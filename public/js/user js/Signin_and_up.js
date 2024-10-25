// Get modal elements
var signUpModal = document.getElementById("signUpModal");
var closeSignUp = signUpModal.getElementsByClassName("close")[0];

// Function to show the sign-up modal
function showSignUpModal() {
    signUpModal.style.display = "flex";
}

// Get the "Join Us Now!" button
var joinButton = document.getElementById("join");

// When the user clicks on the "Join Us Now!" button, show the sign-up modal
joinButton.onclick = function() {
    showSignUpModal();
}

// Close the sign-up modal when the user clicks on the close (x)
closeSignUp.onclick = function() {
    signUpModal.style.display = "none";
    window.location.href = 'index.php'; // Redirect to homepage
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == signUpModal) {
        signUpModal.style.display = "none";
    }
}

// Function to toggle password visibility
function togglePassword() {
    const passwordInputs = [document.getElementById("Password"), document.getElementById("ConfirmPassword")];
    passwordInputs.forEach(input => {
        input.type = input.type === "password" ? "text" : "password";
    });
}


    
    const form = document.querySelector("#signupModal"); // Correct form selector

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

