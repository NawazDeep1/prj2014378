<?php
require_once ('DatabaseConnection.php');
 define("LENGHTOFFIRSTNAME ",20);
    define("LENGHTOFLASTNAME ",20);
    define("LENGHTOFADDRESS ", 25);
    define("LENGHTOFCITY ", 25);
    define("LENGHTOFPROVINCE ", 25);
    define("LENGHTOFPOSTALCODE ", 7);
    define("LENGHTOFUSERNAME ", 12);
    define("LENGHTOFPASSWORD ",30);

class customer1 {
   
    private $customer_uuid = '';
    private $firstname = '';
    private $lastname = '';
    private $address = '';
    private $city = '';
    private $province = '';
    private $postalcode = '';
    private $username = '';
    private $password = '';


public function __construct($customer_uuid = '', $firstname = '', $lastname = '', $address = '', $city = '', $province = '', $postalcode = '', $username = '', $password = '') 
    {
        $this->customer_uuid = $customer_uuid;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->city = $city;
        $this->province = $province;
        $this->postalcode = $postalcode;
        $this->username = $username;
        $this->password = $password;
    }
    
function getCustomer_UUID()
    {
        return $this->customer_uuid;
    }
function getFirstName()
    {
        return $this->firstname;
    }
    function setFirstName($newFirstName)
    {
        if(mb_strlen($newFirstName) > LENGHTOFFIRSTNAME )
        {
            return "First Name does not have more than ".LENGHTOFFIRSTNAME ." alphabets";
        }
        else if(mb_strlen($newFirstName) == 0)
        {
            return "Cannot be empty";
        }
        else
        {
            $this->firstname = $newFirstName;
            return '';
        }
    }
    
 function getLastName()
    {
        return $this->lastname;
    }
    function setLastName($newLastName)
    {
        if(mb_strlen($newLastName) > LENGHTOFLASTNAME )
        {
            return "Last Name does not have more than ".LENGHTOFLASTNAME ." alphabets";
        }
        else if(mb_strlen($newLastName) == 0)
        {
            return "Cannot be empty";
        }
        else
        {
            $this->lastname = $newLastName;
            return '';
        }
    }
    
  function getAddress()
    {
        return $this->address;
    }
    function setAddress($newAddress)
    {
        if(mb_strlen($newAddress) > LENGHTOFADDRESS )
        {
            return "Address does not have more than ".LENGHTOFADDRESS ." alphabets";
        }
        else if(mb_strlen($newAddress) == 0)
        {
            return "Cannot be empty";
        }
        else
        {
            $this->address = $newAddress;
            return '';
        }
    }
    
    function getCity()
    {
        return $this->city;
    }
    function setCity($newCity)
    {
        if(mb_strlen($newCity) > LENGHTOFCITY )
        {
            return "City does not have  more than ".LENGHTOFCITY ." alphabets";
        }
        else if(mb_strlen($newCity) == 0)
        {
            return "Cannot be empty";
        }
        else
        {
            $this->city = $newCity;
            return '';
        }
    }
     function getProvince()
    {
        return $this->province;
    }
    function setProvince($newProvince)
    {
        if(mb_strlen($newProvince) > LENGHTOFPROVINCE )
        {
            return "Province does not have more than ".LENGHTOFPROVINCE ." alphabets";
        }
        else if(mb_strlen($newProvince) == 0)
        {
            return "City cannot be empty";
        }
        else
        {
            $this->province = $newProvince;
            return '';
        }
    }
    
    function getPostalCode()
    {
        return $this->postalcode;
    }
    function setPostalCode($newPostalCode)
    {
        if(mb_strlen($newPostalCode) > LENGHTOFPOSTALCODE )
        {
            return "Postal  does not have more than ".LENGHTOFPOSTALCODE ." alphabets";
        }
        else if(mb_strlen($newPostalCode) == 0)
        {
            return "Cannot be empty";
        }
        else
        {
            $this->postalcode = $newPostalCode;
            return '';
        }
    }
    
       function getUserName()
    {
        return $this->username;
    }
    function setUserName($newUserName)
    {
        if(mb_strlen($newUserName) > LENGHTOFUSERNAME )
        {
            return "UserName does nor have more than ".LENGHTOFUSERNAME ." alphabets";
        }
        else if(mb_strlen($newUserName) == 0)
        {
            return "Cannot be empty";
        }
        else
        {
            $this->username = $newUserName;
            return '';
        }
    }
    
     function getPassword()
    {
        return $this->password;
    }
    function setPassword($newPassword)
    {
        if(mb_strlen($newPassword) > LENGHTOFPASSWORD )
        {
            return "Password does not have more than ".LENGHTOFPASSWORD ." alphabets";
        }
        else if(mb_strlen($newPassword) == 0)
        {
            return "Cannot be empty";
        }
        else
        {
            $this->password = $newPassword;
            return '';
        }
    }
    
    public function Load($customer_uuid)
    {
        global $conn;
        
        $sqlQuery = "CALL customer_load(:p_customer_uuid)";
        
        $PDO = $conn->prepare($sqlQuery);
        
        $PDO->bindParam(':p_customer_uuid', $customer_uuid);
        
        $PDO->execute();
        
        if($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $this->customer_uuid = $row['customer_uuid'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->address = $row['address'];
            $this->city = $row['city'];
            $this->province = $row['province'];
            $this->postalcode = $row['postalcode'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            return true;
        }
        
    }
    
     public function Save()
    {
        global $conn;
        if($this->customer_uuid == '')
        {
            $sqlQuery = "CALL customer_insert(:p_firstname, :p_lastname, :p_address, :p_city, :p_province, :p_postalcode, :p_username, :p_password)";
        
            $PDO = $conn->prepare($sqlQuery);

            $PDO->bindParam(':p_firstname', $this->firstname);
            $PDO->bindParam(':p_lastname', $this->lastname);
            $PDO->bindParam(':p_address', $this->address);
            $PDO->bindParam(':p_city', $this->city);
            $PDO->bindParam(':p_province', $this->province);
            $PDO->bindParam(':p_postalcode', $this->postalcode);
            $PDO->bindParam(':p_username', $this->username);
            $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $PDO->bindParam(':p_password', $hashPassword);
            
            $affectedRows = $PDO->execute(); 
            if($affectedRows == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $sqlQuery = "CALL customer_update(:p_customer_uuid, :p_firstname, :p_lastname, :p_address, :p_city, :p_province, :p_postalcode, :p_username, :p_password)";
            
            $PDO = $conn->prepare($sqlQuery);
            
            $PDO->bindParam(':p_customer_uuid', $this->customer_uuid);
            $PDO->bindParam(':p_firstname', $this->firstname);
            $PDO->bindParam(':p_lastname', $this->lastname);
            $PDO->bindParam(':p_address', $this->address);
            $PDO->bindParam(':p_city', $this->city);
            $PDO->bindParam(':p_province', $this->province);
            $PDO->bindParam(':p_postalcode', $this->postalcode);
            $PDO->bindParam(':p_username', $this->username);
            $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $PDO->bindParam(':p_password', $hashPassword);

            $PDO->execute();   
            return true;
        }
    }
    public function Login($username)
    {
        global $con;
        
        $sqlQuery = "CALL customer_login(:p_username)";
        
        $PDO = $connection->prepare($sqlQuery);
        
        $PDO->bindParam(':p_username', $username);
        
        $PDO->execute();
        
        if($row = $PDO->fetch(PDO::FETCH_ASSOC))
        {
            $this->customer_uuid = $row['customer_uuid'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            return true;
        }
    }
    
     public function Delete()
    {
        global $conn;
        $sqlQuery = "CALL customer_delete(:p_customer_uuid)";
        $PDO= $conn->prepare($sqlQuery);
        $PDO->bindParam(':p_customer_uuid', $this->customer_uuid);
        
        $affectedRows = $PDO->execute();
        
        return $affectedRows;
    }
}   
