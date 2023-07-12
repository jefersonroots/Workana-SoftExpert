<?php
   
   require_once __DIR__ . '/../../database/connection.php';


class ProductController
{
    public function index()
    {
        
        $conn = getConnection(); 

        $query = "SELECT P.*, PT.Name as typeName
                  FROM Products P
                  JOIN ProductTypes PT ON P.TypeID = PT.TypeID";
        $stmt = $conn->query($query);

        $products = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = array(
                'id' => $row['ProductID'],
                'name' => $row['Name'],
                'typeName' =>$row['typeName']
            );
            $products[] = $product;
        }
      

      
        echo json_encode($products);
    }

    public function create($request)
    {
        
        $price = $request['price'];
        $typeID = 1;//$request['typeID'];
    
        // Obter a conexão com o banco de dados
        $conn = getConnection();
    
       
         
            // Preparar a instrução SQL de inserção
            $query = "INSERT INTO Products (Name, Price, TypeID) VALUES (?,?,?)";
  
            $conn->prepare($query)->execute([$request['name'],$typeID,$price]);

            return 'Cadastrado';
    }
}

?>