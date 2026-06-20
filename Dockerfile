# ==========================================
# Tahap 1: Build Dependencies PHP (Composer)
# ==========================================
FROM composer:2.7 as vendor

WORKDIR /app

# Salin file yang dibutuhkan untuk instalasi dependensi
COPY database/ database/
COPY composer.json composer.lock ./

# Install vendor tanpa dev-dependencies untuk keamanan & ukuran
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

# Install NPM dependencies
COPY package.json package-lock.json* vite.config.js ./
RUN npm ci

# Salin resource frontend dan build (misal: tailwind, vue, react)
COPY resources/ resources/
COPY public/ public/
RUN npm run build

# ==========================================
# Tahap 3: Image Produksi Akhir
# ==========================================
FROM php:8.2-fpm-alpine

# Install ekstensi sistem yang dibutuhkan Laravel
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
    intl

WORKDIR /var/www/html

# Salin konfigurasi PHP kustom jika ada (opsional)
# COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Salin folder vendor dari tahap 1
COPY --from=vendor /app/vendor/ ./vendor/

# Salin folder public (hasil build aset) dari tahap 2
COPY --from=frontend /app/public/ ./public/

# Salin sisa kode aplikasi
COPY . .

# Berikan hak akses kepada user www-data (standar PHP-FPM)
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Ekspos port 9000 untuk PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]