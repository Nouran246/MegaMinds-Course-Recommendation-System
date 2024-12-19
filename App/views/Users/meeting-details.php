<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once "../../../public/includes/DB.php";
$host = 'localhost'; // or your host
$dbname = 'megaminds'; // your database name
$username = 'root'; // your username
$password = ''; // your password

try {
  // Establish PDO connection
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if (isset($_GET['course_ID'])) {
  $course_id = $_GET['course_ID'];

  // Define the query to fetch course details
  $query = "SELECT * FROM courses WHERE course_ID = :course_id";

  // Prepare the query
  $stmt = $pdo->prepare($query);

  // Bind the course ID to the query
  $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);

  // Execute the query
  if ($stmt->execute()) {
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($course) {
      // Display course details
      // echo "<h2>" . htmlspecialchars($course['course_name']) . "</h2>";
      // echo "<p><strong>Description:</strong> " . htmlspecialchars($course['description']) . "</p>";
      // echo "<p><strong>Level:</strong> " . htmlspecialchars($course['level']) . "</p>";
      // echo "<p><strong>Start Date:</strong> " . htmlspecialchars($course['start_date']) . "</p>";
      // echo "<p><strong>End Date:</strong> " . htmlspecialchars($course['end_date']) . "</p>";
      // echo "<p><strong>Rating:</strong> " . htmlspecialchars($course['rating']) . "/10</p>";
      // echo "<p><strong>Fees:</strong> $" . htmlspecialchars($course['fees']) . "</p>";
      // echo "<p><strong>Tags:</strong> " . htmlspecialchars($course['tags']) . "</p>";
    } else {
      echo "Course not found.";
    }
  } else {
    echo "Error fetching course details.";
  }
} else {
  echo "No course selected.";
}

// Query to fetch the specific menu items: My Courses, Cart, My Profile, and Sign out
$query = "SELECT * FROM menu WHERE name IN ('My Courses', 'Cart', 'My Profile', 'Sign out')";
$result = mysqli_query($conn, $query);

// Check if any rows are returned
if (!$result) {
    die("Error fetching menu items: " . mysqli_error($conn));
}

// Fetch the menu items into an array
$menu_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>



<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Template Mo">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

  <title>Education Template - Meeting Detail Page</title>

  <!-- Bootstrap core CSS -->
  <link href="../../../public/css/user css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="../../../public/css/user css/fontawesome.css">
  <link rel="stylesheet" href="../../../public/css/user css/templatemo-edu-meeting.css">
  <link rel="stylesheet" href="../../../public/css/user css/owl.css">
  <link rel="stylesheet" href="../../../public/css/user css/lightbox.css">
  <link rel="stylesheet" href="../../../public/css/user css/meeting-details.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
  <!-- ***** Header Area End ***** -->

  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Get all details</h6>
          <h2>Online Teaching and Learning Tools</h2>
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
              <div class="meeting-single-item">
                <div class="thumb">
                  <div class="price">
          
                  </div>
                  <div class="date">
                    <h6>Nov <span>12</span></h6>
                  </div>
                  <img src="data:image/jpeg;base64,<?= base64_encode($course['image']); ?>" alt="Course Image">
                </div>
                <div class="down-content">
                  <a href="meeting-details.php?course_ID=<?= htmlspecialchars($course['course_ID']) ?>">
                    <h4><?= htmlspecialchars($course['course_name']) ?></h4>
                  </a>

                  <!-- Dynamic course details -->
                  <p><strong>Description:</strong> <?= htmlspecialchars($course['description']) ?></p>
                  <p><strong>Level:</strong> <?= htmlspecialchars($course['level']) ?></p>
                  <p><strong>Start Date:</strong> <?= htmlspecialchars($course['start_date']) ?></p>
                  <p><strong>End Date:</strong> <?= htmlspecialchars($course['end_date']) ?></p>
                  <p><strong>Fees:</strong> $<?= htmlspecialchars($course['fees']) ?></p>
                  <p><strong>Tags:</strong> <?= htmlspecialchars($course['tags']) ?></p>

                  <div class="main-button-red">
                    <!-- Button to Add To Cart (replace this if needed with relevant action) -->
                    <button
                      onclick="window.location.href='cart-page.php?course_ID=<?= htmlspecialchars($course['course_ID']) ?>'">Add
                      To Cart</button>
                  </div>
                </div>

              </div>
              <br>



            </div>

            <div class="container">

              <div class="row text-center">
                <h3 class="text-center">Learners Reviews</h3>
                <div class="col-sm-6 col-md-4">

                  <div class="testimonial-box">
                    <img
                      src="https://images.pexels.com/photos/206615/pexels-photo-206615.jpeg?w=940&h=650&auto=compress&cs=tinysrgb"
                      class="img-responsive" alt="" width="90">
                    <div class="ratings-icons">
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                    </div>
                    <h4>James Baker</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sapien augue, dictum et gravida et
                    </p>

                  </div>
                </div> <!-- End Col -->

                <div class="col-sm-6 col-md-4">
                  <div class="testimonial-box">
                    <img
                      src="https://images.pexels.com/photos/478544/pexels-photo-478544.jpeg?w=940&h=650&auto=compress&cs=tinysrgb"
                      class="img-responsive" alt="" width="90">
                    <div class="ratings-icons">
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="glyphicon glyphicon-star"></span>
                      <span class="fa fa-star"></span>
                    </div>
                    <h4>Jon Doe</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sapien augue, dictum et gravida et
                    </p>

                  </div>
                </div> <!-- End Col -->

                <div class="col-sm-6 col-md-4">
                  <div class="testimonial-box">
                    <img
                      src="https://images.pexels.com/photos/478544/pexels-photo-478544.jpeg?w=940&h=650&auto=compress&cs=tinysrgb"
                      class="img-responsive" alt="" width="90">
                    <div class="ratings-icons">
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                      <span class="glyphicon glyphicon-star"></span>
                      <span class="glyphicon glyphicon-star"></span>
                    </div>
                    <h4>Maria Jose</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sapien augue, dictum et gravida et
                    </p>

                  </div>
                </div> <!-- End Col -->


              </div>
            </div>
          </div>
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
  <script src="../../../public/js/user js/jquery/jquery.min.js"></script>
  <script src="../../../public/js/user js/bootstrap.bundle.min.js"></script>

  <script src="../../../public/js/user js/isotope.min.js"></script>
  <script src="../../../public/js/user js/owl-carousel.js"></script>
  <script src="../../../public/js/user js/lightbox.js"></script>
  <script src="../../../public/js/user js/tabs.js"></script>
  <script src="../../../public/js/user js/video.js"></script>
  <script src="../../../public/js/user js/slick-slider.js"></script>
  <script src="../../../public/js/user js/custom.js"></script>
  <script src="../../../public/js/user js/meeting-details.js"></script>

</body>

</body>

</html>