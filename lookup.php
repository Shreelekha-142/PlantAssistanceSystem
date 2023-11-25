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
    <title>Plant Requirements Lookup</title>
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

        .plant-requirements {
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
        // display requirements

        // joining plant and requirements table 
        $query = "SELECT 
                      plant.`Common Name`,
                      requirements.`Climatic Conditions`,
                      requirements.`Soil preferences`,
                      requirements.`Pruning Schedule`,
                      requirements.`Watering Schedule`,
                      requirements.`Sunlight Requirements`,
                      requirements.`Fertilization and Needs`
                  FROM
                      plant
                  INNER JOIN
                      requirements ON plant.Plant_ID = requirements.Plant_ID
                  WHERE
                      plant.`Common Name` = ?";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $commonName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Display the results
            if ($row = mysqli_fetch_assoc($result)) {
                // Display plant requirements
                echo "<div class='plant-requirements'>";
                echo "<h2>Requirements for '{$row['Common Name']}'</h2>";
                echo "<p>Climatic Conditions: {$row['Climatic Conditions']}</p>";
                echo "<p>Soil Preferences: {$row['Soil preferences']}</p>";
                echo "<p>Pruning Schedule: {$row['Pruning Schedule']}</p>";
                echo "<p>Watering Schedule: {$row['Watering Schedule']}</p>";
                echo "<p>Sunlight Requirements: {$row['Sunlight Requirements']}</p>";
                echo "<p>Fertilization and Needs: {$row['Fertilization and Needs']}</p>";
                echo "</div>";
            } else {
                // No matching plant found
                echo "<p>No requirements found for the specified plant common name.</p>";
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
