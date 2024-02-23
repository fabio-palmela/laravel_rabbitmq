FROM php:8.2-fpm

# Instale a extensão de sockets
# RUN apt-get update && \
#     apt-get install -y \
#     libzip-dev \
#     unzip && \
#     libssl-dev \
#     libcurl4-openssl-dev && \
#     docker-php-ext-install sockets zip curl

# RUN docker-php-ext-install ftp
ENV DOCKERIZE_VERSION v0.6.1

RUN apt-get update && \
    apt-get install -y wget && \
    wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    apt-get remove -y wget && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    libssl-dev \
    libcurl4-openssl-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Instale as extensões PHP
RUN docker-php-ext-install sockets zip curl ftp

# Instale o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html

COPY . /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN composer install --no-scripts

CMD ["dockerize", "-wait", "tcp://rabbitmq:5672", "--", "php", "artisan", "app:calcular"]