<?php
session_start();
if (empty($_SESSION['user_session'])) {
header('Location:contactdetailslist.php');
}
include_once '../dbconnection.php';
if(isset($_POST['upload'])){

$id = $_POST['ID'];
$num = $_POST["num"];
// $message= $_POST["message"];

    $sql = "UPDATE contact SET 	contact_number='$num' WHERE id = '$id'";
      //echo "<br>-=-=-=-=-=-<br>".$sql;
        if ($conn->query($sql)) {
            echo "<SCRIPT type='text/javascript'> //not showing me this
                  alert('Edited successfully!!');
                 window.location.replace('contactdetailslist.php');
                </SCRIPT>";
              }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            } 
        }
    ?>