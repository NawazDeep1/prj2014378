<?php
require_once 'DatabaseConnection.php';

define("PRODUCTCODE_VALUE",20);
 define("DESCRIPTION_VALUE",100);

class product1 {
   private $productcode = '';
    private $description = '';
    private $price = 0.0;
    private $costprice = 0.0;
    
public function __construct($productcode='', $description = '', $price = '', $costprice = '') {
 
            $this->productcode = $productcode;
            $this->description = $description;
            $this->price = $price;
            $this->costprice = $costprice;
    }
    function getProductCode()
    {
        return $this->productcode;
    }
    function setProductCode($newProductCode)
    {
        $this->productcode = $newProductCode;
    }
    function getDescription()
    {
        return $this->description;
    }
    function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }
    function getPrice()
    {
        return $this->price;
    }
    function setPrice($newPrice)
    {
        $this->price = $newPrice;
    }    
    function getCostPrice()
    {
        return $this->costprice;
    }
    function setCostPrice($newCostPrice)
    {
        $this->costprice = $newCostPrice;
    }
    public function Load($productCode)
    {
        global $conn;
        $sqlQuery = "CALL product_load(:p_productcode)";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->bindParam(':p_productcode', $productCode);
        $PDO->execute();
        if($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $this->productcode = $row['productcode'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->costprice = $row['costprice'];
            return true;
        }
    }
    
}