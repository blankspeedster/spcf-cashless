<?php
include('sidebar.php');
include('dbh.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

$getTotalTransactions = mysqli_query($mysqli, "SELECT count(id) AS id FROM transaction WHERE DATE(`transaction_date`) = CURDATE()");
$newTotalTransactions = $getTotalTransactions->fetch_array();
//echo $newTotalTransactions['id'];

$date = date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

$getTotalTransactionsToday = mysqli_query($mysqli, "SELECT sum(amount_paid) AS total_amount_paid FROM transaction WHERE transaction_date = '$date' ");
$newTotalTransactionsToday = $getTotalTransactionsToday->fetch_array();

$getInventoryInStock = mysqli_query($mysqli, "SELECT count(id) AS id FROM inventory WHERE qty <= 10 ");
$newInventoryInStock = $getInventoryInStock->fetch_array();

$getAllTransactions = mysqli_query($mysqli, "SELECT * FROM transaction ORDER BY id DESC LIMIT 50");

$getTotalExpense = mysqli_query($mysqli, "SELECT sum(total_cost) AS total_cost FROM inventory_cost");
$newTotalExpense = $getTotalExpense->fetch_array();

$getTotalEarnings = mysqli_query($mysqli, "SELECT sum(amount_paid) AS total_earnings, sum(total_amount) AS grand_total FROM transaction WHERE DATE(`transaction_date`) = CURDATE()");
$newTotalEarnings = $getTotalEarnings->fetch_array();
$grandTotal = $newTotalEarnings['grand_total'] - $newTotalEarnings['total_earnings'];
$user_id = $_SESSION['user_id'];

//Get total balance of the vendor
$getTotalBalance = mysqli_query($mysqli, "SELECT * FROM accounts WHERE id = '$user_id' ");
$totalBalance = $getTotalBalance->fetch_array();
$newTotalBalance = $totalBalance['balance'];

//List of Cashout Request
$getCashOutTransaction = mysqli_query($mysqli, "SELECT * FROM cash_out WHERE vendor_id = '$user_id' ");

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
                <h1 class="h3 mb-0 text-gray-800">Cashout</h1>
            </div>

            <!-- End Student Record -->

            <!-- Student Employees -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of your Cashout Request</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="process_cashout.php">
                            <div class="row">

                                <div class="col-lg-6">
                                    <input class="form-control" type="number" name="amount" min="20" max="<?php echo  $newTotalBalance; ?>">
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" name="cashout" class="btn btn-sm btn-success m-2">Cash Out</button>
                                </div>

                            </div>
                        </form>
                        <br>
                        <table class="table table-bordered" id="indexTransactionTable">
                            <thead>
                                <tr>
                                    <th>Control ID</th>
                                    <th>Reference Number</th>
                                    <th>Amount</th>
                                    <th>Date Initiated</th>
                                    <th>Date Completed</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($newCashOutTransaction = $getCashOutTransaction->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $newCashOutTransaction["id"]; ?></td>
                                        <td><?php echo $newCashOutTransaction["reference_id"]; ?></td>
                                        <td><?php echo $newCashOutTransaction["amount"]; ?></td>
                                        <td><?php echo $newCashOutTransaction["date_initiated"]; ?></td>
                                        <td><?php if ($newCashOutTransaction["completed"] == 0) {
                                                echo "#NA";
                                            } else {
                                                echo $newCashOutTransaction["date_completed"];
                                            }
                                            ?>
                                        </td>
                                        <td><?php if ($newCashOutTransaction["completed"] == 0) {
                                            ?>
                                                <span style="color: orange;">PENDING</span>
                                            <?php } else if ($newCashOutTransaction["completed"] == 1) { ?>
                                                <span style="color: green;">COMPLETED</span>
                                            <?php } else { ?>
                                                <span style="color: red;">REJECTED</span>
                                            <?php } ?>
                                        </td>

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
            $('#indexTransactionTable').DataTable({
                "pageLength": 25
            });
        });
        $(document).ready(function() {
            $('#studentTab').DataTable({
                "pageLength": 25
            });
        });
    </script>
    <?php
    include('footer.php');
    ?>