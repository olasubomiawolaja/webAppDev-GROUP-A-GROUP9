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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 40px 0;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            min-height: 100vh;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            text-align: center;
            color: #fff;
            font-size: 2.5rem;
            letter-spacing: 1px;
            text-shadow: 1px 2px 4px rgba(0,0,0,0.2);
            margin-bottom: 25px;
        }

        form {
            text-align: center;
            background: rgba(255, 255, 255, 0.85);
            padding: 20px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            backdrop-filter: blur(8px);
            margin-bottom: 30px;
            width: 85%;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        input[type="text"], select, button {
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 30px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, select:focus {
            border-color: #43cea2;
            box-shadow: 0 0 5px rgba(67,206,162,0.5);
        }

        button {
            background: linear-gradient(135deg, #43cea2, #185a9d);
            color: #fff;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        button:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #5ee7df, #b490ca);
            box-shadow: 0 6px 18px rgba(0,0,0,0.25);
        }

        table {
            width: 85%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            backdrop-filter: blur(8px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        table:hover {
            transform: scale(1.01);
            box-shadow: 0 10px 35px rgba(0,0,0,0.15);
        }

        th, td {
            padding: 14px 18px;
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        th {
            background: linear-gradient(135deg, #43cea2, #185a9d);
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 15px;
        }

        tr:nth-child(even) td {
            background-color: rgba(240, 255, 240, 0.6);
        }

        tr:hover td {
            background-color: rgba(129, 212, 250, 0.4);
            transition: background-color 0.3s ease;
        }

        .average {
            text-align: center;
            margin-top: 30px;
            font-size: 1.2rem;
            color: #fff;
            background: rgba(0,0,0,0.2);
            padding: 12px 25px;
            border-radius: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            backdrop-filter: blur(6px);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .average:hover {
            transform: translateY(-4px);
            background: rgba(255,255,255,0.25);
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 22px;
            text-decoration: none;
            background: linear-gradient(135deg, #43cea2, #185a9d);
            color: white;
            border-radius: 30px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        a:hover {
            transform: translateY(-3px);
            background: linear-gradient(135deg, #5ee7df, #b490ca);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
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