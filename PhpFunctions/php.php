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

//defing javascript file
define("JSFOLDER","JScript/");
define("JSFILE",JSFOLDER. "javascriptfile.js");


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
        <<script lang="javascript" type= "text/JScript"src="<?php echo javascriptfile;?>"></script>  
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
        echo '<li><a href = "'.LOGIN.'">SignIn</a></li>';
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
    
    function SignIn()
    {
      include_once DATABASEFILE;
      include_once CLASSCUSTOMER1;
      $customer = new customer1();
      $usernameErrorMsg = '';
      $passwordErrorMsg = '';

      if(isset($_POST['submit']))
        {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            if(mb_strlen($username) == 0)
            {
                $usernameErrorMsg = "Please Enter Username";
            }
            if(mb_strlen($password) == 0)
            {
                $passwordErrorMsg = "Please Enter Password";
            }

            if($usernameErrorMsg=='' && $passwordErrorMsg=='')
            {
                $dbPassword = '';
                global $conn;
                $sqlQuery = "CALL get_password(:p_username)";
                $PDO = $conn->prepare($sqlQuery);    
                $PDO->bindParam(':p_username', $username);
                $PDO->execute();
                while($row=$PDO->fetch())
                {
                    $dbPassword = $row['password'];
                }
                $PDO->closeCursor();
                if(password_verify($password, $dbPassword))
                {
                    if($customer->SignIn($username))
                    {
                    $_SESSION['user'] = $customer->getCustomerUUID();
                     header('Location: '. $_SERVER['REQUEST_URI']);
                    }
                }
                else     
                {
                    unset($_SESSION['user']);
                    echo "<h3 class = 'Error'>Please re-enter</h3><br>";
                }
            }   
        }
        ?>
        <h3 style="text-align: center">Sign In</h3>
        <h4 class="req">* = Mandatory</h4>
        <form method="POST">
        <p>
            <label>Username: <span class="req">*</label>
            <input type="text" name="username"><span class="validation"><?php echo $usernameErrorMsg; ?></span>
        </p>
        <p>
            <label>Password: <span class="req">*</label>
            <input type="password" name="password"><span class="validation"><?php echo $passwordErrorMsg; ?></span>
        </p>
        <p>
            <input type="submit" name="submit" value="Login" class="button">
        </p>
        </form>
        <p class="Signin">Must Sign Up <a href="<?php echo REGISTER; ?>">Sign up</a></p>

    <?php
    }
    function SignOut()
    {
        include_once CLASSCUSTOMER1;
        $customer = new customer1();
        $customer->Load($_SESSION['user']);
        echo "<h3 style='text-align: center;'>Welcome ".$customer->getFirstName()." ".$customer->getLastName()."</h3>";
        if(isset($_POST['SignOut']))
        {
            unset($_SESSION['user']);
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
        ?>
        <form method="POST">
            <p>
                <input type="submit" name="logout" value="Logout" class="button">
            </p>
        </form>
        <?php
    }
    function ErrorHandler()
    {
        ErrorReporting(0); 
        function Errors($ErrorNum, $ErrorString, $ErrorFile, $ErrorLine, $ErrorContext)
        {
            $debug = false;
            if($debug)
            {
                echo "Error : ".$ErrorString."<br>"; 
                echo "FileLine : ".$ErrorLine."<br>";
                echo "FileName : ".$ErrorFile."<br>";               
            }
            date_default_timezone_set('America/Toronto');
            $dateTime = date("Y-m-d G:i:s:v");
            $Error = array($ErrorString, $ErrorFile, $ErrorLine,$dateTime);
            file_put_contents(ERROR, json_encode($Error)."\r\n",FILE_APPEND);
            echo "<h3 class ='ErEx'>PHP ended because of an Error</h3>";
            pageFooter();
            die();
        }
        function Expection($exception)
        {
            $debug = false;
            if($debug)
            {
             echo "Error : ".$exception->getMessage()."<br>"; 
             echo "FileLine : ".$exception->getLine()."<br>";
             echo "FileName : ".$exception->getFile()."<br>";
             
            }
            date_default_timezone_set('America/Toronto');
            $dateTime = date("Y-m-d G:i:s:v");
            $exceptionArray = array($exception->getMessage(), $exception->getFile(), $exception->getLine(),$dateTime);
            file_put_contents(EXCEPTION, json_encode($exceptionArray)."\r\n",FILE_APPEND);
            echo "<h3 class ='ErEx'>Program Ends</h3>";
            pageFooter();
            die();
        }
        set_Error_handler("Errors");
        set_exception_handler("Exceptions");
    }
        