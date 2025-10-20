<?php
require 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name  = htmlspecialchars(trim($_POST['last_name']));
    $email      = htmlspecialchars(trim($_POST['email']));
    $rating     = (int)$_POST['rating'];
    $comments   = htmlspecialchars(trim($_POST['comments']));

 
    if ($rating < 1 || $rating > 5) {
        die("Error: Rating must be between 1 and 5.");
    }

    
    $stmt = $conn->prepare("INSERT INTO feedbacks (first_name, last_name, email, rating, comments) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $first_name, $last_name, $email, $rating, $comments);

  
    if ($stmt->execute()) {
        echo "<script>alert('Thank you for your feedback!'); window.location.href='display.php';</script>";
    } else {
        echo "Error saving feedback: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    
} else {
    
    echo "Invalid request.";
}
?>
