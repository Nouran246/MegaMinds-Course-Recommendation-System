<?php
session_start();
// Include the database connection file
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");

include_once "../../public/includes/DB.php";
// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "CoursesClass.php";
        // course_ID is auto-incremented in the database
            $course_name = htmlspecialchars($_POST['course_name']);
            $description = htmlspecialchars($_POST['description']);
            $level = htmlspecialchars($_POST['level']);
            $start_date = htmlspecialchars($_POST['start_date']);
            $end_date = htmlspecialchars($_POST['end_date']);
            $rating = htmlspecialchars($_POST['rating']);
            $fees = htmlspecialchars($_POST['fees']);
            $tags = htmlspecialchars($_POST['tags']);
    Course::AddCourse($course_name, $description, $level, $start_date, $end_date, $rating, $fees, $tags);
    }
    mysqli_close($conn);
?>
