<?php
session_start();
include_once '../dbconnection.php';

if (isset($_POST['submit'])) {
    $description = $_POST['description'] ?? '';

    // Handle file upload
    $target_dir = "uploads/";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

            // Prepare the SQL statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO `gallery1` (`description`, `image`) VALUES (?, ?)");
            $stmt->bind_param("ss", $description, $target_file);

            // Execute the query
            if ($stmt->execute()) {
                echo "<script type='text/javascript'>
                        alert('New Image Added successfully!!');
                        window.location.replace('gallery1.php');
                      </script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close the database connection
    $conn->close();
}
?>
