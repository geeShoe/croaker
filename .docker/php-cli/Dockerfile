ARG PHP_VERSION

FROM php:${PHP_VERSION}-cli-alpine

RUN apk update && \
    apk add --no-cache bash && \
    apk add --no-cache icu-dev && \
    apk add --no-cache libintl && \
    apk add --no-cache $PHPIZE_DEPS

RUN pecl install xdebug

RUN docker-php-ext-enable xdebug && \
    docker-php-ext-install pdo_mysql

RUN cp $(find /usr/local/etc/php -name "php.ini-development") /usr/local/etc/php/php.ini && \
    find /usr/local/lib/php -name "xdebug.so" -exec echo 'zend_extension="{}"' >> /usr/local/etc/php/php.ini \;

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

USER 1000:1000

WORKDIR /vat/htdocs