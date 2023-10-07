FROM php:8.2-fpm-alpine

RUN apk update \
  && apk upgrade \
  && apk add --no-cache \
    libzip-dev  \
    git  \
    wget  \
    autoconf  \
    pkgconfig  \
    unzip  \
    libssh-dev \
    linux-headers \
    musl-dev \
    gcc \
    make \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions &&  \
    sync && \
    install-php-extensions amqp-1.11.0

RUN docker-php-ext-install pdo zip bcmath sockets;

RUN pecl install mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

COPY ../../ /var/www/html/
COPY entrypoint.sh docker/php/entrypoint.sh

RUN chmod +x docker/php/entrypoint.sh

WORKDIR /var/www/html

RUN chmod -R 777 *

#RUN /usr/bin/composer install --no-interaction

#ENTRYPOINT ["docker/php/entrypoint.sh"]
