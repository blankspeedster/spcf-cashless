<?php 
    include ('dbh.php');

    $date = date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d H:i:s');
    $user_id = $_SESSION['user_id'];
    
    //Request to add cashout request
    if(isset($_POST['cashout'])){
        $amount = $_POST['amount'];
        $refence_id = generateRandomString();


        $mysqli->query("INSERT INTO cash_out (vendor_id, reference_id, amount, date_initiated, date_completed) VALUES ('$user_id', '$refence_id', '$amount', '$date','$date') ") or die(mysqli_error($mysqli));

        $_SESSION['message']    = "Request has been saved!";
        $_SESSION['msg_type']   = "success";
        header('location: cashout_initiate.php');
    }

    //Request to reject
    if(isset($_GET['reject'])){
        $id = $_GET['reject'];

        $mysqli->query("UPDATE cash_out SET completed = '2', date_completed = '$date' WHERE id = '$id' ") or die(mysqli_error($mysqli));

        $_SESSION['message']    = "Request has been updated!";
        $_SESSION['msg_type']   = "danger";
        header('location: cashout.php');
    }


    //Request to approve
    if(isset($_GET['approve'])){
        $id = $_GET['approve'];

        $getBalance = $mysqli->query("SELECT * FROM cash_out co
        JOIN accounts a
        ON a.id = co.vendor_id WHERE co.id = '$id' ");
        $newBalance = $getBalance->fetch_array();

        $vendor_id = $newBalance["vendor_id"];
        $current_balance = $newBalance["balance"];
        $request_amount = $newBalance["amount"];
        
        $current_balance = $current_balance - $request_amount;


        $mysqli->query("UPDATE cash_out SET completed = '1', date_completed = '$date' WHERE id = '$id' ") or die(mysqli_error($mysqli));
        
        $mysqli->query("UPDATE accounts SET balance = '$current_balance' WHERE id = '$vendor_id' ") or die(mysqli_error($mysqli));

        //Set Balance of the accounting
        $user_id = $_SESSION['user_id'];
        $getBalance = mysqli_query($mysqli, "SELECT * FROM accounts WHERE id =  '$user_id' ");
        $newBalance = $getBalance->fetch_array();
        $balance = $newBalance["balance"];
        $new_balance = $balance + $request_amount;

        $mysqli->query("INSERT transaction_logs (account_id, vendor_id, kind, amount, current_balance, updated_at) VALUES ('$user_id', '$vendor_id', 'cashin', '$request_amount', '$new_balance', '$date' )") or die(mysqli_error($mysqli));

        $mysqli->query("UPDATE accounts SET balance = '$new_balance' WHERE id = '$user_id' ") or die(mysqli_error($mysqli));

        $_SESSION['message']    = "Request has been updated!";
        $_SESSION['msg_type']   = "success";
        header('location: cashout.php');
    }


    function generateRandomString($length = 9) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>
