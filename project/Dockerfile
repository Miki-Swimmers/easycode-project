FROM node:latest AS node
FROM php:8.3-fpm

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

WORKDIR /var/www/local.easycode.com

RUN apt-get update && apt-get install -y \
    g++ \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    libz-dev \
    zip \
    wget \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    zlib1g-dev \
    && pecl install redis \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install opcache pdo pdo_mysql zip gd pcntl \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

COPY --chown=www:www . .

USER www

CMD ["php-fpm"]
