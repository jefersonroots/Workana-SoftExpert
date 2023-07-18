<?php

require_once __DIR__ . '/../../database/connection.php';
require_once __DIR__ .'../../Services/ProductService.php';

class ProductController
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $products = $this->productService->index();
        print_r($products);
    }

    public function create($request)
    {
       ;

        $result = $this->productService->create($request);

        print_r($result);
    }

    public function saveBuy($data)
    {
        $result = $this->productService->saveBuy($data);

        print_r($result);
    }

    public function sellingList()
    {
        $sales = $this->productService->sellingList();
        print_r($sales);
    }
}

?>
