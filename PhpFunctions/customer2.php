<?php
require_once ('DatabaseConnection.php');
require_once ('Collection.php');
require_once ('customer1.php');

class customer2 extends Collection{
    //put your code here
      function __construct()
    {
        global $conn;
        $sqlQuery = "CALL customers_select()";
        $PDO= $conn->prepare($sqlQuery);
        $PDO->execute();
        while($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $customer = new customer($row['customer_uuid'],$row['firstname'], $row['lastname'], $row['address'], $row['city'], $row[province], $row['postalcode'], $row['username'], $row['password']);
            $this->add($row['customer_uuid'], $customer);
        }
    }
}

