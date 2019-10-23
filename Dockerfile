FROM php:7.2-apache

COPY . /var/www/html/

WORKDIR /var/www/html/

RUN apt-get update && apt-get install -y zip unzip git libmcrypt-dev mariadb-client \
    && docker-php-ext-install pdo_mysql sockets bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

EXPOSE 80

CMD ["apache2-foreground"]