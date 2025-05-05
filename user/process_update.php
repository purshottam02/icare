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
                                <form action="insertpro.php" method="post" enctype="multipart/form-data">
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

                                       
                                        <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>">

                                        

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

                                       
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Repair Details</span></h5>
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
                                                <label>Engineer Note:</label>
                                                <input type="text" name="engineer" class="form-control"
                                                    value="<?php echo $row["engineer"] ?>">
                                            </div>
                                        </div>


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

                                        <!-- Button to Add More Problem Descriptions -->



                                        <!-- <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Technician Assigned:</label>

                                                <select name="technician_assigned" class="form-control">
                                                    <?php
                                                    include '../dbconnection.php';
                                                    $shop_id = $_SESSION['user_session']['id'];
                                                    $sql = "SELECT * FROM technician where shop_id = $shop_id";
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





                                        <div class="col-12">
                                            <h5 class="form-title" style="margin-top: 40px;"><span>Checklist Inward Chick</span></h5>
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
                                        </form>



                                        <div class="col-12" style="    margin-top: 35px; text-align: center;">
                                            <button type="submit" name="update" name="addsubhead"
                                                class="btn btn-primary">Submit</button>
                                        </div>
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