$(document).ready(function () {
    let userIdToDelete = null;

    // Show delete modal and store user ID when delete button is clicked
    $('.delete-button').on('click', function () {
        userIdToDelete = $(this).data('id');
        $('#deleteConfirmationModal').modal('show');
    });

    // Handle delete confirmation in modal
    $('#confirmDelete').on('click', function () {
        if (userIdToDelete) {
            $.ajax({
                url: '../../public/database/deleteUser.php',
                type: 'POST',
                data: { id: userIdToDelete },
                success: function (response) {
                    $('#deleteConfirmationModal').modal('hide');
                    location.reload();
                },
                error: function () {
                    alert('Error deleting user');
                }
            });
        }
    });

    // Show edit modal with current user data
    $('.edit-button').on('click', function () {
        const id = $(this).data('id');
        const fname = $(this).data('fname');
        const lname = $(this).data('lname');
        const email = $(this).data('email');

        $('#editUserId').val(id);
        $('#editFname').val(fname);
        $('#editLname').val(lname);
        $('#editEmail').val(email);

        $('#editModal').modal('show');
    });

    // Handle form submission for editing user
    $('#editForm').on('submit', function (e) {
        e.preventDefault();
    
        // Clear previous error messages
        $('#fnameError, #lnameError, #emailError').hide();
    
        // Get values from input fields
        const fname = $('#editFname').val().trim();
        const lname = $('#editLname').val().trim();
        const email = $('#editEmail').val().trim();
        let isValid = true;
    
        // Validate first name
        if (fname === '') {
            $('#fnameError').show();
            isValid = false;
        }
    
        // Validate last name
        if (lname === '') {
            $('#lnameError').show();
            isValid = false;
        }
    
        // Validate email format
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '' || !emailPattern.test(email)) {
            $('#emailError').text('Please enter a valid email address.').show();
            isValid = false;
        }
    
        // If valid, proceed with AJAX call
        if (isValid) {
            $.ajax({
                url: '../../public/database/editUser.php',
                type: 'POST',
                data: { id: $('#editUserId').val(), FName: fname, LName: lname, Email: email }, // Pass user ID too
                success: function (response) {
                    console.log(response);
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message); // Display error message from server
                    }
                },
                error: function () {
                    alert('Error editing user');
                }
            });
        }
    });
    
});
