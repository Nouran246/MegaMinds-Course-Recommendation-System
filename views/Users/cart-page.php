<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../public/includes/DB.php";

session_start();
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>Cart</title>

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
                          <li><a href="Courses.php" >My Courses</a></li>
                          <li><a href="cart-page.php" class="active">My Cart</a></li> 
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
              <!-- <div class="meeting-single-item">
                <div class="thumb">
                  <div class="price">
                    <span>$14.00</span>
                  </div>
                  <div class="date">
                    <h6>Jan <span>3</span></h6>
                  </div>
                  <a href="meeting-details.php"><img src="../../public/images/single-meeting.jpg" alt=""></a>
                </div>
                <div class="down-content">
                  <a href="meeting-details.php"><h4>Online Teaching and Learning Tools</h4></a>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="hours">
                        <h5>Hours</h5>
                        <p>Monday - Friday: 07:00 AM - 13:00 PM</p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="location">
                        <h5>Location</h5>
                        <p>Recreio dos Bandeirantes, 
                        <br>Rio de Janeiro - RJ, 22795-008, Brazil</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

              <br>

              <div class="meeting-single-item">
                <div class="thumb">
                  <div class="price">
                    <span>$20.60</span>
                  </div>
                  <div class="date">
                    <h6>Nov <span>12</span></h6>
                  </div>
                  <a href="meeting-details.php"><img src="../../public/images/AI.jpeg" alt=""></a>
                </div>
                <div class="down-content">
                  <a href="meeting-details.php"><h4>Introduction To AI</h4></a>
                  <!-- <div class="row">
                    <div class="col-lg-4">
                      <div class="hours">
                        <h5>Hours</h5>
                        <p>Monday - Friday: 07:00 AM - 13:00 PM</p>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="location">
                        <h5>Location</h5>
                        <p>Recreio dos Bandeirantes, 
                        <br>Rio de Janeiro - RJ, 22795-008, Brazil</p>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
                        <!-- Checkout Button -->
            <div class="container mt-5 text-center">
              <h3>Total Price: $34.60</h3>
              <button type="button" class="btn btn-primary mt-3" id="checkoutButton">Check out now!</button>
            </div>

            <!-- Payment Checkout Modal -->
            <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <h4 class="modal-title" id="checkoutModalLabel">Payment Checkout</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">
                    <form id="paymentForm">
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
                          <input type="text" class="form-control" id="cardNumber" placeholder="Enter credit card number">
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
                          <input type="text" class="form-control" id="cardNumber" placeholder="Enter account number">
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
                            <input type="text" class="form-control" id="cardName" placeholder="Enter account name">
                          </div>
                          <label for="cardNumber" class="form-label">Account Number</label>
                          <input type="text" class="form-control" id="cardNumber" placeholder="Enter account number">
                        </div>
                      </div>


                      <button type="submit" class="btn btn-success">Pay Now</button>
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
    <script src="../../public/js/user js/jquery.min.js"></script>
    <script src="../../public/js/user js/bootstrap.min.js"></script>

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
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
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

        checkoutButton.addEventListener('click', function() {
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

        // Show the correct fields based on the selected payment method
        paymentMethodSelect.addEventListener('change', function() {
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
