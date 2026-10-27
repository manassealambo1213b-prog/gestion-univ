FROM php:8.2-apache
RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip && docker-php-ext-install pdo pdo_pgsql pgsql zip
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
WORKDIR /var/www/html
COPY . .
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN mkdir -p storage/logs bootstrap/cache storage/framework/sessions storage/framework/views storage/framework/cache
RUN php artisan config:clear || true
EXPOSE 80
RUN echo '#!/bin/bash\nphp artisan migrate --force\nphp artisan config:clear\nphp artisan cache:clear\napache2-foreground' > /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]
