// Get the "Join Us Now!" button
var joinButton = document.getElementById("join");

// When the user clicks on the "Join Us Now!" button, show the sign-up modal
joinButton.onclick = function() {
    showSignUpModal();  // This will show the Sign-up form
}
// Get modal elements
var loginModal = document.getElementById("loginModal");
var signUpModal = document.getElementById("signUpModal");

// Get the buttons/links that open the modals
var openLoginModal = document.getElementById("openLoginModal");
var openSignUpModal = document.getElementById("openSignUpModal");
var openLoginModalFromSignUp = document.getElementById("openLoginModalFromSignUp");

// Get the "Join Us Now!" button
var joinButton = document.getElementById("join");

// Get the <span> elements that close the modals
var closeLogin = loginModal.getElementsByClassName("close")[0];
var closeSignUp = signUpModal.getElementsByClassName("close")[0];

// Function to show the login modal and hide the sign-up modal
function showLoginModal() {
    loginModal.style.display = "flex";
    signUpModal.style.display = "none";
}

// Function to show the sign-up modal and hide the login modal
function showSignUpModal() {
    signUpModal.style.display = "flex";
    loginModal.style.display = "none";
}

// When the user clicks on the "Sign in" link, show the login modal
openLoginModal.onclick = function() {
    showLoginModal();
}

// When the user clicks on the "Sign up" link, show the sign-up modal
openSignUpModal.onclick = function() {
    showSignUpModal();
}

// When the user clicks on "Sign in" from the sign-up modal, switch back to the login modal
openLoginModalFromSignUp.onclick = function() {
    showLoginModal();
}

// When the user clicks on the "Join Us Now!" button, show the sign-up modal
joinButton.onclick = function() {
    showSignUpModal();
}

window.onload = function() {
    loginModal.style.display = "none";
    signUpModal.style.display = "none";
}
// Optional: close modals when clicking the close buttons
closeLogin.onclick = function() {
    loginModal.style.display = "none";
}

closeSignUp.onclick = function() {
    signUpModal.style.display = "none";
}

// Optional: close modals when clicking outside the modal
window.onclick = function(event) {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == signUpModal) {
        signUpModal.style.display = "none";
    }
}
// Close login modal when the user clicks on the close (x)
closeLogin.onclick = function() {
    loginModal.style.display = "none";
}

// Close sign-up modal when the user clicks on the close (x)
closeSignUp.onclick = function() {
    signUpModal.style.display = "none";
}

// Close modals if the user clicks outside of them
window.onclick = function(event) {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == signUpModal) {
        signUpModal.style.display = "none";
    }
}

// Function to toggle password visibility
function togglePassword(id) {
    var input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}



document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#signUpModal form"); // Use form inside the modal

    form.addEventListener("submit", function (event) {
        // Clear previous error messages
        clearErrorMessages();

        let isValid = true;

        // Validate each field
        if (document.getElementById("FName").value.trim() === "") {
            displayErrorMessage("firstnameError", "First Name is required.");
            isValid = false;
        }
        if (document.getElementById("LName").value.trim() === "") {
            displayErrorMessage("lastnameError", "Last Name is required.");
            isValid = false;
        }

        // Validate email
        const emailInput = document.getElementById("Email");
        const emailValue = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Basic email format

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

        // Validate confirm password
        const confirmPasswordInput = document.getElementById("ConfirmPassword");
        if (confirmPasswordInput.value.trim() === "") {
            displayErrorMessage("confirmPasswordError", "Please confirm your password.");
            isValid = false;
        } else if (passwordInput.value !== confirmPasswordInput.value) {
            displayErrorMessage("confirmPasswordError", "Passwords do not match.");
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
});
