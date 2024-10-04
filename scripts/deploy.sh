#!/bin/bash
set -e

# Which user is running this script?
echo "Running as $(whoami)"

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"  # This loads nvm
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"  # This loads nvm bash_completion

cd usda-farm-market-pricing-tool

DB_CONNECTION=sqlite composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

chown -R :www-data .

npm ci
npm run build

if [ -d /var/www/marketpricing.core.uconn.edu/ ]; then
    echo "Copying files to the server"
    rsync -arv --omit-dir-times ./ /var/www/marketpricing.core.uconn.edu/

    cd /var/www/marketpricing.core.uconn.edu
    php artisan migrate --force
    php artisan optimize
    chown -R :www-data .
else 
    echo "Skipping file copy. Prod directory does not exist."
fi

