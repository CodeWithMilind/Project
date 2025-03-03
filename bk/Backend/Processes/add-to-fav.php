<?php
session_start();
include '../../config/db-connect.php'; // Ensure database connection is included

header('Content-Type: application/json'); // Return JSON response


$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
$category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';

if ($product_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid product ID"]);
    exit;
}

// Check if product is already in the favorites list
$check_sql = "SELECT * FROM fav_products WHERE uid = ? AND product_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $user_id, $product_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    // Remove from favorites
    $delete_sql = "DELETE FROM fav_products WHERE uid = ? AND product_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $user_id, $product_id);
    $delete_stmt->execute();
    echo json_encode(["status" => "removed", "message" => "Removed from favorites"]);
} else {
    // Add to favorites
    $insert_sql = "INSERT INTO fav_products (uid, product_id, title, category) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iiss", $user_id, $product_id, $title, $category);
    if ($insert_stmt->execute()) {
        echo json_encode(["status" => "added", "message" => "Added to favorites"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add to favorites"]);
    }
}

$conn->close();
