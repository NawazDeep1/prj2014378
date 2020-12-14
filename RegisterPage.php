<?php
//including file on th ewebpage 
include_once ('PhpFunctions/php.php');
include_once CLASSCUSTOMER1;
//functions
pageHeader("Register");
Menu();
//declaring variables 
$customer = new customer1();
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
   
//definging
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
        $firstnameErrorMsg = $customer->setFirstname($firstname);
        $lastnameErrorMsg = $customer->setLastname($lastname);
        $addressErrorMsg = $customer->setAddress($address);
        $cityErrorMsg = $customer->setCity($city);
        $provinceErrorMsg = $customer->setProvince($province);
        $postalcodeErrorMsg = $customer->setPostalcode($postalcode);
        $usernameErrorMsg = $customer->setUsername($username);
        $passwordErrorMsg = $customer->setPassword($password);
        
        if($firstnameErrorMsg == '' && $lastnameErrorMsg == '' && $addressErrorMsg == '' && $cityErrorMsg == '' && $provinceErrorMsg == '' && $postalcodeErrorMsg == '' && $usernameErrorMsg == '' && $passwordErrorMsg == '')
        {
            if($customer->Save())
            {
                $firstname = '';
                $lastname = '';
                $address = '';
                $city = '';
                $province = '';
                $postalcode = '';
                $username = '';
                $password = '';
                header('Location: '.CART2);
            }
            else
            {
                echo "Error in saving";
            }
        }
    }
?>
<h3 class = "req">* = required</h3>
 <form method="POST">
        <p>
            <label>First Name:<span class="req">*</span></label>
            <input type="text" name ="firstname" value="<?php echo $firstname; ?>"><span class="validation"><?php echo $firstnameErrorMsg; ?></span>
        </p>
        <p>
            <label>Last Name:<span class="req">*</span></label>
            <input type="text" name ="lastname" value="<?php echo $lastname; ?>"><span class="validation"><?php echo $lastnameErrorMsg; ?></span>
        </p>
        <p>
            <label>Address:<span class="req">*</span></label>
            <input type="text" name ="address" value="<?php echo $address; ?>"><span class="validation"><?php echo $addressErrorMsg; ?></span>
        </p>
        <p>
            <label>City:<span class="req">*</span></label>
            <input type="text" name ="city" value="<?php echo $city; ?>"><span class="validation"><?php echo $cityErrorMsg; ?></span>
        </p>
        <p>
            <label>Province:<span class="req">*</span></label>
            <input type="text" name ="province" value="<?php echo $province; ?>"><span class="validation"><?php echo $provinceErrorMsg; ?></span>
        </p>
        <p>
            <label>Postal Code:<span class="req">*</span></label>
            <input type="text" name ="postalcode" value="<?php echo $postalcode; ?>"><span class="validation"><?php echo $postalcodeErrorMsg; ?></span>
        </p>
        <p>
            <label>Username:<span class="req">*</span></label>
            <input type="text" name ="username" value="<?php echo $username; ?>"><span class="validation"><?php echo $usernameErrorMsg; ?></span>
        </p>
        <p>
            <label>Password:<span class="req">*</span></label>
            <input type="password" name ="password"><span class="validation"><?php echo $passwordErrorMsg; ?></span>
        </p>
        <p>
            <input type="submit" value="save info" name="submit" class="button"/>
            <input type="reset" value="clear data" class="button"/>
        </p>
    </form>
<?php
//footer functions

    Footer();
?>
