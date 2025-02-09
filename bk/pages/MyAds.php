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
    <link rel="stylesheet" href="../css/user-header.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <!-- for search icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* css for the POST ADS Butoon */

        .post-ads-btn {
            position: fixed;
            top: 15px;
            right: 250px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .post-ads-btn:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <?php include '../Backend/DynamicHeader.php'; ?> <!-- Include the dynamic header -->

    <?php include '../pages/categories-myads.php'; ?>


    <?php include '../Backend/user_filtered_products.php'; ?>



    <button class="post-ads-btn" onclick="window.location.href='./PostAds.php' ">Post Ads</button>




    <script src="../script/dark-mode.js"></script>
    <script src="../script/open.js"></script>
    <script src="../script/script.js"></script>
</body>
<script>
    // Global variable to identify the source page
    var currentPage = 'MyAds'; // You can use any name here, 'MyAds' in this case
</script>

</html>