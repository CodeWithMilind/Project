<?php
session_start();
include("../config/db-connect.php"); // File to connect to the database

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Backend/login.php");
    exit();
}
$ispass = true;
$uid = $_SESSION['user_id'];

// Fetch current user data
$query = "SELECT * FROM users WHERE UID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $profile_pic = $user['profile_pic'];
    $whatsapp_no = trim($_POST['whatsapp_no']);

    // Validate input
    if (empty($password)) {
        // echo "Password is required.";
        echo "<script>alert('Password is Required!');</script>";
        $ispass = false;
    }

    // Verify password
    if ($password != $user['password'] && !empty($password)) {
        // echo "Password is incorrect.";
        echo "<script>alert('Password is incorrect!');</script>";

        // exit();
    }

    // Handle profile picture upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $max_size = 10 * 1024 * 1024; // 10MB
        $file_type = mime_content_type($_FILES['profile_pic']['tmp_name']);
        $file_size = $_FILES['profile_pic']['size'];

        $target_dir = "../uploads/";
        $profile_pic = $target_dir . basename($_FILES["profile_pic"]["name"]);
        if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic)) {
            echo "Failed to upload profile picture.";
            exit();
        }
    }

    // Initialize query and parameter variables
    $update_query = "UPDATE users SET name = ?, email = ?, profile_pic = ?";
    $params = [$name, $email, $profile_pic];
    $types = "sss";

    // Add whatsapp_no to the query only if it's not empty
    if (!empty($whatsapp_no)) {
        $update_query .= ", mobile_no = ?";
        $params[] = $whatsapp_no;
        $types .= "i";
    }

    $update_query .= " WHERE uid = ?";
    $params[] = $uid;
    $types .= "i";

    // Execute the query
    $stmt = $conn->prepare($update_query);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute() && $ispass == true) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
}

?>

<!-- Html file  -->

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
        <form action="" method="post" enctype="multipart/form-data">
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
                    <input type="password" name="password" placeholder="Enter password" class="box">
                </div>
            </div>

            <input type="submit" value="Update Profile" class="btn">
            <a href="../pages/user.php" class="delete-btn">Go Back</a>
        </form>
    </div>

</body>
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

</html>