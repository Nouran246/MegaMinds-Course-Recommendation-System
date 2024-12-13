<?php

// include_once "../../../public/includes/DB.php";


// Base User class
class User
{
    public $ID;
    public $FName;
    public $LName;
    public $Email;
    public $Password;
    public $role;

    public function __construct($ID = null, $FName = null, $LName = null, $Email = null, $Password = null, $role = null)
    {
        $this->ID = $ID;
        $this->FName = $FName;
        $this->LName = $LName;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->role = $role;
    }
}

// UserFactory class
class UserFactory
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUserHandler($operation)
    {
        switch ($operation) {
            case 'Signup':
                return new SignupHandler($this->db);
            case 'Login':
                return new LoginHandler($this->db);
            case 'Edit':
                return new EditUserHandler($this->db);
            case 'Delete':
                return new DeleteUserHandler($this->db);
            default:
                throw new Exception("Invalid operation");
        }
    }
}

// Abstract UserHandler class
abstract class UserHandler
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    abstract public function handle($data);
}

// SignupHandler class
class SignupHandler extends UserHandler
{
    public function handle($data)
    {
        $FName = htmlspecialchars($data['FName']);
        $LName = htmlspecialchars($data['LName']);
        $Email = htmlspecialchars($data['Email']);
        $Password = htmlspecialchars($data['Password']);
        $role = 1;

        $checkEmailQuery = "SELECT * FROM users WHERE Email = :email";
        $stmt = $this->db->prepare($checkEmailQuery);
        $stmt->execute(['email' => $Email]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email is already used. Please try a different email.');
              window.location.href = '/MegaMinds-Course-Recommendation-System/App/views/Users/index.php';</script>";
        } else {
            // Secure password hashing
            // $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (FName, LName, Email, Password) VALUES (:fname, :lname, :email, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['fname' => $FName, 'lname' => $LName, 'email' => $Email, 'password' => $Password]);

            // Fetch the newly registered user's details
            $getUserQuery = "SELECT * FROM users WHERE Email = :email";
            $stmt = $this->db->prepare($getUserQuery);
            $stmt->execute(['email' => $Email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Set session variables
                $_SESSION['user_id'] = $user['ID'];
                $_SESSION['FName'] = $user['FName'];
                $_SESSION['LName'] = $user['LName'];
                $_SESSION['role'] = $role; // Assign the user's role

                // Redirect to the user's dashboard
                header("Location: /MegaMinds-Course-Recommendation-System/App/views/Users/Courses.php");
                exit();
            }
        }
    }
}

// LoginHandler class
class LoginHandler extends UserHandler
{
        public  function handle($data)
    {
        // Get form data and sanitize it
        $Email = htmlspecialchars($data["Email"]);
        $Password = htmlspecialchars($data["Password"]); // Raw password input

        // SQL Query to select the user
        $sql = "SELECT ID, FName, LName, Password, usertype_id FROM users WHERE Email = '$Email'";
        $result = mysqli_query($GLOBALS['conn'], $sql);

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
                    header("Location: /MegaMinds-Course-Recommendation-System/App/views/Users/Courses.php");
                } elseif ($user['usertype_id'] == 2) {
                    header("Location: /MegaMinds-Course-Recommendation-System/App/views/Admins/members.php");
                }
                exit();
            } else {
                // Incorrect password, display error message
                echo "<script>
                     alert('Incorrect email or password.');
                     window.location.href = '/MegaMinds-Course-Recommendation-System/App/views/Users/index.php';
                   </script>";
            }
        } else {
            // Email does not exist in the database, display error message
            echo "<script>
                 alert('Incorrect email or password.');
                 window.location.href = '/MegaMinds-Course-Recommendation-System/App/views/Users/index.php';
               </script>";
        }
    }


}

// EditUserHandler class
class EditUserHandler extends UserHandler
{
    public function handle($data)
    {
        $id = $data['id'];
        $fname = $data['FName'];
        $lname = $data['LName'];
        $email = $data['Email'];

        $checkEmailQuery = "SELECT COUNT(*) FROM users WHERE Email = :email AND ID != :id";
        $stmt = $this->db->prepare($checkEmailQuery);
        $stmt->execute(['email' => $email, 'id' => $id]);

        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email already in use.']);
            exit;
        }

        $updateQuery = "UPDATE users SET FName = :fname, LName = :lname, Email = :email WHERE ID = :id";
        $stmt = $this->db->prepare($updateQuery);
        if ($stmt->execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'id' => $id])) {
            echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
        }
    }
}

// DeleteUserHandler class
class DeleteUserHandler extends UserHandler
{
    public function handle($data)
    {
        $userId = $data['id'];

        $deleteQuery = "DELETE FROM users WHERE ID = :id";
        $stmt = $this->db->prepare($deleteQuery);
        if ($stmt->execute(['id' => $userId])) {
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
        }
    }
}

class UserType
{
    public $ID;
    public $UserTypeName;
    public $ArrayOfPages;
    function __construct($id)
    {
        if ($id != "") {
            $sql = "select * from usertypes where ID=$id";
            $result = mysqli_query($GLOBALS['con'], $sql);
            if ($row = mysqli_fetch_array($result)) {
                $this->UserTypeName = $row["Name"];
                $this->ID = $row["ID"];
                $sql = "select PageID from UserType_Pages where UserTypeID=$this->ID";
                $result = mysqli_query($GLOBALS['con'], $sql);
                $i = 0;
                while ($row1 = mysqli_fetch_array($result)) {
                    $this->ArrayOfPages[$i] = new pages($row1[0]);
                    $i++;
                }
            }
        }
    }

    static function SelectAllUserTypesInDB()
    {
        $sql = "select * from usertypes";
        $TypeDataSet = mysqli_query($GLOBALS['con'], $sql);
        $i = 0;
        $Result;
        while ($row = mysqli_fetch_array($TypeDataSet)) {
            $MyObj = new UserType($row["ID"]);
            $Result[$i] = $MyObj;
            $i++;
        }
        return $Result;
    }
}

class pages
{
    public $ID;
    public $FreindlyName;
    public $Linkaddress;

    function __construct($id)
    {
        if ($id != "") {
            $sql = "select * from pages where ID=$id";
            $result2 = mysqli_query($GLOBALS['con'], $sql);
            if ($row2 = mysqli_fetch_array($result2)) {
                $this->FreindlyName = $row2["FreindlyName"];
                $this->Linkaddress = $row2["Linkaddress"];
                $this->ID = $row2["ID"];
            }
        }
    }

    static function SelectAllPagesInDB()
    {
        $sql = "select * from pages";
        $PageDataSet = mysqli_query($GLOBALS['con'], $sql);
        $i = 0;
        $Result;
        while ($row = mysqli_fetch_array($PageDataSet)) {
            $MyObj = new pages($row["ID"]);
            $Result[$i] = $MyObj;
            $i++;
        }
        return $Result;
    }
}

?>