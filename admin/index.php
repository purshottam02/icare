<?php
session_start();
if (empty($_SESSION['admin_session'])) {
header('Location:login.php');
}
include_once '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>
    <link rel="shortcut icon" href="assets/img/logoo2.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome <?php echo $_SESSION['admin_session']['username'] ?>!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card bg-one">
                        <a href="products.php">

                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-icon">
                                        <i class="fas fa-user-plus text-center"></i>
                                    </div>
                                    <div class="db-info">
                                        <?php include '../dbconnection.php';
                                        $sql = "SELECT COUNT(id) FROM addshop";
                                        $result = mysqli_query($conn, $sql);
                                        $rows = mysqli_fetch_row($result);
                                        ?>
                                        <h3 class="text-center "><?php echo $rows[0]; ?></h3>
                                        <h6>Total Shop</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                
            </div>
            <footer>
                <p>Copyright © 2024.</p>
            </footer>
        </div>
    </div>

<!-- Scripts  -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>