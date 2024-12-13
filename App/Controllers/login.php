<?php
session_start();
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");
include_once BASE_PATH . "public/includes/DB.php";
include_once BASE_PATH . "App/Model/UserClass.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new PDO("mysql:host=localhost;dbname=megaminds;charset=utf8", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Email = htmlspecialchars($_POST["Email"]);
        $Password = htmlspecialchars($_POST["Password"]);

        // Use the factory to handle login
        $factory = new UserFactory($db);
        $handler = $factory->createUserHandler('Login');

        $handler->handle([
            'Email' => $Email,
            'Password' => $Password
        ]);
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
}
?>