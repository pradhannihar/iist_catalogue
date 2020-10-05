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
