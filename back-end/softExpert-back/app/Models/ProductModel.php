<?php

require_once __DIR__ . '/../../database/connection.php';

class ProductModel
{
    public function getAllProducts()
    {
        $conn = getConnection();

        $query = "SELECT P.*, PT.Name as typeName , PT.TaxPercentage as TaxPercentage
                  FROM Products P
                  JOIN ProductTypes PT ON P.TypeID = PT.TypeID";
        $stmt = $conn->query($query);

        $products = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = array(
                'id' => $row['ProductID'],
                'name' => $row['Name'],
                'typeName' => $row['typeName'],
                'tax' => $row['TaxPercentage'],
                'price' => $row['Price']
            );
            $products[] = $product;
        }

        return $products;
    }

    public function createProduct($name, $price, $typeID)
    {
        $conn = getConnection();

        $query = "INSERT INTO Products (Name, Price, TypeID) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$name, $price, $typeID]);

        return $stmt->rowCount() > 0;
    }

    public function saveBuy($data)
    {
        $conn = getConnection();

        $insertStatement = "INSERT INTO Sales (ProductID, Quantity, ItemTotalValue, ItemTaxValue) VALUES ";

        $values = [];
        foreach ($data['cartItems'] as $item) {
            if (isset($item['id'], $item['quantity'], $item['price'], $item['tax'])) {
                $productID = $item['id'];
                $quantity = $item['quantity'];
                $itemTotalValue = $item['price'] * $item['quantity'];
                $itemTaxValue = $item['tax'] * $item['quantity'];

                $values[] = "($productID, $quantity, $itemTotalValue, $itemTaxValue)";
            }
        }

        if (count($values) > 0) {
            $insertStatement .= implode(", ", $values);

            // Executar a inserção na tabela Sales
            $conn->exec($insertStatement);

            return 'Dados inseridos com sucesso na tabela Sales';
        } else {
            return 'Nenhum dado válido para inserção na tabela Sales';
        }
    }

    public function getSellingList()
    {
        $conn = getConnection();

        $query = "SELECT S.SalesID, S.ProductID, P.Name AS ProductName, S.Quantity, S.ItemTotalValue, S.ItemTaxValue
        FROM Sales S
        JOIN Products P ON S.ProductID = P.ProductID;";
        $stmt = $conn->query($query);

        $products = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = array(
                'id' => $row['SalesID'],
                'ProductID' => $row['ProductID'],
                'ProductName' => $row['ProductName'],
                'quantity' => $row['Quantity'],
                'itemTotalValue' => $row['ItemTotalValue'],
                'itemTaxValue' => $row['ItemTaxValue']
            );
            $products[] = $product;
        }

        return $products;
    }
}
