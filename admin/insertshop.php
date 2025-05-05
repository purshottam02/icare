<?php
include_once '../dbconnection.php';

// Collecting form data safely
$shopname = trim($_POST['shopname']);
$ownername = trim($_POST['ownername']);
$number = trim($_POST['number']);
$email = trim($_POST['email']);
$address = trim($_POST['address']);
$area = trim($_POST['area']);
$opentime = trim($_POST['opentime']);
$services_offered = trim($_POST['services_offered']);
$GST_number = trim($_POST['GST_number']);
$customer_support_number = trim($_POST['customer_support_number']);
$password = trim($_POST['password']);

// Hash the password before storing
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Image handling
if (!empty($_FILES["image"]["name"])) {
    $filename = basename($_FILES["image"]["name"]);
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "image/" . $filename;

    // Validate the file type
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_extensions)) {
        die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
    }

    // Move uploaded file
    if (!move_uploaded_file($tempname, $folder)) {
        die("Failed to upload image.");
    }
} else {
    $filename = null; // Allow NULL if no image is uploaded
}

// Prepare SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO `addshop`(`shopname`, `ownername`, `number`, `email`, `address`, `area`, `opentime`, `services_offered`, `GST_number`, `image`, `customer_support_number`, `password`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssssssssssss", $shopname, $ownername, $number, $email, $address, $area, $opentime, $services_offered, $GST_number, $filename, $customer_support_number, $password);

// Execute and check for success
if ($stmt->execute()) {
    echo "<SCRIPT type='text/javascript'>
              alert('Shop added successfully!');
              window.location.replace('products.php');
          </SCRIPT>";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>
