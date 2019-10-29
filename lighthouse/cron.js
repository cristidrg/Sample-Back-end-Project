require('dotenv').config({ path: '../.env' });

const chromeLauncher = require('chrome-launcher');
const urlMetadata = require('url-metadata');
const lighthouse = require('lighthouse');
const cron = require("node-cron");
const mysql = require('mysql');
const fs = require('fs');

const launchChromeAndRunLighthouse = (url, opts, config = null) => new Promise((resolve, reject) => {
    chromeLauncher.launch({chromeFlags: opts.chromeFlags}).then(chrome => {
        opts.port = chrome.port;

        lighthouse(url, opts, config).then(results => {
            chrome.kill().then(() => resolve(results))
        }).catch(error => reject(error));
    }).catch(error => reject(error));
});

const opts = {
  chromeFlags: ['--headless', '--no-sandbox'],
  onlyCategories: ['performance', 'seo', 'accessibility'],
  output: 'html',
  port: process.env.LIGHTHOUSE_PORT
};

// cron.schedule("* * * * *", function() {
    const connection = mysql.createConnection({
        host: process.env.DB_HOST,
        user: process.env.DB_USERNAME,
        password: process.env.DB_PASSWORD,
        database: process.env.DB_DATABASE
    });

    connection.connect();

    connection.query(`
        SELECT id, url, title
        FROM props;
    `, async (error, results) => {
        if (error) throw error;

        for ({url, id, title} of results) {
            try {
                console.log("Launching lighthouse and metadata grabber for " + url);
                const report = await launchChromeAndRunLighthouse(url, opts);
                const metaData = await urlMetadata(url);
                
                await saveResult(report, title, id, metaData.title, metaData.description, connection);
            } catch (err) {
                console.log('Error at ' + url + ': ');
                console.log(err);
            }
        }

        return;
    });
// });

const saveResult = (result, title, id, metaTitle, metaDesc, connection) => new Promise((resolve, reject) => {
    if (result == undefined) {
        console.log('Lighthouse test failed to run for ' + title);
        reject();
    }

    try {
        fs.writeFileSync(`../public/audits/${id}.html`, result.report);
    } catch (err) {
        console.log('Error writing file for ' + title + ': ');
        console.log(err);
        reject();
    }

    const resultJson = result.lhr;
    const { requestedUrl, fetchTime } = resultJson;
    const perfScore = resultJson.categories.performance.score;
    const a11yScore = resultJson.categories.accessibility.score;
    const seoScore = resultJson.categories.seo.score;
    
    if (perfScore != null && a11yScore != null && seoScore != null) {
        connection.query(`
            UPDATE props
            SET
                perfScore = '${perfScore}',
                a11yScore = '${a11yScore}',
                seoScore = '${seoScore}',
                fetchTime = '${fetchTime}',
                metaTitle = ${connection.escape(metaTitle)},
                metaDesc = ${connection.escape(metaDesc)}
            WHERE url = '${requestedUrl}';
        `, (error) => {
            if (error) {
                console.log("Error writing to db for " + url + ": ");
                console.log(error);
                reject();
            }
            console.log(url + " has been succesfully updated \n");
            resolve();
        });
    }
});
