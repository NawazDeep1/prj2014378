<?php
    
// first we have to define constants
define("CSSFOLDER","CSS/");
define("CSSFILE",CSSFOLDER."Css.css"); 
define("IMAGESFOLDER","Images/");
define("LOGO",IMAGESFOLDER."logo1.png");

//defining the main pages 
define("MAIN","Homepage.php");
define("CART","BuyingsPage.php");
define("ORDER","Orderspage.php");

define("REGISTER","RegisterPage.php");
define("LOGIN","LoginPage.php");
define("ACCOUNT","AccountPage.php");

// defining the products in image folder
define("COMPUTER_1",IMAGESFOLDER."asus.jpg");
define("COMPUTER_2",IMAGESFOLDER."dell.jpg");
define("COMPUTER_3",IMAGESFOLDER."lenovo.jpg");
define("COMPUTER_4",IMAGESFOLDER."microsoft.jpg");
define("COMPUTER_5",IMAGESFOLDER."vortex.jpg");

//defining  textfile
define("TXTFILE","purchases.txt");
define("CHEAT","CheatSheet.txt");
define("ERRORFOLDER","Errors/");
define("ERROR",ERRORFOLDER."Errors.txt");
define("EXCEPTION",ERRORFOLDER."Exceptions.txt");

//Defining classses
define("PHPFUNCTIONFOLDER","PhpFunctions/");
define("CLASSCUSTOMER1",PHPFUNCTIONFOLDER."customer1.php");
define("CLASSCUSTOMER2",PHPFUNCTIONFOLDER."customer2.php");
define("CLASSPRODUCT1",PHPFUNCTIONFOLDER."product1.php");
define("CLASSPRODUCT2",PHPFUNCTIONFOLDER."product2.php");
define("CLASSPURCHASE1",PHPFUNCTIONFOLDER."purchase1.php");
define("CLASSPURCHASE2",PHPFUNCTIONFOLDER."purchase1.php");

//deinfing some new php pages
define("PURCHASES","PurchasesPage.php");
define("SEARCH","SearchPurchasesPage.php");
define("CART2","Buyingpage2.php");
define("COLLECTIONCLASS", "Collection.php");

//defining data connection
define("DATABASEFILE","DataConnection.php");


$items= array(COMPUTER_1, COMPUTER_2, COMPUTER_3, COMPUTER_4, COMPUTER_5);

function pageHeader($heading)
    {
    header('Expires: thu, 01, 1994 10:00:00 GMT');
    header('Cache-Control: no-cache');
    header('pragma: no-cache');
    if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']!= "ON")
    {
        header("Location: https://".$_SERVER['HTTPS_HOST'].$_SERVER["REQUEST_URI"]);
    }
        
    ?>
    <!DOCTYPE>
    <html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $heading;?></title>
        <link rel="stylesheet" type="text/css" href ="<?php echo CSSFILE;?>">
    </head>
    <body>
    <?php
     }
     //HTML
    function Footer()
    {
        copyright();
    ?>
    </body>
    </html>   
    <?php
    }
    //LOGO function
    function Logo()
    {
        echo '<a href = "'.MAIN.'"><img src = "'.LOGO.'" height = "100px" width = "200px" class="logo1"></a>';
    }
    //navigation menu
    function Menu()
    {
        echo '<div class = "nav">';
        Logo();
        echo '<ul>';
        echo '<li><a href = "'.MAIN.'">Home</a></li>'; 
        echo '<li><a href = "'.REGISTER.'">Register</a></li>';
        echo '<li><a href = "'.LOGIN.'">Login</a></li>';
        echo '<li><a href = "'.ACCOUNT.'">Account</a></li>';
        echo '<li><a href = "'.CART2.'">Buy</a></li>';
        echo '<li><a href = "'.PURCHASES.'">Purchases</a></li>';
        
        echo '</ul>';
        echo '</div>';
    }
    //copyright
    function copyright()
    {
        echo '<br><p class = "copyright">Copyright NAWAZ DEEP SINGH (2014378) '.date('Y').'</p>';
    }