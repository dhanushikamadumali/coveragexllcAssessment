#!/bin/bash

# Wait for MariaDB to be ready
echo "Waiting for MariaDB to be available..."
while ! nc -z mariadb 3306; do
  sleep 1
done
echo "MariaDB is up and running."

# Run Laravel's key:generate command
php artisan key:generate

# Run Laravel migrations
php artisan migrate --force

# Start Laravel development server
php artisan serve --host=0.0.0.0 --port=8000
