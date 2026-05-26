# syntax=docker/dockerfile:1

FROM php:8.2-apache

# Instalacija sistemskih paketa i PHP ekstenzija neophodnih za Laravel i MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Omogući Apache mod_rewrite (kritično za Laravel rute/linkove)
RUN a2enmod rewrite

# Podesi Apache da gleda direktno u /public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Kopiraj fajlove projekta
COPY . /var/www/html

# Postavi dozvole
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Koristi produkcionu PHP konfiguraciju
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

USER www-data