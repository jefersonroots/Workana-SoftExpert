<?php
   
   require_once __DIR__ . '/../../database/connection.php';


class ProductController
{
    public function index()
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
                'typeName' =>$row['typeName'],
                'tax' => $row['TaxPercentage'], 
                'price' => $row['Price']
            );
            $products[] = $product;
        }
      

      
        echo json_encode($products);
    }

    public function create($request)
    {
        
        $price = $request['price'];
        $typeID = $request['typeID'];
    
        // Obter a conexão com o banco de dados
        $conn = getConnection();
    
       
         
            // Preparar a instrução SQL de inserção
            $query = "INSERT INTO Products (Name, Price, TypeID) VALUES (?,?,?)";
  
            $conn->prepare($query)->execute([$request['name'],$typeID,$price]);

            return 'Cadastrado';
    }
    function saveBuy($data)
    {
        // Obter a conexão com o banco de dados
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
    
    public function sellingList()
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
                'quantity' =>$row['Quantity'],
                'itemTotalValue' => $row['ItemTotalValue'], 
                'itemTaxValue' => $row['ItemTaxValue']
            );
            $products[] = $product;
        }
      

      
        echo json_encode($products);
    }
}

?>