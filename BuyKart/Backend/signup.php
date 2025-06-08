<?php
// Database configuration
include("../config/db-connect.php");

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ""; // Variable to store error message

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm-password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check_email = "SELECT email FROM users WHERE email = '$email'";
        $result = $conn->query($check_email);

        if ($result->num_rows > 0) {
            $error = "This email is already registered!";
        } else {
            // SQL query to insert data
            $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                header("Location: ../pages/SignupSuccess.html");
                exit();
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="../css/sign-up.css">
</head>

<body>
    <div class="wrapper">
        <div class="left-panel">
            <h1>Welcome to buyKart</h1>
            <p>Discover amazing products at the best prices. Shop now and enjoy seamless buying and selling!</p>
        </div>
        <div class="right-panel">
            <div class="form-container">
                <h2>New User Sign Up</h2>

                <!-- Show error message -->
                <?php if (!empty($error)) {
                    echo "<p style='color: red;'>$error</p>";
                } ?>

                <form action="" method="POST">
                    <input type="text" name="name" placeholder="User Name" required>

                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" minlength="8" name="password" placeholder="Password" required>
                    <input type="password" minlength="8" name="confirm-password" placeholder="Confirm Password" required>


                    <br><br>
                    <button type="submit" name="submit">Sign Up</button>
                </form>
                <p> &nbsp; &nbsp; Already have an account? <a href="./login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>

</html>