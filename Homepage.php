<?php
    include_once 'PhpFunctions/php.php';
    Header("Main");
    Menu();
    shuffle($items);
    ?>
<h1 class="info">facilities</h1>
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