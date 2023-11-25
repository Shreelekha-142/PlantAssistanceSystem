<?php // keep 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
} else {
    //echo "Connection successful";
}

if (isset($_POST['delete'])) {
    $instructorID = $_POST['instructorID'];

    $sql = "DELETE FROM `instructor` WHERE `ID` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $instructorID);

        if (mysqli_stmt_execute($stmt)) {
            $aff = mysqli_affected_rows($conn);
            echo "<br>Number of affected rows: $aff<br>";

            if ($aff > 0) {
                echo "Instructor with ID $instructorID has been deleted successfully.";
            } else {
                echo "No instructor found with ID $instructorID.";
            }
        } else {
            echo "Error executing the statement: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the statement: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Instructor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #009688;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
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
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]{
            background-color: #009688; 
        }
        input[type="submit"]:hover{
            background-color: red; 
        }


        p {
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2  style="color: white;">Sorry to see you go !!</h2>
    <form method="post">
        <label  style="color: #009688;" for="instructorID">Enter your Instructor ID to Delete:</label>
        <input type="text" name="instructorID" required>
        <input type="submit" name="delete" value="Delete Account">
    </form>
</body>
</html>
