<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

if (isset($_GET['username'])) {
    $instructorUsername = $_GET['username'];

    // Fetch messages based on instructor's username
    $sql = "CALL GetInstructorMessagesByUsername(?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $instructorUsername);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            echo '<div class="container">';
            echo '<h2>Message Results</h2>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="message">';
                echo '<p>Message: ' . $row['message'] . '</p>';
                echo '<p>Timestamp: ' . $row['timestamp'] . '</p>';
                echo '</div>';
            }

            echo '</div>';
        } else {
            echo "Error executing the statement: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error executing the statement: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Message Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #009688;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .message {
            background-color: #f0f0f0;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .message p {
            color: #333;
        }
    </style>
</head>
<body>
</body>
</html>
