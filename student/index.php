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


            <!-- List of Cards -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Cards Associated to you</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="cardsTable">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>RFID Card Tag Number</th>
                                    <th>Data Enrolled</th>
                                    <th width="20%">Actions</th>
                                    <!-- <th style="display: none;">Balance</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    //List of RFID Cards
                                    $counter= 0;
                                    $rfidCards = $mysqli->query("SELECT * FROM cards WHERE user_id='$account_id' ");
                                    while($rfidCard = $rfidCards->fetch_assoc()){
                                        $counter++;
                                    ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $rfidCard["tag_number"]; ?></td>
                                    <td><?php echo $rfidCard["created_at"]; ?></td>
                                    <td class="text-danger">Delete function is disabled at the moment.</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End List of Cards -->

            <!-- List of Transactions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="transactionTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    //List of RFID Cards
                                    $transactionLogs = $mysqli->query("SELECT * FROM transaction_logs WHERE account_id='$account_id' ORDER BY created_at DESC");
                                    while($transaction = $transactionLogs->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td><?php echo $transaction["created_at"]; ?></td>
                                    <td><?php
                                        if($transaction["kind"] == "cashin"){
                                            echo "CASH-IN";
                                        }
                                        else{
                                            echo "BUY";
                                        }
                                    ?>
                                    </td>
                                    <td><?php
                                        if($transaction["kind"] == "buy"){
                                            echo $transaction["amount"];
                                        }
                                        else{
                                            echo "-";
                                        }
                                    ?></td>
                                    <td>
                                    <?php
                                        if($transaction["kind"] == "cashin"){
                                            echo $transaction["amount"];
                                        }
                                        else{
                                            echo "-";
                                        }
                                    ?>
                                    </td>
                                    <td><?php echo $transaction["current_balance"]; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End List of Cards -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- JS here -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cardsTable').DataTable( {
                "pageLength": 25
            } );
        } );     
        $(document).ready(function() {
            $('#transactionTable').DataTable( {
                "pageLength": 25,
                "order": [[ 0, "desc" ]]
            } );
        } );     
    </script>
    <?php
    include('footer.php');
    ?>

