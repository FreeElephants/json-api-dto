ARG PHP_VERSION=8.3

FROM php:${PHP_VERSION}-cli

RUN apt-get update \
    && apt-get install -y \
    git \
    libzip-dev \
    unzip \
    libicu-dev

RUN docker-php-ext-install \
    zip \
    intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN pecl install xdebug \
    && docker-php-ext-enable xdebug


RUN echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /app
