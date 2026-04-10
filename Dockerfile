FROM php:8.2-cli

LABEL maintainer="CampusMart Development Team"

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libonig-dev \
    libpng-dev libjpeg-dev libxml2-dev libfreetype6-dev \
    mariadb-client ca-certificates \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql mbstring zip exif pcntl bcmath gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8080

CMD ["/bin/bash", "/usr/local/bin/docker-entrypoint.sh"]