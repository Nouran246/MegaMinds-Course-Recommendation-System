<?php
// App\Controllers\addcourse.php
session_start();
// Define the base path and include necessary files
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");
include_once "../../public/includes/DB.php";
include_once "../Model/CoursesClass.php";

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES['image']['tmp_name']); // Get the binary data
    } else {
        $image = null; // Handle error or set a default value
    }
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
        ->setImage($image)
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
        $course->tags,
        $course->image
    );
}

// Close the database connection
mysqli_close($conn);
?>