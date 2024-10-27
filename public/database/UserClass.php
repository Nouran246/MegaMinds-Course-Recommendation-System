<?php

include_once "../../public/includes/DB.php";
class User {
  public $ID ;
  public $FName;
  public $LName;
  public  $Email;
  public $Password;
  public $role;

    // Constructor to initialize the database connection
    public function __construct() {
        if ($ID !=""){
			$sql="select * from users where 	ID=$ID";
			$User = mysqli_query($GLOBALS['con'],$sql);
			if ($row = mysqli_fetch_array($User)){
                $this->ID=$row["ID"];
				$this->FName=$row["FName"];
                $this->LName=$row["LName"];
                $this->Email=$row["Email"];
                $this->Password=$row["Password"];
                $this->role = $row["role"];
				// $this->UserRole_obj=new UserType($row["role"]);
			}
		}
    }

    static function Signup($FName,$LName,$Email,$Password)	{
        $FName = htmlspecialchars($_POST["FName"]);
        $LName = htmlspecialchars($_POST["LName"]);
        $Email = htmlspecialchars($_POST["Email"]);
        $Password = htmlspecialchars($_POST["Password"]);
        $role = 1;
    
         // Check if email already exists
         $checkEmailQuery = "SELECT * FROM users WHERE Email = '$Email'";
         $result=mysqli_query($GLOBALS['conn'],$checkEmailQuery);
     
         if (mysqli_num_rows($result) > 0) {
             // Email already exists, display a message
             echo "<script>alert('Email is already used. Please try a different email.');</script>";
         } else {
        // SQL Query to insert data
        $sql = "INSERT INTO users (FName, LName, Email, Password,role) 
                VALUES ('$FName', '$LName', '$Email', '$Password','$role')";
    
        // Execute query and check result
        if (mysqli_query($GLOBALS['conn'], $sql)) {
            $_SESSION['FName'] = $FName; // Store first name
            $_SESSION['LName'] = $LName; // Store last name
            // Redirect the user after successful insertion
            header("Location: ../../views/Users/Courses.php");
            exit();
        } else {
            // Display the error for debugging
            echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['conn']);
        }
    }
	}

    
    public static function login($Email,$Password){
		 // Get form data and sanitize it
         $Email = htmlspecialchars($_POST["Email"]);
         $Password = htmlspecialchars($_POST["Password"]); // Raw password input
     
         // SQL Query to select the user
         $sql = "SELECT FName, LName, Password, role FROM users WHERE Email = '$Email'";
         $result=mysqli_query($GLOBALS['conn'],$sql);
     
         // Check if user exists
         if ($result && mysqli_num_rows($result) > 0) {
             $user = mysqli_fetch_assoc($result);
     
             // Verify the password
             if ($Password === $user['Password']) {
                 // Store user information in session
                 $_SESSION['FName'] = $user['FName']; // Store first name
                 $_SESSION['LName'] = $user['LName']; // Store last name
                 $_SESSION['role'] = $user['role']; // Store user role
     
                 // Redirect based on user role
                 if ($user['role'] == 1) {
                     header("Location: ../../views/Users/Courses.php");
                 } elseif ($user['role'] == 2) {
                     header("Location: ../../views/Admins/dashboard.php");
                 }
                 exit();
             } else {
                 // Incorrect password, display alert and redirect
                 echo "<script>
                         alert('Incorrect password. Please try again.');
                         window.location.href = '../../views/Users/index.php';
                       </script>";
             }
         } else {
             // Email does not exist in the database, display alert and redirect
             echo "<script>
                     alert('Email does not exist. Please try again to register.');
                     window.location.href = '../../views/Users/index.php';
                   </script>";
         }
	}
    public function editUser($FName, $LName, $Email) {
        $FName = htmlspecialchars($FName);
        $LName = htmlspecialchars($LName);
        $Email = htmlspecialchars($Email);

        // Check if the email is already in use by another user
        $sql = "SELECT COUNT(*) FROM users WHERE Email = :email AND ID != :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $Email, 'id' => $this->ID]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return json_encode(['status' => 'error', 'message' => 'Email already in use.']);
        }

        // Update user information if no duplicate email is found
        $sql = "UPDATE users SET FName = :fname, LName = :lname, Email = :email WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':fname', $FName);
        $stmt->bindParam(':lname', $LName);
        $stmt->bindParam(':email', $Email);
        $stmt->bindParam(':id', $this->ID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->FName = $FName;
            $this->LName = $LName;
            $this->Email = $Email;
            return json_encode(['status' => 'success', 'message' => 'User updated successfully']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Failed to update user']);
        }
    }
    public function deleteUser($userId) {
        $userId = (int)$userId; // Ensure user ID is an integer
        $sql = "DELETE FROM users WHERE ID = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return json_encode(['status' => 'success', 'message' => 'User deleted successfully.']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Error executing the delete statement.']);
        }
    }
     
//     // Method to get a user by ID
//     public function getUserById($id) {
//         $sql = "SELECT * FROM users WHERE ID = :id";
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//         $stmt->execute();
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }

//     // Method to update a user by ID
//     public function updateUser($id, $firstName, $lastName, $email, $password = null, $role = 1) {
//         $sql = "UPDATE users SET FName = :firstName, LName = :lastName, Email = :email, role = :role";
//         if ($password) {
//             $sql .= ", Password = :password";
//         }
//         $sql .= " WHERE ID = :id";
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->bindParam(':firstName', $firstName);
//         $stmt->bindParam(':lastName', $lastName);
//         $stmt->bindParam(':email', $email);
//         $stmt->bindParam(':role', $role);
//         if ($password) {
//             $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Encrypt password
//         }
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//         return $stmt->execute();
//     }

//     // Method to delete a user by ID
//     public function deleteUser($id) {
//         $sql = "DELETE FROM users WHERE ID = :id";
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//         return $stmt->execute();
//     }

//     // Method to get all users
//     public function getAllUsers() {
//         $sql = "SELECT * FROM users";
//         $stmt = $this->pdo->query($sql);
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }
// }
}
class UserType {
    public $ID;
    public $UserTypeName;
    public $ArrayOfPages = [];

    function __construct($id) {
        if ($id != "") {
            $sql = "SELECT * FROM usertypes WHERE ID = $id";
            $result = mysqli_query($GLOBALS['con'], $sql);
            if ($row = mysqli_fetch_array($result)) {
                $this->UserTypeName = $row["Name"];
                $this->ID = $row["ID"];
                $this->ArrayOfPages = Pages::getPagesForUserType($this->ID);
            }
        }
    }

    // Static method to retrieve all user types from the database
    static function SelectAllUserTypesInDB() {
        $sql = "SELECT * FROM usertypes";
        $TypeDataSet = mysqli_query($GLOBALS['con'], $sql);
        $Result = [];
        while ($row = mysqli_fetch_array($TypeDataSet)) {
            $MyObj = new UserType($row["ID"]);
            $Result[] = $MyObj;
        }
        return $Result;
    }
}

// Class for managing pages and user permissions
class Pages {
    public $ID;
    public $FriendlyName;
    public $LinkAddress;

    function __construct($id) {
        if ($id != "") {
            $sql = "SELECT * FROM pages WHERE ID = $id";
            $result = mysqli_query($GLOBALS['con'], $sql);
            if ($row = mysqli_fetch_array($result)) {
                $this->FriendlyName = $row["FriendlyName"];
                $this->LinkAddress = $row["Linkaddress"];
                $this->ID = $row["ID"];
            }
        }
    }

    // Static method to retrieve all pages from the database
    static function SelectAllPagesInDB() {
        $sql = "SELECT * FROM pages";
        $PageDataSet = mysqli_query($GLOBALS['con'], $sql);
        $Result = [];
        while ($row = mysqli_fetch_array($PageDataSet)) {
            $MyObj = new Pages($row["ID"]);
            $Result[] = $MyObj;
        }
        return $Result;
    }

    // Method to get accessible pages for a specific user type
    static function getPagesForUserType($userTypeId) {
        $pages = [];
        if ($userTypeId == 1) {
            // Role 1: Limited access (only user pages)
            $pages[] = 'Users/Courses.php';
        } elseif ($userTypeId == 2) {
            // Role 2: Full access (admin pages)
            $pages[] = 'Admins/dashboard.php';
            $pages[] = 'Users/Courses.php';
            // Add more admin pages as needed
        }
        return $pages;
    }
}