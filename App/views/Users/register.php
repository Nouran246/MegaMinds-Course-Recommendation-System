
<!DOCTYPE html>
<html lang="en">
<?php
session_start(); // Start the session
include_once "../../../public/includes/DB.php";

?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Megaminds</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../public/css/user css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../public/css/user css/signup_and_in.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../../public/css/user css/fontawesome.css">
    <link rel="stylesheet" href="../../../public/css/user css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../../../public/css/user css/owl.css">
    <link rel="stylesheet" href="../../../public/css/user css/lightbox.css">

</head>

<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            MEGAMINDS
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="#courses">Courses</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                            <li><a href="login.php">Sign In</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="../../../public/images/course-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="caption">
                            <h2>Welcome to MEGAMINDS</h2>
                            <h5>Where you maximise your mind's potential</h5>
                            <div class="main-button-red">
                                <div>
                                    <a href="register.php">
                                        <button id="join">Join Us Now!</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="scroll-to-section">
        <a href="javascript:void(0)" id="openModal">Join Us Now!</a>
    </div>

    <div id="signUpModal" class="modal">
        <div class="modal-content">
        <span class="close" onclick="window.location.href='index.php'">&times;</span>
            <h2>Sign up</h2>
            <form action="../../Controllers/Signup.php" method="POST" id = "signupModal">
                <label for="FName">First Name</label>
                <input type="text" id="FName" name="FName" placeholder="Enter your First Name">
                <p id="firstnameError" class="error-message"></p>

                <label for="LName">Last Name</label>
                <input type="text" id="LName" name="LName" placeholder="Enter your Last Name" >
                <p id="lastnameError" class="error-message"></p>

                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" placeholder="Enter your Email" >
                <p id="emailError" class="error-message"></p>

                <label for="Password">Password</label>
                <div class="password-container">
                    <input type="password" id="Password" name="Password" placeholder="Enter a Password" >
                    <button type="button" class="toggle-password" onclick="togglePassword()">&#128065;</button>
                </div>
                <p id="passwordError" class="error-message"></p>

                <label for="password">Confirm Password</label>
                <div class="password-container">
                    <input type="password" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm your Password" >
                    <button type="button" class="toggle-password" onclick="togglePassword()">&#128065;</button>
                </div>
                <p id="confirmPasswordError" class="error-message"></p>

                <button type="submit" class="login-btn">Create Account</button>
                <p>Already has an account? <a href="login.php">Sign in</a></p>
            </form>
        </div>
    </div>
    <script src="../../../public/js/user js/Signin_and_up.js"></script>
</body>
</html>