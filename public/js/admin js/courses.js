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
            url: '../../Controllers/editcourse.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
              if (response.status === 'success') {
                $('#editCourseModal').modal('hide');
                location.reload();
            } else if (response.status === 'error' && response.message === 'Course name already in use.') {
              // Display the error message in the label
              console.log("why");
              $('#errorname').text(response.message)
                  .show()            // Ensure the label is visible
                  .css('color', 'red'); // Change the text color to red
          }
           else {
                // Handle other errors from server response
                alert(response.message);
            }
            },
            error: function () {
                alert('Error updating course');
            }
        });
    }
});

// add course 
 document.getElementById("add-blog-form").addEventListener("submit", function (event) {
    let isValid = true;
  
    const courseName = document.getElementById("course_name");
    const description = document.getElementById("description");
    const level = document.getElementById("level");
    const startDate = document.getElementById("start_date");
    const endDate = document.getElementById("end_date");
    const rate = document.getElementById("rate");
    const fees = document.getElementById("fees");
    const tags = document.getElementById("tags");
  
    // Validate Course Name
    if (courseName.value.trim() === "") {
      isValid = false;
      courseName.classList.add("is-invalid");
    } else {
      courseName.classList.remove("is-invalid");
    }
  
    // Validate Description
    if (description.value.trim() === "") {
      isValid = false;
      description.classList.add("is-invalid");
    } else {
      description.classList.remove("is-invalid");
    }
  
    // Validate Level
    if (level.value === "") {
      isValid = false;
      level.classList.add("is-invalid");
    } else {
      level.classList.remove("is-invalid");
    }
  
    // Validate Start Date
    if (startDate.value === "") {
      isValid = false;
      startDate.classList.add("is-invalid");
    } else {
      startDate.classList.remove("is-invalid");
    }
  
    // Validate End Date
    if (endDate.value === "" || new Date(endDate.value) < new Date(startDate.value)) {
      isValid = false;
      endDate.classList.add("is-invalid");
    } else {
      endDate.classList.remove("is-invalid");
    }
  
    // Validate Rate
    if (rate.value === "0") {
      isValid = false;
      rate.classList.add("is-invalid");
    } else {
      rate.classList.remove("is-invalid");
    }
  
    // Validate Fees
    if (fees.value.trim() === "" || isNaN(fees.value) || Number(fees.value) < 0) {
      isValid = false;
      fees.classList.add("is-invalid");
    } else {
      fees.classList.remove("is-invalid");
    }
  
    // Validate Tags
    if (tags.value.trim() === "") {
      isValid = false;
      tags.classList.add("is-invalid");
    } else {
      tags.classList.remove("is-invalid");
    }
  
    // Prevent form submission if invalid
    if (!isValid) {
      event.preventDefault();
    }
  });
  
});