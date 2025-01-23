<?php
// Database configuration
include("../config/db-connect.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
                $message = "Ad submitted successfully!";
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
            </select>

            <button type="submit">Submit Ad</button>
        </form>
    </div>


</body>
<script>
    // js to preview the uploaded photo on the screen from device 

    const photosInput = document.getElementById('photos');
    const previewContainer = document.getElementById('preview-container');

    photosInput.addEventListener('change', () => {
        previewContainer.innerHTML = ''; // Clear previous previews
        const files = photosInput.files;

        Array.from(files).forEach(file => {
            const reader = new FileReader();

            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    });
</script>

</html>