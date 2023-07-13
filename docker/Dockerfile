# Imagem base
FROM php:latest

# Diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o diretório de trabalho
COPY ../back-end/softExpert-back /var/www/html

# Instalar e habilitar a extensão mssql
RUN apt-get update && apt-get install -y \
    freetds-bin \
    freetds-dev \
    && docker-php-ext-install pdo_dblib

# Expor a porta do servidor web (por exemplo, o Apache)
EXPOSE 80

# Comando para iniciar o servidor web do PHP
CMD ["php", "-S", "0.0.0.0:80"]
