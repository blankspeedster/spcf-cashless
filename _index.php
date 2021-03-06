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
                <h1 class="h3 mb-0 text-gray-800">Dashboard Accounting Office</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Total Balance -->
                <?php
                    $getBalance = mysqli_query($mysqli, "SELECT * FROM accounts WHERE id =  '$user_id' ");
                    $newBalance = mysqli_fetch_array($getBalance);
                    $balance = $newBalance["balance"];
                ?>
                <div class="col-xl-4 col-md6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Total Balance:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo "P ".number_format($balance, 2); ?>
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
                <!-- End Total Balance -->

            <!-- Total Transactions -->
                <div class="col-xl-4 col-md6 mb-4" style="display: none;"> 
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Total Transactions:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $newTotalTransactions['id']; ?>
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
                <!-- Total Transactions -->

                <!-- Total Sales -->
                <div class="col-xl-4 col-md6 mb-4" style="display: none;">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Total Sales Today:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        ???<?php echo number_format($newTotalTransactionsToday['total_amount_paid'],2); ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-exchange-alt fa-5x text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Sales -->

                <!-- Items in Stock -->
                <div class="col-xl-4 col-md6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Items Low in Stock:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $newInventoryInStock['id']; ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-5x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Items in Stock -->

                <!-- Total Expenses -->
                <div class="col-xl-4 col-md6 mb-4" style="display: none;">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Total Expenses:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo "P ".number_format($newTotalExpense['total_cost'],2); ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-5x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Expenses -->

                <!-- Total Earnings -->
                <div class="col-xl-4 col-md6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Total Earnings:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo "P ".number_format($newTotalEarnings['total_earnings'],2); ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-wave fa-5x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Total Balance -->
                <div class="col-xl-4 col-md6 mb-4" style="display: none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Total Balance in my account:
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo "P ".number_format($totalBalance['balance'],2); ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-wave fa-5x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Earnings -->

                <!-- Total Credit -->
                <div class="col-xl-4 col-md6 mb-4" style="display: none;">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Credit (Receivables):
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $grandTotal; ?>
                                    </div>
                                    <!-- End Progress -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-credit-card fa-5x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Credit -->

            </div>

            <!-- End Student Record -->

            <!-- Student Employees -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Customers</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="indexTransactionTable">
                            <thead>
                                <tr>
                                    <th>Control ID</th>
                                    <th>Date</th>
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Total Amount</th>
                                    <th>Total Paid</th>
                                    <!-- <th style="display: none;">Balance</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                    <?php while($newtAllTransactions = $getAllTransactions->fetch_assoc()){
                                    $balance = $newtAllTransactions['amount_paid'] - $newtAllTransactions['total_amount'];
                                    ?>
                                <tr>
                                    <td><a href="view_transaction.php?id=<?php echo $newtAllTransactions['id']; ?>" target="_blank"><?php echo $newtAllTransactions['id']; ?></a></td>
                                    <td><?php echo $newtAllTransactions['transaction_date']; ?></td>
                                    <td><a href="view_transaction.php?id=<?php echo $newtAllTransactions['id']; ?>" target="_blank"><?php echo $newtAllTransactions['full_name']; ?></a></td>
                                    <td><?php echo $newtAllTransactions['phone_num']; ?></td>
                                    <td><?php echo '???'.number_format($newtAllTransactions['total_amount'],2); ?></td>
                                    <td><?php echo '???'.number_format($newtAllTransactions['amount_paid'],2); ?></td>
                                    <!-- <td style="display: none; color: <?php if($balance<0){echo 'red';}else{echo 'green';} ?> ">
                                        <b><?php echo number_format($balance,2); ?></b>
                                    </td> -->
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Student Employees -->
            <?php
                $cash_in_transaction = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t  JOIN accounts a ON a.id = t.account_id WHERE t.account_id = '$user_id' ORDER BY created_at DESC ");
            ?>
            <!-- Transaction Logs -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Cash in and Cash out Transactions</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="cashInTransactions">
                            <thead>
                                <tr>
                                    <th>Control ID</th>
                                    <th>Date</th>
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Kind</th>
                                    <th>Total Amount</th>
                                    <th>Current Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        while($transcations = $cash_in_transaction->fetch_assoc()){
                                        $transction_id = $transcations["transaction_id"];
                                        $get_full_name = mysqli_query($mysqli, "SELECT *, t.id AS transaction_id FROM transaction_logs t JOIN accounts a ON a.id = t.vendor_id WHERE t.id = '$transction_id' ");
                                        $new_full_name = mysqli_fetch_assoc($get_full_name);
                                        $first_name = $new_full_name['first_name'];
                                        $last_name = $new_full_name['last_name'];
                                        $full_name = $first_name." ".$last_name;
                                    ?>
                                <tr>
                                    <td><?php echo $transction_id; ?></td>
                                    <td><?php echo $transcations['created_at']; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $transcations['phone_number']; ?></td>
                                    <td>
                                        <?php
                                        if($transcations['kind'] == 'cashin'){
                                            echo "<a style='color: green;'>".strtoupper($transcations['kind'])."</a>";
                                        }
                                        else{
                                            echo "<a style='color: red;'>".strtoupper($transcations['kind'])."</a>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo '???'.number_format($transcations['amount'],2); ?></td>
                                    <td><?php echo '???'.number_format($transcations['current_balance'],2); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Student Employees -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <!-- JS here -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#indexTransactionTable').DataTable( {
                "pageLength": 25
            } );
        } );
        $(document).ready(function() {
            $('#studentTab').DataTable( {
                "pageLength": 25
            } );
        } );    
        $(document).ready(function() {
            $('#cashInTransactions').DataTable( {
                "pageLength": 25
            } );
        } );        
    </script>
    <?php
    include('footer.php');
    ?>

