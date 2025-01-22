<?php
include '../config/db-connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
}

// get user id 
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}
$usr = $_SESSION['user_id'];


// Fetch products from the database
$sql = "SELECT title, price, address, listing_date, product_image FROM products WHERE UID = $usr ORDER BY listing_date DESC  ";
$result = $conn->query($sql);

echo " <br><br><h2>
        <center>Your Ads</center>
    </h2><br>";

// Check if products exist
if ($result->num_rows > 0) {
    echo '<div class="product-grid">';
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img src="' . $row['product_image'] . '" alt="' . $row['title'] . '">';
        echo '<div class="product-info">';
        echo '<h3>₹ ' . $row['price'] . '</h3>';
        echo '<h2><p>' . $row['title'] . '</p></h2>';
        echo '<p>' . $row['address'] . '</p>';
        echo '<p>' . date("M d", strtotime($row['listing_date'])) . '</p>';
        echo '</div>';
        echo '<button class="wishlist-btn">❤️</button>';
        echo '</div>';
    }
    echo '</div>';
} else {
    // echo "<p>No products found!</p>";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/productGrid.css">
    <style>
        /* css for the POST ADS Butoon */

        .post-ads-btn {
            position: fixed;
            top: 80px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .post-ads-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <button class="post-ads-btn" onclick="window.location.href='' ">Post Ads</button>


</body>

</html>