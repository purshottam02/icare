<?php
session_start();
if (empty($_SESSION['admin_session'])) {
header('Location:login.php');
}
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

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

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
                                <h3 class="page-title active">All Student</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">All Student</li>
                                </ul>
                            </div>
                            <div class="col-auto text-right float-right ml-auto">
                              <!--   <a href="#" class="btn btn-outline-primary mr-2"><i class="fas fa-download"></i> Download</a> -->
                                <a href="addstudent.php" class="btn btn-primary">Add Student  <i class="fas fa-plus"></i></a> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0 datatable">
                                            <thead>
                                                <tr>
                                             <!--     course_id   -->
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Photo</th>
                                                    <th>Cost</th>
                                                    <th>City</th>
                                                    <th>Area</th>
                                                    
                                                    <th>Description </th> 
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php include '../dbconn.php';
                                        $sql = "SELECT * FROM student";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                          // output data of each row
                                             $srno = 1;
                                          while($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td scope="row"><?= $srno ?> </td>
                                                    <td><?php echo $row["name"] ?></td>
                                                    <td>
                                                       <img src="<?php echo $row["photo"] ?>" class="img-fluid rounded-start" style="height: 200px; " alt="...">
                                                    </td>    
                                           
                                                <td><?php echo $row["discountcost"] ?></td>
                                               
                                                
                                                <td><?php echo $row["discription"] ?></td>
                                                <td><?php echo $row["cityname"] ?></td>
                                                <td><?php echo $row["area"] ?></td>
                                                
                                                    <td class="text-right">
                                                        <div class="actions">
                                                             <a href="editstudent.php?id=<?php echo $row["id"] ?>" class="btn btn-md bg-success-light">
                                                                <i class="fas fa-pen"></i>
                                                            </a> 
                                                            <a href="deletestudent.php?id=<?php echo  $row["id"] ?>" class="btn btn-md bg-danger-light" onClick="javascript: return confirm('Please confirm deletion');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
													
													 <!--td class="text-right">
                                                        <div class="actions">
                                                            <a href="editcourse.php?id=<?php //echo $row["course_id"] ?>" class="btn btn-md bg-success-light">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <a href="deletecourse.php?id=<?php //echo  $row["course_id"] ?>" class="btn btn-md bg-danger-light" onClick="javascript: return confirm('Please confirm deletion');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td-->
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
                <p>Copyright © 2023 SSQUAREIT.</p>
            </footer>
        </div>
    </div>

<!-- Scripts  -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>

        <script src="assets/js/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="assets/plugins/datatables/datatables.min.js"></script>

        <script src="assets/js/script.js"></script>

</body>

</html>