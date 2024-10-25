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

    // SQL Query to insert data
    $sql = "INSERT INTO users (FName, LName, Email, Password) 
            VALUES ('$FName', '$LName', '$Email', '$Password')";

    // Execute query and check result
    if (mysqli_query($conn, $sql)) {
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