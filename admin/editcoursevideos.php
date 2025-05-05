
<?php
session_start();
if (empty($_SESSION['admin_session'])) {
header('Location:login.php');
}
include '../dbconn.php';
$id=$_GET['id'];
?>
 <?php
 if(isset($_POST['submit'])) {
 
	$idD = $_POST['ID'];
    $course_date= $_POST['course_date'];

	$sql = "UPDATE coursevideos SET course_date='$course_date' WHERE coursevideos_id= '$idD'";
		if ($conn->query($sql) === TRUE) {
            if ($_FILES['cuploadvideo']['name']!=='') {
                $fileName=$_FILES['cuploadvideo'];
                $imgName = $fileName['name'];
                move_uploaded_file($fileName['tmp_name'], 'videos/' . $imgName);
                $sqlu = mysqli_query($conn, "UPDATE coursevideos SET cuploadvideo='videos/$imgName' WHERE coursevideos_id = '$idD'");
                if ($sqlu) {
                         echo "<SCRIPT type='text/javascript'> //not showing me this
                        alert('Course Videos Update Successfully!!');
                        window.location.replace('coursevideos.php');
                    </SCRIPT>";
                    } else {
                        echo "<SCRIPT>alert('something went wrong...!'); window.location.replace('');</SCRIPT>";
				        }
	               }
                }else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                         }
        }
?>
<!-- coursevideos coursevideos_id  cours_id  videos  -->
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
        <?php //include 'sidebar.php'; ?>
                <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <li>
                            <a href="index.php"><i class="fas fa-th-large"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="courses.php"><i class="fas fa-book"></i> <span>All Courses</span></a>
                        </li>
                        <li>
                      <!--       <a href="coursesdesc.php"><i class="fas fa-book"></i> <span>Course Description</span></a>
                        </li>
                         <li>
                            <a href="coursecurriculum.php"><i class="fas fa-user-graduate"></i> <span>Course Curriculum</span></a>
                        </li>   -->
                        <li class="active">
                            <a href="coursevideos.php"><i class="fas fa-user-graduate"></i> <span>Course Videos</span></a>
                        </li>  
                        <li>
                            <a href="userlist.php"><i class="fas fa-user-graduate"></i><span class="badge badge-danger" style="margin-left: 0px;"> Unpaid User<span></a>
                        </li> 
                        <li>
                            <a href="paiduser.php"><i class="fas fa-user-graduate"></i><span class="badge badge-success" style="margin-left: 0px;">Paid User</span></a>
                        </li> 
                        <li class="menu-title">
                            <span>Management</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="changepassword.php">Change Password</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Courses Videos</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="coursecurriculum.php">Demo Videos</a></li>
                                <li class="breadcrumb-item active">Edit Courses Videos</li>
                            </ul>
                        </div>
                    </div>            
                </div>
<!-- coursevideos coursevideos_id  cours_id  videos  -->
            <?php 
                $sql = "SELECT * FROM coursevideos WHERE coursevideos_id=$id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();            
            ?>
                <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data" >
                                        <input type="hidden" name="ID" value="<?php echo $id ?>">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="form-title"><span>Courses Video Information</span></h5>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <video width='80%'  controls><source src="<?=$row["cuploadvideo"];?>" type='video/mp4'></video>
                                                    <label>Course Videos </label>
                                                    <input type="file" name="cuploadvideo" class="form-control"  required> 
                                                </div>
                                            </div>
                                           <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Course Date</label>
                                                    <input value="<?php echo $row["course_date"]?>"  type="Date" name="course_date" class="form-control" required>
                                                </div>
                                            </div> 
                                      <!--      <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Course List</label>
                                                    
                                                    <select class="form-control" name="coursename" required>
                                                        <option>Select Course</option>
                                                       <?php 
                                                        // $sql2 = mysqli_query($conn, "SELECT * From courses");
                                                        // $row2 = mysqli_num_rows($sql2);
                                                        // while ($row2 = mysqli_fetch_array($sql2)){
                                                        // echo "<option value='". $row2['course_id'] ."'>" .$row2['course_name'] ."</option>" ;
                                                        // }
                                                     ?>
                                                    </select>
                                                </div>
                                            </div> -->
                                            
                                          
                                            <div class="col-12">
                                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Upadte</button>
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