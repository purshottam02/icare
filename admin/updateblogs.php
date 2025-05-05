<?php
include_once '../dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if required POST variables are set
    if (!isset($_POST['id'], $_POST['heading'], $_POST['description'])) {
        echo "Required form data is missing.";
        exit;
    }

    $id = $_POST['id'];
    $heading = $_POST['heading'];
    $description = $_POST['description'];

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "image/" . $filename;

    $image_uploaded = false;

    if (!empty($filename)) {
        // Ensure the 'image' directory exists
        if (!is_dir('image')) {
            mkdir('image', 0777, true);
        }

        // Image is uploaded
        if (move_uploaded_file($tempname, $folder)) {
            $image_uploaded = true;
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    if ($image_uploaded) {
        // Prepare the SQL statement to update the record including the image
        $stmt = $conn->prepare("UPDATE `blogs` SET `heading` = ?, `image` = ?, `description` = ? WHERE `id` = ?");
        $stmt->bind_param("sssi", $heading, $filename, $description, $id);
    } else {
        // Image is not uploaded, update without changing the image
        $stmt = $conn->prepare("UPDATE `blogs` SET `heading` = ?, `description` = ? WHERE `id` = ?");
        $stmt->bind_param("ssi", $heading, $description, $id);
    }

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<SCRIPT type='text/javascript'>
                      alert('Blog updated successfully!!');
                      window.location.replace('blogs.php');
                  </SCRIPT>";
        } else {
            echo "No changes were made to the blog.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
