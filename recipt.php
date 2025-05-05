<?php
session_start();
include_once 'dbconnection.php';

// Check if the user is logged in
// if (empty($_SESSION['user_session'])) {
//     header('Location: login.php');
//     exit();
// }

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

    <link rel="icon" type="image/png" href="user/assets/img/logoo.jpg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;0,600;0,700;1,400&amp;display=swap">

    <link rel="stylesheet" href="user/assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="user/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="user/assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="user/assets/css/style.css">
</head>
<style>
    /* Hide the default checkbox */
    input[type="checkbox"] {
        display: none;
    }

    /* Style each table cell to look like a button */
    .checkbox-button label {
        display: inline-block;
        padding: 3px 7px;
        font-weight: 500;
        border: 1px solid #333;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        text-align: center;
    }

    /* Change background color on hover */
    .checkbox-button label:hover {
        background-color: #f0f0f0;
    }

    /* Selected style for checkbox */
    input[type="checkbox"]:checked+label {
        background-color: #7f7f7f;
        color: white;
        border-color: #7f7f7f;
    }

    .gray-text {
        color: #000;
    }

    table {
        font-size: 14px;
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
        font-size: 20px;
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
        <?php include 'top.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title" style="text-align: center; font-size: 41px; font-weight: 600;">Service Reciept</h3>
                            <ul class="breadcrumb">
                                <!--    <li class="breadcrumb-item"><a href="coursesdesc.php">Sub Head</a></li>
                                <li class="breadcrumb-item active">Add Sub Head</li> -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <!-- <h1 style="text-align: center; color: #333;">Customer Bill</h1> -->
                    <table>
                        <tr>
                            <?php
                            include 'dbconnection.php';
                            $id = $_SESSION['user_session']['id'];
                            $sql = "SELECT * FROM addshop where id='$id' ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <th colspan="2" style="padding: 0px;">
                                        <img src="user/assets/img/logoup.png" alt="Logo" style="width: 22%;">
                                    </th>
                                    <!-- <th colspan="2" style="font-size: 44px; font-weight: 100;">iCARE</th> -->
                                    <th colspan="3" style="font-size: 22px; font-weight: 600;">Apple Service Centre </th>


                        </tr>

                        <tr>
                            <td style="font-weight: 600;">Job No:</td>
                            <td><?php echo htmlspecialchars($customer["reference"]); ?></td>
                            <td rowspan="4" colspan="5">

                                <span style="font-weight: 600;"> Address:</span>
                                <?php echo htmlspecialchars($row["address"]); ?><br><br>
                                <span style="font-weight: 600;"> Contact Number:</span>
                                <?php echo htmlspecialchars($row["number"]); ?><br><br>
                                <span style="font-weight: 600;"> Email ID:</span>
                                <?php echo htmlspecialchars($row["email"]); ?><br><br>
                                <span style="font-weight: 600;">Shop open Time & day: </span>
                                <?php echo htmlspecialchars($row["opentime"]); ?><br><br>
                                <span style="font-weight: 600;">Customer Support Number: </span>
                                <?php echo htmlspecialchars($row["customer_support_number"]); ?><br><br>
                            </td>

                    <?php
                                }
                            } else {
                                 "No Data In Database";
                            }
                    ?>
                        </tr>
                        <tr>

                        </tr>
                        <tr>

                        </tr>

                        <tr>
                            <td style="font-weight: 600;">Date of Device Inward:</td>
                            <td><?php echo htmlspecialchars($customer["created_at"]); ?></td>
                            </td>
                        </tr>

                        <tr>

                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Customer Details</td>

                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Checklist </td>

                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Inward Check </td>

                        </tr>

                        <tr>
                            <td style="font-weight: 600;">Full Name:</td>
                            <td><?php echo htmlspecialchars($customer["first_name"]); ?> <?php echo htmlspecialchars($customer["last_name"]); ?>
                            <td colspan="2" style="font-weight: 600;">Device is Powering On</td>
                            <td><?php echo htmlspecialchars($customer["device_powering"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Contact Number:</td>
                            <td><?php echo htmlspecialchars($customer["mobile_number"]); ?></td>
                            <td colspan="2" style="font-weight: 600;">Power Button is Working</td>
                            <td><?php echo htmlspecialchars($customer["power_button"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Email ID:</td>
                            <td><?php echo htmlspecialchars($customer["email"]); ?></td>
                            <td colspan="2" style="font-weight: 600;">Volume Keys are Working</td>
                            <td><?php echo htmlspecialchars($customer["volume_keys"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Address:</td>
                            <td><?php echo htmlspecialchars($customer["address"]); ?></td>
                            <td colspan="2" style="font-weight: 600;">Face Id</td>
                            <td><?php echo htmlspecialchars($customer["face_idi"]); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Product Details</td>
                            <td colspan="2" style="font-weight: 600;">Touchscreen is Working</td>
                            <td><?php echo htmlspecialchars($customer["touchscreen"]); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;">Product Name:</td>
                            <td><?php echo htmlspecialchars($customer["device_brand"]); ?> <?php echo htmlspecialchars($customer["device_model"]); ?></td>
                            <td colspan="2" style="font-weight: 600;">Speaker is Working</td>
                            <td><?php echo htmlspecialchars($customer["speaker_working"]); ?></td>
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
                            <td colspan="2" style="font-weight: 600;">Charging Port is Working</td>
                            <td><?php echo htmlspecialchars($customer["charging_port"]); ?></td>

                        </tr>


                        <tr>
                            <td style="font-weight: 600;">IMEI / Serial No:</td>
                            <td><?php echo htmlspecialchars($customer["imei_number"]); ?></td>

                            <!-- Show Headphone Jack value -->
                            <td colspan="2" style="font-weight: 600;">Screw Heads are Damaged</td>
                            <td><?php echo htmlspecialchars($customer["screw_head"]); ?></td>

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
                            <td colspan="2" class="section-title" style="font-size: 20px; font-weight: 600;">Issue
                                Reported by Customer</td>
                            <td colspan="2" style="font-weight: 600;">SIM Tray is Damaged or Missing</td>
                            <td><?php echo htmlspecialchars($customer["sim_tray"]); ?></td>
                        </tr>

                        <tr>
                            <td style="font-weight: 600;">Category</td>
                            <td style="font-weight: 600;">Description</td>
                            <td colspan="4" style="font-weight: 600;"></td>

                        </tr>
                        <tr>
                            <?php
                            if ($problem_result->num_rows > 0) {
                                while ($problem_row = $problem_result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($customer['category']) . '</td>';
                                    echo '<td colspan="8">' . htmlspecialchars($problem_row['problem_description']) . '</td>';

                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="2">No Problems Reported</td><td colspan="2" class="no-border"></td></tr>';
                            }
                            ?>

                        </tr>
                        <?php
                        if ($problem_result->num_rows > 0) {
                            while ($problem_row = $problem_result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($customer['category']) . '</td>';
                                echo '<td>' . htmlspecialchars($problem_row['problem_description']) . '</td>';
                                echo '<td colspan="2" class="no-border"></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="2">No Problems Reported</td><td colspan="2" class="no-border"></td></tr>';
                        }
                        ?>
                        <tr>
                            <td colspan="8" class="section-title" style="font-size: 20px; font-weight: 600;">Cosmetic
                                Condition of Product:</td>
                           
                        </tr>

                        <tr>
                            <td colspan="8" class=""><?php echo htmlspecialchars($customer["condition_of_device"]); ?></td>
                           
                        </tr>
                       

                        
                        <?php
                        // Include the database connection file
                        include 'dbconnection.php';

                        // Get customer ID from the URL (make sure it is passed as a GET parameter)
                        $id = isset($_GET['id']) ? $_GET['id'] : '';

                        // Ensure $id is not empty before proceeding
                        if (!empty($id)) {

                            // Correct the SQL query to match the correct column name (assuming it's "id")
                            $sql = "SELECT payment_mode, repair_cost_estimate, advance_payment FROM customers WHERE id = ?";
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





                    <div style="display:flex; justify-content: space-between; margin-top: 29px;">

                        <!-- <div>
                            <p style="margin-bottom: -5px; text-align: center;">
                                <?php
                                date_default_timezone_set('Asia/Kolkata'); 
                                echo date('d/m/y H:i:s'); 
                                ?>
                            </p>
                            <hr> 
                            <p style="text-align: center; font-weight:600;">Authorized Signatory<br>
                                (Mitali More)
                            </p>
                        </div> -->

                        <!-- <div>
                            <p style="margin-bottom: -5px; text-align: center;">
                                <?php
                                date_default_timezone_set('Asia/Kolkata'); 
                                echo date('d/m/y H:i:s'); 
                                ?>
                            </p>
                            <hr> 
                            <p style="font-weight: 600;">Customers Signature</p>
                        </div> -->

                    </div>

                    <h6 class="mt-1 ">This is an electronically generated report, hence does not require a signature</h6>

                    <p style="font-weight: 600;">Terms and Conditions:</p>
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
                    <!-- <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary" onclick="redirectAndPrint()">Send
                            Invoice</button>
                    </div> -->
                    <!-- CSS for print -->
                    <style>
                        @media print {
                            body * {
                                visibility: hidden;
                            }

                            #printSection,
                            #printSection * {
                                visibility: visible;
                            }

                            #printSection {
                                position: absolute;
                                left: 0;
                                top: 0;
                            }
                        }
                    </style>

                    <!-- <script>
                        function redirectAndPrint() {
                            const printWindow = window.open('printt_receipt.php?id=<?php echo $id; ?>');
                            printWindow.onload = function() {
                                printWindow.print();
                            };
                        }
                    </script> -->

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





<?php
// Close connection
mysqli_close($conn);
?>