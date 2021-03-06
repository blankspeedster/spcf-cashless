<?php
    include('dbh.php');
    $getURI = $_SESSION['getURI'];
    $date   = date_default_timezone_set('Asia/Manila');
    $date   = date('Y-m-d');

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['save'])){
        $item_id      = mysqli_real_escape_string($mysqli, $_POST['item_id']);
        $barcode      = mysqli_real_escape_string($mysqli, $_POST['barcode']);
        $item_code    = mysqli_real_escape_string($mysqli, $_POST['item_code']);
        $item_name    = mysqli_real_escape_string($mysqli, $_POST['item_name']);
        $qty          = mysqli_real_escape_string($mysqli, $_POST['qty']);
        $price        = mysqli_real_escape_string($mysqli, $_POST['price']);
        $market_price = mysqli_real_escape_string($mysqli, $_POST['market_price']);
        $total_cost   = mysqli_real_escape_string($mysqli, $_POST['total_cost']);
        $description  = mysqli_real_escape_string($mysqli, $_POST['description']);

        $mysqli->query("INSERT INTO inventory (id, barcode, item_code, item_name, qty, item_description, item_price, market_original_price, vendor_id) VALUES('$item_id', '$barcode', '$item_code','$item_name', '$qty', '$description', '$price', '$market_price', '$user_id')") or  die(mysqli_error($mysqli));
        $mysqli->query("INSERT INTO inventory_cost (item_id, total_cost, date_added) VALUES('$item_id', '$total_cost', '$date')") or  die(mysqli_error($mysqli));

        $_SESSION['message']  = "An item has been added!";
        $_SESSION['msg_type'] = "success";
        header('location: inventory.php');
    }

    if(isset($_GET['delete'])){
        $item_id = $_GET['delete'];
        $mysqli->query(" DELETE FROM inventory WHERE id = '$item_id' ") or die(mysqli_error($mysqli));

        $_SESSION['message'] = "Item has been deleted!";
        $_SESSION['msg_type'] = "danger";
        header('location: inventory.php');
    }

    if(isset($_POST['add_stock'])){
        $barcode      = mysqli_real_escape_string($mysqli, $_POST['barcode']);
        $item_code    = mysqli_real_escape_string($mysqli, $_POST['item_code']);
        $item_name    = mysqli_real_escape_string($mysqli, $_POST['item_name']);
        $item_id      = mysqli_real_escape_string($mysqli, $_POST['item_id']);
        $old_stock    = mysqli_real_escape_string($mysqli, $_POST['old_stock']);
        $new_stock    = mysqli_real_escape_string($mysqli, $_POST['new_stock']);
        $market_price = mysqli_real_escape_string($mysqli, $_POST['market_price']);

        $new_stock = $new_stock + $old_stock;
        $cost      = mysqli_real_escape_string($mysqli, $_POST['cost']);


        $mysqli->query("UPDATE inventory SET qty='$new_stock', barcode='$barcode', item_code='$item_code', item_name = '$item_name', market_original_price = '$market_price' WHERE id='$item_id' ") or  die(mysqli_error($mysqli));
        $mysqli->query("INSERT INTO inventory_cost (item_id, total_cost, date_added) VALUES('$item_id', '$cost', '$date')") or  die(mysqli_error($mysqli));

        $_SESSION['message']  = "An item has been updated!";
        $_SESSION['msg_type'] = "success";

        header('location: '.$getURI);
    }
?>