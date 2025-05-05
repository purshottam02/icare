<?php
session_start();
include_once '../dbconnection.php';
if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
}



if (isset($_POST['add'])) {
    // $products = $_POST['products'];
    $product_name = $_POST['product_name'];
    $des = $_POST['des'];
    $product_cost = $_POST['product_cost'];
    $product_weight = $_POST['product_weight'];
    $product_image = "uploads/products/" . $_FILES["image"]["name"];
    $product_image1 = "uploads/products/" . $_FILES["image1"]["name"];
    $product_image2 = "uploads/products/" . $_FILES["image2"]["name"];



    if (move_uploaded_file($_FILES["image"]["tmp_name"], $product_image)) {
        "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
    }
    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $product_image)) {
        "The file " . basename($_FILES["image1"]["name"]) . " has been uploaded.";
    }
    if (move_uploaded_file($_FILES["image2"]["tmp_name"], $product_image)) {
        "The file " . basename($_FILES["image2"]["name"]) . " has been uploaded.";
    }

    $query = "INSERT INTO products(product_name,des,product_cost,product_weight,product_image,product_image1,product_image2) VALUES ('$product_name','$des','$product_cost','$product_weight','$product_image','$product_image1','$product_image2')";
    $query_run = mysqli_query($conn, $query);

    if (!$query_run) {
        echo "try again";
    } else {
        //echo "Registered Successfully";

        echo "<SCRIPT type='text/javascript'> //not showing me this
              alert('New Sub head Added successfully!!');
             window.location.replace('add_products.php');
            </SCRIPT>";
    }
}


?>


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

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<style>
    .form-group div {
        display: flex;
        gap: 10px;
        align-items: center;
    }
</style>


<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Update Customers Information</h3>
                            <ul class="breadcrumb">
                                <!--    <li class="breadcrumb-item"><a href="coursesdesc.php">Sub Head</a></li>
                                <li class="breadcrumb-item active">Add Sub Head</li> -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="a.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- <div class="col-12">
                                            <h5 class="form-title"><span>Edit Information</span></h5>
                                        </div> -->
                                        <?php
                                        include '../dbconnection.php';
                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM customers WHERE id='$id'";
                                        $result = $conn->query($sql);

                                        $row = $result->fetch_assoc() ?>

                                        <!--   <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                               <label for="Product">Add Product</label>
                                                <input type="text" name="products" class="form-control" id="Product" placeholder="Product Name" required>
                                            </div>
                                        </div> -->
                                        <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>">

                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="Product">First Name:</label>
                                                <input type="text" name="first_name" class="form-control"
                                                    value="<?php echo $row["first_name"] ?>"
                                                    oninput="validateText(this)">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name:</label>
                                                <input type="text" name="last_name" class="form-control"
                                                    value="<?php echo $row["last_name"] ?>"
                                                    oninput="validateText(this)">
                                            </div>
                                        </div>

                                        <script>
                                            function validateText(input) {
                                                input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
                                            }
                                        </script>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Email Address:</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="<?php echo $row["email"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile Number:</label>
                                                <input type="tel" name="mobile_number" class="form-control"
                                                    oninput="validateMobileNumber(this)" maxlength="10"
                                                    value="<?php echo $row["mobile_number"] ?>">
                                            </div>
                                        </div> -->

                                        <script>
                                            function validateMobileNumber(input) {
                                                // Remove non-digit characters
                                                input.value = input.value.replace(/\D/g, '');

                                                // Ensure only the first 10 digits are kept
                                                if (input.value.length > 10) {
                                                    input.value = input.value.slice(0, 10);
                                                }
                                            }
                                        </script>

                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Address:</label>
                                                <input type="text" name="address" class="form-control"
                                                    value="<?php echo $row["address"] ?>">
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-12">
                                            <h5 class="form-title"><span>Device Information</span></h5>
                                        </div> -->

                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device Brand:</label>
                                                <input type="text" name="device_brand" class="form-control"
                                                    value="<?php echo $row["device_brand"] ?>">
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device Model:</label>
                                                <input type="text" name="device_model" class="form-control"
                                                    value="<?php echo $row["device_model"] ?>">
                                            </div>
                                        </div> -->

                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>IMEI Number:</label>
                                                <input type="text" name="imei_number" class="form-control"
                                                    value="<?php echo $row["imei_number"] ?>">
                                            </div>
                                        </div> -->

                                        <!--<div class="col-12 col-sm-6">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label>Diagnosis Details:</label>-->
                                        <!--        <input type="text" name="diagnosis" class="form-control"-->
                                        <!--            value="<?php echo $row["diagnosis"] ?>">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        
                                        <?php
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d H:i:s");
?>
<input type="hidden" name="outdate" value="<?=$date?>">

                                        <div class="col-12">
                                            <h5 class="form-title"><span>Repair Details</span></h5>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Repair Cost Estimate:</label>
                                                <input type="text" name="repair_cost_estimate" readonly class="form-control"
                                                    value="<?php echo $row["repair_cost_estimate"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Repair Final Cost :</label>
                                                <input type="text" name="finalcost" class="form-control"
                                                    value="<?php echo $row["finalcost"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label> Remaining Payment Mode:</label>
                                                <select name="remaining_payment_mode" class="form-control" required>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Online">Online</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Part Warranty:</label>
                                                <input type="text" name="repair_warranty" class="form-control"
                                                    value="<?php echo $row["repair_warranty"] ?>">
                                            </div>
                                        </div> -->


                                        <?php
                                        $sql_problem = "SELECT problem_description FROM customer_problem WHERE customer_id = " . $row['id'];
                                        $result_problem = $conn->query($sql_problem);

                                        if ($result_problem->num_rows > 0) {
                                            while ($problem_row = $result_problem->fetch_assoc()) {
                                        ?>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Problem Description:</label>
                                                        <input name="problem_description[]" class="form-control"
                                                            value="<?php echo $problem_row['problem_description']; ?>">
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "No Problems Reported";
                                        }
                                        ?>

                                        <!-- Additional Problem Descriptions -->
                                        <div id="additional-problems" class="col-12 col-sm-6"></div>

                                        <!-- Button to Add More Problem Descriptions -->
                                        <div class="col-12 col-sm-6">
                                            <button type="button" id="add-problem" class="btn btn-primary">Add More
                                                Problem Description</button>
                                        </div>

                                        <!-- JavaScript to Add More Problem Descriptions -->
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

                                        

                                        <!-- Additional Problem Descriptions -->
                                       

                                        <!-- Button to Add More Problem Descriptions -->
                                       
                                        <!-- JavaScript to Add More Problem Descriptions -->
                                        <script>
                                            document.getElementById('add-accessories').addEventListener('click', function() {
                                                var newaccessoriesDiv = document.createElement('div');
                                                newaccessoriesDiv.classList.add('form-group');

                                                var newLabel = document.createElement('label');
                                                newLabel.textContent = 'accessories:';

                                                var newTextarea = document.createElement('textarea');
                                                newTextarea.name = 'accessories[]';
                                                newTextarea.classList.add('form-control');
                                                newTextarea.required = true;

                                                newaccessoriesDiv.appendChild(newLabel);
                                                newaccessoriesDiv.appendChild(newTextarea);

                                                document.getElementById('additional-accessories').appendChild(newaccessoriesDiv);
                                            });
                                        </script>




                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Technician Assigned:</label>

                                                <select name="technician_assigned" class="form-control">
                                                    <?php
                                                    include '../dbconnection.php';
                                                    $sql = "SELECT * FROM technician ORDER BY technician.id ASC";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        $srno = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $row["catogery"]; ?>">
                                                                <?php echo $row["catogery"]; ?>
                                                            </option>
                                                    <?php
                                                            $srno++;
                                                        }
                                                    } else {
                                                        echo "No Data In Database";
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div> -->

















                                        <!-- <div class="col-12">
                                            <h5 class="form-title"><span>Checklist Inward Chick</span></h5>
                                        </div> -->

                                        <?php
                                        include '../dbconnection.php';

                                        $id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Ensure id is an integer

                                        $sql = "SELECT * FROM customers WHERE id = ?";
                                        $stmt = $conn->prepare($sql); // Prepare the SQL statement

                                        if ($stmt) { // Check if preparation was successful
                                            $stmt->bind_param('i', $id); // Bind the parameter
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                            } else {
                                                echo "No customer found with the given ID.";
                                                $row = []; // Ensure $row is defined
                                            }

                                            $stmt->close(); // Close the prepared statement
                                        } else {
                                            echo "Error preparing statement: " . $conn->error; // Output error if preparation failed
                                        }

                                        $conn->close(); // Close the database connection
                                        ?>
                                        <!-- First Name -->
                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device is Powering On:</label>
                                                <div>
                                                    <input type="radio" id="device_powering_yes" name="device_powering" value="W" <?php echo ($row['device_powering'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="device_powering_yes">W</label>
                                                    <input type="radio" id="device_powering_no" name="device_powering" value="NA" <?php echo ($row['device_powering'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="device_powering_no">NA</label>
                                                    <input type="radio" id="device_powering_no" name="device_powering" value="NW" <?php echo ($row['device_powering'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="device_powering_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Power Button Is Working:</label>
                                                <div>
                                                    <input type="radio" id="power_button_yes" name="power_button" value="W"
                                                        <?php echo ($row['power_button'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="power_button_yes">W</label>
                                               
                                               
                                                    <input type="radio" id="power_button_no" name="power_button" value="NA"
                                                        <?php echo ($row['power_button'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="power_button_no">NA</label>
                                               
                                                
                                                    <input type="radio" id="power_button_no" name="power_button" value="NW"
                                                        <?php echo ($row['power_button'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="power_button_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Volume Keys are Working:</label>
                                                <div>
                                                    <input type="radio" id="volume_keys_yes" name="volume_keys" value="W"
                                                        <?php echo ($row['volume_keys'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="volume_keys_yes">W</label>
                                               
                                                    <input type="radio" id="volume_keys_no" name="volume_keys" value="NA"
                                                        <?php echo ($row['volume_keys'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="volume_keys_no">NA</label>
                                               
                                                    <input type="radio" id="volume_keys_no" name="volume_keys" value="NW"
                                                        <?php echo ($row['volume_keys'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="volume_keys_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Display is working:</label>
                                                <div>
                                                    <input type="radio" id="display_working_yes" name="display_working" value="W"
                                                        <?php echo ($row['display_working'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="display_working_yes">W</label>
                                              
                                                    <input type="radio" id="display_working_no" name="display_working" value="NA"
                                                        <?php echo ($row['display_working'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="display_working_no">NA</label>
                                               
                                                    <input type="radio" id="display_working_no" name="display_working" value="NW"
                                                        <?php echo ($row['display_working'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="display_working_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Touchscreen is Working:</label>
                                                <div>
                                                    <input type="radio" id="touchscreen_yes" name="touchscreen" value="W"
                                                        <?php echo ($row['touchscreen'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="touchscreen_yes">W</label>
                                               
                                                    <input type="radio" id="touchscreen_no" name="touchscreen" value="NA"
                                                        <?php echo ($row['touchscreen'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="touchscreen_no">NA</label>
                                              
                                                    <input type="radio" id="touchscreen_no" name="touchscreen" value="NW"
                                                        <?php echo ($row['touchscreen'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="touchscreen_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Speaker is Working:</label>
                                                <div>
                                                    <input type="radio" id="speaker_working_yes" name="speaker_working" value="W"
                                                        <?php echo ($row['speaker_working'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="speaker_working_yes">W</label>
                                               
                                                    <input type="radio" id="speaker_working_no" name="speaker_working" value="NA"
                                                        <?php echo ($row['speaker_working'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="speaker_working_no">NA</label>
                                               
                                                    <input type="radio" id="speaker_working_no" name="speaker_working" value="NW"
                                                        <?php echo ($row['speaker_working'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="speaker_working_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Charging Port is Working:</label>
                                                <div>
                                                    <input type="radio" id="charging_port_yes" name="charging_port" value="W"
                                                        <?php echo ($row['charging_port'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="charging_port_yes">W</label>
                                               
                                                    <input type="radio" id="charging_port_no" name="charging_port" value="NA"
                                                        <?php echo ($row['charging_port'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="charging_port_no">NA</label>
                                               
                                                    <input type="radio" id="charging_port_no" name="charging_port" value="NW"
                                                        <?php echo ($row['charging_port'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="charging_port_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Headphone Jack is Working:</label>
                                                <div>
                                                    <input type="radio" id="headphone_jack_yes" name="headphone_jack" value="W"
                                                        <?php echo ($row['headphone_jack'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="headphone_jack_yes">W</label>
                                               
                                                    <input type="radio" id="headphone_jack_no" name="headphone_jack" value="NA"
                                                        <?php echo ($row['headphone_jack'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="headphone_jack_no">NA</label>
                                               
                                                    <input type="radio" id="headphone_jack_no" name="headphone_jack" value="NW"
                                                        <?php echo ($row['headphone_jack'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="headphone_jack_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Back Cover Damaged or Broken:</label>
                                                <div>
                                                    <input type="radio" id="back_cover_yes" name="back_cover" value="W"
                                                        <?php echo ($row['back_cover'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="back_cover_yes">W</label>
                                               
                                                    <input type="radio" id="back_cover_no" name="back_cover" value="NA"
                                                        <?php echo ($row['back_cover'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="back_cover_no">NA</label>
                                                
                                                    <input type="radio" id="back_cover_no" name="back_cover" value="NW"
                                                        <?php echo ($row['back_cover'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="back_cover_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Body is Damaged or has Dents:</label>
                                                <div>
                                                    <input type="radio" id="body_damage_yes" name="body_damage" value="W"
                                                        <?php echo ($row['body_damage'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="body_damage_yes">W</label>
                                               
                                                    <input type="radio" id="body_damage_no" name="body_damage" value="NA"
                                                        <?php echo ($row['body_damage'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="body_damage_no">NA</label>
                                               
                                                    <input type="radio" id="body_damage_no" name="body_damage" value="NW"
                                                        <?php echo ($row['body_damage'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="body_damage_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Screw Heads are Damaged or Missing:</label>
                                                <div>
                                                    <input type="radio" id="screw_head_yes" name="screw_head" value="W"
                                                        <?php echo ($row['screw_head'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="screw_head_yes">W</label>
                                               
                                                    <input type="radio" id="screw_head_no" name="screw_head" value="NA"
                                                        <?php echo ($row['screw_head'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="screw_head_no">NA</label>
                                               
                                                    <input type="radio" id="screw_head_no" name="screw_head" value="NW"
                                                        <?php echo ($row['screw_head'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="screw_head_no">NW</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>SIM Tray is Damaged or Missing:</label>
                                                <div>
                                                    <input type="radio" id="sim_tray_yes" name="sim_tray" value="W"
                                                        <?php echo ($row['sim_tray'] == 'W') ? 'checked' : ''; ?>>
                                                    <label for="sim_tray_yes">W</label>
                                               
                                                    <input type="radio" id="sim_tray_no" name="sim_tray" value="NA"
                                                        <?php echo ($row['sim_tray'] == 'NA') ? 'checked' : ''; ?>>
                                                    <label for="sim_tray_no">NA</label>
                                              
                                                    <input type="radio" id="sim_tray_no" name="sim_tray" value="NW"
                                                        <?php echo ($row['sim_tray'] == 'NW') ? 'checked' : ''; ?>>
                                                    <label for="sim_tray_no">NW</label>
                                                </div>
                                            </div>
                                        </div> -->


                                        <div class="col-12">
                                            <h5 class="form-title" style="margin-top:40px;"><span>Checklist Inward Chick</span></h5>
                                        </div>

                                        <?php
                                        include '../dbconnection.php';

                                        $id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Ensure id is an integer

                                        $sql = "SELECT * FROM customers WHERE id = ?";
                                        $stmt = $conn->prepare($sql); // Prepare the SQL statement

                                        if ($stmt) { // Check if preparation was successful
                                            $stmt->bind_param('i', $id); // Bind the parameter
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                            } else {
                                                echo "No customer found with the given ID.";
                                                $row = []; // Ensure $row is defined
                                            }

                                            $stmt->close(); // Close the prepared statement
                                        } else {
                                            echo "Error preparing statement: " . $conn->error; // Output error if preparation failed
                                        }

                                        $conn->close(); // Close the database connection
                                        ?>
                                        <!-- First Name -->
                                        <?php
                                        // Assuming you have already established a database connection $conn
                                        // Also assuming you have fetched the row from the database, e.g.:
                                        // $row = mysqli_fetch_assoc($result);
                                        ?>

                                        <form method="POST" action="">
                                            <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse; text-align: left; font-family: Arial, sans-serif;">
                                                <tr style="background-color: #f2f2f2; text-align: center;">
                                                    <th>Field</th>
                                                    <th>Status</th>
                                                </tr>

                                                <tr>
                                                    <td><strong>Device is Powering On:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['device_powering']; ?></span></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Power Button Is Working:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['power_button']; ?></span></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Volume Keys are Working:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['volume_keys']; ?></span></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Face Id:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['face_idi']; ?></span></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Touchscreen is Working:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['touchscreen']; ?></span></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Speaker is Working:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['speaker_working']; ?></span></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Charging Port is Working:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['charging_port']; ?></span></td>
                                                </tr>

                                                

                                                <tr>
                                                    <td><strong>Screw Heads are Damaged or Missing:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['screw_head']; ?></span></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>SIM Tray is Damaged or Missing:</strong></td>
                                                    <td style="text-align: center;"><span style="font-weight: 900;"><?php echo $row['sim_tray']; ?></span></td>
                                                </tr>
                                            </table>



                                            <div class="col-12" style="margin-top: 40px;">
                                                <h5 class="form-title"><span>Checklist Outward Check</span></h5>
                                            </div>

                                            <form action="a.php" method="post" enctype="multipart/form-data">
                                                <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse; text-align: left;">
                                                    <thead>
                                                        <tr>
                                                            <th>Checklist Item</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Device is Powering On:</td>
                                                            <td>
                                                                <label><input type="radio" name="device" value="Working" <?php if ($row['device'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="device" value="Not Available" <?php if ($row['device'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="device" value="Not Working" <?php if ($row['device'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Power Button Is Working:</td>
                                                            <td>
                                                                <label><input type="radio" name="power" value="Working" <?php if ($row['power'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="power" value="Not Available" <?php if ($row['power'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="power" value="Not Working" <?php if ($row['power'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Volume Keys are Working:</td>
                                                            <td>
                                                                <label><input type="radio" name="volume" value="Working" <?php if ($row['volume'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="volume" value="Not Available" <?php if ($row['volume'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="volume" value="Not Working" <?php if ($row['volume'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Face Id:</td>
                                                            <td>
                                                                <label><input type="radio" name="face_id" value="Working" <?php if ($row['face_id'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="face_id" value="Not Available" <?php if ($row['face_id'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="face_id" value="Not Working" <?php if ($row['face_id'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Touchscreen is Working:</td>
                                                            <td>
                                                                <label><input type="radio" name="touch" value="Working" <?php if ($row['touch'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="touch" value="Not Available" <?php if ($row['touch'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="touch" value="Not Working" <?php if ($row['touch'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Speaker is Working:</td>
                                                            <td>
                                                                <label><input type="radio" name="speaker" value="Working" <?php if ($row['speaker'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="speaker" value="Not Available" <?php if ($row['speaker'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="speaker" value="Not Working" <?php if ($row['speaker'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Charging Port is Working:</td>
                                                            <td>
                                                                <label><input type="radio" name="charging" value="Working" <?php if ($row['charging'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="charging" value="Not Available" <?php if ($row['charging'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="charging" value="Not Working" <?php if ($row['charging'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>Screw Heads are Damaged or Missing:</td>
                                                            <td>
                                                                <label><input type="radio" name="heads" value="Working" <?php if ($row['heads'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="heads" value="Not Available" <?php if ($row['heads'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="heads" value="Not Working" <?php if ($row['heads'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>SIM Tray is Damaged or Missing:</td>
                                                            <td>
                                                                <label><input type="radio" name="simtray" value="Working" <?php if ($row['simtray'] == 'Working') echo 'checked'; ?>> W</label>
                                                                <label><input type="radio" name="simtray" value="Not Available" <?php if ($row['simtray'] == 'Not Available') echo 'checked'; ?>> NA</label>
                                                                <label><input type="radio" name="simtray" value="Not Working" <?php if ($row['simtray'] == 'Not Working') echo 'checked'; ?>> NW</label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div style="margin-top: 15px; text-align: center;">
                                                    <button type="submit" name="update" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>

                                    </div>
                            </div>
                        </div>
                    </div>









                </div>


                <footer>
                    <p>Copyright © 2024 </p>
                </footer>
            </div>
        </div>

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