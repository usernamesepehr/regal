FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libz-dev \
    libssl-dev \
    && pecl install redis \
    && docker-php-ext-enable redis