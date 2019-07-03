FROM php:7.0-fpm

COPY . /app

WORKDIR /app

RUN apt-get update && apt-get install -y zip unzip git libmcrypt-dev mysql-client \
    && docker-php-ext-install mcrypt pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

EXPOSE 80