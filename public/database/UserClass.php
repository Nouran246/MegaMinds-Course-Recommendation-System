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

    // // Method to create a new user
    // public function createUser($firstName, $lastName, $email, $password, $role = 1) {
    //     $sql = "INSERT INTO users (FName, LName, Email, Password, role) VALUES (:firstName, :lastName, :email, :password, :role)";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindParam(':firstName', $firstName);
    //     $stmt->bindParam(':lastName', $lastName);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Encrypt password
    //     $stmt->bindParam(':role', $role);
    //     return $stmt->execute();
    // }

    
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
class UserType{
    // 3lshan el pages el mo3ayana el hatetfete7 (permissions)
}
?>
