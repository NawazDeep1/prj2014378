<?php
    
#create constants
define("FOLDER_CSS","CSS/");
define("CSSFILE",FOLDER_CSS."Css.css"); 
define("IMAGES","Images/");
define("LOGO",FOLDER_IMAGES."front.webp");
define("HOME_PAGE","Home.php");
define("BUY_PAGE","");
define("ORDER_PAGE","");
//define("PRODUCT_EX_BIKE",FOLDER_IMAGES."Excerscise Bike.jpeg");
//define("PRODUCT_TREDMILL",FOLDER_IMAGES."Tredmill.jpg");
//define("PRODUCT_ELLIPTICAL",FOLDER_IMAGES."Elliptical.jpg");
//define("PRODUCT_CYCLE",FOLDER_IMAGES."Cycle.jpg");
//define("PRODUCT_ROWERS",FOLDER_IMAGES."Rowers.jpg");
$products = array(PRODUCT_EX_BIKE, PRODUCT_TREDMILL, PRODUCT_ELLIPTICAL, PRODUCT_CYCLE, PRODUCT_ROWERS);
function pageHeader($title)
    {
    ?>
    <!DOCTYPE>
    <html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title;?></title>
        <link rel="stylesheet" type="text/css" href ="<?php echo CSS_FILE;?>">
    </head>
    <body> 
    <?php
    }
    function pageFooter()
    {
        copyright();
    ?>
    </body>
    </html>   
    <?php
    }
    function copyright()
    {
        echo '<br><p class = "copyright">Copyright Nawaz Deep (2013417) '.date('Y').'</p>';
    }
    function displayLogo()
    {
        echo '<a href = "'.HOME_PAGE.'"><img src = "'.LOGO.'" height = "150px" width = "230px" class="logo"></a>';
    }
    function navigationMenu()
    {
        echo '<div class = "navMenu">';
        displayLogo();
        echo '<ul>';
        echo '<li><a href = "'.HOME_PAGE.'">Home</a></li>'; 
        echo '<li><a href = "'.BUY_PAGE.'">Buy</a></li>';
        echo '<li><a href = "'.ORDER_PAGE.'">Orders</a></li>';
        echo '</ul>';
        echo '</div>';
    }