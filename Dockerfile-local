FROM php:8.1-fpm-alpine

ARG user=christopher
ARG uid=1000

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --no-cache openssl bash nodejs npm mysql postgresql-dev
RUN docker-php-ext-install pdo pgsql pdo_pgsql mysqli pdo_mysql

RUN apk add --no-cache zip libzip-dev libxml2-dev libpng-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip xml gd simplexml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

ENTRYPOINT ["sh", "./docker/entrypoint.sh"]
