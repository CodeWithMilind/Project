<?php
include '../../config/db-connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        $usr = $_SESSION['user_id'] ?? 0; // Ensure user session is set

        // Check if the favorite entry exists for the user
        $checkQuery = "SELECT * FROM fav_products WHERE product_id = ? AND uid = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ii", $product_id, $usr);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Entry exists, proceed with deletion
            $deleteQuery = "DELETE FROM fav_products WHERE product_id = ? AND uid = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("ii", $product_id, $usr);

            if ($deleteStmt->execute()) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "unauthorized"; // If the favorite entry does not exist
        }
    } else {
        echo "invalid";
    }
} else {
    echo "method_error";
}
