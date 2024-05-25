FROM php:8.2-fpm

ENV TZ="Asia/Tehran"
# Install Composer
ENV COMPOSER_VERSION 2.6.5

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=$COMPOSER_VERSION


RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libssl-dev \
        libzip-dev \
        unzip \
        zip \
    && apt-get clean \
    && pecl install redis \
    && docker-php-ext-configure gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install \
        gd \
        exif \
        opcache \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        pcntl \
        zip \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*;

COPY ./docker/php/laravel.ini /usr/local/etc/php/conf.d/laravel.ini

WORKDIR /usr/src/app

COPY . /usr/src/app

RUN chown -R www-data:www-data .

RUN composer install
