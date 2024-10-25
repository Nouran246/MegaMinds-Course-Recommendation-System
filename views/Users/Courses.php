<!DOCTYPE html>
<html lang="en">
<?php
session_start();

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
                  <li data-filter="*"  class="active">All Courses</li>
                  <li data-filter=".soon">Current Courses</li>
                  <li data-filter=".imp">Recommeded Courses</li>
                  <li data-filter=".att">Meetings</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="row grid">
                <div class="col-lg-4 templatemo-item-col all soon">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$14.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-01.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Month <span>1</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>New Lecturers Meeting</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all imp">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$22.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-02.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Mins <span>60</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>Online Teaching Techniques</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all soon">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$24.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-03.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Months <span>2</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>Network Teaching Concept</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all att">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$32.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-04.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Hours <span>12</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>Online Teaching Tools</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all att">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$34.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-02.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Hours <span>22</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>New Teaching Techniques</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all imp">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$45.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-03.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Minutes <span>24</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>Technology Conference</h4></a>
                      <p>TemplateMo is the best website<br>when it comes to Free CSS.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all imp att">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$52.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-01.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Hours <span>27</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>Online Teaching Techniques</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all soon imp">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$64.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-02.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Hours <span>28</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>Instant Lecture Design</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 templatemo-item-col all att soon">
                  <div class="meeting-item">
                    <div class="thumb">
                      <div class="price">
                        <span>$74.00</span>
                      </div>
                      <a href="meeting-details.php"><img src="../../public/images/meeting-03.jpg" alt=""></a>
                    </div>
                    <div class="down-content">
                      <div class="date">
                        <h6>Weeks <span>30</span></h6>
                      </div>
                      <a href="meeting-details.php"><h4>Online Social Networking</h4></a>
                      <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
                    </div>
                  </div>
                </div>
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
    <script src="../../public/js/user js/courses.js"></script>
   
 

<?php
session_start();
// Assuming you have already verified the user's credentials

// Example: Storing user data in session after successful login or signup
$_SESSION['FName'] = $user['FName']; // Replace with actual user data
$_SESSION['LName'] = $user['LName']; // Replace with actual user data
?>



  </body>

</html>
