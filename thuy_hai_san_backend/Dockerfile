# Sử dụng PHP 8.2 FPM
FROM php:8.2-fpm

# Cài đặt các thư viện hệ thống và extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip libzip-dev unzip git curl \
    && docker-php-ext-install pdo_mysql gd zip

# Cài đặt Composer từ image chính thức
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy mã nguồn vào container
COPY . .

# Cấp quyền cho các thư mục quan trọng của Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000

# Chạy server nội bộ của Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]