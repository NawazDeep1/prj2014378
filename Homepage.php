<?php
    include_once 'PhpFunctions/php.php';
    //calling functions
    
    pageHeader("Main");
    Menu();
    shuffle($items);
    ?>
// information about website
<h1 class="info">Computers and computing are all around us. Some computing is highly visible, like your laptop. But this is only part of a computing iceberg. A lot more lies hidden below the surface. We don't see and usually don't think about the computers inside appliances, cars, airplanes, cameras, smartphones, GPS navigators and games.</h1>
<?php
    if($items[0] == COMPUTER_1)
    {
        echo '<br><img src="'.$items[0].'" class="computer1"></img>';
    }
    else
    {
        echo '<br><img src="'.$items[0].'" class="product"></img>';
    }
    Footer();
?>