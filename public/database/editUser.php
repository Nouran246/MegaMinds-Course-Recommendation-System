<?php
// Database connection settings
$host = 'localhost';
$dbname = 'megaminds';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['id']) && isset($_POST['Fname']) && isset($_POST['Lname']) && isset($_POST['Email'])) {
        $id = $_POST['id'];
        $fname = $_POST['Fname'];
        $lname = $_POST['Lname'];
        $email = $_POST['Email'];

        $stmt = $pdo->prepare("UPDATE users SET Fname = :fname, Lname = :lname, Email = :email WHERE id = :id");
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection error: ' . $e->getMessage()]);
}
?>
