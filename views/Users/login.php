<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="../../public/js/signup_and_in.js"></script> <!-- Make sure this path is correct -->

    <!-- Bootstrap core CSS -->
    <link href="../../public/css/user css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="../../public/css/signup_and_in.css" rel="stylesheet">
    <link href="../../public/css/templatemo-edu-meeting.css" rel="stylesheet">
    
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../public/css/user css/fontawesome.css">
    <link rel="stylesheet" href="../../public/css/user css/owl.css">
    <link rel="stylesheet" href="../../public/css/user css/lightbox.css">
</head>
<body>

<div class="scroll-to-section">
    <a href="javascript:void(0)" id="openModal">Join Us Now!</a>
</div>

<div id="loginModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Welcome back</h2>
        <form method="post">
            <label for="Email">Email</label>
            <input type="email" id="Email" name="Email" placeholder="Enter your Email" required>

            <label for="Password">Password</label>
            <div class="password-container">
                <input type="password" id="Password" name="Password" placeholder="Enter your Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">&#128065;</button>
            </div>

            <a href="#" class="forgot-password">Forgot password?</a>

            <button type="submit" class="login-btn">Login</button>

            <div class="divider">or</div>
            <button type="button" class="google-btn">
                <img src="../../public/images/google.png" id="google" alt="Google Logo" class="google-icon">
                Continue with Google
            </button>
            <button type="button" class="microsoft-btn">
                <img src="../../public/images/microsoft.png" id="microsoft" alt="Microsoft Logo" class="google-icon">
                Continue with Microsoft
            </button>
            <button type="button" class="apple-btn">
                <img src="../../public/images/apple.png" id="apple" alt="Apple Logo" class="google-icon">
                Continue with Apple
            </button>

            <p>New to the site? <a href="register.html">Sign up</a></p>
        </form>
    </div>
</div>

<?php
// Make sure the path to DB.php is correct
include_once "../../public/database/DB.php";
?>

</body>
</html>
