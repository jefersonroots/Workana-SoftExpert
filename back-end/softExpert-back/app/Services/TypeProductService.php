<?php

require_once __DIR__ . '/../../database/connection.php';
require_once __DIR__ . '/../models/TypeProductModel.php';

class TypeProductService
{
    private $typeProductModel;

    public function __construct()
    {
        $this->typeProductModel = new TypeProductModel();
    }

    public function index()
    {
        $types = $this->typeProductModel->getAllTypes();
        echo json_encode($types);
    }

    public function create($request)
    {
        $name = $request['name'];
        $tax = $request['tax'];

        return $this->typeProductModel->createType($name, $tax);
    }
}
