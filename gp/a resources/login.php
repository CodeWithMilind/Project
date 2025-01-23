<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'buykart');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Use prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO `users1` (`id`, `pass`) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<p>Login data saved successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
