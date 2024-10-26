<?php
session_start();
include_once "../../public/includes/DB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "../../public/database/UserClass.php";
    User::login($Email,$Password);
}

// Close the database connection
mysqli_close($conn);
?>
