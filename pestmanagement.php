<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pest Management Information</title>
    <!-- Add your CSS styling here -->
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #009688;
            color: white;
            margin: 0;
            padding: 0;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        .result {
            background-color: #009688;
            padding: 20px;
            border-radius: 10px;
        }

        label {
            font-size: 1.2rem;
        }

        input[type="text"] {
            width: 200px;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: white;
            color: #009688;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
<form method="post">
        <p>Find Pest Management Information</p>
        <label for="plantName">Enter Plant Name:</label>
        <input type="text" name="plantName" id="plantName" required>
        <input type="submit" name="submit" value="Search">
    </form>
    <?php
if (isset($_POST['submit'])) {
    $plantName = $_POST['plantName'];

    $sql = "SELECT Common_Weeds, Common_Pests, Common_Diseases, PreventionAndCure FROM pestmanagement WHERE PlantName = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $plantName);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $commonWeeds, $commonPests, $commonDiseases, $preventionAndCure);

            echo "<div class='result'>";
            if (mysqli_stmt_fetch($stmt)) {
                echo "<p>Common Weeds: " . $commonWeeds . "</p>";
                echo "<p>Common Pests: " . $commonPests . "</p>";
                echo "<p>Common Diseases: " . $commonDiseases . "</p>";
                echo "<p>Prevention and Cure:</p>";

                // Split the text into lines
                $preventionAndCureLines = explode('->', $preventionAndCure);

                echo "<ul>";
                foreach ($preventionAndCureLines as $line) {
                    $line = trim($line); // Remove leading/trailing spaces
                    if (!empty($line)) {
                        echo "<li>" . $line . "</li>";
                    }
                }
                echo "</ul>";
            } else {
                echo "<p>No information found for the specified plant.</p>";
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
    
</body>
</html>
