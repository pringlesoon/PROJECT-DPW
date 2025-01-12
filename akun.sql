-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 06:52 PM
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
-- Database: `akun`
--

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` enum('Pending','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `voucher_name`, `voucher_price`, `email`, `whatsapp_number`, `payment_method`, `username`, `password`, `created_at`, `start_time`, `end_time`, `status`) VALUES
(93, 'Paket 12 Jam', 5000.00, 'akayaje@gmail.com', '0989231712', 'transfer', '', '', '2025-01-12 17:44:06', NULL, NULL, 'Pending'),
(95, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '0989231712', 'qris', '4437b', 'c5c', '2025-01-12 17:50:10', '2025-01-12 18:50:10', '2025-01-19 18:50:10', 'Completed'),
(96, 'Paket 12 Jam', 5000.00, 'akayaje@gmail.com', '0989231712', 'transfer', 'f60d6', '187', '2025-01-12 17:50:25', '2025-01-12 18:50:25', '2025-01-13 06:50:25', 'Completed'),
(97, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '12312412', 'transfer', '3e6aa', '89a', '2025-01-12 17:50:38', '2025-01-12 18:50:38', '2025-01-19 18:50:38', 'Completed'),
(98, 'Paket 12 Jam', 5000.00, 'akayaje@gmail.com', '0989231712', 'qris', '', '', '2025-01-12 17:51:34', '2025-01-12 18:51:34', '2025-01-13 06:51:34', 'Pending');

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
(6, 'rajesh', '$2y$10$afKofGltOJvwLdPeyMunXO7rp5b2C1DNqNUc/4uukHAruM2CupjiO', ''),
(7, 'yarsi', '$2y$10$urwe/l.ZUBNovzL/fLBE/uaCtOKyDgFEEEAWPwLoy6yEkoSBS/5we', 'axeman211234@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_2` (`username`);

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
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
