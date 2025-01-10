-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 02:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akun`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `pricing_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `payment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `voucher_price` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `whatsapp_number` varchar(15) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `username` varchar(5) NOT NULL,
  `password` char(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `voucher_name`, `voucher_price`, `email`, `whatsapp_number`, `payment_method`, `username`, `password`, `created_at`) VALUES
(1, 'Paket 12 Jam', 5000.00, '124@gmail.com', '2199318241', 'qris', 'eowxA', '322', '2025-01-09 12:51:14'),
(2, 'Paket 12 Jam', 5000.00, '124@gmail.com', '2199318241', 'qris', 'xxeMC', '310', '2025-01-09 12:51:27'),
(3, 'Paket 12 Jam', 5000.00, '456@gmail.com', '2199318241', 'qris', 'v42dI', '207', '2025-01-09 13:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_voucher`
--

CREATE TABLE `pembelian_voucher` (
  `id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `voucher_price` decimal(10,2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `whatsapp_number` varchar(15) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `voucher_code` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid_from` datetime DEFAULT current_timestamp(),
  `valid_until` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_voucher`
--

INSERT INTO `pembelian_voucher` (`id`, `voucher_name`, `voucher_price`, `email`, `whatsapp_number`, `payment_method`, `voucher_code`, `created_at`, `valid_from`, `valid_until`) VALUES
(3, 'Paket 7 Hari', 20000.00, 'olinkotlin@gmail.com', '0987637182', 'transfer', 'VCH-677F4DA961C88', '2025-01-09 04:16:41', '2025-01-09 11:16:41', NULL),
(4, 'Paket 12 Jam', 5000.00, 'olinkotlin@gmail.com', '2199318241', 'transfer', 'VCH-677F4DF2C6688', '2025-01-09 04:17:54', '2025-01-09 11:17:54', NULL),
(5, 'Paket 12 Jam', 5000.00, '456@gmail.com', '2199318241', 'transfer', 'VCH-677F4E6B654F8', '2025-01-09 04:19:55', '2025-01-09 11:19:55', NULL),
(6, 'Paket 12 Jam', 5000.00, '124@gmail.com', '2199318241', 'transfer', 'VCH-677FC03326F03', '2025-01-09 12:25:23', '2025-01-09 19:25:23', NULL),
(7, 'Paket 12 Jam', 5000.00, '124@gmail.com', '2199318241', 'qris', 'VCH-677FC43BCE74B', '2025-01-09 12:42:35', '2025-01-09 19:42:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `name`, `price`, `description`) VALUES
(2, 'Standard', 50.00, 'Up to 50 Mbps, 5 devices, priority support'),
(3, 'Premium', 80.00, 'Up to 100 Mbps, 10 devices, 24/7 premium support');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'axeman2134', '$2y$10$zjMyXk4C81MKHyVZA86Be.XkTKMj/hWpnUp8FVzsZ1vCKwnxF7FvC', 'axeman2134@gmail.com'),
(2, 'al', '$2y$10$txpFRD.oKtwhyPLOyAk0YemeExiuw9RKEyeqx48j.ALbzMCAvNEIa', 'yarsiprojek@gmail.com'),
(4, 'olin', '$2y$10$nNcePmpQegi/dAmWcn03ouuE3Kc4FZCLZiVTjZNr4IC1tbgZfdwce', '1234@gmail.com'),
(5, 'tegaryu', '$2y$10$iuZq4dujUCov7eT7oLnFGuEezPXrJ3s8ojpLKgxfMKZo0dLTXXBh.', '456@gmail.com'),
(6, 'rajesh', '$2y$10$afKofGltOJvwLdPeyMunXO7rp5b2C1DNqNUc/4uukHAruM2CupjiO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pricing_id` (`pricing_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pembelian_voucher`
--
ALTER TABLE `pembelian_voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_code` (`voucher_code`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembelian_voucher`
--
ALTER TABLE `pembelian_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`pricing_id`) REFERENCES `pricing` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
