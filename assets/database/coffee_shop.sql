-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 12:44 PM
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
-- Database: `coffee_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'Josiah Danielle Gallenero', 'admin@gmail.com', '$2y$10$NlH/TMscb5bYenhnigSPlOHfd4suFwLm8dqplNfQf76vPObf.NK/q');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `size` enum('12oz','16oz','22oz','solo','duo') DEFAULT '12oz',
  `addon` varchar(255) NOT NULL,
  `addon_price` float DEFAULT 0,
  `status` enum('Available','Out of Stock') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(15) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`) VALUES
(1, 'Hot Coffee', '2025-03-19 02:10:21'),
(2, 'Cold Coffee', '2025-03-19 03:16:32'),
(3, 'Hot Tea', '2025-03-19 05:12:35'),
(4, 'Breakfast', '2025-03-19 05:12:46'),
(5, 'Lunch', '2025-03-19 05:12:50'),
(6, 'Extra', '2025-03-19 05:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `delivery_fee` decimal(10,2) DEFAULT NULL,
  `payment_method` enum('cod','online') DEFAULT NULL,
  `delivery_method` enum('delivery','pickup') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('Pending','Processing','Completed','Cancelled','On the Way','Ready for Pickup') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `email`, `fullname`, `total`, `tax`, `delivery_fee`, `payment_method`, `delivery_method`, `address`, `city`, `region`, `zip`, `phone`, `notes`, `status`, `created_at`) VALUES
(66, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 302.00, 27.00, 50.00, 'cod', 'delivery', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Cancelled', '2025-03-20 11:52:05'),
(67, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 252.00, 27.00, 0.00, NULL, 'pickup', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Cancelled', '2025-03-20 11:52:57'),
(68, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 302.00, 27.00, 50.00, 'cod', 'delivery', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Cancelled', '2025-03-20 11:55:26'),
(74, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 252.00, 27.00, 0.00, NULL, 'pickup', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Completed', '2025-03-21 00:49:33'),
(75, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 229.60, 24.60, 0.00, NULL, 'pickup', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Completed', '2025-03-21 13:17:54'),
(76, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 168.00, 18.00, 0.00, NULL, 'pickup', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Ready for Pickup', '2025-03-22 02:03:58'),
(77, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 358.00, 33.00, 50.00, 'cod', 'delivery', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Processing', '2025-03-22 04:37:36'),
(78, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 224.00, 24.00, 0.00, NULL, 'pickup', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Processing', '2025-03-22 12:04:19'),
(79, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 224.00, 24.00, 0.00, NULL, 'pickup', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Pending', '2025-03-22 12:10:29'),
(80, 5, 'josiahdanielle09gallenero@gmail.com', 'Josiah Danielle Gallenero', 274.00, 24.00, 50.00, 'cod', 'delivery', 'Zone 2, Avancena Street Molo', 'City', 'Iloilo', '5000', '09100616716', '', 'Pending', '2025-03-22 12:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `addon_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `subtotal`, `addon_price`) VALUES
(59, 66, 1, 200.00, 1, NULL, 25.00),
(60, 67, 1, 200.00, 1, NULL, 25.00),
(61, 68, 1, 200.00, 1, NULL, 25.00),
(62, 74, 1, 200.00, 1, NULL, 25.00),
(63, 75, 1, 200.00, 1, NULL, 5.00),
(64, 76, 1, 150.00, 1, NULL, 0.00),
(65, 77, 1, 200.00, 1, NULL, 75.00),
(66, 78, 1, 200.00, 1, NULL, 0.00),
(67, 79, 1, 200.00, 1, NULL, 0.00),
(68, 80, 1, 200.00, 1, NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Available','Out of Stock') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `category`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'testdsadsadsa', 'dasdasasdas', 150.00, 'Hot Coffee', 'assets/images/uploads/Hot Coffee/1742353648_l.png', 'Available', '2025-03-19 03:07:28', '2025-03-21 03:01:03'),
(2, 'test', 'dsadasdasdas', 31.00, 'Hot Coffee', 'assets/images/uploads/Hot Coffee/1742353659_m.png', 'Available', '2025-03-19 03:07:39', '2025-03-19 03:07:39'),
(3, 'czczczxczxc', 'dsadasdsadas', 31.00, 'Hot Coffee', 'assets/images/uploads/Hot Coffee/1742353670_s.png', 'Available', '2025-03-19 03:07:50', '2025-03-19 03:07:50'),
(4, 'testdsadsadsa', 'dsadsdsad', 31.00, 'Hot Coffee', 'assets/images/uploads/Hot Coffee/1742353679_s.png', 'Available', '2025-03-19 03:07:59', '2025-03-19 03:07:59'),
(5, 'Christine', 'dsadasdasda', 1500.00, 'Hot Coffee', 'assets/images/uploads/Hot Coffee/1742354616_logo.png', 'Available', '2025-03-19 03:23:36', '2025-03-19 03:23:36'),
(6, 'Matcha Tae', 'Matcha Tae is the best coffee in the molo', 100.00, 'Cold Coffee', 'assets/images/uploads/Ice Coffee/1742361204_hero.png', 'Available', '2025-03-19 05:13:24', '2025-03-19 05:13:24'),
(7, 'Shopping Bag', 'My shopping bag is the best', 50.00, 'Extra', 'assets/images/uploads/Extra/1742361232_logo.png', 'Available', '2025-03-19 05:13:52', '2025-03-19 05:13:52'),
(8, 'testdsadsadsa', '31231', 123.00, 'Hot Tea', 'assets/images/uploads/Hot Tea/1742362865_hero.png', 'Available', '2025-03-19 05:41:05', '2025-03-19 05:41:05'),
(9, 'dsadsa', 'dasda', 31.00, 'Breakfast', 'assets/images/uploads/Breakfast/1742362877_auth.png', 'Available', '2025-03-19 05:41:17', '2025-03-19 05:41:17'),
(10, 'dsadasdas', 'dsadasds', 123.00, 'Lunch', 'assets/images/uploads/Lunch/1742362893_hero.png', 'Available', '2025-03-19 05:41:33', '2025-03-19 05:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `created_at`) VALUES
(5, 'Josiah Danielle Gallenero', 'josiahdanielle09gallenero@gmail.com', '$2y$10$iZ.SxiNU1wePxa0K6AsUjOE6KfmtuG3ybxGLQF/wZ8iwFeAUyYQrW', '2025-03-18 16:21:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`category_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
