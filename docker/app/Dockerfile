FROM php:8.2-fpm
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions apcu bcmath exif gd gettext gmp imagick intl mcrypt mysqli opcache pdo_mysql snmp soap xsl zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY ./docker/app/php.ini "$PHP_INI_DIR/php.ini"
