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
    <title>iCARE Apple Service Centre</title>
    <link rel="shortcut icon" href="assets/img/logoo2.jpg">
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
        <?php
        include_once '../dbconnection.php';

        $products_id = $_GET['id'];
        $sql = "SELECT * FROM addshop WHERE id=$products_id";
        $result = $conn->query($sql);
        $products = $result->fetch_assoc();
        ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Update <span style="color: #222f7e;"> <?php echo htmlspecialchars($products['shopname'], ENT_QUOTES); ?></span> Shop Information</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="products.php">Shop</a></li>
                                <li class="breadcrumb-item active">Update Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="updateproducts.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Shop Information</span></h5>
                                        </div>



                                        <input type="hidden" name="id" value="<?php echo $products['id']; ?>">

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shop Name</label>
                                                <input type="text" name="shopname" class="form-control"
                                                    value="<?php echo htmlspecialchars($products['shopname'], ENT_QUOTES); ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Owner Name</label>
                                                <input type="text" name="ownername" class="form-control"
                                                    value="<?php echo htmlspecialchars($products['ownername'], ENT_QUOTES); ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Upload Photo</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" name="number" class="form-control"
                                                    value="<?php echo htmlspecialchars($products['number'], ENT_QUOTES); ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="<?php echo htmlspecialchars($products['email'], ENT_QUOTES); ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control"><?php echo htmlspecialchars($products['address'], ENT_QUOTES); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shop Area Name</label>
                                                <textarea name="area" class="form-control"><?php echo htmlspecialchars($products['area'], ENT_QUOTES); ?></textarea>
                                            </div>
                                        </div>


                                         <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Open Time</label>
                                <textarea name="operating_hours" class="form-control"><?php echo htmlspecialchars($products['opentime'], ENT_QUOTES); ?></textarea>
                            </div>
                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>GST Number</label>
                                                <input type="text" name="GST_number" class="form-control"
                                                    value="<?php echo htmlspecialchars($products['GST_number'], ENT_QUOTES); ?>">
                                            </div>
                                        </div>



                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Customer Support Number</label>
                                                <input type="text" name="customer_support_number" class="form-control"
                                                    value="<?php echo htmlspecialchars($products['customer_support_number'], ENT_QUOTES); ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" name="password" class="form-control"
                                                    value="<?php echo htmlspecialchars($products['password'], ENT_QUOTES); ?>">
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <footer>
                <p>Copyright © 2024.</p>
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
<div class="0">