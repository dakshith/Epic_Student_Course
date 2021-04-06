<?php
include_once 'config/DbConnection.php';
$conn = new DB_con();

// data insert code starts here.
if(isset($_POST['btn-save']))
{
	try{
		 $fname = $_POST['firstname'];
		 $lname = $_POST['lastname'];
		 $dob = $_POST['dob'];
		 $contact = $_POST['contact'];
		 
		 $conn->insert($fname,$lname,$dob,$contact);
		 header('Location: StudentRegisterForm.php?action=created');
	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 
}
// data insert code ends here.

?>