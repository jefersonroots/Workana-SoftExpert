<?php

require_once __DIR__ . '/../../database/connection.php';


class TypeProductController
{
    public function index()
    {

        $conn = getConnection();

        $query = "SELECT * FROM ProductTypes";
        $stmt = $conn->query($query);

        $types = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $type = array(
                'id' => $row['TypeID'],
                'name' => $row['Name'],
                'tax' => $row['TaxPercentage'],                
            );
            $types[] = $type;
        }



        echo json_encode($types);
    }

    public function create($request)
    {

  
        $tax = $request['tax'];
        $conn = getConnection();

        $query = "INSERT INTO ProductTypes (Name, TaxPercentage) VALUES (?,?)";

        return $conn->prepare($query)->execute([$request['name'], $tax]);

       
    }
}
