<?php
//including file on the webpage
include_once 'PhpFunctions/php.php';
 include_once DATABASEFILE;
//defining  
    define("MAXLENGTHOFQUANTITY",99);
    define("MINLENGTHOFQUANTITY",1);
    define("LENGTHOFCOMMENTS",200);
    define("TAXRATE",15.2);

    //defining class for purchase 1
class purchase1 {
    //put your code here
    private $purchase_uuid = '';
    private $customer_uuid = '';
    private $product_uuid = '';
    private $quantity = 0;
    private $comments = '';
    private $subtotal = 0.0;
    private $tax = 0.0;
    private $grandtotal = 0.0;
    
   //defining function
    public function __construct($purchase_uuid = '', $customer_uuid = '', $product_uuid= '', $quantity = '', $comments = '', $subtotal = '', $tax = '', $grandtotal = '') 
    {
        $this->purchase_uuid = $purchase_uuid;
        $this->product_uuid = $product_uuid;
        $this->customer_uuid = $customer_uuid;
        $this->quantity = $quantity;
        $this->comments = $comments;
        $this->subtotal = $subtotal;
        $this->tax = $tax;
        $this->grandtotal = $grandtotal;
    }    
    
    //all get set functions
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
    function getProductUUID()
    {
        return $this->product_uuid;
    }    
    function setProductUUID($product_uuid)
    {
        $this->product_uuid = $product_uuid;
    }    
    function getSalePrice()
    {
        return $this->saleprice;
    }
       function getTax()
    {
        return $this->tax;
    }
    function setTax()
    {
        $this->tax = round($this->subtotal*TAX_RATE/100, 2);
    }
    
    function getGrandTotal()
    {
        return $this->grandtotal;
    }
    function setGrandTotal()
    {
        $this->grandtotal = round($this->subtotal + $this->tax,2);
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
                 if($quantity > MAXLENGTHOFQUANTITY)  
                {   
                    return "It does not have more than ".MAXLENGTHOFQUANTITY;
                }
                else if($quantity < MINLENGTHOFQUANTITY) 
                {
                        return "It does not have less than ".MINLENGTHOFQUANTITY;
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
        if(mb_strlen($comments) > LENGTHOFCOMMENTS)
        {
            return "Comments does not have more than ".LENGTHOFCOMMENTS;
        }
        else
        {
            $this->comments = $comments;
        }    
    }
    // function for load
     public function Load($purchase_uuid)
    {
        global $conn;
        $sqlQuery = "CALL purchase_load(:p_purchase_uuid)";        
        $PDO = $conn->prepare($sqlQuery);        
        $PDO->bindParam(':p_purchases_uuid', $purchase_uuid);        
        $PDO->execute();        
        if($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $this->purchase_uuid = $row['purchase_uuid'];
            $this->customer_uuid = $row['customer_uuid'];
            $this->product_uuid = $row['product_uuid'];
            $this->quantity = $row['quantity'];
            $this->comments = $row['comments'];
            $this->subtotal = $row['subtotal'];
            $this->tax = $row['tax'];
            $this->grandtotal = $row['grandtotal'];
            return true;
        }
        $PDO->closeCursor();
    }
    
    // function for save
    public function Save()
    {
        global $conn;
        if($this->purchase_uuid == '')
        {
            $sqlQuery = "CALL purchase_insert(:p_customer_uuid, :p_product_uuid, :p_quantity, :p_saleprice, :p_comments)";
            $PDO = $conn->prepare($sqlQuery);
            $PDO->bindParam(':p_customer_uuid', $this->customer_uuid);
            $PDO->bindParam(':p_product_uuid', $this->product_uuid);
            $PDO->bindParam(':p_quantity', $this->quantity);
            $PDO->bindParam(':p_comments', $this->comments);
            $PDO->bindParam(':p_subtotal', $this->subtotal);
            $PDO->bindParam(':p_tax', $this->tax);
            $PDO->bindParam(':p_grandtotal', $this->grandtotal);
            
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
            $sqlQuery = "CALL purchase_update(:p_purchases_uuid, :p_customer_uuid, :p_product_uuid, :p_quantity,:p_comments,:p_subtotal, :p_tax, :p_grandtotal)";    
            $PDO = $conn->prepare($sqlQuery);
            $PDO->bindParam(':p_purchases_uuid', $this->purchase_uuid);
            $PDO->bindParam(':p_customer_uuid', $this->customer_uuid);
            $PDO->bindParam(':p_product_uuid', $this->product_uuid);
            $PDO->bindParam(':p_quantity', $this->quantity);
            $PDO->bindParam(':p_comments', $this->comments);
            $PDO->bindParam(':p_subtotal', $this->subtotal);
            $PDO->bindParam(':p_tax', $this->tax);
            $PDO->bindParam(':p_grandtotal', $this->grandtotal);
            $PDO->execute(); 
            
        $PDO->closeCursor();
            return true;
        }
    }
//delete function
      public function Delete($purchaseUUID)
    {
        global $conn;        
        $sqlQuery = "CALL purchase_delete(:p_purchase_uuid)";        
        $PDO = $conn->prepare($sqlQuery);
        $PDO->bindParam(':p_customer_uuid', $purchaseUUID);        
        $PDO->execute();
        return true;
        $PDO->closeCursor();
        }
}
