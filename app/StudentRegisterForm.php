<?php

 include('HomePage.php');
 include_once 'config/DbConnection.php';

 



$con = new DB_con(); 

if(isset($_GET['page']))
{
  $page=$_GET['page'];
}
else
{
  $page = 1;
}

$limit = 3;

$offset=($page-1)*$limit;
$res=$con->selectPage($limit,$offset);

?>

<!doctype html>
<html lang="en">
 
<body>



<div class="container ">
<div class="row"> 
 
<div class="col-xs-12 col-md-4"> 
<div class="panel panel-default credit-card-box">
<div class="panel-heading"> 
<h3 class="panel-title display-td " >Registration Form</h3>                   
</div>
<div class="panel-body"> 
<form method="POST" action="StudentRegistration.php"> 
  <label for="username">First Name:</label>
  <input type="text" id="fname" class="form-control" name="firstname" required><br/><br/> 

  <label for="username">Last Name:</label>
  <input type="text" id="lname" class="form-control" name="lastname" required><br/><br/>

  <label for="username">DOB (MM/DD/YYYY):</label>
  <input type="text" id="datepicker" class="form-control"name="dob" required><br/><br/>

  <label for="username">Contact Number:</label>
  <input type="tel" id="contact" class="form-control" name="contact" maxlength="10" minlength="10" required><br/><br/>

  <div class="col-md-12 text-center">
	  <input class="btn btn-primary" value="Register Now" type="submit" name="btn-save">
	</div>
</form>

</div>
</div>             


</div>            

<div class="col-xs-12 col-md-8">
<?php
	$action = isset($_GET['action']) ? $_GET['action'] : ""; 
if($action=='deleted'){
    echo "<div class='alert alert-danger'>Record was deleted.</div>";
} 
$action = isset($_GET['action']) ? $_GET['action'] : ""; 
if($action=='created'){
    echo "<div class='alert alert-success'>Successfully Registered.</div>";
} 
$action = isset($_GET['action']) ? $_GET['action'] : ""; 
if($action=='update'){
    echo "<div class='alert alert-success'>Successfully Updated.</div>";
} 
?>
	<table border="1" width="100%" align="center">
    <tr>
    	<th colspan="5" class="text-center">Registered Students</th>
    </tr>
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>DOB</th>
    <th>Contact</th>
    <th>Actions</th>
    </tr>
    <?php
 if($res){
 foreach($res as $value)
 {
   ?>
            <tr>
            <td><?php echo $value['first_name']; ?></td>
            <td><?php echo $value['last_name']; ?></td>
            <td><?php echo $value['dob']; ?></td>
            <td><?php echo $value['contact']; ?></td>
            <td><a class="btn btn-success btn-xs" href="updateStudent.php?id=<?= $value['student_id'] ?>">Edit</a> <a class="btn btn-danger btn-xs" href="deleteRec.php?id=<?= $value['student_id'] ?>">Delete</a></td>
            </tr>
            <?php
 } 
  }else{ ?>
  	<tr>
    	<th colspan="5" class="text-center">No Data Found!</th>
    </tr>
 <?php } ?>
    </table>

    <?php 

     $select_stmt=$con->select();
                $total_records=$select_stmt->fetch_all(PDO::FETCH_ASSOC);
          
                
                if(count($select_stmt) > 0)
                {
                  $total_page = ceil(count($total_records) / $limit);
                  
                  echo '<ul class="pagination">';
                  
                  if($page > 1)
                  { 
                    echo '<li><a href="StudentRegisterForm.php?page='.($page - 1).'">Previous</a></li>';  
                  }
                  
                  for($i=1; $i<=$total_page; $i++)
                  {
                    if($i == $page){
                      
                      $active = "active"; 
                    }
                    else{
                      
                      $active = "";
                    }
                    
                    echo '<li class="page-item '.$active.' ">
                        <a class="page-link" href="StudentRegisterForm.php?page='.$i.'">'.$i.'</a> 
                        </li>';
                  }
                  
                  if($total_page > $page)
                  { 
                    echo '<li><a href="StudentRegisterForm.php?page='.($page + 1).'">Next</a></li>';    
                  }
                    
                  echo '</ul>'; 
                }

                ?>

</div>

</div>
</div>

 
	
</body>
</body>
</html>

<script type="text/javascript">
   $(function() {
$( "#datepicker" ).datepicker();
});
</script>