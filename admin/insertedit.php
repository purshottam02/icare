<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../dbconnection.php';

    // Sanitize inputs
    $id = trim($_POST['id']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $mobile_number = trim($_POST['mobile_number']);
    $address = trim($_POST['address']);
    $device_model = trim($_POST['device_model']);
    $imei_number = trim($_POST['imei_number']);
    $servicetype = trim($_POST['servicetype']);
    $category = trim($_POST['category']);
    $problem_description = isset($_POST['problem_description']) ? $_POST['problem_description'] : []; // Fix
    $repair_cost_estimate = trim($_POST['repair_cost_estimate']);
    $repair_status = trim($_POST['repair_status']);

    $condition_of_device = trim($_POST['condition_of_device']);
    $diagnosis = trim($_POST['diagnosis']);
    $repair_warranty = trim($_POST['repair_warranty']);
    $engineer = trim($_POST['engineer']);
    $payment_mode = trim($_POST['payment_mode']);
    $finalcost = trim($_POST['finalcost']);
    $advance_payment = trim($_POST['advance_payment']);

    if (empty($id)) {
        die("Error: Customer ID is required.");
    }

    $conn->begin_transaction();

    try {
        // Update customer information
        $sql = "UPDATE customers SET 
                    first_name = ?, last_name = ?, email = ?, mobile_number = ?, address = ?, 
                    device_model = ?, imei_number = ?, servicetype = ?, category = ?, 
                    repair_cost_estimate = ?, repair_status = ?, condition_of_device = ?, diagnosis = ?, 
                    repair_warranty = ?, engineer = ?, payment_mode = ?, 
                    finalcost = ?, advance_payment = ?
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'ssssssssssssssssssi',
            $first_name, $last_name, $email, $mobile_number, $address,
            $device_model, $imei_number, $servicetype, $category, 
            $repair_cost_estimate, $repair_status, $condition_of_device, $diagnosis, 
            $repair_warranty, $engineer, $payment_mode, $finalcost, 
            $advance_payment, $id
        );
        $stmt->execute();
        $stmt->close();

        // ✅ Delete old problem descriptions for this customer
        $delete_sql = "DELETE FROM customer_problem WHERE customer_id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        $stmt_delete->bind_param("i", $id);
        $stmt_delete->execute();
        $stmt_delete->close();

        // ✅ Insert new problem descriptions
        if (!empty($problem_description)) {
            $stmt_problem = $conn->prepare("INSERT INTO customer_problem (customer_id, problem_description) VALUES (?, ?)");
            foreach ($problem_description as $problem) {
                $problem = mysqli_real_escape_string($conn, $problem);
                $stmt_problem->bind_param("is", $id, $problem);
                $stmt_problem->execute();
            }
            $stmt_problem->close();
        }

        $conn->commit();
        echo "<script>alert('Update Successful!'); window.location.replace('products.php');</script>";

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}

function sendNotificationEmail($data) {
    $problem_description = implode(", ", $data['problem_description']);
    $repair_status = $data['repair_status'];
    $repair_cost_estimate = $data['repair_cost_estimate']; // Add this

    $subject = "Repair Update Notification";
    $to = "krushnachandane@gmail.com";

    $htmlMessage = "
    <html>
    <head>
    <title>Repair Update Notification</title>
    </head>
    <body>
    <p>Your repair details have been updated:</p>
    <table border='1' cellpadding='5'>
    <tr><td><strong>Problem Description:</strong></td> <td>{$problem_description}</td></tr>
    <tr><td><strong>Repair Status:</strong></td> <td>{$repair_status}</td></tr>
    <tr><td><strong>Repair Cost Estimate:</strong></td> <td>{$repair_cost_estimate}</td></tr>
    </table>
    </body>
    </html>";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    if (mail($to, $subject, $htmlMessage, $headers)) {
        echo "<script>alert('Notification email sent successfully.'); location.replace('userdetails.php');</script>";
    } else {
        echo "Error: Failed to send email!";
    }
}

?>