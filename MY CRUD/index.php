<?php
$servername='localhost';
$username='root';
$password='';
$dbname='mycrud';
$conn=mysqli_connect($servername,$username,$password,$dbname);

$id='';
$name='';
$phone='';
$email='';


if(isset($_POST['create'])){
    $name=$_POST['personname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $id=null;
    $query="INSERT INTO mycrud VALUES(?,?,?,?)";
    $stmt=mysqli_prepare($conn,$query); //used to prepare an sql statement for execution
    mysqli_stmt_bind_param($stmt,'ssis',$id,$name,$phone,$email);
    mysqli_stmt_execute($stmt);
    if(mysqli_affected_rows($conn)>0){
    	echo '<script>alert("INSERTED SUCCESSFULLY")</script>';
    }
    else{
    	echo '<script>alert("NOT INSERTED")</script>';
    }
}

if(isset($_POST['read'])){
    $id=$_POST['id'];
    $query="SELECT * FROM mycrud WHERE id=?";
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $num_rows=mysqli_num_rows($result); //if the id contains some row then this is in use so is num rows is greater than 0
    if($num_rows>0){
    	//if the id contains the data then it will stored in rows in array form
    	while($rows=mysqli_fetch_array($result)){
    		$id=$rows['id'];
    		$name=$rows['name'];
    		$phone=$rows['phonenum'];
    		$email=$rows['email'];
    	}
    }
    else{
    	echo '<script>alert("NO DATA FOUND")</script>';
    }
}

if(isset($_POST['update'])){
	$id=$_POST['id'];
	$name=$_POST['personname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $query="UPDATE mycrud SET name=?,phonenum=?,email=? WHERE id=?";
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'siss',$name,$phone,$email,$id);
    mysqli_stmt_execute($stmt);
    if(mysqli_affected_rows($conn)>0){
    	echo '<script>alert("UPDATES SUCCESSFULLY")</script>';
    }
    else{
    	echo '<script>alert("NOT UPDATED")</script>';
    }
}

if(isset($_POST['delete'])){
	$id=$_POST['id'];
    $query="DELETE FROM mycrud WHERE id=?";
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    if(mysqli_affected_rows($conn)>0)
    {
    	echo '<script>alert("DELETED SUCCESSFULLY")</script>';
    }
    else{
    	echo '<script>alert("NOT DELETED")</script>';
    }	
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MY CRUD</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">CRUD APPLICATION</h4>
  <p>CREATE!!READ!!UPDATE!!DELETE</p>
</div>


			<form action="" method="post">
				<div class="mb-3">
  <label>USER ID</label>
  <input type="text" class="form-control" name='id' placeholder="ID" value='<?php echo $id; ?>'>
</div>
<div class="mb-3">
  <label>NAME</label>
  <input type="text" class="form-control" name='personname' placeholder="NAME" value='<?php echo $name; ?>'>
</div>
<div class="mb-3">
  <label>PHONE NUMBER</label>
  <input type="text" class="form-control" name='phone' placeholder="PHONE NUMBER" value='<?php echo $phone; ?>'>
</div>
<div class="mb-3">
  <label>EMAIL</label>
  <input type="email" class="form-control" name='email' placeholder="EMAIL" value='<?php echo $email; ?>'>
</div>
<button type="submit" name='create' class="btn btn-primary">CREATE</button>
<button type="submit" name='read' class="btn btn-secondary">READ</button>

<button type="submit" name='update'  class="btn btn-warning">UPDATE</button>

<button type="submit" name='delete' class="btn btn-danger">DELETE</button>


			</form>
		</div>
		<div class="col-lg-4"></div>
	</div>
</div>
</body>
</html>