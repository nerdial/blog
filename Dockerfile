FROM php:8.0-fpm


RUN apt-get update && apt-get install vim openssl libssl-dev wget git zlib1g-dev zip unzip libicu-dev supervisor -y

RUN docker-php-ext-install bcmath pcntl pdo_mysql intl sockets

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

RUN mkdir -p /app/storage



WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD / /app


CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]

EXPOSE 8000
