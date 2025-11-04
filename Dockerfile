# Imagen base con Apache y PHP
FROM php:8.2-apache

# Instalamos extensiones necesarias para conectar con MariaDB
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activamos mod_rewrite (útil para frameworks propios)
RUN a2enmod rewrite

# Definimos el directorio de trabajo
WORKDIR /var/www/html

# Damos permisos adecuados al proyecto
RUN chown -R www-data:www-data /var/www/html

# Exponemos el puerto 80
EXPOSE 80

