<?php
session_start();
include("../config/db-connect.php"); // File to connect to the database

// Fetch current user data
$uid = $_SESSION['user_id']; // Replace with dynamic session UID
$query = "SELECT * FROM users WHERE UID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $profile_pic = $user['PROFILE_PIC'];

    // Check if the old password matches
    if ($old_password === $_POST['old_password']) { // Without hashing

        // Update password if new password is provided and matches confirmation
        if (!empty($new_password) && $new_password === $confirm_password) {
            $new_password_plain = $new_password; // No hashing
        } else {
            $new_password_plain = $user['PASSWORD']; // Keep the old password
        }

        // Handle profile picture upload
        if (!empty($_FILES['profile_pic']['name'])) {
            $target_dir = "../uploads/";
            $profile_pic = $target_dir . basename($_FILES["profile_pic"]["name"]);
            move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic);
        }

        // Update the database
        $update_query = "UPDATE users SET NAME = ?, EMAIL = ?, PASSWORD = ?, PROFILE_PIC = ? WHERE UID = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssssi", $name, $email, $new_password_plain, $profile_pic, $uid);

        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile: " . $stmt->error;
        }
    } else {
        echo "Old password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Profile</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Username:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['NAME']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['EMAIL']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password:</label>
                <input type="password" class="form-control" id="old_password" name="old_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <div class="mb-3">
                <label for="profile_pic" class="form-label">Update Image:</label>
                <input type="file" class="form-control" id="profile_pic" name="profile_pic">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="../pages/user.php" class="btn btn-danger">Go Back</a>
            </div>
        </form>
    </div>
</body>

</html>