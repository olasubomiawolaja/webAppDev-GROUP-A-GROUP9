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
    <title>View Feedback</title>

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
            margin-bottom: 30px;
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
    <div class="container">
        <h1>Feedback Table</h1>

        <table>
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

        <div class="average">
            <strong>Average Rating:</strong> <?php echo $average_rating; ?>
        </div>

        <div class="buttons">
            <a href="feedback.html" class="btn">Go Back</a>
            <a href="filter.php" class="btn btn-secondary">Filter Feedback</a>
        </div>
    </div>
</body>
</html>