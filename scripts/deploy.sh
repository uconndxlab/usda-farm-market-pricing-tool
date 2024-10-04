#!/bin/bash
set -e

# Which user is running this script?
echo "Running as $(whoami)"

cd usda-farm-market-pricing-tool

DB_CONNECTION=sqlite composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

php artisan optimize

php artisan migrate --force

chown -R :www-data .

if [ -d /var/www/marketpricing.core.uconn.edu/ ]; then
    echo "Copying files to the server"
    rsync -arvp --omit-dir-times ./ /var/www/marketpricing.core.uconn.edu/
else 
    echo "Skipping file copy. Prod directory does not exist."
fi