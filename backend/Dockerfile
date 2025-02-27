# Use PHP 8.2 image with FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Install dependencies for Laravel
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    netcat-openbsd \
    npm \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set the working directory inside the container
WORKDIR /var/www

# Copy the composer.json and install composer
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the Laravel project files into the container
COPY . .

# Set the file permissions for Laravel (if needed)
RUN chown -R www-data:www-data /var/www

# Copy the entrypoint script into the container
COPY docker-entrypoint.sh /usr/local/bin/

# Make the entrypoint script executable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Set the entry point to run the entrypoint script
ENTRYPOINT ["docker-entrypoint.sh"]

# Expose the port (default PHP-FPM port)
EXPOSE 8000

# Start the PHP-FPM service (this will be executed after key generation and migrations)
CMD ["php-fpm"]
