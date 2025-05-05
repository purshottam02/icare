<?php
include_once '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from POST request
    $id = mysqli_real_escape_string($conn, $_POST['id'] ?? '');
    $shopname = mysqli_real_escape_string($conn, $_POST['shopname'] ?? '');
    $ownername = mysqli_real_escape_string($conn, $_POST['ownername'] ?? '');
    $number = mysqli_real_escape_string($conn, $_POST['number'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
    $area = mysqli_real_escape_string($conn, $_POST['area'] ?? '');
    $operating_hours = mysqli_real_escape_string($conn, $_POST['operating_hours'] ?? '');
    $services_offered = mysqli_real_escape_string($conn, $_POST['services_offered'] ?? '');
    $website = mysqli_real_escape_string($conn, $_POST['website'] ?? '');
    $media_link = mysqli_real_escape_string($conn, $_POST['media_link'] ?? '');
    $registration_number = mysqli_real_escape_string($conn, $_POST['registration_number'] ?? '');
    $GST_number = mysqli_real_escape_string($conn, $_POST['GST_number'] ?? '');
    $shop_description = mysqli_real_escape_string($conn, $_POST['shop_description'] ?? '');
    $service_warranty_period = mysqli_real_escape_string($conn, $_POST['service_warranty_period'] ?? '');
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method'] ?? '');
    $customer_support_number = mysqli_real_escape_string($conn, $_POST['customer_support_number'] ?? '');
    $password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');
    $shop_policies = mysqli_real_escape_string($conn, $_POST['shop_policies'] ?? '');
    $shop_map_location = mysqli_real_escape_string($conn, $_POST['shop_map_location'] ?? '');

// $operating_hours = $_POST['operating_hours'];
    // Handle file upload
    $filename = $_FILES["image"]["name"] ?? '';
    $tempname = $_FILES["image"]["tmp_name"] ?? '';
    $folder = "image/" . $filename;

    if (!empty($filename)) {
        // Image is uploaded
        if (move_uploaded_file($tempname, $folder)) {
            $sql = "UPDATE `addshop` SET `shopname` = '$shopname', `image` = '$filename', `ownername` = '$ownername', `number` = '$number', `email` = '$email', 
                    `address` = '$address', `area` = '$area', `opentime` = '$operating_hours', `services_offered` = '$services_offered', `Website` = '$website', `media_link` = '$media_link', 
                    `registration_number` = '$registration_number', `GST_number` = '$GST_number', `shop_discription` = '$shop_description', `service_warranty_period` = '$service_warranty_period', 
                    `payment_medhot` = '$payment_method', `customer_support_number` = '$customer_support_number',`password` = '$password', `shop_policies` = '$shop_policies', `shop_map_location` = '$shop_map_location' 
                    WHERE `id` = '$id'";
        } else {
            echo "Failed to upload image.";
            exit;
        }
    } else {
        // No new image uploaded
        $sql = "UPDATE `addshop` SET `shopname` = '$shopname', `ownername` = '$ownername', `number` = '$number', `email` = '$email', `address` = '$address',  `area` = '$area', 
                `operating_hours` = '$operating_hours', `services_offered` = '$services_offered', `Website` = '$website', `media_link` = '$media_link', 
                `registration_number` = '$registration_number', `GST_number` = '$GST_number', `shop_discription` = '$shop_description', `service_warranty_period` = '$service_warranty_period', 
                `payment_medhot` = '$payment_method', `customer_support_number` = '$customer_support_number', `password` = '$password', `shop_policies` = '$shop_policies', `shop_map_location` = '$shop_map_location' 
                WHERE `id` = '$id'";
    }

    // Execute the SQL query and check if the update was successful
    if ($conn->query($sql) === TRUE) {
        echo "<SCRIPT type='text/javascript'>
                  alert('Shop updated successfully!');
                  window.location.replace('products.php');
              </SCRIPT>";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
