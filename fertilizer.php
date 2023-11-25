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
<html>
<head>
    <title>Fertilizer Lookup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #009688;
            color: white;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        form p {
            font-size: 1.5rem;
        }

        label {
            font-size: 1.2rem;
        }

        input[type="text"] {
            width: 200px;
            padding: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #00776a;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            font-size: 1.2rem;
        }

        .result p {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <form method="post">
        <p>Find Fertilizer Information</p>
        <label for="plantName">Enter Plant Name:</label>
        <input type="text" name="plantName" id="plantName" required>
        <input type="submit" name="submit" value="Search">
    </form>

    <div class="result">
        <?php
        if (isset($_POST['submit'])) {
            $plantName = $_POST['plantName'];
            
            $sql = "SELECT FertilizerName, Price FROM fertilizers WHERE PlantName = ?";
            $stmt = mysqli_prepare($conn, $sql);
    
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $plantName);
    
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_bind_result($stmt, $fertilizerName, $price);
                    
                    if (mysqli_stmt_fetch($stmt)) {
                        echo "<p>Fertilizer Name: " . $fertilizerName . "</p>";
                        echo "<p>Price: " . $price . "</p>";
                    } else {
                        echo "<p>Fertilizer not found for the specified plant.</p>";
                    }
                } else {
                    echo "<p>Error executing the statement: " . mysqli_error($conn) . "</p>";
                }
    
                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Error preparing the statement: " . mysqli_error($conn) . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>
