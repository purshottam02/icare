<?php
session_start();
if (empty($_SESSION['admin_session'])) {
header('Location:login.php');
}
include '../dbconn.php';
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>AIE Academy - Dashboard</title>

    <link rel="shortcut icon" href="../assets/images/logo/logo.jpg">
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
                            <h3 class="page-title">Edit Student</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="student.php">student</a></li>
                                <li class="breadcrumb-item active">Edit student</li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php 
                $sql = "SELECT * FROM student WHERE id=$id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();            
            ?>
                <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="updatestudent.php" method="post" enctype="multipart/form-data" >
                                        <input type="hidden" name="ID" value="<?php echo $id ?>">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="form-title"><span>Student Information</span></h5>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label> Name</label>
                                                    <input type="text" name="Name" class="form-control" value="<?php echo $row["name"] ?>" required="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>discountcost</label>
                                                    <input type="text" class="form-control" name="discountcost" value="<?php echo $row["discountcost"] ?>" required="">
                                                </div>
                                            </div>
                                      <!--       <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Offer Rate</label>
                                                    <input type="text" class="form-control" name="offer_prise" value="<?php //echo $row["offer_prise"] ?>" required>
                                                </div>
                                            </div>
 -->
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>discription</label>
                                                    <input type="text" class="form-control" name="discription" value="<?php echo $row["discription"] ?>" required="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                               
												<img src="<?php echo $row["photo"] ?>" class="img-fluid rounded-start" style="height: 200px; " alt="...">
                                                <div class="form-group">
                                                    <label>photo</label>
                                                    <input type="file" class="form-control" value="<?php echo $row["photo"]?>" name="photo" >
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>cityname</label>
                                                    <input type="text" class="form-control" name="cityname" value="<?php echo $row["cityname"] ?>" required="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                               
												
                                                <div class="form-group">
                                                    <label>area</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["area"]?>" name="area" >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Upadte</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            </div>
           
            <footer>
                <p>Copyright © 2023 SSQUAREIT.</p>
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

