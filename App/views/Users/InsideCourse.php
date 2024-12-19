<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../../public/includes/DB.php"; // Make sure DB.php has the necessary connection details
include "../../Model/UserClass.php";
include "../../Model/CoursesClass.php";

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "megaminds";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}

// Create instances of User and Course classes
$user = new User($conn);
$c = new Course($conn);

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Ensure course_ID is set from session or URL
if (isset($_GET['course_ID'])) {
  $course_id = $_GET['course_ID'];
  $_SESSION['course_ID'] = $course_id; // Optionally store course_ID in session
} elseif (isset($_SESSION['course_ID'])) {
  $course_id = $_SESSION['course_ID'];
} else {
  echo "No course selected.";
  exit;
}
// echo $user_id . '<br>';
// echo $course_id . '<br>';
// Fetch course details
try {
  $stmt = $conn->prepare("SELECT * FROM courses WHERE course_ID = :course_id");
  $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
  $stmt->execute();
  $course = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($course) {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }

    // Add the course to the cart
    $_SESSION['cart'][$course['course_ID']] = [
      'course_name' => $course['course_name'],
      'description' => $course['description'],
      'level' => $course['level'],
      'start_date' => $course['start_date'],
      'end_date' => $course['end_date'],
      'rating' => $course['rating'],
      'fees' => $course['fees'],
      'tags' => $course['tags'],
      'image' => $course['image']
    ];

  } else {
    echo "Course not found.";
  }
} catch (PDOException $e) {
  echo "Error fetching course data: " . $e->getMessage();
}

// Query to fetch the specific menu items: My Courses, Cart, My Profile, and Sign out
// Fetch menu items using PDO
$query = "SELECT * FROM menu WHERE name IN ('My Courses', 'Cart', 'My Profile', 'Sign out')";

try {
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Fetch the menu items into an array
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$menu_items) {
        echo "No menu items found.";
    }
} catch (PDOException $e) {
    echo "Error fetching menu items: " . $e->getMessage();
    exit;
}

?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <title>Course Content</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../public/css/user css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../../public/css/user css/fontawesome.css">
    <link rel="stylesheet" href="../../../public/css/user css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../../../public/css/user css/owl.css">
    <link rel="stylesheet" href="../../../public/css/user css/lightbox.css">
    <link rel="stylesheet" href="../../../public/css/user css/InsideCourse.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


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
    <!-- ***** Header Area End ***** -->

    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Improve your programming knowledge </h6>
                    <a href="meeting-details.php?course_ID=<?= htmlspecialchars($course['course_ID']) ?>">
                      <h2><?= htmlspecialchars($course['course_name']) ?></h2>
                    </a>                </div>
            </div>
        </div>
    </section>

    <section class="meetings-page" id="meetings">

        <section class="course-content">
            <div class="container">
                <div class="row">
                    <!-- Sidebar for course outline -->
                    <nav class="col-md-3">
                        <h5>Course Outline</h5>
                        <ul class="list-group">
                            <li class="list-group-item active" data-index="0">Lesson 1</li>
                            <li class="list-group-item" data-index="1">Lesson 2</li>
                            <li class="list-group-item" data-index="2">Lesson 3</li>
                            <li class="list-group-item" data-index="3">Lesson 4</li>
                            <li class="list-group-item" data-index="4">Lesson 5</li>
                            <li class="list-group-item" data-index="5">Lesson 6</li>
                        </ul>
                    </nav>

                    <!-- Main content area for the video and details -->
                    <main class="col-md-9">
                        <div id="lesson-container" class="lesson-section mb-3">
                            <h2 id="lesson-title">Lesson 1: Basics</h2>
                            <p id="lesson-description">Brief description of the Basics lecture content.</p>
                            <div class="embed-responsive mb-4">
                                <iframe id="lesson-video" class="embed-responsive-item" src="https://www.youtube.com/embed/8j9b_9Zy8C8" allowfullscreen></iframe>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-secondary" id="prevButton">Previous</button>
                            <button class="btn btn-primary" id="nextButton">Next</button>
                        </div>
                    </main>
                </div>
            </div>
        </section>
        <br><br>
            <section>
            <div class="discussion-container">
                <br><br>
                <h1>Course Discussion</h1>
                <br>
                <form id="discussionForm">
                    <input type="text" id="userNameInput" placeholder="Your Name" required>
                    <textarea id="userCommentInput" placeholder="Write your comment here..." required></textarea>
                    <button type="submit">Post Comment</button>
                </form>
        
                <div id="discussionCommentsSection">
                    <h2>Comments</h2>
                    <div id="discussionCommentsList">
                        <!-- Comments will appear here -->
                    </div>
                </div>
            </div>
        </section>

        <div class="footer">
            <p>Copyright © 2024 MEGAMINDS. All Rights Reserved. 
              </p>
          </div>
        </section>
    </section>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="../../../public/js/user js/jquery.min.js"></script>
    <script src="../../../public/js/user js/bootstrap.min.js"></script>

    <script src="../../../public/js/user js/isotope.min.js"></script>
    <script src="../../../public/js/user js/owl-carousel.js"></script>
    <script src="../../../public/js/user js/lightbox.js"></script>
    <script src="../../../public/js/user js/tabs.js"></script>
    <script src="../../../public/js/user js/isotope.js"></script>
    <script src="../../../public/js/user js/video.js"></script>
    <script src="../../../public/js/user js/slick-slider.js"></script>
    <script src="../../../public/js/user js/custom.js"></script>
    <script src="../../../public/js/user js/InsideCourse.js"></script>
   
</body>

</html>
