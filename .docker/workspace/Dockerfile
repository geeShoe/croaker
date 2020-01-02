ARG PHP_VERSION

FROM php:${PHP_VERSION}-cli-buster

RUN apt-get update && apt-get install -yqq \
    libicu-dev \
    libzip-dev \
    zip \
    gnupg \
    git

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -yqq \
    nodejs \
    yarn

RUN curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install intl && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo_mysql

RUN set -xe; \
    groupadd -g 1000 developer && \
    useradd -u 1000 -g developer -m developer && \
    usermod -p "*" developer -s /bin/bash

COPY .bash_aliases /home/developer/.bash_aliases

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

USER developer

WORKDIR /var/htdocs