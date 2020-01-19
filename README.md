# Laravel Back-end Focused Project Sample
Demo: http://165.227.195.33/ (Build might not match this version)

## Project Description
This repository serves as a code sample from a project I created for Northeastern University. 

This project was brainstormed upon 2 business needs:
 1) Figure out who owns what website inside Northeastern's massive digital presence
 2) Display accessibility and seo reports for each org.

To achieve 1) I used a Nested Tree data structure to organize the org hierarchy. Each org
has a number of websites (props), on which audits are being run. 

There are 3 types of checks being ran against every prop to achieve 2) and more info:

    1) Uptime Monitoring 
    
        - makes use Laravel's Event Scheduler to check for uptime
        
        - uses Laravel's Notification system to send emails or Slack messages if problems occur
        
    2) Lighthouse Auditing
    
        - Creates .html reports with the lighthouse test results and updates the scores
        
        - runs with Lighthouse's Node.js API via a CRON job and writes the results on the project's database
        
    3) SiteImprove.com Auditing
    
        - The university already ran some tests through SiteImprove and I pulled the scores in this app using the URL as a unique key.
        
        - Currently, the update is being done when the /site-improve route is being hit.

To make this tool further accessible to other developers at the university, there is also an API
through which you can pull all of the data available in the app and also filter sites by scores.

Sample requests:
```
http://165.227.195.33/api/orgs
http://165.227.195.33/api/props

http://165.227.195.33/api/props?techDebt=50-89
http://165.227.195.33/api/props?businessOwner=50-89&seoScore=0-35
```


Technologies used: Laravel, TailWind CSS, Node.js, Google Lighthouse, CRON, SiteImprove.com

## Installating Dev Environment Locally
1) Create a DB with an admin user
2) Fill your .env creditentials after the .example.env file
3) Run the following
```
composer install
npm install

php artisan key:generate
php artisan migrate
php artisan db:seed

### Perform a single uptime check to populate data
php artisan monitor:check-uptime

### Start the lighthouse job
cd lighthouse/
npm install -g lighthouse
npm install
npm run start

cd ../
php artisan serve
npm run watch - in another terminal
```

## When you pull from master run
```
php artisan migrate:refresh --seed
php artisan monitor:check-uptime
cd lighthouse/
node cron
```

## Installing on a server
Install Node
Install PHP and Laravel
Install a mail server https://devanswers.co/how-to-get-php-mail-working-on-ubuntu-16-04-digitalocean-droplet/
Configure your desired scheduling laravel rate for monitoring (https://laravel.com/docs/5.8/scheduling)
Configure the CRON frequency of the lighthouse jobs in its folder
Following the local dev steps

## Useful Links
https://github.com/spatie/uptime-monitor-app + https://laravel.com/docs/5.8/scheduling
https://github.com/lazychaser/laravel-nestedset
https://github.com/GoogleChrome/lighthouse

## Troubleshooting
- If you are on MacOS Catalina and experience problems with Lighthouse
Remove your Google Chrome and Canary and reinstall it.
Then add the Chrome Canary path to your .env file like so:
CANARY_PATH = "/Applications/Google Chrome Canary.app/Contents/MacOS/Google Chrome Canary"
