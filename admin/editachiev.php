<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}

// Include database connection
include_once '../dbconnection.php';

// Fetch the service details based on ID
$acheive_id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM acheive WHERE id = ?");
$query->bind_param("i", $acheive_id);
$query->execute();
$result = $query->get_result();
$acheive = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Enviro - Dashboard</title>

    <link rel="shortcut icon" href="../img/logop.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
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
                            <h3 class="page-title">Update Achievements</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="achiev.php">Achievements</a></li>
                                <li class="breadcrumb-item active">Update Achievements</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="updateachiev.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Achievements Information</span></h5>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $acheive['id']; ?>">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Machine Name</label>
                                                <input type="textarea" name="name" class="form-control"
                                                    value="<?php echo $acheive['name']; ?>" required>
                                            </div>
                                        </div>



                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Machine Number</label>
                                                <input type="textarea" name="count" class="form-control"
                                                    value="<?php echo $acheive['count']; ?>" required>
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