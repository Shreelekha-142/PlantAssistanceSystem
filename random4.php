<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $instructor_name = $_POST['instructor_name'];

    // Prepare and execute the SQL statement to update the instructor column in the users table
    $updateSql = "UPDATE users SET instructor = ? WHERE ID = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);

    if ($updateStmt) {
        mysqli_stmt_bind_param($updateStmt, "si", $instructor_name, $user_id);

        if (mysqli_stmt_execute($updateStmt)) {
            // Check if the userinstructor entry already exists
            $checkSql = "SELECT * FROM userinstructor WHERE username = ? AND InstructorName = ?";
            $checkStmt = mysqli_prepare($conn, $checkSql);
            mysqli_stmt_bind_param($checkStmt, "ss", $user_id, $instructor_name);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_store_result($checkStmt);

            if (mysqli_stmt_num_rows($checkStmt) == 0) {
                // If the entry doesn't exist, insert it
                $insertSql = "INSERT INTO userinstructor (username, InstructorName) VALUES (?, ?)";
                $insertStmt = mysqli_prepare($conn, $insertSql);
                mysqli_stmt_bind_param($insertStmt, "ss", $user_id, $instructor_name);
                mysqli_stmt_execute($insertStmt);
            }

            echo "Instructor updated successfully.";
        } else {
            echo "Error updating instructor: " . mysqli_error($conn);
        }

        mysqli_stmt_close($updateStmt);
        mysqli_stmt_close($checkStmt);
    } else {
        echo "Error preparing the update statement: " . mysqli_error($conn);
    }
}

// If the form is submitted and the user has provided a message
if (isset($_POST['send_message'])) {
    $user_id = $_POST['user_id'];
    $instructor_name = $_POST['instructor_name'];
    $message = $_POST['message'];

    // Call the stored procedure to insert the message into the messages table
    $insertMessageSql = "CALL InsertMessage(?, ?, ?)";
    $insertMessageStmt = mysqli_prepare($conn, $insertMessageSql);

    if ($insertMessageStmt) {
        mysqli_stmt_bind_param($insertMessageStmt, "sss", $user_id, $instructor_name, $message);

        if (mysqli_stmt_execute($insertMessageStmt)) {
            echo "Message sent successfully.";
        } else {
            echo "Error inserting message: " . mysqli_error($conn);
        }

        mysqli_stmt_close($insertMessageStmt);
    } else {
        echo "Error preparing the insert message statement: " . mysqli_error($conn);
    }
}

// Create a stored procedure to fetch all instructors
$getAllInstructorsSQL = "CALL GetAllInstructors()";
$instructorList = array();

if ($result = mysqli_query($conn, $getAllInstructorsSQL)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $instructorList[] = $row;
    }
    mysqli_free_result($result);
} else {
    echo "Error fetching instructor list: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Instructor</title>
    <!-- Your existing styles remain unchanged -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            background-color: #009688;
            color: white;
            padding: 10px;
            text-align: center;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"]:focus, textarea:focus {
            border: 2px solid #009688;
        }

        input[type="text"]:required, textarea:required {
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
            margin-top: 10px; /* Added margin-top for spacing */
        }

        input[type="submit"]:hover {
            background-color: #007771;
        }

        p {
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Select your Instructor </h2>
    <form method="post">
        <label for="username">User Name</label>
        <input type="text" name="user_id" required><br>

        <label for="instructor_name">Select Instructor:</label><br>
        <select name="instructor_name" required>
            <option value="">Select an Instructor</option>
            <?php
            foreach ($instructorList as $instructor) {
                echo "<option value=\"{$instructor['Name']}\">{$instructor['Name']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" name="update" value="Update Instructor">
    </form>

    <h2>Send Message </h2>
    <form method="post">
        <label for="username">User Name</label>
        <input type="text" name="user_id" required><br>

        <label for="instructor_name">Select Instructor:</label><br>
        <select name="instructor_name" required>
            <option value="">Select an Instructor</option>
            <?php
            foreach ($instructorList as $instructor) {
                echo "<option value=\"{$instructor['Name']}\">{$instructor['Name']}</option>";
            }
            ?>
        </select><br>

         
        <label for="message">Message:</label><br>
        <textarea name="message" rows="4" cols="50" required></textarea><br>

        <input type="submit" name="send_message" value="Send Message">
    </form>
</body>
</html>
