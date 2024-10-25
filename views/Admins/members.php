<?php
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
    
    // Prepare and execute the query to fetch users
    $stmt = $pdo->prepare("SELECT id, Fname, Lname, Email FROM users");
    $stmt->execute();
    
    // Fetch all users as an associative array
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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
          <h1>Users</h1>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <input type="text" id="search-bar" class="form-control" placeholder="Search by name..." />
        </div>
      </div>
      <div class="table-responsive" style="max-height: 75vh;">
    <table class="table table-bordered table-striped table-hover">
        <thead class="sticky-top bg-light">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['Fname']); ?></td>
                    <td><?php echo htmlspecialchars($user['Lname']); ?></td>
                    <td><?php echo htmlspecialchars($user['Email']); ?></td>
                    <td>
                    <button class="btn btn-warning btn-sm" onclick="editUser(<?php echo $user['id']; ?>)">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

      </div>
      <nav>
        <ul class="pagination justify-content-center" id="pagination-controls"></ul>
      </nav>
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
