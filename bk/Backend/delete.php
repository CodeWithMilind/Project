<?php
// session_start();
include '../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        $usr = $_SESSION['user_id'] ?? 0; // Ensure user session is set

        // Check if the product belongs to the logged-in user
        $checkQuery = "SELECT * FROM products WHERE product_id = ? AND uid = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ii", $product_id, $usr);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Product exists and belongs to user, proceed with deletion
            $deleteQuery = "DELETE FROM products WHERE product_id = ? AND uid = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("ii", $product_id, $usr);

            if ($deleteStmt->execute()) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "unauthorized"; // If product does not belong to the user
        }
    } else {
        echo "invalid";
    }
} else {
    echo "method_error";
}
