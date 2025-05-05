<?php
session_start();
include_once '../dbconnection.php';
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}

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
                            <h3 class="page-title">Update subproducts</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="subproducts.php">Sub Products</a></li>
                                <li class="breadcrumb-item active">Update subproducts</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="updatesubproducts.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Sub Products Information</span></h5>
                                        </div>


                                        <?php
                                             include_once '../dbconnection.php';


                                             $subproducts_id = $_GET['id'];
                                             $sql = "SELECT * FROM subproducts WHERE id=$subproducts_id";
                                             $result = $conn->query($sql);
                                             $subproducts = $result->fetch_assoc();
                                         ?>


                                        <input type="hidden" name="id" value="<?php echo $subproducts['id']; ?>">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="<?php echo $subproducts['name']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Upload Photo</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control"
                                                    rows="6"><?php echo $subproducts['description']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Capacity</label>
                                                <input type="text" name="capacity" class="form-control"
                                                    value="<?php echo isset($subproducts['capacity']) ? $subproducts['capacity'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Model</label>
                                                <input type="text" name="model" class="form-control"
                                                    value="<?php echo isset($subproducts['model']) ? $subproducts['model'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Motor Capacity</label>
                                                <input type="text" name="motor_capacity" class="form-control"
                                                    value="<?php echo isset($subproducts['motor_capacity']) ? $subproducts['motor_capacity'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Heater Capacity</label>
                                                <input type="text" name="heater_capacity" class="form-control"
                                                    value="<?php echo isset($subproducts['heater_capacity']) ? $subproducts['heater_capacity'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Shredder Capacity</label>
                                                <input type="text" name="shredder_capacity" class="form-control"
                                                    value="<?php echo isset($subproducts['shredder_capacity']) ? $subproducts['shredder_capacity'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Power Requirement per Day</label>
                                                <input type="text" name="power_reqirement" class="form-control"
                                                    value="<?php echo isset($subproducts['power_reqirement']) ? $subproducts['power_reqirement'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Diamension</label>
                                                <input type="text" name="diamension" class="form-control"
                                                    value="<?php echo isset($subproducts['diamension']) ? $subproducts['diamension'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Blower Capacity</label>
                                                <input type="text" name="blower_capacity" class="form-control"
                                                    value="<?php echo isset($subproducts['blower_capacity']) ? $subproducts['blower_capacity'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Heating System</label>
                                                <input type="text" name="heating_system" class="form-control"
                                                    value="<?php echo isset($subproducts['heating_system']) ? $subproducts['heating_system'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Required Voltage Supply</label>
                                                <input type="text" name="required_voltage" class="form-control"
                                                    value="<?php echo isset($subproducts['required_voltage']) ? $subproducts['required_voltage'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Electrical Panel System</label>
                                                <input type="text" name="electrical_panel" class="form-control"
                                                    value="<?php echo isset($subproducts['electrical_panel']) ? $subproducts['electrical_panel'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Display</label>
                                                <input type="text" name="display" class="form-control"
                                                    value="<?php echo isset($subproducts['display']) ? $subproducts['display'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Carbon Filter</label>
                                                <input type="text" name="carbon_filter" class="form-control"
                                                    value="<?php echo isset($subproducts['carbon_filter']) ? $subproducts['carbon_filter'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Safety Feature</label>
                                                <textarea name="safty_feature" class="form-control"
                                                    rows="6"><?php echo isset($subproducts['safty_feature']) ? $subproducts['safty_feature'] : ''; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Sensor</label>
                                                <textarea name="sensor" class="form-control"
                                                    rows="6"><?php echo isset($subproducts['sensor']) ? $subproducts['sensor'] : ''; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>VFD System</label>
                                                <input type="text" name="vfd_system" class="form-control"
                                                    value="<?php echo isset($subproducts['vfd_system']) ? $subproducts['vfd_system'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Machine Paint</label>
                                                <input type="text" name="machine_paint" class="form-control"
                                                    value="<?php echo isset($subproducts['machine_paint']) ? $subproducts['machine_paint'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Oil Tank Capacity</label>
                                                <input type="text" name="oil_tank_capacity" class="form-control"
                                                    value="<?php echo isset($subproducts['oil_tank_capacity']) ? $subproducts['oil_tank_capacity'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Weight of Machine</label>
                                                <input type="text" name="weight_of_machine" class="form-control"
                                                    value="<?php echo isset($subproducts['weight_of_machine']) ? $subproducts['weight_of_machine'] : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" name="price" class="form-control"
                                                    value="<?php echo isset($subproducts['price']) ? $subproducts['price'] : ''; ?>">
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