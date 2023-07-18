<?php

require_once __DIR__ . '/../../database/connection.php';
require_once __DIR__ . '../../Models/ProductModel.php';

class ProductService
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $products = $this->productModel->getAllProducts();

        echo json_encode($products);
    }

    public function create($request)
    {
        $name = $request['name'];
        $price = $request['price'];
        $typeID = $request['typeID'];

        $result = $this->productModel->createProduct($name, $price, $typeID);

        if ($result) {
            return 'Cadastrado';
        } else {
            return 'Erro ao cadastrar o produto';
        }
    }

    public function saveBuy($data)
    {
        $result = $this->productModel->saveBuy($data);

        return $result;
    }

    public function sellingList()
    {
        $products = $this->productModel->getSellingList();

        echo json_encode($products);
    }
}
