FROM php:7.4.7-fpm-alpine

ARG environment

RUN apk upgrade --update \
  && apk add --update --no-cache oniguruma-dev \
  && apk --no-cache --virtual .build-deps add make g++ gcc re2c autoconf \
  && apk --no-cache add gettext-dev libzip-dev curl-dev \
  && docker-php-ext-install -j$(nproc) gettext mbstring zip opcache ctype json bcmath sockets curl \
  && pecl channel-update pecl.php.net

# PDO(MySQL)
RUN docker-php-ext-install -j$(nproc) pdo_mysql

# YAML (2.0.4)extension=yaml.so
RUN apk --no-cache add yaml-dev \
  && pecl install yaml-2.0.4 \
  && docker-php-ext-enable yaml

# APCu (5.1.17)  extension=apcu.so
RUN pecl install apcu-5.1.17 \
  && docker-php-ext-enable apcu

# igbinary (3.0.1) extension=igbinary.so
RUN pecl install igbinary-3.0.1 \
  && docker-php-ext-enable igbinary

# msgpack (2.0.3) extension=msgpack.so
RUN pecl install msgpack-2.0.3 \
  && docker-php-ext-enable msgpack

RUN apk del --purge .build-deps \
  && docker-php-source delete \
  && rm -rf /var/cache/apk/* \
  && rm -rf /tmp/*

RUN deluser www-data \
    && addgroup -g 1000 -S www-data \
    && adduser -u 1000 -D -S -G www-data www-data

