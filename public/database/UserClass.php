<?php
class UserClass {
    private $pdo;

    // Constructor to initialize the database connection
    public function __construct($host = '127.0.0.1', $dbname = 'megaminds', $username = 'root', $password = '') {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Method to create a new user
    public function createUser($firstName, $lastName, $email, $password, $role = 1) {
        $sql = "INSERT INTO users (FName, LName, Email, Password, role) VALUES (:firstName, :lastName, :email, :password, :role)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Encrypt password
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    // Method to get a user by ID
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to update a user by ID
    public function updateUser($id, $firstName, $lastName, $email, $password = null, $role = 1) {
        $sql = "UPDATE users SET FName = :firstName, LName = :lastName, Email = :email, role = :role";
        if ($password) {
            $sql .= ", Password = :password";
        }
        $sql .= " WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        if ($password) {
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Encrypt password
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Method to delete a user by ID
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Method to get all users
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
