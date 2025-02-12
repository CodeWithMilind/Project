<?php
include '../config/db-connect.php'; // Include your DB connection file

// Get the search query from the URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Modify the query to filter products based on the search term
$sql = "SELECT * FROM products WHERE title LIKE '%$searchQuery%' OR category LIKE '%$searchQuery%' OR address LIKE '%$searchQuery%'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product-card">';
        echo '<img src="' . $row['product_image'] . '" alt="Product Image">';
        echo '<h4>' . $row['title'] . '</h4>';
        echo '<p>' . $row['address'] . '</p>';
        echo '<p>₹ ' . $row['price'] . '</p>';
        echo '<button>Buy Now</button>';
        echo '</div>';
    }
} else {
    echo "<p>No products found.</p>";
}
