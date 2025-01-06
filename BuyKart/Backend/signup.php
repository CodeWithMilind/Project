<?php
// Database configuration
include("../config/db-connect.php");

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm-password']);

    // Validate password match // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password for security
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // SQL query to insert data
    $sql = "INSERT INTO `users` (`NAME`, `EMAIL`, `PASSWORD`) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // echo "<h1>Sign-up successful! go and login your acc</h1>";
        header("Location: ../pages/SignupSuccess.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
