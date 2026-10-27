FROM php:8.2-apache

# Extensions pour Laravel + PostgreSQL (Neon)
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Apache rewrite pour Laravel
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copie du projet
COPY . .

# Permissions Laravel
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 storage bootstrap/cache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Apache pointe vers /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

# LANCEMENT : efface les tables cassées et recrée tout + démarre Apache
CMD php artisan config:clear && php artisan migrate:fresh --force && apache2-foreground
