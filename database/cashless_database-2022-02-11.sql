-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 08:14 AM
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
(4, '', '$2y$10$DHOzg2a7VWsMkQXHZ7sUUu3OjQ.TQUDmwqwJO6Dv5iGt1YDBfd2A.', 1, 'JASON', 'PINEDA', 'soundtech007@gmail.com', '09000000000', 1, '0'),
(13, '', '$2y$10$CfMROZI0EvlwnmgdIc9h2.WBG0mKEmiYRic58Dnnyqd3cGfME94TC', 2, 'Jason', ' Pineda', 'jc@gmail.com', '09000000000', 1, '909'),
(14, '', '$2y$10$fJvC5jRVQH4RSHWay6kEv..YXUxYtYmujZLhBnf/UmqnSYoVVoSj2', 2, 'Paupau', 'Cold', 'paumarimla@gmail.com', '09123456789', 1, '2910'),
(15, '', '$2y$10$hE1VW9FOhQW6U3jabdyCEedMRsPYzvrpQHn3WQ/ROUef1YZ1lbgSa', 2, 'Lhen', 'Erana', 'lhenerana@gmail.com', '09275445854', 1, '1000'),
(16, '', '$2y$10$TGYSwi.aZuFgt5/gecHIE.X6vArmoQXXm9UI9hDu3hWJyn4YVTP3e', 2, 'MARK', 'CRUZ', 'mark@gmail.com', '09271274477', 1, '1000'),
(17, '', '$2y$10$hv3d9KqaPdOvbWiFwXAQPeTs.J8aod26BqLxDQcWfVHOjrtaI44hC', 2, 'Sara', 'Smith', 'sarasmith@gmail.com', '09271267778', 1, '1000'),
(18, 'vendor', '$2y$10$BFzaFb8UHuithQH2yKdTBuChuUenSOWQGy628Myuj/QlsI/WVDWn.', 3, 'vendor', 'vendor', 'vendor', '1234567890', 1, '26');

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
(4, 1, 1234567890, '2022-01-22 21:39:41', '0000-00-00 00:00:00', 0),
(5, 1, 2147483647, '2022-01-22 21:51:41', '0000-00-00 00:00:00', 0),
(14, 13, 7032910, '2022-02-03 13:11:59', '0000-00-00 00:00:00', 0),
(15, 14, 2520552, '2022-02-03 15:49:20', '0000-00-00 00:00:00', 0),
(16, 13, 2840999, '2022-02-03 15:58:35', '0000-00-00 00:00:00', 0),
(17, 16, 3126272, '2022-02-08 11:08:24', '0000-00-00 00:00:00', 0),
(18, 17, 2862627, '2022-02-09 16:33:38', '0000-00-00 00:00:00', 0);

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
(21, 13, '2022-02-03 13:12:11', '1000'),
(22, 14, '2022-02-03 15:51:25', '3000'),
(23, 13, '2022-02-03 15:58:59', '1000'),
(24, 15, '2022-02-03 16:00:13', '1000'),
(25, 16, '2022-02-08 11:11:13', '1000'),
(26, 17, '2022-02-09 16:34:51', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `cash_out`
--

CREATE TABLE `cash_out` (
  `id` int(11) NOT NULL,
  `vendor_id` int(12) NOT NULL,
  `reference_id` varchar(32) NOT NULL,
  `amount` text NOT NULL,
  `date_initiated` datetime NOT NULL DEFAULT current_timestamp(),
  `date_completed` datetime NOT NULL DEFAULT current_timestamp(),
  `completed` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_out`
--

INSERT INTO `cash_out` (`id`, `vendor_id`, `reference_id`, `amount`, `date_initiated`, `date_completed`, `completed`) VALUES
(1, 18, 'Z9B4502MB', '50', '2022-02-11 14:30:15', '2022-02-11 14:55:25', 2),
(2, 18, 'MCWE1GFPX', '70', '2022-02-11 14:31:13', '2022-02-11 14:57:41', 1),
(3, 18, 'P7SJ2ONGO', '20', '2022-02-11 15:05:08', '2022-02-11 15:05:08', 0);

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
  `market_original_price` decimal(12,2) NOT NULL,
  `vendor_id` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `barcode`, `item_code`, `item_name`, `qty`, `item_description`, `item_price`, `market_original_price`, `vendor_id`) VALUES
(1, '00000', '001', 'Math NoteBook', 20, 'Math NoteBook', '60.00', '60.00', 1),
(2, '00000', '002', 'Journal Notebook', 20, 'Journal Notebook', '55.00', '55.00', 1),
(3, '00000', '003', 'Composition NB', 20, 'Composition NB', '55.00', '55.00', 1),
(4, '00000', '004', 'Long Pad', 20, 'Long Pad', '44.00', '44.00', 1),
(5, '00000', '005', 'G1- G3 Pad Paper', 20, 'G1 -G3 Pad Paper', '33.00', '33.00', 1),
(6, '00000', '006', 'Illustration Board 1/8', 20, 'Illustration Board 1/8', '10.00', '10.00', 1),
(7, '00000', '007', 'Illustration Board 1/2', 20, 'Illustration Board 1/2', '30.00', '30.00', 1),
(8, '00000', '008', 'Manila Paper', 20, 'Manila Paper', '4.50', '4.50', 1),
(9, '00000', '009', 'Marker Monami', 20, 'Marker Monami', '30.00', '30.00', 1),
(10, '00000', '010', 'Oil Pastel', 25, 'Oil Pastel ', '33.00', '33.00', 1),
(11, '00000', '011', 'Crayola#16', 20, 'Crayola#16', '45.00', '45.00', 1),
(12, '00000', '012', 'Crayola#24', 20, 'Crayola#24', '60.00', '60.00', 1),
(13, '00000', '013', 'Black Ballpen(HBW)', 20, 'Black Ballpen(HBW)', '7.00', '7.00', 1),
(14, '00000', '014', 'RED BALLPEN(HBW)', 20, 'RED BALLPEN(HBW)', '7.00', '7.00', 1),
(15, '00000', '015', 'BrownEnvelope(long)', 20, 'BrownEnvelope(long)', '5.00', '5.00', 1),
(16, '00000', '016', 'BrownEnvelope(short)', 20, 'BrownEnvelope(short)', '3.00', '3.00', 1),
(17, '00000', '017', 'Correction Tape', 20, 'Correction Tape', '30.00', '30.00', 1),
(18, '00000', '018', 'Cartolina(black)', 20, 'Cartolina(black)', '10.00', '10.00', 1),
(19, '00000', '019', 'Cartolina(white)', 20, 'Cartolina(white)', '7.00', '7.00', 1),
(20, '00000', '020', 'Plastic Cover', 20, 'Plastic Cover', '10.00', '10.00', 1),
(21, '00000', '001', 'Ballpen', -7, 'Sample lang na ballpen ito', '6.00', '5.00', 18);

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
(39, 1, 3000, '2022-02-03'),
(40, 2, 1100, '2022-02-03'),
(41, 3, 1100, '2022-02-03'),
(42, 4, 880, '2022-02-03'),
(43, 5, 660, '2022-02-03'),
(44, 6, 200, '2022-02-03'),
(45, 7, 600, '2022-02-03'),
(46, 8, 90, '2022-02-03'),
(47, 9, 600, '2022-02-03'),
(48, 10, 660, '2022-02-03'),
(49, 11, 900, '2022-02-03'),
(50, 12, 1200, '2022-02-03'),
(51, 13, 140, '2022-02-03'),
(52, 14, 140, '2022-02-03'),
(53, 15, 100, '2022-02-03'),
(54, 16, 60, '2022-02-03'),
(55, 17, 600, '2022-02-03'),
(56, 18, 200, '2022-02-03'),
(57, 19, 140, '2022-02-03'),
(58, 20, 200, '2022-02-03'),
(59, 19, 0, '2022-02-03'),
(60, 1, 0, '2022-02-03'),
(61, 10, 0, '2022-02-03'),
(62, 10, 330, '2022-02-03'),
(63, 10, 165, '2022-02-03'),
(64, 8, 90, '2022-02-03'),
(65, 21, 50, '2022-02-11');

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
  `account_id` int(12) NOT NULL DEFAULT 1,
  `vendor_id` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `full_name`, `transaction_date`, `address`, `phone_num`, `total_amount`, `amount_paid`, `account_id`, `vendor_id`) VALUES
(1, 'Juan Cruz', '2020-08-08', 'Angeles City', '09090912098', '144.00', '144.00', 1, 1),
(3, 'Juan Cruz121212', '2020-08-11', 'Angeles City', '09090912098', '144.00', '144.00', 1, 1),
(5, 'Juan Cruz', '2020-08-11', 'Angeles City', '09090912098', '4385.00', '4385.00', 1, 1),
(6, 'Juan Cruz', '2021-06-05', 'Angeles City', '09090912098', '22620.00', '22620.00', 1, 1),
(7, 'Juan Cruz', '2022-01-28', 'Angeles City', '09090912098', '24.00', '50.00', 1, 1),
(8, 'Jason  Pineda', '2022-02-03', 'NA', '09000000000', '5.00', '5.00', 13, 1),
(9, 'Jason  Pineda', '2022-02-03', 'NA', '09000000000', '990.00', '990.00', 13, 1),
(10, 'Paupau Cold', '2022-02-03', 'NA', '09123456789', '90.00', '90.00', 14, 1),
(11, 'Jason  Pineda', '2022-02-11', 'NA', '09000000000', '6.00', '6.00', 13, 18),
(12, 'Jason  Pineda', '2022-02-11', 'NA', '09000000000', '30.00', '30.00', 13, 18),
(13, 'Jason  Pineda', '2022-02-11', 'NA', '09000000000', '60.00', '60.00', 13, 18);

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
  `subtotal` decimal(12,2) NOT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lists`
--

INSERT INTO `transaction_lists` (`id`, `transaction_id`, `item_id`, `qty`, `adjusted_price`, `transaction_date`, `subtotal`, `vendor_id`) VALUES
(59, 9, 10, 30, '33.00', '2022-02-03', '990.00', 1),
(60, 10, 8, 20, '4.50', '2022-02-03', '90.00', 1),
(61, 1, 21, 1, '6.00', '2022-02-11', '6.00', 18),
(64, 11, 21, 1, '6.00', '2022-02-11', '6.00', 18),
(65, 12, 21, 5, '6.00', '2022-02-11', '30.00', 18),
(66, 13, 21, 10, '6.00', '2022-02-11', '60.00', 18);

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
(25, 13, 'cashin', '1000', '2022-02-03 13:12:11', '1000'),
(26, 13, 'buy', '5', '2022-02-03 13:36:42', '995'),
(27, 13, 'buy', '990', '2022-02-03 15:44:00', '5'),
(28, 14, 'cashin', '3000', '2022-02-03 15:51:25', '3000'),
(29, 14, 'buy', '90', '2022-02-03 15:52:46', '2910'),
(30, 13, 'cashin', '1000', '2022-02-03 15:58:59', '1005'),
(31, 15, 'cashin', '1000', '2022-02-03 16:00:13', '1000'),
(32, 16, 'cashin', '1000', '2022-02-08 11:11:13', '1000'),
(33, 17, 'cashin', '1000', '2022-02-09 16:34:51', '1000'),
(34, 13, 'buy', '6', '2022-02-11 13:39:05', '999'),
(35, 13, 'buy', '30', '2022-02-11 13:46:13', '969'),
(36, 13, 'buy', '60', '2022-02-11 13:47:52', '909');

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
-- Indexes for table `cash_out`
--
ALTER TABLE `cash_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

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
  ADD KEY `account_id` (`account_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `transaction_lists`
--
ALTER TABLE `transaction_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `transaction_id` (`transaction_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cash_in_transaction`
--
ALTER TABLE `cash_in_transaction`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cash_out`
--
ALTER TABLE `cash_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction_lists`
--
ALTER TABLE `transaction_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
-- Constraints for table `cash_out`
--
ALTER TABLE `cash_out`
  ADD CONSTRAINT `cash_out_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  ADD CONSTRAINT `inventory_cost_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_lists`
--
ALTER TABLE `transaction_lists`
  ADD CONSTRAINT `transaction_lists_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_lists_ibfk_3` FOREIGN KEY (`vendor_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_logs`
--
ALTER TABLE `transaction_logs`
  ADD CONSTRAINT `transaction_logs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
