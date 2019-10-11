const lighthouse = require('lighthouse');
const chromeLauncher = require('chrome-launcher');
const mysql = require('mysql');
const fs = require('fs');

async function launchChromeAndRunLighthouse(url, opts, config = null) {
  return chromeLauncher.launch({chromeFlags: opts.chromeFlags}).then(chrome => {
    opts.port = chrome.port;
    return lighthouse(url, opts, config).then(results => {
      // use results.lhr for the JS-consumeable output
      // https://github.com/GoogleChrome/lighthouse/blob/master/types/lhr.d.ts
      // use results.report for the HTML/JSON/CSV output as a string
      // use results.artifacts for the trace/screenshots/other specific case you need (rarer)
      return chrome.kill().then(() => results)
    }).catch(error => console.log(error));;
  }).catch(error => console.log(error));
}

const opts = {
  chromeFlags: ['--headless', '--no-sandbox'],
  onlyCategories: ['performance', 'seo', 'accessibility'],
  output: 'html',
  port: '8003'
};

// SETUP: Database Connection Data
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'propsadmin',
    password: 'props123',
    database: 'props_prod'
});

connection.connect();

connection.query(`
    SELECT id, url, title
    FROM props;
`, async (error, results) => {
    if (error) throw error;

    console.log("Select Query succesfull");

    const mapEntryToFunc = entry => new Promise((resolve, reject) => {
        console.log("Launching Lighthouse Test for " + entry.url);

        launchChromeAndRunLighthouse(entry.url, opts)
            .then(res => resolve(saveResult(res, entry.title, entry.id)))
            .catch(error => reject(error));
    })

    for (let result of results.map(x => () => mapEntryToFunc(x))) {
        await result()
    }

});

const saveResult = async (result, title, id) => {
    if (result == undefined) {
        console.log('Lighthouse test failed to run for ' + title);
        return;
    }

    try {
        fs.writeFileSync(`../public/audits/${id}.html`, result.report);
        console.log('Successfully wrote html audit for ' + title);
    } catch (err) {
        console.log('Error writing file for ' + title, err);
        return;
    }

    const resultJson = result.lhr;
    const { requestedUrl, fetchTime } = resultJson;
    const perfScore = resultJson.categories.performance.score;
    const a11yScore = resultJson.categories.accessibility.score;
    const seoScore = resultJson.categories.seo.score;
    
    if (perfScore != null && a11yScore != null && seoScore != null) {
        await connection.query(`
            UPDATE props
            SET
                perfScore = '${perfScore}',
                a11yScore = '${a11yScore}',
                seoScore = '${seoScore}',
                fetchTime = '${fetchTime}'
            WHERE url = '${requestedUrl}';
        `, (error) => {
            if (error) throw error;
            console.log('Updated DB Succesfully for ' + title);
        });
    }
};
