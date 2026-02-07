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

# Install composer dependencies (ignoring platform reqs since vendor exists)
RUN composer install --no-dev --optimize-autoloader --no-scripts || true

# Copy application files
COPY . .

# Install npm dependencies and build
RUN npm install && npm run build

# Create SQLite database
RUN touch database/database.sqlite

# Generate application key if not set
RUN php artisan key:generate --force || true

# Cache configuration
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# Set default port (Railway overrides via PORT env var)
ENV PORT=8080
EXPOSE 8080

# Start the application using shell form to expand $PORT
CMD php artisan serve --host=0.0.0.0 --port=$PORT
