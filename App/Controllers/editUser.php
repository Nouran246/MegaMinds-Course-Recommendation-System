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

        // Check if the email already exists for another user
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE Email = :email AND id != :id");
        $stmt->execute(['email' => $email, 'id' => $id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // Email is already in use by another user
            echo json_encode(['status' => 'error', 'message' => 'Email already in use.']);
            exit;
        }

        // Proceed to update the user if no duplicate email is found
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
