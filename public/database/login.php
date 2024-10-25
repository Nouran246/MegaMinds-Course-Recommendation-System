<?php
session_start();
include_once "../../public/includes/DB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $Email = htmlspecialchars($_POST["Email"]);
    $Password = htmlspecialchars($_POST["Password"]); // Get raw password input

    // SQL Query to select the user
    $sql = "SELECT FName, LName, Password, role FROM users WHERE Email = '$Email'";
    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password without hashing it
        if (password_verify($Password, $user['Password'])) {
            // Store user information in session
            $_SESSION['FName'] = $user['FName']; // Store first name
            $_SESSION['LName'] = $user['LName']; // Store last name
            $_SESSION['role'] = $user['role']; // Store user role

            // Redirect based on user role
            if ($user['role'] == 1) {
                header("Location: ../../views/Users/Courses.php");
            } elseif ($user['role'] == 2) {
                header("Location: ../../views/Admins/dashboard.php");
            }
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No user found with that email address.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
