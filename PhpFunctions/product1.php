<?php
//including file on the webpage
include_once 'PhpFunctions/php.php';
include_once DATABASEFILE;

//defining variables
define("LENGTHOFPRODUCTCODE",20);
define("LENGTHOFDESCRIPTION",100);

//class product
class product1 {
    private $product_uuid = '';
    private $productcode = '';
    private $description = '';
    private $price = 0.0;
    private $costprice = 0.0;
    
public function __construct($product_uuid= '',$productcode='', $description = '', $price = '', $costprice = '') {
 
            $this->product_uuid = $product_uuid;
            $this->productcode = $productcode;
            $this->description = $description;
            $this->price = $price;
            $this->costprice = $costprice;
    }
    function getProductUUID()
    {
        return $this->product_uuid;
    }
    function setProductUUID($newProduct_uuid)
    {
        $this->product_uuid = $newProduct_uuid;
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
    //function for load
    public function Load($product_uuid)
    {
        global $conn; //database connection string
        $sqlQuery = "CALL product_load(:p_product_uuid)";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->bindParam(':p_product_uuid', $product_uuid);
        $PDO->execute();
        if($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $this->product_uuid = $row['product_uuid'];
            $this->productcode = $row['productcode'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->costprice = $row['costprice'];
            return true;
        }
        
        $PDO->closeCursor();
    }    
    //fucntion for save
    public function Save()
    {
        global $conn;//database connection string
        if($this->product_uuid == '')
        {
            $sqlQuery = "CALL product_insert(:p_product_code, :p_description, :p_price, :p_costprice)";
            $PDO = $conn->prepare($sqlQuery);
            $PDO->bindParam(':p_product_code', $this->product_code);
            $PDO->bindParam(':p_description', $this->description);
            $PDO->bindParam(':p_price', $this->price);
            $PDO->bindParam(':p_cost_price', $this->costprice);
            $affectedRows = $PDO->execute(); 
            if($affectedRows == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
            $PDO->closeCursor();
        }
        else
        {
            $sqlQuery = "CALL product_update(:p_product_uuid, :p_product_code, :p_description, :p_price, :p_costprice)";
            $PDO = $conn->prepare($sqlQuery);
            $PDO->bindParam(':p_product_uuid', $this->product_uuid);
            $PDO->bindParam(':p_product_code', $this->product_code);
            $PDO->bindParam(':p_description', $this->description);
            $PDO->bindParam(':p_price', $this->price);
            $PDO->bindParam(':p_cost_price', $this->costprice);
            $PDO->execute();   
            return true;
            $PDO->closeCursor();
        }
    }
    //delete function
    public function Delete()
    {
        global $conn; //database connection string
        $sqlQuery = "CALL product_delete(:p_product_uuid)";
        $PDO = $conn->prepare($sqlQuery);
        $PDO->bindParam(':product_uuid', $this->product_uuid);
        $affectedRows = $PDO->execute();
        $PDO->closeCursor();
        return $affectedRows;
    }
}