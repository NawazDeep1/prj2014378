<?php
    include_once 'PhpFunctions/php.php';
    error_reporting(0); 
    function Errormanager($errornum, $errorStr, $errorfile, $errorline, $errortext)
    {
        $debuging = true;
        if($debuging)
        {
            echo "Error : ".$errorStr."<br>"; 
            echo "FileName : ".$errorfile."<br>";
            echo "FileLine : ".$errorline."<br>";
        }
        $dateTime = date("Y-m-d g:i:s:v a");
        $error = array($errorStr, $errorfile, $errorline, $dateTime);
        contents(ERROR, json_encode($error)."\r\n",FILE_APPEND);
        die("PHP ENDED");
    }
    function Exceptionsmanager($exception)
    {
        $debuging = true;
        if($debuging)
        {
            echo "Error : ".$exception->getMessage()."<br>"; 
            echo "FileName : ".$exception->getFile()."<br>";
            echo "FileLine : ".$exception->getLine()."<br>";
        }
        $dateTime = date("Y-m-d g:i:s:v a");
        $excpArray = array($exception->getMessage(), $exception->getFile(), $exception->getLine(),$dateTime);
        contents(EXCEPTION, json_encode($excpArray)."\r\n",FILE_APPEND);
        die("NOTHING more, reason =>Exception");
    }
    set_error_handler("ErrorManager");
    set_exception_handler("Exceptionsmanager");
    
    pageHeader("Orders");
    Menu();
    ?>
<div class="OrdersContainer">
    <!--Creating the table to show the purchases data-->
    <table class="tblOrders" border="1">
    <tr>
        <th>Product ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>City</th>
        <th>Comments</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Taxes</th>
        <th>Grand Total</th>
    </tr>
    <?php
        $handler = fopen(TXTFILE, "r"); 
        while(!feof($handler))   
        {
            $purchStr = fgets($handler);  
            if(!empty($purchStr))    
            {
                $purchsArray = json_decode($purchStr);    
                echo "<tr>";
                for($col = 0; $col < sizeof($purchsArray); $col++)  
                {
                    if($col >=7 || $col<=9)  
                    {
                        if($col == 7)    
                        {
                            if(isset($_GET["command"]) && htmlspecialchars($_GET["command"])=="color")  
                            {
                                if($purchsArray[$col]<100)    
                                {
                                    echo "<td class='sTRED'>".$purchsArray[$col]."$</td>";
                                }
                                else if($purchsArray[$col]>=100 && $purchsArray[$col]<=999.99)  
                                {
                                   echo "<td class='sTLOrangee'>".$purchsArray[$col]."$</td>";
                                }
                                else if($purchsArray[$col]>=1000) 
                                {
                                   echo "<td class='sTGreen'>".$purchsArray[$col]."$</td>";
                                }
                            }
                            else    
                            {
                                echo "<td>".$purchsArray[$col]."$</td>";
                            }
                        }
                        else    
                        {
                            echo "<td>".$purchsArray[$col]."$</td>";
                        }
                    }
                    else    
                    {
                        echo "<td>".$purchsArray[$col]."</td>";
                    }
                }
                echo "</tr>";
            }
        }
    ?>
</table>
</div>
<div class="cheatSheet">
    <h3><a href="<?php echo CHEAT;?>" download>Click to Download Cheat Sheet</a></h3>
</div>
<?php
    Footer();  
?>
