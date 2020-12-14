<?php
//including file on the webpage
include_once 'PhpFunctions/php.php';
include_once DATABASEFILE;
include_once COLLECTIONCLASS;
include_once CLASSCUSTOMER1;

class customer2 extends Collection{
    //put your code here
      function __construct()
    {
        global $conn; //data base connection string
        $sqlQuery = "CALL customers_select()";
        $PDO= $conn->prepare($sqlQuery);
        $PDO->execute();
        while($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $customer = new customer($row['customer_uuid'],$row['firstname'], $row['lastname'], $row['address'], $row['city'], $row[province], $row['postalcode'], $row['username'], $row['password']);
            $this->add($row['customer_uuid'], $customer);
        }
         $PDO->closeCursor();
    }
}

