<?php
// User.php
class User {
    private $conn;
    private $usersTable = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new user
    public function register($fname, $lname, $email, $password, $role = 1) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $sql = "INSERT INTO " . $this->usersTable . " (FName, LName, Email, Password, role) 
                VALUES (:fname, :lname, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // User login
    public function login($email, $password) {
        $sql = "SELECT * FROM " . $this->usersTable . " WHERE Email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['Password'])) { // Verify the hashed password
            return $user; // Return user data on successful login
        }
        return false; // Invalid login
    }

    // Get user profile by ID
    public function getProfile($user_id) {
        $sql = "SELECT * FROM " . $this->usersTable . " WHERE ID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user profile
    public function updateProfile($user_id, $fname, $lname, $email) {
        $sql = "UPDATE " . $this->usersTable . " SET FName = :fname, LName = :lname, Email = :email" . " WHERE ID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $user_id);
        return $stmt->execute();
    }

    // Delete user profile
    public function deleteProfile($user_id) {
        $sql = "DELETE FROM " . $this->usersTable . " WHERE ID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
