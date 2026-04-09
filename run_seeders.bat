@echo off
cd D:\CampusMart\cse-3100\CampusMart-develop
echo ========================================
echo Running Database Seeding...
echo ========================================
echo.

REM Clear existing data (optional - comment out if you want to keep current data)
REM php artisan migrate:refresh

REM Run only the new seeders
echo Running UserSeeder with 16 Bangladeshi users...
php artisan db:seed --class=UserSeeder

echo Running PostProductSeeder with 30 demo products...
php artisan db:seed --class=PostProductSeeder

echo.
echo ========================================
echo Seeding Complete!
echo ========================================
echo.
echo Summary:
echo - 16 users added (4 admins, 12 regular users)
echo - 30 demo products added with Unsplash images
echo - All products set to 'available' status
echo.
pause
