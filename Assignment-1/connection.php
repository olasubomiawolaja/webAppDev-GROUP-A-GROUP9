<?php
$host= "localhost";
$user= "root";   
$password = "";     
$dbname = "feedback_portal";

// Creating connection with the database
$conn = new mysqli($host, $user, $password, $dbname);

// Checking connection(if its connected or not)
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
