<?php
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'signout') {
    session_destroy();
    header("Location: /MegaMinds-Course-Recommendation-System/App/views/Users/index.php");
    exit();
    
}
?> 