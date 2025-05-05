<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
    exit();
}
$id = $_GET['id'];

include '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>
    <link rel="icon" type="image/png" href="assets/img/logoo2.jpg">
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
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header" style="background: aliceblue; padding: 16px 29px; border-radius: 5px;">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title active">Completed Customers </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Completed </li>
                            </ul>
                        </div>
                        <!-- <div class="col-auto text-right float-right ml-auto">
                            <a href="exl.php?id=<?php echo $id; ?>" class="btn btn-primary"> Download Data <i
                                    class="fas fa-download"></i></a>
                        </div> -->

                    </div>

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
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card ">
                            <div class="card-body" style="padding: 0px;">

                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0 datatable" id="tblData">
                                        <div class="col-lg-4 d-flex justify-conten-between "
                                            style="border:0px solid; font-size:20px; text-align:right; float: right;">
                                            <script
                                                src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
                                            </script>
                                            <script>
                                                $(document).ready(function() {
                                                    $("#myInput").on("keyup", function() {
                                                        var value = $(this).val().toLowerCase();
                                                        $("#tblData tr").filter(function() {
                                                            $(this).toggle($(this).text()
                                                                .toLowerCase().indexOf(value) >
                                                                -1)
                                                        });
                                                    });
                                                });
                                            </script>

                                            <input id="myInput" type="text" placeholder="Search.." style="margin-bottom: 21px; margin-top: 21px; border: 1px solid #8080806b;
                                             padding: 5px 9px; font-size: 17px;">
                                        </div>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Mobile Number</th>
                                                <th>Address</th>
                                                <!-- <th>Device Brand</th>
                                                <th>Device Model</th>
                                                <th>IMEI Number</th>
                                                <th>Problem Description</th>
                                                <th>Repair Cost Estimate</th>
                                                <th>Repair Status</th>
                                                <th>Technician Assigned</th>
                                                <th>Repair Warranty</th> -->
                                                <th>View More</th>
                                                <!--<th>Update</th>-->
                                                <!-- <th>Upadte</th> -->
                                                <!-- <th>Update Status</th> -->
                                                <th>Billing</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            include '../dbconnection.php';
                                            $shop_id = $_SESSION['user_session']['id'];

                                            // Modify the SQL query to filter for pending repair status
                                            $sql = "SELECT * FROM customers WHERE repair_status = 'completed'   AND shop_id = '$shop_id' ORDER BY customers.id DESC";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                $srno = 1;
                                                while ($row = $result->fetch_assoc()) {
                                                    $rcots = $row['finalcost'];
                                            ?>
                                                    <tr>
                                                        <td scope="row"><?= $srno ?></td>
                                                        <td><?= htmlspecialchars($row["first_name"]) ?></td>
                                                        <td><?= htmlspecialchars($row["last_name"]) ?></td>
                                                        <td><?= htmlspecialchars($row["email"]) ?></td>
                                                        <td><?= htmlspecialchars($row["mobile_number"]) ?></td>
                                                        <td><?= htmlspecialchars($row["address"]) ?></td>



                                                        <td class="text-right">
                                                            <div class="actions">
                                                                <a href="view-info.php?id=<?php echo $row["id"]; ?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-eye"></i> View
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <?php
                                                        if (empty(trim($rcots))) { // Checks if $rcots is empty or only contains spaces
                                                        ?>
                                                            <td class="text-right">
                                                                <div class="actions">
                                                                    <a href="edit-customer.php?id=<?= htmlspecialchars($row["id"]) ?>" class="btn btn-md bg-success-light">
                                                                        <i class="fas fa-pen"></i> Update
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>

                                                        <!--<td class="text-right">-->
                                                        <!--    <div class="actions">-->
                                                        <!--        <a href="deleteblog.php?id=<? //= $row["id"] 
                                                                                                ?>"-->
                                                        <!--            class="btn btn-md bg-danger-light"-->
                                                        <!--            onClick="javascript: return confirm('Please confirm deletion');">-->
                                                        <!--            <i class="fas fa-trash"></i> Delete-->
                                                        <!--        </a>-->
                                                        <!--    </div>-->
                                                        <!--</td>-->
                                                        <!-- <td class="text-right">
                                                            <div class="actions">
                                                                <a href="complatestatus.php?id=<?php echo $row["id"]; ?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-pen"></i> Update status
                                                                </a>
                                                            </div>
                                                        </td> -->
                                                        <td class="text-right">
                                                            <div class="actions">
                                                                <a href="bill.php?id=<?= $row["id"] ?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-receipt"></i> Billing
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $srno++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='15'>No Data In Database</td></tr>";
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
                <p>Copyright © 2024</p>
            </footer>
        </div>
    </div>

    <!-- Scripts  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#tblData').DataTable(); // Initialize DataTable for enhanced search, pagination, and sorting

            // AJAX call for updating repair status
            $('.repair-status-update').change(function() {
                var customerId = $(this).data('customer-id');
                var newStatus = $(this).val();

                $.ajax({
                    url: 'update-repair-status.php',
                    method: 'POST',
                    data: {
                        id: customerId,
                        repair_status: newStatus
                    },
                    success: function(response) {
                        alert("Repair status updated successfully!");
                    },
                    error: function() {
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