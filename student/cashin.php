<?php
include('sidebar.php');
include('dbh.php');

//echo $newTotalTransactions['id'];

$date = date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

$account_id = $_SESSION['user_id'];

$getBalance = $mysqli->query("SELECT balance FROM accounts WHERE id='$account_id' ");
$balance = $getBalance->fetch_array();
?>
<title>Dashboard - SPCF - Cashless Program</title>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php
        include('../topbar.php');
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Current Balance: ₱<?php echo number_format($balance["balance"], 2); ?></h1>
            </div>


            <!-- Cash in -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cash in</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input id="amount" type="number" placeholder="Amount to cashin" class="form-control"></input>
                        <br>
                        <button id="btnSubmit" class="btn btn-primary">Cash in using Paypal</button>
                    </div>
                </div>
            </div>
            <!-- End of Cash in -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- JS here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
    <script type="module">

        import {accessToken} from "./paypal/environment.js";
        import {order} from "./paypal/paypal.js"


        document.addEventListener("DOMContentLoaded", function(){
            axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`; 
        });

        window.document.getElementById('btnSubmit').onclick = function(){
            
            const amount = window.document.getElementById('amount').value;
            window.localStorage.setItem("cashInAmount", amount);
            let account_id = <?php echo $account_id; ?>;
            window.localStorage.setItem("account_id", account_id);
            order(amount);

        }
    </script>
    <?php
    include('footer.php');
    ?>

