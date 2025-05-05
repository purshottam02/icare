<?php
include_once '../dbconnection.php';

$name = $_POST['name'];
$description = $_POST['description'];

$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "image/" . $filename;

if (move_uploaded_file($tempname, $folder)) {
    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO `testimonial` (`name`, `image`, `description`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $filename, $description);

    if ($stmt->execute()) {
        echo "<SCRIPT type='text/javascript'>
                  alert('testimonial Added successfully!!');
                  window.location.replace('testimo.php');
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
