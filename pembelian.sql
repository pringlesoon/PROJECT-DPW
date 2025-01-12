-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 06:43 PM
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
(30, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'transfer', 'smkQY', '312', '2025-01-10 18:17:53', '2025-01-10 19:17:53', '2025-01-11 07:17:53', 'Pending'),
(31, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'qris', 'JCqDL', '825', '2025-01-10 18:19:02', '2025-01-10 19:19:02', '2025-01-11 07:19:02', 'Pending'),
(32, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'transfer', '5ca8d', '7ee', '2025-01-10 18:26:19', '2025-01-10 19:26:35', '2025-01-11 07:26:35', 'Pending'),
(36, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '12312412', 'transfer', 'wnMqP', '947', '2025-01-11 12:50:34', '2025-01-11 13:50:34', '2025-01-18 13:50:34', 'Pending'),
(37, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '0989231712', 'qris', 'DMmHd', '674', '2025-01-11 13:28:59', '2025-01-11 14:28:59', '2025-01-12 02:28:59', 'Completed'),
(38, 'Paket 12 Jam', 5000.00, 'akayaje@gmail.com', '0989231712', 'qris', 'PkFQx', '352', '2025-01-11 13:29:22', '2025-01-11 14:29:22', '2025-01-12 02:29:22', 'Completed'),
(39, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '12312412', 'transfer', '1e051', 'fd1', '2025-01-11 13:34:55', '2025-01-11 14:35:04', '2025-01-18 14:35:04', 'Pending'),
(41, 'Paket 7 Hari', 20000.00, 'axeman2134@gmail.com', '12312412', 'transfer', 'vuxAe', '748', '2025-01-11 13:41:46', '2025-01-11 14:41:46', '2025-01-18 14:41:46', 'Pending'),
(42, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '0989231712', 'transfer', 'RHSDo', '521', '2025-01-11 13:45:53', '2025-01-11 14:45:53', '2025-01-12 02:45:53', 'Pending'),
(43, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '3412412', 'transfer', 'esyYS', '845', '2025-01-11 15:34:41', '2025-01-11 16:34:41', '2025-01-18 16:34:41', 'Pending'),
(44, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'transfer', 'QxURf', '695', '2025-01-11 15:43:26', '2025-01-11 16:43:26', '2025-01-12 04:43:26', 'Pending'),
(45, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '0989231712', 'transfer', 'hCJID', '590', '2025-01-11 16:12:40', '2025-01-11 17:12:40', '2025-01-18 17:12:40', 'Pending'),
(46, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '0989231712', 'transfer', 'XPEIL', '891', '2025-01-11 16:13:08', '2025-01-11 17:13:08', '2025-01-12 05:13:08', 'Completed'),
(47, 'Paket 7 Hari', 20000.00, 'axeman2134@gmail.com', '0989231712', 'transfer', 'KrDUL', '927', '2025-01-11 16:21:38', '2025-01-11 17:21:38', '2025-01-18 17:21:38', 'Pending'),
(48, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '0989231712', 'transfer', 'VSXhd', '264', '2025-01-11 16:22:47', '2025-01-11 17:22:47', '2025-01-12 05:22:47', 'Pending'),
(50, 'Paket 30 Hari', 50000.00, 'akayaje@gmail.com', '0989231712', 'qris', 'TUSNn', '934', '2025-01-11 16:26:31', '2025-01-11 17:26:31', '2025-02-10 17:26:31', 'Completed'),
(52, 'Paket 12 Jam', 5000.00, 'akayaje@gmail.com', '0989231712', 'transfer', '1bfa0', 'b9d', '2025-01-11 16:34:53', '2025-01-11 17:35:03', '2025-01-12 05:35:03', 'Completed'),
(53, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'transfer', '2c85a', '4e8', '2025-01-11 16:36:01', '2025-01-11 17:36:01', '2025-01-12 05:36:01', 'Completed'),
(54, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '12312412', 'transfer', '0dfb0', 'a56', '2025-01-11 16:39:12', '2025-01-11 17:39:12', '2025-01-18 17:39:12', 'Completed'),
(55, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '0989231712', 'transfer', 'f4ca1', '52b', '2025-01-11 16:43:14', '2025-01-11 17:43:32', '2025-01-12 05:43:32', 'Completed'),
(56, 'Paket 12 Jam', 5000.00, 'tegas@gmail.com', '293123123', 'qris', 'e9cfa', '2e1', '2025-01-11 17:31:14', '2025-01-11 18:31:45', '2025-01-12 06:31:45', 'Completed'),
(57, 'Paket 12 Jam', 5000.00, 'tegas@gmail.com', '009831312', 'qris', '45453', '0ec', '2025-01-11 17:41:25', '2025-01-11 18:41:25', '2025-01-12 06:41:25', 'Completed');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
