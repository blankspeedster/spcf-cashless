<?php
include 'dbh.php';
    //Process Login
    if(isset($_POST['login'])){
        $email = strtolower($_POST['email']);
        $password = $_POST['password'];

        $checkUser = $mysqli->query("SELECT * FROM accounts WHERE email='$email' ");

        if(mysqli_num_rows($checkUser) <= 0){
            $_SESSION['messageLogin'] = "Email not found. Please try again.";
            header("location: login.php?email=".$email);
        }
        else{
            $newCheckUser = $checkUser->fetch_array();
            $hashPassword = $newCheckUser['password'];
            $verify = password_verify($password, $hashPassword);
            if ($verify){
                if($newCheckUser["validated"]==0){
                    $_SESSION['messageLogin'] = "Account is pending validation. Please wait for a while.";
                    header("location: sign-in.php?email=".$email);
                }
                else{
                    $_SESSION['username'] = $newCheckUser["first_name"]." ".$newCheckUser["last_name"];
                    $_SESSION['user_id'] = $newCheckUser["id"];
                    $_SESSION['email'] = $newCheckUser["email"];
                    $_SESSION['firstname'] = $newCheckUser["firstname"];
                    $_SESSION['lastname'] = $newCheckUser["lastname"];
                    $_SESSION['role'] = $newCheckUser["role_id"];
                    header("location: index.php");
                }

            } else {
                $_SESSION['messageLogin'] = "Incorrect password!";
                header("location: login.php?email=".$email);
            }
        }
    }

    // Forgot Password
    if(isset($_POST['reset_password'])){
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$checkUser = $mysqli->query("SELECT * FROM accounts WHERE email='$email' ");
		if(mysqli_num_rows($checkUser)==0){
			$_SESSION['registerError'] = "No email registered. Please create an account";
			header("location: forgot-password.php");
		}
		else{
			//$token = "resetPasswordThisAccount".$email;
			$token = bin2hex(random_bytes(50));
			$mysqli->query(" INSERT INTO password_reset ( email, token ) VALUES('$email','$token') ") or die ($mysqli->error);

			// $to = $email;
			// $subject = "Reset your password on LNTDMP";
			// $msg = "Hi there, to reset your password kindly click the ffg: https://spcf-cashless.acms.org.ph/password-reset.php?token=".$token;
			// $msg = wordwrap($msg,70);
			// $headers = "From: pauline@spcf.edu.ph";
			// mail($to, $subject, $msg, $headers);

            // $link = "<a href='www.yourwebsite.com/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";
 

            require("vendor/autoloads/phpmailer/phpmailer/src/PHPMailer.php");
            require("vendor/autoloads/phpmailer/phpmailer/src/SMTP.php");
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $link = "<a href='https://spcf-cashless.acms.org.ph/password-reset.php?token=".$token."'>link</a>";
            $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            // enable SMTP authentication
            $mail->SMTPAuth = true;                  
            // GMAIL username
            $mail->Username = "pauline@spcf.edu.ph";
            // GMAIL password
            $mail->Password = "Ccispauline";
            $mail->SMTPSecure = "ssl";  
            // sets GMAIL as the SMTP server
            $mail->Host = "smtp.gmail.com";
            // set the SMTP port for the GMAIL server
            $mail->Port = "465";
            $mail->From='pauline@spcf.edu.ph';
            $mail->FromName='SPCF Cashless Application';
            $mail->AddAddress($email, '');
            $mail->Subject  =  'Reset Password';
            $mail->IsHTML(true);
            $mail->Body    = 'Please click on this link to reset your password '.$link.''.'<br><br><br><br> Please contact us if you did not initiate this request.';
            if($mail->Send())
            {
                $_SESSION['messageLogin'] = "Password instruction sent to your email account. Please check you inbox or spam folder.";
            }
            else
            {
                $_SESSION['messageLogin'] = "There is an error processing your password. Please try again.";
            }


			
			header("location: login.php");
		}

	}


    // New Password
    if(isset($_POST['new_password'])){
		$token = $_POST['token'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];

		if($password1!=$password2){
			$_SESSION['registerError'] = "Password not match. Please try again.";
			header("location: password-reset.php?token=".$token);
		}
		else{
			$getEmail = $mysqli->query(" SELECT email FROM password_reset WHERE token = '$token' LIMIT 1 ") or die ($mysqli->error);
			$email = mysqli_fetch_assoc($getEmail)['email'];

			if($email){
                require("vendor/autoloads/phpmailer/phpmailer/src/PHPMailer.php");
                require("vendor/autoloads/phpmailer/phpmailer/src/SMTP.php");
                $mail = new PHPMailer\PHPMailer\PHPMailer();
    
                $mail->CharSet =  "utf-8";
                $mail->IsSMTP();
                // enable SMTP authentication
                $mail->SMTPAuth = true;                  
                // GMAIL username
                $mail->Username = "pauline@spcf.edu.ph";
                // GMAIL password
                $mail->Password = "Ccispauline";
                $mail->SMTPSecure = "ssl";  
                // sets GMAIL as the SMTP server
                $mail->Host = "smtp.gmail.com";
                // set the SMTP port for the GMAIL server
                $mail->Port = "465";
                $mail->From='pauline@spcf.edu.ph';
                $mail->FromName='SPCF Cashless Application';
                $mail->AddAddress($email, '');
                $mail->Subject  =  'Reset Password';
                $mail->IsHTML(true);
                $mail->Body    = 'This is a notice that your password was changed';
                if($mail->Send())
                {
                    $_SESSION['messageLogin'] = "Changing password successful. Please login";
                }

				header('location: index.php');
			}
			else{
                require("vendor/autoloads/phpmailer/phpmailer/src/PHPMailer.php");
                require("vendor/autoloads/phpmailer/phpmailer/src/SMTP.php");
                $mail = new PHPMailer\PHPMailer\PHPMailer();
    
                $mail->CharSet =  "utf-8";
                $mail->IsSMTP();
                // enable SMTP authentication
                $mail->SMTPAuth = true;                  
                // GMAIL username
                $mail->Username = "pauline@spcf.edu.ph";
                // GMAIL password
                $mail->Password = "Ccispauline";
                $mail->SMTPSecure = "ssl";  
                // sets GMAIL as the SMTP server
                $mail->Host = "smtp.gmail.com";
                // set the SMTP port for the GMAIL server
                $mail->Port = "465";
                $mail->From='pauline@spcf.edu.ph';
                $mail->FromName='SPCF Cashless Application';
                $mail->AddAddress($email, '');
                $mail->Subject  =  'Reset Password';
                $mail->IsHTML(true);
                $mail->Body    = 'This is a notice that your password was changed';
                if($mail->Send())
                {
                    $_SESSION['messageLogin'] = "Changing password successful. Please login";
                }

				header('location: index.php');
			}
		}

	}
