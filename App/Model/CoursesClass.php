<?php
// App\Model\CoursesClass.php
session_start();
include_once "../../../public/includes/DB.php";

class Course {
    public $course_ID;
    public $course_name;
    public $description;
    public $level;
    public $start_date;
    public $end_date;
    public $rating;
    public $fees;
    public $tags;
    public $image;

    // public function __construct($builder) {
    //     $this->course_ID = $builder->course_ID;
    //     $this->course_name = $builder->course_name;
    //     $this->description = $builder->description;
    //     $this->level = $builder->level;
    //     $this->start_date = $builder->start_date;
    //     $this->end_date = $builder->end_date;
    //     $this->rating = $builder->rating;
    //     $this->fees = $builder->fees;
    //     $this->tags = $builder->tags;
    // }

    // Static Methods for Database Operations
    static function AddCourse($course_name, $description, $level, $start_date, $end_date, $rating, $fees, $tags, $image) {
        // Sanitize input data
        $course_name = htmlspecialchars($_POST["course_name"]);
        $description = htmlspecialchars($_POST["description"]);
        $level = htmlspecialchars($_POST["level"]);
        $start_date = htmlspecialchars($_POST["start_date"]);
        $end_date = htmlspecialchars($_POST["end_date"]);
        $rating = htmlspecialchars($_POST["rating"]);
        $fees = htmlspecialchars($_POST["fees"]);
        $tags = htmlspecialchars($_POST["tags"]);
        $image = htmlspecialchars($_POST["image"]);
        
        // Check if course name already exists
        $checkCourseQuery = "SELECT * FROM courses WHERE course_name = '$course_name'";
        $result = mysqli_query($GLOBALS['conn'], $checkCourseQuery);

        if (mysqli_num_rows($result) > 0) {
            // Course already exists, display a message
            echo "<script>alert('Course already exists. Please try a different name.');
            window.location.href = '/MegaMinds-Course-Recommendation-System/App/views/Courses/index.php';</script>";
        } else {
            // SQL Query to insert data
            $sql = "INSERT INTO courses (course_name, description, level, start_date, end_date, rating, fees, tags, Image) 
                    VALUES ('$course_name', '$description', '$level', '$start_date', '$end_date', '$rating', '$fees', '$tags', '$image')";

            // Execute query and check result
            if (mysqli_query($GLOBALS['conn'], $sql)) {
                // Redirect the user after successful insertion
                header("Location: /MegaMinds-Course-Recommendation-System/App/views/Admins/courses.php");
                exit();
            } else {
                // Display the error for debugging
                echo "Error: " . $sql . "<br>" . mysqli_error($GLOBALS['conn']);
            }
        }
    }


    
    public static function deleteCourse($courseId) {
        $courseId = (int)$courseId; // Ensure course ID is an integer
        $sql = "DELETE FROM courses WHERE course_ID = :course_ID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':course_ID', $courseId, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return json_encode(['status' => 'success', 'message' => 'Course deleted successfully.']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Error executing the delete statement.']);
        }
    }


    //    Function to edit a course in the database
    static function editCourse() {
        try {
            // Database connection
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            if (isset($_POST['course_ID']) && isset($_POST['course_name']) && isset($_POST['description']) && isset($_POST['level']) && isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['rating']) && isset($_POST['fees']) && isset($_POST['tags']) && isset($_POST['image'])) {
                $courseId = $_POST['course_ID'];
                $courseName = $_POST['course_name'];
                $description = $_POST['description'];
                $level = $_POST['level'];
                $startDate = $_POST['start_date'];
                $endDate = $_POST['end_date'];
                $rating = $_POST['rating'];
                $fees = $_POST['fees'];
                $tags = $_POST['tags'];
                $image = $_POST['image'];
        
                // Check if the course name already exists for another course
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM courses WHERE course_name = :course_name AND course_ID != :course_ID");
                $stmt->execute(['course_name' => $courseName, 'course_ID' => $courseId]);
                $count = $stmt->fetchColumn();
        
                if ($count > 0) {
                    // Course name is already in use by another course
                    echo json_encode(['status' => 'error', 'message' => 'Course name already in use.']);
                    exit;
                }
        
                // Proceed to update the course if no duplicate course name is found
                $stmt = $pdo->prepare("UPDATE courses SET course_name = :course_name, description = :description, level = :level, start_date = :start_date, end_date = :end_date, rating = :rating, fees = :fees, tags = :tags, image = :image WHERE course_ID = :course_ID");
                $stmt->bindParam(':course_name', $courseName);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':level', $level);
                $stmt->bindParam(':start_date', $startDate);
                $stmt->bindParam(':end_date', $endDate);
                $stmt->bindParam(':rating', $rating);
                $stmt->bindParam(':fees', $fees);
                $stmt->bindParam(':tags', $tags);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':course_ID', $courseId, PDO::PARAM_INT);

        
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Course updated successfully']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update course']);
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
    }


class Builder {
    public $course_ID;
    public $course_name;
    public $description;
    public $level;
    public $start_date;
    public $end_date;
    public $rating;
    public $fees;
    public $tags;
    public $image;

    public function setCourseID($course_ID) {
        $this->course_ID = $course_ID;
        return $this;
    }

    public function setCourseName($course_name) {
        $this->course_name = $course_name;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setLevel($level) {
        $this->level = $level;
        return $this;
    }

    public function setStartDate($start_date) {
        $this->start_date = $start_date;
        return $this;
    }

    public function setEndDate($end_date) {
        $this->end_date = $end_date;
        return $this;
    }

    public function setRating($rating) {
        $this->rating = $rating;
        return $this;
    }

    public function setFees($fees) {
        $this->fees = $fees;
        return $this;
    }

    public function setTags($tags) {
        $this->tags = $tags;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function build() {
        return new Course($this);
    }
}

// Usage Example:
// $builder = new Builder();
// $course = $builder->setCourseName('Example Course')->setDescription('Description')->setLevel('Beginner')->setStartDate('2024-01-01')->setEndDate('2024-12-31')->setRating(5)->setFees(100)->setTags('tag1,tag2')->build();
// echo Course::addCourse($db, $course);
?>