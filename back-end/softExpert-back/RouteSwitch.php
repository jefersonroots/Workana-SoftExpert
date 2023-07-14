<?php

require_once 'app/Controllers/ProductController.php';
require_once 'app/Controllers/TypeProductController.php';

class RouteSwitch
{
    private $productsController;
    private $typeController;

    public function __construct()
    {
        $this->productsController = new ProductController();
        $this->typeController = new TypeProductController();
    }

    public function products()
    {
        $return = $this->productsController->index();

        return json_encode($return);
    }
    public function createProducts($request)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $request;

            $return = $this->productsController->create($data);
    
            return json_encode($return);
        } else {
            http_response_code(405); 
        }
    }
    public function Types()
    {

        $return = $this->typeController->index();

        return json_encode($return);
    }
    public function createTypeProducts($request)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $request;
            $return = $this->typeController->create($data);

            return json_encode($return);
        } else {
            http_response_code(405);
        }
    }
    public function saveBuy($request)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $request;
            $return = $this->productsController->saveBuy($data);

            return json_encode($return);
        } else {
            http_response_code(405);
        }
    }
    public function sellingList()
    {

        $return = $this->productsController->sellingList();

        return json_encode($return);
    }

    
    public function __call($name, $arguments)
    {
        echo "WELCOME MY API";
        // http_response_code(404);
        // require __DIR__ . '/pages/not-found.html';
    }
}
