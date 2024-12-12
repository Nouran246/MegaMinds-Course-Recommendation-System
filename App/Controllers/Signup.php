<?php
session_start();
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");
include_once BASE_PATH . "public/includes/DB.php";
include_once BASE_PATH . "App/Controllers/UserClass.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new PDO("mysql:host=localhost;dbname=megaminds;charset=utf8", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $FName = htmlspecialchars($_POST["FName"]);
        $LName = htmlspecialchars($_POST["LName"]);
        $Email = htmlspecialchars($_POST["Email"]);
        $Password = htmlspecialchars($_POST["Password"]);

        // Use the factory to handle signup
        $factory = new UserFactory($db);
        $handler = $factory->createUserHandler('Signup');

        $handler->handle([
            'FName' => $FName,
            'LName' => $LName,
            'Email' => $Email,
            'Password' => $Password
        ]);
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
}

?>
