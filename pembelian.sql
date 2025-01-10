-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 07:27 PM
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
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `voucher_name`, `voucher_price`, `email`, `whatsapp_number`, `payment_method`, `username`, `password`, `created_at`, `start_time`, `end_time`) VALUES
(1, 'Paket 12 Jam', 5000.00, '124@gmail.com', '2199318241', 'qris', 'eowxA', '322', '2025-01-09 12:51:14', NULL, NULL),
(2, 'Paket 12 Jam', 5000.00, '124@gmail.com', '2199318241', 'qris', 'xxeMC', '310', '2025-01-09 12:51:27', NULL, NULL),
(3, 'Paket 12 Jam', 5000.00, '456@gmail.com', '2199318241', 'qris', 'v42dI', '207', '2025-01-09 13:05:05', NULL, NULL),
(18, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '879789', 'transfer', 'nkihc', '540', '2025-01-10 16:58:16', NULL, NULL),
(19, 'Paket 12 Jam', 5000.00, 'akayaje@gmail.com', '0989231712', 'transfer', 'IWNGU', '680', '2025-01-10 16:59:52', NULL, NULL),
(20, 'Paket 7 Hari', 20000.00, 'axeman2134@gmail.com', '132313', 'transfer', 'ngEYH', '507', '2025-01-10 17:08:45', '2025-01-10 18:08:45', '2025-01-17 18:08:45'),
(21, 'Paket 7 Hari', 20000.00, 'axeman2134@gmail.com', '12412412', 'transfer', 'YGgms', '531', '2025-01-10 17:14:31', '2025-01-10 18:14:31', '2025-01-17 18:14:31'),
(22, 'Paket 12 Jam', 5000.00, 'akayaje@gmail.com', '231232123', 'transfer', 'ScEwL', '704', '2025-01-10 17:20:30', '2025-01-10 18:20:30', '2025-01-11 06:20:30'),
(23, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '08973172', 'transfer', '8bYTN', '126', '2025-01-10 17:30:23', '2025-01-10 18:30:23', '2025-01-11 06:30:23'),
(25, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '08973172', 'transfer', 'GQZhN', '625', '2025-01-10 17:31:12', '2025-01-10 18:31:12', '2025-01-11 06:31:12'),
(27, 'Paket 30 Hari', 50000.00, 'akayaje@gmail.com', '213123213', 'transfer', '7RvEy', '819', '2025-01-10 17:41:06', '2025-01-10 18:41:06', '2025-02-09 18:41:06'),
(28, 'Paket 7 Hari', 20000.00, 'akayaje@gmail.com', '0989231712', 'transfer', 'NQy8M', '077', '2025-01-10 17:41:47', '2025-01-10 18:41:47', '2025-01-17 18:41:47'),
(30, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'transfer', 'smkQY', '312', '2025-01-10 18:17:53', '2025-01-10 19:17:53', '2025-01-11 07:17:53'),
(31, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'qris', 'JCqDL', '825', '2025-01-10 18:19:02', '2025-01-10 19:19:02', '2025-01-11 07:19:02'),
(32, 'Paket 12 Jam', 5000.00, 'axeman2134@gmail.com', '12312412', 'transfer', '5ca8d', '7ee', '2025-01-10 18:26:19', '2025-01-10 19:26:35', '2025-01-11 07:26:35');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
