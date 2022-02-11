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
$getCashOutTransaction = mysqli_query($mysqli, "SELECT * FROM cash_out");

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
                    <h6 class="m-0 font-weight-bold text-primary">List of Vendor's Cashout Request</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                    <th>Reject</th>
                                    <th>Approve</th>
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
                                            <?php } else if($newCashOutTransaction["completed"] == 1) { ?>
                                                <span style="color: green;">COMPLETED</span>
                                            <?php } else {?>
                                                <span style="color: red;">REJECTED</span>
                                            <?php } ?>
                                        </td>
                                        <td>

                                        <!-- Dropdown for Rejection -->
                                        <button class="btn btn-danger btn-secondary dropdown-toggle btn-sm mb-1" type="button" id="dropDownReject" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php if($newCashOutTransaction['completed']==1 || $newCashOutTransaction['completed']==2){echo "disabled";} ?> >
                                            <i class="far fa-trash-alt"></i> Reject
                                        </button>
                                        <div class="dropdown-menu p-1" aria-labelledby="dropDownReject btn-sm">
                                            Are you sure you want to reject? You cannot undo the changes<br/>
                                            <a href="process_cashout.php?reject=<?php echo $newCashOutTransaction['id'] ?>" class='btn btn-danger btn-sm'>
                                                <i class="far fa-trash-alt"></i> Confirm Reject
                                            </a>
                                            <a href="#" class='btn btn-success btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                                        </div>

                                        </td>
                                        <td>

                                        <!-- Dropdown for Approval -->
                                        <button class="btn btn-success btn-secondary dropdown-toggle btn-sm mb-1" type="button" id="dropdownApproveButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php if($newCashOutTransaction['completed']==1 || $newCashOutTransaction['completed']==2){echo "disabled";} ?> >
                                            <i class="far fa-trash-alt"></i> Approve
                                        </button>
                                        <div class="dropdown-menu p-1" aria-labelledby="dropdownApproveButton btn-sm">
                                            Are you sure you want to approve? You cannot undo the changes<br/>
                                            <a href="process_cashout.php?approve=<?php echo $newCashOutTransaction['id'] ?>" class='btn btn-success btn-sm'>
                                                <i class="far fa-trash-alt"></i> Confirm Approval
                                            </a>
                                            <a href="#" class='btn btn-warning btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                                        </div>

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