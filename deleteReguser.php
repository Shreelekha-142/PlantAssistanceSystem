<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

if (isset($_POST['delete'])) {
    $username = $_POST['username'];

    // Deleting from registration where username is correct 
    $deleteQuery = "DELETE FROM registration WHERE username = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteFunction);

    if ($deleteStmt) {
        mysqli_stmt_bind_param($deleteStmt, "s", $username);

        if (mysqli_stmt_execute($deleteStmt)) {
            $result = mysqli_stmt_get_result($deleteStmt);
            $row = mysqli_fetch_assoc($result);
            $aff = $row['result'];

            if ($aff > 0) {
                echo "User with username $username has been deleted successfully.";
            } else {
                echo "No user found with username $username.";
            }
        } else {
            echo "Error executing the statement: " . mysqli_error($conn);
        }

        mysqli_stmt_close($deleteStmt);
    } else {
        echo "Error preparing the statement: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #009688;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h2 {
            font-size: 24px;
        }

        form {
            margin: 0 auto;
            max-width: 300px;
            padding: 10px;
        }

        label {
            display: block;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #009688;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00736e;
        }
    </style>
</head>
<body>
    <h3>Sorry to see you go!</h3> 
    <h2>Delete Account</h2>
    <form method="post" action="">
        <label for="username">Enter your Username</label>
        <input type="text" name="username" required>
        <input type="submit" name="delete" value="Delete User">
    </form>
</body>
</html>

