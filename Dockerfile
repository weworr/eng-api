FROM php:8.2-apache

RUN a2enmod rewrite

RUN apt-get update \
  && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev \
  && apt-get install -y libzip-dev git wget --no-install-recommends \
  && apt-get clean \
  && apt-get install -y ssl-cert \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
  && pecl install mongodb \
  && pecl config-set php_ini /etc/php.ini

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN a2enmod ssl

RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/CN=engapi.localhost' -keyout /etc/ssl/private/engapi-selfsigned.key -out /etc/ssl/certs/engapi-selfsigned.crt

RUN docker-php-ext-install pdo mysqli pdo_mysql zip;

RUN php -r 'copy("https://getcomposer.org/installer", "composer-setup.php");' \
  && php composer-setup.php && php -r 'unlink("composer-setup.php");' \
  && mv composer.phar /usr/local/bin/composer

RUN wget https://getcomposer.org/download/2.0.9/composer.phar \
  && mv composer.phar /usr/bin/composer \
  && chmod +x /usr/bin/composer

COPY docker/engapi.localhost.conf /etc/apache2/sites-enabled/engapi.localhost.conf
#COPY docker/web/entrypoint.sh /entrypoint.sh
COPY . /var/www/html/

RUN service apache2 restart

WORKDIR /var/www/html

#RUN chmod +x /entrypoint.sh

CMD ["apache2-foreground"]

#ENTRYPOINT ["/entrypoint.sh"]
