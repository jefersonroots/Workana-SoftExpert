<?php

require_once __DIR__ . '/RouteSwitch.php';

class Router extends RouteSwitch
{
    public function run(string $requestUri)
    {
        $route = substr($requestUri, 1);

        if ($route === '') {
    
            // Verificar se a solicitação é um POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Acessar os dados enviados pelo front-end
                $data = json_decode(file_get_contents('php://input'), true);

                // Chamar a função passando os dados
                $this->product($data);
            } else {
                $this->product();
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Acessar os dados enviados pelo front-end
                $data = json_decode(file_get_contents('php://input'), true);

                // Chamar a função passando os dados
                $this->$route($data);
            } else {
                $this->$route();
            }
        }
    }
}
