<?php
   // Start session
   session_start();

   // Include database connection file
   include_once "../../public/includes/DB.php";


   //grab data from user and see if it exists in database
   if($_SERVER["REQUEST_METHOD"]=="POST"){

    $Email=$_POST["Email"];
	$Password=$_POST["Password"];
	$sql="Select * from users where Email ='$Email' and Password='$Password'";
	$result = mysqli_query($conn,$sql);
    if($row=mysqli_fetch_array($result))	{
		$_SESSION["ID"]=$row[0];
		$_SESSION["FName"]=$row["FName"];
		$_SESSION["LName"]=$row["LName"];
		$_SESSION["Email"]=$row["Email"];
		$_SESSION["Password"]=$row["Password"];

		header("Location: ../../views/Users/Courses.php?login=success");
	}
	else	{
		echo "Inalid Email or Password";
	}
   }

?>
