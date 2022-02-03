<?php
    include("dbh.php");
    $currentDateTime = date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');
    
    //Process Add Card
    if(isset($_POST['save_rfid'])){
        $user_id = $_POST['user_id'];
        $tag_number = $_POST['tag_number'];
        $checkCard = $mysqli->query("SELECT * FROM cards WHERE tag_number='$tag_number' ");
        if(mysqli_num_rows($checkCard)>0){
            $_SESSION['msg_type'] = "warning";
            $_SESSION['message'] = "This card is already owned by someone. Please try another card.";
            header("location: add_card.php?id=".$user_id);
        }
        else{
            $mysqli->query(" INSERT INTO cards (user_id, tag_number) VALUES('$user_id','$tag_number') ") or die ($mysqli->error);

            $_SESSION['msg_type'] = "success";
            $_SESSION['message'] = "Card has been added!";

            header("location: add_card.php?id=".$user_id);
        }
    }


    //Delete Card
    if(isset($_GET['delete_card'])){
        $user_id = $_GET['user_id'];
        $card_id = $_GET['delete_card'];
        $checkCard = $mysqli->query("SELECT * FROM cards WHERE tag_number='$tag_number' ");

        $mysqli->query("UPDATE cards SET deleted = '1' WHERE id = '$card_id' ") or die ($mysqli->error);

        $_SESSION['msg_type'] = "danger";
        $_SESSION['message'] = "Card has been deleted!";
        header("location: card.php?user=".$user_id);
    }

    //Add Balance
    if(isset($_POST['add_balance'])){
        $user_id = $_POST["user_id"];
        $amount = $_POST["amount"];

        $chekcBalance = $mysqli->query("SELECT * FROM accounts WHERE id='$user_id' ") or die ($mysqli->error);
        $newBalance = $chekcBalance->fetch_array();
        $newBalance = $newBalance["balance"];
        $newBalance = $newBalance;
        $newAmount = $newBalance + $amount;
        $mysqli->query("UPDATE accounts SET balance = '$newAmount' WHERE id='$user_id' ") or die ($mysqli->error);


        //Insert into cash in logs
        $mysqli->query("INSERT INTO cash_in_transaction(account_id, created_at, amount) VALUES('$user_id','$currentDateTime','$amount')  ") or die ($mysqli->error);

        //Insert into transaction logs
        $mysqli->query("INSERT INTO transaction_logs (account_id, kind, amount, created_at, current_balance) VALUES('$user_id', 'cashin','$amount', '$currentDateTime', '$newAmount') ") 
        or die(mysqli_error($mysqli));

        $_SESSION['msg_type'] = "success";
        $_SESSION['message'] = "Cash in successful!";
        header("location: add_card.php?id=".$user_id);
    }

    //Check Account Balance
    if(isset($_GET["checkAccountBalance"])){
        //Code 0 when not exist
        //Code 1 when insuffecient balance
        //Code 2 when enough balance
        $totalItem = $_GET["currentTotal"];
        $rfid = $_GET["checkAccountBalance"];

        $balances =  $mysqli->query("SELECT a.balance AS balance FROM cards c
        JOIN accounts a
        ON c.user_id = a.id
        WHERE c.tag_number = '$rfid' AND c.deleted = '0' ") or die ($mysqli->error);


        if(mysqli_num_rows($balances)<1){
            $response = array('code' => '0', 'message'=>'Card Not Found. Please try again or try another card.');
        }
        else{
            $balance = $balances->fetch_array();

            if($balance["balance"] < $totalItem){
                $response = array('code' => '1', 'message'=>'Account does not have enough balance.');
            }
            else{
                $response = array('code' => '2', 'message'=>'Proceed to go.');
            }
        }

        echo json_encode($response);
        
    }
?>