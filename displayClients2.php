<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

$instructorName = "";
$instructorName_err = "";

$associatedClients = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['instructorName']))) {
        $instructorName_err = "Please enter your Instructor Name.";
    } else {
        $instructorName = trim($_POST['instructorName']);
    }

    if (empty($instructorName_err)) {
        // Create a SQL query to retrieve clients associated with the instructor from userinstructor table
        $sql = "SELECT username FROM userinstructor WHERE InstructorName = ?";

        // Use prepared statements to avoid SQL injection
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $instructorName);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)) {
                    $associatedClients[] = $row['username'];
                }
            } else {
                echo "Error executing the statement: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the statement: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Associated Clients</title>
    <style>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #009688;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #009688;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            text-align: center;
        }

        h2 {
            background-color: #00796b;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        form {
            background-color: #fff;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"]:focus {
            border: 2px solid #009688;
        }

        input[type="text"]:required {
            border: 2px solid #ff0000;
        }

        button {
            background-color: #009688;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00796b;
        }

        .text-danger {
            color: #ff0000;
            margin-top: 8px;
            display: block;
        }

        p {
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h2>Display Associated Clients</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="instructorName">Instructor Name</label>
                <input type="text" class="form-control" name="instructorName" id="instructorName">
                <span class="text-danger"><?php echo $instructorName_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit">Display Clients</button>
            </div>
        </form>

        <?php
        if (!empty($associatedClients)) {
            echo "<h2>Clients associated with Instructor:</h2>";

            foreach ($associatedClients as $client) {
                echo "Username: " . $client . "<br>";
                echo "<br>";
            }
        } else {
            echo "<p>No clients associated with the provided instructor.</p>";
        }
        ?>
    </div>
</body>
</html>
