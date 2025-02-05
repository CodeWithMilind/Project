<?php
// Database connection
include '../config/db-connect.php'; // Include your database connection file


// Get product ID from URL parameter
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 1;

// Fetch product and seller details
$sql = "SELECT p.*, u.name AS seller_name, u.email AS seller_email, u.profile_pic 
        FROM products p
        JOIN users u ON p.uid = u.uid
        WHERE p.product_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="../css/user-header.css">
    <link rel="stylesheet" href="../css/header.css">

</head>

<body>
    <?php include '../Backend/DynamicHeader.php'; ?> <!-- Include the dynamic header -->


    <div class="container">
        <!-- Left Side: Product Image & Details -->
        <div class="left">
            <div class="card">
                <div class="image-container">
                    <div class="image-box">
                        <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image">
                    </div>
                </div>
            </div>
            <div class="card">
                <h4 style="color: #007bff;">₹<?php echo number_format($product['price']); ?></h4>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($product['address']); ?></p>
                <p><small>Posted on <?php echo date("F j, Y", strtotime($product['listing_date'])); ?></small></p>
            </div>
        </div>
        <!-- Right Side: Seller Info & Chat Button -->
        <div class="right">
            <div class="card seller-box">
                <img src="<?php echo htmlspecialchars($product['profile_pic']); ?>" alt="Seller">
                <div>


                    <h2><?php echo htmlspecialchars($product['seller_name']); ?></h2>
                    <a href="mailto:<?php echo htmlspecialchars($product['seller_email']); ?>" class="btn">Chat With Us</a>
                </div>
            </div>
            <div class="card">
                <h6>Posted in</h6>
                <p><?php echo htmlspecialchars($product['address']); ?></p>
            </div>
            <div class="card">
                <h6>Map View</h6>
                <iframe class="map-container" src="https://www.google.com/maps/embed?..." allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </div>
</body>
<script src="../script/dark-mode.js"></script>
<script src="../script/open.js"></script>
<script src="../script/script.js"></script>

</html>