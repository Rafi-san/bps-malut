FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Node.js untuk build asset Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /app
COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Build asset (menghasilkan public/build/manifest.json)
RUN npm ci && npm run build

RUN php artisan config:clear

RUN printf "upload_max_filesize=12M\npost_max_size=14M\n" > /usr/local/etc/php/conf.d/uploads.ini

EXPOSE 8080

CMD php artisan migrate --force && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8080