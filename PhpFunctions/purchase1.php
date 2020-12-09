<?php
 include_once 'DatabaseConnection.php';
    define("MAXLENGHTOFQUANTITY",99);
    define("MINLENGHTOFQUANTITY",1);
    define("LENGHTOFCOMMENTS",200);

class purchase1 {
    //put your code here
    private $purchase_uuid = '';
    private $customer_uuid = '';
    private $productcode = '';
    private $quantity = 0;
    private $saleprice = 0.0;
    private $comments = '';
    public function __construct($purchase_uuid = '' ,$productcode = '', $quantity = '', $saleprice = '', $comments = '') {
        $this->purchase_uuid = $purchase_uuid;
        $this->productcode = $productcode;
        $this->quantity = $quantity;
        $this->saleprice = $saleprice;
        $this->comments = $comments;
    }    
    function getPurchaseUUID()
    {
        return $this->purchase_uuid;
    }    
    function getCustomerUUID()
    {
        return $this->customer_uuid;
    }    
    function setCustomerUUID($customer_uuid)
    {
        $this->customer_uuid = $customer_uuid;
    }    
    function getProductCode()
    {
        return $this->productcode;
    }    
    function setProductCode($productCode)
    {
        $this->productcode = $productCode;
    }    
    function getSalePrice()
    {
        return $this->saleprice;
    }
    function setSalePrice($price)
    {
        $this->saleprice = $this->quantity * $price;
    }
    
    function getQuantity()
    {
        return $this->quantity;
    }
    function setQuantity($quantity)
    {
        if(strpos($quantity,".") == false)
        {
            if(is_numeric($quantity) && !is_float($quantity)) 
            {
                 if($quantity > MAXLENGHTOFQUANTITY)  
                {   
                    return "It does not have more than ".MAXLENGHTOFQUANTITY;
                }
                else if($quantity < MINLENGHTOFQUANTITY) 
                {
                        return "It does not have less than ".MINLENGHTOFQUANTITY;
                }
            }
            else
            {
                return "Cannot be Empty";
            }
        }
        if(strpos($quantity, "."))    
        {
            return "Decimals are not allowed";
        }
        else 
        {
            $this->quantity = $quantity;
        }
    }
    function getComments()
    {
        return $this->comments;
    }
    function setComments($comments)
    {
        if(mb_strlen($comments) > LENGHTOFCOMMENTS)
        {
            return "Comments does not have more than ".LENGHTOFCOMMENTS;
        }
        else
        {
            $this->comments = $comments;
        }    
    }
    public function Save()
    {
        global $conn;
        if($this->purchase_uuid == '')
        {
            $sqlQuery = "CALL purchase_insert(:p_customer_uuid, :p_productcode, :p_quantity, :p_saleprice, :p_comments)";
            $PDO = $conn->prepare($sqlQuery);
            $PDO->bindParam(':p_customer_uuid', $this->customer_uuid);
            $PDO->bindParam(':p_productcode', $this->productcode);
            $PDO->bindParam(':p_quantity', $this->quantity);
            $PDO->bindParam(':p_saleprice', $this->saleprice);
            $PDO->bindParam(':p_comments', $this->comments);     
            $affectedRows = $PDO->execute(); 
            if($affectedRows == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $sqlQuery = "CALL purchase_update(:p_purchase_uuid, :p_customer_uuid, :p_productcode, :p_quantity, :p_saleprice, :p_comments)";    
            $PDO = $conn->prepare($sqlQuery);
            $PDO->bindParam(':p_purchase_uuid', $this->purchase_uuid);
            $PDO->bindParam(':p_customer_uuid', $this->customer_uuid);
            $PDO->bindParam(':p_productcode', $this->productcode);
            $PDO->bindParam(':p_quantity', $this->quantity);
            $PDO->bindParam(':p_saleprice', $this->saleprice);
            $PDO->bindParam(':p_comments', $this->comments);
            $PDO->execute();   
            return true;
        }
    }
}
