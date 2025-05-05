<?php
session_start();
include_once '../dbconnection.php';
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
    exit();
}

$shop_id = $_SESSION['user_session']['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>
    <link rel="icon" type="image/png" href="assets/img/logoo.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
        .card { 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }
        .form-title span { 
            color: #121f6e; 
            font-weight: 600; 
        }
        .btn-primary { 
            background-color: #007bff; 
            border-color: #007bff; 
            font-weight: 600; 
        }
        .table thead th { 
            background-color: #121f6e; 
            color: #fff; 
        }
        .actions .btn { 
            font-size: 0.9rem; 
            margin: 0 5px; 
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header py-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title text-primary" style="color: #000 !important;">Add Technician</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Technician Management</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Add Technician Form -->
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <form action="inserttech.php" method="post">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Add Technician</span></h5>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="Category">Add Technician</label>
                                                <input type="text" name="category" class="form-control" id="Category" placeholder="Enter Technician Name" required>
                                            </div>
                                        </div>
                                        <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
                                        <div class="col-12">
                                            <div>
                                                 <button type="submit" name="add" class="btn btn-primary w-100">Submit</button>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Technician Section -->
                <h3 class="page-title text-primary mt-5" style="color: #000 !important;">Delete Technician</h3>
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0 datatable" id="technicianTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Technician Category</th>
                                <th style="text-align: right;">Action</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM technician where shop_id = '$shop_id'  ORDER BY id DESC";
                            $result = $conn->query($sql); 
                            if ($result->num_rows > 0) {
                                $srno = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$srno}</td>
                                        <td>{$row["catogery"]}</td>
                                        <td class='text-right'>
                                            <div class='actions'>
                                                <a href='deletetech.php?id={$row["id"]}' class='btn btn-sm btn-danger-light' onClick=\"javascript: return confirm('Please confirm deletion');\">
                                                    <i class='fas fa-trash'></i> 
                                                </a>
                                            </div>
                                        </td>
                                    </tr>";
                                    $srno++;
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center text-muted'>No Data Available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <footer class="py-4 text-center">
                <p class="mb-0">&copy; 2024.</p>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/script.js"></script>



</body>
</html>
