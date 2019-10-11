# NU Props 

## Installating Dev Environment

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
npm run prod - in another terminal
```


## Useful Links
https://github.com/spatie/uptime-monitor-app + https://laravel.com/docs/5.8/scheduling

https://github.com/lazychaser/laravel-nestedset
https://github.com/GoogleChrome/lighthouse
