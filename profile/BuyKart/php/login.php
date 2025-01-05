<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "buykart"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session
session_start();

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
        header("Location: ../pages/user.html");
        exit;
    } else {
        // Invalid credentials
        $error = "Invalid email or password!";
        echo $error;
    }

    $stmt->close();
}

$conn->close();
