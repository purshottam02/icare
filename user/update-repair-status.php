<?php
include '../dbconnection.php';

if (isset($_POST['id']) && isset($_POST['repair_status'])) {
    $customerId = $_POST['id'];
    $newStatus = $_POST['repair_status'];

    $sql = "UPDATE customers SET repair_status='$newStatus' WHERE id=$customerId";
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
