<?php
// Database connection
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

$name = $contact = $fieldOfSpecialization = $about = "";
$name_err = $contact_err = $field_err = $about_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $fieldOfSpecialization = $_POST['fieldOfSpecialization'];
    $about = $_POST['about'];

    // You can add validation for these fields if needed

    if (empty($name) || empty($contact) || empty($fieldOfSpecialization) || empty($about)) {
        // Handle missing fields
        echo "All fields are required.";
    } else {
        // Insert instructor data into the instructor table
        $sql = "INSERT INTO instructor (Name, Contact, FieldofSpecialization, About) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $name, $contact, $fieldOfSpecialization, $about);

            if (mysqli_stmt_execute($stmt)) {
                echo "Instructor data inserted successfully.";
            } else {
                echo "Cannot insert data.";
            }
        } else {
            echo "Error preparing the statement.";
        }
    }
}

// Fetch messages for the logged-in instructor
if (isset($_SESSION['instructor_name'])) {
    $instructorName = $_SESSION['instructor_name'];
    $getMessagesSql = "CALL GetInstructorMessages(?)";
    $getMessagesStmt = mysqli_prepare($conn, $getMessagesSql);

    if ($getMessagesStmt) {
        mysqli_stmt_bind_param($getMessagesStmt, "s", $instructorName);
        mysqli_stmt_execute($getMessagesStmt);

        $result = mysqli_stmt_get_result($getMessagesStmt);

        echo "<h2>Messages for Instructor: $instructorName</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th><th>Instructor Name</th><th>Message</th><th>Timestamp</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['instructor_name']}</td>";
            echo "<td>{$row['message']}</td>";
            echo "<td>{$row['timestamp']}</td>";
            echo "</tr>";
        }

        echo "</table>";

        mysqli_stmt_close($getMessagesStmt);
    } else {
        echo "Error preparing the get messages statement: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Details</title>
    <style>
        body {
            background-color: #009688;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #009688;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #009688;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #007672;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2  style="color: #009688;">Create a Profile</h2>
        <form action="" method="post">
            <div class="form-group">
            <label for="name" style="color: #009688;">Name</label>

                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                
                <label for="contact" style="color: #009688;">Contact</label>
                <input type="text" class="form-control" name="contact" id="contact" required>
            </div>
            <div class="form-group">
                
                <label for="fieldofSpecialization" style="color: #009688;">Field of Specialization</label>
                <input type="text" class="form-control" name="fieldOfSpecialization" id="fieldOfSpecialization" required>
            </div>
            <div class="form-group">
                
                <label for="about" style="color: #009688;">About</label>
                <textarea class="form-control" name="about" id="about" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>


        </form>

        <h3 style="text-align: center; color: green;"> OR </h3>
        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
        <form action="delete.php">
            <input type="submit" value="Delete Account" class="button" style="background-color: white; color: black;">
        </form>

        <form action="displayClients2.php">
            <input type="submit" value="See your Clients" class="button" style="background-color: white; color: black;">
        </form>

        <form action="receivemsg.php">
            <input type="submit" value="See your messages" class="button" style="background-color: white; color: black;">
        </form>
    </div>
</body>
</html>
