<?php
// Database configuration
include("../config/db-connect.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// if user is not logged then redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Backend/login.php");
    exit();
}



$usr = $_SESSION['user_id'];

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productName = $conn->real_escape_string($_POST['product-name']);
    $price = $conn->real_escape_string($_POST['rs']);
    $address = $conn->real_escape_string($_POST['address']);
    $category = $conn->real_escape_string($_POST['category']);
    $listingDate = date("Y-m-d H:i:s");

    // Handle file upload
    $targetDir = "../Products-img/";
    $fileName = basename($_FILES["photos"]["name"]);
    $uniqueFileName = uniqid() . '-' . $fileName; // Ensure unique file name
    $targetFilePath = $targetDir . $uniqueFileName;

    // Validate file type (only images allowed)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/img', 'image/jpg'];
    $fileType = $_FILES["photos"]["type"];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["photos"]["tmp_name"], $targetFilePath)) {

            // Insert data into the database using prepared statements
            $stmt = $conn->prepare("INSERT INTO `products` (`title`, `price`, `address`, `product_image`, `listing_date`, `category`, `uid`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $productName, $price, $address, $targetFilePath, $listingDate, $category, $usr);

            if ($stmt->execute()) {
                // $message = "Ad submitted successfully!";
                $showPopup = true; // Flag to show the popup
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "File upload failed!";
        }
    } else {
        $message = "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post an Ad</title>
    <link rel="stylesheet" href="../css/PostAds.css">
    <link rel="stylesheet" href="../css/PostAds-PopUp.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <h1>Post an Ad</h1>
        <p><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></p>
        <form method="POST" enctype="multipart/form-data">
            <label for="product-name">Product Name</label>
            <input type="text" id="product-name" name="product-name" placeholder="Enter product name" required>

            <label for="rs">Price (RS)</label>
            <input type="text" id="rs" name="rs" placeholder="Enter price in RS" required>

            <label for="photos">Photo (Required)</label>
            <input type="file" id="photos" name="photos" required>
            <div class="preview-container" id="preview-container"></div>

            <label for="address">Address</label>
            <textarea id="address" name="address" placeholder="Enter your address" rows="4" required></textarea>

            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="mobiles">Mobiles</option>
                <option value="vehicles">Vehicles</option>
                <option value="property">Property</option>
                <option value="electronics">Electronics</option>
                <option value="bikes">Bikes</option>
                <option value="services">Services</option>
                <option value="books">Books</option>
                <option value="others">others</option>

            </select>

            <button id="submit" type="submit">Submit Ad</button>

        </form>
        <button id="homeButton" type="button" onclick="window.location.href='./user.php'">
            Home
        </button>
    </div>

    <!-- Popup HTML -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <div class="popup-icon">✨</div>
        <p>Ad posted successfully!</p>
        <div class="popup-buttons">
            <button onclick="window.location.href='./user.php'">Return to Home</button>
            <button onclick="closePopup()">Add More Posts</button>
        </div>
    </div>


</body>
<script src="../script/PostAds.js"></script>
<?php if (isset($showPopup) && $showPopup): ?>
    <script>
        sessionStorage.setItem("showPopup", "true");
        window.location.href = window.location.href; // Reload the page to clear the form
    </script>
<?php endif; ?>


</html>