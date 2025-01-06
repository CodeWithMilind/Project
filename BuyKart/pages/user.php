<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/categories.css">
    <link rel="stylesheet" href="../css/font.css">
    <link rel="stylesheet" href="../css/banner.css">
    <link rel="stylesheet" href="../css/productGrid.css">
    <link rel="stylesheet" href="../css/header.css">
    <!--  -->
    <link rel="stylesheet" href="../css/user-header.css">
    <!-- for search icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <?php include '../Backend/DynamicHeader.php'; ?> <!-- Include the dynamic header -->



    <!-- banner with search bar -->
    <div class="banner">
        <div class="banner-content">
            <h1>Online Buy-Sell Platform</h1>
            <div class="search-bar">
                <input type="text" placeholder="Search..">
                <button type="submit"><i class="fa fa-search"></i></button>

            </div>
        </div>
    </div>





    <div class="categories">
        <h2>All Categories <br><br></h2>
        <div class="categories-container">
            <!-- Category 1: Mobiles -->
            <div class="category">
                <div class="category-icon" style="background-color: #ff6f61;">
                    <img src="https://www.olx.com.pk/assets/mobiles.8c768c96bfde33f18fcf5af2a8b9cf71.png" alt="Mobiles">
                </div>
                <div class="category-label">Mobiles</div>
            </div>

            <!-- Category 2: Vehicles -->
            <div class="category">
                <div class="category-icon" style="background-color: #ffd700;">
                    <img src="https://www.olx.com.pk/assets/vehicles.29fb808d5118f0db56f68a39ce5392e2.png"
                        alt="Vehicles">
                </div>
                <div class="category-label">Vehicles</div>
            </div>

            <!-- Category 3: Property -->
            <div class="category">
                <div class="category-icon" style="background-color: #ffcccb;">
                    <img src="https://www.olx.com.pk/assets/property-for-sale.e3a00dbfdaa69fe5f713665f1069502f.png"
                        alt="Property">
                </div>
                <div class="category-label">Property</div>
            </div>

            <!-- Category 4: Electronics -->
            <div class="category">
                <div class="category-icon" style="background-color: #fff5d9;">
                    <img src="https://www.olx.com.pk/assets/electronics-home-appliances.46e034dd8adca44625c2c70e4d1b5984.png"
                        alt="Electronics">
                </div>
                <div class="category-label">Electronics</div>
            </div>

            <!-- Category 5: Bikes -->
            <div class="category">
                <div class="category-icon" style="background-color: #b3f0f0;">
                    <img src="https://www.olx.com.pk/assets/bikes.4dcd02c49b2b83aa5b4d629d1e2b383e.png" alt="Bikes">
                </div>
                <div class="category-label">Bikes</div>
            </div>

            <!-- Category 6: Services -->
            <div class="category">
                <div class="category-icon" style="background-color: #ffa500;">
                    <img src="https://www.olx.com.pk/assets/services.dc6aef196c0403dc61b0ee813f66fa5b.png"
                        alt="Services">
                </div>
                <div class="category-label">Services</div>
            </div>

            <!-- Category 7: Books -->
            <div class="category">
                <div class="category-icon" style="background-color: #ff4d4d;">
                    <img src="https://www.olx.com.pk/assets/books-sports-hobbies.6fee8d841b332d65a10f050f4a2ee1c8.png"
                        alt="Books">
                </div>
                <div class="category-label">Books</div>
            </div>
        </div>
    </div>

    <!-- items grid -->
    <div class="product-grid">
        <!-- Item 1 -->
        <div class="product-card">
            <img src="../Products-img/camera.png" alt="Smart Watch">
            <div class="product-info">
                <h3>₹ 600</h3>
                <h2>
                    <p>Camera</p>
                </h2>
                <p>Samudrapur, Maharashtra</p>
                <p>Dec 10</p>
            </div>
            <button class="wishlist-btn">❤️</button>
        </div>






        <!--  -->
    </div>



    <script src="../script/dark-mode.js"></script>
    <script src="../script/open.js"></script>
    <script src="../script/script.js"></script>
</body>

</html>