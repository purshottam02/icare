<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location: login.php');
    exit;
}
$shop_id = $_SESSION['user_session']['id'];
$string = $_SESSION['user_session']['area'];
$ref = $_SESSION['user_session']['reference'];
$refrance = substr($ref, 0, 4);
$jobfirst = substr($string, 0, 4); // Extract the first two characters

include '../dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>
    <link rel="icon" type="image/png" href="assets/img/logoo.jpg">
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
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Customer</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="insertcustomer.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Add Customer Information</span></h5>
                                        </div>
                                        <input type="hidden" value="<?php echo $shop_id; ?>" name="shop_id" class="form-control">

                                        <!-- First Name -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>First Name:</label>
                                                <input type="text" name="first_name" class="form-control" required
                                                    oninput="validateText(this)">
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name:</label>
                                                <input type="text" name="last_name" class="form-control" required
                                                    oninput="validateText(this)">
                                            </div>
                                        </div>

                                        <!-- JavaScript for text validation -->
                                        <script>
                                            function validateText(input) {
                                                input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
                                            }
                                        </script>

                                        <!-- Email -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Email Address:</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Mobile Number -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile Number:</label>
                                                <input type="tel" name="mobile_number" class="form-control"
                                                    oninput="validateMobileNumber(this)" maxlength="10" required>
                                            </div>
                                        </div>

                                        <!-- JavaScript for mobile number validation -->
                                        <script>
                                            function validateMobileNumber(input) {
                                                input.value = input.value.replace(/\D/g, '');
                                                if (input.value.length > 10) {
                                                    input.value = input.value.slice(0, 10);
                                                }
                                            }
                                        </script>

                                        <!-- Address -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Address:</label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <h5 class="form-title"><span>Service Details</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-6">

                                            <?php


                                            $sql3 = "SELECT * FROM `customers` WHERE shop_id = ?";
                                            $stmt = $conn->prepare($sql3);
                                            $stmt->bind_param("i", $shop_id); // Using prepared statements for security
                                            $stmt->execute();
                                            $res = $stmt->get_result();

                                            $reference = null; // Initialize variable

                                            if ($res->num_rows > 0) {
                                                while ($show = $res->fetch_assoc()) {
                                                    $reference = $show['reference']; // Fetch 'reference' from each row
                                                }
                                            }

                                            $stmt->close();


                                            if (empty($reference)) {
                                                // Get the last inserted customer ID
                                                // $categorynm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM `customers` ORDER BY id DESC LIMIT 1"))['id'];
                                                // $categorynm = (int)$categorynm; // Ensure it's an integer
                                            
                                                // Generate new job ID
                                                $jobidn =  1;
                                                $jobid = strtoupper($jobfirst . str_pad($jobidn, 3, '0', STR_PAD_LEFT)); // Ensures proper formatting
                                            
                                            } else {
                                                // Extract the prefix and number separately
                                                if (preg_match('/(\D+)(\d+)/', $reference, $matches)) {
                                                    $prefix = $matches[1]; // Extracts the non-numeric prefix (e.g., "SWAR")
                                                    $number = (int)$matches[2]; // Extracts numeric part and converts it to an integer
                                            
                                                    // Increment the numeric part and maintain leading zeros
                                                    $jobid = $prefix . str_pad($number + 1, strlen($matches[2]), '0', STR_PAD_LEFT);
                                                } else {
                                                    $jobid = $reference; // Fallback in case reference format is invalid
                                                }
                                            }
                                            
                                            
                                            ?>


                                            <div class="form-group">
                                                <label>Job No:</label>
                                                <input type="text" name="reference" value="<?= $jobid  ?>" class="form-control" readonly>

                                            </div>

                                        </div>


                                        <div class="col-12">
                                            <h5 class="form-title"><span>Device Information</span></h5>
                                        </div>

                                        <!-- Device Brand -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device Brand:</label>
                                                <input type="text" name="device_brand" value="Apple" readonly class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Device Model -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device Model:</label>
                                                <input type="text" name="device_model" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- IMEI Number -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>IMEI Number:</label>
                                                <input type="text" name="imei_number" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <!-- <div class="form-group">
                                                <label>Serial Number:</label>
                                                <input type="text" name="serialno" class="form-control">
                                            </div> -->
                                        </div>




                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Product Warranty Status:</label>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="oow" value="OOW">
                                                        <label class="form-check-label" for="oow">
                                                            OOW
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="app" value="Repeat Warranty">
                                                        <label class="form-check-label" for="app">
                                                            Repeat Warranty
                                                        </label>
                                                    </div>
                                                     <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="warranty" value="Warranty" required>
                                                        <label class="form-check-label" for="warranty">
                                                            Warranty
                                                        </label>
                                                    </div>
                                                   
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="others" value="Others">
                                                        <label class="form-check-label" for="others">
                                                            Others
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <h5 class="form-title"><span>Repair Details</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label> Category:</label>
                                                <input type="text" name="category" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Problem Description Field -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Problem Description:</label>
                                                <textarea name="problem_description[]" class="form-control" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Additional Problem Descriptions -->
                                        <div id="additional-problems" class="col-12 col-sm-6"></div>

                                        <!-- Button to Add More Problem Descriptions -->
                                        <div class="col-12 col-sm-6">
                                            <button type="button" id="add-problem" class="btn btn-primary">Add More Problem Description</button>
                                        </div>

                                        <!-- JavaScript to Add and Remove Problem Descriptions -->
                                        <script>
                                            document.getElementById('add-problem').addEventListener('click', function() {
                                                var newProblemDiv = document.createElement('div');
                                                newProblemDiv.classList.add('form-group', 'd-flex', 'align-items-center');

                                                var newLabel = document.createElement('label');
                                                newLabel.textContent = 'Problem Description:';
                                                newLabel.style.marginRight = '10px';

                                                var newTextarea = document.createElement('textarea');
                                                newTextarea.name = 'problem_description[]';
                                                newTextarea.classList.add('form-control');
                                                newTextarea.required = true;
                                                newTextarea.style.flexGrow = '1';

                                                var removeButton = document.createElement('button');
                                                removeButton.type = 'button';
                                                removeButton.classList.add('btn', 'btn-danger', 'ml-2');
                                                removeButton.textContent = 'Remove';
                                                removeButton.addEventListener('click', function() {
                                                    newProblemDiv.remove();
                                                });

                                                newProblemDiv.appendChild(newLabel);
                                                newProblemDiv.appendChild(newTextarea);
                                                newProblemDiv.appendChild(removeButton);

                                                document.getElementById('additional-problems').appendChild(newProblemDiv);
                                            });
                                        </script>



                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Condition of Device:</label>
                                                <input type="text" name="condition_of_device" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Approx Repair Cost:</label>
                                                <input type="text" name="repair_cost_estimate" class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Repair Status:</label>
                                                <select name="repair_status" class="form-control" required>
                                                    <option value="Pending">Pending</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="ready">Ready for Pickup</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>






                                        <!-- Technician Assigned Dropdown -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Technician Assigned:</label>
                                                <select name="technician_assigned" class="form-control" required>
                                                    <?php
                                                    include '../dbconnection.php';

                                                    if ($conn->connect_error) {
                                                        die("Connection failed: " . $conn->connect_error);
                                                    }

                                                    $sql = "SELECT * FROM technician where shop_id = '$shop_id'  ORDER BY id DESC";
                                                    $result = $conn->query($sql);

                                                    if ($result && $result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . htmlspecialchars($row['catogery']) . "'>" . htmlspecialchars($row['catogery']) . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No Technicians Available</option>";
                                                    }

                                                    $conn->close();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <!--<div class="col-12 col-sm-6">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label>Engineer Action:</label>-->
                                        <!--        <input type="text" name="engineer" class="form-control" required>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <!-- Warranty on Repair -->
                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Warranty on Repair:</label>
                                                <input type="text" name="repair_warranty" class="form-control">
                                            </div>
                                        </div> -->
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Payment Details</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Payment Mode:</label>
                                                <select name="payment_mode" class="form-control" required>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Online">Online</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Repair Cost:</label>
                                                <input type="text" name="repair_cost" class="form-control"
                                                    required>
                                            </div>
                                        </div> -->




                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Advance Payment:</label>
                                                <input type="text" name="advance_payment" class="form-control" required>
                                            </div>
                                        </div>







                                        <div class="container">
                                            <h5 class="form-title"><span>Inward Check</span></h5>
                                            <form action="#" method="post">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Device Powering -->
                                                        <tr>
                                                            <td>Device is Powering On:</td>
                                                            <td>
                                                                <input type="radio" id="device_powering_w" name="device_powering" value="Working" required><label for="device_powering_w">W</label>
                                                                <input type="radio" id="device_powering_na" name="device_powering" value="Not Available"><label for="device_powering_na">NA</label>
                                                                <input type="radio" id="device_powering_nw" name="device_powering" value="Not Working"><label for="device_powering_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- Power Button -->
                                                        <tr>
                                                            <td>Power Button Is Working:</td>
                                                            <td>
                                                                <input type="radio" id="power_button_w" name="power_button" value="Working" required><label for="power_button_w">W</label>
                                                                <input type="radio" id="power_button_na" name="power_button" value="Not Available"><label for="power_button_na">NA</label>
                                                                <input type="radio" id="power_button_nw" name="power_button" value="Not Working"><label for="power_button_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- Volume Keys -->
                                                        <tr>
                                                            <td>Volume Keys are Working:</td>
                                                            <td>
                                                                <input type="radio" id="volume_keys_w" name="volume_keys" value="Working" required><label for="volume_keys_w">W</label>
                                                                <input type="radio" id="volume_keys_na" name="volume_keys" value="Not Available"><label for="volume_keys_na">NA</label>
                                                                <input type="radio" id="volume_keys_nw" name="volume_keys" value="Not Working"><label for="volume_keys_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- Display Working -->
                                                        <tr>
                                                            <td>Face ID is working:</td>
                                                            <td>
                                                                <input type="radio" id="display_working_w" name="face_idi" value="Working" required><label for="display_working_w">W</label>
                                                                <input type="radio" id="display_working_na" name="face_idi" value="Not Available"><label for="display_working_na">NA</label>
                                                                <input type="radio" id="display_working_nw" name="face_idi" value="Not Working"><label for="display_working_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- Touchscreen Working -->
                                                        <tr>
                                                            <td>Touchscreen is Working:</td>
                                                            <td>
                                                                <input type="radio" id="touchscreen_w" name="touchscreen" value="Working" required><label for="touchscreen_w">W</label>
                                                                <input type="radio" id="touchscreen_na" name="touchscreen" value="Not Available"><label for="touchscreen_na">NA</label>
                                                                <input type="radio" id="touchscreen_nw" name="touchscreen" value="Not Working"><label for="touchscreen_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- Speaker Working -->
                                                        <tr>
                                                            <td>Speaker is Working:</td>
                                                            <td>
                                                                <input type="radio" id="speaker_working_w" name="speaker_working" value="Working" required><label for="speaker_working_w">W</label>
                                                                <input type="radio" id="speaker_working_na" name="speaker_working" value="Not Available"><label for="speaker_working_na">NA</label>
                                                                <input type="radio" id="speaker_working_nw" name="speaker_working" value="Not Working"><label for="speaker_working_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- Charging Port Working -->
                                                        <tr>
                                                            <td>Charging Port is Working:</td>
                                                            <td>
                                                                <input type="radio" id="charging_port_w" name="charging_port" value="Working" required><label for="charging_port_w">W</label>
                                                                <input type="radio" id="charging_port_na" name="charging_port" value="Not Available"><label for="charging_port_na">NA</label>
                                                                <input type="radio" id="charging_port_nw" name="charging_port" value="Not Working"><label for="charging_port_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- Headphone Jack -->
                                                        <!--<tr>-->
                                                        <!--    <td>Headphone Jack is Working:</td>-->
                                                        <!--    <td>-->
                                                        <!--        <input type="radio" id="headphone_jack_w" name="headphone_jack" value="Working" required><label for="headphone_jack_w">W</label>-->
                                                        <!--        <input type="radio" id="headphone_jack_na" name="headphone_jack" value="Not Available"><label for="headphone_jack_na">NA</label>-->
                                                        <!--        <input type="radio" id="headphone_jack_nw" name="headphone_jack" value="Not Working"><label for="headphone_jack_nw">NW</label>-->
                                                        <!--    </td>-->
                                                        <!--</tr>-->

                                                        <!-- Back Cover -->
                                                        <!--<tr>-->
                                                        <!--    <td>Back Cover Damaged or Broken:</td>-->
                                                        <!--    <td>-->
                                                        <!--        <input type="radio" id="back_cover_w" name="back_cover" value="Working" required><label for="back_cover_w">W</label>-->
                                                        <!--        <input type="radio" id="back_cover_na" name="back_cover" value="Not Available"><label for="back_cover_na">NA</label>-->
                                                        <!--        <input type="radio" id="back_cover_nw" name="back_cover" value="Not Working"><label for="back_cover_nw">NW</label>-->
                                                        <!--    </td>-->
                                                        <!--</tr>-->

                                                        <!-- Body Damage -->
                                                        <!--<tr>-->
                                                        <!--    <td>Body is Damaged or has Dents:</td>-->
                                                        <!--    <td>-->
                                                        <!--        <input type="radio" id="body_damage_w" name="body_damage" value="Working" required><label for="body_damage_w">W</label>-->
                                                        <!--        <input type="radio" id="body_damage_na" name="body_damage" value="Not Available"><label for="body_damage_na">NA</label>-->
                                                        <!--        <input type="radio" id="body_damage_nw" name="body_damage" value="Not Working"><label for="body_damage_nw">NW</label>-->
                                                        <!--    </td>-->
                                                        <!--</tr>-->

                                                        <!-- Screw Head Damage -->
                                                        <tr>
                                                            <td>Screw Heads are Damaged</td>
                                                            <td>
                                                                <input type="radio" id="screw_head_w" name="screw_head" value="Working" required><label for="screw_head_w">W</label>
                                                                <input type="radio" id="screw_head_na" name="screw_head" value="Not Available"><label for="screw_head_na">NA</label>
                                                                <input type="radio" id="screw_head_nw" name="screw_head" value="Not Working"><label for="screw_head_nw">NW</label>
                                                            </td>
                                                        </tr>

                                                        <!-- SIM Tray -->
                                                        <tr>
                                                           <td>SIM Tray is Damaged or Missing:</td>
                                                           <td>
                                                               <input type="radio" id="sim_tray_w" name="sim_tray" value="Working" required><label for="sim_tray_w">W</label>
                                                               <input type="radio" id="sim_tray_na" name="sim_tray" value="Not Available"><label for="sim_tray_na">NA</label>
                                                               <input type="radio" id="sim_tray_nw" name="sim_tray" value="Not Working"><label for="sim_tray_nw">NW</label>
                                                           </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <!-- Submit Button -->
                                                <div class="col-12">
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </form>
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