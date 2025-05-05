<?php


if (isset($_POST['update'])) {
    require '../conn.php';

    $id = $_POST['ID'];
  
    if ($conn->query($sql1) === TRUE) {
        if ($_FILES['bimg']['name']!=='') {
            $fileName=$_FILES['bimg'];
            $imgName = $fileName['name'];
        //   echo $imgName;
            move_uploaded_file($fileName['tmp_name'], 'uploads/products/' . $imgName);
            $sql1 = mysqli_query($conn, "UPDATE gallery SET img='uploads/products/$imgName' WHERE id = '$id'");
            if ($sql1) {
                     echo "<SCRIPT type='text/javascript'>alert(' Edited Successfully...!'); window.location.replace('editgallery.php');</SCRIPT>";
        } else {
        echo "<SCRIPT type='text/javascript'>alert('something went wrong...! '); window.location.replace('editgallery.php');</SCRIPT>";
    }

}else{
                     echo "<SCRIPT type='text/javascript'>alert(' Edited Successfully...!'); window.location.replace('editgallery.php');</SCRIPT>";
        } 
}


}





?>