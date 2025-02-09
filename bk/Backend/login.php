<?php
// Start session
session_start();

// Database connection
include '../config/db-connect.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = ""; // Variable to store error message

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify password without hashing
        if ($password === $user['password']) {
            // Login successful
            $_SESSION['user_id'] = $user['uid'];
            $_SESSION['user_name'] = $user['name'];

            // Redirect to dashboard
            header("Location: ../pages/LoginSuccess.html");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="form-container">
        <h2>Login</h2>

        <!-- Show error message -->
        <?php if (!empty($error)) {
            echo "<p style='color: red;'>$error</p>";
        } ?>

        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Login</button>
        </form>

        <div class="link">
            <p>Don't have an account? <a href="./signup.php">Sign Up</a></p>
        </div>
    </div>
</body>

</html>