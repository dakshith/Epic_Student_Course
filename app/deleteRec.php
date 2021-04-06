<?php
// include database connection
include_once 'config/DbConnection.php';
$conn = new DB_con();
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    //print_r($_GET);exit;
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    $tabname=$_GET['tabname'];
 
    
    if($tabname='course'){
    $conn->deleteCourse($id);
     header('Location: CourseDetails.php?action=deleted');
    }else{
    	$conn->delete($id);
    	 header('Location: StudentRegisterForm.php?action=deleted');
    }
         
   
}  
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>