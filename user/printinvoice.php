<?php
session_start();
include_once '../dbconnection.php';
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>

    <link rel="icon" type="image/png" href="assets/img/logoo.jpg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    @media (min-width: 260px) and (max-width: 780px) {
        #invoice {
            margin-top: 0px !important;
            width: 55% !important;
        }
    }

    .page-wrapper {
        margin-left: 0px !important;
        padding-top: 60px;
        position: relative;
        transition: all .4s ease;
        margin-top: -68px;
    }
</style>

<body>
    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Customer Bill</h3>
                            <ul class="breadcrumb">

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body" id="printSection">
                                <form action="a.php" method="post" enctype="multipart/form-data">
                                    <?php
                                    include '../dbconnection.php';
                                    $sql = "SELECT * FROM addshop ORDER BY addshop.id ASC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 style="text-align:center;">Invoice</h5>
                                                    <h2
                                                        style="text-align:center; color:#d50a0a;font-weight: 600; font-size: 40px;">
                                                        <?php echo $row["shopname"]; ?>
                                                    </h2>
                                                    <div class="col-12 text-right">
                                                        <p>Email: <?php echo $row["email"]; ?></p>
                                                        <p>Contact Us: <?php echo $row["number"]; ?></p>
                                                        <p>Address: <?php echo $row["address"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-left" style="margin-top: -126px;">
                                                    <img src="../admin/image/<?php echo $row["image"]; ?>" alt="Logo"
                                                        style="width: 24%;">
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo "No Data In Database";
                                    }
                                    ?>
                                    <div class="col-12">
                                        <p>Date: <?php echo date('d/m/y'); ?></p>
                                        <h4 style="background: #37377e; color: #fff; padding: 4px 23px;">Customer
                                            Information</h4>
                                        <hr>
                                    </div>

                                    <?php
                                    include '../dbconnection.php';
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM customers WHERE id='$id'";
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    ?>

                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div style="display:flex;">
                                        <div class="col-6">
                                            <p><strong>First Name:</strong> <?php echo $row["first_name"]; ?></p>
                                        </div>

                                        <div class="col-6">
                                            <p><strong>Last Name:</strong> <?php echo $row["last_name"]; ?></p>
                                        </div>
                                    </div>
                                    <div style="display:flex;">
                                        <div class="col-6">
                                            <p><strong>Email:</strong> <?php echo $row["email"]; ?></p>
                                        </div>

                                        <div class="col-6">
                                            <p><strong>Mobile:</strong> <?php echo $row["mobile_number"]; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p><strong>Address:</strong> <?php echo $row["address"]; ?></p>
                                    </div>

                                    <div class="col-12">
                                        <h4 style="background: #37377e; color: #fff; padding: 4px 23px;">Device
                                            Information</h4>
                                        <hr>
                                    </div>
                                    <div style="display:flex;">
                                        <div class="col-6">
                                            <p><strong>Brand:</strong> <?php echo $row["device_brand"]; ?></p>
                                        </div>

                                        <div class="col-6">
                                            <p><strong>Model:</strong> <?php echo $row["device_model"]; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p><strong>IMEI:</strong> <?php echo $row["imei_number"]; ?></p>
                                    </div>

                                    <div class="col-12">
                                        <h4 style="background: #37377e; color: #fff; padding: 4px 23px;">Repair
                                            Information</h4>
                                        <hr>
                                    </div>

                                    <div class="col-12">
                                        <p><strong>Problem Descriptions:</strong></p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Problem Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql_problem = "SELECT problem_description FROM customer_problem WHERE customer_id = " . intval($row['id']);
                                                $result_problem = $conn->query($sql_problem);
                                                if ($result_problem) {
                                                    if ($result_problem->num_rows > 0) {
                                                        $srno = 1;
                                                        while ($problem_row = $result_problem->fetch_assoc()) {
                                                            echo '<tr>';
                                                            echo '<td>' . $srno . '</td>';
                                                            echo '<td>' . htmlspecialchars($problem_row['problem_description']) . '</td>';
                                                            echo '</tr>';
                                                            $srno++;
                                                        }
                                                    } else {
                                                        echo '<tr><td colspan="2">No Problems Reported</td></tr>';
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="2">Error fetching problem descriptions: ' . htmlspecialchars($conn->error) . '</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="display:flex;">
                                    <div class="col-6">
                                        <p><strong>Repair Status:</strong>
                                            <?php echo htmlspecialchars($row["repair_status"]); ?></p>
                                    </div>

                                    <div class="col-6">
                                        <p><strong>Warranty:</strong>
                                            <?php echo htmlspecialchars($row["repair_warranty"]); ?></p>
                                    </div>
</div>
<div style="display:flex;">
                                    <div class="col-6">
                                        <p><strong>Technician Assigned:</strong>
                                            <?php
                                            if (!empty($row['technician_assigned'])) {
                                                $tech_sql = "SELECT * FROM technician WHERE id='" . $row['technician_assigned'] . "'";
                                                $tech_result = $conn->query($tech_sql);

                                                if ($tech_result && $tech_result->num_rows > 0) {
                                                    $tech_row = $tech_result->fetch_assoc();
                                                    echo htmlspecialchars($tech_row["catogery"]);
                                                } else {
                                                    echo "Technician not found";
                                                }
                                            } else {
                                                echo "No technician assigned";
                                            }
                                            ?>
                                        </p>
                                    </div>

                                    <div class="col-6">
                                        <p><strong>Estimated Cost:</strong> ₹
                                            <?php echo htmlspecialchars($row["repair_cost_estimate"]); ?>
                                        </p>
                                    </div>
</div>
                                    <div class="col-12">
                                        <h3
                                            style="width: 29%; border: 1px solid; padding: 10px 10px; font-size: 22px; background: #d50a0a; color: #fff;">
                                            <strong>Total Cost:</strong> ₹
                                            <?php echo htmlspecialchars($row["repair_cost_estimate"]); ?>
                                        </h3>
                                        <hr>
                                    </div>

                                    <div class="col-12" style="margin-top: 50px; font-size: 14px;">
                                    <?php
                                    include '../dbconnection.php';
                                    $sql = "SELECT * FROM addshop ORDER BY addshop.id ASC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                        <ul>
                                            <li style="margin-bottom: 12px;"><strong>Shop Description:</strong>
                                            <?php echo htmlspecialchars($row["shop_discription"]); ?></li>
                                        </li>
                                            
                                               
                                            <li style="margin-bottom: 12px;"><strong>Shop Policie:</strong> 
                                             <?php echo htmlspecialchars($row["shop_policies"]); ?></li>
                                             
                                        </ul>
                                        <?php
                                        }
                                    } else {
                                        echo "No Data In Database";
                                    }
                                    ?>
                                    </div>



                            </div>
                            </form>

                        </div>

                        <!-- CSS for print -->
                        <style>
                            @media print {
                                body * {
                                    visibility: hidden;
                                }

                                #printSection,
                                #printSection * {
                                    visibility: visible;
                                }

                                #printSection {
                                    position: absolute;
                                    left: 0;
                                    top: 0;
                                }
                            }
                        </style>


                    </div>
                </div>
            </div>

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