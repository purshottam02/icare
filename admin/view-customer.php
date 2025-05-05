<?php
session_start();
include_once '../dbconnection.php';
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Enviro - Dashboard</title>

    <link rel="shortcut icon" href="../img/logop.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header" style="background: aliceblue; padding: 16px 29px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title active">All Customers</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Customers</li>
                            </ul>
                        </div>
                        <!-- <div class="col-auto text-right float-right ml-auto">
                            <a href="add_customer.php" class="btn btn-primary">Add Customer <i class="fas fa-plus"></i></a>
                        </div> -->
                    </div>

                    <style>
                        table {
                            border-collapse: collapse;
                            border-spacing: 0;
                            width: 100%;
                            border: 1px solid #ddd;
                        }

                        th, td {
                            text-align: left;
                            padding: 8px;
                        }

                        tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }
                    </style>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card ">
                            <div class="card-body" style="padding: 0px;">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0 datatable" id="tblData">
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
                                                <th>Problem Description</th>
                                                <th>Repair Cost Estimate</th>
                                                <th>Repair Status</th>
                                                <th>Technician Assigned</th>
                                                <th>Repair Warranty</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            include '../dbconnection.php';
                                            $sql = "SELECT * FROM customers ORDER BY customers.id ASC";
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
                                                        <td>
                                                            <?php
                                                            // Fetch problem descriptions for the current customer
                                                            $sql_problem = "SELECT problem_description FROM customer_problem WHERE customer_id = " . intval($row['id']);
                                                            $result_problem = $conn->query($sql_problem);

                                                            if ($result_problem) { // Check if the query executed successfully
                                                                if ($result_problem->num_rows > 0) {
                                                                    while ($problem_row = $result_problem->fetch_assoc()) {
                                                                        // Check if the key exists before trying to access it
                                                                        if (isset($problem_row['problem_description'])) {
                                                                            ?>
                                                                            <strong><?= htmlspecialchars($problem_row['problem_description']); ?></strong><br>
                                                                            <?php
                                                                        } else {
                                                                            // Handle the case where the key does not exist
                                                                            echo "Problem description not available.";
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "No Problems Reported";
                                                                }
                                                            } else {
                                                                // Handle query error
                                                                echo "Error fetching problem descriptions: " . $conn->error;
                                                            }
                                                            ?>

                                                        </td>
                                                        <td><?php echo $row["repair_cost_estimate"]; ?></td>
                                                        <td style="
    color: <?php
            if ($row["repair_status"] == 'Pending') {
                echo 'red';
            } elseif ($row["repair_status"] == 'In Progress') {
                echo 'blue';
            } elseif ($row["repair_status"] == 'Completed') {
                echo 'green';
            } else {
                echo 'black'; // Default color if none match
            }
            ?>
;">
                                                            <?php echo $row["repair_status"]; ?>
                                                        </td>
                                                        <td><?php echo $row["technician_assigned"]; ?></td>
                                                        <td><?php echo $row["repair_warranty"]; ?></td>
                                                        <!-- <td class="text-right">
                                                            <div class="actions">
                                                                <a href="edit-customer.php?id=<?php echo $row["id"]; ?>" class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-pen"></i> Update
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="actions">
                                                                <a href="deleteblog.php?id=<?php echo $row["id"]; ?>" class="btn btn-md bg-danger-light" onClick="javascript: return confirm('Please confirm deletion');">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </a>
                                                            </div>
                                                        </td> -->
                                                    </tr>
                                                    <?php
                                                    $srno++;
                                                }
                                            } else {
                                                echo "No Data In Database";
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

            <footer>
                <p>Copyright © 2023 Ganga.</p>
            </footer>
        </div>
    </div>

    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!-- Scripts  -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>