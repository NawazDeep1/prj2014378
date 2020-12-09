<?php
include_once 'PhpFunction/php.php';
include_once CLASSCUSTOMER1;
pageHeader("Account","");
Menu();
sessionStart();
$firstname = '';
$lastname = '';
$address = '';
$city = '';
$province = '';
$postalcode = '';
$username = '';
$password = '';
$firstnameErrorMsg = '';
$lastnameErrorMsg = '';
$addressErrorMsg = '';
$cityErrorMsg = '';
$provinceErrorMsg = '';
$postalcodeErrorMsg = '';
$usernameErrorMsg = '';
$passwordErrorMsg = '';
    
if(isset($_SESSION['user']))
    {
        $customer = new customer1();
        var_dump($_SESSION['user']);
        if($customer->Load($_SESSION['user']))
        {
        $firstname = $customer->getFirstName();
        $lastname = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $province = $customer->getProvince();
        $postalcode = $customer->getPostalCode();
        $username = $customer->getUsername();
        }        
    }
    else
    {
        ?><h3 style="text-align: center">Login</h3><?php
        Footer();
        die();
    }
    if(isset($_POST['submit']))
    {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $province = htmlspecialchars($_POST['province']);
        $postalcode = htmlspecialchars($_POST['postalcode']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        $firstnameErrorMsg = $customer->setFirstName($firstname);
        $lastnameErrorMsg = $customer->setLastName($lastname);
        $addressErrorMsg = $customer->setAddress($address);
        $cityErrorMsg = $customer->setCity($city);
        $provinceErrorMsg = $customer->setProvince($province);
        $postalcodeErrorMsg = $customer->setPostalCode($postalcode);
        $usernameErrorMsg = $customer->setUsername($username);
        $passwordErrorMsg = $customer->setPassword($password);
        
        if($firstnameErrorMsg == '' && $lastnameErrorMsg == '' && $addressErrorMsg == '' && $cityErrorMsg == '' && $provinceErrorMsg == '' && $postalcodeErrorMsg == '' && $usernameErrorMsg == '' && $passwordErrorMsg == '')
        {
            if($customer->Save())
            {
                $firstname = $customer->getFirstName();
                $lastname = $customer->getLastName();
                $address = $customer->getAddress();
                $city = $customer->getCity();
                $province = $customer->getProvince();
                $postalcode = $customer->getPostalCode();
                $username = $customer->getUsername();
                $password = '';
                echo "Saved";
            }
            else
            {
                echo "Error in saving";
            }
        }
    }    
?>
    <form method="POST">
        <p>
            <label>First Name:</label>
            <input type="text" name ="firstname" value="<?php echo $firstname; ?>"><span><?php echo $firstnameErrorMsg; ?></span>
        </p>
        <p>
            <label>Last Name:</label>
            <input type="text" name ="lastname" value="<?php echo $lastname; ?>"><span><?php echo $lastnameErrorMsg; ?></span>
        </p>
        <p>
            <label>Address:</label>
            <input type="text" name ="address" value="<?php echo $address; ?>"><span><?php echo $addressErrorMsg; ?></span>
        </p>
        <p>
            <label>City:</label>
            <input type="text" name ="city" value="<?php echo $city; ?>"><span><?php echo $cityErrorMsg; ?></span>
        </p>
        <p>
            <label>Province:</label>
            <input type="text" name ="province" value="<?php echo $province; ?>"><span><?php echo $provinceErrorMsg; ?></span>
        </p>
        <p>
            <label>Postal Code:</label>
            <input type="text" name ="postalcode" value="<?php echo $postalcode; ?>"><span><?php echo $postalcodeErrorMsg; ?></span>
        </p>
        <p>
            <label>Username:</label>
            <input type="text" name ="username" value="<?php echo $username; ?>"><span><?php echo $usernameErrorMsg; ?></span>
        </p>
        <p>
            <label>Password:</label>
            <input type="password" name ="password"><span><?php echo $passwordErrorMsg; ?></span>
        </p>
        <p>
            <input type="submit" value="Update Info" name="submit" class="button"/>
        </p>
    </form>
<?php
    pageFooter();
?>

