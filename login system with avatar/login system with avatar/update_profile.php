<?php

// Include configuration and start session
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

// Handle profile update
if (isset($_POST['update_profile'])) {

    // Sanitize input data
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

    // Update user name and email
    mysqli_query($conn, "UPDATE `user_form` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('Query failed');

    // Handle password update
    $old_pass = $_POST['old_pass'];
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($update_pass != $old_pass) {
            $message[] = 'Old password does not match!';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'Confirm password does not match!';
        } else {
            mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('Query failed');
            $message[] = 'Password updated successfully!';
        }
    }

    // Handle image update
    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/' . $update_image;

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image is too large';
        } else {
            if (mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'")) {
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
                $message[] = 'Image updated successfully!';
            } else {
                $message[] = 'Failed to update image';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="update-profile">
    <?php
    // Fetch user details
    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('Query failed');
    $fetch = mysqli_fetch_assoc($select);
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- Display user image -->
        <img src="<?= $fetch['image'] ? 'uploaded_img/' . $fetch['image'] : 'images/default-avatar.png'; ?>" alt="User Image">

        <!-- Display messages -->
        <?php if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . $msg . '</div>';
            }
        } ?>

        <div class="flex">
            <div class="inputBox">
                <span>Username:</span>
                <input type="text" name="update_name" value="<?= $fetch['name']; ?>" class="box">
                <span>Email:</span>
                <input type="email" name="update_email" value="<?= $fetch['email']; ?>" class="box">
                <span>Update Image:</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_pass" value="<?= $fetch['password']; ?>">
                <span>Old Password:</span>
                <input type="password" name="update_pass" placeholder="Enter old password" class="box">
                <span>New Password:</span>
                <input type="password" name="new_pass" placeholder="Enter new password" class="box">
                <span>Confirm Password:</span>
                <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
            </div>
        </div>

        <input type="submit" value="Update Profile" name="update_profile" class="btn">
        <a href="home.php" class="delete-btn">Go Back</a>
    </form>
</div>

</body>
</html>
