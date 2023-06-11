FROM php:7.4-apache

RUN apt-get update && apt-get install -y zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --prefer-source --no-interaction
COPY ./src/ /var/www/html/

WORKDIR /var/www/html/
RUN composer install

EXPOSE 80
CMD ["apache2-foreground"]
