<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}
include '../dbconnection.php';

?>
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
                            <h3 class="page-title">Add What We Offer</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">What We Offer</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
               $id = $_GET['id'];
                $sql1 = "SELECT * FROM courses WHERE id= $id";
                $result = $conn->query($sql1);
                $row = $result->fetch_assoc()

                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="updatecourse.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>About What We Offer Information</span></h5>
                                        </div>
                                        <!---div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label>Service Name</label>
                                                    <input type="text" name="ser_name" class="form-control" required>
                                                </div>
                                            </div-->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Courses</label>
                                                <input type="hidden" name="ID" value="<?php echo $id; ?>">
                                                <input type="text" class="form-control" name="coursename" value="<?php echo $row['coursename']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>

                                                <textarea type="text" style="height:222px;" class="form-control" name="description"  rows="6" required><?php echo $row['description']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <!-- <label>Photo</label> -->
                                                    <img src="image/<?php echo $row["image"] ?>" class="img-fluid rounded-start" style="height: 200px; " alt="...">
                                                </div>
</div>
                                        <div class="col-12">
                                            <button type="submit" name="upload" class="btn btn-primary">Submit</button>
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

    <footer>
        <p>Copyright © 2023 SSQUAREIT.</p>
    </footer>
    </div>
    </div>

    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
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