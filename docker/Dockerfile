# Imagem base
FROM php:latest

# Diretório de trabalho dentro do container
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o diretório de trabalho
COPY . /var/www/html

# Expor a porta do servidor web (por exemplo, o Apache)
EXPOSE 8080

# Comando para iniciar o servidor web do PHP
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html"]
