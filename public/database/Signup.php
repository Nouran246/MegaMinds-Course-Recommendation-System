<?php

include_once "includes/DB.php";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get form data and sanitize it
	$Fname = htmlspecialchars($_POST["FName"]);
	$Lname = htmlspecialchars($_POST["LName"]);
	$Email = htmlspecialchars($_POST["email"]);  // Fixed 'Email' to 'email'
	$Password = htmlspecialchars($_POST["password"]); // Fixed 'Password' to 'password'

	// Insert it into the database
	$sql = "INSERT INTO users(FName, LName, Email, Password) 
            VALUES('$Fname', '$Lname', '$Email', '$Password')";

	// Execute query and check result
	if (mysqli_query($conn, $sql)) {
		// Redirect the user after successful insertion
		header("Location: Courses.php");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);  // Add error output for debugging
	}
}

// Close the database connection
mysqli_close($conn);
?>