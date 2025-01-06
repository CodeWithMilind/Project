<?php

// Include configuration and start session
include '../config/db-connect.php';
session_start();
$user_id = $_SESSION['user_id'];

// Handle profile update
if (isset($_POST['update_profile'])) {

    // Sanitize input data
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

    // Update user name and email
    mysqli_query($conn, "UPDATE `users` SET NAME = '$update_name', EMAIL = '$update_email' WHERE UID = '$user_id'") or die('Query failed');

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
            mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE UID = '$user_id'") or die('Query failed');
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
            if (mysqli_query($conn, "UPDATE `users` SET PROFILE_PIC = '$update_image' WHERE UID = '$user_id'")) {
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
    <style>
        :root {
            --blue: #3498db;
            --dark-blue: #2980b9;
            --red: #e74c3c;
            --dark-red: #c0392b;
            --black: #333;
            --white: #fff;
            --light-bg: #eee;
            --box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        }

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        *::-webkit-scrollbar {
            width: 10px;
        }

        *::-webkit-scrollbar-track {
            background-color: transparent;
        }

        *::-webkit-scrollbar-thumb {
            background-color: var(--blue);
        }

        .btn,
        .delete-btn {
            width: 100%;
            border-radius: 5px;
            padding: 10px 30px;
            color: var(--white);
            display: block;
            text-align: center;
            cursor: pointer;
            font-size: 20px;
            margin-top: 10px;
        }

        .btn {
            background-color: var(--blue);
        }

        .btn:hover {
            background-color: var(--dark-blue);
        }

        .delete-btn {
            background-color: var(--red);
        }

        .delete-btn:hover {
            background-color: var(--dark-red);
        }

        .message {
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            background-color: var(--red);
            color: var(--white);
            font-size: 20px;
        }

        .form-container,
        .container,
        .update-profile {
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container form,
        .container .profile,
        .update-profile form {
            padding: 20px;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            text-align: center;
            border-radius: 5px;
        }

        .form-container form h3,
        .container .profile h3 {
            margin-bottom: 10px;
            font-size: 30px;
            color: var(--black);
            text-transform: uppercase;
        }

        .form-container form .box,
        .update-profile form .flex .inputBox .box {
            width: 100%;
            border-radius: 5px;
            padding: 12px 14px;
            font-size: 18px;
            color: var(--black);
            margin: 10px 0;
            background-color: var(--light-bg);
        }

        .form-container form p,
        .container .profile p {
            margin-top: 15px;
            font-size: 20px;
            color: var(--black);
        }

        .form-container form p a,
        .container .profile p a {
            color: var(--red);
        }

        .form-container form p a:hover,
        .container .profile p a:hover {
            text-decoration: underline;
        }

        .container .profile img,
        .update-profile form img {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        .update-profile form .flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 15px;
        }

        .update-profile form .flex .inputBox {
            width: 49%;
        }

        .update-profile form .flex .inputBox span {
            text-align: left;
            display: block;
            margin-top: 15px;
            font-size: 17px;
            color: var(--black);
        }

        .update-profile form .flex .inputBox .box {
            width: 100%;
            border-radius: 5px;
            background-color: var(--light-bg);
            padding: 12px 14px;
            font-size: 17px;
            color: var(--black);
            margin-top: 10px;
        }

        @media (max-width: 650px) {
            .update-profile form .flex {
                flex-wrap: wrap;
                gap: 0;
            }

            .update-profile form .flex .inputBox {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="update-profile">
        <?php
        // Fetch user details
        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE UID = '$user_id'") or die('Query failed');
        $fetch = mysqli_fetch_assoc($select);
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- Display user image -->
            <img src="<?= $fetch['PROFILE_PIC'] ? 'uploaded_img/' . $fetch['PROFILE_PIC'] : '../img/default.png'; ?>" alt="User Image">

            <!-- Display messages -->
            <?php if (isset($message)) {
                foreach ($message as $msg) {
                    echo '<div class="message">' . $msg . '</div>';
                }
            } ?>

            <div class="flex">
                <div class="inputBox">
                    <span>Username:</span>
                    <input type="text" name="update_name" value="<?= $fetch['NAME']; ?>" class="box">
                    <span>Email:</span>
                    <input type="email" name="update_email" value="<?= $fetch['EMAIL']; ?>" class="box">
                    <span>Update Image:</span>
                    <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
                </div>
                <div class="inputBox">
                    <input type="hidden" name="old_pass" value="<?= $fetch['PASSWORD']; ?>">
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