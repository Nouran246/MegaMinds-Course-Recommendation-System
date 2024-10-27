<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Courses</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
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
      </ul>
      <hr />
      <form action="/logout" method="POST">
        <button type="submit" class="btn btn-danger btn-block">Logout</button>
      </form>
    </div>
    

    <div id="content" class="content container mt-5">
      <div class="row mb-4">
        <div class="col">
          <h1>Manage Courses</h1>
        </div>
        <div class="col text-right">
          <button
            class="btn btn-success"
            data-bs-toggle="modal"
            data-bs-target="#addBlogModal"
          >
            Add New Course
          </button>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col">
          <input
            type="text"
            id="search-bar"
            class="form-control"
            placeholder="Search by title or author..."
          />
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
              <th>Operation</th>
            </tr>
          </thead>
          <tbody id="blog-table-body">
            <!-- Example of a blog entry -->
            <tr>
              <td>1</td>
              <td>cloud</td>
              <td>Short description...</td>
              <td>beginner</td>
              <td>Mon Oct 02 2024</td>
              <td>Mon Nov 02 2024</td>
              <td>1</td>
              <td>$40</td>
              <td>ai</td>

              <td>
                <div class="btn-group" role="group">
                  <a
                    href="#"
                    class="btn btn-outline-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editBlogModal"
                    >Edit</a
                  >
                  <form
                    action="/admin/blogs/delete/1"
                    method="POST"
                    class="d-inline"
                  >
                    <button
                      type="submit"
                      class="btn btn-outline-danger btn-sm"
                    >
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
    <div
      class="modal fade"
      id="addBlogModal"
      tabindex="-1"
      aria-labelledby="addBlogModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/admin/blogs/add" method="POST" enctype="multipart/form-data" id="add-blog-form">
            <div class="modal-header">
              <h5 class="modal-title" id="addBlogModalLabel">Add New Blog</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="blog-title"
                  name="title"
                />
                <div id="title-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input
                  type="text"
                  class="form-control"
                  id="blog-author"
                  name="author"
                />
                <div id="author-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="brief" class="form-label">Brief</label>
                <textarea
                  class="form-control"
                  id="blog-brief"
                  name="brief"
                  rows="2"
                ></textarea>
                <div id="brief-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea
                  class="form-control"
                  id="blog-content"
                  name="content"
                  rows="5"
                ></textarea>
                <div id="content-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input
                  type="file"
                  class="form-control"
                  id="blog-image"
                  name="image"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Blog</button>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  

    <script>
      document.getElementById("toggleSidebar").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("active");
        document.querySelector(".content").classList.toggle("active");
      });
    </script>
  </body>
</html>
