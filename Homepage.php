<?php
//including file on the webpage
include_once 'PhpFunctions/php.php';
    //calling functions
   pageHeader("Main");
    Menu();
    shuffle($items);
    ?>
<h1 class="info">Computers and computing are all around us. Some computing is highly visible, like your laptop. But this is only part of a computing iceberg. A lot more lies hidden below the surface. We don't see and usually don't think about the computers inside appliances, cars, airplanes, cameras, smartphones, GPS navigators and games.</h1>
<?php
    if($items[0] == COMPUTER_1)
    //including items
    {
        echo '<br><img src="'.$items[0].'" class="computer1"></img>';
    }
    else
    {
        echo '<br><img src="'.$items[0].'" class="product"></img>';
    }
    //to download cheatsheet
  ?>
<div class ="CheatSheet">
    <h2><a href ="<?php echo CHEAT;?>" download>Download Cheat Sheet</a></h2>
</div>
<?php
  Footer(); // function footer
  ?>