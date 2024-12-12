

<?php
session_start();
// Define the base path and include necessary files
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");
include_once "../../public/includes/DB.php";
include_once "CoursesClass.php";

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use the Builder class to construct a course object
    $builder = new Builder();
    $course = $builder
        ->setCourseName(htmlspecialchars($_POST['course_name']))
        ->setDescription(htmlspecialchars($_POST['description']))
        ->setLevel(htmlspecialchars($_POST['level']))
        ->setStartDate(htmlspecialchars($_POST['start_date']))
        ->setEndDate(htmlspecialchars($_POST['end_date']))
        ->setRating(htmlspecialchars($_POST['rating']))
        ->setFees(htmlspecialchars($_POST['fees']))
        ->setTags(htmlspecialchars($_POST['tags']))
        ->build();

    // Call the AddCourse method with the constructed course
    Course::AddCourse(
        $course->course_name,
        $course->description,
        $course->level,
        $course->start_date,
        $course->end_date,
        $course->rating,
        $course->fees,
        $course->tags
    );
}

// Close the database connection
mysqli_close($conn);
?>
