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
                            <h3 class="page-title">Edit Customer Information</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Customer</li>
                            </ul>
                        </div>
                        <?php
                        $shopid= $_GET['shopid'];
                        ?>
                        <div class="col-auto text-right float-right ml-auto">
                             <!--<a class="btn btn-primary" onclick="exportTableToExcel('tblData')">Download</a> -->
                            <a href="view-complete.php?id=<?=$shopid?>" class="btn btn-primary">Back Page <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">

                                <form action="insertedit.php" method="post" enctype="multipart/form-data">
                                    <div class="row">

                                        <?php
                                        include '../dbconnection.php';
                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM customers WHERE id='$id'";
                                        $result = $conn->query($sql);

                                        $row = $result->fetch_assoc() ?>

                                        <div class="col-12">
                                            <h5 class="form-title"><span>Add Customer Information</span></h5>
                                        </div>
                                        <input type="hidden" value="<?php echo $shop_id; ?>" name="shop_id" class="form-control">

                                        <!-- First Name -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>First Name:</label>
                                                <input type="text" name="first_name" class="form-control" value="<?php echo $row["first_name"] ?>"

                                                    oninput="validateText(this)">
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name:</label>
                                                <input type="text" name="last_name" class="form-control" value="<?php echo $row["last_name"] ?>"
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
                                                <input type="email" name="email" class="form-control" value="<?php echo $row["email"] ?>">
                                            </div>
                                        </div>

                                        <!-- Mobile Number -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile Number:</label>
                                                <input type="tel" name="mobile_number" class="form-control" value="<?php echo $row["mobile_number"] ?>"
                                                    oninput="validateMobileNumber(this)" maxlength="10">
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
                                                <input type="text" name="address" class="form-control" value="<?php echo $row["address"] ?>">
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <h5 class="form-title"><span>Service Details</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-6">



                                            <div class="form-group">
                                                <label>Job No:</label>
                                                <input type="text" name="reference" value="<?php echo $row["reference"] ?>" class="form-control" readonly>

                                            </div>

                                        </div>

                                        <div class="col-12">
                                            <h5 class="form-title"><span>Device Information</span></h5>
                                        </div>

                                        <!-- Device Brand -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device Brand:</label>
                                                <input type="text" name="device_brand" value="Apple" readonly class="form-control">
                                            </div>
                                        </div>

                                        <!-- Device Model -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Device Model:</label>
                                                <input type="text" name="device_model" class="form-control" value="<?php echo $row["device_model"] ?>">
                                            </div>
                                        </div>

                                        <!-- IMEI Number -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>IMEI Number:</label>
                                                <input type="text" name="imei_number" class="form-control" value="<?php echo $row["imei_number"] ?>">
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
                                                    <?php
                                                    $servicetype = isset($row["servicetype"]) ? $row["servicetype"] : "";
                                                    ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="warranty" value="Warranty"
                                                            <?php echo ($servicetype == "Warranty") ? "checked" : ""; ?>>
                                                        <label class="form-check-label" for="warranty">Warranty</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="app" value="App"
                                                            <?php echo ($servicetype == "App") ? "checked" : ""; ?>>
                                                        <label class="form-check-label" for="app">App</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="oow" value="OOW"
                                                            <?php echo ($servicetype == "OOW") ? "checked" : ""; ?>>
                                                        <label class="form-check-label" for="oow">OOW</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="servicetype" id="others" value="Others"
                                                            <?php echo ($servicetype == "Others") ? "checked" : ""; ?>>
                                                        <label class="form-check-label" for="others">Others</label>
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
                                                <input type="text" name="category" class="form-control" value="<?php echo $row["category"] ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Technician Assigned:</label>

                                                <select name="technician_assigned" class="form-control">
                                                    <?php
                                                    include '../dbconnection.php';
                                                    $shop_id = $_SESSION['user_session']['id'];

                                                    // ✅ Fix the SQL query with WHERE condition
                                                    $sql = "SELECT `id`, `catogery` FROM `technician` WHERE shop_id = '$shop_id' ORDER BY `id` ASC";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $row["catogery"]; ?>">
                                                                <?php echo $row["catogery"]; ?>
                                                            </option>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<option>No Data Available</option>";
                                                    }
                                                    ?>
                                                </select>



                                            </div>
                                        </div>

                                        <!-- Problem Description Field -->
                                        <?php
                                        include '../dbconnection.php';
                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM customers WHERE id='$id'";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        ?>

                                        <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>">

                                        <!-- Fetch problem descriptions for the current customer -->
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
                                                <label>Repair Status:</label>
                                                <select name="repair_status" class="form-control" id="repairStatus"
                                                    onchange="changeColor()">
                                                    <option value="Pending" <?php if ($row["repair_status"] == 'Pending')
                                                                                echo 'selected'; ?>>Pending</option>
                                                    <option value="In Progress" <?php if ($row["repair_status"] == 'In Progress')
                                                                                    echo 'selected'; ?>>In Progress</option>
                                                    <option value="Completed" <?php if ($row["repair_status"] == 'Completed')
                                                                                    echo 'selected'; ?>>
                                                        Completed</option>
                                                </select>

                                                <script>
                                                    function changeColor() {
                                                        var select = document.getElementById("repairStatus");
                                                        var selectedValue = select.options[select.selectedIndex].value;
                                                        select.style.color = ''; // Reset color
                                                        switch (selectedValue) {
                                                            case "Pending":
                                                                select.style.color = "red";
                                                                break;
                                                            case "In Progress":
                                                                select.style.color = "blue";
                                                                break;
                                                            case "Completed":
                                                                select.style.color = "green";
                                                                break;
                                                        }
                                                    }
                                                    window.onload = changeColor;
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Condition of Device:</label>
                                                <input type="text" name="condition_of_device" class="form-control" value="<?php echo $row["condition_of_device"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Diagnosis Details:</label>
                                                <input type="text" name="diagnosis" class="form-control"
                                                    value="<?php echo $row["diagnosis"] ?>">
                                            </div>
                                        </div>



                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Part Warranty Status:</label>
                                                <input type="text" name="repair_warranty" class="form-control"
                                                    value="<?php echo $row["repair_warranty"] ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Engineer Action:</label>
                                                <input type="text" name="engineer" class="form-control"
                                                    value="<?php echo $row["engineer"] ?>">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <h5 class="form-title"><span>Payment Details</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Payment Mode:</label>
                                                <select name="payment_mode" class="form-control">
                                                    <?php
                                                    $payment_mode = isset($row["payment_mode"]) ? $row["payment_mode"] : ""; // Fetch from database
                                                    ?>
                                                    <option value="Cash" <?php echo ($payment_mode == "Cash") ? "selected" : ""; ?>>Cash</option>
                                                    <option value="Online" <?php echo ($payment_mode == "Online") ? "selected" : ""; ?>>Online</option>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Advance Payment:</label>
                                                <input type="text" name="advance_payment" class="form-control" value="<?php echo $row["advance_payment"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Approx Repair Cost:</label>
                                                <input type="text" name="repair_cost_estimate" class="form-control" value="<?php echo $row["repair_cost_estimate"] ?>">
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Repair Final Cost :</label>
                                                <input type="text" name="finalcost" class="form-control"
                                                    value="<?php echo $row["finalcost"] ?>">
                                            </div>
                                        </div>


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