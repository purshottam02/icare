<?php
session_start();
include_once '../dbconnection.php';

if (empty($_SESSION['user_session'])) {
    header('Location:login.php');
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$address = $_POST['address'];
$mobile_model = $_POST['mobile_model'];

$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "image/" . basename($filename);

// Check if image upload is successful
if (move_uploaded_file($tempname, $folder)) {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `registered`(`name`, `email`, `number`, `address`, `mobile_model`, `image`) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    
    // Bind parameters: match the number of parameters with the SQL query
    $stmt->bind_param("ssssss", $name, $email, $number, $address, $mobile_model, $filename);
    
    // Execute and check for success
    if ($stmt->execute()) {
        echo "<SCRIPT type='text/javascript'>
                  alert('Shop added successfully!');
                  window.location.replace('userdetails.php');
              </SCRIPT>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Failed to upload image.";
}

// Close the database connection
$conn->close();
?>
