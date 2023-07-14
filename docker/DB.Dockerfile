# Imagem base
FROM mcr.microsoft.com/mssql/server:2019-latest

ENV ACCEPT_EULA=Y
ENV SA_PASSWORD=E8ds46i1
ENV MSSQL_PID=Developer
ENV MSSQL_TCP_PORT=1433
ENV SERVER_NAME=DBMarket

ENV DB_NAME=MarketDB
EXPOSE 1433


COPY docker/script.sql /script.sql


COPY docker/entrypoint.sh /entrypoint.sh


USER root
RUN chown root:root /entrypoint.sh


RUN chmod +x /entrypoint.sh


USER mssql

CMD /entrypoint.sh
