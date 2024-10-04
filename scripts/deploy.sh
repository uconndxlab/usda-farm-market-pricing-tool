#!/bin/bash
set -e

# Which user is running this script?
echo "Running as $(whoami)"

cd usda-farm-market-pricing-tool

DB_CONNECTION=sqlite composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

chown -R :www-data .

npm ci
npm run build

if [ -d /var/www/marketpricing.core.uconn.edu/ ]; then
    echo "Copying files to the server"
    rsync -arvp --omit-dir-times ./ /var/www/marketpricing.core.uconn.edu/

    cd /var/www/marketpricing.core.uconn.edu
    php artisan migrate --force
    php artisan optimize
    chown -R :www-data .
else 
    echo "Skipping file copy. Prod directory does not exist."
fi

