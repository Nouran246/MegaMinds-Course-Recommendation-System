<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include_once "../../../public/includes/DB.php"; // Ensure this file establishes a PDO connection
include "../../Model/UserClass.php";
// Query to fetch the specific menu items: My Courses, Cart, My Profile, and Sign out
$query = "SELECT * FROM menu WHERE name IN ('My Courses', 'Cart', 'My Profile', 'Sign out')";
$result = mysqli_query($conn, $query);

// Check if any rows are returned
if (!$result) {
    die("Error fetching menu items: " . mysqli_error($conn));
}

// Fetch the menu items into an array
$menu_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Check if any rows are returned
if (!$result) {
    die("Error fetching menu items: " . mysqli_error($conn));
}
// Create a PDO connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "megaminds";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Verify session
if (!isset($_SESSION['user_id'])) {
    die('User not logged in.');
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM users WHERE ID = :id");
$stmt->execute(['id' => $user_id]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_data) {
    die('User not found.');
}

// Instantiate User class
$user = new User($conn);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteAccount'])) {
        // Delete account
        $deleteHandler = new DeleteUserHandler($conn); // Use the appropriate handler
        if ($deleteHandler->handle(['id' => $user_id])) {
            session_destroy();
            header("Location: /MegaMinds-Course-Recommendation-System/App/views/Users/index.php");
            exit();
        } else {
            echo "Error deleting account.";
        }
    } else {
        // Update profile
        $fname = htmlspecialchars(trim($_POST['FName']));
        $lname = htmlspecialchars(trim($_POST['LName']));
        $email = htmlspecialchars(trim($_POST['Email']));

        $updateHandler = new UpdateProfileHandler($conn); // Use the appropriate handler
        if ($updateHandler->handle(['id' => $user_id, 'FName' => $fname, 'LName' => $lname, 'Email' => $email])) {
            echo "Profile updated!";
        } else {
            echo "Error updating profile.";
        }
    }
}


?>






<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>My Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../public/css/user css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap CSS (Make sure this is included) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (with bundle including Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Public files (CSS)! -->
    <link href="../../../public/css/user css/profile.css" rel="stylesheet">



    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../../public/css/user css/fontawesome.css">
    <link rel="stylesheet" href="../../../public/css/user css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../../../public/css/user css/owl.css">
    <link rel="stylesheet" href="../../../public/css/user css/lightbox.css">
    <!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->

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
        MegaMinds
    </a>
    <!-- ***** Logo End ***** -->
    <!-- ***** Menu Start ***** -->
    <ul class="nav">
        <?php
        // Loop through the fetched menu items and display each one
        if (isset($menu_items) && is_array($menu_items)) {
            foreach ($menu_items as $index => $item) {
                // Set the 'active' class on the first item as an example, you can adjust it as needed
                $active_class = ($index == 0) ? 'class="active"' : '';
                echo "<li><a href='" . htmlspecialchars($item['href']) . "' $active_class>" . htmlspecialchars($item['name']) . "</a></li>";
            }
        } else {
            echo "No menu items available.";
        }
        ?>
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

    <section class="apply-now" id="apply">

        <div class="container" style="margin-top: 70px;">
            <div class="row">
                <div class="col-lg-6"
                    style="background-color:white; width:340px;height:330px;margin-left: 10px; margin-bottom: 10px;">

                    <div class="item" style="text-align:center; height:320px; background-color: white;">
                        <div class="profile-img" style="text-align: center; margin-right:12px;">
                            <img src="../../public/images/course-02.jpg" id="profile-img" alt="Profile Image"
                                style="width:150px; height:150px; object-fit: cover; border-radius:50%;">
                        </div>

                        <div class="info" style="margin-top: 5px;">
                            <label for="userName" id="label-name" class="form-label"
                                style="font-weight: bold; margin: 20px 20px 10px; text-decoration: solid;">
                                <?= htmlspecialchars($user_data['FName']) ?> <?= htmlspecialchars($user_data['LName']) ?></label>
                            <div class="main-button-yellow" style="text-align:center;">
                                <div id="edit-img-btn"><a href="#">Edit Image</a></div>
                                <input type="file" id="profileImage" name="profileImage"
                                    accept="image/png, image/jpeg, image/jpg" style="display:none;">
                                <div id="error-image-message" class="error-message"
                                    style="color: red; font-size: 12px; display: none; font-weight: bold;"></div>


                            </div>
                        </div>
                    </div>
                </div>


                <!-- info here -->
                <div class="col-lg-6">
                    <div class="item">
                        <!-- Tabs for User Info Section -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="basicInfo-tab" data-bs-toggle="tab" href="#basicInfo"
                                    role="tab" aria-controls="basicInfo" aria-selected="true"
                                    style="font-weight:500;">Basic Info</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="interest-tab" data-bs-toggle="tab" href="#interest" role="tab"
                                    aria-controls="interest" aria-selected="false" style="font-weight:500;">Your
                                    interests</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="progress-tab" data-bs-toggle="tab" href="#progress" role="tab"
                                    aria-controls="progress" aria-selected="false" style="font-weight:500;">Your
                                    progress</a>
                            </li>
                        </ul>

                        <form action="profile.php" method="POST">
                            <div class="tab-content" id="myTabContent"> 
                                <!-- Basic Info Tab -->
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                    <div class="row" style="margin-top: 20px;">
                                        <!-- Name Input -->
                                        <div class="col-12">
                                            <label for="FName">First Name</label>
                                            <input type="text" name="FName" id="FName" class="form-control" value="<?= htmlspecialchars($user_data['FName']) ?>" required>
                                            <label for="LName">Last Name</label>
                                            <input type="text" name="LName" id="LName" class="form-control" value="<?= htmlspecialchars($user_data['LName']) ?>" required>
                                        </div>
                                        <!-- Email Input -->
                                        <div class="col-12">
                                            <label for="Email">Email</label>
                                            <input type="email" name="Email" id="Email" class="form-control"
                                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" value="<?= htmlspecialchars($user_data['Email']) ?>" required>
                                            <div id="error-email-message" class="error-message"
                                                style="color: red; font-size: 12px; display: none; font-weight:400;"></div>
                                        </div>
                                        <!-- Phone input dropdown-->
                                        <div class="col-12">
                                            <label for="phone">Phone</label>
                                            <div class="input-group">
                                                <select class="form-select" id="phoneCode" name="phoneCode" required>
                                                    <option value="+20">+20 (Egypt)</option>
                                                    <option value="+1">+1 (USA/Canada)</option>
                                                    <option value="+44">+44 (UK)</option>
                                                    <option value="+49">+49 (Germany)</option>
                                                    <option value="+33">+33 (France)</option>
                                                </select>
                                                <input type="tel" id="phone" name="phone" class="form-control"
                                                    value="1234567890" pattern="^\d{10}$" required>
                                            </div>
                                            <div id="error-phone-message" class="error-message"
                                                style="color: red; font-size: 12px; display: none; font-weight: 400;"></div>
                                        </div>

                                        <!-- University Dropdown -->
                                        <div class="col-12">
                                            <label for="university">University</label>
                                            <select id="university" class="form-select" name="university" required>
                                                <option value="MIU">Misr International University</option>
                                                <option value="AUC">The American University in Cairo</option>
                                                <option value="CairoU">Cairo University</option>
                                                <option value="TantaU">Tanta University</option>
                                            </select>
                                        </div>
                                        <!-- Degree Program Dropdown -->
                                        <div class="col-12">
                                            <label for="degreeProgram">Degree Program</label>
                                            <select id="degreeProgram" class="form-select" name="degreeProgram" required>
                                                <option value="Bachelors">Bachelor's</option>
                                                <option value="Masters">Master's</option>
                                                <option value="PhD">PhD</option>
                                                <option value="Diploma">Diploma</option>
                                            </select>
                                        </div>
                                        <!-- Major Input -->
                                        <div class="col-12">
                                            <label for="major">Major</label>
                                            <select id="major" class="form-select" name="major" required>
                                                <option value="Computer Science">Computer Science</option>
                                                <option value="Electrical Engineering">Electrical Engineering</option>
                                                <option value="Mechanical Engineering">Mechanical Engineering</option>
                                                <option value="Business Administration">Business Administration</option>
                                                <option value="Mathematics">Mathematics</option>
                                                <option value="Physics">Physics</option>
                                            </select>
                                        </div>
                                        <!-- Location Dropdown for Country -->
                                        <div class="col-12">
                                            <label for="location">Location</label>
                                            <select id="location" class="form-select" name="location" required>
                                                <option value="Cairo, Egypt">Cairo, Egypt</option>
                                                <option value="New York, USA">New York, USA</option>
                                                <option value="London, UK">London, UK</option>
                                                <option value="Berlin, Germany">Berlin, Germany</option>
                                                <option value="Paris, France">Paris, France</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary" id="saveChanges"
                                                style="background-color:#f5a425; color: white; border-color: #FFBF00;">Save
                                                Changes</button>
                                                <button type="submit" class="btn btn-primary" id="deleteAccount" name="deleteAccount"
                                                style="background-color: red; color: white; border-color: #FFBF00;">Delete Account</button>
                                            <button type="button" class="btn btn-secondary" id="resetChanges">Reset</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Learning Path Tab -->
                                <div class="tab-pane fade" id="interest" role="tabpanel" aria-labelledby="interest">
                                    <div class="row" style="margin-top: 20px;">
                                        <!-- Skills -->
                                        <div class="section">
                                            <label for="skills">Select Skills for Your Learning Plan</label>
                                            <div class="checkbox-group">
                                                <input type="checkbox" id="html" name="skills" value="html" checked>
                                                <label for="html">HTML</label>

                                                <input type="checkbox" id="css" name="skills" value="css">
                                                <label for="css">CSS</label>

                                                <input type="checkbox" id="js" name="skills" value="js" checked>
                                                <label for="js">JavaScript</label>

                                                <input type="checkbox" id="python" name="skills" value="python">
                                                <label for="python">Python</label>

                                                <input type="checkbox" id="java" name="skills" value="java">
                                                <label for="java">Java</label>

                                                <input type="checkbox" id="react" name="skills" value="react">
                                                <label for="react">React</label>

                                                <input type="checkbox" id="nodejs" name="skills" value="nodejs" checked>
                                                <label for="nodejs">Node.js</label>

                                                <input type="checkbox" id="sql" name="skills" value="sql">
                                                <label for="sql">SQL</label>

                                                <input type="checkbox" id="ruby" name="skills" value="ruby">
                                                <label for="ruby">Ruby</label>

                                                <input type="checkbox" id="php" name="skills" value="php">
                                                <label for="php">PHP</label>
                                            </div>
                                        </div>
                                        <!-- Subjects -->
                                        <div class="section">
                                            <label for="subjects">Select Subjects</label>
                                            <div class="checkbox-group">
                                                <input type="checkbox" id="webDev" name="subjects" value="webDev" checked>
                                                <label for="webDev">Web Development</label>

                                                <input type="checkbox" id="dataSci" name="subjects" value="dataSci">
                                                <label for="dataSci">Data Science</label>

                                                <input type="checkbox" id="ai" name="subjects" value="ai" checked>
                                                <label for="ai">AI & Machine Learning</label>

                                                <input type="checkbox" id="cyberSec" name="subjects" value="cyberSec">
                                                <label for="cyberSec">Cybersecurity</label>

                                                <input type="checkbox" id="cloud" name="subjects" value="cloud">
                                                <label for="cloud">Cloud Computing</label>
                                            </div>
                                        </div>
                                        <!-- Careers -->
                                        <div class="section">
                                            <label for="career">Select Your Desired Career</label>
                                            <div class="checkbox-group">
                                                <input type="checkbox" id="softwareEngineer" name="career" value="Software Engineer">
                                                <label for="softwareEngineer">Software Engineer</label>

                                                <input type="checkbox" id="dataScientist" name="career" value="Data Scientist" checked>
                                                <label for="dataScientist">Data Scientist</label>

                                                <input type="checkbox" id="aiResearcher" name="career" value="AI Researcher">
                                                <label for="aiResearcher">AI Researcher</label>

                                                <input type="checkbox" id="webDeveloper" name="career" value="Web Developer">
                                                <label for="webDeveloper">Web Developer</label>

                                                <input type="checkbox" id="cybersecurityAnalyst" name="career" value="Cybersecurity Analyst">
                                                <label for="cybersecurityAnalyst">Cybersecurity Analyst</label>

                                                <input type="checkbox" id="projectManager" name="career" value="Project Manager">
                                                <label for="projectManager">Project Manager</label>

                                                <input type="checkbox" id="bioinformatician" name="career" value="Bioinformatician">
                                                <label for="bioinformatician">Bioinformatician</label>
                                            </div>
                                        </div>

                                        <!-- Learning Style -->
                                        <div class="section">
                                            <label for="learningStyle">Preferred Learning Style</label>
                                            <div class="checkbox-group">
                                                <input type="checkbox" id="video" name="learningStyle" value="video" checked>
                                                <label for="video">Video</label>

                                                <input type="checkbox" id="text" name="learningStyle" value="text">
                                                <label for="text">Text</label>

                                                <input type="checkbox" id="handsOn" name="learningStyle" value="handsOn">
                                                <label for="handsOn">Hands-On</label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary" id="saveLearningPlan"
                                                style="background-color:#f5a425; color: white; border-color: #FFBF00;">Save Learning
                                                Plan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <div class="footer">
            <p>Copyright © 2024 MEGAMINDS. All Rights Reserved.
            </p>
        </div>
    </section>
    </section>


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="../../../public/js/user js/jquery.min.js"></script>
    <script src="../../../public/js/user js/bootstrap.bundle.min.js"></script>

    <script src="../../../public/js/user js/isotope.min.js"></script>
    <script src="../../../public/js/user js/owl-carousel.js"></script>
    <script src="../../../public/js/user js/lightbox.js"></script>
    <script src="../../../public/js/user js/tabs.js"></script>
    <script src="../../../public/js/user js/isotope.js"></script>
    <script src="../../../public/js/user js/video.js"></script>
    <script src="../../../public/js/user js/slick-slider.js"></script>
    <script src="../../../public/js/user js/custom.js"></script>

    <!-- Public files (JS)! -->
    <script src="../../../public/js/user js/profile.js"></script>
    <script>
    document.getElementById('deleteAccount').addEventListener('click', function () {
        if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
            // Submit the form when confirmed
            document.getElementById('deleteAccountForm').submit();
        }
    });
</script>

</body>


</body>

</html>