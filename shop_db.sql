-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 01:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
-- product : mobiles

CREATE TABLE `mobiles` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Battery` VARCHAR(100) NOT NULL,
  `RAM` VARCHAR(100) NOT NULL,
  `ROM` VARCHAR(100) NOT NULL,
  `Screen` VARCHAR(100) NOT NULL,
  `Camera` VARCHAR(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- product : laptopbags
CREATE TABLE `laptopbags` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Color` VARCHAR(100) NOT NULL,
  `Weight` VARCHAR(100) NOT NULL,
  `Width` VARCHAR(100) NOT NULL,
  `Height` VARCHAR(100) NOT NULL,
  `Depth` VARCHAR(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- product : grocery_products
CREATE TABLE `grocery_products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Weight` VARCHAR(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- product : footwear
CREATE TABLE `footwear`(
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `size` varchar (100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- product : ea
CREATE TABLE `ea`(
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `Weight` varchar(100) NOT NULL,
  `Warranty` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- product : beauty_product
CREATE TABLE `beauty_product`(
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `Weight` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `ratings`

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL,
  `created at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--product : mobiles

ALTER TABLE `mobiles`
  ADD PRIMARY KEY (`id`);

-- product : laptopbags

ALTER TABLE `laptopbags`
  ADD PRIMARY KEY (`id`);

-- product : grocery_products

ALTER TABLE `grocery_products`
  ADD PRIMARY KEY (`id`);

-- product : footwear

ALTER TABLE `footwear`
  ADD PRIMARY KEY (`id`);

-- product : ea

ALTER TABLE `ea`
  ADD PRIMARY KEY (`id`);

-- product : beauty_product

ALTER TABLE `beauty_product`
  ADD PRIMARY KEY (`id`);


-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--product : mobiles

ALTER TABLE `mobiles`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--product : laptopbags
ALTER TABLE `laptopbags`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--product : grocery_products
ALTER TABLE `grocery_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--product : footwear
ALTER TABLE `footwear`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--product : ea
ALTER TABLE `ea`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--product : beauty_products
ALTER TABLE `beauty_product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
