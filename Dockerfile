FROM php:8.2-apache

# Instalar extensiones y herramientas
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    netcat-openbsd \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite

# Definir directorio de trabajo
WORKDIR /var/www

# Copiar proyecto
COPY ./mini-framework /var/www

# Copiar script para esperar DB
COPY wait-for-db.sh /usr/local/bin/wait-for-db.sh
RUN chmod +x /usr/local/bin/wait-for-db.sh

# Ajustar permisos
RUN chown -R www-data:www-data /var/www

# Configurar Apache para servir "public"
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/public|g' /etc/apache2/sites-available/000-default.conf

# Instalar Composer dentro del contenedor y dependencias
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --working-dir=/var/www

# Comando por defecto
CMD ["/usr/local/bin/wait-for-db.sh", "db", "3306", "--", "/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
