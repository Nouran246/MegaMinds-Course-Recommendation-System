<?php
// Database connection settings
$host = 'localhost'; // Replace with your database host
$dbname = 'megaminds'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id']) && !empty($_POST['course_id'])) {
        $courseId = (int)$_POST['course_id'];
        
        $stmt = $pdo->prepare("DELETE FROM courses WHERE course_ID = :course_id");
        $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Course deleted successfully.']);
        } else {
            echo json_encode(['message' => 'Error executing the delete statement.']);
        }
    } else {
        echo json_encode(['message' => 'Invalid request: Course ID is missing.']);
    }
} catch (PDOException $e) {
    echo json_encode(['message' => 'Database error: ' . $e->getMessage()]);
}
?>
