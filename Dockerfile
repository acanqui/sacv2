FROM php:7.4-apache

# 1. Ajustar repositorios archive para Debian Buster
RUN rm -rf /etc/apt/sources.list.d/* \
    && echo "deb http://archive.debian.org/debian buster main" > /etc/apt/sources.list \
    && echo "deb http://archive.debian.org/debian-security buster/updates main" >> /etc/apt/sources.list \
    && echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until

# 2. Instalar dependencias alineando las versiones conflictivas mediante --allow-downgrades
RUN apt-get update && apt-get install -y --no-install-recommends --allow-downgrades \
    libbz2-1.0=1.0.6-9.2~deb10u2 \
    libonig5=6.9.1-1 \
    zlib1g=1:1.2.11.dfsg-1+deb10u2 \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    libbz2-dev \
    libonig-dev \
    gettext \
    libgettextpo-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# 3. Configurar e instalar extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        bz2 \
        calendar \
        exif \
        gd \
        gettext \
        intl \
        mbstring \
        mysqli \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        sockets \
        zip \
        opcache

# 4. Habilitar mod_rewrite de Apache para Yii2
RUN a2enmod rewrite

# 5. Copiar la configuración personalizada de Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# 6. Directorio de trabajo
WORKDIR /var/www/html