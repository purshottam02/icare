<?php
if (isset($_POST['update'])) {
    require '../dbconnection.php';

    // Sanitize and validate inputs
    $id = trim($_POST['id'] ?? '');
    $repair_status = trim($_POST['repair_status'] ?? '');
    $problem_descriptions = $_POST['problem_description'] ?? [];
    $repair_cost_estimate = trim($_POST['repair_cost_estimate'] ?? '');

    if (empty($id)) {
        die("Error: ID is missing!");
    }

    if (empty($problem_descriptions)) {
        die("Error: Problem description is missing!");
    }

    // Update the repair status and cost estimate in the customers table
    $sql = "UPDATE customers SET repair_status = ?, repair_cost_estimate = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssi', $repair_status, $repair_cost_estimate, $id);

        if ($stmt->execute()) {
            // Handle the problem descriptions: delete old ones and insert new ones
            $deleteSql = "DELETE FROM customer_problem WHERE customer_id = ?";
            if ($stmtDelete = $conn->prepare($deleteSql)) {
                $stmtDelete->bind_param('i', $id);
                $stmtDelete->execute();
                $stmtDelete->close();
            }

            foreach ($problem_descriptions as $problem_description) {
                $sql_problem = "INSERT INTO customer_problem (customer_id, problem_description) VALUES (?, ?)";
                if ($stmt_problem = $conn->prepare($sql_problem)) {
                    $stmt_problem->bind_param('is', $id, $problem_description);
                    $stmt_problem->execute();
                    $stmt_problem->close();
                }
            }

            // Fetch email for notification
            $emailQuery = "SELECT email FROM customers WHERE id = ?";
            if ($stmtEmail = $conn->prepare($emailQuery)) {
                $stmtEmail->bind_param('i', $id);
                $stmtEmail->execute();
                $stmtEmail->bind_result($email);
                $stmtEmail->fetch();
                $stmtEmail->close();
            } else {
                die("Error: Could not fetch email.");
            }

            // Send email notification
            sendNotificationEmail($email, $_POST);

             "<SCRIPT type='text/javascript'>alert('Edited Successfully...!'); window.location.replace('userdetails.php');</SCRIPT>";
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
function sendNotificationEmail($to, $data) {
    if (empty($to)) {
        echo "Error: Customer email is missing!";
        return;
    }

    $problem_description = implode(", ", $data['problem_description']);
    $repair_status = $data['repair_status'];
    $repair_cost_estimate = $data['repair_cost_estimate'];

    $subject = "Repair Update Notification";

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
    // $headers .= "From: noreply@example.com" . "\r\n"; // Change to a valid sender email
    // $headers .= "Reply-To: noreply@example.com" . "\r\n"; // Prevent user email from being used in headers

    if (mail($to, $subject, $htmlMessage, $headers)) {
        echo "<script>alert('Notification email sent successfully.'); location.replace('userdetails.php');</script>";
    } else {
        echo "Error: Failed to send email!";
    }
}
?>
