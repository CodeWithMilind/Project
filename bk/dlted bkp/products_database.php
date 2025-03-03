<?php
include '../config/db-connect.php'; // Include your DB connection file

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get category and search query from URL, and escape them for security
$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : 'All';
$searchQuery = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Modify SQL query based on category and search input
if ($category === 'All' && empty($searchQuery)) {
    $sql = "SELECT  *  
            FROM products 
            ORDER BY listing_date DESC";
} elseif ($category !== 'All' && empty($searchQuery)) {
    $sql = "SELECT  *  
            FROM products 
            WHERE category = '$category' 
            ORDER BY listing_date DESC";
} elseif ($category === 'All' && !empty($searchQuery)) {
    $sql = "SELECT  *  
            FROM products 
            WHERE title LIKE '%$searchQuery%' 
               OR category LIKE '%$searchQuery%' 
               OR address LIKE '%$searchQuery%' 
            ORDER BY listing_date DESC";
} else {
    $sql = "SELECT  *  
            FROM products 
            WHERE category = '$category' 
              AND (title LIKE '%$searchQuery%' 
               OR category LIKE '%$searchQuery%' 
               OR address LIKE '%$searchQuery%') 
            ORDER BY listing_date DESC";
}

$result = mysqli_query($conn, $sql);

echo "<br><br><h2><center>Ads</center></h2><br>";

if (mysqli_num_rows($result) > 0) {
    echo '<div class="product-grid">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product-card">';
        echo '<div class="image-box">';
        echo '<img src="' . $row['product_image'] . '" alt="' . $row['title'] . '">';
        echo '</div>';
        echo '<div class="product-info">';
        echo '<h3>₹ ' . $row['price'] . '</h3>';
        echo '<h2><p>' . $row['title'] . '</p></h2>';
        echo '<p>' . $row['address'] . '</p>';
        echo '<p>' . date("M d", strtotime($row['listing_date'])) . '</p>';
        echo '<form method="POST" action="../Backend/product-details.php">';
        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">';
        echo '<br><button type="submit" class="btn btn-outline-success">Buy Now</button>';
        echo '</form>';
        echo '</div>';
        // echo '<button class="wishlist-btn">❤︎</button>';
        echo '<button class="wishlist-btn" onclick="this.classList.toggle(\'active\')">❤︎</button>';




        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<div style='background-color: red; color: white; text-align: center; padding: 10px;'>
    <h4>No products found!</h4>
  </div><br><br>";
}



$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/productGrid.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

</body>

<script>
    // for buy now button
    function buyNow(productId) {
        window.location.href = "../Backend/product-details.php?product_id=" + productId; // Fix URL parameter name
    }
</script>

</html>