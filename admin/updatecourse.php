<?php
session_start();
if (empty($_SESSION['user_session'])) {

}
include_once '../dbconnection.php';
if(isset($_POST['upload'])){

$id = $_POST['ID'];
$coursename = $_POST["coursename"];
$description= $_POST["description"];

    $sql = "UPDATE courses SET 	coursename='$coursename', 	description='$description' WHERE id = '$id'";
      //echo "<br>-=-=-=-=-=-<br>".$sql;
        if ($conn->query($sql)) {
            echo "<SCRIPT type='text/javascript'> //not showing me this
                  alert('Edited successfully!!');
                 window.location.replace('services.php');
                </SCRIPT>";
              }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            } 
        }
    ?>   