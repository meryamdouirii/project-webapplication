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