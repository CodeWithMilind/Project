-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 05:25 PM
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
(1, 3, 88, 'headphones', 'mobiles'),
(3, 3, 48, 'iPhone 15', 'mobiles'),
(6, 3, 49, 'Samsung S23', 'mobiles'),
(8, 3, 52, 'Google Pixel 7', 'mobiles');

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
(48, 1, 'iPhone 15', 50000.00, 'Mumbai', 'Latest iPhone model', '../Products-img/mobiles.png', '2025-02-09 22:53:37', 'mobiles'),
(49, 2, 'Samsung S23', 45000.00, 'Pune', 'Samsung flagship phone', '../Products-img/mobiles.png', '2025-02-09 22:53:37', 'mobiles'),
(50, 3, 'OnePlus 11', 42000.00, 'Delhi', 'Fastest OnePlus phone', '../Products-img/mobiles.png', '2025-02-09 22:53:37', 'mobiles'),
(52, 6, 'Google Pixel 7', 60000.00, 'Hyderabad', 'Best camera phone', '../Products-img/mobiles.png', '2025-02-09 22:53:37', 'mobiles'),
(53, 2, 'Toyota Fortuner', 3500000.00, 'Delhi', 'Luxury SUV', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(54, 3, 'Honda City', 1200000.00, 'Mumbai', 'Popular Sedan', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(55, 1, 'Maruti Swift', 800000.00, 'Pune', 'Best-selling hatchback', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(56, 6, 'Hyundai Creta', 1500000.00, 'Chennai', 'Top compact SUV', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(58, 4, '3BHK Flat', 7500000.00, 'Delhi', 'Luxury apartment', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(59, 6, '2BHK House', 5000000.00, 'Mumbai', 'Cozy home', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(60, 1, 'Farmhouse', 15000000.00, 'Pune', 'Spacious farm villa', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(61, 3, 'Studio Apartment', 3000000.00, 'Chennai', 'Compact living space', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(62, 2, 'Office Space', 10000000.00, 'Bangalore', 'Prime location office', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(64, 4, 'Sony Headphones', 15000.00, 'Mumbai', 'Noise-canceling headset', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(65, 1, 'Apple MacBook', 120000.00, 'Pune', 'Powerful laptop', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(66, 2, 'Samsung Smart TV', 55000.00, 'Chennai', '4K LED TV', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(67, 6, 'Bose Speakers', 25000.00, 'Bangalore', 'High-quality sound', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(68, 2, 'Yamaha R15', 200000.00, 'Delhi', 'Sporty bike', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(69, 6, 'Royal Enfield', 250000.00, 'Mumbai', 'Classic cruiser', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(71, 1, 'Bajaj Pulsar 220', 150000.00, 'Chennai', 'Best budget sports bike', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(78, 6, 'Rich Dad Poor Dad', 500.00, 'Delhi', 'Financial literacy book', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(79, 1, 'The Alchemist', 400.00, 'Mumbai', 'Motivational novel', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(80, 2, 'Atomic Habits', 600.00, 'Pune', 'Self-improvement book', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(88, 10, 'headphones', 109.00, 'jjj', NULL, '../Products-img/67c42f9c9b05b-1730005889694.jpg', '2025-03-02 11:14:52', 'mobiles');

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
(1, 'gayu', 'M@gmail.com', '1', 9999999999, '../uploads/g.png'),
(2, 'shubh', 'shubh@g.com', '1', 1111111111, '../uploads/milind.JPG'),
(3, 'dnyaneshwar', 'milind.chaudhari1010@gmail.com', '1', 7066329030, '../uploads/pexels-photo-672444.png'),
(4, 'nikhil', 'n@gmail.com', '123', 0, '../uploads/milind.JPG'),
(6, 'bhushu', 'bhusu@gmail.com', '2', 0, ''),
(7, 'SHIVAM', 's@gmail.com', '1', 8530871762, '../uploads/pexels-photo-672444.png'),
(8, 'Nileshwari', 'Nil@gmail.com', '1', 9999999999, '../uploads/m.jpg'),
(9, 'sumit', 'sumitbawaskar68@gmail.com', '123', 7709623616, '../uploads/images.jpg'),
(10, 'kiran', 'kiran@gmail.com', '123', 9999999999, '../uploads/IMG_8085.JPG');

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
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
