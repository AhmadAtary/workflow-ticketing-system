FROM composer:2.8 AS vendor

WORKDIR /app

COPY backend/composer.json backend/composer.lock ./

RUN composer install \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader \
    --no-dev \
    --no-scripts

FROM php:8.2-fpm-alpine

WORKDIR /var/www/backend

RUN apk add --no-cache \
    bash \
    curl \
    git \
    icu-dev \
    libpq-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-client \
    unzip \
    && docker-php-ext-install \
        bcmath \
        intl \
        pcntl \
        pdo_pgsql \
        zip

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
COPY --from=vendor /app/vendor ./vendor
COPY backend ./
COPY docker/app/entrypoint.sh /usr/local/bin/app-entrypoint

RUN chmod +x /usr/local/bin/app-entrypoint \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/backend \
    && chmod -R ug+rwx storage bootstrap/cache

ENTRYPOINT ["app-entrypoint"]
CMD ["php-fpm", "-F"]
