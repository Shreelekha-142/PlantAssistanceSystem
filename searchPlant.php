<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}
 
if (isset($_POST['search'])) {    
    $searchTerm = $_POST['searchTerm'];

    // Displaying plant information 
    $sql = "SELECT * FROM plant WHERE `Common Name` LIKE CONCAT('%', ?, '%')";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $searchTerm);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // HTML code for displaying search results
            echo '<div class="container">';
            echo '<h2>Search Results</h2>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="plant">';
                echo '<h3>Plant ID: ' . $row['Plant_ID'] . '</h3>';
                echo '<p>Common Name: ' . $row['Common Name'] . '</p>';
                echo '<p>Scientific Name: ' . $row['Scientific Name'] . '</p>';
                echo '<p>Category Name: ' . $row['Category_Name'] . '</p>';
                echo '<p>About: ' . $row['About'] . '</p>';
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
    <title>Plant Search Results</title>
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

        .plant {
            background-color: #f0f0f0;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .plant h3 {
            color: #009688;
        }

        .plant p {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Plant Search</h1>
        <form method="post" action="">
            <label for="searchTerm">Plant Common Name:</label>
            <input type="text" name="searchTerm" id="searchTerm" required>
            <input type="submit" name="search" value="Search">
        </form>
    </div>
</body>
</html>
