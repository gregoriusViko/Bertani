# ==========================================
# Tahap 1: Build Dependencies PHP (Composer)
# ==========================================
FROM composer:2.7 as vendor
WORKDIR /app

COPY database/ database/
COPY composer.json composer.lock ./

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# ==========================================
# Tahap 2: Build Aset Frontend (Node.js)
# ==========================================
FROM node:20-alpine as frontend
WORKDIR /app

COPY package.json package-lock.json* vite.config.js ./
RUN npm ci

COPY resources/ resources/
COPY public/ public/
RUN npm run build

# ==========================================
# Tahap 3: Image Produksi Akhir (PHP-FPM Alpine)
# ==========================================
FROM php:8.2-fpm-alpine

# Install ekstensi minimal & esensial untuk Laravel + Reverb
RUN apk add --no-cache \
    zip \
    libzip-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    icu-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    sockets

WORKDIR /var/www/html

# Salin hasil eliminasi dari Tahap 1 dan Tahap 2
COPY --from=vendor /app/vendor/ ./vendor/
COPY --from=frontend /app/public/ ./public/

# Salin sisa kode aplikasi
COPY . .

# Atur kepemilikan file secara ketat ke user www-data demi keamanan
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]