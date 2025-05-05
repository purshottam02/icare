<?php
session_start();
if (empty($_SESSION['user_session'])) {
    header('Location:index.php');
}
include '../conn.php';
// $id = $_GET['id']; ?>


<?php

    $id = $_POST['id'];
    $feedback = $_POST['feedback'];
   
    $sql2 = "UPDATE `order_place` SET `user_feedback`='$feedback' WHERE user_id ='$id' ";
    if ($conn->query($sql2) === TRUE) {
      echo "<SCRIPT type='text/javascript'> //not showing me this
                                    alert('Feedback Update Successfully!!');
                                    window.location.replace('index.php');
                                    </SCRIPT>";
    }
   

?>