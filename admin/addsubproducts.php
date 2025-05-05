<?php
session_start();
if (empty($_SESSION['admin_session'])) {
    header('Location: login.php');
    exit; // Always exit after redirection
}

$id = $_GET['id']; 
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
                            <h3 class="page-title">Add SubProducts</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subproducts.php">SubProducts</a></li>
                                <li class="breadcrumb-item active">Add SubProducts</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="insertsubproducts.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title">
                                                <span>Products Information</span>
                                            </h5>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                        
                                        <?php $categorynm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = $id"))['name']; ?>
                                        
                                         <input type="hidden" name="mainproduct" value="<?php echo $categorynm; ?>">

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Upload Photo</label>
                                                <input type="file" class="form-control" name="image" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" rows="6"
                                                    required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Capacity</label>
                                                <input type="text" name="capacity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Model</label>
                                                <input type="text" name="model" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Motor Capacity</label>
                                                <input type="text" name="motor_capacity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Heater Capacity</label>
                                                <input type="text" name="heater_capacity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shredder Capacity</label>
                                                <input type="text" name="shredder_capacity" class="form-control"
                                                    >
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Power Requirement per
                                                    Day</label>
                                                <input type="text" name="power_requirement_per_day" class="form-control"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Dimensions</label>
                                                <input type="text" name="dimensions" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Blower Capacity</label>
                                                <input type="text" name="blower_capacity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Heating System</label>
                                                <input type="text" name="heating_system" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Required Voltage
                                                    Supply</label>
                                                <input type="text" name="required_voltage_supply" class="form-control"
                                                    >
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Electrical Panel
                                                    System</label>
                                                <input type="text" name="electrical_panel_system" class="form-control"
                                                    >
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Display</label>
                                                <input type="text" name="display" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Carbon Filter</label>
                                                <input type="text" name="carbon_filter" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Safety Feature</label>
                                                <textarea name="safety_feature" class="form-control" rows="6"
                                                    ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Sensor</label>
                                                <textarea name="sensor" class="form-control" rows="6"
                                                    ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>VFD System</label>
                                                <input type="text" name="vfd_system" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Machine Paint</label>
                                                <input type="text" name="machine_paint" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Oil Tank Capacity</label>
                                                <input type="text" name="oil_tank_capacity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Weight of Machine</label>
                                                <input type="text" name="weight_of_machine" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" name="price" class="form-control">
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