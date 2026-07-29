FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY . /var/www/html/

WORKDIR /var/www/html/public

EXPOSE 80

CMD ["apache2-foreground"]
