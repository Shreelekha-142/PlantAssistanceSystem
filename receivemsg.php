<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Lookup</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-right: 20px;
        }

        form p {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        label {
            font-size: 1.2rem;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #00776a;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }

        .result {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .message-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            text-align: left;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message-container p {
            margin: 5px 0;
        }

        .no-messages {
            color: #777;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">
            <p>Find Messages</p>
            <label for="instructorUsername">Enter Instructor Username:</label>
            <input type="text" name="instructorUsername" id="instructorUsername" required>
            <input type="submit" name="submit" value="Search">
        </form>

        <?php
        // Your PHP code here
        ?>

        <div class="result">
            <?php
                
                define('DB_SERVER', 'localhost');
                define('DB_USERNAME', 'root');
                define('DB_PASSWORD', '');
                define('DB_NAME', 'PlantAssistanceSystem');
            
                $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            
                if ($conn == false) {
                    die('Error: Unsuccessful');
                }
            
                if (isset($_POST['submit'])) {
                    $instructorUsername = $_POST['instructorUsername'];
            
                // Call the stored procedure
                    $sql = "CALL GetMessagesByInstructor(?)";
                    $stmt = mysqli_prepare($conn, $sql);
            
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $instructorUsername);
            
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_bind_result($stmt, $username, $timestamp, $message);
            
                            echo "<div class='result'>";
                        
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<p>Username: " . $username . "</p>";
                                echo "<p>Timestamp: " . $timestamp . "</p>";
                                echo "<p>Message: " . $message . "</p>";
                                echo "<hr>";
                            }
            
                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                echo "<p>No messages found for the specified instructor.</p>";
                            }
            
                            echo "</div>";
                        } else {
                            echo "<p>Error executing the statement: " . mysqli_error($conn) . "</p>";
                        }
            
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "<p>Error preparing the statement: " . mysqli_error($conn) . "</p>";
                    }
                }
            
            
                    
                    
            ?>
           

            <p class="no-messages">No messages found for the specified instructor.</p>
        </div>
    </div>
</body>

</html>

