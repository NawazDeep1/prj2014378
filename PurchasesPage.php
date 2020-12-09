<?php
 include_once 'PhpFunctions/phh.php';
 pageHeader("Purchases", "");
 Menu();
?>
 <label>Purchases made on this day or later: </label>
 <input type="text" placeholder="2020-05-10" id="search">
 </p>
 <p>
    <button onclick="SearchPurchases()" class="button">Search</button>
 </p>

<div id="searchResults">
</div>
<?php
  Footer();
?>