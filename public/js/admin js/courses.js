$(document).ready(function () {
    let courseIdToDelete = null;

    // Show delete modal and store course ID when delete button is clicked
    $('.delete-button').on('click', function () {
        courseIdToDelete = $(this).data('id');
        
        $('#deleteConfirmationModal').modal('show');
        console.log('Course ID to delete:', courseIdToDelete); // Debugging line
    });
    // Handle delete confirmation in modal
    $('#confirmDelete').on('click', function () {
        console.log('heloooooo22222222222'); 
        if (courseIdToDelete) {
            console.log('heloooooo'); 
            $.ajax({
                url: '../../Controllers/deletecourse.php',
                type: 'POST',
                data: { course_ID: courseIdToDelete },
                success: function (response) {
                    console.log(response); // Debugging line
                    $('#deleteConfirmationModal').modal('show');
                    location.reload(); // Reload to reflect changes
                },
                error: function () {
                    alert('Error deleting course');
                }
            });
        }
    });



    // Show edit modal with current course data
$('.edit-button').on('click', function () {
    const course_ID = $(this).data('course-id');
    const course_name = $(this).data('course-name');
    const description = $(this).data('description');
    const level = $(this).data('level');
    const start_date = $(this).data('start-date');
    const end_date = $(this).data('end-date');
    const rating = $(this).data('rating');
    const fees = $(this).data('fees');
    const tags = $(this).data('tags');

    // Set the values of the modal form fields to the course data
    $('#editCourseId').val(course_ID);
    $('#editCourseName').val(course_name);
    $('#editDescription').val(description);
    $('#editLevel').val(level);
    $('#editStartDate').val(start_date);
    $('#editEndDate').val(end_date);
    $('#editRating').val(rating);
    $('#editFees').val(fees);
    $('#editTags').val(tags);

    // Show the modal
    $('#editModal').modal('show');
});

// Handle form submission for editing course
$('#editForm').on('submit', function (e) {
    e.preventDefault();

    // Clear previous error messages
    $('#courseNameError, #descriptionError, #levelError, #startDateError, #endDateError, #ratingError, #feesError, #tagsError').hide();

    // Get values from input fields
    const course_name = $('#editCourseName').val().trim();
    const description = $('#editDescription').val().trim();
    const level = $('#editLevel').val().trim();
    const start_date = $('#editStartDate').val().trim();
    const end_date = $('#editEndDate').val().trim();
    const rating = $('#editRating').val().trim();
    const fees = $('#editFees').val().trim();
    const tags = $('#editTags').val().trim();
    let isValid = true;

    // Validate course name
    if (course_name === '') {
        $('#courseNameError').show();
        isValid = false;
    }

    // Validate description
    if (description === '') {
        $('#descriptionError').show();
        isValid = false;
    }

    // Validate level
    if (level === '') {
        $('#levelError').show();
        isValid = false;
    }

    // Validate start date
    if (start_date === '') {
        $('#startDateError').show();
        isValid = false;
    }

    // Validate end date
    if (end_date === '') {
        $('#endDateError').show();
        isValid = false;
    }

    // Validate rating (numeric check)
    if (rating === '' || isNaN(rating) || rating < 1 || rating > 5) {
        $('#ratingError').text('Please enter a valid rating between 1 and 5.').show();
        isValid = false;
    }

    // Validate fees (numeric check)
    if (fees === '' || isNaN(fees)) {
        $('#feesError').text('Please enter a valid fee amount.').show();
        isValid = false;
    }

    // Validate tags (optional check)
    if (tags === '') {
        $('#tagsError').show();
        isValid = false;
    }

    // If valid, proceed with AJAX call
    if (isValid) {
        $.ajax({
            url: '../../Controllers/editCourse.php', // Update the URL to your controller for editing course
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $('#editModal').modal('hide');
                    location.reload();
                } else {
                    // Display custom error message if any
                    alert(response.message);
                }
            },
            error: function () {
                alert('Error updating course');
            }
        });
    }
});
});