<?php
// App\Controllers\addcourse.php
session_start();
// Define the base path and include necessary files
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . "/MegaMinds-Course-Recommendation-System/");
include_once "../../public/includes/DB.php";
include_once "../Model/CoursesClass.php";

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageType = mime_content_type($imageTmpPath);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($imageType, $allowedTypes)) {
            if ($_FILES['image']['size'] <= 2 * 1024 * 1024) { // Limit: 2MB
                $image = file_get_contents($imageTmpPath);
            } else {
                echo json_encode(["status" => "error", "message" => "Image size exceeds 2MB."]);
                exit;
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Unsupported image type."]);
            exit;
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Image upload failed."]);
        exit;
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