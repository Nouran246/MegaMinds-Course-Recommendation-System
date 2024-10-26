<?php
session_start();
// Include the database connection file
include_once "../../public/includes/DB.php";
// Existing PHP code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "../../public/database/UserClass.php";

    // Get form data and sanitize it
    User::Signup($FName,$LName,$Email,$Password);
}
// Close the database connection
mysqli_close($conn);

?>