FROM php:8.2-fpm

RUN apt-get update --fix-missing && \
    apt-get install -y \
    nano vim procps git iproute2 wget unzip\
    # acllocal
    autotools-dev automake\
    libmemcached-dev \
    libzip-dev \
    # для intl
    libicu-dev \
    # для xml и soap
    libxml2-dev \
    # zmq
    libzmq3-dev \
    # для gd
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    # для PostgreSQL
    libpq-dev \
    # для imap
    libc-client-dev \
    libkrb5-dev && rm -r /var/lib/apt/lists/* \
    # установка модулей
    && pecl install xdebug-3.2.0 \
    && docker-php-ext-enable xdebug \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install intl \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install soap \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install sockets \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install pgsql

# Composer
COPY --from=composer:2.6.2 /usr/bin/composer /usr/bin/composer

RUN sed -i 's|DEFAULT@SECLEVEL=2|DEFAULT@SECLEVEL=1|g' /etc/ssl/openssl.cnf

WORKDIR /symfony