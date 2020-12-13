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
    foreach($purchases->Items as $purchase)
    {
        $product->Load($purchase->getProductCode());
        echo "<tr>";
        echo "<td>".$purchase->getProductCode()."</td>";
        echo "<td>".$customer->getFirstName()."</td>";
        echo "<td>".$customer->getLastName()."</td>";
        echo "<td>".$customer->getCity()."</td>";
        echo "<td>".$purchase->getComments()."</td>";
        echo "<td>".$product->getPrice()."</td>";
        echo "<td>".$purchase->getQuantity()."</td>";
        echo "<td>".$purchase->getSalePrice()."</td>";
        echo "</tr>";
    }
        echo "</table>";
  }
?>
