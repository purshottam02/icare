<?php
if (isset($_POST['update'])) {
    require '../dbconnection.php';

    // Sanitize inputs
    $id = $_POST['id'];
   
    $diagnosis = $_POST['diagnosis'];
    $repair_warranty = $_POST['repair_warranty'];
    $engineer = $_POST['engineer'];
    $problem_descriptions = isset($_POST['problem_description']) ? $_POST['problem_description'] : []; // Check if exists
    $accessories = isset($_POST['accessories']) ? $_POST['accessories'] : []; // Check if exists
   

    $device = isset($_POST['device']) ? $_POST['device'] : '';
    $power = isset($_POST['power']) ? $_POST['power'] : '';
    $volume = isset($_POST['volume']) ? $_POST['volume'] : '';
    $face_id = isset($_POST['face_id']) ? $_POST['face_id'] : '';
    $touch = isset($_POST['touch']) ? $_POST['touch'] : '';
    $speaker = isset($_POST['speaker']) ? $_POST['speaker'] : '';
    $charging = isset($_POST['charging']) ? $_POST['charging'] : '';
    $heads = isset($_POST['heads']) ? $_POST['heads'] : '';
    $simtray = isset($_POST['simtray']) ? $_POST['simtray'] : '';


    // Check if the ID is provided
    if (!$id) {
        echo "Error: ID is missing!";
        exit;
    }

    // Prepare the SQL update query for customers table
    $sql = "
        UPDATE customers 
        SET 
           
            diagnosis = '$diagnosis', 
            repair_warranty = '$repair_warranty',
            engineer = '$engineer',
           

             device = '$device',
            power = '$power',
            volume = '$volume',
            face_id = '$face_id',
            touch = '$touch',
            speaker = '$speaker',
            charging = '$charging',
            heads = '$heads',
            simtray = '$simtray'
        WHERE id = '$id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Handle the customer_problem table
        $delete_sql = "DELETE FROM customer_problem WHERE customer_id = '$id'";
        $conn->query($delete_sql);

        // Insert each problem description into customer_problem
        foreach ($problem_descriptions as $problem_description) {
            $problem_description = $conn->real_escape_string($problem_description); // Sanitize input
            $insert_sql = "INSERT INTO customer_problem (customer_id, problem_description) 
                           VALUES ('$id', '$problem_description')";
            $conn->query($insert_sql);
        }

        // Now handle the accessories table
        // First, delete existing accessories for the customer
        $delete_accessories_sql = "DELETE FROM accessories WHERE customer_id = '$id'";
        $conn->query($delete_accessories_sql);

        // Insert each accessory into accessories table
        foreach ($accessories as $accessory) {
            $accessory = $conn->real_escape_string($accessory); // Sanitize input
            $insert_accessory_sql = "INSERT INTO accessories (customer_id, accessories) 
                                     VALUES ('$id', '$accessory')";
            $conn->query($insert_accessory_sql);
        }

        // Success message
        echo "<SCRIPT type='text/javascript'>alert('Edited Successfully...!'); window.location.replace('progress.php');</SCRIPT>";
    } else {
        // Display SQL error message
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
