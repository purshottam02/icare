<?php
session_start();
include_once '../conn.php';
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
}

?>
<?php
if (isset($_POST['submit'])) {

    $getpincode = $_POST["pincode"];
    $getshippingCost = $_POST["shippingCost"];

    $sqlqq= mysqli_fetch_assoc(mysqli_query($conn,"SELECT pincode FROM shippingcost"))['pincode'];
    if ($getpincode==$sqlqq) {
        echo "<script>alert('Pincode Allready Registerd');window.location.replace('');</script>";
    } else {
    $sql = "INSERT INTO shippingcost(pincode,shippingCost) VALUES('$getpincode','$getshippingCost')";
    //echo "<br>-=-=-=-=-=-<br>".$sql;
    if ($conn->query($sql)) {
        echo "<SCRIPT type='text/javascript'> 
                  alert('New Charges Added Successfully!!');
                 window.location.replace('zipcode.php');
                </SCRIPT>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    }
}
?>
<!-- shippingcost shippingCostid pincode shippingCost -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>

    <link rel="icon" type="image/png" href="assets/img/logoo.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

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
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Pincodewise Shipping Charges </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Pincodewise Shipping Charges </a></li>
                                <li class="breadcrumb-item active">Add Pincodewise Shipping Charges </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Pincodewise Shipping Charges Information</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="name" name="pincode" class="form-control"  placeholder="Enter Pin Code"required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shipping Charges</label>
                                                <input type="number" name="shippingCost" class="form-control"  placeholder="Shipping Charge"required>
                                            </div>
                                        </div>
                                       
                                        <div class="col-12">
                                           <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content container-fluid">
            <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">All Pincode & Shipping Charges</h3>
                            <!-- <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Orders</li>
                            </ul> -->
                        </div>
                        <div class="col-auto text-right float-right ml-auto">
                            <!--   <a href="#" class="btn btn-outline-primary mr-2"><i class="fas fa-download"></i> Download</a> -->
                            <!-- <a href="add.php" class="btn btn-primary"><i class="fas fa-plus"></i></a> -->
                        </div>
                    </div>
                </div>
              

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card ">
                            <div class="card-body" style="padding: 0px;">
                                <div class="table-responsive">
                                    <table id="mytable" class="table table-hover table-center mb-0">
                                        <thead>
                                            <tr>
                                                <!-- user_Id  -->
                                                <th>#</th>
                                                <th>Pincode</th>
                                                <th>Shipping Charges</th>
                                                <!-- <th>Email</th>
                                                <th>Contact Number</th>
                                              -->  <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            $sql = "SELECT * FROM shippingcost";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                $srno = 1;
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                        <td>" . $srno . "</td>
                                                        <td>" . $row['pincode'] . "</td>
                                                        <td>" . $row['shippingCost'] . "</td>
                                                        <td><a href='dzip.php?id=". $row['id'] ." 'class='btn btn-sm bg-danger-light'><i class='fas fa-trash'></i>
</a></td>

                                                      
                                                       
                                                    </tr>";

                                                    $srno++;
                                                }
                                            } else {
                                                echo "Curruntaly No Any Customers";
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
                <p>Copyright © 2022 Nucleus - Health & Medical.</p>
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

    <!-- Scripts  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <script>
                 $(document).ready( function () {
                $('#mytable').DataTable();
            } );
        </script>

    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>