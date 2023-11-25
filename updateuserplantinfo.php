<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Unsuccessful');
}

if (isset($_POST['update'])) {
    $LastPruningDate = $_POST['LastPruningDate'];
    $AcquisitionDate = $_POST['AcquisitionDate'];
    $FertilisersUsed = $_POST['FertilisersUsed'];
    $GrowthStatus = $_POST['GrowthStatus'];
    $username = $_POST['username'];

    // Call the stored procedure
    $sql = "CALL UpdatePlantInfo('$LastPruningDate', '$AcquisitionDate', '$FertilisersUsed', '$GrowthStatus', '$username')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['result'];
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter your Plants Information </title>
    <style>
          <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #009688;
            color: white;
            margin: 0;
            padding: 0;
        }

        h2, h3 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #009688;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"]:focus,
        input[type="date"]:focus {
            border: 2px solid #009688;
        }

        input[type="text"]:required,
        input[type="date"]:required {
            border: 2px solid #ff0000;
        }

        input[type="submit"] {
            background-color: #009688;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #00796b;
        }
    </style>
    </style>
</head>
<body>
    <h2>Enter your plant Info</h2>
    <h3> This will help you to keep a track of your gardening activities!! </h3>  
    <form method="post" action="updateuserplantinfo.php">
        

        <label for="LastPruningDate">Last Pruning Date:</label>
        <input type="date" name="LastPruningDate"><br>

        <label for="AcquisitionDate">Acquisition Date:</label>
        <input type="date" name="AcquisitionDate"><br>

        <label for="FertilisersUsed">Fertilisers Used:</label>
        <input type="text" name="FertilisersUsed"><br>

        <label for="GrowthStatus">Growth Status:</label>
        <input type="text" name="GrowthStatus"><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <input type="submit" name="update" value="Update Record">
    </form>
</body>
</html>

