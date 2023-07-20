# <p align="center"> Desafio PHP </p>

## Sobre o Projeto

  O SISTEMA DE CONTROLE DE PRODUTOS. 

   * > STATUS: Developing

### Tecnologias Utilizadas

<table>
    <tr>
        <td>PHP</td>
        <td>JavaScript</td>
        <td>Vue 3</td>
        <td>Vuetify</td>
        <td>MSSQL</td>
    </tr>
</table>

### Passos utilizados para "startar" o projeto USANDO DOCKER após um git clone
   *  Git clone [https://github.com/jefersonroots/Workana-SoftExpert.git]
   *  Abrir repositório;
   *  Na pasta docker rodar o comando: docker compose up -d
      - Ira criar containers de banco mssql e php
      - O banco e o dados base estão sendo criado juntos ao comando docker compose up
   *  Na pasta front-end/softExpert-front rodar o comando : npm install depois -> npm run dev;
   *  Comando para rodar o phpunit -> php vendor/bin/phpunit teste/ProductServiceTest.php;
  
### Passos utilizados para "startar" o projeto USANDO AMBIENTE LOCAl após um git clone
   *  Git clone [https://github.com/jefersonroots/Workana-SoftExpert.git]
   *  Abrir repositório;
   *  Na pasta docker, copie o documento sql e execute ele no SQL Server Management Studio;
   *  Na pasta front-end/softExpert-front rodar o comando : npm install depois -> npm run dev;
   *  Na pasta back-end/softExpert-back rodar o comando: composer install depois -> php -S localhost:8080;
   *  Comando para rodar o phpunit -> php vendor/bin/phpunit teste/ProductServiceTest.php;



* A inclusão do front-end no docker está em construção!

