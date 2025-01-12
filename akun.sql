-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 08:43 PM
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
  `status` enum('Pending','Completed') DEFAULT 'Pending',
  `status_voucher` varchar(50) DEFAULT 'Belum digunakan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `voucher_name`, `voucher_price`, `email`, `whatsapp_number`, `payment_method`, `username`, `password`, `created_at`, `start_time`, `end_time`, `status`, `status_voucher`) VALUES
(60, 'Paket 12 Jam', 5000.00, 'yogapandu@gmail.com', '081231241241941', 'transfer', '677c1', '2a4', '2025-01-12 19:23:32', '2025-01-12 20:23:37', '2025-01-13 08:23:37', 'Completed', 'Belum digunakan'),
(62, 'Paket 7 Hari', 20000.00, 'yogapandu@gmail.com', '01831321412', 'qris', '28366', '1e7', '2025-01-12 19:24:41', '2025-01-12 20:24:41', '2025-01-19 20:24:41', 'Completed', 'Belum digunakan');

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
(7, 'yarsi', '$2y$10$urwe/l.ZUBNovzL/fLBE/uaCtOKyDgFEEEAWPwLoy6yEkoSBS/5we', 'axeman211234@gmail.com'),
(8, 'yoga', '$2y$10$AixIeOwacWnBHqHtfwb60OmMzvc5dqDVfLKc2edyHG9Afp7Z8mG8O', 'yogapandu@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
