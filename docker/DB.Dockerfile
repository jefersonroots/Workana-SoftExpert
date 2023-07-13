# Imagem base
FROM mcr.microsoft.com/mssql/server:2019-latest

# Variáveis de ambiente para configurar a instância do MSSQL
ENV ACCEPT_EULA=Y
ENV SA_PASSWORD=E8d#s46i
ENV MSSQL_PID=Developer
ENV MSSQL_TCP_PORT=1433

# Expor a porta do MSSQL
EXPOSE 1433

# Comando para iniciar o servidor do MSSQL
CMD ["/opt/mssql/bin/sqlservr"]
