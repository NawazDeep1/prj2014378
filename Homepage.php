<?php
    include_once 'PhpFunctions/php.php';
    pageHeader("Hello");
    navigationMenu();
    shuffle($products);
    ?>
<h1 class="info">Supreme Fitness is the distributer of Fitness Equipment. We sell best-in-class exercise machines for the home and for a wide variety of commercial facilities</h1>
<?php
    if($products[0] == PRODUCT_CYCLE)
    {
        echo '<br><img src="'.$products[0].'" class="product_cycle"></img>';
    }
    else
    {
        echo '<br><img src="'.$products[0].'" class="product"></img>';
    }
    pageFooter();
?>