<?php
session_start();

// Check if the user is logged in
if (empty($_SESSION['user_session'])) {
    header('Location: login.php');
    exit;
}

// Database connection
include '../dbconnection.php';

// Example INSERT query to add a new technician
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catogery = htmlspecialchars($_POST['category']); 
    $shop_id = htmlspecialchars($_POST['shop_id']); 

    $insert_query = "INSERT INTO technician (catogery, shop_id) VALUES (?, ?)"; 
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("ss", $catogery, $shop_id); 

    if ($insert_stmt->execute()) {
        echo "<script type='text/javascript'>
                alert('Technician Added Successfully.');
                window.location.href = 'add_technician.php';
              </script>";
    } else {
        echo "Error: " . $insert_stmt->error;
    }

    $insert_stmt->close();
    $conn->close(); // Closing the database connection
}
?>
