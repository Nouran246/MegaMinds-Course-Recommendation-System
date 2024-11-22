<?php
session_start();
include_once "../../public/includes/DB.php";
include_once "../../public/database/UserClass.php";

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