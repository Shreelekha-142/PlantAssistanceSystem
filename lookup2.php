<?php


define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn == false){
    dir('Error: Unsuccessful');
}else{
    //echo"connection successfull"; 
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planting Techniques Lookup</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #009688;
        }

        .planting-techniques {
            max-width: 600px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p {
            margin-bottom: 16px;
            color: #333;
        }

        p:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commonName = $_POST['common_name'];
        // planting techniques

        // displaying planting techniques 
        $query = "SELECT
                      Common_Name,
                      `Procedure`,
                      Tools_Required,
                      Requirements  
                  FROM
                      planting_techniques
                  WHERE
                      Plant_ID IN (
                          SELECT
                              Plant_ID
                          FROM
                              plant
                          WHERE
                              `Common Name` = ?
                      )";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $commonName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Display the results
            while ($row = mysqli_fetch_assoc($result)) {
                // Display planting techniques
                echo "<div class='planting-techniques'>";
                echo "<h2>Planting Techniques for '{$row['Common_Name']}'</h2>";
                echo "<p>Procedure: {$row['Procedure']}</p>";
                echo "<p>Tools Required: {$row['Tools_Required']}</p>";
                echo "<p>Requirements: {$row['Requirements']}</p>";
                echo "</div>";
            }

            if (mysqli_num_rows($result) === 0) {
                // No matching plant found
                echo "<p>No planting techniques found for the specified plant common name.</p>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the statement: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
