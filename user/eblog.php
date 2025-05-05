<?php


if (isset($_POST['update'])) {
    require '../conn.php';
    $id = $_POST['ID'];
   $name=$_POST['product_name'];
$heading=$_POST['product_weight'];
$date=$_POST['product_cost'];
$information=$_POST['info'];

$sql="UPDATE blog SET `name`='$name', `date`='$date',`heading`='$heading', `info`='$information' WHERE id = '$id'";
if ($conn->query($sql) === TRUE) {
            if ($_FILES['pimg']['name']!=='') {
                $fileName=$_FILES['pimg'];
                $imgName = $fileName['name'];
                //echo $imgName;
                move_uploaded_file($fileName['tmp_name'], 'uploads/products/' . $imgName);
                $sql = mysqli_query($conn, "UPDATE blog SET img='uploads/products/$imgName' WHERE id = '$id'");
                if ($sql) {
                         echo "<SCRIPT type='text/javascript'>alert(' Edited Successfully...!'); window.location.replace('editblog.php');</SCRIPT>";
            } else {
            echo "<SCRIPT type='text/javascript'>alert('something went wrong...! '); window.location.replace('editblog.php');</SCRIPT>";
        }

}else{
                         echo "<SCRIPT type='text/javascript'>alert(' Edited Successfully...!'); window.location.replace('editblog.php');</SCRIPT>";
            } 
}
}





?>