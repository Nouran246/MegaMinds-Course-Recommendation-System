<?php
session_start();
include_once "../../public/includes/DB.php";

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

    // Constructor to initialize the course properties
    public function __construct() {
        $this->course_ID = $course_ID;
        $this->course_name = $course_name;
        $this->description = $description;
        $this->level = $level;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->rating = $rating;
        $this->fees = $fees;
        $this->tags = $tags;
    }

    // Function to display course details (optional)
}

// Example of creating a new Course object
$course = new Course(
    1,                    // course_ID
    "Introduction to PHP",// course_name
    "Learn the basics of PHP.", // description
    "Beginner",           // level
    "2024-01-01",         // start_date
    "2024-02-01",         // end_date
    5,                    // rating
    200,                  // fees
    "PHP, Web Development" // tags
);
?>
