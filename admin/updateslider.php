<?php
include_once '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from POST request
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "image/" . $filename;

    if (!empty($filename)) {
        // Image is uploaded
        if (move_uploaded_file($tempname, $folder)) {
            // Prepare the SQL statement to update the record including the image
            $stmt = $conn->prepare("UPDATE `slider` SET `name` = ?, `image` = ?, `description` = ? WHERE `id` = ?");
            $stmt->bind_param("sssi", $name, $filename, $description, $id);
        } else {
            echo "Failed to upload image.";
            exit;
        }
    } else {
        // Image is not uploaded, update without changing the image
        $stmt = $conn->prepare("UPDATE `slider` SET `name` = ?, `description` = ? WHERE `id` = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
    }

    if ($stmt->execute()) {
        echo "<SCRIPT type='text/javascript'>
                  alert('Slider updated successfully!!');
                  window.location.replace('slider.php');
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