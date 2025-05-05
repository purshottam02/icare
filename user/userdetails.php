<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
    exit();
}


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
<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>

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
                        <div class="col-auto text-right float-right ml-auto">
                            <a href="exl.php" class="btn btn-primary"> Download Data <i class="fas fa-download"></i></a>
                        </div>
                        <!--<div class="col-auto text-right float-right ml-auto">-->
                        <!--    <a href="add_customer.php" class="btn btn-primary">Add Customer <i-->
                        <!--            class="fas fa-plus"></i></a>-->
                        <!--</div>-->
                    </div>


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
                                                 <th>Device Model</th>
                                                <th>View All Information</th>
                                                 
                                                <!--<th>Delete</th>-->
                                                <!--<th>update Status</th>-->
                                                <!-- <th>Billing</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include '../dbconnection.php';
                                            $shop_id = $_SESSION['user_session']['id'];

                                            $sql = "SELECT * FROM customers
                                            where shop_id = '$shop_id'
                                             ORDER BY customers.id DESC";
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
                                                         <td><?php echo $row["device_model"]; ?></td>
                                                        

                                                        <td class="text-right">
                                                            <div class="actions">
                                                                 <a href="view-info.php?id=<?php echo $row["id"]; ?>" class="btn btn-md bg-success-ligh" onclick="window.open(this.href, 'mywin','left=200,top=150,width=1000,height=500,directories=no,titlebar=no,toolbar=no,location=no,status=no,addressbar=0,scrollbars=no,resizable=yes'); return false;" style="background-color:#121f6e; color:#fff" >
                                                    <i class="fas fa-eye"></i> View </a>
                                                                <!--<a href="view-info.php?id=<?php echo $row["id"]; ?>"-->
                                                                <!--    class="btn btn-md bg-success-light">-->
                                                                <!--    <i class="fas fa-eye"></i> View More-->
                                                                <!--</a>-->
                                                            </div>
                                                        </td>
                                                        <!-- <td class="text-right">
                                                            <div class="actions">
                                                                <a href="edit-customer.php?id=<?php echo $row["id"]; ?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-pen"></i> Update
                                                                </a>
                                                            </div>
                                                        </td> -->
                                                        <!--<td class="text-right">-->
                                                        <!--    <div class="actions">-->
                                                        <!--        <a href="deleteblog.php?id=<?php // echo $row["id"]; ?>"-->
                                                        <!--            class="btn btn-md bg-danger-light"-->
                                                        <!--            onClick="javascript: return confirm('Please confirm deletion');">-->
                                                        <!--            <i class="fas fa-trash"></i> Delete-->
                                                        <!--        </a>-->
                                                        <!--    </div>-->
                                                        <!--</td>-->
                                                        <!--<td class="text-right">-->
                                                        <!--    <div class="actions">-->
                                                        <!--        <a href="upadte_status.php?id=<?php// echo $row["id"]; ?>"-->
                                                        <!--            class="btn btn-md bg-success-light">-->
                                                        <!--            <i class="fas fa-pen"></i> Update status-->
                                                        <!--        </a>-->
                                                        <!--    </div>-->
                                                        <!--</td>-->
                                                        <!-- <td class="text-right">
                                                            <div class="actions">
                                                                <a href="bill.php?id=<?php echo $row["id"]; ?>"
                                                                    class="btn btn-md bg-success-light">
                                                                    <i class="fas fa-receipt"></i> Billing
                                                                </a>
                                                            </div>
                                                        </td> -->
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