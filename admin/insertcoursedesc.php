<?php
include_once '../dbconn.php';

$course_desc = $_POST["course_desc"];
$coursename = $_POST["coursename"];
$coursevideo = $_POST["coursevideo"];

    $sql = "INSERT INTO coursesdesc(coursesdescdetail,coursevideo,course_id) VALUES('$course_desc','$coursevideo','$coursename')";
      //echo "<br>-=-=-=-=-=-<br>".$sql;
        if ($conn->query($sql)) {
             echo "<SCRIPT type='text/javascript'> //not showing me this
                  alert('New Course Description Added successfully!!');
                 window.location.replace('coursesdesc.php');
                </SCRIPT>";
              }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
?>