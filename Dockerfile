FROM php:8.2-apache
RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql zip
RUN a2enmod rewrite
WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
EXPOSE 80
CMD php artisan migrate --force && php artisan config:clear && apache2-foreground
