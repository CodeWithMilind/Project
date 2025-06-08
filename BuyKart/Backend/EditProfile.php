<?php
session_start();
include("../config/db-connect.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Backend/login.php");
    exit();
}

$uid = $_SESSION['user_id'];

// Fetch current user data
$query = "SELECT * FROM users WHERE UID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$isPassValid = true;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";
    $profile_pic = $user['profile_pic'];
    $whatsapp_no = trim($_POST['whatsapp_no']);

    // Validate password
    if (empty($password)) {
        echo "<script>alert('Password is required!');</script>";
        $isPassValid = false;
    } elseif ($password !== $user['password']) {
        echo "<script>alert('Password is incorrect!');</script>";
        $isPassValid = false;
    }

    // Handle profile picture upload
    if ($_FILES['profile_pic']['error'] == 0) {
        $max_size = 10 * 1024 * 1024; // 10MB limit
        $file_size = $_FILES['profile_pic']['size'];
        $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];

        $file_type = mime_content_type($_FILES['profile_pic']['tmp_name']);
        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Invalid file type! Only JPG, JPEG, and PNG allowed.');</script>";
            exit();
        }

        if ($file_size > $max_size) {
            echo "<script>alert('File size exceeds 10MB!');</script>";
            exit();
        }

        $target_dir = "../uploads/";
        $profile_pic = $target_dir . basename($_FILES["profile_pic"]["name"]);
        if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic)) {
            echo "<script>alert('Failed to upload profile picture.');</script>";
            exit();
        }
    }

    if ($isPassValid) {
        // Update query
        $update_query = "UPDATE users SET name = ?, email = ?, profile_pic = ?";
        $params = [$name, $email, $profile_pic];
        $types = "sss";

        if (!empty($whatsapp_no)) {
            $update_query .= ", mobile_no = ?";
            $params[] = $whatsapp_no;
            $types .= "s"; // Changed from "i" to "s" (since mobile_no is a string)
        }

        $update_query .= " WHERE UID = ?";
        $params[] = $uid;
        $types .= "i";

        $stmt = $conn->prepare($update_query);
        if (!$stmt) {
            echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
            exit();
        }

        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            echo "<script>alert('Profile updated successfully!');</script>";

            // to refresh the page
            header("Location: ".$_SERVER['PHP_SELF']);
        } else {
            echo "<script>alert('Error updating profile: " . $stmt->error . "');</script>";
        }
    }
}
?>

<!-- Html file -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../css/Edit-Profile.css">
</head>

<body>
    <div id="popup-message" class="popup-message"></div>

    <div class="update-profile">
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <img src="<?= htmlspecialchars($user['profile_pic'] ?: '../img/default.png') ?>" alt="Profile Image" class="profile-image">

            <div class="flex">
                <div class="inputBox">
                    <span>Username: (Space Not Allowed)</span>
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" class="box">
                    <span>Email:</span>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="box">
                    <span>Update Image:</span>
                    <input type="file" name="profile_pic" accept="image/jpg, image/jpeg, image/png" class="box">
                </div>
                <div class="inputBox">
                    <span>Whatsapp No:</span>
                    <input type="text" name="whatsapp_no" value="<?= htmlspecialchars($user['mobile_no']) ?>" placeholder="Enter Whatsapp No" class="box">
                    <span>Password:</span>
                    <input type="password" id="password" name="password" placeholder="Enter password" class="box">
                </div>
            </div>

            <input type="submit" value="Update Profile" class="btn">
            <a href="../pages/user.php" class="delete-btn">Go Back</a>
        </form>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("password");
            if (password.value.trim() === "") {
                alert("Password is required!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>