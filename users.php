<?php
require_once("process_users.php");
include('sidebar.php');
//Get current URI
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

$session_user_id = $_SESSION['user_id'];
$users = mysqli_query($mysqli, "SELECT *, u.id AS user_id
    FROM accounts u
    JOIN role r
    ON r.id = u.role_id");

//Get role
$global_role_id = $_SESSION['role'];
?>

<title>SPCF Cashless - Users</title>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("topbar.php"); ?>
                <!-- End of Topbar -->

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
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>
                    <p class="mb-4"></p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add / Edit Users</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="process_users.php">
                                <div class="row">

                                    <!-- First Name -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    First Name</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <input type="text" class="form-control" name="fname" value="<?php if (isset($_GET['edit'])) {
                                                                                                                    echo $edit_user['first_name'];
                                                                                                                } else if (isset($_GET['fname'])) {
                                                                                                                    echo $_GET['fname'];
                                                                                                                } ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Last Name</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <input type="text" class="form-control" name="lname" value="<?php if (isset($_GET['edit'])) {
                                                                                                                    echo $edit_user['last_name'];
                                                                                                                } else if (isset($_GET['lname'])) {
                                                                                                                    echo $_GET['lname'];
                                                                                                                } ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Email Address
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <input type="email" class="form-control" name="email" value="<?php if (isset($_GET['edit'])) {
                                                                                                                        echo $edit_user['email'];
                                                                                                                    } else if (isset($_GET['email'])) {
                                                                                                                        echo $_GET['email'];
                                                                                                                    } ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Phone Number
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <input type="number" maxlength="11" value="09000000000" class="form-control" name="phone_number" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                                                echo $edit_user['phone_number'];
                                                                                                                                                            } else if (isset($_GET['phone_number'])) {
                                                                                                                                                                echo $_GET['phone_number'];
                                                                                                                                                            } ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Role -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Role
                                                </div>
                                                <?php if ($_SESSION["role"] == 1) { ?>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php if (isset($_GET['edit'])) { ?>
                                                            <input type="text" class="form-control" id="password" name="role" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                            echo strtoupper($edit_user['code']);
                                                                                                                                        } ?>" readonly>
                                                        <?php } else { ?>
                                                            <select name="role" class="form-control" required>
                                                                <option value="" disabled selected>Role:</option>
                                                                <option value="1">Admin</option>
                                                                <option value="2">Student</option>
                                                                <option value="3">Vendor</option>
                                                            </select>
                                                        <?php } ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <select name="role" class="form-control">
                                                        <option value="2" selected>Student</option>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (isset($_GET['edit'])) {
                                    } else {  ?>
                                        <!-- Password -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Password
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <input type="password" class="form-control" id="password" name="password" onkeyup='check();' required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Confirm Password
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" onkeyup='check();' required>
                                                        <button disabled id="password-message" class="btn btn-block"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- Submit Form -->
                                    <div class="col-xl-12 col-md-6 mb-4">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <?php if (isset($_GET['edit'])) { ?>
                                                    <input type="text" name="user_id" value="<?php echo $_GET['edit']; ?>" style="visibility: hidden;">
                                                    <button type="submit" class="btn btn-primary btn-sm float-right mr-1" name="update"><i class="far fa-save"></i> Update User</button>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-primary btn-sm float-right mr-1" name="save" id="save"><i class="far fa-save"></i> Create User</button>
                                                <?php } ?>
                                                <a href="users.php" id="refresh" class='float-right btn-sm btn btn-danger mr-1'><i class="fas as fa-sync"></i> Clear/Refresh</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Users Table -->

                    <?php
                    $roles =  mysqli_query($mysqli, "SELECT * FROM role");
                    while ($newRole = mysqli_fetch_array($roles)) {
                        $roleId = $newRole["id"];
                        $users = mysqli_query($mysqli, "SELECT *, u.id AS user_id
                        FROM accounts u
                        JOIN role r
                        ON r.id = u.role_id WHERE r.id = '$roleId' ");
                    ?>
                        <div class="card shadow mb-4" style="display: <?php if ($role == 3 and $newRole["id"] != 2) {
                                                                            echo 'none';
                                                                        } ?>;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">List of Users - <?php echo ucfirst($newRole["code"]); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="<?php echo $newRole['code']; ?>Table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Phone Number</th>
                                                <th>Role</th>
                                                <th>Validated</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Phone Number</th>
                                                <th>Role</th>
                                                <th>Validated</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php while ($user = mysqli_fetch_array($users)) {
                                                $approved = boolval($user["validated"]);
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo ucfirst($user["first_name"]) . " " . ucfirst($user["last_name"]); ?>
                                                    </td>
                                                    <td><?php echo $user["email"]; ?></td>
                                                    <td><?php echo $user["phone_number"]; ?></td>
                                                    <td><?php echo ucfirst($user["code"]); ?></td>
                                                    <td><?php if ($approved) {
                                                        ?><span class="badge bg-success text-white">Validated</span><?php
                                                                                                        } else { ?> <span class="badge bg-warning text-white">Pending</span> <?php } ?></td>
                                                    <td>
                                                        <!-- Edit-->
                                                        <a href="users.php?edit=<?php echo $user['user_id']; ?>" class="btn btn-info btn-sm"><i class="far fa-edit"></i> Edit</a>
                                                        <?php if (!$approved) { ?>
                                                            <a href="process_users.php?validate=<?php echo $user['user_id']; ?>" class="btn btn-success btn-sm">
                                                                <i class="far fa-check-square"></i> Validate
                                                            </a>
                                                        <?php } ?>
                                                        
                                                        <!-- Associate RFID Card here -->
                                                        <?php if($newRole["id"] == 2){ ?>
                                                            <a href="add_card.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Card / Add Balance</a>
                                                        <?php } ?>
                                                        <!-- Start Drop down Delete here -->
                                                        <button style="display: <?php if ($user["role_id"] == $global_role_id) { echo "none"; } ?>" class="btn btn-danger btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="<?php if ($session_user_id == $user['user_id']) {
                                                                                                                                                                                                                                                echo 'display: none;';
                                                                                                                                                                                                                                            } ?>">
                                                            <i class="far fa-trash-alt"></i> Delete
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton btn-sm">
                                                            You sure you want to delete? You cannot undo the changes<br />
                                                            <a href="#" class='btn btn-success btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                                                            <a href="process_users.php?delete=<?php echo $user['user_id'] ?>" class='btn btn-danger btn-sm'><i class="far fa-trash-alt"></i> Confirm Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            

            <!-- Start scripts here -->
            <script>
                let check = function() {
                    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
                        document.getElementById('password-message').style.color = 'green';
                        document.getElementById('password-message').innerHTML = 'Passwords matched';
                        document.getElementById("save").disabled = false;
                    } else {
                        document.getElementById('password-message').style.color = 'red';
                        document.getElementById('password-message').innerHTML = 'Passwords do not match!';
                        document.getElementById("save").disabled = true;
                    }
                }

                $(document).ready(function() {
                    $('#adminTable').DataTable({
                        "order": [
                            [0, "desc"]
                        ]
                    });
                    $('#studentTable').DataTable({
                        "order": [
                            [0, "desc"]
                        ]
                    });
                    $('#vendorTable').DataTable({
                        "order": [
                            [0, "desc"]
                        ]
                    });
                });
            </script>
            <?php include("footer.php"); ?>