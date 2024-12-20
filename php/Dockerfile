## TO APACHE ##
#FROM php:8.2-apache
#RUN pecl install redis && docker-php-ext-enable redis
#RUN docker-php-ext-install pdo pdo_mysql
#RUN a2enmod rewrite

FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y libpq-dev \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer