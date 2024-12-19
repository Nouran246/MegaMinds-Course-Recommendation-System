<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../../public/includes/DB.php"; // Make sure DB.php has the necessary connection details
include "../../Model/UserClass.php";
include "../../Model/CoursesClass.php";
// Query to fetch the specific menu items: My Courses, Cart, My Profile, and Sign out
$query = "SELECT * FROM menu WHERE name IN ('My Courses', 'Cart', 'My Profile', 'Sign out')";
$result = mysqli_query($conn, $query);

// Check if any rows are returned
if (!$result) {
    die("Error fetching menu items: " . mysqli_error($conn));
}

// Fetch the menu items into an array
$menu_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
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

    echo "Course added to cart!" . "<br>";
  } else {
    echo "Course not found.";
  }
} catch (PDOException $e) {
  echo "Error fetching course data: " . $e->getMessage();
}
// echo $user_id . '<br>';
// echo $course_id . '<br>';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $paymentMethod = $_POST['paymentMethod'] ?? null;
  $user_id = $_SESSION['user_id'] ?? null;
  $course_id = $_SESSION['course_ID'] ?? null;

  // Debugging: Sanitize and output for testing (remove in production)
  // echo "User ID: " . htmlspecialchars($user_id) . "<br>";
  // echo "Course ID: " . htmlspecialchars($course_id) . "<br>";

  // Validate input
  if ($user_id && $course_id) {
    try {
      // Corrected SQL query
      $stmt = $conn->prepare("INSERT INTO user_courses (user_id, course_ID) VALUES (:user_id, :course_id)");
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
      $stmt->execute();

      echo "Course successfully added!";
    } catch (PDOException $e) {
      // Log the error for debugging
      error_log("Error: " . $e->getMessage());
      // echo "Something went wrong. Please try again.";
    }
  } else {
    echo "All fields are required.";
  }
}



?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Template Mo">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


  <title>Cart</title>

  <link href="../../public/css/user css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../public/css/user css/fontawesome.css">
  <link rel="stylesheet" href="../../../public/css/user css/templatemo-edu-meeting.css">
  <link rel="stylesheet" href="../../../public/css/user css/owl.css">
  <link rel="stylesheet" href="../../../public/css/user css/lightbox.css">
</head>

<body>
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

  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Get all my courses</h6>
          <h2>My Cart</h2>
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
              <br>

              <div class="meeting-single-item">
                <div class="thumb">
                  <div class="price">
                    <span>$20.60</span>
                  </div>
                  <div class="date">
                    <h6>Nov <span>12</span></h6>
                  </div>
                  <img src="data:image/jpeg;base64,<?= base64_encode($course['image']); ?>" alt="Course Image">
                  </div>
                <div class="down-content">
                  <div class="down-content">
                    <a href="meeting-details.php?course_ID=<?= htmlspecialchars($course['course_ID']) ?>">
                      <h4><?= htmlspecialchars($course['course_name']) ?></h4>
                    </a>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="hours">
                          <h5>Duration</h5>
                          <p><strong> Start Date: </strong> <?= htmlspecialchars($course['start_date']) ?></p>
                          <p><strong>End Date: </strong> <?= htmlspecialchars($course['end_date']) ?></p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Checkout Section -->
                  <div class="container mt-5 text-center">
                    <h3>Total Price: $<?= htmlspecialchars($course['fees']) ?></h3>
                    <button type="button" class="btn btn-primary mt-3" id="checkoutButton"
                      onclick="paymentMethodSelect()">Check out now!</button>
                  </div>


                  <!-- Payment Checkout Modal -->
                  <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="checkoutModalLabel">Payment Checkout</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form id="paymentForm" method="POST">
                            <!-- Payment Method Dropdown -->
                            <div class="mb-3">
                              <label for="paymentMethod" class="form-label">Payment Method</label>
                              <select class="form-control" id="paymentMethod">
                                <option>Select Payment Method</option>
                                <option value="creditCard">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bankTransfer">Bank Transfer</option>
                              </select>
                            </div>

                            <!-- Credit Card Information -->
                            <div id="creditCardFields">
                              <div class="mb-3">
                                <label for="cardNumber" class="form-label">Credit Card Number</label>
                                <input type="text" class="form-control" id="cardNumber"
                                  placeholder="Enter credit card number">
                              </div>
                              <div class="mb-3">
                                <label for="cardName" class="form-label">Cardholder Name</label>
                                <input type="text" class="form-control" id="cardName" placeholder="Enter name on card">
                              </div>
                              <div class="mb-3">
                                <label for="expiryDate" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                              </div>
                              <div class="mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" placeholder="3-digit code">
                              </div>
                            </div>


                            <div id="PayPalFields">
                              <div class="mb-3">
                                <label for="cardNumber" class="form-label">Account Number</label>
                                <input type="text" class="form-control" id="cardNumber"
                                  placeholder="Enter account number">
                              </div>
                              <div class="mb-3">
                                <label for="cardName" class="form-label">Account Name</label>
                                <input type="text" class="form-control" id="cardName" placeholder="Enter account name">
                              </div>
                            </div>


                            <div id="BanckTransFields">
                              <div class="mb-3">
                                <div class="mb-3">
                                  <label for="cardName" class="form-label">Account Name</label>
                                  <input type="text" class="form-control" id="cardName"
                                    placeholder="Enter account name">
                                </div>
                                <label for="cardNumber" class="form-label">Account Number</label>
                                <input type="text" class="form-control" id="cardNumber"
                                  placeholder="Enter account number">
                              </div>
                            </div>
                            <button type="button" class="btn btn-success" onclick="redirectToPaymentPage()">Pay Now</button>      
                            <div id="messageArea" style="margin-top: 10px;"></div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <!-- ha7ot hena el feed back of the courses -->
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
  <script src="../../../public/js/user js/jquery.min.js"></script>
  <script src="../../../public/js/user js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/lightbox.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/video.js"></script>
  <script src="assets/js/slick-slider.js"></script>
  <script src="assets/js/custom.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


  <!-- Bootstrap JS and dependencies (Popper.js and jQuery) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


  <script>
    //according to loftblog tut
    function redirectToPaymentPage() {
        // Display the success message
        var messageArea = document.getElementById('messageArea');
        var successMessage = document.createElement('div');
        successMessage.textContent = "Course Purchased";
        successMessage.style.color = 'green';
        successMessage.style.fontWeight = 'bold';
        successMessage.style.marginTop = '10px';
        messageArea.appendChild(successMessage);

        // Set a timeout to remove the message after 2 seconds
        setTimeout(function() {
            successMessage.remove();
              // Redirect to the desired page after the button is clicked
        var redirectUrl = '../../../app/views/Users/InsideCourse.php'; // Replace with your path
        window.location.href = redirectUrl;
        }, 2000);

      
    }

    var showSection = function showSection(section, isAnimate) {
      var
        direction = section.replace(/#/, ''),
        reqSection = $('.section').filter('[data-section="' + direction + '"]'),
        reqSectionPos = reqSection.offset().top - 0;

      if (isAnimate) {
        $('body, html').animate({
          scrollTop: reqSectionPos
        },
          800);
      } else {
        $('body, html').scrollTop(reqSectionPos);
      }

    };

    var checkSection = function checkSection() {
      $('.section').each(function () {
        var
          $this = $(this),
          topEdge = $this.offset().top - 80,
          bottomEdge = topEdge + $this.height(),
          wScroll = $(window).scrollTop();
        if (topEdge < wScroll && bottomEdge > wScroll) {
          var
            currentId = $this.data('section'),
            reqLink = $('a').filter('[href*=\\#' + currentId + ']');
          reqLink.closest('li').addClass('active').
            siblings().removeClass('active');
        }
      });
    };

    $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
      e.preventDefault();
      showSection($(this).attr('href'), true);
    });

    $(window).scroll(function () {
      checkSection();
    });


    // Show the modal when the "Check out now!" button is clicked
    const checkoutButton = document.getElementById('checkoutButton');
    const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));

    checkoutButton.addEventListener('click', function () {
      checkoutModal.show();
    });

    // Hide the credit card fields initially, show them when "Credit Card" is selected
    const paymentMethodSelect = document.getElementById('paymentMethod');
    const creditCardFields = document.getElementById('creditCardFields');
    const PayPalFields = document.getElementById('PayPalFields');
    const BanckTransFields = document.getElementById('BanckTransFields');

    // Initially hide all payment fields
    const hideAllFields = () => {
      creditCardFields.style.display = 'none';
      PayPalFields.style.display = 'none';
      BanckTransFields.style.display = 'none';
    };

    // Hide all fields on page load
    hideAllFields();

    // Function to add course and user IDs into the users_courses table
    function addUserCourse() {
      consol.log("HELLO THERE");
      var userID = <?php echo $_SESSION['user_id']; ?>;
      var courseID = <?php echo isset($_SESSION['course_ID']) ? $_SESSION['course_ID'] : 0; ?>;
      consol.log("AHHHHHHH THERE");
      // Create a hidden form element
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = ''; // Submit to the current page

      // Create hidden input fields for user_id and course_id
      var userIDInput = document.createElement('input');
      userIDInput.type = 'hidden';
      userIDInput.name = 'user_id';
      userIDInput.value = userID;

      var courseIDInput = document.createElement('input');
      courseIDInput.type = 'hidden';
      courseIDInput.name = 'course_id';
      courseIDInput.value = courseID;

      // Append the inputs to the form
      form.appendChild(userIDInput);
      form.appendChild(courseIDInput);

      // Append the form to the body and submit it
      document.body.appendChild(form);
      form.submit();
    }


    // Show the correct fields based on the selected payment method
    paymentMethodSelect.addEventListener('change', function () {
      hideAllFields(); // Hide all fields first

      switch (this.value) {
        case 'creditCard':
          creditCardFields.style.display = 'block';
          break;
        case 'paypal':
          PayPalFields.style.display = 'block';
          break;
        case 'bankTransfer':
          BanckTransFields.style.display = 'block';
          break;
        default:
          // Optionally, handle cases where no valid payment method is selected
          break;
      }
    });

  </script>
</body>


</body>

</html>