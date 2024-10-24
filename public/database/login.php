<?php
   //start session
   session_start();

   //include database connection file
   include_once "includes/dbh.inc.php";
   
   //grab data from user and see if it exists in database
   if($_SERVER["REQUEST_METHOD"]=="POST"){

    $Email=$_POST["Email"];
	  $Password=$_POST["Password"];
   
   //select data from database where email and password matches

  $sql = "Select * from users where Email='$Email' and Password='$Password'";
  $result = mysqli_query($conn,$sql);
   //if true then use session variables to use it as long as session is started

   if($row=mysqli_fetch_array($result)) {
    
    $_SESSION["ID"]=$row[0];
    $_SESSION["FName"]=$row["FirstName"];
    $_SESSION["LName"]=$row["LastName"];
    $_SESSION["Email"]=$row["Email"];
    $_SESSION["Password"]=$row["Password"];   
    header("Location:courses.php?login=success");

  }
  else{

    echo "Invalid";
  }
	
   }

 
 ?>