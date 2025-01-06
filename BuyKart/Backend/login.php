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
        header("Location: ../pages/user.php");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid email or password!";
    }

    $stmt->close();
}

$conn->close();
