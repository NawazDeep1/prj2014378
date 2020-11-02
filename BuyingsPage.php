<?php
    include_once 'PhpFunctions/php.php';
    pageHeader("Buy");
    Menu();
    
    //defining constants
    define("LENGHTOFPRODUCTID",10);
    define("LENGHTOFFIRSTNAME",20);
    define("LENGHTOFLASTNAME",20);
    define("LENGHTOFCITY",8);
    define("LENGHTOFCOMMENTS",200);
    define("MAXPRICE",10000);
    define("MAXQUANTITY",99);
    define("MINQUANTITY",1);
    
   //declare variables
    $productid= "";
    $fname = "";
    $lname = "";
    $city = "";
    $comment = "";
    $price = "";
    $quantity = "";
    
    //declaring error message variable
    $productIdErrorMsg = "";
    $fnameErrorMsg = "";
    $lameErrorMsg = "";
    $cityErrorMsg = "";
    $commentErrorMsg = "";
    $priceErrorMsg = "";
    $quantityErrorMsg = "";
    
    if(isset($_POST["submit"]))
    {
        $productid = htmlspecialchars($_POST["productid"]);
        $fname = htmlspecialchars($_POST["fname"]);
        $lname = htmlspecialchars($_POST["lname"]);
        $city = htmlspecialchars($_POST["city"]);     
        $comment = htmlspecialchars($_POST["comment"]);
        $price = htmlspecialchars($_POST["price"]);
        $quantity = htmlspecialchars($_POST["quantity"]);
        
        #Validation of all the things

        if(mb_strlen($productid) > LENGHTOFPRODUCTID)
        {
            $productIdErrorMsg = "ProductID should not be more than ".LENGHTOFPRODUCTID." characters ";
        }
        else if(mb_strlen($productid) == 0)
        {
            $productIdErrorMsg = "Cannot be empty";
        }
        else if(stripos($productid,"p") === false || stripos($productid, "P ")!=0)
        {
            $productIdErrorMsg = "ID must begin with p or P";
        }
        
        if(mb_strlen($fname) > LENGHTOFFIRSTNAME)
        {
            $fnameErrorMsg = "First Name Should not be more than ".LENGHTOFFIRSTNAME." characters";
        }
        else if(mb_strlen($fname) == 0)
        {
            $fnameErrorMsg = "Cannot be empty";
        }
        

        if(mb_strlen($lname) > LENGHTOFLASTNAME)
        {
            $lameErrorMsg = "Last Name Should not be more than ".LENGHTOFLASTNAME." characters";
        }
        else if(mb_strlen($lname) == 0)
        {
            $lameErrorMsg = "Cannot be empty";
        }
        
        if(mb_strlen($city) > LENGHTOFCITY)
        {
            $cityErrorMsg = "City Should not be more than ".LENGHTOFCITY." characters";
        }
        else if(mb_strlen($city) == 0)
        {
            $cityErrorMsg = "City cannot be empty";
        }
        
        if(mb_strlen($comment) > LENGHTOFCOMMENTS)
        {
            $commentErrorMsg = "Comment Should not be more than ".LENGHTOFCOMMENTS." characters";
        }
        
        if(is_numeric($price))
        {
            if($price > MAXPRICE)
            {
                $priceErrorMsg = "Price Should not be more than $".MAXPRICE;
            }
            else if($price < 0)
            {
                $priceErrorMsg = "Price Should not be Negative";
            }
        }
        else if($price == "")
        {
            $priceErrorMsg = "Price Should not be Empty";
        }
        else
        {
            $priceErrorMsg = "Price is not Numeric";
        }
        
        if(strpos($quantity,".") == false)
        {
            if(is_numeric($quantity) && !is_float($quantity))
            {
                if($quantity > MAXQUANTITY)
                {
                    $quantityErrorMsg = "Quantity Should not be more than ".QUANTITY_MAX_VALUE;
                }
                else if($quantity < MINQUANTITY)
                {
                    $quantityErrorMsg = "Quantity Should not be less than ".QUANTITY_MIN_VALUE;
                }
            }
            else if($quantity == "")
            {
                $quantityErrorMsg = "Quantity Should not be Empty";
            }
            
        }
        else
        {
            $quantityErrorMsg = "Decimals are not allowed";
        }
        
        if($productIdErrorMsg =="" && $fnameErrorMsg=="" && $lameErrorMsg=="" && $cityErrorMsg=="" && $commentErrorMsg=="" && $priceErrorMsg=="" && $quantityErrorMsg=="")
        {
             $subtotal = $price * $quantity;
            $taxes = $subtotal * 12.05/100; // calculating taxes
            $grandTotal = $subtotal + $taxes;
            $purchase = array($productid, $fname, $lname, $city, $comment, $price, $quantity, $subtotal, $taxes, $grandTotal);
            file_put_contents(TXTFILE, json_encode($purchase)."\r\n",FILE_APPEND);
                        // clearing variables
            $productid="";
            $fname = "";
            $lname = "";
            $city ="";
            $comment = "";
            $price = "";
            $quantity = "";
        }
    }
    
    ?>



<div class="buy">
<h1>Please fill the Following :</h1>
<h3 class="req">* = required</h3>
</div>
<!--<form action="<?php echo MAIN;?>" method="POST">-->
<form method="POST">
            <p>
                <label>Product ID<span class="req">*</span>:  </label>
                <input type="text" placeholder="ID" name="productid" value="<?php echo $productid; ?>"/> <span class="req"><?php echo $productIdErrorMsg;?></span>
            </p>
            <p>
                <label>First Name<span class="req">*</span>:  </label>
                <input type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?>"/> <span class="req"><?php echo $fnameErrorMsg;?></span>
            </p>
            <p>
                <label>Last Name<span class="req">*</span>:  </label>
                <input type="text" placeholder="Last Name" name="lname" value="<?php echo $lname;?>"/> <span class="req"><?php echo $lameErrorMsg;?></span>
            </p>   
            <p>
                <label>City Name<span class="req">*</span>:  </label>
                <input type="text" placeholder="City Name" name="city" value="<?php echo $city;?>"/> <span class="req"><?php echo $cityErrorMsg;?></span>
            </p> 
            <p>
                <label>Comments:</label>
                <input type="text" placeholder="Comments" name="comment" value="<?php echo $comment;?>"/> <span class="req"><?php echo $commentErrorMsg;?></span>
            </p>
            <p>
                <label>Price<span class="req">*</span>: $ </label>
                <input type="text" placeholder="Price" name="price" value="<?php echo $price; ?>"/> <span class="req"><?php echo $priceErrorMsg;?></span> 
            </p> 
            <p>
                <label>Quantity<span class="req">*</span>:  </label>
                <input type="text" placeholder="Quantity" name="quantity" value="<?php echo $quantity;?>"/> <span class="req"><?php echo $quantityErrorMsg;?></span>
            </p>
            <p>
                <input type="submit" value="save info" name="submit"/>
                <input type="reset" value="clear data"/>
            </p>
</form>
<?php
    Footer();
?>

