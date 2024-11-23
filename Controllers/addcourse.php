<?php
// Database connection settings
$host = 'localhost'; // Replace with your database host
$dbname = 'megaminds'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Usage example for adding a course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $course = new Course(
            null, // Assuming course_ID is auto-incremented
            $_POST['course_name'],
            $_POST['description'],
            $_POST['level'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['rating'],
            $_POST['fees'],
            $_POST['tags']
        );
        if ($course->addCourse()) {
            echo json_encode(['status' => 'success', 'message' => 'Course added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add course.']);
        }
    } elseif ($_POST['action'] === 'edit') {
        Course::editCourse();
    } elseif ($_POST['action'] === 'delete' && isset($_POST['course_ID'])) {
        echo Course::deleteCourse($_POST['course_ID']);
    }
}
?>