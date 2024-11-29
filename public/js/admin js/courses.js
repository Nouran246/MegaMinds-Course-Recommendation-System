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
    const courseId = $(this).data('course-id');
    const courseName = $(this).data('course-name');
    const description = $(this).data('description');
    const level = $(this).data('level');
    const startDate = $(this).data('start-date');
    const endDate = $(this).data('end-date');
    const rating = $(this).data('rating');
    const fees = $(this).data('fees');
    const tags = $(this).data('tags');

    // Set values in the modal form fields
    $('#editCourseId').val(courseId);
    $('#editCourseName').val(courseName);
    $('#editDescription').val(description);
    $('#editLevel').val(level);
    $('#editStartDate').val(startDate);
    $('#editEndDate').val(endDate);
    $('#editRating').val(rating);
    $('#editFees').val(fees);
    $('#editTags').val(tags);

    // Show the modal
    $('#editCourseModal').modal('show');
});

// Handle form submission for editing course
$('#editCourseForm').on('submit', function (e) {
    e.preventDefault();

    // Clear previous error messages
    $('#courseNameError, #levelError, #startDateError, #endDateError, #ratingError, #feesError, #tagsError').hide();

    // Get values from input fields
    const courseName = $('#editCourseName').val().trim();
    const description = $('#editDescription').val().trim();
    const level = $('#editLevel').val().trim();
    const startDate = $('#editStartDate').val().trim();
    const endDate = $('#editEndDate').val().trim();
    const rating = $('#editRating').val().trim();
    const fees = $('#editFees').val().trim();
    const tags = $('#editTags').val().trim();

    let isValid = true;

    // Validate course name
    if (courseName === '') {
        $('#courseNameError').show();
        isValid = false;
    }

    // Validate level
    if (level === '') {
        $('#levelError').show();
        isValid = false;
    }

    // Validate start date
    if (startDate === '') {
        $('#startDateError').show();
        isValid = false;
    }

    // Validate end date
    if (endDate === '') {
        $('#endDateError').show();
        isValid = false;
    }

    // Validate rating
    if (rating === '') {
        $('#ratingError').show();
        isValid = false;
    }

    // Validate fees
    if (fees === '') {
        $('#feesError').show();
        isValid = false;
    }

    // Validate tags
    if (tags === '') {
        $('#tagsError').show();
        isValid = false;
    }

    // If valid, proceed with AJAX call
    if (isValid) {
        $.ajax({
            url: '../../Controllers/editCourse.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $('#editCourseModal').modal('hide');
                    location.reload();
                } else {
                    // Handle errors from server response
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