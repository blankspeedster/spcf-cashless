<?php
require_once 'process_inventory.php';

include('sidebar.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI . '?';

$user_id = $_SESSION['user_id'];

$getLastTransaction = mysqli_query($mysqli, "SELECT * FROM transaction ");
$getTransaction = mysqli_query($mysqli, "SELECT * FROM transaction WHERE vendor_id = '$user_id' ORDER BY transaction_date DESC LIMIT 10");

$lastTransactionID = 0;
while ($newLastTransaction = mysqli_fetch_array($getLastTransaction)) {
    $lastTransactionID = $newLastTransaction['id'];
}

if (!isset($_GET['itemCtrl'])) {
    $itemCtrl = 1;
} else {
    $itemCtrl = $_GET['itemCtrl'];
}


if (!isset($_GET['itemBarCodeCtrl'])) {
    $itemBarCodeCtrl = 0;
} else {
    $itemBarCodeCtrl = $_GET['itemBarCodeCtrl'];
}

?>
<title>Transactions - SPCF - Cashless Program</title>

<!-- Live Search -->

<!-- Latest compiled and minified JavaScript -->
<script src="libs/bootstrap-select.min.js"></script>

<script>
    $(function () {
        // $('select').selectpicker();
    });
</script>

<!-- CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/bootstrap-select.min.css" rel="stylesheet" />

<!--Vue Support-->
<script src="../js/vue/vue.min.js"></script>

<!-- Axios -->
<script src="../js/vue/axios.min.js"></script>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php
        include('topbar.php');
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid" id="vueApp">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
            </div>

            <!-- Alert here -->
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['errors'])) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['errors'];
                    unset($_SESSION['errors']);
                    ?>
                </div>
            <?php endif ?>
            <!-- End Alert here -->

            <!-- Alert here -->
            <div v-if="showWarning" class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ alertMessage }}
            </div>
            <!-- End Alert here -->



            <!-- Add Transaction -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add to Cart</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form name="transactionForm" id="transactionForm" method="post" action="process_transaction.php" @submit.prevent="checkAccountBalance">
                            <!-- <table id="table_items_barcode" class="table" style="display: none;">
                                <thead>
                                    <tr>
                                        <th width="10%"></th>
                                        <th width="35%">Barcode</th>
                                        <th width="25%">Quantity</th>
                                        <th width="15%">Price</th>
                                        <th width="15%">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <input type="hidden" class='_input_id' value="">
                                            <div class='d-flex justify-content-center align-items-center border-none'>
                                                <button type="button" class="btn btn-success btn-sm _btn_add_item" disabled>Add Item</button>
                                            </div>
                                        </td>
                                        <td>
                                            <input list="item_barcodes" class="form-control _input_barcode" value="" placeholder="Barcode">
                                            <datalist id="item_barcodes">
                                                <?php
                                                $items = mysqli_query($mysqli, "SELECT barcode FROM inventory");
                                                ?>
                                                <?php while ($item = $items->fetch_assoc()) : ?>
                                                    <option value="<?= $item['barcode'] ?>">
                                                        <?= $item['barcode'] ?>
                                                    </option>
                                                <?php endwhile ?>
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control _input_quantity" value="0" placeholder="0" disabled>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control _input_price" value="0" step="0.0001" placeholder="0.00" readonly>
                                        </td>
                                        <td><input class="form-control _input_subtotal" value="0" readonly></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <span class="float-right"><b>TOTAL: ₱ <span id="total_amount_barcode">0.00</span></b></span>
                            <br>
                            <br>
                            <br>
                            <br> -->
                            <table id="table_items" class="table">
                                <thead>
                                    <tr>
                                        <th width="10%"></th>
                                        <th width="35%">Item</th>
                                        <th width="25%">Quantity</th>
                                        <th width="15%">Price</th>
                                        <th width="15%">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <input type="hidden" class='_input_id' value="">
                                            <div class='d-flex justify-content-center align-items-center border-none'>
                                                <button type="button" class="btn btn-success btn-sm _btn_add_item" disabled>Add Item</button>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Items using select -->
                                            <select class="form-control select-picker _select_item" data-live-search="true">
                                                <option selected disabled>
                                                    Select Item
                                                </option>
                                                <?php
                                                $getItemForAdding = mysqli_query($mysqli, "SELECT * FROM inventory WHERE vendor_id = '$user_id' ");
                                                ?>
                                                <?php while ($newItemsForAdding = $getItemForAdding->fetch_assoc()) : ?>
                                                    <option data-tokens="<?php echo strtoupper($newItemsForAdding['item_name']); ?>" class="" value="<?php echo $newItemsForAdding['id']; ?>">
                                                        <?php echo strtoupper($newItemsForAdding['item_code'] . ' - ' . $newItemsForAdding['item_name']); ?>
                                                    </option>
                                                <?php endwhile ?>
                                            </select>

                                        </td>
                                        <td>
                                            <input type="number" class="form-control _input_quantity" value="0" placeholder="0" disabled>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control _input_price" value="0" step="0.0001" placeholder="0.00" readonly>
                                        </td>
                                        <td><input class="form-control _input_subtotal" name="subTotal" value="0" readonly></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <span class="float-right"><b>TOTAL: ₱ <span id="total_amount">0.00</span></b></span>
                            <br>
                            <br>
                            <!-- <hr>
                            <div class="text-right font-weight-bold">
                                GRAND TOTAL : ₱ <span id="grand_total">0.00</span>
                            </div> -->
                            <br>
                            <br>
                            <!-- <table class="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%;">Control ID</th>
                                        <th width="">Full Name</th>
                                        <th width="">Address</th>
                                        <th width="">Phone Number</th>
                                        <th width="">Amount Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" name="transactionID" value="<?php //echo ++$lastTransactionID; ?>" readonly></td>
                                        <td><input type="text" class="form-control" name="full_name" placeholder="ex: Juan Crus" value="Juan Cruz"></td>
                                        <td>
                                            <textarea class="form-control" name="address" style="min-height: 100px;">Angeles City</textarea>
                                        </td>
                                        <td><input type="text" class="form-control" name="phone_num" placeholder="ex: 04876494843" value="09090912098"></td>
                                        <td><input type="number" step="0.01" class="form-control" name="amount_paid" required></td>
                                    </tr>
                                </tbody>
                            </table> -->
                            Put the cursor here and tap the RFID to initiate the transaction
                            <input type="password" class="form-control" v-model="rfid" name="rfid" value="">
                            <br/>
                            <center>
                                <input type="text" class="form-control" name="transactionID" value="<?php echo ++$lastTransactionID; ?>" readonly style="visibility: hidden;">
                                <button class="btn btn-sm btn-primary m-1" name="save"><i class="far fa-save"></i> Confirm Transaction</button>
                                <a href="transactions.php" class="btn btn-danger btn-sm m-1"><i class="fas as fa-sync"></i> Cancel</a>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Transaction -->

            <!-- List of Transactions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Transactions</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="transactionTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Control ID</th>
                                    <th>Full Name</th>
                                    <th>Phone Num</th>
                                    <th>Total Amount</th>
                                    <th>Total Paid</th>
                                    <th style="display: none;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($newTransaction = $getTransaction->fetch_assoc()) {
                                    $balance = $newTransaction['amount_paid'] - $newTransaction['total_amount'];
                                ?>
                                    <tr>
                                        <td><?php echo $newTransaction['transaction_date']; ?></td>
                                        <td><a href="view_transaction.php?id=<?php echo $newTransaction['id']; ?>" target="_blank"><?php echo $newTransaction['id']; ?></a></td>
                                        <td><a href="view_transaction.php?id=<?php echo $newTransaction['id']; ?>" target="_blank"><?php echo $newTransaction['full_name']; ?></a></td>
                                        <td><?php echo $newTransaction['phone_num']; ?></td>
                                        <td><?php echo '₱' . number_format($newTransaction['total_amount'], 2); ?></td>
                                        <td><?php echo '₱' . number_format($newTransaction['amount_paid'], 2); ?></td>
                                        <td style="display: none;">
                                            <!-- Start Drop down Delete here -->
                                            <button class="btn btn-danger btn-secondary dropdown-toggle btn-sm mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="far fa-trash-alt"></i> Delete
                                            </button>
                                            <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton btn-sm">
                                                Are you sure you want to delete? You cannot undo the changes<br />
                                                <a href="process_transaction.php?delete=<?php echo $newTransaction['id']; ?>" class='btn btn-danger btn-sm'>
                                                    <i class="far fa-trash-alt"></i> Confirm Delete
                                                </a>
                                                <a href="#" class='btn btn-success btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- End Item Transactions -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- JS here -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#transactionTable').DataTable({
                "pageLength": 25
            });
        });
    </script>

    <!-- JS here -->
    <script type="text/javascript">
        $(function() {
            $('.selectpicker').selectpicker();
        });
    </script>




    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; SPCF - Cashless Program <?php echo date("Y"); ?></span>
                <br>
                <br>
                <img src="../img/logo.png" style="width: 50px;">
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-sm btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    new Vue({
        el: "#vueApp",
        data() {
            return {
                rfid: null,
                showWarning: false,
                alertMessage: "",
            }
        },
        methods: {
            async checkAccountBalance(){
                console.log('Check Balance!');
                const totalItem = localStorage.getItem("totalItem");
                const options = {
                    method: "POST",
                    url: "process_card.php?checkAccountBalance="+this.rfid+"&currentTotal="+totalItem,
                    headers: {
                        Accept: "application/json",
                    },
                };
                await axios
                    .request(options)
                    .then((response) => {
                        console.log(response.data);
                        if(response.data.code === '2'){
                            document.getElementById("transactionForm").submit();
                        }
                        else{
                            this.showWarning = true;
                            this.alertMessage = response.data.message;
                        }
                    })
                    .catch((error) => {
                    });
                // document.getElementById("transactionForm").submit();
            }
        },
        mounted() {
            console.log("Vue!");
            localStorage.setItem("totalItem",0);
        }
    });
</script>
<!-- Page Behaviour -->
<script src="../transaction_page.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Selector with search -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-select.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/datatables-demo.js"></script>



<style type="text/css">
    html {
        /* font-family: 'Roboto Condensed', sans-serif !important; */
        font-size: 0.9rem;
        scroll-behavior: smooth !important;
    }
</style>
</body>

</html>