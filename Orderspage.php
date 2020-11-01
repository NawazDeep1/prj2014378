<?php
    include_once 'PhpFunctions/php.php';
    pageHeader("Home");
   Menu();
    ?>
<h1></h1>
<div class="OrdersContainer">
    <table class="tblOrders" border="1">
    <tr>
        <th>Product ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>City</th>
        <th>Comments</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Taxes</th>
        <th>Grand Total</th>
    </tr>
    <?php
        $handle = fopen(PURCHASES_FILE, "r");
        while(!feof($handle))
        {
            $purchasesString = fgets($handle);
            if(!empty($purchasesString))
            {
                $purchasesArray = json_decode($purchasesString);
                echo "<tr>";
                for($column = 0; $column < sizeof($purchasesArray); $column++)
                {
                    if(gettype($purchasesArray[$column]) == "double" || gettype($purchasesArray[$column]) == "integer")
                    {
                        echo "<td>".$purchasesArray[$column]."$</td>";
                    }
                    else
                    {
                        echo "<td>".$purchasesArray[$column]."</td>";
                    }
                }
                echo "</tr>";
            }
        }
    ?>
</table>
</div>

<?php
    Footer();
?>

