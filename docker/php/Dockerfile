FROM php:8.4-fpm-alpine

RUN docker-php-ext-install pdo_mysql opcache

WORKDIR /var/www/html/in48-laravel-blog

COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY docker/php/zz-fpm.conf /usr/local/etc/php-fpm.d/zz-fpm.conf
COPY . /var/www/html/in48-laravel-blog

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rw storage bootstrap/cache
