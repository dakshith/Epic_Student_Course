<?php

 include('HomePage.php');
 include_once 'config/DbConnection.php';

 



 
 
 $con = new DB_con(); 
 $res=$con->selectCoursesAll();
 $std=$con->select();



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
 $allSubscriptions=$con->selectSubscriptionPage($limit,$offset);

?>

<!doctype html>
<html lang="en">
 
<body>



<div class="container ">
<div class="row"> 
 
<div class="col-xs-12 col-md-6">
 
<div class="panel panel-default credit-card-box">
<div class="panel-heading"> 
<h3 class="panel-title display-td " >Course Subscription</h3>                   
</div>
<div class="panel-body"> 
<form method="POST"> 
    <div id="main_container">
  <div class="wrapper">
<div class="col-md-5">
      <label for="username">Student:</label>
  <select name="student[]" class="form-control" data-live-search="true" required>
    <option value="">Select a Student</option>
    <?php foreach($std as $value)
 {
   ?>
   <option value="<?= $value['student_id'] ?>"><?= $value['first_name'].' '.$value['last_name'] ?></option> 
            
            <?php
 } ?>
      
    </select>
  </div>
  <div class="col-md-5">
    <label for="username">Course:</label>
  <select name="course[]" class="form-control" data-live-search="true" required>
    <option value="">Select a Course</option>
    <?php foreach($res as $value)
 {
   ?>
   <option value="<?= $value['id'] ?>"><?= $value['course_name'] ?></option> 
            
            <?php
 } ?>
      
    </select>
</div>
<div class="col-md-2">
  <br/>
  <div class="btn btn-warning add-btn">Add</div>
</div>
 </div>
</div>
  <div class="col-md-12 text-center">
    <br/>
	  <input class="btn btn-primary" value="Subscribe Now" type="submit" name="btn-save">
	</div>

</form>

</div>
</div>             


</div>            

<div class="col-xs-12 col-md-6">
  <?php
  
$action = isset($_GET['action']) ? $_GET['action'] : ""; 
if($action=='create'){
    echo "<div class='alert alert-success'>Subscribed Successfully.</div>";
}   
?>
 <table border="1" width="100%" align="center">
    <tr>
      <th colspan="5" class="text-center">Subscription Report</th>
    </tr>
    <tr>
    <th>Student Name</th> 
    <th>Course</th> 
    </tr>
    <?php
 if($allSubscriptions){
 foreach($allSubscriptions as $value)
 { 
   ?>
            <tr>
            <td><?php echo $value['first_name'].' '.$value['last_name']; ?></td> 
            <td><?php echo $value['course_name']; ?></td>
            
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

     $select_stmt=$con->selectSubscriptionAll();
                $total_records=$select_stmt->fetch_all(PDO::FETCH_ASSOC);
          
                
                if(count($select_stmt) > 0)
                {
                  $total_page = ceil(count($total_records) / $limit);
                  
                  echo '<ul class="pagination">';
                  
                  if($page > 1)
                  { 
                    echo '<li><a href="subscription.php?page='.($page - 1).'">Previous</a></li>';  
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
                        <a class="page-link" href="subscription.php?page='.$i.'">'.$i.'</a> 
                        </li>';
                  }
                  
                  if($total_page > $page)
                  { 
                    echo '<li><a href="subscription.php?page='.($page + 1).'">Next</a></li>';    
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


<?php  
try {
     
    if(isset($_POST['btn-save']))
    { 
      //print_r($_POST);exit;
     $student = $_POST['student'];
     $course = $_POST['course']; 
     
     $con->createSubscription($student,$course);
     //header('Location: subscription.php?action=create');
     
    } 
         
   
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>


<script type="text/javascript">
  $(document).ready(function () {
  
 
    // initialize the counter for textbox
    var x = 1;

    // handle click event on Add More button
    $('.add-btn').click(function (e) { 
      e.preventDefault(); 
        x++; // increment the counter
        $.ajax({
            type: "POST",
            url: 'requestAjaxData.php',
            data : {'step':x},
            success: function(response)
            {
              console.log(response);
                $('#main_container').append(response)
           }
       }); 
    });
 
    // handle click event of the remove link
    $(document).on("click", ".remove-lnk", function (e) {
      e.preventDefault();
      rmid = $(this).attr("id");
      $("#row"+rmid).remove();  // remove input field
      x--; // decrement the counter
    })
 
  });
</script>