<?php
// Enable error reporting to display any issues
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the database connection
include '../dbconnection.php';

// Initialize the next job number variable
$nextJobNo = 1;  // Default in case no jobs are found

// Get the maximum reference number from the 'customers' table
$sql = "SELECT MAX(reference) AS reference FROM customers";

// Run the query and check for errors
if ($result = $conn->query($sql)) {
    // Check if there is a result and fetch it
    if ($row = $result->fetch_assoc()) {
        // If there's a reference value, increment it by 1
        $nextJobNo = ($row['reference'] !== null) ? $row['reference'] + 1 : 1;
    }
    // Free the result to avoid memory leaks
    $result->free();
} else {
    // Handle query error (optional, but good practice)
    die("Error: " . $conn->error);
}

// Set the response type to JSON
header('Content-Type: application/json');

// Return the next job number as a JSON response
echo json_encode(['nextJobNo' => $nextJobNo]);

// Close the database connection
$conn->close();
?>
