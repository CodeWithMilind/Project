-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 07:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buykart`
--

-- --------------------------------------------------------

--
-- Table structure for table `fav_products`
--

CREATE TABLE `fav_products` (
  `fav_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fav_products`
--

INSERT INTO `fav_products` (`fav_id`, `uid`, `product_id`, `title`, `category`) VALUES
(25, 1, 166, 'iPhone 16', 'mobiles'),
(27, 1, 167, 'Google Pixel 8', 'mobiles');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `listing_date` datetime DEFAULT current_timestamp(),
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `uid`, `title`, `price`, `address`, `description`, `product_image`, `listing_date`, `category`) VALUES
(165, 1, 'Samsung Galaxy S24', 70000.00, 'Mumbai', 'Latest Samsung flagship phone', '../Products-img/s24.jpg', '2025-03-19 19:18:25', 'mobiles'),
(166, 2, 'iPhone 16', 120000.00, 'Pune', 'Latest Apple iPhone model', '../Products-img/apple16.jpg', '2025-03-19 19:18:25', 'mobiles'),
(167, 3, 'Google Pixel 8', 85000.00, 'Delhi', 'Best Android phone', '../Products-img/pixel.jpg', '2025-03-19 19:18:25', 'mobiles'),
(168, 4, 'Toyota Corolla', 900000.00, 'Chennai', 'Reliable sedan', '../Products-img/Toyota.jpg', '2025-03-19 19:18:25', 'vehicles'),
(169, 5, 'Honda Civic', 1100000.00, 'Bangalore', 'Premium sedan', '../Products-img/honda.jpg', '2025-03-19 19:18:25', 'vehicles'),
(170, 6, 'Yamaha MT-15', 180000.00, 'Hyderabad', 'Sporty bike', '../Products-img/Mt.jpg', '2025-03-19 19:18:25', 'bikes'),
(171, 7, 'Luxury Villa', 25000000.00, 'Mumbai', 'Spacious luxury villa', '../Products-img/villa.jpg', '2025-03-19 19:18:25', 'property'),
(172, 8, '2BHK Apartment', 6000000.00, 'Pune', 'Modern 2BHK flat', '../Products-img/2bhk.jpg', '2025-03-19 19:18:25', 'property');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` bigint(11) NOT NULL COMMENT 'Mobile Number of the user',
  `profile_pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`, `mobile_no`, `profile_pic`) VALUES
(1, 'User1', 'user1@gmail.com', 'welcome', 9891847343, '../uploads/m.jpeg'),
(2, 'User2', 'user2@gmail.com', 'welcome', 9258904443, '../uploads/user2.jpg'),
(3, 'User3', 'user3@gmail.com', 'welcome', 9618980218, '../uploads/user3.jpg'),
(4, 'User4', 'user4@gmail.com', 'welcome', 9318187792, '../uploads/user4.jpg'),
(5, 'User5', 'user5@gmail.com', 'welcome', 9733998336, '../uploads/user5.jpg'),
(6, 'User6', 'user6@gmail.com', 'welcome', 9715428337, '../uploads/user6.jpg'),
(7, 'User7', 'user7@gmail.com', 'welcome', 9375146706, '../uploads/user7.jpg'),
(8, 'User8', 'user8@gmail.com', 'welcome', 9729448553, '../uploads/user8.jpg'),
(13, 'Milind', 'Codewithmilind@gmail.com', 'Milind10@', 8530871762, '../uploads/m.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fav_products`
--
ALTER TABLE `fav_products`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fav_products`
--
ALTER TABLE `fav_products`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fav_products`
--
ALTER TABLE `fav_products`
  ADD CONSTRAINT `fav_products_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `fav_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`UID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
