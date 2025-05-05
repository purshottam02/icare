<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}
include_once '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>SSQUARE-IT - Dashboard</title>

    <link rel="shortcut icon" href="../img/logop.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="page-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Contact Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="addcontactdetails.php">Contact Details</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <a href="addcontactdetails.php" class="btn btn bg-danger-light"><i class="fas fa-plus"></i>Add Contact Details</a>
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
                                                <!-- course_curriculum id  cours_id    curriculum  -->

                                                <th>No</th>
                                                <th>Number</th>
                                                <!-- <th>Message</th> -->
                                                <th class="text-right">Action</th>
                                                <!--   <td>Photos</td> -->
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM contact ORDER BY contact.id DESC";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                $srno = 1;
                                                while ($row = $result->fetch_assoc()) {

                                            ?>
                                                    <tr style="    text-align: justify;">
                                                        <td scope="row"><?= $srno ?> </td>

                                                        <td><?php echo $row['contact_number']; ?></td>
                                                        <!-- <td><?php echo $row['description']; ?></td> -->
                                                        <td class="text-right">
                                                            <div class="actions">
                                                                <!-- <a href="editnumber.php?id=<?php echo  $row["id"] ?>" class="btn btn-sm bg-success-light ">
                                                                    <i class="fas fa-pen"></i>
                                                                </a><br> -->
                                                                <a href="deletecontact.php?id=<?php echo  $row["id"] ?>" class="btn btn-sm bg-danger-light" onClick="javascript: return confirm('Please confirm deletion');">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>

                                                            </div>
                                                        </td>
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
        </div>
        <footer>
                <p>Copyright © 2023 SSQUAREIT.</p>
            </footer>
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