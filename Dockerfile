# Dockerfile
FROM php:7.4-apache

# Copy the PHP file into the container at /var/www/html
COPY ./src/ /var/www/html/

# Expose port 80
EXPOSE 80

# By default, simply start apache
CMD ["apache2-foreground"]
