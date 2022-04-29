<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}

if($_SESSION['role'] == "2"){
    header("location: ./student/index.php");
}
else if($_SESSION['role'] == "3"){
    header("location: ./vendors/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="img/logo.png" type="image/gif" sizes="16x16">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <!-- required libraries -->
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <!-- For Exporting -->
    <style>
        html {
            font-size: 0.9rem;
            scroll-behavior: smooth !important;
        }

        .bg-gradient-primary {
            background-color: #142567 !important;
            background-image: none !important;
            background-image: none !important;
            background-size: cover !important;
        }

        ::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            opacity: 0.7 !important;
            /* Firefox */
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                SPCF - Cashless
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Devices -->
            <li class="nav-item" style="display: none;">
                <a class="nav-link" href="inventory.php">
                    <i class="fas fa-laptop"></i>
                    <span>Inventory</span></a>
            </li>

            <!-- Nav Item - Users -->
            <li class="nav-item" style="display: <?php if($_SESSION['role']==3){echo "none;";} ?>;">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>

            <li class="nav-item" style="display: <?php if($_SESSION['role']==3){echo "none;";} ?>;">
                <a class="nav-link" href="all_transactions.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cash In and Cash Out Transactions</span></a>
            </li>

            <!-- Nav Item - Transactions -->
            <li class="nav-item" style="display: none;">
                <a class="nav-link" href="transactions.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Transactions</span></a>
            </li>


            <!-- Nav Item - Cashout -->
            <li class="nav-item" style="display: <?php if($_SESSION['role']==3){echo "none;";} ?>;">
                <a class="nav-link" href="cashout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    <span>Cashout Requests</span></a>
            </li>

            <!-- Nav Item - Cashout -->
            <li class="nav-item" style="display: none;">
                <a class="nav-link" href="cashout_initiate.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    <span>Initiate Cashout</span></a>
            </li>

            <!-- Nav Item - Reports -->
            <li class="nav-item">
                <a class="nav-link" href="report.php">
                <i class="fas fa-fw fa-table"></i>
                    <span>Sales Report</span>
            </li>



            <!-- Nav Item - Reports -->
            <li class="nav-item" style="display: none">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Reports</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Type:</h6>
                        <a class="collapse-item" href="report.php"><i class="fas fa-fw fa-table"></i> Daily Sales Report</a>
                        <a class="collapse-item" href="report_earnings.php"><i class="fas fa-fw fa-table"></i> DSR with Earnings</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Accounts -->
            <li class="nav-item" style="display: none;">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Accounts</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline" style="display: none ;">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->

        </ul>
        <!-- End of Sidebar -->