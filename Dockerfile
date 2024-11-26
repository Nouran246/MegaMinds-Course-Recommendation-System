# Use a PHP image from Docker Hub
FROM php:7.4-apache

# Copy the contents of your project into the container
COPY . /var/www/html/

# Expose the default Apache port
EXPOSE 80
