<!DOCTYPE html>
<html lang="en">
<?php
// Database connection settings
$host = 'localhost'; // Replace with your database host
$dbname = 'megaminds'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
  // Create a new PDO instance for database connection
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  // Set PDO error mode to exception for better error handling
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare and execute the query to fetch courses
  $stmt = $pdo->prepare("SELECT course_ID, course_name, description, level, start_date, end_date, rating, fees, tags FROM courses");
  $stmt->execute();

  // Fetch all courses as an associative array
  $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  // Handle database connection errors
  die("Database connection failed: " . $e->getMessage());
}
?>


  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Courses</title>

    <!-- Bootstrap core CSS -->
    <link href="../../public/css/user css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../public/css/user css/fontawesome.css">
    <link rel="stylesheet" href="../../public/css/user css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../../public/css/user css/owl.css">
    <link rel="stylesheet" href="../../public/css/user css/lightbox.css">
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
                          <li><a href="Courses.php" class="active">My Courses</a></li>

                          <li><a href="cart-page.php">Cart</a></li> 

                          <li><a href="profile.php">My Profile</a></li> 
                          
                          <li><a href="../../Controllers/signout.php?action=signout">Sign out</a></li> 

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
    <h6>Hello, <?php echo isset($_SESSION['FName']) ? $_SESSION['FName'] : 'Guest'; ?> <?php echo isset($_SESSION['LName']) ? $_SESSION['LName'] : ''; ?>!</h6>        
        <h2>Let's dive into learning</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12">
            <div class="filters">
              <ul>
                <li data-filter="*" class="active">All Courses</li>
                <li data-filter=".soon">Current Courses</li>
                <li data-filter=".imp">Recommended Courses</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="row grid">
              <?php
              // Assuming $courses is fetched from your database
              foreach ($courses as $course) {
                $courseName = htmlspecialchars($course['course_name']);
                $coursePrice = htmlspecialchars($course['fees']);
              ?>
              <div class="col-lg-4 templatemo-item-col all soon">
                <div class="meeting-item">
                    <a href="meeting-details.php?course_ID=<?php echo $course['course_ID']; ?>">
                        <div class="thumb">
                            <div class="price">
                                <span>$<?php echo $coursePrice; ?></span>
                            </div>
                            <img src="../../public/images/placeholder.jpg" alt="Course Image">
                        </div>
                        <div class="down-content">
                            <div class="date">
                                <h6>Month <span>1</span></h6>
                            </div>
                            <h4><?php echo $courseName; ?></h4>
                        </div>
                    </a>
                </div>

              </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="pagination">
              <ul>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <p>Copyright © 2024 MEGAMINDS. All Rights Reserved.</p>
  </div>
</section>

  </section>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="../../public/js/user js/jquery.min.js"></script>
    <script src="../../public/js/user js/bootstrap.min.js"></script>
    <script src="../../public/js/user js/isotope.min.js"></script>
    <script src="../../public/js/user js/owl-carousel.js"></script>
    <script src="../../public/js/user js/lightbox.js"></script>
    <script src="../../public/js/user js/tabs.js"></script>
    <script src="../../public/js/user js/isotope.js"></script>
    <script src="../../public/js/user js/video.js"></script>
    <script src="../../public/js/user js/slick-slider.js"></script>
    <script src="../../public/js/user js/custom.js"></script>
    <script src="../../public/js/user js/courses.js"></script>
  </body>

</html>
