<?php
include_once '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $count = $_POST['count'];
   
    // Prepare the SQL statement to update the record without the image
    $stmt = $conn->prepare("UPDATE `acheive` SET `name` = ?, `count` = ? WHERE `id` = ?");
    $stmt->bind_param("ssi", $name, $count, $id);

    if ($stmt->execute()) {
        echo "<SCRIPT type='text/javascript'>
                  alert('Achievements updated successfully!!');
                  window.location.replace('achiev.php');
              </SCRIPT>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
