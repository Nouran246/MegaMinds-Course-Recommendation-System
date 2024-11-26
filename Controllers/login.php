<?php
session_start();
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");
include_once BASE_PATH . "public/includes/DB.php";
include_once BASE_PATH . "Controllers/UserClass.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = htmlspecialchars($_POST["Email"]);
    $Password = htmlspecialchars($_POST["Password"]);
    
    User::login($Email, $Password);
    
   /*  $_SESSION['FName'] = $user['FName'];
    $_SESSION['LName'] = $user['LName']; */
}



// Close the database connection
mysqli_close($conn);
?>