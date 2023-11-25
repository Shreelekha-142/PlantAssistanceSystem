<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

// Initialize variables
$username = "";
$resultUsername = "";
$totalTime = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username from the form
    $username = $_POST['username'];

    // Call the stored procedure to calculate total time spent logged in for the specified user
    $calculateTotalTimeProcedure = "CALL CalculateTotalTimeForUser(?)";
    $calculateTotalTimeStmt = mysqli_prepare($conn, $calculateTotalTimeProcedure);

    if ($calculateTotalTimeStmt) {
        mysqli_stmt_bind_param($calculateTotalTimeStmt, 's', $username);
        mysqli_stmt_execute($calculateTotalTimeStmt);

        // Bind the result variables
        mysqli_stmt_bind_result($calculateTotalTimeStmt, $resultUsername, $totalTime);

        // Fetch the result
        mysqli_stmt_fetch($calculateTotalTimeStmt);
    } else {
        echo 'Error calling stored procedure: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Time Spent Logged In</title>
    <style>
        
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        color: #009688;
    }

    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: #009688;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
    }

    button:hover {
        background-color: #00796b;
    }

    table {
        border-collapse: collapse;
        width: 50%;
        margin: 20px auto;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }


    </style>
</head>
<body>

<h2>Total Time Spent Logged In by User</h2>

<form action="" method="post">
    <label for="username">Enter Username:</label>
    <input type="text" name="username" required>
    <button type="submit">Calculate Total Time</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Display the results in an HTML table
    echo '<table border="1">';
    echo '<tr><th>Username</th><th>Total Time Logged In</th></tr>';
    echo '<tr>';
    echo '<td>' . $resultUsername . '</td>';
    echo '<td>' . $totalTime . '</td>';
    echo '</tr>';
    echo '</table>';
}
?>

</body>
</html>
