
# opaiapp
## Setup Instructions

1. Install Composer Dependencies

Ensure all necessary PHP dependencies are installed using Composer:

composer install

2. Run Database Migrations

To set up the database schema, run the following migrations in the specified order. This ensures all tables are created correctly.

php artisan migrate --path=/database/migrations/2025_12_01_042935_create_apps_table.php
php artisan migrate --path=/database/migrations/2025_12_01_043817_create_app_settings_table.php
php artisan migrate --path=/database/migrations/0001_01_01_000000_create_users_table.php
php artisan migrate --path=/database/migrations/2025_12_01_043930_create_nonce_table.php
php artisan migrate --path=/database/migrations/0001_01_01_000001_create_cache_table.php
php artisan migrate --path=/database/migrations/0001_01_01_000002_create_jobs_table.php
php artisan migrate --path=/database/migrations/2025_11_29_131147_create_personal_access_tokens_table.php
php artisan migrate --path=/database/migrations/2025_12_02_061151_create_app_packages_table.php
php artisan migrate --path=/database/migrations/2025_12_02_061821_create_customer_deposits_table.php
php artisan migrate --path=/database/migrations/2025_12_02_094431_create_customer_earning_details_table.php
php artisan migrate --path=/database/migrations/2025_12_03_044502_create_app_level_packages_table.php
php artisan migrate --path=/database/migrations/2025_12_03_093456_create_free_deposit_package_table.php
php artisan migrate --path=/database/migrations/2025_12_03_103914_create_wallet_transactions_table.php
php artisan migrate --path=/database/migrations/2025_12_04_050908_create_customer_withdraws_table.php
php artisan migrate --path=/database/migrations/2025_12_04_054615_create_customer_financials_table

3. Run Database Seeders
After migrations, populate the database with initial data using the following seeders:
Code

php artisan db:seed --class=SuperAdminSeeder
php artisan db:seed --class=AppPackagesSeeder
php artisan db:seed --class=AppLevelPackagesSeeder
php artisan db:seed --class=FreeDepositPackagesSeeder

4. Install Required Modules for web3 connection

composer require kornrunner/keccak
composer require simplito/elliptic-php

Install them via Composer:
