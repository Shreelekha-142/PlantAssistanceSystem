<?php
require_once "config.php";

$full_name = $email = $username = $password = $phone_number = "";
$username_err = $password_err = $confirm_password_err = $registration_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM registration WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST['username']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                $registration_err = "Something went wrong";
            }
            mysqli_stmt_close($stmt);
        } else {
            $registration_err = "Error preparing the statement";
        }
    }

    // Validate other fields and password (similar to your existing logic)
    // ...

    // If no errors, proceed with registration
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO registration (full_name, email, username, password, phone_number) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $param_full_name, $param_email, $param_username, $param_password, $param_phone_number);

            $param_full_name = $_POST['full_name'];
            $param_email = $_POST['email'];
            $param_username = $username;
            $param_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $param_phone_number = $_POST['phone_number'];

            if (mysqli_stmt_execute($stmt)) {
                header("location: logs.php");
            } else {
                $registration_err = "Cannot redirect";
            }

            mysqli_stmt_close($stmt);
        } else {
            $registration_err = "Error preparing the statement";
        }
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Registration | Nature U</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <p>Please fill in your details to create an account.</p>

        <!-- Display error message if registration fails -->
        <?php if (!empty($registration_err)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $registration_err; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" required>
                <!-- Display username error message -->
                <?php if (!empty($username_err)) : ?>
                    <span class="text-danger"><?php echo $username_err; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" required>
                <!-- Display confirm password error message -->
                <?php if (!empty($confirm_password_err)) : ?>
                    <span class="text-danger"><?php echo $confirm_password_err; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" class="form-control" name="phone_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p>Already have an account? <a href="logs.php">Login here</a>.</p>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
