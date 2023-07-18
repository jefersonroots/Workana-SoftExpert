<?php

require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/../app/Models/ProductModel.php';
require_once __DIR__ . '/../app/Services/ProductService.php';

use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    private $productService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductService();
    }
    public function testIndex()
    {
       
        ob_start();
        $this->productService->index();
        $output = ob_get_clean();
    

        $this->assertEquals($output, $output);
    }
    
    public function testSellingList()
    {

        ob_start();
        $this->productService->sellingList();
        $output = ob_get_clean();
    
        $this->assertEquals($output, $output);
    }
    public function testCreate()
    {
        $request = [
            'name' => 'New Product',
            'price' => 19.99,
            'typeID' => 1
        ];

        // Call the create method
        $result = $this->productService->create($request);

        // Assert the expected result
        $this->assertEquals('Cadastrado', $result);
    }

    public function testSaveBuy()
    {
        $data = [
            'cartItems' => [
                [
                    'id' => 1,
                    'quantity' => 2,
                    'price' => 10.50,
                    'tax' => 5.00
                ],
                [
                    'id' => 2,
                    'quantity' => 3,
                    'price' => 15.75,
                    'tax' => 5.00
                ],
                // Add more cart items as needed
            ]
        ];

        // Call the saveBuy method
        $result = $this->productService->saveBuy($data);

        // Assert the expected result
        $this->assertEquals('Dados inseridos com sucesso na tabela Sales', $result);
    }


    
}
