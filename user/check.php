<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location: login.php');
    exit;
}
$shop_id = $_SESSION['user_session']['id'];
include '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>    <link rel="icon" type="image/png" href="assets/img/logoo.jpg">
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
                            <h3 class="page-title">Add Customer</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="customers.php">Customers</a></li>
                                <li class="breadcrumb-item active">Add Customer</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="insertcheck.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-12">
                                            <h5 class="form-title"><span>Checklist Outward Check</span></h5>
                                        </div>

                                        <!-- First Name -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device is Powering On:</label>
                                                <select name="device_powering" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Power Button Is Working:</label>
                                                <select name="power_button" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Volume Keys are Working:</label>
                                                <select name="volume_keys" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Display is working:</label>
                                                <select name="display_working" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Touchscreen is Working:</label>
                                                <select name="touchscreen" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Speaker is Working:</label>
                                                <select name="speaker_working" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Charging Port is Working:</label>
                                                <select name="charging_port" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Headphone Jack is Working:</label>
                                                <select name="headphone_jack" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Back Cover Damaged or Broken:</label>
                                                <select name="back_cover" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Body is Damaged or has Dents:</label>
                                                <select name="body_damage" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Screw Heads are Damaged or Missing:</label>
                                                <select name="screw_head" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>SIM Tray is Damaged or Missing:</label>
                                                <select name="sim_tray" class="form-control" required>
                                                    <option value="">Seclect Inward Check</option>
                                                    <!-- Optional placeholder option -->
                                                    <option value="W">W</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
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

    <!-- Scripts -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>