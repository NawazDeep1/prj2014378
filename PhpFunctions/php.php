<?php

define("CSS_FOLDER","CSS/");
define('CSSFILE',CSS_FOLDER."Css.css");
define("IMAGES","Images/");
define("LOGO",IMAGES."front.wep");


function Header($Heading)
{
    ?>
      <!DOCTYPE>
        <html>
            <head>
                <meta charset ="UTF-8">
                <title>
                    <?php 
                    echo $Heading;
                    ?>
                </title>
                <link rel="stylesheet" type="text/css" href="<?php echo CSSFILE; ?>">
            </head>
        
<body>
<?php
}

function Footer()
{
    ?>

</body>
</html>
<?php
}
function Copyright()
{
    echo"<br> Copyright NawazDeep Singh (2014378)".date('y')."<br>";
}

function Logo()
{
    echo'<img src = "'.front.'" width = "250px" height ="170px">';
}


