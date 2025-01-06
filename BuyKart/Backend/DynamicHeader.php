<?php
include '../config/db-connect.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.html');
    exit();
}

// Handle logout functionality
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ../pages/login.html');
    exit();
}

// Get user ID from session
$uid = $_SESSION['user_id'];

// Fetch user data securely
$sql = "SELECT name, PROFILE_PIC FROM users WHERE UID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Default profile photo if not set
$profile_photo = $user['PROFILE_PIC'] ? 'data:image/jpeg;base64,' . base64_encode($user['PROFILE_PIC']) : '../img/default.png';
$name = htmlspecialchars($user['name'] ?? 'Guest');
?>

<header class="header">
    <div class="logo">
        <img src="../img/logo.png" alt="BuyKart Logo" class="logo-img">
    </div>
    <nav class="nav">
        <button id="dark-mode-toggle">Dark Mode</button>

        <div class="profile" onclick="toggleDropdown()">
            <!-- Dynamic profile picture -->
            <img src="<?php echo $profile_photo; ?>" alt="Profile Picture">

            <!-- Display user's name -->
            <span><?php echo $name; ?></span>
        </div>

        <div class="dropdown" id="profile-dropdown">
            <a href="#"><img src="../icons/ads.png" alt="My Ads"> My Ads</a>
            <a href="#"><img src="../icons/packages.png" alt="Buy Packages"> Buy Business Packages</a>
            <a href="#"><img src="../icons/billing.png" alt="Billing"> Bought Packages & Billing</a>
            <a href="#"><img src="../icons/help.png" alt="Help"> Help</a>
            <a href="#"><img src="../icons/settings.png" alt="Settings"> Settings</a>
            <a href="?logout=true"><img src="../icons/logout.png" alt="Logout"> Logout</a>
        </div>
    </nav>
</header>