#!/usr/bin/env sh
set -eu

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    database_path="${DB_DATABASE:-/tmp/database.sqlite}"
    mkdir -p "$(dirname "$database_path")"
    touch "$database_path"
fi

php artisan config:cache
php artisan view:cache
php artisan migrate --seed --force

port="${PORT:-10000}"
sed -ri "s/Listen 80/Listen ${port}/" /etc/apache2/ports.conf
sed -ri "s/:80>/:${port}>/" /etc/apache2/sites-available/*.conf

exec apache2-foreground
