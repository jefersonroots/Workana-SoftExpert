<?php

require_once __DIR__ . '/../../database/connection.php';

class TypeProductModel
{
    public function getAllTypes()
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

        return $types;
    }

    public function createType($name, $tax)
    {
        $conn = getConnection();

        $query = "INSERT INTO ProductTypes (Name, TaxPercentage) VALUES (?, ?)";
        $stmt = $conn->prepare($query);

        return $stmt->execute([$name, $tax]);
    }
}
