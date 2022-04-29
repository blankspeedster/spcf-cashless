<?php
include('sidebar.php');
include('dbh.php');

$user_id = $_SESSION['user_id'];

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

$getTotalTransactions = mysqli_query($mysqli, "SELECT count(id) AS id FROM transaction WHERE DATE(`transaction_date`) = CURDATE() ");
$newTotalTransactions = $getTotalTransactions->fetch_array();
//echo $newTotalTransactions['id'];

$date = date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

$getTotalTransactionsToday = mysqli_query($mysqli, "SELECT sum(amount_paid) AS total_amount_paid FROM transaction WHERE transaction_date = '$date' ");
$newTotalTransactionsToday = $getTotalTransactionsToday->fetch_array();

$getInventoryInStock = mysqli_query($mysqli, "SELECT count(id) AS id FROM inventory WHERE qty <= 10 ");
$newInventoryInStock = $getInventoryInStock->fetch_array();

$getAllTransactions = mysqli_query($mysqli, "SELECT * FROM transaction id ");

$getTotalEarnings = mysqli_query($mysqli, "SELECT sum(amount_paid) AS total_earnings, sum(total_amount) AS grand_total FROM transaction WHERE DATE(`transaction_date`) = CURDATE() ");

$newTotalEarnings = $getTotalEarnings->fetch_array();
$grandTotal = $newTotalEarnings['grand_total'] - $newTotalEarnings['total_earnings'];

//Get total balance of the vendor
$getTotalBalance = mysqli_query($mysqli, "SELECT * FROM accounts ");
$totalBalance = $getTotalBalance->fetch_array();

?>
<title>Dashboard - SPCF - Cashless Program</title>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php
        include('topbar.php');
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>
            <div class="row">
                <!-- Total Transactions -->
                <?php
                $getTotalTransaction = mysqli_query($mysqli, "SELECT sum(amount) AS total_amount FROM transaction_logs WHERE DATE(`updated_at`) = CURDATE() ");
                $totalTransaction = $getTotalTransaction->fetch_array();
                ?>
                <div class="col-xl-4 col-md6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Current balance  as of Date:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo '₱ ' . number_format($totalTransaction['total_amount'], 2); ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-invoice fa-5x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $getTotalCashOut = mysqli_query($mysqli, "SELECT sum(amount) AS total_amount FROM transaction_logs WHERE DATE(`updated_at`) = CURDATE() AND kind = 'cashout' ");
                $cashOutTransaction = $getTotalCashOut->fetch_array();
                ?>
                <div class="col-xl-4 col-md6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-danger text-uppercase mb-1">Total Cashout:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo '₱ ' . number_format($cashOutTransaction['total_amount'], 2); ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-invoice fa-5x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $getTotalCashIn = mysqli_query($mysqli, "SELECT sum(amount) AS total_amount FROM transaction_logs WHERE DATE(`updated_at`) = CURDATE() AND kind = 'cashin' AND account_id = '$user_id' ");
                $cashInTransaction = $getTotalCashIn->fetch_array();
                ?>
                <div class="col-xl-4 col-md6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-success text-uppercase mb-1">Total Cashin:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo '₱ ' . number_format($cashInTransaction['total_amount'], 2); ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-invoice fa-5x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Transactions -->
            </div>
            <?php
            $cash_in_transaction = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t  JOIN accounts a ON a.id = t.account_id WHERE t.account_id = '$user_id' ORDER BY created_at DESC ");
            ?>
            <!-- Cash in and cash out -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Transactions</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="cashInOutTransactions">
                            <thead>
                                <tr>
                                    <th>Control ID</th>
                                    <th>Reference Number</th>
                                    <th>Transaction Date</th>
                                    <th>Full Name</th>
                                    <!-- <th>Phone Number</th> -->
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <!-- <th>Date Completed</th> -->
                                    <!-- <th>Current Balance</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($transcations = $cash_in_transaction->fetch_assoc()) {
                                    $transction_id = $transcations["transaction_id"];

                                    $reference_number = "";
                                    $created_at = $transcations['created_at'];
                                    $timestamp = strtotime($created_at);
                                    $new_date_format = date('Ymd', $timestamp);
                                    $reference_number = $new_date_format . "00" . $transction_id;



                                    $get_full_name = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t JOIN accounts a ON a.id = t.vendor_id WHERE t.id = '$transction_id' ");
                                    $new_full_name = mysqli_fetch_assoc($get_full_name);
                                    $first_name = $new_full_name['first_name'];
                                    $last_name = $new_full_name['last_name'];
                                    $full_name = $first_name . " " . $last_name;
                                ?>
                                    <tr>
                                        <td><?php echo $transction_id; ?></td>
                                        <td><?php echo $reference_number; ?></td>
                                        <td><?php echo $transcations['created_at']; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <!-- <td><?php echo $transcations['phone_number']; ?></td> -->
                                        <td>
                                            <?php
                                            if ($transcations['kind'] == 'cashin') {
                                                echo "<a style='color: green;'>" . strtoupper($transcations['kind']) . "</a>";
                                            } else {
                                                echo "<a style='color: red;'>" . strtoupper($transcations['kind']) . "</a>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo '₱' . number_format($transcations['amount'], 2); ?></td>
                                        <!-- <td><?php //echo $transcations['updated_at']; 
                                                    ?></td> -->
                                        <!-- <td><?php //echo '₱'.number_format($transcations['current_balance'],2); 
                                                    ?></td> -->
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Cash in and cash out -->

            <!-- Cash in -->
            <?php
            $cash_in_transaction = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t  JOIN accounts a ON a.id = t.account_id WHERE t.account_id = '$user_id' AND kind = 'cashin' ORDER BY created_at DESC ");
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Cash in</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="cashInTransactions">
                            <thead>
                                <tr>
                                    <th>Control ID</th>
                                    <!-- <th>Reference Number</th> -->
                                    <!-- <th>Date Initiated</th> -->
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Date Completed</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($transcations = $cash_in_transaction->fetch_assoc()) {
                                    $transction_id = $transcations["transaction_id"];

                                    $reference_number = "";
                                    $created_at = $transcations['created_at'];
                                    $timestamp = strtotime($created_at);
                                    $new_date_format = date('Ymd', $timestamp);
                                    $reference_number = $new_date_format . "00" . $transction_id;



                                    $get_full_name = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t JOIN accounts a ON a.id = t.vendor_id WHERE t.id = '$transction_id' ");
                                    $new_full_name = mysqli_fetch_assoc($get_full_name);
                                    $first_name = $new_full_name['first_name'];
                                    $last_name = $new_full_name['last_name'];
                                    $full_name = $first_name . " " . $last_name;
                                ?>
                                    <tr>
                                        <td><?php echo $transction_id; ?></td>
                                        <!-- <td><?php //echo $reference_number; ?></td> -->
                                        <!-- <td><?php //echo $transcations['created_at']; ?></td> -->
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $transcations['phone_number']; ?></td>
                                        <td><?php echo $transcations['updated_at']; ?></td>
                                        <td><?php echo '₱' . number_format($transcations['amount'], 2); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Cash in -->


            <!-- Cash out -->
            <?php
            $cash_in_transaction = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t  JOIN accounts a ON a.id = t.account_id WHERE t.account_id = '$user_id' AND kind = 'cashout' ORDER BY created_at DESC ");
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Cash Out</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="cashOutTransactions">
                            <thead>
                                <tr>
                                    <th>Control ID</th>
                                    <th>Reference Number</th>
                                    <th>Date Initiated</th>
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Date Completed</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($transcations = $cash_in_transaction->fetch_assoc()) {
                                    $transction_id = $transcations["transaction_id"];

                                    $reference_number = "";
                                    $created_at = $transcations['created_at'];
                                    $timestamp = strtotime($created_at);
                                    $new_date_format = date('Ymd', $timestamp);
                                    $reference_number = $new_date_format . "00" . $transction_id;



                                    $get_full_name = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t JOIN accounts a ON a.id = t.vendor_id WHERE t.id = '$transction_id' ");
                                    $new_full_name = mysqli_fetch_assoc($get_full_name);
                                    $first_name = $new_full_name['first_name'];
                                    $last_name = $new_full_name['last_name'];
                                    $full_name = $first_name . " " . $last_name;
                                ?>
                                    <tr>
                                        <td><?php echo $transction_id; ?></td>
                                        <td><?php echo $reference_number; ?></td>
                                        <td><?php echo $transcations['created_at']; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $transcations['phone_number']; ?></td>
                                        <td><?php echo $transcations['updated_at']; ?></td>
                                        <td><?php echo '₱' . number_format($transcations['amount'], 2); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Cash in -->



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- JS here -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#indexTransactionTable').DataTable({
                "pageLength": 25
            });
        });
        $(document).ready(function() {
            $('#studentTab').DataTable({
                "pageLength": 25
            });
        });
        $(document).ready(function() {
            $('#cashInTransactions').DataTable({
                "pageLength": 25
            });
        });

        $(document).ready(function() {
            $('#cashInOutTransactions').DataTable({
                "pageLength": 25
            });
        });

        $(document).ready(function() {
            $('#cashOutTransactions').DataTable({
                "pageLength": 25
            });
        });
    </script>
    <?php
    include('footer.php');
    ?>