<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}
include_once '../dbconnection.php';
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>
    <link rel="shortcut icon" href="assets/img/logoo2.jpg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    @media (min-width: 260px) and (max-width: 780px) {
        #king{
            display: block !important;
        }
    }
</style>
<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                    <?php
        include_once '../dbconnection.php';

        $products_id = $_GET['id'];
        $sql = "SELECT * FROM addshop WHERE id=$products_id";
        $result = $conn->query($sql);
        $products = $result->fetch_assoc();
        ?>
                        <div class="col-sm-12">
                            <h3 class="page-title"><span style="color: #222f7e;"> <?php echo htmlspecialchars($products['shopname'], ENT_QUOTES); ?></span> All Customers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">View Customers</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="king" style="display: flex; justify-content: space-between;">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card bg-two" style="box-shadow: 6px 5px 13px #0000009c; border: aliceblue;">
                            <a href="view-pending.php?id=<?php echo $id ; ?>">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-icon">
                                            <i class="fas fa-hourglass-half"></i>
                                        </div>
                                        <div class="db-info">
                                            <?php include '../dbconnection.php';
                                            $id = $_GET['id'];
                                            $sql = "SELECT COUNT(id) FROM customers WHERE repair_status = 'Pending' AND shop_id = '$id'";
                                            $result = mysqli_query($conn, $sql);
                                            $rows = mysqli_fetch_row($result);
                                            ?>
                                            <h3 class="text-center"><?php echo $rows[0]; ?></h3>
                                            <h6>pending..</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card bg-three" style="box-shadow: 6px 5px 13px #0000009c; border: aliceblue;">
                            <a href="view-progess.php?id=<?php echo $id ; ?>">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-icon">
                                            <i class="fas fa-cog fa-spin"></i>
                                        </div>
                                        <div class="db-info">
                                            <?php include '../dbconnection.php';
                                            $id = $_GET['id'];
                                            $sql = "SELECT COUNT(id) FROM customers WHERE repair_status = 'in progress' AND shop_id = '$id' ";
                                            $result = mysqli_query($conn, $sql);
                                            $rows = mysqli_fetch_row($result);
                                            ?>
                                            <h3 class="text-center"><?php echo $rows[0]; ?></h3>
                                            <h6>In Progress</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card bg-four" style="box-shadow: 6px 5px 13px #0000009c; border: aliceblue;">
                            <a href="view-complete.php?id=<?php echo $id ; ?>">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="db-info">
                                            <?php include '../dbconnection.php';
                                              $id = $_GET['id'];
                                            $sql = "SELECT COUNT(id) FROM customers WHERE repair_status = 'completed' AND shop_id = '$id'";
                                            $result = mysqli_query($conn, $sql);
                                            $rows = mysqli_fetch_row($result);
                                            ?>
                                            <h3 class="text-center"><?php echo $rows[0]; ?></h3>
                                            <h6>Completed</h6>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>

<hr>
            </div>
           
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