# Use official PHP image as base
FROM php:8.1-apache

# Install necessary PHP extensions (e.g., GD for image processing)
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Copy the application code to the container's web root
COPY . /var/www/html/

# Update Apache configuration to use the correct DocumentRoot


# Set the working directory
WORKDIR /var/www/html

# Expose port 80 for HTTP traffic
EXPOSE 80

# Enable the Apache rewrite module (if necessary)
RUN a2enmod rewrite
