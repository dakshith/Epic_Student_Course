<?php 
 include_once 'config/DbConnection.php'; 
 $con = new DB_con(); 
 $res=$con->selectCoursesAll();
 $std=$con->select();

$row=$_POST['step'];

$statement='<div class="wrapper"id=row'.$row.'>
				<div class="col-md-5">
      				<label for="username">Student:</label>
  					<elect name="student[]" class="form-control" data-live-search="true" required="">
    			    <ption value="">Select a Student</option>';
					foreach($std as $value)
					 {
					   
					   $statement.='<option value="'.$value['student_id'].'">'.$value['first_name'].' '.$value['last_name'].'</option>';
					            
					             
					 } 
       
            
                  
$statement.='</select></div>
  <div class="col-md-5">
    <label for="username">Course:</label>
	  <select name="course[]" class="form-control" data-live-search="true" required="">
	    <option value="">Select a Course</option>';
	      foreach($res as $value)
		 { 
		
		   $statement.='<option value="'.$value['id'].'">'.$value['course_name'].'</option>';
		            
		            
		 } 
                  
    $statement.='</select>
</div>
<div class="col-md-2"><br>
  <a href="#" class="btn btn-danger remove-lnk" id="'.$row.'">Remove</a>
</div> ';

echo $statement;
?>