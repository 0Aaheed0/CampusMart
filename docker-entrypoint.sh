#!/bin/bash

php artisan config:clear || true
php artisan migrate:fresh --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache

exec php artisan serve --host=0.0.0.0 --port=8080