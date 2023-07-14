
FROM php:latest

WORKDIR /var/www/html


COPY ../back-end/softExpert-back /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN apt-get update && apt-get install -y gnupg2 \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools \
    && apt-get install -y unixodbc-dev \
    && pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80"]
