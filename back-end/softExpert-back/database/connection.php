<?php

 function getConnection(){
$serverName = "DESKTOP-D7S7L2B"; // Nome do servidor SQL Server
$database = "MarketDB"; // Nome do banco de dados
$username = "admin"; // Nome de usuário
$password = "admin"; // Senha


try {
    $dsn = "sqlsrv:Server=$serverName;Database=$database";
    $conn = new PDO($dsn, $username, $password);

    return $conn;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());

}}
