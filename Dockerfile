# Dockerfile
# Multi-stage build for CampusMart Laravel Application
# This Dockerfile sets up a PHP-FPM container for running the CampusMart marketplace

FROM php:8.2-fpm

# Metadata
LABEL maintainer="CampusMart Development Team"
LABEL description="CampusMart Laravel Application Server"
LABEL version="1.0"

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libxml2-dev \
    libfreetype6-dev \
    mariadb-client \
    ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required for Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    json

# Install Composer (latest version)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Create a non-root user for security
RUN useradd -m -u 1000 www-data || true

# Copy project files
COPY . .

# Set permissions before composer install
RUN chown -R www-data:www-data /var/www/html

# Switch to www-data user
USER www-data

# Install PHP dependencies (Composer)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Switch back to root to set final permissions
USER root

# Set proper permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 755 /var/www/html/bootstrap/cache

# Generate Laravel key if not already set
RUN if [ ! -f .env ]; then cp .env.example .env 2>/dev/null || true; fi

# Clear Laravel cache and config for Docker environment
RUN php artisan config:clear 2>/dev/null || true
RUN php artisan cache:clear 2>/dev/null || true

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]