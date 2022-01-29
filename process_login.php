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
                    $_SESSION['username'] = $newCheckUser["username"];
                    $_SESSION['user_id'] = $newCheckUser["id"];
                    $_SESSION['email'] = $newCheckUser["email"];
                    $_SESSION['firstname'] = $newCheckUser["firstname"];
                    $_SESSION['lastname'] = $newCheckUser["lastname"];
                    $_SESSION['role'] = $newCheckUser["role_id"];
                    header("location: index.php");
                }

            } else {
                $_SESSION['messageLogin'] = "Incorrect password!";
                header("location: loginn.php?email=".$email);
            }
        }
    }
?>