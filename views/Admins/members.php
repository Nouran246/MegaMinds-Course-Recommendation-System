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
    <link rel="stylesheet" href="../../public/css/admin css/header.css">
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
                            <button class="btn btn-danger btn-sm delete-button" data-id="<?php echo $user['id']; ?>">Delete</button>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this user?
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
    <script>
      $(document).ready(function () {
        let userIdToDelete = null;

        // Show modal and store user ID when delete button is clicked
        $('.delete-button').on('click', function () {
          userIdToDelete = $(this).data('id');
          $('#deleteConfirmationModal').modal('show');
        });

        // Handle delete confirmation in modal
        $('#confirmDelete').on('click', function () {
          if (userIdToDelete) {
            $.ajax({
              url: '../../public/database/deleteUser.php', // Replace with actual delete script path
              type: 'POST',
              data: { id: userIdToDelete },
              success: function (response) {
                alert(response.message || 'User deleted successfully.'); // Show message
                location.reload(); // Reload the page to reflect changes
              },
              error: function () {
                alert('Error deleting user. Please try again.');
              }
            });
            $('#deleteConfirmationModal').modal('hide'); // Hide modal after confirmation
            userIdToDelete = null; // Reset user ID
          }
        });
      });

      function editUser(userId) {
        // Redirect to edit user page (replace with your actual edit URL)
        window.location.href = `editMember.php?id=${userId}`;
      }
    </script>
  </body>
</html>
