#!/bin/bash
set -e

php artisan config:clear
php artisan cache:clear
php artisan migrate:fresh --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache

apache2-foreground