<!-- css = user-header.css -->

<?php
include '../config/db-connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Backend/login.php');
    exit();
}

// Handle logout functionality
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ../Backend/login.php');
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user data securely
$sql = "SELECT name, PROFILE_PIC FROM users WHERE UID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// $profile_photo = $user['PROFILE_PIC'] ? 'data:image/jpeg;base64,' . base64_encode($user['PROFILE_PIC']) : '../img/default.png';
$name = htmlspecialchars($user['name'] ?? 'Guest');
?>

<!-- html code -->

<header class="header">
    <div class="logo">
        <!-- <img src="../img/logo.png" alt="BuyKart Logo" class="logo-img"> -->
        <a href="../pages/user.php">
            <img src="../img/logo.png" alt="BuyKart Logo" class="logo-img">

        </a>
    </div>
    <nav class="nav">
        <a href="../pages/MyCart.php">
            <button><img src="../img/logos/cart.png" width="40px" height=40px alt=""></button>
        </a>
        <button id="dark-mode-toggle" class="btn dark-mode">🌘</button>

        <div class="profile" onclick="toggleDropdown()">
            <!-- Dynamic profile picture -->

            <?php
            $select = mysqli_query($conn, "SELECT * FROM `users` WHERE uid = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }

            // Default profile photo if not set
            if ($fetch['profile_pic'] == '') {
                echo '<img src="../img/default.png">';
            } else {
                echo '<img src="../uploads/' . $fetch['profile_pic'] . '">';
            }
            ?>

            <!-- Display user's name -->
            <span><?php echo $fetch['name']; ?></span>
        </div>

        <div style="position: fixed;" class="dropdown" id="profile-dropdown">
            <a href="../Backend/EditProfile.php"><img src="../img/logos/editProfile.png" alt="Edit Profile">Edit Profile</a>
            <a href="../pages/MyAds.php"><img src="../img/logos/My-Ads.png" alt="My Ads"> My Ads</a>
            <a href="#"><img src="../icons/help.png" alt="Help"> Help</a>
            <a href="#"><img src="../icons/settings.png" alt="Settings"> Settings</a>
            <a href="?logout=true"><img src="../icons/logout.png" alt="Logout"> Logout</a>
        </div>
    </nav>
</header>