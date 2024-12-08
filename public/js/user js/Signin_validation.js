 // Get modal elements
 var loginModal = document.getElementById("loginModal");
 var closeLogin = loginModal.getElementsByClassName("close")[0];

 // Function to show the login modal
 function showLoginModal() {
     loginModal.style.display = "flex";
 }

 // Get the "Join Us Now!" button
 var joinButton = document.getElementById("join");

 // When the user clicks on the "Join Us Now!" button, show the login modal
 joinButton.onclick = function () {
     showLoginModal();
 };

 // Close the login modal when the user clicks on the close (x)
 closeLogin.onclick = function () {
     loginModal.style.display = "none";
     window.location.href = "index.php"; // Redirect to homepage
 };

 // Close the modal if the user clicks outside of it
 window.onclick = function (event) {
     if (event.target == loginModal) {
         loginModal.style.display = "none";
     }
 };

 // Function to toggle password visibility
 function togglePassword() {
     const passwordInput = document.getElementById("Password");
     passwordInput.type = passwordInput.type === "password" ? "text" : "password";
 }

 // Login form validation
 const loginForm = document.querySelector("#loginModal form");
 loginForm.addEventListener("submit", function (event) {
     // Clear previous error messages
     clearErrorMessages();

     let isValid = true;

     // Validate email
     const emailInput = document.getElementById("Email");
     const emailValue = emailInput.value.trim();
     const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format

     if (emailValue === "") {
         displayErrorMessage("emailError", "Email is required.");
         isValid = false;
     } else if (!emailPattern.test(emailValue)) {
         displayErrorMessage("emailError", "Please enter a valid email address.");
         isValid = false;
     }

     // Validate password
     const passwordInput = document.getElementById("Password");
     if (passwordInput.value.trim() === "") {
         displayErrorMessage("passwordError", "Password is required.");
         isValid = false;
     }

     // Prevent form submission if there are validation errors
     if (!isValid) {
         event.preventDefault();
     }
 });

 // Function to display an error message
 function displayErrorMessage(elementId, message) {
     const errorElement = document.getElementById(elementId);
     errorElement.textContent = message;
     errorElement.style.display = "block";
 }

 // Function to clear all error messages
 function clearErrorMessages() {
     const errorMessages = document.querySelectorAll(".error-message");
     errorMessages.forEach((errorElement) => {
         errorElement.textContent = "";
         errorElement.style.display = "none";
     });
 }