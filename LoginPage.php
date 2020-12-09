<?php
include_once 'PhpFunctions/php.php';
include_once DATABASEFILE;
include_once CLASSCUSTOMER1;
$customer = new customer1();
pageHeader("Login", "");
Menu();
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
                if($customer->Login($username))
                {
                sessionStart();
                $_SESSION['user'] = $customer->getCustomerUUID();
                    echo "<h3 class = 'incorrect'>Welcome ".$customer->getFirstname()."</h3><br>";
                }
                else
                {
                    echo "Try again";
                }
            }
            else
            {
                sessionStart();
                unset($_SESSION['user']);
                echo "<h3 class = 'incorrect'>Enter again</h3><br>";
            }
        }   
    }
?>
<form method="POST">
    <p>
        <label>Username: </label>
        <input type="text" name="username"><span><?php echo $usernameErrorMsg; ?></span>
    </p>
    <p>
        <label>Password: </label>
        <input type="password" name="password"><span><?php echo $passwordErrorMsg; ?></span>
    </p>
    <p>
        <input type="submit" name="submit" value="Login" class="button">
    </p>
</form>
<p class="loginRegister">Need a User Account? <a href="<?php echo REGISTER; ?>">Register</a></p>
<?php
    Footer();
?>
