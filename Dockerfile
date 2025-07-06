FROM php:8.1-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos de dependencias PHP
COPY composer.json composer.lock ./

# Instalar dependencias de PHP (incluyendo dev para compilar assets)
RUN composer install --no-interaction

# Copiar archivos de Node.js
COPY package.json package-lock.json ./

# Instalar dependencias de Node.js
RUN npm ci

# Copiar el resto de la aplicación
COPY . .

# Compilar assets
RUN npm run production

# Limpiar dependencias de desarrollo después de compilar
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && rm -rf node_modules package*.json webpack.mix.js

# Configurar permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Exponer puerto
EXPOSE 9000

CMD ["php-fpm"] 