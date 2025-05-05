<?php
session_start();

if (empty($_SESSION['admin_session'])) {
header('Location:login.php');
}
include_once '../dbconnection.php';
if (isset($_POST['send'])) {
    $number = $_POST["number"];
    // $description = $_POST["description"];
    
    $sql = "INSERT INTO contact(contact_number) VALUES('$number')";
          
          //echo "<br>-=-=-=-=-=-<br>".$sql;
            if ($conn->query($sql)) {
                echo "<SCRIPT type='text/javascript'> //not showing me this
                      alert('contact Number Added successfully!!');
                     window.location.replace('contactdetailslist.php');
                    </SCRIPT>";
                  }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                } 
    
    }
    ?>
?>
<!-- <?php 
//if(isset($_POST['submit'])) {
 

//}
   

?> -->
<!-- coursevideos coursevideos_id  cours_id  videos  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>SsquareIT - Dashboard</title>

    <link rel="shortcut icon" href="../img/logop.png">
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
                                <h3 class="page-title">Add Job Post</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active">Job Post</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data" >
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="form-title"><span>Job Post</span></h5>
                                            </div>
                                            <!---div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Service Name</label>
                                                    <input type="text" name="ser_name" class="form-control" required>
                                                </div>
                                            </div-->
                                             <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Add Mobile Number</label>
                                                    
													<input type="text" class="form-control" name="number" required>
                                                </div>
                                            </div>
                                            <!--div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Welcome Image</label>
                                                    <input type="file" class="form-control" name="image" required>
													<p>Best View Size 300 X 200 PX</p>
                                                </div>
                                            </div-->
                                            <!-- <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Description </label>
                                                    <textarea class="form-control" name="description" required></textarea>
                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <button type="submit"  name="send" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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