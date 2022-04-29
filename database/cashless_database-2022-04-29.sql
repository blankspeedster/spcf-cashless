-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 05:54 AM
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
(1, 'admin', '$2y$10$BFzaFb8UHuithQH2yKdTBuChuUenSOWQGy628Myuj/QlsI/WVDWn.', 1, 'Admin', 'Admin', 'admin', '1234567890', 1, '1100'),
(4, '', '$2y$10$DHOzg2a7VWsMkQXHZ7sUUu3OjQ.TQUDmwqwJO6Dv5iGt1YDBfd2A.', 1, 'JASON', 'PINEDA', 'soundtech007@gmail.com', '09000000000', 1, '0'),
(14, '', '$2y$10$fJvC5jRVQH4RSHWay6kEv..YXUxYtYmujZLhBnf/UmqnSYoVVoSj2', 2, 'Paupau', 'Cold', 'paumarimla@gmail.com', '09123456789', 1, '2910'),
(15, '', '$2y$10$hE1VW9FOhQW6U3jabdyCEedMRsPYzvrpQHn3WQ/ROUef1YZ1lbgSa', 2, 'Lhen', 'Erana', 'lhenerana@gmail.com', '09275445854', 1, '1200'),
(16, '', '$2y$10$TGYSwi.aZuFgt5/gecHIE.X6vArmoQXXm9UI9hDu3hWJyn4YVTP3e', 2, 'MARK', 'CRUZ', 'mark@gmail.com', '09271274477', 1, '2400'),
(17, '', '$2y$10$hv3d9KqaPdOvbWiFwXAQPeTs.J8aod26BqLxDQcWfVHOjrtaI44hC', 2, 'Sara', 'Smith', 'sarasmith@gmail.com', '09271267778', 1, '1000'),
(19, '', '$2y$10$LxBbQ9fYr7iofHSml2a3X.fN2G7y1xICvfdug9T8zLq0rpdN2YBl.', 2, 'Karlo', 'Sotto', 'student', '09000000000', 1, '500'),
(20, '', '$2y$10$9rFApDysDiTW3LHuSVTwyeqVeSTOa8mXxLMf8GqBl6e5DGmvf3u1C', 3, 'SPCF Business', 'Center', 'businesscenter@gmail.com', '09000000000', 1, '0'),
(21, '', '$2y$10$nTI3Qwmkp9bfP4BsUS3BJuwFs4VgsLpLXj/qytI3Ebs/QcuFMEYFq', 2, 'JASON CARLO', 'PINEDA', 'jc101@gmail.com', '09000000000', 1, '300'),
(22, '', '$2y$10$/fAYhbMhxPZA8DNGJHHtO.N6w/cTibdyyK8zyd0iWqIzYuotiqJkK', 2, 'Manilyn', 'Erana', 'merana@gmail.com', '09271267431', 1, '1000'),
(23, '', '$2y$10$BFzaFb8UHuithQH2yKdTBuChuUenSOWQGy628Myuj/QlsI/WVDWn.', 3, 'SPCF', 'Canteen', 'spcfcanteen@gmail.com', '09000000000', 1, '8300'),
(24, '', '$2y$10$zCuA/.Bp4Ln7SIJzhGdZTO9JzseMSJvUaLYP/E4FpknA8GCEQOmwy', 2, 'Aj', 'Castro', 'ajajcast@gmail.com', '09155458491', 1, '1000'),
(25, '', '$2y$10$vJ/FHxgEd/ChFzTy95mRLuunw.I0NPyYfLgUxqfktKQhrXT0ZnV3W', 2, 'Ajaj', 'Castcast', 'aj@gmail.com', '09155458491', 1, '2000'),
(26, '', '$2y$10$obs1wpKYXDjDpBkcoX.DU.sObzmTqDsQpuqeeLgW/4FNlaldbVjYG', 2, 'Ronie', 'Bituin', 'ronieb03@gmail.com', '09000000000', 1, '12845');

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
(15, 14, 2520552, '2022-02-03 15:49:20', '0000-00-00 00:00:00', 0),
(17, 16, 3126272, '2022-02-08 11:08:24', '0000-00-00 00:00:00', 0),
(18, 17, 2862627, '2022-02-09 16:33:38', '0000-00-00 00:00:00', 0),
(20, 15, 7651875, '2022-04-20 08:13:42', '0000-00-00 00:00:00', 1),
(21, 15, 2876434, '2022-04-20 08:14:19', '0000-00-00 00:00:00', 1),
(22, 15, 7432430, '2022-04-20 08:15:41', '0000-00-00 00:00:00', 0),
(23, 24, 6966513, '2022-04-20 13:30:52', '0000-00-00 00:00:00', 0),
(24, 22, 8858405, '2022-04-20 13:47:20', '0000-00-00 00:00:00', 0),
(25, 25, 2840999, '2022-04-20 15:14:47', '0000-00-00 00:00:00', 0),
(26, 26, 123, '2022-04-25 10:01:17', '0000-00-00 00:00:00', 0),
(27, 21, 1111, '2022-04-25 12:07:10', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash_in_transaction`
--

CREATE TABLE `cash_in_transaction` (
  `id` int(12) NOT NULL,
  `account_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` tinytext NOT NULL,
  `new_balance` tinytext NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_in_transaction`
--

INSERT INTO `cash_in_transaction` (`id`, `account_id`, `created_at`, `amount`, `new_balance`, `updated_at`) VALUES
(22, 14, '2022-02-03 15:51:25', '3000', '', '2022-04-29 10:58:49'),
(24, 15, '2022-02-03 16:00:13', '1000', '', '2022-04-29 10:58:49'),
(25, 16, '2022-02-08 11:11:13', '1000', '', '2022-04-29 10:58:49'),
(26, 17, '2022-02-09 16:34:51', '1000', '', '2022-04-29 10:58:49'),
(27, 19, '2022-04-20 11:07:04', '500', '', '2022-04-29 10:58:49'),
(29, 21, '2022-04-20 13:04:12', '5000', '', '2022-04-29 10:58:49'),
(30, 21, '2022-04-20 13:09:55', '500', '', '2022-04-29 10:58:49'),
(31, 21, '2022-04-20 21:28:57', '1000', '', '2022-04-29 10:58:49'),
(32, 24, '2022-04-20 23:06:51', '1000', '', '2022-04-29 10:58:49'),
(33, 22, '2022-04-20 23:10:55', '1000', '', '2022-04-29 10:58:49'),
(34, 25, '2022-04-20 23:15:02', '1000', '', '2022-04-29 10:58:49'),
(35, 25, '2022-04-20 23:16:59', '1000', '', '2022-04-29 10:58:49'),
(36, 26, '2022-04-25 10:06:52', '12345', '', '2022-04-29 10:58:49'),
(37, 26, '2022-04-25 10:07:54', '500', '', '2022-04-29 10:58:49'),
(38, 16, '2022-04-25 10:57:20', '200', '', '2022-04-29 10:58:49'),
(39, 16, '2022-04-25 10:57:53', '200', '', '2022-04-29 10:58:49'),
(40, 16, '2022-04-25 12:05:01', '1000', '', '2022-04-29 10:58:49'),
(41, 21, '2022-04-25 12:06:17', '200', '', '2022-04-29 10:58:49'),
(42, 21, '2022-04-25 12:07:13', '123', '', '2022-04-29 10:58:49'),
(43, 21, '2022-04-25 12:07:47', '100', '', '2022-04-29 10:58:49'),
(44, 21, '2022-04-25 12:07:50', '100', '', '2022-04-29 10:58:49'),
(45, 15, '2022-04-29 11:16:49', '100', '', '2022-04-29 11:16:49'),
(46, 15, '2022-04-29 11:17:00', '100', '', '2022-04-29 11:17:00');

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
  `completed` int(1) NOT NULL DEFAULT 0,
  `new_balance` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_out`
--

INSERT INTO `cash_out` (`id`, `vendor_id`, `reference_id`, `amount`, `date_initiated`, `date_completed`, `completed`, `new_balance`) VALUES
(4, 23, '16N3MYA4K', '', '2022-04-25 10:14:37', '2022-04-25 10:15:59', 2, ''),
(5, 23, 'LY9NB5IS3', '1000', '2022-04-25 10:15:36', '2022-04-25 10:16:03', 1, ''),
(6, 23, 'XV7BJRX4O', '100', '2022-04-25 10:40:17', '2022-04-25 10:44:35', 1, ''),
(7, 23, 'XTW65FBRK', '200', '2022-04-25 10:46:43', '2022-04-25 11:58:48', 1, ''),
(8, 23, 'IK42O6PJD', '200', '2022-04-29 11:03:14', '2022-04-29 11:04:50', 1, '');

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
(22, '00000', '001', 'Math NoteBook', 17, 'MathNotebook', '65.00', '60.00', 20),
(23, '00000', '002', 'Journal Notebook', 18, 'Journal Notebook', '60.00', '55.00', 20),
(24, '00000', '003', 'Composition NB', 20, 'Composition NB', '60.00', '55.00', 20),
(25, '00000', '004', 'Long Pad', 20, 'Long Pad Paper', '48.00', '44.00', 20),
(26, '00000', '005', 'G1- G3 Pad Paper', 20, 'G1- G3 Pad Paper', '38.00', '33.00', 20),
(27, '00000', '006', 'Illustration Board 1/8', 20, 'Illustration Board 1/8', '13.00', '10.00', 20),
(28, '00000', '007', 'Illustration Board 1/2', 20, 'Illustration Board 1/2', '35.00', '30.00', 20),
(29, '00000', '008', 'Manila Paper', 20, 'Manila Paper', '6.00', '4.00', 20),
(30, '00000', '009', 'Marker Monami', 20, 'Marker Monami', '33.00', '30.00', 20),
(31, '00000', '010', 'Oil Pastel', 25, 'Oil Pastel', '35.00', '33.00', 20),
(32, '00000', '011', 'Crayola#16', 20, 'Crayola#16', '50.00', '45.00', 20),
(33, '00000', '012', 'Crayola#24', 20, 'Crayola#24', '64.00', '60.00', 20),
(34, '00000', '013', 'Black Ballpen(HBW)', 20, 'Black Ballpen(HBW)', '9.00', '7.00', 20),
(35, '00000', '014', 'RED BALLPEN(HBW)', 20, 'RED BALLPEN(HBW)', '9.00', '7.00', 20),
(36, '00000', '015', 'BrownEnvelope(long)', 20, 'BrownEnvelope(long)', '7.00', '5.00', 20),
(37, '00000', '016', 'BrownEnvelope(short)', 20, 'BrownEnvelope(short)', '6.00', '4.00', 20),
(38, '00000', '017', 'Correction Tape', 60, 'Correction Tape', '34.00', '30.00', 20),
(39, '00000', '018', 'Cartolina(black)', 20, 'Cartolina(black)', '12.00', '10.00', 20),
(40, '00000', '019', 'Cartolina(white)', 20, 'Cartolina(white)', '9.00', '7.00', 20),
(41, '00000', '020', 'Plastic Cover', 15, 'Plastic Cover', '12.00', '10.00', 20),
(42, '00000', '021', 'Sharpener Single', 20, 'Sharpener Single', '4.00', '2.00', 20),
(43, '00000', '01', 'Club House Sandwich', 25, '', '35.00', '35.00', 23),
(44, '00000', '02', 'Tuna Sandwich', 25, '', '30.00', '30.00', 23),
(45, '00000', '03', 'Egg Mayo Sandwhich', 25, '', '30.00', '30.00', 23),
(46, '00000', '04', 'Cheese Burger Sandwitch', 25, '', '35.00', '35.00', 23),
(47, '00000', '05', 'Egg Burger Sandwich', 25, '', '45.00', '45.00', 23),
(48, '00000', '06', 'Kikiam', 200, '1 pc - 1 peso', '1.00', '1.00', 23),
(49, '00000', '07', 'Fish Ball', 200, '2pc - 1 peso', '1.00', '1.00', 23),
(50, '00000', '08', 'SquidBall', 200, '1pc - 2 pesos', '2.00', '1.00', 23),
(51, '00000', '09', 'Kwek-Kwek', 100, '1pc - 3 pesos', '3.00', '200.00', 23),
(52, '00000', '10', 'Kopiko Blanca', 50, '', '10.00', '8.00', 23),
(53, '00000', '11', 'Nescafe White', 50, '', '10.00', '8.00', 23),
(54, '00000', '12', 'Milo', 50, '', '10.00', '8.00', 23),
(55, '00000', '13', 'Pancit Canton', 20, '', '25.00', '16.00', 23),
(56, '00000', '14', 'CupNoodles- Big', 20, 'Big', '30.00', '20.00', 23),
(57, '00000', '15', 'CupNoodles-Small', 20, 'Small', '20.00', '15.00', 23),
(58, '00000', '16', 'Dewberry', 20, '', '10.00', '10.00', 23),
(59, '00000', '17', 'Cream-O', 20, '', '10.00', '10.00', 23),
(60, '00000', '18', 'Chocomucho Cookies', 20, '', '10.00', '10.00', 23),
(61, '00000', '19', 'Presto', 20, '', '10.00', '10.00', 23),
(62, '00000', '20', 'Hansel', 20, '', '10.00', '10.00', 23),
(63, '00000', '21', 'Sky Flakes condensada', 20, '', '10.00', '10.00', 23),
(64, '00000', '22', 'Rebisco Choco ', 20, '', '10.00', '10.00', 23),
(65, '00000', '23', 'Skyflakes', 20, '', '10.00', '10.00', 23),
(66, '00000', '24', 'Bengbeng', 20, '', '10.00', '10.00', 23),
(67, '00000', '25', 'Chocomucho bar', 20, '', '10.00', '10.00', 23),
(68, '00000', '26', 'Cloud9', 20, '', '10.00', '10.00', 23),
(69, '00000', '27', 'Clover ', 20, '', '10.00', '10.00', 23),
(70, '00000', '28', 'Cheezy red', 20, '', '10.00', '10.00', 23),
(71, '00000', '29', 'Mr. Chips', 20, '', '10.00', '10.00', 23),
(72, '00000', '30', 'Chiz Curl', 20, '', '10.00', '10.00', 23),
(73, '00000', '31', 'Ridges', 20, '', '15.00', '15.00', 23),
(74, '00000', '32', 'Oheya', 20, '', '10.00', '10.00', 23),
(75, '00000', '33', 'Oshi-Spicy', 20, '', '10.00', '10.00', 23),
(76, '00000', '34', 'Crispy Patata', 20, '', '10.00', '10.00', 23),
(77, '00000', '35', 'Modes', 15, '', '10.00', '10.00', 23);

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
(66, 22, 1105, '2022-04-20'),
(67, 23, 1080, '2022-04-20'),
(68, 24, 1200, '2022-04-20'),
(69, 25, 960, '2022-04-20'),
(70, 26, 760, '2022-04-20'),
(71, 27, 260, '2022-04-20'),
(72, 28, 700, '2022-04-20'),
(73, 29, 120, '2022-04-20'),
(74, 30, 660, '2022-04-20'),
(75, 31, 875, '2022-04-20'),
(76, 32, 1000, '2022-04-20'),
(77, 33, 1280, '2022-04-20'),
(78, 34, 140, '2022-04-20'),
(79, 35, 140, '2022-04-20'),
(80, 36, 140, '2022-04-20'),
(81, 37, 120, '2022-04-20'),
(82, 38, 2040, '2022-04-20'),
(83, 39, 240, '2022-04-20'),
(84, 40, 180, '2022-04-20'),
(85, 41, 180, '2022-04-20'),
(86, 42, 80, '2022-04-20'),
(87, 43, 350, '2022-04-20'),
(88, 43, 0, '2022-04-20'),
(89, 43, 0, '2022-04-20'),
(90, 44, 750, '2022-04-20'),
(91, 45, 750, '2022-04-20'),
(92, 46, 875, '2022-04-20'),
(93, 47, 1125, '2022-04-20'),
(96, 48, 1, '2022-04-20'),
(97, 49, 1, '2022-04-20'),
(98, 50, 200, '2022-04-20'),
(99, 51, 300, '2022-04-20'),
(100, 52, 400, '2022-04-20'),
(101, 53, 400, '2022-04-20'),
(102, 54, 400, '2022-04-20'),
(104, 55, 320, '2022-04-20'),
(105, 56, 600, '2022-04-20'),
(106, 57, 400, '2022-04-20'),
(107, 58, 200, '2022-04-20'),
(108, 59, 200, '2022-04-20'),
(109, 60, 200, '2022-04-20'),
(110, 61, 200, '2022-04-20'),
(111, 62, 200, '2022-04-20'),
(112, 63, 200, '2022-04-20'),
(113, 64, 200, '2022-04-20'),
(114, 65, 200, '2022-04-20'),
(115, 66, 200, '2022-04-20'),
(116, 67, 200, '2022-04-20'),
(117, 68, 200, '2022-04-20'),
(118, 69, 200, '2022-04-20'),
(119, 68, 0, '2022-04-20'),
(120, 69, 0, '2022-04-20'),
(121, 70, 200, '2022-04-20'),
(122, 71, 200, '2022-04-20'),
(123, 56, 0, '2022-04-20'),
(124, 57, 0, '2022-04-20'),
(125, 72, 200, '2022-04-20'),
(126, 73, 300, '2022-04-20'),
(127, 74, 200, '2022-04-20'),
(128, 75, 200, '2022-04-20'),
(129, 76, 200, '2022-04-20'),
(130, 77, 300, '2022-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(10, 'Paupau Cold', '2022-02-03', 'NA', '09123456789', '90.00', '90.00', 14, 1);

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
(60, 10, 8, 20, '4.50', '2022-02-03', '90.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--

CREATE TABLE `transaction_logs` (
  `id` int(11) NOT NULL,
  `account_id` int(12) DEFAULT NULL,
  `vendor_id` tinytext DEFAULT NULL,
  `kind` varchar(128) NOT NULL,
  `amount` tinytext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `current_balance` tinytext NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_logs`
--

INSERT INTO `transaction_logs` (`id`, `account_id`, `vendor_id`, `kind`, `amount`, `created_at`, `current_balance`, `updated_at`) VALUES
(57, 1, '16', 'cashout', '200', '2022-04-25 10:57:53', '1200', '2022-04-29 10:59:37'),
(58, 1, '23', 'cashin', '200', '2022-04-25 11:58:48', '1400', '2022-04-29 10:59:37'),
(59, 16, NULL, 'cashin', '1000', '2022-04-25 12:05:01', '2400', '2022-04-29 10:59:37'),
(60, 1, '16', 'cashout', '1000', '2022-04-25 12:05:01', '1400', '2022-04-29 10:59:37'),
(65, 21, NULL, 'cashin', '100', '2022-04-25 12:07:47', '200', '2022-04-29 10:59:37'),
(66, 1, '21', 'cashout', '100', '2022-04-25 12:07:47', '100', '2022-04-29 10:59:37'),
(67, 21, NULL, 'cashin', '100', '2022-04-25 12:07:50', '300', '2022-04-29 10:59:37'),
(68, 1, '21', 'cashout', '100', '2022-04-25 12:07:50', '200', '2022-04-29 10:59:37'),
(69, 1, '23', 'cashin', '200', '2022-04-29 11:04:50', '400', '2022-04-29 11:04:50'),
(70, 15, NULL, 'cashin', '100', '2022-04-29 11:16:49', '1100', '2022-04-29 11:16:49'),
(71, 15, NULL, 'cashin', '100', '2022-04-29 11:17:00', '1200', '2022-04-29 11:17:00'),
(72, 1, '15', 'cashout', '100', '2022-04-29 11:17:00', '1100', '2022-04-29 11:17:00');

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
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cash_in_transaction`
--
ALTER TABLE `cash_in_transaction`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cash_out`
--
ALTER TABLE `cash_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
