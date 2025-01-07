<?php
// Start session
session_start();

// Database connection
include '../config/db-connect.php'; // Include your database connection file


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $sql = "SELECT * FROM users WHERE EMAIL = ? AND PASSWORD = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['UID'];
        $_SESSION['user_name'] = $user['NAME'];

        // Redirect to dashboard or home page
        // header("Location: ../pages/user.php");
        header("Location: ../pages/LoginSuccess.html");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid email or password!";
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
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Login</button>
        </form>

        <div class="link">
            <p>Don't have an account? <a href="./signup.html">Sign Up</a></p>
        </div>
    </div>
</body>

</html>