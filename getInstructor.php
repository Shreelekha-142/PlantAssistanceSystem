<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

// Call the GetAllInstructors stored procedure
$getAllInstructorsSQL = "CALL GetAllInstructors()";

if ($result = mysqli_query($conn, $getAllInstructorsSQL)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Instructors List</title>
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

                    .instructor-card {
                        background-color: white;
                        max-width: 400px;
                        margin: 20px auto;
                        padding: 20px;
                        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                        border-radius: 5px;
                    }

                    .instructor-card h3 {
                        font-size: 18px;
                        font-weight: bold;
                    }

                    .instructor-card p {
                        margin-top: 10px;
                    }

                    .centered-button {
                        text-align: center;
                    }

                    .centered-form {
                        text-align: center;
                        max-width: 400px;
                        margin: 0 auto;
                    }

                    .centered-form form {
                        width: 100%; /* Make the form take up full width of the centered container */
                    }
                </style>
            </head>
            <body>
                <h2>Instructors List</h2>';
        while ($row = mysqli_fetch_assoc($result)) {
            // Process and display the results in instructor cards
            echo '<div class="instructor-card">';
            echo "<h3>Name: " . $row['Name'] . "</h3>";
            echo "<p>Field of Specialization: " . $row['FieldofSpecialization'] . "</p>";
            echo "<p>About: " . $row['About'] . "</p>";
            echo '</div>';
        }
        echo '<div class="centered-button">
                  <form action="random4.php" class="centered-form">
                      <input type="submit" value="Choose your instructor" class="button" style="background-color:#009688 ; color: black; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;">
                  </form>
              </div>';
        echo '</body></html>';
        mysqli_free_result($result);
    } else {
        echo "No records found.";
    }
} else {
    echo "Error calling the stored procedure: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
