<?php
//including file on the webpage
include_once 'PhpFunctions/php.php';
    include_once CLASSPRODUCT1;
    include_once CLASSPRODUCT2;
    include_once CLASSPURCHASE1;
    
    pageHeader("Buy"); // header show on the top
    Menu(); //menu fucntion show on the top
//to start the session
    session_start();
    //delaring variables
    $comments = '';
    $productUUID = '';
    $commentsErrorMsg = '';
    $quantity = '';
    $quantityErrorMsg = '';
 
if(isset($_SESSION['admin']))
    {
        $products = new product2();
        $purchase = new purchase1();
        echo $products->count();
        if(isset($_POST['submit']))
        {
            $productUUID = $_POST['productUUID'];
            $comments = htmlspecialchars($_POST['comments']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $commentsErrorMsg = $purchase->setComments($comments);
            $quantityErrorMsg = $purchase->setQuantity($quantity);
            if($commentsErrorMsg == '' && $quantityErrorMsg == '')
            {
                foreach($products->items as $product)
                {
                    if($product->getProductUUID() == $productUUID)
                    {
                        $purchase->setSalePrice($product->getPrice());
                         $purchase->setTax();
                        $purchase->setGrandTotal();
                    }
                }
                $purchase->setProductUUID($productUUID);
                $purchase->setCustomerUUID($_SESSION['admin']);
                
                if($purchase->Save())
                {
                    $comments = '';
                    $quantity = '';
                    echo "finsh";
                }
                else
                {
                    echo "Error in working";
                }
            }
        }
    }
    else
    {
        SignIn();//sign in function
         Footer();//footer function
        die();
    }
?>
<h3 class="req">* = Mandatory</h3>

<form method="POST">
    <p>
        <label>Product UUID:<span class="req">*</span></label>
        <select name="productUUID">
        <?php
        foreach($products->items as $product)
        {
            ?><option value="<?php echo $product->getProductUUID(); ?>"><?php echo $product->getProductUUID()." - ".$product->getDescription();?></option>
        <?php
        }
        ?>
        </select>
    </p>
    <p>
        <label>Comments:</label>
        <input type="text" name="comments" value="<?php echo $comments;?>"/> <span class="validation"><?php echo $commentsErrorMessage;?></span>
    </p>
    <p>
        <label>Quantity<span class="req">*</span>:  </label>
        <input type="text" name="quantity" value="<?php echo $quantity;?>"/> <span class="validation"><?php echo $quantityErrorMessage;?></span>
    </p>
    <p>
        <input type="submit" value="Buy" name="submit" class="button"/>
    </p>
</form>
<?php
    SignOut();//signout function
Footer();// footer function
?>
    
   