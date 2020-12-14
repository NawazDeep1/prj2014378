<?php
//including file on the webpage 
include_once 'PhpFunctions/php.php';
//functions
 pageHeader("Purchases");
 Menu();
 session_start();
 if(isset($_SESSION['admin']))
 {
    if(isset($_POST['delete']))
    {
        $purchase = new purchase();
         if($purchase->Delete($_POST['purchaseUUID']))
         {
            echo "<h3 class='deleteInfo'>Purchase Deleted</h3>";
         }
    }     
 }
 else
 {
     //functions
     SignIn();
     Footer();
     die();
 }
?>
<div class ="purchases">
    <label>Purchases made on this day or later: </label>
    <input type="text" placeholder="2020-05-10" id="search">
    </p>
    <p>
       <button onclick="SearchPurchases()" class="button">Search</button>
    </p>
 </div>
 
    <div id="Results">
    </div>
<?php
//functions
    SignOut();
  Footer();
?>