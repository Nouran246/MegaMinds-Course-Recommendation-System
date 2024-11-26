<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Courses</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../public/css/admin css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../public/css/admin css/site.css" />
  <link rel="stylesheet" href="../../public/css/admin css/header.css">
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

    <div class="row mb-4">
      <div class="col">
        <input type="text" id="search-bar" class="form-control" placeholder="Search by title or author..." />
      </div>
    </div>

    <div class="table-responsive" style="max-height: 75vh">
      <table class="table table-bordered table-striped table-hover">
        <thead class="sticky-top bg-light">
          <tr>
            <!-- <th>Course ID</th> -->
            <th>Course Name</th>
            <th>Description</th>
            <th>level</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Rating</th>
            <th>Fees</th>
            <th>Tags</th>
            <th>Operation</th>
          </tr>
        </thead>
        <tbody id="blog-table-body">
          <!-- Example of a blog entry -->
          <tr>
            <!-- <td>1</td> -->
            <td>$course_name</td>
            <td>Short description...</td>
            <td>beginner</td>
            <td>Mon Oct 02 2024</td>
            <td>Mon Nov 02 2024</td>
            <td>1</td>
            <td>$40</td>
            <td>ai</td>

            <td>
              <div class="btn-group" role="group">
                <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                  data-bs-target="#editBlogModal">Edit</a>
                <form action="/admin/blogs/delete/1" method="POST" class="d-inline">
                  <button type="submit" class="btn btn-outline-danger btn-sm">
                    Delete
                  </button>
                </form>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <nav>
      <ul class="pagination justify-content-center" id="pagination-controls"></ul>
    </nav>
  </div>

  <!-- Add Blog Modal -->
  <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../../Controllers/addcourse.php" method="POST" enctype="multipart/form-data" id="add-blog-form">
          <div class="modal-header">
            <h5 class="modal-title" id="addBlogModalLabel">Add New Course</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <!-- <label for="course_id" class="form-label">Course ID</label>
                <input
                  type="text"
                  class="form-control"
                  id="course_id"
                  name="course_id"
                /> -->
              <div id="course_id-error" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="course_name" class="form-label">Course Name</label>
              <input type="text" class="form-control" id="course_name" name="course_name" />
              <div id="course_name-error" class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="2"></textarea>
              <div id="description-error" class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
              <label for="level" class="form-label">Level</label>
              <select class="form-control" id="level" name="level">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
              </select>
              <div id="level-error" class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
              <label for="start_date" class="form-label">Start Date</label>
              <input type="date" class="form-control" id="start_date" name="start_date" />
              <div id="start_date-error" class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
              <label for="end_date" class="form-label">End Date</label>
              <input type="date" class="form-control" id="end_date" name="end_date" />
              <div id="end_date-error" class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
              <label for="rate" class="form-label">Rating</label>
              <select class="form-control" id="rate" name="rate">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
              <div id="rate-error" class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
              <label for="fees" class="form-label">Fees</label>
              <input type="text" class="form-control" id="fees" name="fees" />
              <div id="fees-error" class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
              <label for="tags" class="form-label">Tags</label>
              <input type="text" class="form-control" id="tags" name="tags" />
              <div id="tags-error" class="invalid-feedback"></div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Course</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../../public/js/admin js/blogManagement.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

  <!-- Footer -->
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>


  <script>
    document.getElementById("toggleSidebar").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("active");
      document.querySelector(".content").classList.toggle("active");
    });
  </script>
</body>

</html>