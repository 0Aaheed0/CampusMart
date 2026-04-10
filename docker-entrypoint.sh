#!/bin/bash
set -e

php artisan config:clear || true
php artisan cache:clear || true
php artisan migrate:fresh --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache

exec apache2ctl -D FOREGROUND