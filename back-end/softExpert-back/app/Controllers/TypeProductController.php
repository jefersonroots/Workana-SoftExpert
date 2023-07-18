<?php

require_once __DIR__ . '/../../database/connection.php';
require_once __DIR__ .'../../Services/TypeProductService.php';


class TypeProductController
{
    private $typeProductService;

    public function __construct()
    {
        $this->typeProductService = new TypeProductService();
    }

    public function index()
    {
        $types = $this->typeProductService->index();
        print_r($types);
      
    }

    public function create($request)
    {
        return $this->typeProductService->create($request);
  
    }
}
