<?php

require_once __DIR__ . '/Router.php';

$requestUri = $_SERVER['REQUEST_URI'];
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$router = new Router;
$router->run($requestUri);