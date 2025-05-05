<?php
session_start();
include_once '../dbconnection.php';
if (isset($_POST['submit'])) {

//     $unicode = $_POST['unicode'];
//     $cname = $_POST['cname'];
//     $pname = $_POST['pname'];
//     $email = $_POST['email'];
//     $numbers = $_POST['numbers'];
//     $state = $_POST['state'];
//     $district = $_POST['district'];
//     $taluka = $_POST['taluka'];
//     $area = $_POST['area'];
//     $pincode = $_POST['pincode'];
//     $service = $_POST['service'];
//     $refrance = $_POST['refrance'];
//     $date = $_POST['date'];
//     $discription = $_POST['discription'];
    // $name = $_POST['name'];
    // $description = $_POST['description'];
   
    
    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    // if ($uploadOk == 0) {
    //     echo "Sorry, your file was not uploaded.";
       
    // } else {
    //     if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    //         echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    //     } else {
    //         echo "Sorry, there was an error uploading your file.";
    //     }
    // }




  
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
       
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


        $sql = "INSERT INTO `partner1`(`image`) VALUES ('$target_file')";

        if ($conn->query($sql)) {
            echo "<SCRIPT type='text/javascript'> //not showing me this
                                            alert('New Image Added successfully!!');
                                            window.location.replace('partner1.php');
                                            </SCRIPT>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
