<?php
include_once '../dbconnection.php';

$mach_name = $_POST['mach_name'];
$mach_no = $_POST['mach_no'];
$satis_client = $_POST['satis_client'];
$client_no = $_POST['client_no'];
$exp_staff = $_POST['exp_staff'];
$staff_no = $_POST['staff_no'];
$award = $_POST['award'];
$award_no = $_POST['award_no'];

// Prepare the SQL statement to avoid SQL injection
$stmt = $conn->prepare("INSERT INTO `acheive` (`mach_name`, `mach_no`, `satis_client`, `client_no`, `exp_staff`, `staff_no`, `award`, `award_no`) VALUES (?, ?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssss", $mach_name, $mach_no, $satis_client, $client_no, $exp_staff, $staff_no, $award, $award_no);

if ($stmt->execute()) {
    echo "<SCRIPT type='text/javascript'>
              alert('Achievements Added successfully!!');
              window.location.replace('achiev.php');
          </SCRIPT>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>
