FROM php:7.1-apache-stretch
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
	libxml2-dev \
	libcurl4-gnutls-dev \
	libpq-dev \
	git \
    && docker-php-ext-install -j$(nproc) iconv mcrypt pgsql pdo pdo_pgsql mbstring curl xml\
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY ./ /var/www/html
WORKDIR /var/www/html
RUN composer install

ENTRYPOINT php artisan serve
