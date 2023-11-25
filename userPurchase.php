<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn == false) {
    die('Error: Connection unsuccessful');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $plant_selections = isset($_POST['plant_selection']) ? $_POST['plant_selection'] : [];
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];

    $total_amount = 0; // Initialize total amount

    // Loop through each plant purchase
    for ($i = 0; $i < count($plant_selections); $i++) {
        // Check if array keys exist before accessing them
        $plant_selection = isset($plant_selections[$i]) ? explode(" - ", $plant_selections[$i]) : [];
        $quantity = isset($quantities[$i]) ? intval($quantities[$i]) : 0;

        // Ensure that necessary keys exist before accessing them
        if (count($plant_selection) == 2) {
            $plant_price = floatval(str_replace('$', '', $plant_selection[1])); // Extract price from the selection
            $subtotal = $plant_price * $quantity;
            $total_amount += $subtotal;
        }
    }

    // Call the stored procedure to insert the total purchase amount
    $insertProcedure = "CALL InsertUserPurchase(?, ?)";
    $insertStmt = mysqli_prepare($conn, $insertProcedure);

    if ($insertStmt) {
        mysqli_stmt_bind_param($insertStmt, 'id', $user_id, $total_amount);
        mysqli_stmt_execute($insertStmt);
        mysqli_stmt_close($insertStmt);
        echo "Purchase successful! Total Amount: $" . number_format($total_amount, 2);
    } else {
        echo 'Error calling stored procedure: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Purchase Form</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #009688;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('arrow.png') no-repeat 95% 50%;
            background-size: 20px;
            padding-right: 40px; /* Adjust based on the arrow image size */
        }

        button {
            background-color: #009688;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1.2rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #00796b;
        }

        .add-plant {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .add-plant button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h2>Make a Purchase</h2>
    <form action="" method="post">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" required>

        <!-- Plant selection with price -->
        <label for="plant_selection">Select Plant:</label>
        <div class="add-plant">
            <select name="plant_selection[]" required>
                <option value="Rose - $10.00">Rose - $10.00</option>
                <option value="Lily - $15.00">Lily - $15.00</option>
                <option value="Fern - $8.00">Fern - $8.00</option>
                <option value="Tulip - $12.00">Tulip - $12.00</option>
                <option value="Sunflower - $18.00">Sunflower - $18.00</option>
                <option value="Daisy - $9.00">Daisy - $9.00</option>
                <option value="Orchid - $25.00">Orchid - $25.00</option>
                <option value="Cactus - $7.00">Cactus - $7.00</option>
                <!-- Add more plant options with prices as needed -->
            </select>
            <button type="button" onclick="addPlant()">Add Another Plant</button>
        </div>

        <!-- Quantity input -->
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity[]" min="1" required>

        <button type="submit">Make Purchase</button>
    </form>

    <script>
        function addPlant() {
            // Clone the plant input fields and append them to the form
            var plantFields = document.querySelectorAll('[name^="plant_selection"]');
            var lastPlantField = plantFields[plantFields.length - 1];
            var newPlantField = lastPlantField.cloneNode(true);
            newPlantField.value = '';
            document.querySelector('.add-plant').insertBefore(newPlantField, lastPlantField.nextSibling);
        }
    </script>
</body>
</html>
