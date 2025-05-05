 <?php
include_once '../dbconn.php';

$name = $_POST['name'];
// $classimg = $_POST['classimg'];
$discountcost =$_POST['discountcost'];
$discription =$_POST['discription'];

$cityname =$_POST['cityname'];
$area =$_POST['area'];
	// $sql = "UPDATE courses SET course_name='$courses_Name',course_rate='$courses_rate',offer_prise='$offer_prise', startdate = '$startdate' WHERE course_id= '$id'";
$cityname =$_POST['cityname'];
	$sql = "UPDATE `student` SET `name`='$name',`discountcost`='$discountcost',`discription`='$discription',`cityname`='$cityname',`area`='$area'
	WHERE id= '$id'";
		
	
	//UPDATE `classes` SET `name`='',`classimg`='',`discountprice`='[value-4]',`shortdescription`='[value-5]',`cityname`='[value-6]',`address`='[value-7]' WHERE 1

	
	if ($conn->query($sql) === TRUE) {
			if ($_FILES['image']['name']!=='') {
				$fileName=$_FILES['image'];
				$imgName =$fileName['name'];
				move_uploaded_file($fileName['tmp_name'], 'images/course/' . $photo);
				$sql = mysqli_query($conn, "UPDATE student SET photo='images/course/$photo' WHERE id = '$id'");
				if ($sql) {
						 echo "<SCRIPT type='text/javascript'>alert('Update student Successfully!!'); window.location.replace('studentlist.php');</SCRIPT>";
			} else {
			echo "<SCRIPT type='text/javascript'>alert('something went wrong...! '); window.location.replace('editstudent.php');</SCRIPT>";
		}
			}
			  echo "<SCRIPT type='text/javascript'> //not showing me this
			 			alert('Update student Successfully!!');
			  			window.location.replace('studentlist.php');
			  		</SCRIPT>";
	}
	
	else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>
