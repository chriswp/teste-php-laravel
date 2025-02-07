#!/bin/sh

composer update

php artisan key:generate
php artisan migrate
php artisan optimize:clear
php artisan config:cache

#php artisan queue:work

chmod +x -R ./storage

php-fpm
