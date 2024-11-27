FROM php:8.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

COPY docker/php/website.conf /etc/apache2/sites-available/000-default.conf
