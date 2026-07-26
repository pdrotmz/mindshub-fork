#!/bin/sh
set -e

echo "Gerando cache de config/rotas/views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Rodando migrations..."
php artisan migrate --force

exec "$@"