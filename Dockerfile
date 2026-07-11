FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
        libicu-dev \
        libzip-dev \
        libpng-dev \
        libxml2-dev \
        libonig-dev \
    && docker-php-ext-install \
        intl \
        zip \
        gd \
        mysqli \
        pdo_mysql \
        dom \
        mbstring \
        xml \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
