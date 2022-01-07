FROM composer:2 as composer_stage

RUN rm -rf /var/www && mkdir -p /var/www/
WORKDIR /var/www/

COPY /app/composer.json /app/composer.lock ./

# This are production settings, I'm running with 'no-dev', adjust accordingly
# if you need it
RUN composer install --no-scripts --no-progress --no-interaction --no-dev --no-autoloader

RUN composer dump-autoload --optimize --apcu --no-dev

FROM php:7.4-fpm

# Install packages and PHP extensions
RUN apt update \
    && apt install -y git acl openssl openssh-client wget zip vim librabbitmq-dev libssh-dev \
    && apt install -y libpng-dev zlib1g-dev libzip-dev libxml2-dev libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip soap bcmath sockets gd \
    && pecl install xdebug \
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache xdebug

# Install and update composer
RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer self-update

# Install PHP-CS-FIXER
RUN wget https://cs.symfony.com/download/php-cs-fixer-v2.phar -O php-cs-fixer
RUN chmod a+x php-cs-fixer
RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer

RUN mkdir -p /var/www/

WORKDIR /var/www

# Config XDEBUG
COPY docker/php-fpm/xdebug.ini  /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY docker/php-fpm/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini

COPY --from=composer_stage /var/www/ /var/www/

COPY app ./
