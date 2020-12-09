<?php

require_once ('DatabaseConnection.php');
require_once ('Collection.php');
require_once ('purchase1.php');

class purchase2 extends Collection {
    //put your code here

      function __construct($SearchedDate, $customer_uuid)
    {
        global $conn;
        $sqlQuery = "CALL purchases_filter(:p_searcheddate, :p_customer_uuid)";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->bindParam(':p_searcheddate', $SearchedDate);
        $PDO->bindParam(':p_customer_uuid', $customer_uuid);
        $PDO->execute();
        while($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $purchase = new purchase($row['purchase_uuid'],$row['productcode'], $row['quantity'], $row['saleprice'], $row['comments']);
            $this->add($row['purchase_uuid'], $purchase);
        }
    }
}
