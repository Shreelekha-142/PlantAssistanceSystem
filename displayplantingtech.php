<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
} else {
    // echo "Connection successful";
}

if (isset($_POST['submit'])) {
    $plantName = $_POST['plantName'];

    $sql = "SELECT Common_Name, `Procedure`, Tools_Required, Requirements FROM planting_techniques WHERE Common_Name = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $plantName);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $commonName, $procedure, $toolsRequired, $requirements);

            if (mysqli_stmt_fetch($stmt)) {
                echo "<h1 style='text-align: center; margin-top: 20px;'>Planting Techniques for " . $commonName . "</h1>";
                echo "<div style='background-color: #f0f0f0; max-width: 600px; margin: 0 auto; padding: 20px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);'>";
                echo "<p><strong>Procedure:</strong></p>";
                echo "<p>" . $procedure . "</p>";
                echo "<p><strong>Tools Required:</strong></p>";
                echo "<p>" . $toolsRequired . "</p>";
                echo "<p><strong>Requirements:</strong></p>";
                echo "<p>" . $requirements . "</p>";
                echo "</div>";
            } else {
                echo "<p style='text-align: center; margin-top: 20px;'>Plant not found</p>";
            }
        } else {
            echo "<p style='text-align: center; margin-top: 20px;'>Error executing the statement: " . mysqli_error($conn) . "</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p style='text-align: center; margin-top: 20px;'>Error preparing the statement: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Planting Techniques</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="post">
        <label for="plantName">Enter Plant Name:</label>
        <input type="text" name="plantName" id="plantName" required>
        <input type="submit" name="submit" value="Search">
    </form>
</body>
</html>
