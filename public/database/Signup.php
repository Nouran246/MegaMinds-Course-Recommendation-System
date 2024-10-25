<?php

// Include the database connection file
include_once "../../public/includes/DB.php";
// Existing PHP code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $FName = htmlspecialchars($_POST["FName"]);
    $LName = htmlspecialchars($_POST["LName"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $Password = htmlspecialchars($_POST["Password"]);
    $role = 1;
    // SQL Query to insert data
    $sql = "INSERT INTO users (FName, LName, Email, Password,role) 
            VALUES ('$FName', '$LName', '$Email', '$Password','$role')";

    // Execute query and check result
    if (mysqli_query($conn, $sql)) {
		$_SESSION['FName'] = $FName; // Store first name
        $_SESSION['LName'] = $LName; // Store last name
        // Redirect the user after successful insertion
        header("Location: ../../views/Users/Courses.php");
        exit();
    } else {
        // Display the error for debugging
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);

?>