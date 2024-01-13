FROM php:8.2-fpm-alpine

COPY cronjobs.txt /etc/crontabs/root

RUN apk update \
  && apk upgrade \
  && apk add --no-cache \
    supervisor \
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
COPY supervisor.conf /etc/supervisor/supervisor.conf

RUN chmod +x docker/php/entrypoint.sh

WORKDIR /var/www/html

RUN chmod -R 777 *

ENTRYPOINT /usr/bin/supervisord -c /etc/supervisor/supervisor.conf
