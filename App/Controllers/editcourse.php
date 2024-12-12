<?php
// Database connection settings
$host = 'localhost'; // Replace with your database host
$dbname = 'megaminds'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the request is for updating a course
    if (isset($_POST['course_ID']) && isset($_POST['course_name']) && isset($_POST['description']) && isset($_POST['level']) && isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['rating']) && isset($_POST['fees']) && isset($_POST['tags']) ) {
        $courseId = (int)$_POST['course_ID'];
        $courseName = $_POST['course_name'];
        $description = $_POST['description'];
        $level = $_POST['level'];
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $rating = $_POST['rating'];
        $fees = $_POST['fees'];
        $tags = $_POST['tags'];

        // Check if the course name already exists for another course
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM courses WHERE course_name = :course_name AND course_ID != :course_ID");
        $stmt->execute(['course_name' => $courseName, 'course_ID' => $courseId]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Course name is already in use by another course
            echo json_encode(['status' => 'error', 'message' => 'Course name already in use.']);
            exit;
        }

        // Proceed to update the course if no duplicate course name is found
        $stmt = $pdo->prepare("UPDATE courses SET course_name = :course_name, description = :description, level = :level, start_date = :start_date, end_date = :end_date, rating = :rating, fees = :fees, tags = :tags WHERE course_ID = :course_ID");
        $stmt->bindParam(':course_name', $courseName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':fees', $fees);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':course_ID', $courseId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Course updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update course']);
        }
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection error: ' . $e->getMessage()]);
}
?>
