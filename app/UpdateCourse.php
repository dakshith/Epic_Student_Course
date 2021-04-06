<?php

 include('HomePage.php');
 include_once 'config/DbConnection.php';


 



$con = new DB_con();  

 
$id = isset($_GET['id']) ? $_GET['id'] : null; 
$res=$con->selectOneCourse($id);
 
 


?>

<!doctype html>
<html lang="en">
 
<body>



<div class="container ">
<div class="row"> 
 <div class="col-xs-12 col-md-4"> 
</div>
<div class="col-xs-12 col-md-4"> 
<div class="panel panel-default credit-card-box">
<div class="panel-heading"> 
<h3 class="panel-title display-td " >Update Student Details</h3>                   
</div>
<div class="panel-body"> 
<form method="POST"> 
    <label for="username">Course Name:</label>
  <input type="text" id="fname" class="form-control" name="course_name" value="<?= $res['course_name'] ?>" required><br/><br/> 

  <label for="username">Course Detail:</label>
  <textarea  id="lname" class="form-control" name="detail" value="<?= $res['detail'] ?>" required><?= $res['detail'] ?></textarea><br/><br/>

  <div class="col-md-12 text-center">
	  <input class="btn btn-primary" value="Update" type="submit" name="btn-save">
	</div>
</form>

</div>
</div>             


</div>            

<div class="col-xs-12 col-md-4">
 

</div>

</div>
</div>

 
	
</body>
</body>
</html>


<?php  
try {
     
    if(isset($_POST['btn-save']) && isset($_GET['id']))
    { 
     $course_name = $_POST['course_name'];
     $detail = $_POST['detail']; 
     
     $con->updateCourse($_GET['id'],$course_name,$detail);
     header('Location: CourseDetails.php?action=update');
     
    } 
         
   
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>