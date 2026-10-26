FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev libzip-dev sqlite3 libsqlite3-dev unzip git curl && docker-php-ext-install pdo pdo_sqlite mbstring gd zip bcmath

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p database storage/logs bootstrap/cache storage/framework/sessions storage/framework/views storage/framework/cache && touch database/database.sqlite && chown -R www-data:www-data storage bootstrap/cache database && chmod -R 775 storage bootstrap/cache database

RUN php artisan config:clear || true

EXPOSE 80

RUN echo '#!/bin/bash\nphp artisan migrate --force\nphp artisan config:clear\nphp artisan cache:clear\napache2-foreground' > /start.sh && chmod +x /start.sh
CMD ["/start.sh"]
