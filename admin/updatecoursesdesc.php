 <?php
include_once '../dbconn.php';

	$id = $_POST['ID'];
	$coursesdescdetail = $_POST["coursesdescdetail"];
	//$coursename = $_POST["coursename"];
	$coursevideo = $_POST['coursevideo'];

	$sql = "UPDATE coursesdesc SET coursesdescdetail='$coursesdescdetail',coursevideo='$coursevideo' WHERE coursesdesc_id= '$id'";
		if ($conn->query($sql) === TRUE) {
			  echo "<SCRIPT type='text/javascript'> //not showing me this
			 			alert('Course Description Update Successfully!!');
			  			window.location.replace('coursesdesc.php');
			  		</SCRIPT>";
				}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
?>
