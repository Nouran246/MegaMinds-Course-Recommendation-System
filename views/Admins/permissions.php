
 <?php
$con = mysqli_connect("localhost", "root", "", "megaminds");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $userType = $_POST["UserType"];
    $chosenPages = $_POST["choosen-pages"];

    // Delete old associations
    $sqlDelete = "DELETE FROM usertype_pages WHERE usertype_id = $userType";
    mysqli_query($con, $sqlDelete);

    // Insert new associations
    foreach ($chosenPages as $page) {
        $sqlInsert = "INSERT INTO usertype_pages (usertype_id, PageID) VALUES ($userType, $page)";
        mysqli_query($con, $sqlInsert);
    }
}

// Fetch all pages
function fetchAllPages($con) {
    $query = "SELECT * FROM pages";
    $result = mysqli_query($con, $query);
    $pages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pages[] = $row;
    }
    return $pages;
}

// Fetch all user types
function fetchUserTypes($con) {
    $query = "SELECT * FROM usertype";
    $result = mysqli_query($con, $query);
    $userTypes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $userTypes[] = $row;
    }
    return $userTypes;
}

$allPages = fetchAllPages($con);
$userTypes = fetchUserTypes($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pages Assignment </title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../../public/css/admin css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../public/css/admin css/site.css" />
    <link rel="stylesheet" href="../../public/css/admin css/header.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#btnLeft").click(function () {
                $("#leftValues option:selected").appendTo("#rightValues");
            });
            $("#btnRight").click(function () {
                $("#rightValues option:selected").appendTo("#leftValues");
            });
        });
    </script>
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
      <form action="/logout" method="POST">
        <button type="submit" class="btn btn-danger btn-block">Logout</button>
      </form>
    </div>
    

    <div id="content" class="content container mt-5">
      <div class="row mb-4">
        <div class="col">
          <h1>Page Assignment</h1>
        </div>
      </div>
      <form action="" method="post">
            <table class="table">
                <tr>
                    <td>All Pages</td>
                    <td></td>
                    <td>Chosen Pages</td>
                </tr>
                <tr>
                    <td>
                        <select id="leftValues" size="10" multiple style="width: 200px;">
                            <?php foreach ($allPages as $page): ?>
                                <option value="<?= $page['ID'] ?>"><?= $page['FriendlyName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <button type="button" id="btnRight" class="btn btn-secondary"><<</button><br><br>
                        <button type="button" id="btnLeft" class="btn btn-secondary">>></button>
                    </td>
                    <td>
                        <select id="rightValues" name="choosen-pages[]" size="10" multiple style="width: 200px;"></select>
                    </td>
                </tr>
                <tr>
                    <td>Select User Type:</td>
                    <td>
                        <select name="UserType" class="form-control">
                            <?php foreach ($userTypes as $userType): ?>
                                <option value="<?= $userType['ID'] ?>"><?= $userType['UserTypeName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit" name="submit" class="btn btn-primary">Assign Pages</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Add Blog Modal -->
<!--     <div
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
              <h5 class="modal-title" id="addBlogModalLabel">Add New Course</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
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
             <!--    <div id="course_id-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="course_name"
                  name="course_name"
                />
                <div id="course_name-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                  class="form-control"
                  id="description"
                  name="description"
                  rows="2"
                ></textarea>
                <div id="description-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="level" class="form-label">level</label>
                <input
                  type="text"
                  class="form-control"
                  id="level"
                  name="level"
                />
                <div id="level-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input
                  type="text"
                  class="form-control"
                  id="start_date"
                  name="start_date"
                />
                <div id="start_date-error" class="invalid-feedback"></div>
              </div><div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input
                  type="text"
                  class="form-control"
                  id="end_date"
                  name="end_date"
                />
                <div id="end_date-error" class="invalid-feedback"></div>
              </div><div class="mb-3">
                <label for="rate" class="form-label">Rating</label>
                <input
                  type="text"
                  class="form-control"
                  id="rate"
                  name="rate"
                />
                <div id="rate-error" class="invalid-feedback"></div>
              </div>
              <div class="mb-3">
                <label for="fees" class="form-label">Fees</label>
                <input
                  type="text"
                  class="form-control"
                  id="fees"
                  name="fees"
                />
                <div id="fees-error" class="invalid-feedback"></div>
              </div><div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input
                  type="text"
                  class="form-control"
                  id="tags"
                  name="tags"
                />
                <div id="tags-error" class="invalid-feedback"></div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Course</button>
            </div>
          </form>
        </div>
      </div>
    </div>  -->

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
