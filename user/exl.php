<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
    exit();
}
$sid = $_SESSION['user_session']['id'];

include '../dbconnection.php';
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
    <link rel="icon" type="image/png" href="uploads/logo/logo.jpg">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">

        <div class="page-wrapper" style="margin-left: 0px;">
            <div class="content container-fluid">
                <!-- <div class="page-header" style="background: aliceblue; padding: 16px 29px; border-radius: 5px;"> -->
                

                <style>
                    table {
                        border-collapse: collapse;
                        border-spacing: 0;
                        width: 100%;
                        border: 1px solid #ddd;
                    }

                    th,
                    td {
                        text-align: left;
                        padding: 8px;
                    }

                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
                </style>
         

            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-body" style="padding: 0px;">

                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 datatable" id="tblData">
                                    <div class="col-lg-4 d-flex justify-conten-between "
                                        style="border:0px solid; font-size:20px; text-align:right; float: right;">
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
                                        </script>
                                        <script>
                                            $(document).ready(function () {
                                                $("#myInput").on("keyup", function () {
                                                    var value = $(this).val().toLowerCase();
                                                    $("#tblData tr").filter(function () {
                                                        $(this).toggle($(this).text()
                                                            .toLowerCase().indexOf(value) >
                                                            -1)
                                                    });
                                                });
                                            });
                                        </script>

                                        <input id="myInput" type="text" placeholder="Search.." style="margin-bottom: 21px; margin-top: 21px; border: 1px solid #8080806b;
                                             padding: 5px 9px; font-size: 17px;">
                                              <div>
                                    <a href="export.php" class="btn btn-primary" style="    margin-top: 21px;
    margin-left: 41px;"> Export Data <i class="fas fa-download"></i></a>
                                    </div>
                                    </div>
                                   
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Device Brand</th>
                                            <th>Device Model</th>
                                            <th>IMEI Number</th>
                                            <th>Job No</th>
                                            <th>Serial Number</th>
                                            <th>Service Type</th>
                                            <th>Problem Description</th>
                                            <!-- <th>Repair Cost Estimate</th> -->
                                            <th>Repair Status</th>
                                            <th>Accessories</th>
                                            <th>Technician Assigned</th>
                                            <th>Repair Warranty</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../dbconnection.php';
                                        $sql = "SELECT * FROM customers where shop_id ='$sid' ORDER BY customers.id ASC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $srno = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td scope="row"><?= $srno ?></td>
                                                    <td><?php echo $row["first_name"]; ?></td>
                                                    <td><?php echo $row["last_name"]; ?></td>
                                                    <td><?php echo $row["email"]; ?></td>
                                                    <td><?php echo $row["mobile_number"]; ?></td>
                                                    <td><?php echo $row["address"]; ?></td>
                                                    <td><?php echo $row["device_brand"]; ?></td>
                                                    <td><?php echo $row["device_model"]; ?></td>
                                                    <td><?php echo $row["imei_number"]; ?></td>
                                                    <td><?php echo $row["reference"]; ?></td>
                                                    <td><?php echo $row["serialno"]; ?></td>
                                                    <td><?php echo $row["servicetype"]; ?></td>
                                                    <!-- <td><?php echo $row["servicestatus"]; ?></td> -->

                                                    <td>
                                                        <?php
                                                        // Fetch problem descriptions for the current customer
                                                        $sql_problem = "SELECT problem_description FROM customer_problem WHERE customer_id = " . $row['id'];
                                                        $result_problem = $conn->query($sql_problem);

                                                        if ($result_problem->num_rows > 0) {
                                                            while ($problem_row = $result_problem->fetch_assoc()) {
                                                                ?>
                                                                <strong><?php echo $problem_row['problem_description']; ?></strong><br>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "No Problems Reported";
                                                        }
                                                        ?>
                                                    </td>
                                                    <!-- <td><?php echo $row["repair_cost_estimate"]; ?></td> -->
                                                    <td><?php echo $row["repair_status"]; ?></td>




                                                    <td>
                                                        <?php
                                                        // Fetch accessories for the current customer
                                                        $sql_accessories = "SELECT accessories FROM accessories WHERE customer_id = " . $row['id'];
                                                        $result_accessories = $conn->query($sql_accessories);

                                                        if ($result_accessories->num_rows > 0) {
                                                            while ($accessory_row = $result_accessories->fetch_assoc()) {
                                                                ?>
                                                                <strong><?php echo $accessory_row['accessories']; ?></strong><br>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "No Accessories Added";
                                                        }
                                                        ?>
                                                    </td>

                                                    <?php  $row["repair_status"]; ?>
                                                    </td>
                                                    <td><?php echo $row["technician_assigned"]; ?></td>
                                                    <td><?php echo $row["repair_warranty"]; ?></td>

                                                </tr>
                                                <?php
                                                $srno++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='14'>No Data In Database</td></tr>";
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div>


    </div>
    </div>

    <!-- Scripts  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#tblData').DataTable(); // Initialize DataTable for enhanced search, pagination, and sorting

            // AJAX call for updating repair status
            $('.repair-status-update').change(function () {
                var customerId = $(this).data('customer-id');
                var newStatus = $(this).val();

                $.ajax({
                    url: 'update-repair-status.php',
                    method: 'POST',
                    data: { id: customerId, repair_status: newStatus },
                    success: function (response) {
                        alert("Repair status updated successfully!");
                    },
                    error: function () {
                        alert("Error updating repair status.");
                    }
                });
            });
        });
    </script>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>