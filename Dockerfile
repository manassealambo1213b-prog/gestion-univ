FROM php:8.2-apache
RUN apt-get update && apt-get install -y git zip unzip libpng-dev libonig-dev libxml2-dev sqlite3 libsqlite3-dev && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
WORKDIR /var/www/html
COPY . .
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader
RUN mkdir -p database storage/logs bootstrap/cache && touch database/database.sqlite && mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache && chown -R www-data:www-data storage bootstrap/cache database && chmod -R 775 storage bootstrap/cache database
RUN php artisan config:clear || true
RUN php artisan migrate --force || true
EXPOSE 80
CMD ["apache2-foreground"]
