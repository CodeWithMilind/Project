<?php
include '../config/db-connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$usr = $_SESSION['user_id'] ?? 0; // Ensure session variable is set
$category = $_GET['category'] ?? 'All';

// Prepare SQL query with JOIN to get full product details
$sql = "SELECT p.*, f.fav_id FROM fav_products f 
        JOIN products p ON f.product_id = p.product_id 
        WHERE f.uid = ?";

if ($category !== 'All') {
    $sql .= " AND f.category = ?";
}

$sql .= " ORDER BY f.fav_id DESC";

$stmt = $conn->prepare($sql);

if ($category === 'All') {
    $stmt->bind_param("i", $usr);
} else {
    $stmt->bind_param("is", $usr, $category);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<br><br><h2><center>Your Favourite Ads</center></h2><br>";

if ($result->num_rows > 0) {
    echo '<div class="product-grid">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<div class="image-box">';
        echo '<img src="' . htmlspecialchars($row['product_image']) . '" alt="' . htmlspecialchars($row['title']) . '">';
        echo '</div>';
        echo '<div class="product-info">';
        echo '<h3>₹ ' . number_format($row['price'], 2) . '</h3>';
        echo '<h2><p>' . htmlspecialchars($row['title']) . '</p></h2>';
        echo '<p>' . htmlspecialchars($row['address']) . '</p>';
        echo '<p>' . date("M d", strtotime($row['listing_date'])) . '</p>';
        echo '<form method="POST" action="../Backend/product-details.php">';
        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">';
        echo '<br><button type="submit" class="btn btn-outline-success">Buy Now</button>';
        echo '</form>';

        // Delete button
        echo '<button onclick="deleteProduct(this)" class="delete-product delete-btn" data-id="' . htmlspecialchars($row['product_id']) . '">⌦</button>';

        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<div style='background-color: red; color: white; text-align: center; padding: 10px;'>
    <h4>No products found!</h4>
  </div><br><br>";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listings</title>
    <link rel="stylesheet" href="../css/productGrid.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: grey;
            border: 2px solid black;
            border-radius: 10%;
            cursor: pointer;
            width: 30px;
            height: 30px;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .delete-btn:hover {
            color: rgb(0, 0, 0);
            background-color: red;
        }
    </style>
</head>

<body>
</body>

<script>
    function deleteProduct(button) {
        const productId = button.getAttribute("data-id");
        if (confirm("Are you sure you want to delete this product?")) {
            fetch("../Backend/Processes/delete-fav.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "product_id=" + encodeURIComponent(productId)
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        alert("Product deleted successfully!");
                        location.reload();
                    } else {
                        alert("Error deleting product: " + data);
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    }
</script>

</html>