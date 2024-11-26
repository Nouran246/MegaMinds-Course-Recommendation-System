    <!-- public\Controllers\UserClass.php -->
<?php

include_once "../public/includes/DB.php";



class User {
    
    public $ID;
    public $FName;
    public $LName;
    public  $Email;
    public $Password;
    public $role;
    private $conn;
    private $usersTable = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // // Constructor to initialize the database connection
    // public function __construct() {
    //     if ($ID != NULL){
	// 		$sql="select * from users where 	ID=$ID";
	// 		$User = mysqli_query($GLOBALS['con'],$sql);
	// 		if ($row = mysqli_fetch_array($User)){
    //             $this->ID=$row["ID"];
	// 			$this->FName=$row["FName"];
    //             $this->LName=$row["LName"];
    //             $this->Email=$row["Email"];
    //             $this->Password=$row["Password"];
    //             $this->role = $row["role"];
	// 			// $this->UserRole_obj=new UserType($row["role"]);
	// 		}
	// 	}
    // }

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
             echo "<script>alert('Email is already used. Please try a different email.');
              window.location.href = '/MegaMinds-Course-Recommendation-System/views/Users/index.php';</script>";
         } else {
        // SQL Query to insert data
        $sql = "INSERT INTO users (FName, LName, Email, Password) 
                VALUES ('$FName', '$LName', '$Email', '$Password')";
    
        // Execute query and check result
        if (mysqli_query($GLOBALS['conn'], $sql)) {
            $_SESSION['FName'] = $FName; // Store first name
            $_SESSION['LName'] = $LName; // Store last name
            // Redirect the user after successful insertion
            header("Location: /MegaMinds-Course-Recommendation-System/views/Users/Courses.php");
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
         $sql = "SELECT ID, FName, LName, Password, usertype_id FROM users WHERE Email = '$Email'";
         $result=mysqli_query($GLOBALS['conn'],$sql);
     
         // Check if user exists
         if ($result && mysqli_num_rows($result) > 0) {
             $user = mysqli_fetch_assoc($result);
     
             // Verify the password
             if ($Password === $user['Password']) {
                 // Store user information in session
                 $_SESSION['user_id'] = $user['ID'];
                 $_SESSION['FName'] = $user['FName']; // Store first name
                 $_SESSION['LName'] = $user['LName']; // Store last name
                 $_SESSION['role'] = $user['usertype_id']; // Store user role
                 
     
                 // Redirect based on user role
                 if ($user['usertype_id'] == 1) {
                     header("Location: /MegaMinds-Course-Recommendation-System/views/Users/Courses.php");
                 } elseif ($user['usertype_id'] == 2) {
                     header("Location: /MegaMinds-Course-Recommendation-System/views/Admins/members.php");
                 }
                 exit();
             } else {
                 // Incorrect password, display alert and redirect
                 echo "<script>
                         alert('Incorrect password. Please try again.');
                         window.location.href = '/MegaMinds-Course-Recommendation-System/views/Users/index.php';
                       </script>";
             }
         } else {
             // Email does not exist in the database, display alert and redirect
             echo "<script>
                     alert('Email does not exist. Please try again to register.');
                     window.location.href = '/MegaMinds-Course-Recommendation-System/views/Users/index.php';
                   </script>";
         }
	}
    public static function editUser() {
        try {
            // Database connection
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            if (isset($_POST['id']) && isset($_POST['Fname']) && isset($_POST['Lname']) && isset($_POST['Email'])) {
                $id = $_POST['id'];
                $fname = $_POST['Fname'];
                $lname = $_POST['Lname'];
                $email = $_POST['Email'];
        
                // Check if the email already exists for another user
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE Email = :email AND id != :id");
                $stmt->execute(['email' => $email, 'id' => $id]);
                $count = $stmt->fetchColumn();
        
                if ($count > 0) {
                    // Email is already in use by another user
                    echo json_encode(['status' => 'error', 'message' => 'Email already in use.']);
                    exit;
                }
        
                // Proceed to update the user if no duplicate email is found
                $stmt = $pdo->prepare("UPDATE users SET Fname = :fname, Lname = :lname, Email = :email WHERE id = :id");
                $stmt->bindParam(':fname', $fname);
                $stmt->bindParam(':lname', $lname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
            }
        
        } catch (PDOException $e) {
            // Output database connection error
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        } catch (Exception $e) {
            // Output general error
            echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    
    // Delete user profile
    public function deleteProfile($user_id) {
        $sql = "DELETE FROM " . $this->usersTable . " WHERE ID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function deleteUser($userId) {
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
    // Update user profile
    public function updateProfile($user_id, $fname, $lname, $email) {
        $sql = "UPDATE " . $this->usersTable . " SET FName = :fname, LName = :lname, Email = :email" . 
                " WHERE ID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}

class UserType {
	public $ID;
	public $UserTypeName;
	public $ArrayOfPages;
	function __construct($id){
		if ($id !=""){
			$sql="select * from usertypes where ID=$id";
			$result=mysqli_query($GLOBALS['con'],$sql);
			if ($row = mysqli_fetch_array($result))	{
				$this->UserTypeName=$row["Name"];
				$this->ID=$row["ID"];
				$sql="select PageID from UserType_Pages where UserTypeID=$this->ID";
				$result=mysqli_query($GLOBALS['con'],$sql);
				$i=0;
				while($row1=mysqli_fetch_array($result)){
					$this->ArrayOfPages[$i]=new pages($row1[0]);
					$i++;
				}
			}
		}
	}
	
	static function SelectAllUserTypesInDB(){
		$sql="select * from usertypes";
		$TypeDataSet = mysqli_query($GLOBALS['con'],$sql);
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($TypeDataSet))	{
			$MyObj= new UserType($row["ID"]);
			$Result[$i]=$MyObj;
			$i++;
		}
		return $Result;
	}
}

class pages {
	public $ID;
	public $FreindlyName;
	public $Linkaddress;

	function __construct($id){
		if ($id !=""){	
			$sql="select * from pages where ID=$id";
			$result2=mysqli_query($GLOBALS['con'],$sql) ;
			if ($row2 = mysqli_fetch_array($result2)){
				$this->FreindlyName=$row2["FreindlyName"];
				$this->Linkaddress=$row2["Linkaddress"];
				$this->ID=$row2["ID"];
			}
		}
	}
	
	static function SelectAllPagesInDB(){
		$sql="select * from pages";
		$PageDataSet = mysqli_query($GLOBALS['con'],$sql);		
		$i=0;
		$Result;
		while ($row = mysqli_fetch_array($PageDataSet))	{
			$MyObj= new pages($row["ID"]);
			$Result[$i]=$MyObj;
			$i++;
		}
		return $Result;
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
 


?>