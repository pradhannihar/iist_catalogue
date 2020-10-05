<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Just a cell
        </title>
        <link rel="stylesheet" type="text/css" href="cell.css">
        <link rel="stylesheet" type="text/css" href="otp.css">
            
            <meta charset="UTF-8">
    </head>
    <body>
        <?php 
         $email= $_SESSION["email"];

         echo "Email varification of $email is going on \n";
         if ($_SERVER["REQUEST_METHOD"] == "POST"){
             $otp_received = $_POST["otp"];
             if($_SESSION["otp"] == $otp_received)
                echo "Email Varified, Welcome !";
         }
        ?>

    <form action="" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">

    <div class="title_ ">
                IIST Catalogue User Email Varification 
    </div>

    <div class="info"> Enter the OTP send to <?php 
        echo $email;
       ?>

    </div>
    <div class = "name otp">
        
        <div class="input"> OTP</div>

        <input type='text' class="input" name='otp'> 
    </div>

    
    <div class="name sub"><input class="input" type="submit" value="Sign Up"></div>
   </div>
    
    </form>

    </body>
</html>