<?php
// App\views\Admins\courses.php
// Database connection settings
$host = 'localhost'; // Replace with your database host
$dbname = 'megaminds'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
  // Create a new PDO instance for database connection
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  // Set PDO error mode to exception for better error handling
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare and execute the query to fetch courses
  $stmt = $pdo->prepare("SELECT course_ID, course_name, description, level, start_date, end_date, rating, fees, tags, image FROM courses");
  $stmt->execute();

  // Fetch all courses as an associative array
  $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  // Handle database connection errors
  die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Courses</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../public/css/admin css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../public/css/admin css/site.css" />
  <link rel="stylesheet" href="../../../public/css/admin css/header.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

</head>

<body>
  <!-- Header -->

  <button class="btn btn-primary toggle-btn" id="toggleSidebar">
    Toggle Sidebar
  </button>
  <div class="sidebar d-flex flex-column p-3 bg-light" id="sidebar">
    <a href="/" class="d-flex align-items-center mb-3 text-decoration-none">
      <span class="fs-4 admin-title">MegaMinds Admin</span>
    </a>
    <hr />
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="members.php" class="nav-link <%= title === 'Members' ? 'active' : '' %>">
          Members
        </a>
      </li>
      <li>
        <a href="courses.php" class="nav-link <%= title === 'Blogs' ? 'active' : '' %>">
          Courses
        </a>
      </li>
      <li>
        <a href="permissions.php" class="nav-link <%= title === 'Blogs' ? 'active' : '' %>">
          Page Assignment
        </a>
      </li>
    </ul>
    <hr />
    <form action="../../Controllers/signout.php?action=signout" method="POST">
      <button type="submit" class="btn btn-danger btn-block">Logout</button>
    </form>
  </div>


  <div id="content" class="content container mt-5">
    <div class="row mb-4">
      <div class="col">
        <h1>Manage Courses</h1>
      </div>
      <div class="col text-right">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBlogModal">
          Add New Course
        </button>
      </div>
    </div>

    <div class="table-responsive" style="max-height: 75vh">
      <table class="table table-bordered table-striped table-hover">
        <thead class="sticky-top bg-light">
          <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>level</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Rating</th>
            <th>Fees</th>
            <th>Tags</th>
            <th>Image</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($courses as $course): ?>
            <tr>
              <td><?php echo htmlspecialchars($course['course_ID']); ?></td>
              <td><?php echo htmlspecialchars($course['course_name']); ?></td>
              <td><?php echo htmlspecialchars($course['description']); ?></td>
              <td><?php echo htmlspecialchars($course['level']); ?></td>
              <td><?php echo htmlspecialchars($course['start_date']); ?></td>
              <td><?php echo htmlspecialchars($course['end_date']); ?></td>
              <td><?php echo htmlspecialchars($course['rating']); ?></td>
              <td>$<?php echo htmlspecialchars($course['fees']); ?></td>
              <td><?php echo htmlspecialchars($course['tags']); ?></td>
              <td><?php echo htmlspecialchars($course['image']); ?></td>
              <td>
                <button class="btn btn-warning btn-sm edit-button" data-course-id="<?php echo $course['course_ID']; ?>"
                  data-course-name="<?php echo htmlspecialchars($course['course_name']); ?>"
                  data-description="<?php echo htmlspecialchars($course['description']); ?>"
                  data-level="<?php echo htmlspecialchars($course['level']); ?>"
                  data-start-date="<?php echo htmlspecialchars($course['start_date']); ?>"
                  data-end-date="<?php echo htmlspecialchars($course['end_date']); ?>"
                  data-rating="<?php echo htmlspecialchars($course['rating']); ?>"
                  data-fees="<?php echo htmlspecialchars($course['fees']); ?>"
                  data-tags="<?php echo htmlspecialchars($course['tags']); ?>"
                  data-image="<?php echo htmlspecialchars($course['image']); ?>">Edit</button>
                <button class="btn btn-danger btn-sm delete-button"
                  data-id="<?php echo $course['course_ID']; ?>">Delete</button>

              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>

    <nav>
      <ul class="pagination justify-content-center" id="pagination-controls"></ul>
    </nav>
  </div>

  <!-- Add course Modal -->
  <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../../Controllers/addcourse.php" method="POST" enctype="multipart/form-data" id="add-blog-form">
        <div class="modal-header">
          <h5 class="modal-title" id="addBlogModalLabel">Add New Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" required />
            <div id="course_name-error" class="invalid-feedback">Course name is required.</div>
            <label id="erroraddname" class="form-label"></label>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
            <div id="description-error" class="invalid-feedback">Description is required.</div>
          </div>

          <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select class="form-control" id="level" name="level" required>
              <option value="" selected disabled>Select a level</option>
              <option value="beginner">Beginner</option>
              <option value="intermediate">Intermediate</option>
              <option value="advanced">Advanced</option>
            </select>
            <div id="level-error" class="invalid-feedback">Please select a level.</div>
          </div>

          <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required />
            <div id="start_date-error" class="invalid-feedback">Start date is required.</div>
          </div>

          <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required />
            <div id="end_date-error" class="invalid-feedback">End date is required.</div>
          </div>

          <div class="mb-3">
            <label for="rate" class="form-label">Rating</label>
            <select class="form-control" id="rate" name="rate" required>
              <option value="0" selected disabled>Select a rating</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <div id="rate-error" class="invalid-feedback">Please select a rating.</div>
          </div>

          <div class="mb-3">
            <label for="fees" class="form-label">Fees</label>
            <input type="text" class="form-control" id="fees" name="fees" required />
            <div id="fees-error" class="invalid-feedback">Fees must be provided.</div>
          </div>

          <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" required />
            <div id="tags-error" class="invalid-feedback">Tags are required.</div>
          </div>
          
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required />
            <div id="image-error" class="invalid-feedback">Image is required.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Course</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- Edit course -->
  <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editCourseForm">
          <div class="modal-body">
            <input type="hidden" id="editCourseId" name="course_ID" />
            <div class="mb-3">
              <label for="editCourseName" class="form-label">Course Name</label>
              <input type="text" class="form-control" id="editCourseName" name="course_name" required />
              <label id="errorname" class="form-label"></label>
            </div>
            <div class="mb-3">
              <label for="editDescription" class="form-label">Description</label>
              <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="editLevel" class="form-label">Level</label>
              <input type="text" class="form-control" id="editLevel" name="level" />
            </div>
            <div class="mb-3">
              <label for="editStartDate" class="form-label">Start Date</label>
              <input type="date" class="form-control" id="editStartDate" name="start_date" />
            </div>
            <div class="mb-3">
              <label for="editEndDate" class="form-label">End Date</label>
              <input type="date" class="form-control" id="editEndDate" name="end_date" />
            </div>
            <div class="mb-3">
              <label for="editRating" class="form-label">Rating</label>
              <input type="number" class="form-control" id="editRating" name="rating" step="0.1" />
            </div>
            <div class="mb-3">
              <label for="editFees" class="form-label">Fees</label>
              <input type="number" class="form-control" id="editFees" name="fees" />
            </div>
            <div class="mb-3">
              <label for="editTags" class="form-label">Tags</label>
              <input type="text" class="form-control" id="editTags" name="tags" />
            </div>
            <div class="mb-3">
              <label for="editImage" class="form-label">Image</label>
              <input type="file" class="form-control" id="editImage" name="image" accept="image/*" required />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this course?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../../public/js/admin js/courses.js"></script>

  <!--  Footer -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>


  <script>
    document.getElementById("toggleSidebar").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("active");
      document.querySelector(".content").classList.toggle("active");
    });

  </script> -->
</body>

</html>


