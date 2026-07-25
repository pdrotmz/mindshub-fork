# ---------- Estágio 1: build do front (Vite/React) ----------
FROM node:20-alpine AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm ci

COPY . .
# Ajuste o comando se seu script de build tiver outro nome
RUN npm run build

# ---------- Estágio 2: dependências PHP (Composer) ----------
FROM composer:2 AS vendor

WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader

# ---------- Estágio 3: imagem final (PHP-FPM + Nginx) ----------
FROM php:8.3-fpm-alpine

# Extensões comuns do Laravel
RUN apk add --no-cache \
        nginx \
        supervisor \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
        curl \
        postgresql-dev \
    && docker-php-ext-install \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        zip \
        gd \
        bcmath \
        opcache

WORKDIR /var/www/html

# Copia o código da aplicação
COPY . .

# Copia vendor/ já instalado
COPY --from=vendor /app/vendor ./vendor

# Copia os assets do React já buildados (ajuste "dist" se seu build sair em outra pasta)
COPY --from=frontend /app/public/build ./public/build

# Configs de Nginx / Supervisor / PHP
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/laravel.ini
COPY docker/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]