<?php
 include_once 'PHP Functions/PHPFunctions.php';
    include_once CLASSPRODUCT1;
    include_once CLASSPRODUCT2;
    include_once CLASSPURCHASE1;
    pageHeader("New Buy", "");
    Menu();
    sessionStart();
    $comments = '';
    $productCode = '';
    $commentsErrorMsg = '';
    $quantity = '';
    $quantityErrorMsg = '';
 
if(isset($_SESSION['user']))
    {
        $products = new product2();
        $purchase = new purchase1();
        echo $products->count();
        if(isset($_POST['submit']))
        {
            $productCode = $_POST['productCode'];
            $comments = htmlspecialchars($_POST['comments']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $commentsErrorMsg = $purchase->setComments($comments);
            $quantityErrorMsg = $purchase->setQuantity($quantity);
            if($commentsErrorMsg == '' && $quantityErrorMsg == '')
            {
                foreach($products->items as $product)
                {
                    if($product->getProductCode() == $productCode)
                    {
                        $purchase->setSalePrice($product->getPrice());
                        echo $purchase->getSalePrice();
                    }
                }
                $purchase->setProductCode($productCode);
                $purchase->setCustomerUUID($_SESSION['user']);
                
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
        ?><h3 style="text-align: center">Login</h3><?php
                Footer();
        die();
    }
?>
<form method="POST">
    <p>
        <label>Product Code:</label>
        <select name="productCode">
        <?php
        foreach($products->items as $product)
        {
            ?><option value="<?php echo $product->getProductCode(); ?>"><?php echo $product->getProductCode()." - ".$product->getDescription();?></option>
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
        <label>Quantity<span class="required">*</span>:  </label>
        <input type="text" name="quantity" value="<?php echo $quantity;?>"/> <span class="validation"><?php echo $quantityErrorMessage;?></span>
    </p>
    <p>
        <input type="submit" value="Buy" name="submit" class="button"/>
    </p>
</form>
<?php
Footer();
?>
    
   