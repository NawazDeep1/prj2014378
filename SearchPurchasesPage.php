<?php
  include_once 'PhpFunctions/php.php';
  include_once CLASSCUSTOMER1;
  include_once CLASSPRODUCT1;
  include_once CLASSPURCHASE2;
  sessionStart();
  if(isset($_POST['search']))
  {
    $search = htmlspecialchars($_POST['search']);
    $purchases = new purchase2($search, $_SESSION['user']);
    $customer = new customer1();
    $product = new product1();
    $customer->Load($_SESSION['user']);
    ?>

<?php
    foreach($purchases->Items as $purchase)
    {
        $product->Load($purchase->getProductCode());
        echo "<tr>";
        ?>
 <td>
        <button  onclick="DeleteRow(this)" value="Delete" name="delete" class="button">Delete</button>
 </td>
<?php
        echo "<td>".$purchase->getProductCode()."</td>";
        echo "<td>".$customer->getFirstName()."</td>";
        echo "<td>".$customer->getLastName()."</td>";
        echo "<td>".$customer->getCity()."</td>";
        echo "<td>".$purchase->getComments()."</td>";
        echo "<td>".$product->getPrice()."</td>";
        echo "<td>".$purchase->getQuantity()."</td>";
        echo "<td>".$purchase->getSubTotal().' $'."</td>";
        echo "<td>".$purchase->getTaxes().' $'."</td>";
        echo "<td>".$purchase->getGrandTotal().' $'."</td>";
        echo "</tr>";
    }
        echo "</table>";
  }
?>

