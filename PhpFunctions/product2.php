<?php
require_once ('DatabaseConnection.php');
require_once ('Collection.php');
require_once ('product1.php');

class product2 extends Collection{
    //put your code here
     function __construct()
    {
        global $conn;
        $sqlQuery = "CALL products_select()";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->execute();  
        while($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $product = new product($row['productcode'], $row['description'], $row['price'], $row['costprice']);
            $this->add($row['productcode'], $product);
        }
    }
}
