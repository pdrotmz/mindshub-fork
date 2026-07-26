#!/bin/sh
set -e

echo "Limpando caches antigos..."
rm -rf bootstrap/cache/*
mkdir -p bootstrap/cache

echo "Rodando migrations..."
php artisan migrate --force

echo "Gerando cache de config/rotas/views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"