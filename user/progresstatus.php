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

<body>
    <div class="main-wrapper">
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Update Status</h3>
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
                                <form action="c.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Update Status</span></h5>
                                        </div>


                                        <?php
                                        include '../dbconnection.php';
                                        $id = $_GET['id'];
                                        $sql = "SELECT * FROM customers WHERE id='$id'";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        ?>

                                        <input type="hidden" name="id" class="form-control" value="<?php echo $id ?>">

                                        <!-- Fetch problem descriptions for the current customer -->

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Approx Repair Cost:</label>
                                                <input name="repair_cost_estimate" class="form-control"
                                                    value="<?php echo $row["repair_cost_estimate"]; ?>">
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Repair Status:</label>
                                                <select name="repair_status" class="form-control" id="repairStatus"
                                                    onchange="changeColor()">
                                                    <option value="Pending" <?php if ($row["repair_status"] == 'Pending')
                                                                                echo 'selected'; ?>>Pending</option>

                                                    <option value="In Progress" <?php if ($row["repair_status"] == 'In Progress')
                                                                                    echo 'selected'; ?>>In Progress</option>

                                                    <option value="readyforpickup" <?php if ($row["repair_status"] == 'readyforpickup')
                                                                                            echo 'selected'; ?>>readyforpickup</option>

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
                                                            case "readyforpickup":
                                                                select.style.color = "purple";
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
                                                newProblemDiv.classList.add('form-group');

                                                var newLabel = document.createElement('label');
                                                newLabel.textContent = 'Problem Description:';

                                                var newTextarea = document.createElement('textarea');
                                                newTextarea.name = 'problem_description[]';
                                                newTextarea.classList.add('form-control');
                                                newTextarea.required = true;

                                                newProblemDiv.appendChild(newLabel);
                                                newProblemDiv.appendChild(newTextarea);

                                                document.getElementById('additional-problems').appendChild(newProblemDiv);
                                            });
                                        </script>


                                        <!-- Repair Status Dropdown -->


                                        <div class="col-12" style="margin-top: 29px; text-align: center;">
                                            <button type="submit" name="update" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <footer>
                <p>Copyright © 2022 </p>
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