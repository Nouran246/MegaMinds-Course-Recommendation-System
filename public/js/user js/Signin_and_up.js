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