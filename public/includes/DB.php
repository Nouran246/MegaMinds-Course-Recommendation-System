<?php
$servername = "sql211.infinityfree.com";
$username = "if0_37790923";
$password = " 8dTUdnid6i ";
$DB = "if0_37790923_megaminds";

$conn = mysqli_connect($servername,$username,$password,$DB);


if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}