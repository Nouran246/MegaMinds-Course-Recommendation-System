<?php
 //grap data from user if form was submitted 

  if($_SERVER["REQUEST_METHOD"]=="POST"){ //check if form was submitted
	$Fname=htmlspecialchars($_POST["FName"]);
	$Lname=htmlspecialchars($_POST["LName"]);
	$Email=htmlspecialchars($_POST["Email"]);
	$Password=htmlspecialchars($_POST["Password"]);

    //insert it to database 
	$sql="insert into users(FirstName,LastName,Email,Password) 
	values('$Fname','$Lname','$Email','$Password')";
	$result=mysqli_query($conn,$sql);

    //redirect the user back to index.php 
	if($result)	{
		header("Location:courses.php");
	}
}

?>
