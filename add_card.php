<?php
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
} else {
    header("location: users.php");
}

include("process_card.php");
include('sidebar.php');
$users = mysqli_query($mysqli, "SELECT * FROM accounts WHERE id = '$student_id' ");
$user = $users->fetch_array();
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

            <!-- Notification here -->
            <?php
            if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>
            <!-- End Notification -->

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Add Card</h1>
            </div>


            <!-- End Student Record -->

            <!-- Enroll a card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Card for <?php echo $user["first_name"] . " " . $user["last_name"]; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="process_card.php" method="post">
                            <div class="row m-1">
                                <div class="col-xl-12">
                                    To enroll, make sure that the cursor is in the field below. Then simply tap the card. The registration will take place automatically.
                                    <br>
                                    <input type="number" class="form-control" name="tag_number" id="tag_number" required>
                                </div>
                                <input type="text" style="visibility: hidden;" name="user_id" id="user_id" value="<?php echo $student_id; ?>">
                                <div class="col-md-12 text-end">
                                    <button class="btn btn-info" type="submit" name="save_rfid"><i class="far fa-save"></i> Enroll Card</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Enroll a card -->


            <!-- List of Cards-->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Cards <?php echo $user["first_name"] . " " . $user["last_name"]; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $cards =  mysqli_query($mysqli, "SELECT *
                            FROM cards
                            WHERE user_id = '$student_id' AND
                            deleted = '0' ");
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>ID Tag</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                while ($card = mysqli_fetch_array($cards)) {
                                    $counter++;
                                ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $card['tag_number']; ?></td>
                                        <td><?php echo $card['created_at']; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu shadow-info">
                                                <button class="dropdown-item" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete</button>
                                                <div class="dropdown-menu shadow-danger mb-1">
                                                    <span class="dropdown-item">This card will be deleted permanently and you cannot undo the changes. Confirm Deletion?</span>
                                                    <a class="dropdown-item text-info" href="#">Cancel</a>
                                                    <a class="dropdown-item text-danger" href="process_card.php?delete_card=<?php echo $card['id'] . '&user_id=' . $current_user; ?>">Confirm Delete</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- List of Cards -->


            <!-- List of Cards-->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manual Cash in</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="process_card.php" method="post">
                            <div class="row m-1">
                                <div class="col-xl-12">
                                    To manually cash in, please enter the desired amount. This is manual cashin.
                                    <br>
                                    <input type="number" step="0.001" class="form-control" name="amount" id="amount" required>
                                </div>
                                <input type="text" style="visibility: hidden;" name="user_id" id="user_id" value="<?php echo $student_id; ?>">
                                <div class="col-md-12">
                                    <center>
                                    <button class="btn btn-info btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Add Balance
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton btn-sm">
                                        Please check the amount if it is correct.<br />
                                        <a href="#" class='btn btn-danger btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                                        <button type="submit" class='btn btn-success btn-sm' name="add_balance">Confirm Amount</a>
                                    </div>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- List of Cards -->


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