# Primero descargamos la imagen 8.4 de PHP
FROM php:8.4-apache
#Instalamos dependencias que puede llegar a ocupar el sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Se tiene que limpiar la cache para que todo se instale limpio, seguro y bajo sus condiciones
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalamos extensiones para que php se pueda conectar con MySQL
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalamos composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuramos Apache para que pueda trabajar con Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf
RUN sed -ri -e "s!/var/www/!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilitamos esto para que no vayan a dar algun error las rutas
RUN a2enmod rewrite

# Creamos el espacio de trabajo
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

# Instalar Node.js y NPM para poder compilar Jetstream/Tailwind
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# AJUSTES PARA DESPLEGAR EN PRODUCCIÓN
# 1. Copiar todo el código del proyecto al directorio de trabajo
COPY . /var/www/html

# 2. Instalar las dependencias de Composer sin interacción
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-interaction --optimize-autoloader

# 3. Darle los permisos correctos a las carpetas de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias de Node y compilar los assets (Tailwind/Vite)
RUN npm install && npm run build

# Obligar a Apache a escuchar en el puerto dinámico de Railway
CMD sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf && sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/g" /etc/apache2/sites-available/*.conf && php artisan migrate --force && apache2-foreground
