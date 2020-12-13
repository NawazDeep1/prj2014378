<?php
    include_once 'PhpFunctions/php.php';
    error_reporting(0); 
    function Errormanager($Errornum, $ErrorStr, $Errorfile, $Errorline, $Errortext)
    {
        $debuging = true;
        if($debuging)
        {
            echo "Error : ".$ErrorStr."<br>"; 
            echo "FileLine : ".$Errorline."<br>";
            echo "FileName : ".$Errorfile."<br>";
        }
        $dateTime = date("Y-m-d g:i:s:v a");
        $Error = array($ErrorStr, $Errorfile, $Errorline, $dateTime);
        contents(ERROR, json_encode($Error)."\r\n",FILE_APPEND);
        die("PROGRAM ENDED");
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
        date_default_timezone_set('America/Toronto');
        $dateTime = date("Y-m-d g:i:s:v a");
        $excpArray = array($exception->getMessage(), $exception->getFile(), $exception->getLine(),$dateTime);
        contents(EXCEPTION, json_encode($excpArray)."\r\n",FILE_APPEND);
        die("NOTHING more, reason =>Exception");
    }
    set_error_handler("ErrorManager");
    set_exception_handler("Exceptionsmanager");
    
    if(isset($_GET['command']) && htmlspecialchars($_GET['command']=="print"))  #if in the link, command = print then it will change the background-color
    {
        pageHeader("Orders", "clsBody");
    }
    else    #if method get for command = print is not there, than the background-color will remain the same as other pages
    {
        pageHeader("Orders","");
    }
    #calling the navigationMenu() to show the Menu
    Menu();
    ?>
<div class="Orders">
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
<?php
    Footer();  
?>
