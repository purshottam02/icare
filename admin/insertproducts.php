<?php
include_once '../dbconnection.php';

$name = $_POST['name'];
$description = $_POST['description'];

// Handling image file
$image_filename = $_FILES["image"]["name"];
$image_tempname = $_FILES["image"]["tmp_name"];
$image_folder = "image/" . $image_filename;

// Handling video file
$video_filename = $_FILES["video"]["name"];
$video_tempname = $_FILES["video"]["tmp_name"];
$video_folder = "video/" . $video_filename;

// Create directories if they don't exist
if (!is_dir("image")) {
    mkdir("image", 0777, true);
}
if (!is_dir("video")) {
    mkdir("video", 0777, true);
}

$image_uploaded = move_uploaded_file($image_tempname, $image_folder);
$video_uploaded = move_uploaded_file($video_tempname, $video_folder);

if ($image_uploaded && $video_uploaded) {
    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO `products` (`name`, `image`, `video`, `description`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $image_filename, $video_filename, $description);

    if ($stmt->execute()) {
        echo "<SCRIPT type='text/javascript'>
                  alert('Product added successfully!');
                  window.location.replace('products.php');
              </SCRIPT>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    if (!$image_uploaded) {
        echo "Failed to upload image.";
    }
    if (!$video_uploaded) {
        echo "Failed to upload video.";
    }
}

// Close the database connection
$conn->close();
?>
