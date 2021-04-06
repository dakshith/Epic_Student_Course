<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'epicstudent');


 


class DB_con
{
	function __construct()
 { 
  $this->conn= mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysql_error());
  mysqli_select_db($this->conn,DB_NAME); 

 }
 
 public function insert($fname,$lname,$dob,$contact)
 {  try{ 
	  $res = mysqli_query($this->conn, "INSERT student(first_name,last_name,dob,contact) VALUES('$fname','$lname','$dob','$contact')");
	 // print_r($res);exit;
	  return $res;
	  }catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

  public function selectPage($limit,$offset)
 { 
 	try{
  		$res=mysqli_query($this->conn,"SELECT * FROM Student ORDER BY student_id DESC LIMIT $offset,$limit");
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 } 
 
 public function select()
 { 
 	try{
  		$res=mysqli_query($this->conn,"SELECT * FROM Student ORDER BY student_id DESC");
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

  public function selectOne($id)
 {
 	try{ 
		$res=mysqli_query($this->conn,"SELECT * FROM Student WHERE student_id=$id");
		return ($res)? mysqli_fetch_array($res): [];
	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

 public function delete($id)
 { 
 	try{
  		$res=mysqli_query($this->conn,"DELETE FROM student WHERE student_id=$id");
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

  public function deleteCourse($id)
 { 
 	try{
  		$res=mysqli_query($this->conn,"DELETE FROM course WHERE id=$id");
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

 public function update($id,$fname,$lname,$dob,$contact){
 	try{  
 	$query = "UPDATE student 
                    SET first_name='".$fname."', last_name='".$lname."', dob='".$dob."', contact='".$contact."' 
                    WHERE student_id = $id";

     $res=mysqli_query($this->conn,$query); 
    return $res;
    }  
	// show error
	catch(PDOException $exception){
	    die('ERROR: ' . $exception->getMessage());
	}
 }


 public function createCourse($course_name,$detail)
 { 
 	try{
  		$res = mysqli_query($this->conn, "INSERT course(course_name,detail) VALUES('$course_name','$detail')");

	  return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }


  public function selectCourses($limit,$offset)
 { 
 	try{
  		$res=mysqli_query($this->conn,"SELECT * FROM Course ORDER BY id DESC LIMIT $offset,$limit ");
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

   public function selectCoursesAll()
 { 
 	try{
  		$res=mysqli_query($this->conn,"SELECT * FROM Course");
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

 

  public function updateCourse($id,$course_name,$detail){
 	try{  
 	$query = "UPDATE course 
                    SET course_name='".$course_name."', detail='".$detail."' 
                    WHERE id = $id";

     $res=mysqli_query($this->conn,$query); 
    return $res;
    }  
	// show error
	catch(PDOException $exception){
	    die('ERROR: ' . $exception->getMessage());
	}
 }

   public function selectOneCourse($id)
 {
 	try{ 
		$res=mysqli_query($this->conn,"SELECT * FROM course WHERE id=$id");
		return ($res)? mysqli_fetch_array($res): [];
	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }


 public function createSubscription($student,$course)
 { 
 	//print_r($student);exit;
 	try{
 		$sql='';
 		foreach ($student as $key=>$value) {

		       // Add to the $sql variable each INSERT query
		    $sql.="INSERT INTO student_course_mapping (student_id,course_id) VALUES ('$value','$course[$key]'); "; 

		}
  		//$res = mysqli_query($this->conn, "INSERT student_course_mapping(student_id,course_id) VALUES('$student','$course')");
		if (mysqli_multi_query($this->conn, $sql)) {
	       header('Location: subscription.php?action=create');
	   } else {
	       echo 'ERROR: ' . mysqli_error($this->conn);
	   }
	  
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

    public function selectSubscriptionAll()
 { 
 	try{
  		$res=mysqli_query($this->conn," SELECT * FROM student_course_mapping ORDER BY id DESC");
  		//print_r($res);exit;
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }

  public function selectSubscriptionPage($limit,$offset)
 { 
 	try{
  		$res=mysqli_query($this->conn," SELECT u.first_name, u.last_name, i.course_name FROM student_course_mapping p
 JOIN student u on p.student_id=u.student_id
 JOIN course i on p.course_id=i.id ORDER BY p.id DESC LIMIT $offset,$limit");
  		//print_r($res);exit;
  		return $res;
  	}catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
 }
 


}

?>