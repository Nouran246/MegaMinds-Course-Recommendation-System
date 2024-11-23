<?php
session_start();
// Include the database connection file
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");

include_once BASE_PATH . "public/includes/DB.php";
// Existing PHP code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once BASE_PATH . "Controllers/UserClass.php";
    $FName = htmlspecialchars($_POST["FName"]);
    $LName = htmlspecialchars($_POST["LName"]);
    $Email = htmlspecialchars($_POST["Email"]);
    $Password = htmlspecialchars($_POST["Password"]);
    // Get form data and sanitize it
    User::Signup($FName,$LName,$Email,$Password);
}
// Close the database connection
mysqli_close($conn);

?>