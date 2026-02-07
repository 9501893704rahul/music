FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first for caching
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts || true

# Copy application files
COPY . .

# Install npm dependencies and build
RUN npm install && npm run build

# Create storage directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Create SQLite database
RUN touch database/database.sqlite && chmod 664 database/database.sqlite

# Set environment variables for Laravel
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV DB_CONNECTION=sqlite
ENV PORT=8080

# Generate key and cache views only (skip config/route cache due to env issues at build time)
RUN php artisan key:generate --force || true
RUN php artisan view:cache || true

EXPOSE 8080

# Create startup script that runs migrations and starts server
RUN echo '#!/bin/sh\n\
php artisan migrate --force || true\n\
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}' > /var/www/start.sh && chmod +x /var/www/start.sh

# Start the application
CMD ["/var/www/start.sh"]
