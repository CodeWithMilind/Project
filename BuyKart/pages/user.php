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

    <!-- header for applying dark mode -->
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


    <!-- Include the Categories header -->
    <?php include '../pages/categories.php'; ?>




    <!-- ----All Products grid---- -->

    <?php include '../pages/all_products.php'; ?>










    <script src="../script/dark-mode.js"></script>
    <script src="../script/open.js"></script>
    <script src="../script/script.js"></script>
</body>

</html>