-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 07:17 PM
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
(51, 4, 'Redmi Note 12', 18000.00, 'Bangalore', 'Best budget phone', '../Products-img/mobiles.png', '2025-02-09 22:53:37', 'mobiles'),
(52, 6, 'Google Pixel 7', 60000.00, 'Hyderabad', 'Best camera phone', '../Products-img/mobiles.png', '2025-02-09 22:53:37', 'mobiles'),
(53, 2, 'Toyota Fortuner', 3500000.00, 'Delhi', 'Luxury SUV', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(54, 3, 'Honda City', 1200000.00, 'Mumbai', 'Popular Sedan', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(55, 1, 'Maruti Swift', 800000.00, 'Pune', 'Best-selling hatchback', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(56, 6, 'Hyundai Creta', 1500000.00, 'Chennai', 'Top compact SUV', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(57, 4, 'Tata Nexon', 1200000.00, 'Bangalore', 'Top-selling EV', '../Products-img/vehicles.png', '2025-02-09 22:53:37', 'vehicles'),
(58, 4, '3BHK Flat', 7500000.00, 'Delhi', 'Luxury apartment', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(59, 6, '2BHK House', 5000000.00, 'Mumbai', 'Cozy home', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(60, 1, 'Farmhouse', 15000000.00, 'Pune', 'Spacious farm villa', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(61, 3, 'Studio Apartment', 3000000.00, 'Chennai', 'Compact living space', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(62, 2, 'Office Space', 10000000.00, 'Bangalore', 'Prime location office', '../Products-img/property.png', '2025-02-09 22:53:37', 'property'),
(63, 3, 'Canon DSLR', 60000.00, 'Delhi', 'Professional camera', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(64, 4, 'Sony Headphones', 15000.00, 'Mumbai', 'Noise-canceling headset', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(65, 1, 'Apple MacBook', 120000.00, 'Pune', 'Powerful laptop', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(66, 2, 'Samsung Smart TV', 55000.00, 'Chennai', '4K LED TV', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(67, 6, 'Bose Speakers', 25000.00, 'Bangalore', 'High-quality sound', '../Products-img/electronics.png', '2025-02-09 22:53:37', 'electronics'),
(68, 2, 'Yamaha R15', 200000.00, 'Delhi', 'Sporty bike', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(69, 6, 'Royal Enfield', 250000.00, 'Mumbai', 'Classic cruiser', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(70, 3, 'KTM Duke 390', 320000.00, 'Pune', 'Performance street bike', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(71, 1, 'Bajaj Pulsar 220', 150000.00, 'Chennai', 'Best budget sports bike', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(72, 4, 'Honda Activa', 80000.00, 'Bangalore', 'Top-selling scooter', '../Products-img/bikes.png', '2025-02-09 22:53:37', 'bikes'),
(78, 6, 'Rich Dad Poor Dad', 500.00, 'Delhi', 'Financial literacy book', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(79, 1, 'The Alchemist', 400.00, 'Mumbai', 'Motivational novel', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(80, 2, 'Atomic Habits', 600.00, 'Pune', 'Self-improvement book', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(81, 3, 'Harry Potter', 800.00, 'Chennai', 'Fiction novel series', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(82, 4, 'The Lean Startup', 700.00, 'Bangalore', 'Entrepreneurship book', '../Products-img/books.png', '2025-02-09 22:53:37', 'books'),
(83, 3, 'Cannon D500', 13000.00, 'jalgaon', NULL, '../Products-img/67a8eab951a24-camera.jpg', '2025-02-09 18:49:45', 'electronics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`UID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
