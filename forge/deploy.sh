#!/usr/bin/env bash
set -e

cd /home/forge/marketplace.dataflair.ai

git pull origin main

composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

npm ci
npm run build

php artisan queue:restart || true
