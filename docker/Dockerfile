FROM php:8.1-apache

ARG name=diogox451
ARG uid=1000

COPY book.api.conf /etc/apache2/sites-available/

RUN a2ensite book.api && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN apt-get update && \
    apt-get install git libpng-dev libonig-dev postgresql postgresql-contrib libpq-dev -y

RUN docker-php-ext-install calendar pdo_mysql mysqli pdo_pgsql pgsql 


RUN echo "www-data ALL=NOPASSWD: /usr/bin/php, /usr/bin/python2.7, /usr/bin/python2" >> /etc/sudoers

RUN apt-get update && apt-get install -y libzip-dev zlib1g-dev \
    && docker-php-ext-install zip gd

ENV APACHE_RUN_USER book
RUN useradd -d /var/www --uid=1000 --group=www-data -s /sbin/nologin book

RUN chmod 777 /var/www/html -R