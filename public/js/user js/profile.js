/* public/js/profile.js */


/* triggering edit btn + img input + validation for file type and uploading the img (changing src img) */
document.getElementById('edit-img-btn').onclick = () => document.getElementById('profileImage').click();
document.getElementById('profileImage').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    // Check if file is an image
    if (file && file.type.startsWith('image/')) {
        reader.onload = function (e) {
            document.getElementById('profile-img').src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        const errorMessage = document.getElementById('error-image-message');
        errorMessage.textContent = 'Invalid file type (PNG,JPEG,JPG)';
        errorMessage.style.display = 'block';
        setTimeout(function () {
            errorMessage.style.display = 'none';
        }, 4000);
    }

});

/* save changed info + reset recenlty added info */

const initialValues = {
    name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    phoneCode: document.getElementById('phoneCode').value,
    phone: document.getElementById('phone').value,
    university: document.getElementById('university').value,
    degreeProgram: document.getElementById('degreeProgram').value,
    major: document.getElementById('major').value,
    location: document.getElementById('location').value,
    labelName: document.getElementById('label-name').innerText
};

document.getElementById('resetChanges').addEventListener('click', () => {
    document.getElementById('name').value = initialValues.name;
    document.getElementById('email').value = initialValues.email;
    document.getElementById('phoneCode').value = initialValues.phoneCode;
    document.getElementById('phone').value = initialValues.phone;
    document.getElementById('university').value = initialValues.university;
    document.getElementById('degreeProgram').value = initialValues.degreeProgram;
    document.getElementById('major').value = initialValues.major;
    document.getElementById('location').value = initialValues.location;
});
document.getElementById('saveChanges').addEventListener('click', () => {
    initialValues.name = document.getElementById('name').value;
    document.getElementById('label-name').innerText = initialValues.name;
    initialValues.email = document.getElementById('email').value;
    initialValues.phoneCode = document.getElementById('phoneCode').value;
    initialValues.phone = document.getElementById('phone').value;
    initialValues.university = document.getElementById('university').value;
    initialValues.degreeProgram = document.getElementById('degreeProgram').value;
    initialValues.major = document.getElementById('major').value;
    initialValues.location = document.getElementById('location').value;
});

function validateForm() {
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;

    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    let phonePattern = /^\d{10}$/;

    let emailErrorMessage = document.getElementById('error-email-message');
    let phoneErrorMessage = document.getElementById('error-phone-message');

    // Email validation
    if (!emailPattern.test(email)) {
        emailErrorMessage.textContent = 'Invalid email (e.g. name@domain.com)';
        emailErrorMessage.style.display = 'block';
        setTimeout(function () {
            emailErrorMessage.style.display = 'none';
        }, 4000);
    } else {
        emailErrorMessage.style.display = 'none';
    }

    // Phone number validation
    if (!phonePattern.test(phone)) {
        phoneErrorMessage.textContent = 'Invalid phone number (e.g. 123 456 7890)';
        phoneErrorMessage.style.display = 'block';
        setTimeout(function () {
            phoneErrorMessage.style.display = 'none';
        }, 4000);
    } else {
        phoneErrorMessage.style.display = 'none';
    }

}

// Attach the validation to the "Save Changes" button
document.getElementById('saveChanges').addEventListener('click', function (event) {
    event.preventDefault();  // Prevent the form from submitting
    validateForm();
});


/* Tab Switching*/

document.addEventListener('DOMContentLoaded', function () {
    var hash = window.location.hash;
    if (hash) {
        var tab = new bootstrap.Tab(document.querySelector(hash));
        tab.show();
    }
});

// Enable tab switching and update the URL when tabs are clicked
document.querySelectorAll('#myTab a').forEach(function (tab) {
    tab.addEventListener('click', function (e) {
        e.preventDefault();
        var activeTab = new bootstrap.Tab(this);
        activeTab.show();
        window.location.hash = this.getAttribute('href');  // Update the URL hash
    });
});
