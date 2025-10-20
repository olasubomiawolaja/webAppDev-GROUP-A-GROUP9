<?php
include('connection.php');
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$rating = isset($_GET['rating']) ? trim($_GET['rating']) : '';
$query = "SELECT first_name, last_name, email, rating, comments FROM feedbacks WHERE 1";
if (!empty($keyword)) {
    $query .= " AND (first_name LIKE '%$keyword%' OR last_name LIKE '%$keyword%' OR comments LIKE '%$keyword%' OR email LIKE '%$keyword%')";
}
if (!empty($rating)) {
    $query .= " AND rating = '$rating'";
}
$result = mysqli_query($conn, $query);
$avgQuery = "SELECT AVG(rating) AS avg_rating FROM feedbacks WHERE 1";
if (!empty($keyword)) {
    $avgQuery .= " AND (first_name LIKE '%$keyword%' OR last_name LIKE '%$keyword%' OR comments LIKE '%$keyword%' OR email LIKE '%$keyword%')";
}
if (!empty($rating)) {
    $avgQuery .= " AND rating = '$rating'";
}
$avgResult = mysqli_query($conn, $avgQuery);
$avgData = mysqli_fetch_assoc($avgResult);
$average = $avgData['avg_rating'] ? number_format($avgData['avg_rating'], 2) : 'No ratings yet';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Filter</title>
</head>
<body>
    <h1>Filter Feedback</h1>
    <form method="GET" action="">
        <input type="text" name="keyword" placeholder="Search" value="<?php echo htmlspecialchars($keyword); ?>">
        <select name="rating">
            <option value="">All Ratings</option>
            <?php
            for ($i = 1; $i <= 5; $i++) {
                $selected = ($rating == $i) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>
        <button type="submit">Apply Filter</button>
    </form>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Comments</th>
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['first_name']) . "</td>
                        <td>" . htmlspecialchars($row['last_name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['rating']) . "</td>
                        <td>" . htmlspecialchars($row['comments']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No matching records found.</td></tr>";
        }
        ?>
    </table>
    <div class="average">
        <strong>Average Rating:</strong> <?php echo $average; ?>
    </div>
    <a href="display.php">Go Back</a>
</body>
</html>