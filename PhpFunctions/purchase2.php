<?php
//including file on the webpage
include_once 'PhpFunctions/php.php';
include_once DATABASEFILE;
include_once COLLECTIONCLASS;
include_once CLASSPURCHASE1;

//class purchase
class purchase2 extends Collection {
    //put your code here

  function __construct()
    {
        global $conn;//ddata base connection
        $sqlQuery = "CALL purchases_select()";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->execute();
        while($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $purchase = new purchase($row['purchase_uuid'], $row['customer_uuid'] ,$row['product_uuid'], $row['quantity'], $row['comments'], $row['subtotal'], $row['taxes'], $row['grandtotal']);
            $this->add($row['purchase_uuid'], $purchase);
        }
        $PDO->closeCursor();
    }    
  function filterPurchases($searchedDate, $customer_uuid)
    {
        global $conn;
        $sqlQuery = "CALL purchases_filter(:p_searched_date, :p_customer_uuid)";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->bindParam(':p_searched_date', $searchedDate);
        $PDO->bindParam(':p_customer_uuid', $customer_uuid);
        $PDO->execute();
        while($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $purchase = new purchase($row['purchase_uuid'],$customer_uuid ,$row['product_uuid'], $row['quantity'], $row['comments'], $row['subtotal'], $row['taxes'], $row['grandtotal']);
            $this->add($row['purchase_uuid'], $purchase);
        }
    }
}

