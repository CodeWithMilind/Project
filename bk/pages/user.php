<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
    <!-- header for applying dark mode -->
    <link rel="stylesheet" href="../css/dark-mode.css">
    <link rel="stylesheet" href="../css/categories.css">
    <link rel="stylesheet" href="../css/font.css">
    <link rel="stylesheet" href="../css/banner.css">
    <link rel="stylesheet" href="../css/productGrid.css">
    <link rel="stylesheet" href="../css/header.css">

    <!-- for search icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dropdown.css">

    <!-- css to post ads button -->
    <link rel="stylesheet" href="../css/post-ads-btn.css">



</head>

<body>

    <?php include '../Backend/DynamicHeader.php'; ?> <!-- Include the dynamic header -->



    <!-- banner with search bar -->
    <br><br>
    <div class="banner">
        <div class="banner-content">
            <h1>Online Buy-Sell Platform</h1>
            <div class="search-bar">
                <input type="text" placeholder="Search..">
                <button type="submit"><i class="fa fa-search"></i></button>

            </div>
        </div>
    </div>


    <!-- Include the Categories header -->
    <?php include '../pages/categories-user.php'; ?>




    <!-- ----All Products grid---- -->
    <?php include '../Backend/filtered_products.php'; ?>

    <button class="post-ads-btn" onclick="window.location.href='./PostAds.php' ">Post Ads</button>








    <script src="../script/dark-mode.js"></script>
    <script src="../script/open.js"></script>
    <script src="../script/script.js"></script>
</body>
<script>
    // Global variable to identify the source page
    var currentPage = 'user'; // You can use any name here, 'MyAds' in this case
</script>

</html>