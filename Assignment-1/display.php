<?php

include('connection.php');

$sql = "SELECT * FROM feedbacks";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error retrieving data: " . mysqli_error($conn));
}


$avg_sql = "SELECT AVG(rating) AS average_rating FROM feedbacks";
$avg_result = mysqli_query($conn, $avg_sql);
$avg_row = mysqli_fetch_assoc($avg_result);
$average_rating = number_format($avg_row['average_rating'], 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> View Feedback</title>
</head>
<body>
    <h1>Feedback Table</h1>

    <table border="1">
        <tr>
            <?php
            
            if (mysqli_num_rows($result) > 0) {
                $fields = mysqli_fetch_fields($result);
                foreach ($fields as $field) {
                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                }
                echo "</tr>";

                
                mysqli_data_seek($result, 0);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='100%'>No records found.</td></tr>";
            }
            ?>
    </table>

    <div>
        <strong>Average Rating:</strong> <?php echo $average_rating; ?>
    </div>

    <a href="feedback.html">Go Back</a>
    <a href="filter.php">Filter Feedback</a>
</body>
</html>
