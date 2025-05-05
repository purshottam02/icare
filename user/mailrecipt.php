
<?php

$id = $_GET['id'];
$email = $_GET['email'];


$to = "$email";

// $to = "swapra.vishal@gmail.com";
$subject = "Your Device Repair Receipts";

$message = "
<html>
<head>
<title>Repair Receipts</title>
</head>

<body>
<p>Repair Receipts</p>


<p>View Your Device Repair Receipts From I Care <a href= 'https://appleicare.in//receipt.php?id=".$id. "'>Click Hear</a></p>

</body>
</html>
";

// Always set content-type when sending HTML email

$headers = "From: I Care\r\n";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($to,$subject,$message,$headers);

echo "<script>alert(' THANK YOU FOR CONTACTING, WE LOOK FORWARD TO WORKING WITH YOU SOON');location.replace('index.php')</script>";
?>
