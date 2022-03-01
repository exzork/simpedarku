FROM php:8.1.3-apache
RUN apt-get update && \
    apt-get install -y
RUN apt-get install -y curl
RUN apt-get install -y libicu-dev libzip-dev
RUN apt-get update
RUN docker-php-ext-install intl
RUN docker-php-ext-configure intl
RUN docker-php-ext-install mysqli pdo pdo_mysql zip exif

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions http

RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN service apache2 restart

ADD . /var/www
ADD ./public /var/www/html
ADD .env /var/www/.env
WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN chown -R www-data:www-data /var/www/
RUN chown -R www-data:www-data /var/www/storage
RUN composer install

EXPOSE 443
EXPOSE 80
