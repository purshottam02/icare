<?php
session_start();
include_once '../dbconnection.php';

// Check if the user is logged in
if (empty($_SESSION['user_session'])) {
    header('Location: login.php');
    exit();
}

// Validate the ID from the query parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    die("Invalid ID");
}

// Fetch customer data
$stmt = $conn->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if (!$customer) {
    die("Customer not found");
}

// Fetch shop data
$shop_result = $conn->query("SELECT * FROM addshop LIMIT 1");
$shop = $shop_result->fetch_assoc();

// Fetch customer problems
$problem_stmt = $conn->prepare("SELECT problem_description FROM customer_problem WHERE customer_id = ?");
$problem_stmt->bind_param("i", $id);
$problem_stmt->execute();
$problem_result = $problem_stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>iCARE Apple Service Centre</title>

    <link rel="icon" type="image/png" href="assets/img/logoo.jpg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    table {
        font-size: 17px;
    }

    body {
        font-family: 'Roboto', sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
        background-color: #f7f7f7;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid #e0e0e0;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #e9ecef;
        color: black;
    }

    td {
        background-color: #f9f9f9;
    }

    .barcode {
        text-align: center;
        font-family: 'Libre Barcode', Roboto;
        font-size: 30px;
    }

    .no-border {
        border: none;
    }

    .section-title {
        font-weight: bold;
        background-color: #e9ecef;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .terms {
        margin-top: 20px;
        font-weight: bold;
    }
</style>

<body>
    <div class="main-wrapper">
      
        <div class="page-wrapper" style="margin-left:0px">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title" style="text-align: center; font-size: 40px; font-weight: 600;">Customer Full Information</h3>
                            <ul class="breadcrumb">
                                <!--    <li class="breadcrumb-item"><a href="coursesdesc.php">Sub Head</a></li>
                                <li class="breadcrumb-item active">Add Sub Head</li> -->
                            </ul>
                        </div>
                        <div class="col-auto text-right float-right ml-auto">
                             <!--<a class="btn btn-primary" onclick="exportTableToExcel('tblData')">Download</a> -->
                            <a href="completed.php" class="btn btn-primary">Back Page <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <!-- <h1 style="text-align: center; color: #333;">Customer Bill</h1> -->
                    <table>
                        <tr>
                            <?php
                            include '../dbconnection.php';
                            $id = $_SESSION['user_session']['id'];
                            $sql = "SELECT * FROM addshop where id='$id' ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <th colspan="2" style="padding: 0px;">
                                        <img src="assets/img/logoup.png" alt="Logo" style="width: 22%;">
                                    </th>
                                    <!-- <th colspan="2" style="font-size: 44px; font-weight: 100;">iCARE</th> -->
                                    <th colspan="8" style="font-size: 22px; font-weight: 600;">Apple Service Centre </th>


                        </tr>









                        <tr>
                            <td style="font-weight: 600;">Job No:</td>
                            <td><?php echo htmlspecialchars($customer["reference"]); ?></td>
                            <td rowspan="4" colspan="8">

                                <span style="font-weight: 600;"> Address:</span>
                                <?php echo htmlspecialchars($row["address"]); ?><br><br>
                                <span style="font-weight: 600;"> Contact Number:</span>
                                <?php echo htmlspecialchars($row["number"]); ?><br><br>
                                <span style="font-weight: 600;"> Email ID:</span>
                                <?php echo htmlspecialchars($row["email"]); ?><br><br>
                                <span style="font-weight: 600;">Shop opening Time & day: </span>
                                <?php echo htmlspecialchars($row["opentime"]); ?><br><br>
                                <span style="font-weight: 600;">Customer Support Number: </span>
                                <?php echo htmlspecialchars($row["customer_support_number"]); ?><br><br>
                            </td>

                    <?php
                                }
                            } else {
                                
                            }
                    ?>
                        </tr>
                        <tr>

                        </tr>
                       

                        <tr>
                            <td style="font-weight: 600;">Date of Device Inward:</td>
                            <td><?php echo htmlspecialchars($customer["created_at"]); ?></td>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Date of Device Outword:</td>
                            <td><?php echo htmlspecialchars($customer["outworddatetime"]); ?></td>
                            
                        </tr>

                        <tr>

                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Customer Details</td>

                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Checklist </td>

                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Inward Check </td>

                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">OutWard Check </td>

                        </tr>

                        <tr>
                            <td style="font-weight: 600;">Full Name:</td>
                            <td><?php echo htmlspecialchars($customer["first_name"]); ?> <?php echo htmlspecialchars($customer["last_name"]); ?>
                            <td style="font-weight: 600;">Device is Powering On</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["device_powering"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["device"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Contact Number:</td>
                            <td><?php echo htmlspecialchars($customer["mobile_number"]); ?></td>
                            <td style="font-weight: 600;">Power Button is Working</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["power_button"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["power"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Email ID:</td>
                            <td><?php echo htmlspecialchars($customer["email"]); ?></td>
                            <td style="font-weight: 600;">Volume Keys are Working</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["volume_keys"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["volume"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Address:</td>
                            <td><?php echo htmlspecialchars($customer["address"]); ?></td>
                            <td style="font-weight: 600;">Face Id</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["face_idi"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["touch"]); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Product Details</td>
                            <td style="font-weight: 600;">Touchscreen is Working</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["touchscreen"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["touch"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Product Name:</td>
                            <td><?php echo htmlspecialchars($customer["device_brand"]); ?> <?php echo htmlspecialchars($customer["device_model"]); ?></td>
                            <td style="font-weight: 600;">Speaker is Working</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["speaker_working"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["speaker"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Product Warranty Status </td>
                            <?php
                            $fetched_value = htmlspecialchars($customer["servicetype"]); // Assume this contains the fetched value.
                            ?>
                            <td colspan="1">
                                <table>
                                    <tr>
                                        <!-- Check if 'Warranty' is selected -->
                                        <?php if ($fetched_value == 'Warranty') : ?>
                                            <td style="border: none; padding: 0px;">
                                                <label for="warranty" class="gray-text" style="margin: 0px;">Warranty</label>
                                            </td>
                                        <?php endif; ?>

                                        <!-- Check if 'App' is selected -->
                                        <?php if ($fetched_value == 'App') : ?>
                                            <td style="border: none; padding: 0px;">
                                                <label for="app" class="gray-text" style="margin: 0px;">App</label>
                                            </td>
                                        <?php endif; ?>

                                        <!-- Check if 'OOW' is selected -->
                                        <?php if ($fetched_value == 'OOW') : ?>
                                            <td style="border: none; padding: 0px;">
                                                <label for="oow" class="gray-text" style="margin: 0px;">OOW</label>
                                            </td>
                                        <?php endif; ?>

                                        <!-- Check if 'Others' is selected -->
                                        <?php if ($fetched_value == 'Others') : ?>
                                            <td style="border: none; padding: 0px;">
                                                <label for="others" class="gray-text" style="margin: 0px;">Others</label>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </td>
                            <td style="font-weight: 600;">Charging Port is Working</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["charging_port"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["charging"]); ?></td>

                        </tr>


                        <tr>
                            <td style="font-weight: 600;">IMEI:</td>
                            <td><?php echo htmlspecialchars($customer["imei_number"]); ?></td>

                            <!-- Show Headphone Jack value -->
                            <td style="font-weight: 600;">Screw Heads are Damaged</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["screw_head"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["heads"]); ?></td>

                        </tr>

                        <script>
                            // Function to allow only one checkbox to be selected at a time
                            function selectOnlyThis(checkbox) {
                                var checkboxes = document.getElementsByName('service_type[]');
                                checkboxes.forEach((item) => {
                                    if (item !== checkbox) item.checked = false;
                                });
                            }
                        </script>

                        <tr>
                            <td style="font-weight: 600;">Part Warranty Status:</td>
                            <td><?php echo htmlspecialchars($customer["repair_warranty"]); ?></td>

                            <!-- Show Headphone Jack value -->
                            <td style="font-weight: 600;">SIM Tray is Damaged or Missing</td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["sim_tray"]); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($customer["simtray"]); ?></td>

                        </tr>

                        <tr>
                            <td style="font-weight: 600;">Engineer Action:</td>
                            <td colspan="8"><?php echo htmlspecialchars($customer["engineer"]); ?></td>

                            <!-- Show Headphone Jack value -->


                        </tr>



                        <tr>
                            <td colspan="8" class="section-title" style="font-size: 20px; font-weight: 600;">Issue
                                Reported by Customer</td>

                        </tr>
                        <tr>
                            <td colspan="1" style="font-weight: 600;">Category</td>
                            <td colspan="8" style="font-weight: 600;">Description</td>

                        </tr>
                        <?php
                        if ($problem_result->num_rows > 0) {
                            while ($problem_row = $problem_result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($customer['category']) . '</td>';
                                echo '<td  colspan="8">' . htmlspecialchars($problem_row['problem_description']) . '</td>';

                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2">No Problems Reported</td><td colspan="2" class="no-border"></td></tr>';
                        }
                        ?>

                        <tr>
                            <td colspan="8" class="section-title" style="font-size: 20px; font-weight: 600;">Diagnosis Details:</td>
                            <!-- <td colspan="1" class="section-title"></td> -->


                        </tr>
                        <tr>
                            <td colspan="8" style="    padding: 15px 5px;"><?php echo htmlspecialchars($customer["diagnosis"]); ?></td>


                        </tr>


                        <tr>
                            <td colspan="8" class="section-title" style="font-size: 20px; font-weight: 600;">Cosmetic
                                Condition of Product:</td>
                            <!-- <td colspan="3" class="section-title">Accessories Received</td> -->



                        </tr>

                        <?php
                        include '../dbconnection.php';

                        // Make sure $id is defined and has a value
                        $id = isset($_GET['id']) ? $_GET['id'] : ''; // Example: if $id is passed as a query parameter

                        // Check if $id is not empty
                        if (!empty($id)) {
                            // Fetch all accessories data for the given customer_id
                            $sql = "SELECT * FROM accessories WHERE customer_id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $id); // Using a prepared statement for safety
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $srno = 1;
                                $staticTextDisplayed = false; // Flag to track if static text is displayed

                                while ($row = $result->fetch_assoc()) {
                                    if (!$staticTextDisplayed) {
                                        // Display the static text once
                                        echo '<tr>
                        <td colspan="8">Regular usage marks, scratches, and dents on device; data loss; internal needs to be checked</td>
                      </tr>';
                                        $staticTextDisplayed = true; // Set flag to true after displaying
                                    } else {
                                        // Display only accessories for subsequent rows
                                        echo '<tr>
                        <td colspan="2"></td> <!-- Empty for alignment -->
                        <td colspan="3">' . htmlspecialchars($row["accessories"]) . '</td>
                      </tr>';
                                    }
                                    $srno++;
                                }
                            } else {
                                echo "<tr><td colspan='8'></td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'></td></tr>";
                        }
                        ?>
                        <?php
                        // Include the database connection file
                        include '../dbconnection.php';

                        // Get customer ID from the URL (make sure it is passed as a GET parameter)
                        $id = isset($_GET['id']) ? $_GET['id'] : '';

                        // Ensure $id is not empty before proceeding
                        if (!empty($id)) {

                            // Correct the SQL query to match the correct column name (assuming it's "id")
                            $sql = "SELECT payment_mode, repair_cost_estimate, advance_payment, finalcost,remaining_payment_mode FROM customers WHERE id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $id);  // Bind the customer ID to the SQL query
                            $stmt->execute();
                            $result = $stmt->get_result();  // Fetch the result

                            // Check if data exists for this customer
                            if ($result->num_rows > 0) {
                                // Fetch the first row (only one payment record per customer in your case)
                                $payment_row = $result->fetch_assoc();
                            } else {
                                // If no data found, set $payment_row to null
                                $payment_row = null;
                            }

                            // Close the prepared statement
                            $stmt->close();
                        } else {
                            // If customer ID is not set, set $payment_row to null
                            $payment_row = null;
                        }
                        ?>
                        <!-- Payment Details Section -->
                        <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: auto;">
                            <!-- Payment Details Heading -->
                            <tr>
                                <td colspan="4" class="section-title" style="font-size: 18px; font-weight: 600; padding: 12px; text-align: center; background-color: #f2f2f2;">
                                    Payment Details
                                </td>
                            </tr>

                            <?php if ($payment_row): ?>
                                <!-- Payment Mode Row -->
                                <tr>
                                    <td style="font-weight: 600; padding: 10px; text-align: left; width: 30%; background-color: #f9f9f9;">Payment Mode</td>
                                    <td style="padding: 10px; width: 70%;"><?php echo htmlspecialchars($payment_row["payment_mode"]); ?></td>
                                </tr>

                                <!-- Repair Cost Row -->
                                <tr>
                                    <td style="font-weight: 600; padding: 10px; text-align: left; background-color: #f9f9f9;">Repair Cost</td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($payment_row["repair_cost_estimate"]); ?></td>
                                </tr>

                                <!-- Advance Payment Row -->
                                <tr>
                                    <td style="font-weight: 600; padding: 10px; text-align: left; background-color: #f9f9f9;">Advance Payment</td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($payment_row["advance_payment"]); ?></td>
                                </tr>
                                <!-- Remaining payment mode -->
                                <tr>
                                    <td style="font-weight: 600; padding: 10px; text-align: left; background-color: #f9f9f9;">Remaining Payment Mode</td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($payment_row["remaining_payment_mode"]); ?></td>
                                </tr>
                                <!-- Final Payment Row -->
                                <tr>
                                    <td style="font-weight: 600; padding: 10px; text-align: left; background-color: #f9f9f9;">Final Payment</td>
                                    <td style="padding: 10px;"><?php echo htmlspecialchars($payment_row["finalcost"]); ?></td>
                                </tr>


                            <?php else: ?>
                                <!-- If no payment data is available, display this message -->
                                <tr>
                                    <td colspan="4" style="padding: 10px; text-align: center; color: red; background-color: #f9f9f9;">
                                        No Payment Details Available for this Customer.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
    
                    </table>
                    <h6 class="mt-3 ">This is an electronically generated report, hence does not require a signature</h6>

                    <p class="mt-3" style="font-weight: 600;">Terms and Conditions:</p>
                    *Subject to Engineer’s inspection.<br>
                    *Quality program repairs will not cover all defective parts on non-chargeable basis.
                    <br>
                    *Only parts covered
                    under quality program will be covered as non-chargeable post inspection is completed by engineer.
                    <br>
                    *AASP shall receive customer devices without opening and diagnosed later.
                    <br>
                    *Contact details provided by the Customer will be shared to Apple for and/or feedback.
                    <br>
                    *Repair (In-warranty/ Out-Warranty) cannot be cancelled once repair is logged in with Apple.
                    <br>
                    *The Service Provider will not be responsible for any data loss, screen guard, wear and tear, and no
                    warranty
                    for liquid/physical damages, and unauthorised modifications found in the device.
                    </p>

                   

                  
                  
                </div>

            </div>



        </div>


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