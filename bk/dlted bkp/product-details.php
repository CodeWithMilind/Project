<?php
// Database connection
include '../config/db-connect.php'; // Include your database connection file


// Get product ID from URL parameter
// $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 1;

// Get product ID from POST request to hide data in link
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$usr = $_SESSION['user_id'];



// Fetch product and seller details
$sql = "SELECT p.*, u.name AS seller_name,
        u.email AS seller_email,
        u.profile_pic,
        u.mobile_no AS wp 
        FROM products p
        JOIN users u ON p.uid = u.uid
        WHERE p.product_id = $product_id";


$stmt = $conn->prepare($sql);
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
    <link rel="stylesheet" href="../css/product-details.css">

    <link rel="stylesheet" href="../css/dark-mode-product-details.css">
    <link rel="stylesheet" href="../css/user-header.css">

    <link rel="stylesheet" href="../css/dropdown.css">

    <link rel="stylesheet" href="../css/categories.css">


    <style>
        /* css for back button */
        #backButton {
            width: 100%;
            color: white;
            background-color: #007BFF;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #backButton:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }




        /* new back button */

        .back-btn-container {
            position: absolute;
            top: 15px;
            /* Adjust position under the logo */
            left: 20px;
            /* Align with the logo */
            z-index: 1000;
            /* Ensure it's above other elements */
        }

        #backButton {
            color: white;
            background-color: #007BFF;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #backButton:hover {
            background-color: #0056b3;
        }
    </style>
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
                <h1 class="price_tag">₹<?php echo number_format($product['price']); ?></h1>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>
                <h3>Location:</h3> <?php echo htmlspecialchars($product['address']); ?></p>
                <p><small>Posted on <?php echo date("F j, Y", strtotime($product['listing_date'])); ?></small></p>
            </div>

            <div class="card">
                <p>
                <h3>Description</h3>
                <?php echo htmlspecialchars($product['description']); ?>
                </p>
            </div>
            <div class="card">
                <a href="../pages/user.php">
                    <button id="backButton" href="../pages/user.php">Back</button>
                </a>
            </div>
        </div>
        <!-- Right Side: Seller Info & Chat Button -->
        <div class="right">
            <div class="card seller-box">
                <img src="<?php echo htmlspecialchars($product['profile_pic']); ?>" alt="Seller">

                <h2 class="seller_name"><?php echo htmlspecialchars($product['seller_name']); ?></h2>
            </div>


            <a target="_blank" href="https://wa.me/91<?php echo htmlspecialchars($product['wp']); ?>" class="btn">
                <h3>Chat With Us</h3> <img height="40px" width="auto" src="../img/logos/whatsapp.png" alt="">
            </a>

            <div class="card">
                <h3>Posted in</h3>
                <p><?php echo htmlspecialchars($product['address']); ?></p>
            </div>
            <div class="card">
                <h3>Map View</h3>
                <iframe class="map-container" src="https://www.google.com/maps/embed?..." allowfullscreen loading="lazy"></iframe>
            </div>

        </div>
    </div>
</body>
<script src="../script/dark-mode4product-details.js"></script>
<script src="../script/open.js"></script>
<script src="../script/script.js"></script>
<script src="../script/delete-product.js"></script>


</html>