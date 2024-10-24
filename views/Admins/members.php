<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users</title>
    
    <link rel="stylesheet" href="../../public/css/admin css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../public/css/admin css/site.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/bs-brain@2.0.4/components/error-404s/error-404-1/assets/css/error-404-1.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <style>
      .admin-title {
        font-size: 2rem;
        font-weight: bold;
      }
      body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        height: 100vh;
        display: flex;
        flex-direction: column;
      }
      .content {
        margin-left: 270px;
        padding: 1rem;
        width: calc(100% - 250px);
        transition: margin-left 0.3s ease, width 0.3s ease;
      }
      .btn-group .btn {
        margin-right: 5px;
      }
      .btn-group .btn:last-child {
        margin-right: 0;
      }
      .sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        background-color: #f8f9fa;
        border-right: 1px solid #dee2e6;
        padding: 1rem;
        transition: transform 0.3s ease;
        z-index: 1000;
      }
      .sidebar .nav-link {
        color: #333;
        margin-bottom: 10px;
      }
      .sidebar .nav-link.active {
        background-color: #007bff;
        color: white;
        border-radius: 5px;
      }
      .toggle-btn {
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 1100;
        display: none;
      }
      @media (max-width: 768px) {
        .sidebar {
          transform: translateX(-100%);
        }
        .sidebar.active {
          transform: translateX(0);
        }
        .content {
          margin-left: 0;
          width: 100%;
        }
        .content.active {
          margin-left: 250px;
          width: calc(100% - 250px);
        }
        .toggle-btn {
          display: block;
        }
      }
    </style>
  </head>

  <body>
    <button class="btn btn-primary toggle-btn" id="toggleSidebar">
      Toggle Sidebar
    </button>
    <div class="sidebar d-flex flex-column p-3 bg-light" id="sidebar">
      <a href="/" class="d-flex align-items-center mb-3 text-decoration-none">
        <span class="fs-4 admin-title">MegaMinds Admin</span>
      </a>
      <hr />
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="#" class="nav-link <%= title === 'Home' ? 'active' : '' %>">
            Home
          </a>
        </li>
        <li>
          <a href="dashboard.php" class="nav-link <%= title === 'Dashboard' ? 'active' : '' %>">
            Dashboard
          </a>
        </li>
        <li>
          <a href="members.php" class="nav-link <%= title === 'Members' ? 'active' : '' %>">
            Members
          </a>
        </li>
        <li>
          <a href="blogs.php" class="nav-link <%= title === 'Blogs' ? 'active' : '' %>">
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
          <h1>Users</h1>
        </div>
        <div class="col text-right">
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMemberModal">
            Add Member
          </button>
          <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
            Filter
          </button>
          <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#sortModal">
            Sort
          </button>
          <button class="btn btn-primary" id="export-btn">Export to Excel</button>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <input type="text" id="search-bar" class="form-control" placeholder="Search by name..." />
        </div>
      </div>
      <div class="table-responsive" style="max-height: 75vh">
        <table class="table table-bordered table-striped table-hover">
          <thead class="sticky-top bg-light">
            <tr>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email</th>
              <th>Password</th>
              <th>Address</th>
              <th>Department</th>

            </tr>
          </thead>
          <tbody id="member-table-body"></tbody>
        </table>
      </div>
      <nav>
        <ul class="pagination justify-content-center" id="pagination-controls"></ul>
      </nav>
    </div>

    <!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addMemberModalLabel">Add Member</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-member-form" action="/admin/addMember" method="post" class="user-form">
          <!-- Form fields -->
          <!-- Name -->
          <div class="mb-3">
            <label for="add-user-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="add-user-name" placeholder="Enter name" name="userName" />
            <div id="add-name-error" class="invalid-feedback"></div>
          </div>
          <!-- Phone Number -->
          <div class="mb-3">
            <label for="add-user-phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="add-user-phone" placeholder="Enter phone number" name="userPhone" />
            <div id="add-phone-error" class="invalid-feedback"></div>
          </div>
          <!-- University ID -->
          <div class="mb-3">
            <label for="add-user-universityId" class="form-label">University ID</label>
            <input type="text" class="form-control" id="add-user-universityId" placeholder="Enter university ID" name="userUniversityId" />
            <div id="add-universityId-error" class="invalid-feedback"></div>
          </div>
          <!-- Department -->
          <div class="mb-3">
            <label for="add-user-department" class="form-label">Department</label>
            <select class="form-control" id="add-user-department" name="userDepartment">
              <option value="Information Technology">Information Technology</option>
              <option value="Human Resources">Human Resources</option>
              <option value="Public Relations">Public Relations</option>
              <option value="Media">Media</option>
              <option value="Coordination">Coordination</option>
              <option value="Technical Coaching">Technical Coaching</option>
            </select>
            <div id="add-department-error" class="invalid-feedback"></div>
          </div>
          <!-- Year -->
          <div class="mb-3">
            <label for="add-user-year" class="form-label">Year</label>
            <select class="form-control" id="add-user-year" name="userYear">
              <option value="24/25">24/25</option>
              <option value="25/26">25/26</option>
              <option value="26/27">26/27</option>
              <option value="27/28">27/28</option>
            </select>
            <div id="add-year-error" class="invalid-feedback"></div>
          </div>
          <!-- Board Member -->
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="add-user-boardMember" name="isBoardMember" />
            <label class="form-check-label" for="add-user-boardMember">Board Member</label>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Member</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteConfirmationLabel">Confirm Deletion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filterModalLabel">Filter Members</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Filter form content -->
      </div>
    </div>
  </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../public/js/admin js/memberManagement.js"></script>
    <script src="../../public/js/admin js/addMember.js"></script>
    <script src="../../public/js/admin js/deleteMember.js"></script>
    <script>
      document.getElementById("toggleSidebar").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("active");
        document.querySelector(".content").classList.toggle("active");
      });
    </script>
  </body>
</html>
