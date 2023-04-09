FROM php:8.1-apache

RUN a2enmod rewrite

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer self-update

RUN apt-get update \
    && apt-get install zip unzip

RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug

COPY config/apache.conf /etc/apache2/sites-available/000-default.conf
COPY config/php.ini /usr/local/etc/php/php.ini
