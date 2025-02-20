FROM php:8.1.31-fpm-alpine

RUN apk add --no-cache openssl bash mysql-client nodejs npm
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www/html

COPY . /var/www/html

# RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https:://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

ENTRYPOINT [ "php-fpm" ]