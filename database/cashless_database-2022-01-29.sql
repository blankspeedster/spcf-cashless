-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 07:26 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cashless_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(12) NOT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `phone_number` varchar(24) NOT NULL,
  `validated` int(1) NOT NULL DEFAULT 1,
  `balance` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `role_id`, `first_name`, `last_name`, `email`, `phone_number`, `validated`, `balance`) VALUES
(1, 'admin', '$2y$10$BFzaFb8UHuithQH2yKdTBuChuUenSOWQGy628Myuj/QlsI/WVDWn.', 1, 'Admin', 'Admin', 'admin', '1234567890', 1, '0'),
(2, 'karlo', '$2y$10$BFzaFb8UHuithQH2yKdTBuChuUenSOWQGy628Myuj/QlsI/WVDWn.', 2, 'Karlo', 'Karlo', 'karlo@karlo.com', '1234567891', 1, '940'),
(3, 'marky@marky.com', '$2y$10$myPzLUZJMqFNN9OkO7JnsOKlIwjHox.QX/P9vKK7ASyon0TvCo2WS', 3, 'Marky', 'Marky', 'marky@marky.com', '09000000000', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag_number` int(32) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `tag_number`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 2, 123123121, '2021-12-07 23:48:12', '0000-00-00 00:00:00', 1),
(2, 2, 123123123, '2021-12-07 23:48:39', '0000-00-00 00:00:00', 0),
(3, 2, 123123120, '2021-12-07 23:57:06', '0000-00-00 00:00:00', 0),
(4, 1, 1234567890, '2022-01-22 21:39:41', '0000-00-00 00:00:00', 0),
(5, 1, 2147483647, '2022-01-22 21:51:41', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash_in_transaction`
--

CREATE TABLE `cash_in_transaction` (
  `id` int(12) NOT NULL,
  `account_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_in_transaction`
--

INSERT INTO `cash_in_transaction` (`id`, `account_id`, `created_at`, `amount`) VALUES
(7, 2, '2022-01-29 10:15:53', '1000.2'),
(8, 2, '2022-01-29 10:16:09', '1.98'),
(9, 2, '2022-01-29 13:25:55', '100'),
(10, 2, '2022-01-29 13:30:00', '100'),
(11, 2, '2022-01-29 14:01:22', '1000'),
(12, 2, '2022-01-29 14:11:23', '1000'),
(13, 2, '2022-01-29 14:12:54', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `item_code` varchar(128) NOT NULL,
  `item_name` varchar(256) NOT NULL,
  `qty` int(12) NOT NULL,
  `item_description` text NOT NULL,
  `item_price` decimal(12,2) NOT NULL,
  `market_original_price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `barcode`, `item_code`, `item_name`, `qty`, `item_description`, `item_price`, `market_original_price`) VALUES
(1, '09151215325', 'S-ITEM', 'Sample Item', -55, 'desc', '12.00', '18.00'),
(2, '23523521', 'bareta', 'bareta_bareta', 101, 'sample', '20.00', '10.00'),
(3, '0981241535235', 'dishwasher', 'dishwash', -80, 'sample', '90.00', '10.00'),
(4, '0256242523', 'shampoo', 'sun silk', 100, 'Shampopo', '9.00', '7.00'),
(5, '098989898989', 'COMP-RAM', '2GB ATI DDR2 RAM MODULE', 5, 'For Old Computers', '250.00', '100.00'),
(6, '525252352352', 'COMP-HEATSINK', 'ATI HEAT SINK FAN', 10, 'FOR OLD COMPUTERS', '70.00', '50.00'),
(7, '35009124124153', 'MED', 'BAND AID ', -10, 'for small scratches', '7.00', '5.00'),
(8, '00000', '123', '123', 133, 'asdfg sadfg sdfg', '123.00', '123.00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_cost`
--

CREATE TABLE `inventory_cost` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `total_cost` int(12) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_cost`
--

INSERT INTO `inventory_cost` (`id`, `item_id`, `total_cost`, `date_added`) VALUES
(3, 1, 12, '2020-07-06'),
(4, 2, 200, '2020-07-31'),
(5, 3, 22, '2020-07-31'),
(6, 2, 100, '2020-08-11'),
(7, 4, 100, '2020-08-11'),
(10, 5, 400, '2021-06-05'),
(11, 5, 0, '2021-06-05'),
(12, 5, 1000, '2021-06-05'),
(13, 5, 2000, '2021-06-05'),
(14, 4, 0, '2021-06-05'),
(15, 1, 20000, '2021-06-05'),
(16, 5, 300, '2021-06-05'),
(17, 6, 7000, '2021-06-05'),
(18, 7, 364, '2021-06-05'),
(19, 7, 420, '2021-06-05'),
(20, 2, 0, '2021-06-05'),
(21, 3, 20000, '2021-06-05'),
(22, 8, 123, '2022-01-29'),
(23, 8, 0, '2022-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(12) NOT NULL,
  `code` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `code`, `description`) VALUES
(1, 'admin', 'admin role for the site'),
(2, 'student', 'default user for the web app'),
(3, 'vendor', 'store owner');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `full_name` varchar(256) NOT NULL,
  `transaction_date` date NOT NULL,
  `address` varchar(256) NOT NULL,
  `phone_num` varchar(256) NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `amount_paid` decimal(12,2) NOT NULL,
  `account_id` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `full_name`, `transaction_date`, `address`, `phone_num`, `total_amount`, `amount_paid`, `account_id`) VALUES
(1, 'Juan Cruz', '2020-08-08', 'Angeles City', '09090912098', '144.00', '144.00', 1),
(3, 'Juan Cruz121212', '2020-08-11', 'Angeles City', '09090912098', '144.00', '144.00', 1),
(5, 'Juan Cruz', '2020-08-11', 'Angeles City', '09090912098', '4385.00', '4385.00', 1),
(6, 'Juan Cruz', '2021-06-05', 'Angeles City', '09090912098', '22620.00', '22620.00', 1),
(7, 'Juan Cruz', '2022-01-28', 'Angeles City', '09090912098', '24.00', '50.00', 1),
(8, '', '2022-01-29', '', '', '0.00', '0.00', 2),
(9, 'Karlo Karlo', '2022-01-29', 'NA', '1234567891', '24.00', '24.00', 2),
(10, 'Karlo Karlo', '2022-01-29', 'NA', '1234567891', '24.00', '24.00', 2),
(11, 'Karlo Karlo', '2022-01-29', 'NA', '1234567891', '120.00', '120.00', 2),
(12, 'Karlo Karlo', '2022-01-29', 'NA', '1234567891', '120.00', '120.00', 2),
(13, 'Karlo Karlo', '2022-01-29', 'NA', '1234567891', '120.00', '120.00', 2),
(14, 'Karlo Karlo', '2022-01-29', 'NA', '1234567891', '60.00', '60.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_lists`
--

CREATE TABLE `transaction_lists` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(12) NOT NULL,
  `adjusted_price` decimal(12,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lists`
--

INSERT INTO `transaction_lists` (`id`, `transaction_id`, `item_id`, `qty`, `adjusted_price`, `transaction_date`, `subtotal`) VALUES
(35, 1, 2, 12, '12.00', '2020-08-11', '144.00'),
(37, 3, 2, 12, '12.00', '2020-08-11', '144.00'),
(39, 5, 1, 52, '52.00', '2020-08-11', '2704.00'),
(40, 5, 2, 41, '41.00', '2020-08-11', '1681.00'),
(41, 6, 7, 70, '60.00', '2021-06-05', '4200.00'),
(42, 6, 3, 200, '50.00', '2021-06-05', '10000.00'),
(43, 6, 1, 20, '421.00', '2021-06-05', '8420.00'),
(44, 7, 1, 2, '12.00', '2022-01-28', '24.00'),
(45, 9, 1, 2, '12.00', '2022-01-29', '24.00'),
(46, 10, 1, 2, '12.00', '2022-01-29', '24.00'),
(47, 11, 1, 10, '12.00', '2022-01-29', '120.00'),
(48, 12, 1, 10, '12.00', '2022-01-29', '120.00'),
(49, 13, 1, 10, '12.00', '2022-01-29', '120.00'),
(50, 14, 1, 5, '12.00', '2022-01-29', '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` int(11) NOT NULL,
  `account_id` int(12) DEFAULT NULL,
  `kind` varchar(128) NOT NULL,
  `amount` tinytext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `current_balance` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `account_id`, `kind`, `amount`, `created_at`, `current_balance`) VALUES
(9, 2, 'cashin', '1000', '2022-01-29 14:12:54', '1000'),
(10, 2, 'buy', '60', '2022-01-29 14:13:13', '940');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role_id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cash_in_transaction`
--
ALTER TABLE `cash_in_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `transaction_lists`
--
ALTER TABLE `transaction_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_logs_ibfk_1` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cash_in_transaction`
--
ALTER TABLE `cash_in_transaction`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaction_lists`
--
ALTER TABLE `transaction_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cash_in_transaction`
--
ALTER TABLE `cash_in_transaction`
  ADD CONSTRAINT `cash_in_transaction_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  ADD CONSTRAINT `inventory_cost_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_lists`
--
ALTER TABLE `transaction_lists`
  ADD CONSTRAINT `transaction_lists_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD CONSTRAINT `transaction_logs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
