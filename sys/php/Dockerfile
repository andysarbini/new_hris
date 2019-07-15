FROM php:7.2-apache
MAINTAINER g3n1k
#RUN docker-php-ext-install pdo pdo_mysql mysqli gd

RUN apt-get update && apt-get install -y \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libaio1 \
        libxml2-dev \
    && docker-php-ext-install -j$(nproc) iconv gettext \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli zip xml xmlwriter


ADD dev.conf /etc/apache2/conf-available/
ADD dev.ini /usr/local/etc/php/conf.d/
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.pem -subj "/C=ID/ST=Vienna/L=Vienna/O=Security/OU=Development/CN=example.com"

RUN a2enconf dev
RUN a2enmod rewrite
RUN a2ensite default-ssl
RUN a2enmod ssl


# you can add more command here


RUN service apache2 restart
