<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
}
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
                            <h3 class="page-title">Products Details</h3>
                            <ul class="breadcrumb">

                                <li class="breadcrumb-item active">Products Details</li>
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">
                            <!-- <a href="#" class="btn btn-outline-primary mr-2"><i class="fas fa-download"></i> Download</a> -->
                            <a href="add_blog.php" class="btn btn-primary" style="font-family: system-ui;">Add Blog</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0 datatable">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Heading</th>
                                                <!-- <th>Availability</th> -->
                                                <th>Date</th>
                                                <th>Information</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include '../conn.php';

                                            $sql = "SELECT * FROM blog";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                $srno = 1;
                                                while ($row = $result->fetch_assoc()) { ?>


                                                    <tr>
                                                        <td><?php echo $srno; ?></td>
                                                        <form method="POST" action="eblog.php" enctype="multipart/form-data">
                                                            <td><label for="files"><img src="<?php echo $row["img"] ?>" width="80%"></label><br><input type="file" id="files" name="pimg" style="display:none;" /></td>
                                                            <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
                                                            <td><input type="text" name="product_name" value="<?php echo $row["name"] ?>" placeholder="<?php echo $row["name"] ?>" style="border: none;"></td>
                                                            <td><input type="text" name="product_weight" value="<?php echo $row["heading"] ?>" placeholder="<?php echo $row["heading"] ?>" style="border: none;"></td>
  
                                                            <td><input type="text" name="product_cost" value="<?php echo $row["date"] ?>" placeholder="<?php echo $row["date"] ?>" style="border: none;"></td>
                                                            <td><input type="text" name="info" value="<?php echo $row["info"] ?>" placeholder="<?php echo $row["info"] ?>" style="border: none;"></td>
                                                            <td class="text-right">
                                                                <div class="actions">
                                                                    <a class="btn btn-sm bg-success-light mr-2">
                                                                        <button type="submit" name="update" style="background: transparent;border: none;"><i class="fas fa-pen"></i></button>
                                                                    </a>
                                                        </form>
                                                        <script type="text/javascript">
                                                            function ConfirmDelete() {
                                                                return confirm("Are you sure you want to delete?");
                                                            }
                                                        </script>
                                                        <a href="deleteblog.php?id=<?php echo $row["id"] ?>" onclick='ConfirmDelete()' class="btn btn-sm bg-danger-light">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                </div>
                                </td>
                                </tr>
                        <?php $srno++;
                                                }
                                            } else {
                                                echo '<div class="alert alert-success" role="alert">
                                                Flat Owner Data Not Found !
                                                </div>';
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
            <p>Copyright © 2022.</p>
        </footer>

    </div>

    </div>


    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/html-template/hostel.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Oct 2021 07:19:07 GMT -->

</html>