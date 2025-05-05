<?php
session_start();
include_once '../dbconnection.php';
if (empty($_SESSION['admin_session'])) {
header('Location:login.php');
}

if (isset($_POST['submit'])) {
        $name = $_POST["name"];
        $message = $_POST["message"];
        
        
            $sql = "INSERT INTO `testimonial`(`name`, `message`) VALUES ('$name','$message')";
              
              //echo "<br>-=-=-=-=-=-<br>".$sql;
                if ($conn->query($sql)) {
                    echo "<SCRIPT type='text/javascript'> //not showing me this
                          alert('New What Clinet Says Added successfully!!');
                         window.location.replace('whatourclientsays.php');
                        </SCRIPT>";
                      }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    } 
        
        }
        ?>