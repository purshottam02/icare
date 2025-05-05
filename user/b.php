<?php
if (isset($_POST['update'])) {
    require '../dbconnection.php';

    // Sanitize and validate inputs
    $id = trim($_POST['id']);
    $repair_status = trim($_POST['repair_status']);
    $problem_descriptions = $_POST['problem_description'];
    $repair_cost_estimate = trim($_POST['repair_cost_estimate']); // Add this

    if (empty($id)) {
        echo "Error: ID is missing!";
        exit;
    }

    if (empty($problem_descriptions)) {
        echo "Error: Problem description is missing!";
        exit;
    }

    // Update the repair status and cost estimate in the customers table
    $sql = "UPDATE customers SET repair_status = ?, repair_cost_estimate = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssi', $repair_status, $repair_cost_estimate, $id); // Bind cost estimate
        if ($stmt->execute()) {
            // Handle the problem descriptions: delete old ones and insert new ones
            $conn->query("DELETE FROM customer_problem WHERE customer_id = $id");

            foreach ($problem_descriptions as $problem_description) {
                $sql_problem = "INSERT INTO customer_problem (customer_id, problem_description) VALUES (?, ?)";
                if ($stmt_problem = $conn->prepare($sql_problem)) {
                    $stmt_problem->bind_param('is', $id, $problem_description);
                    $stmt_problem->execute();
                    $stmt_problem->close();
                }
            }

            // Send email notification after successful update
            // sendNotificationEmail($_POST);

            echo "<SCRIPT type='text/javascript'>alert('Edited Successfully...!'); window.location.replace('userdetails.php');</SCRIPT>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
}

// Function to send email notification
// function sendNotificationEmail($data) {
//     $problem_description = implode(", ", $data['problem_description']);
//     $repair_status = $data['repair_status'];
//     $repair_cost_estimate = $data['repair_cost_estimate']; // Add this

//     $subject = "Repair Update Notification";
//     $to = "krushnachandane@gmail.com";

//     $htmlMessage = "
//     <html>
//     <head>
//     <title>Repair Update Notification</title>
//     </head>
//     <body>
//     <p>Your repair details have been updated:</p>
//     <table border='1' cellpadding='5'>
//     <tr><td><strong>Problem Description:</strong></td> <td>{$problem_description}</td></tr>
//     <tr><td><strong>Repair Status:</strong></td> <td>{$repair_status}</td></tr>
//     <tr><td><strong>Repair Cost Estimate:</strong></td> <td>{$repair_cost_estimate}</td></tr>
//     </table>
//     </body>
//     </html>";

//     $headers = "MIME-Version: 1.0" . "\r\n";
//     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//     if (mail($to, $subject, $htmlMessage, $headers)) {
//         echo "<script>alert('Notification email sent successfully.'); location.replace('userdetails.php');</script>";
//     } else {
//         echo "Error: Failed to send email!";
//     }
// }
?>
