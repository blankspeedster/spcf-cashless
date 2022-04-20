<?php
require_once 'process_login.php';

if (isset($_SESSION['email'])) {
    header('location: index.php');
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    header("location: index.php");
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

    <title>SPCF - Cashless Program - Password Reset</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="icon" href="img/logo.png" sizes="16x16">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-gradient-primary {
            background-color: #0f1e5d !important;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(50%, #4e73df), to(#0f1e5d)) !important;
            background-image: linear-gradient(180deg, #4e73df 10%, #0f1e5d 100%) !important;
            background-size: cover !important;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <!-- Alert Here -->
            <?php
            if (isset($_SESSION['registerError'])) {
            ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['registerError'];
                    unset($_SESSION['registerError']);
                    ?>
                </div>
            <?php
            }
            ?>
            <!-- End Alert Here -->
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Password Reset</h1>
                            </div>
                            <form class="user" method="post" action="process_login.php">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control" id="exampleInputPassword" placeholder="Password" name="password1" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control" id="exampleRepeatPassword" placeholder="Repeat Password" name="password2" required>
                                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" name="new_password">
                                    Reset Password
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>