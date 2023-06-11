# Dockerfile
FROM php:7.4-apache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the PHP file into the container at /var/www/html
COPY ./src/ /var/www/html/

# Install required package
RUN composer require ccp-eva/esi

# Expose port 80
EXPOSE 80

# By default, simply start apache
CMD ["apache2-foreground"]
