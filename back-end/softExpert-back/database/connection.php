<?php

 function getConnection(){
$serverName = "localhost"; 
$database = "MarketDB"; 
$username = "admin";
$password = "admin"; 


try {
    $dsn = "sqlsrv:Server=$serverName;Database=$database";
    $conn = new PDO($dsn, $username, $password);

    return $conn;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());

}}
