<?php
session_start();
include_once '../conn.php';
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
}

if (isset($_POST['add'])) {
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $query = "INSERT INTO `gallery`( `img`) VALUES ('$target_file')";
    $query_run = mysqli_query($conn, $query);

    if (!$query_run) {
        echo "try again";
    } else {
        //echo "Registered Successfully";

        echo "<SCRIPT type='text/javascript'> //not showing me this
              alert('New Sub head Added successfully!!');
             window.location.replace('add_gallery.php');
            </SCRIPT>";
    }
}


?>


?>
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
                            <h3 class="page-title">Add Products</h3>
                            <ul class="breadcrumb">
                                <!--    <li class="breadcrumb-item"><a href="coursesdesc.php">Sub Head</a></li>
                                <li class="breadcrumb-item active">Add Sub Head</li> -->
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
                                            <h5 class="form-title"><span>ProductsInformation</span></h5>
                                        </div>




                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="Product image">Add Image</label>
                                                <input type="file" name="image" class="form-control" id="Product image" placeholder="" required>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <button type="submit" name="add" name="addsubhead" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <footer>
                <p>Copyright © 2022 </p>
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