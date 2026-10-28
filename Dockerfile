FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip \
    && a2enmod rewrite

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

# Apache pointe vers /public et écoute sur 10000 pour Render
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's/Listen 80/Listen 10000/g' /etc/apache2/ports.conf \
    && sed -i 's/:80/:10000/g' /etc/apache2/sites-available/000-default.conf

EXPOSE 10000

# LANCEMENT : efface les tables cassées et recrée tout + démarre Apache
CMD php artisan config:clear && php artisan migrate:fresh --force && apache2-foreground
