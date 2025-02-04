<?php
include '../config/db-connect.php';


// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
}



// Fetch products from the database
$sql = "SELECT title, price, address, listing_date, product_image FROM products ORDER BY listing_date DESC  ";
$result = $conn->query($sql);

echo " <br><br><h2>
        <center>Your Ads</center>
    </h2><br>";

// Check if products exist
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
        echo '</div>';
        echo '<button class="wishlist-btn">❤︎</button>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<p>No products found!</p>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

</head>

<body>


</body>
<script>
    // Add event listener to all wishlist buttons
    document.addEventListener("DOMContentLoaded", () => {
        const wishlistButtons = document.querySelectorAll(".wishlist-btn");

        wishlistButtons.forEach(button => {
            button.addEventListener("click", () => {
                // Toggle 'active' class to change button appearance
                button.classList.toggle("active");
            });
        });
    });
</script>

</html>