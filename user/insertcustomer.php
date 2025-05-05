<?php
session_start();

// Check if the user is logged in
if (empty($_SESSION['user_session'])) {
    header('Location: login.php');
    exit;
}

// Database connection
include '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and sanitize inputs
    $shop_id = mysqli_real_escape_string($conn, $_POST['shop_id'] ?? '');
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name'] ?? '');
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number'] ?? '');
    $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
    $reference = mysqli_real_escape_string($conn, $_POST['reference'] ?? '');
    $serialno = mysqli_real_escape_string($conn, $_POST['serialno'] ?? '');
    $servicemode = mysqli_real_escape_string($conn, $_POST['servicemode'] ?? '');
    $servicestatus = mysqli_real_escape_string($conn, $_POST['servicestatus'] ?? '');
    $servicetype = mysqli_real_escape_string($conn, $_POST['servicetype'] ?? '');
    $device_brand = mysqli_real_escape_string($conn, $_POST['device_brand'] ?? '');
    $device_model = mysqli_real_escape_string($conn, $_POST['device_model'] ?? '');
    $imei_number = mysqli_real_escape_string($conn, $_POST['imei_number'] ?? '');
    $category = mysqli_real_escape_string($conn, $_POST['category'] ?? '');
    $repair_cost_estimate = mysqli_real_escape_string($conn, $_POST['repair_cost_estimate'] ?? '');
    $repair_status = mysqli_real_escape_string($conn, $_POST['repair_status'] ?? '');
    $condition_of_device = mysqli_real_escape_string($conn, $_POST['condition_of_device'] ?? '');
    $technician_assigned = mysqli_real_escape_string($conn, $_POST['technician_assigned'] ?? '');
    $repair_warranty = mysqli_real_escape_string($conn, $_POST['repair_warranty'] ?? '');

    // New device condition fields (Ensure these fields exist in your form)
    $device_powering = mysqli_real_escape_string($conn, $_POST['device_powering'] ?? '');
    $power_button = mysqli_real_escape_string($conn, $_POST['power_button'] ?? '');
    $volume_keys = mysqli_real_escape_string($conn, $_POST['volume_keys'] ?? '');
    $face_idi = mysqli_real_escape_string($conn, $_POST['face_idi'] ?? '');
    $touchscreen = mysqli_real_escape_string($conn, $_POST['touchscreen'] ?? '');
    $speaker_working = mysqli_real_escape_string($conn, $_POST['speaker_working'] ?? '');
    $charging_port = mysqli_real_escape_string($conn, $_POST['charging_port'] ?? '');
    $screw_head = mysqli_real_escape_string($conn, $_POST['screw_head'] ?? '');
    $sim_tray = mysqli_real_escape_string($conn, $_POST['sim_tray'] ?? '');

    // Payment fields
    $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode'] ?? '');
    $repair_cost = mysqli_real_escape_string($conn, $_POST['repair_cost'] ?? '');
    $advance_payment = mysqli_real_escape_string($conn, $_POST['advance_payment'] ?? '');

    // Handle problem descriptions and accessories safely
    $problem_descriptions = $_POST['problem_description'] ?? [];
    $accessories = $_POST['accessories'] ?? [];

    // Check for duplicate entries
    $check_duplicate = "SELECT * FROM customers WHERE email='$email' OR mobile_number='$mobile_number' OR imei_number='$imei_number'";
    $result = mysqli_query($conn, $check_duplicate);


    // Insert into customers table
    $sql = "INSERT INTO customers (first_name, last_name, email, mobile_number, address, reference, serialno, servicemode, servicestatus, servicetype, 
           device_brand, device_model, imei_number, category, repair_cost_estimate, repair_status, condition_of_device, technician_assigned, repair_warranty, shop_id, 
           device_powering, power_button, volume_keys, face_idi, touchscreen, speaker_working, charging_port, screw_head, sim_tray, payment_mode, repair_cost, advance_payment) 
           VALUES ('$first_name', '$last_name', '$email', '$mobile_number', '$address', '$reference', '$serialno', '$servicemode', '$servicestatus', 
           '$servicetype', '$device_brand', '$device_model', '$imei_number', '$category', '$repair_cost_estimate', '$repair_status','$condition_of_device', '$technician_assigned', 
           '$repair_warranty', '$shop_id', '$device_powering', '$power_button', '$volume_keys', '$face_idi', '$touchscreen', '$speaker_working', 
           '$charging_port', '$screw_head', '$sim_tray', '$payment_mode', '$repair_cost', '$advance_payment')";

    if (mysqli_query($conn, $sql)) {
        // Fetch the inserted customer ID
        $customer_id = mysqli_insert_id($conn);

        // Insert problem descriptions
        foreach ($problem_descriptions as $problem) {
            $problem = mysqli_real_escape_string($conn, $problem);
            $sql_problem = "INSERT INTO customer_problem (customer_id, problem_description) VALUES ('$customer_id', '$problem')";
            mysqli_query($conn, $sql_problem);
        }

        // Insert accessories
        foreach ($accessories as $accessory) {
            $accessory = mysqli_real_escape_string($conn, $accessory);
            $sql_accessories = "INSERT INTO customer_accessories (customer_id, accessories) VALUES ('$customer_id', '$accessory')";
            if (!mysqli_query($conn, $sql_accessories)) {
                $_SESSION['error'] = 'Error adding accessory: ' . mysqli_error($conn);
                header('Location: add_customer.php');
                exit;
            }
        }

        // Redirect to the receipt page
        header("Location: receipt.php?id=$customer_id");
        exit;
    } else {
        $_SESSION['error'] = 'Error adding customer: ' . mysqli_error($conn);
        header('Location: add_customer.php');
        exit;
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
