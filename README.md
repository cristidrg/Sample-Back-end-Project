# NU Props 

## Installating Dev Environment Locally

```
composer install
npm install

php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan monitor:check-uptime

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

## Useful Links
https://github.com/spatie/uptime-monitor-app + https://laravel.com/docs/5.8/scheduling

https://github.com/lazychaser/laravel-nestedset
https://github.com/GoogleChrome/lighthouse
