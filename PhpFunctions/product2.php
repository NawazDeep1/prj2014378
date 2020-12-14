<?php
//including file on the webpage
include_once 'PhpFunctions/php.php';
include_once DATABASEFILE;
include_once COLLECTIONCLASS;
include_once CLASSPRODUCT1;

class product2 extends Collection{
    //put your code here
     function __construct()
    {
        global $conn; //databse connection
        $sqlQuery = "CALL products_select()";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->execute();  
        while($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $product = new product($row['productcode'], $row['description'], $row['price'], $row['costprice']);
            $this->add($row['productcode'], $product);
        }
        
        $PDO->closeCursor();
    }
}
