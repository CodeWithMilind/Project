<?php
include '../config/db-connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if category is set
$category = isset($_GET['category']) ? $_GET['category'] : 'All';

// Modify SQL query based on category selection
if ($category === 'All') {
    $sql = "SELECT title, price, address, listing_date, product_image, product_id FROM products ORDER BY listing_date DESC";
} else {
    $sql = "SELECT title, price, address, listing_date, product_image, product_id FROM products WHERE category = ? ORDER BY listing_date DESC";
}

// Prepare the statement if category is not 'All'
$stmt = $conn->prepare($sql);

if ($category !== 'All') {
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

echo "<br><br><h2><center>Ads</center></h2><br>";

if ($result->num_rows > 0) {
    echo '<div class="product-grid">';
    while ($row = $result->fetch_assoc()) {
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
        echo '<button class="wishlist-btn">❤︎</button>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<p>No products found!</p>";
}

$conn->close();
