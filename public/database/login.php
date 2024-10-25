<?php
   // Start session
   session_start();

   // Include database connection file
   include_once "../../public/includes/DB.php";

   // Check if the request is a POST request and if the required fields are set
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Email"]) && isset($_POST["Password"])) {

       // Retrieve data from the form
       $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
       $Password = $_POST["Password"]; // No need to escape the password, we'll use it to verify

       // Prepare SQL statement to prevent SQL injection
       $sql = "SELECT * FROM users WHERE Email = ?";
       $stmt = mysqli_prepare($conn, $sql);

       if ($stmt) {
           // Bind the email to the statement and execute
           mysqli_stmt_bind_param($stmt, "s", $Email);
           mysqli_stmt_execute($stmt);

           // Get the result
           $result = mysqli_stmt_get_result($stmt);

           // Check if user exists
           if ($row = mysqli_fetch_assoc($result)) {
               // Verify the password
               if (password_verify($Password, $row["Password"])) {
                   // Set session variables
                   $_SESSION["ID"] = $row["ID"];
                   $_SESSION["FName"] = $row["FName"];
                   $_SESSION["LName"] = $row["LName"];
                   $_SESSION["Email"] = $row["Email"];

                   // Redirect to Courses page on successful login
                   header("Location: ./../views/Users/Courses.php?login=success");
                   exit(); // Make sure to exit after redirection
               } else {
                   // Password is incorrect
                   echo "Invalid login credentials.";
               }
           } else {
               // Email not found
               echo "Invalid login credentials.";
           }
       } else {
           // Error with SQL statement
           echo "Error: Could not prepare SQL statement.";
       }

       // Close the statement
       mysqli_stmt_close($stmt);
   } else {
       // If Email or Password is not set, show an error message
       echo "Please enter your email and password.";
   }

   // Close the database connection
   mysqli_close($conn);
?>
