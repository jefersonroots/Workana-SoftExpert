#!/bin/bash

# Inicializa o servidor SQL
/opt/mssql/bin/sqlservr &

# Aguarda o servidor SQL ficar disponível
sleep 20

# Executa o script SQL
/opt/mssql-tools/bin/sqlcmd -S localhost -U sa -P E8ds46i1 -d master -i /script.sql

# Mantém o contêiner em execução
tail -f /dev/null
