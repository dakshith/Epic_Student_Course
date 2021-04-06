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
$res=$con->selectCourses($limit,$offset);

?>

 
<html lang="en">
 
<body>



<div class="container ">
<div class="row"> 
 
<div class="col-xs-12 col-md-4">


<!-- CREDIT CARD FORM STARTS HERE -->
<div class="panel panel-default credit-card-box">
  <div class="panel-heading"> 
  <h3 class="panel-title display-td " >Create Course</h3>                   
  </div>
    <div class="panel-body"> 
      <form method="POST"> 
        <label for="username">Course Name:</label>
        <input type="text" id="fname" class="form-control" name="course_name" required><br/><br/> 

        <label for="username">Course Detail:</label>
        <textarea  id="lname" class="form-control" name="detail" required></textarea><br/><br/>

        <div class="col-md-12 text-center">
      	  <input class="btn btn-primary" value="Create" type="submit" name="btn-save">
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
    echo "<div class='alert alert-success'>Successfully Created.</div>";
} 
$action = isset($_GET['action']) ? $_GET['action'] : ""; 
if($action=='update'){
    echo "<div class='alert alert-success'>Successfully Updated.</div>";
} 
?>
<table border="1" width="100%" align="center">
  <tr>
    <th colspan="3" class="text-center">Available Courses</th>
  </tr>
  <tr>
    <th>Course Name</th>
    <th>Course Detail</th> 
    <th>Actions</th>
  </tr>
  <?php
  if($res){
    foreach($res as $value)
    { ?>
      <tr>
        <td><?php echo $value['course_name']; ?></td>
        <td><?php echo $value['detail']; ?></td> 
        <td><a class="btn btn-success btn-xs" href="UpdateCourse.php?id=<?= $value['id'] ?>">Edit</a> <a class="btn btn-danger btn-xs" href="deleteRec.php?id=<?= $value['id'] ?>&tabname=course">Delete</a></td>
      </tr>
    <?php }  
  }else{ ?>
    <tr>
      <th colspan="3" class="text-center">No Data Found!</th>
    </tr>
  <?php } ?>
</table>

    <?php 

     $select_stmt=$con->selectCoursesAll();
                $total_records=$select_stmt->fetch_all(PDO::FETCH_ASSOC);
          
                
                if(count($select_stmt) > 0)
                {
                  $total_page = ceil(count($total_records) / $limit);
                  
                  echo '<ul class="pagination">';
                  
                  if($page > 1)
                  { 
                    echo '<li><a href="CourseDetails.php?page='.($page - 1).'">Previous</a></li>';  
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
                        <a class="page-link" href="CourseDetails.php?page='.$i.'">'.$i.'</a> 
                        </li>';
                  }
                  
                  if($total_page > $page)
                  { 
                    echo '<li><a href="CourseDetails.php?page='.($page + 1).'">Next</a></li>';    
                  }
                    
                  echo '</ul>'; 
                }

                ?>

        </div>

      </div>
    </div>

 
	
  </body> 
</html>


<?php  
try {
     
    if(isset($_POST['btn-save']))
    { 
      //print_r($_POST);exit;
     $course_name = $_POST['course_name'];
     $detail = $_POST['detail']; 
     
     $con->createCourse($course_name,$detail);
     header('Location: CourseDetails.php?action=created');
     
    } 
         
   
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>