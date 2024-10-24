<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <title>Course Content</title>

    <!-- Bootstrap core CSS -->
    <link href="../../public/css/user css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../public/css/user css/fontawesome.css">
    <link rel="stylesheet" href="../../public/css/user css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../../public/css/user css/owl.css">
    <link rel="stylesheet" href="../../public/css/user css/lightbox.css">
    <link rel="stylesheet" href="../../public/css/user css/InsideCourse.css">

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
                        <li><a href="Courses.php" class="active">My Courses</a></li>
                        <li class="has-sub">
                            <a href="javascript:void(0)">Meetings</a>
                            <ul class="sub-menu">
                                <li><a href="meetings.php">Upcoming Meetings</a></li>
                                <li><a href="meeting-details.php">Meeting Details</a></li>
                            </ul>
                        </li>
                        <li><a href="cart-page.php">Cart</a></li> 

                        <li><a href="profile.php">My Profile</a></li> 
                        
                        <li><a href="index.php">Sign out</a></li> 

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
                    <h2>Introduction to Computer Science </h2>
                </div>
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
                            <li class="list-group-item active" data-index="0">Lesson 1: Basics</li>
                            <li class="list-group-item" data-index="1">Lesson 2: Advanced Topics</li>
                            <li class="list-group-item" data-index="2">Lesson 3: Data Structures</li>
                            <li class="list-group-item" data-index="3">Lesson 4: Object Oriented Programming</li>
                            <li class="list-group-item" data-index="4">Lesson 5: Operating Systems</li>
                            <li class="list-group-item" data-index="5">Lesson 6: Artificial Intelligence</li>
                            <li class="list-group-item" data-index="6">Lesson 7: Machine Learning</li>
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
    <script src="../../public/js/user js/InsideCourse.js"></script>
   
</body>

</html>
