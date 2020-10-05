<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Just a cell
        </title>
        <link rel="stylesheet" type="text/css" href="cell.css">
        
            <script src="index_js.js"></script>
            <meta charset="UTF-8">
    </head>
    <body>
        <?php
        // define variables and set to empty values


        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer-master/src/Exception.php';
        require 'PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/src/SMTP.php';
        
        

        $firstname = $lastname = $email = $pswd = $pswd_con= "";
        $is_valid  = TRUE;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate the submitted data 

        $firstname  = test_input($_POST["firstname"]);
        if(strlen($firstname) == 0){
            echo "Sign up failed, Encountered the following errors <br>";
            echo "First name cann't be empty <br>";
            $is_valid = FALSE;
        }

        $lastname  = test_input($_POST["lastname"]);
        if(strlen($lastname) == 0){
            $is_valid = FALSE;
            echo "Last name cann't be empty <br>";
        }

        
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo("Invalid email address <br>");
            $is_valid = FALSE;
         }
        
        $pswd  = test_input($_POST["pswd"]);
        // Validate password strength
        
        $uppercase = preg_match('@[A-Z]@', $pswd);
        $lowercase = preg_match('@[a-z]@', $pswd);
        $number    = preg_match('@[0-9]@', $pswd);
               
        if(!$uppercase || !$lowercase || !$number  || strlen($pswd) < 8)
            {echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number.';
             $is_valid = FALSE;}
        if ($_POST['pswd']!= $_POST['pswd-con'])
        {
            echo "Password not matching";
            $is_valid = FALSE;
        }
        $otp      = rand(100000, 999999);
        if(is_valid){
        // Put all details to session
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] =  $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["otp"]   = $otp;


        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "niharrp123@gmail.com";
        $mail->Password   = "test-pswd123#";

        $mail->IsHTML(true);
        $mail->AddAddress($email, "Niharranjan Pradhan");
        $mail->SetFrom("niharrp123@gmail.com", "IIST Catalogue");
        $mail->Subject = "IIST Catalogue Email Varification";
        $content = "<b>Dear $firstname ,<br>Use the following OTP to complete the email varification process <br> OTP : $otp .</b>";
     

        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
        } else {
        echo "Email sent successfully";
        header("Location: http://localhost/otp.php");
        exit();
        }}
        
        }

        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        ?>

        
        <form action="" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
             <div class="container">
             <div class="title_ ">
                IIST Catalogue User Registration
            </div>
            <div class="name nm" id="firstname">
                
                <div class="input">
                    First Name
                </div>
                <input type="text" class="input" name="firstname" onfocus=focusFun("firstname") onblur=blurFun("firstname") >
            </div>
           
            <div class="name nm" id="lastname">
              
                <div class="input">
                    Last Name
                </div>
                <input type="text" class="input " 
                name="lastname" onfocus=focusFun("lastname") onblur=blurFun("lastname")>
            </div>
            
            <div class="name email" id="email">
                
                <div class="input">
                    Mail ID
                </div>
                <input type="text" class="input" name="email" onfocus=focusFun("email") onblur=blurFun("email") title="This email id will act
                as a primary contact with you and is public">
            </div>

           
            <div class="name pass" id="pass">
                
                <div class="input">
                    Password
                </div>
                <input type="password" class="input" name="pswd" onfocus=focusFun("pass") onblur=blurFun("pass") onkeyup=vali_psw("pass")
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number 
            and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
           
            <div class="name pass" id="pass-con">
              
                <div class="input">
                    Confirm
                </div>
                <input type="password" class="input" name="pswd-con" onkeyup='match_pass("pass", "pass-con")'>
            </div>
            
           <div class="name sub"><input class="input" type="submit" value="Submit"></div>
            
            

        
        </div>
        </form>
        
    </body>
</html>