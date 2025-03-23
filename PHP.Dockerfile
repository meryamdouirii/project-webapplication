# Use official PHP-FPM image
FROM php:fpm

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git \
    zip \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql dom xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory inside the container
WORKDIR /var/www/html/app

# Copy composer files first from the app directory (so composer cache can be used)
COPY ./app/composer.json ./app/composer.lock* ./

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the project files into the container
COPY ./app /var/www/html/app

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html/app

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
