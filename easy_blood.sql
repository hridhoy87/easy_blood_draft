-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 08:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easy_blood`
--

-- --------------------------------------------------------

--
-- Table structure for table `bbdb`
--

CREATE TABLE `bbdb` (
  `id` smallint(5) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Name_of_the_blood_bank',
  `lat` decimal(16,10) NOT NULL,
  `long` decimal(16,10) NOT NULL,
  `plus_code` varchar(128),
  `last_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Blood Bank Database';

--
-- Dumping data for table `bbdb`
--

INSERT INTO `bbdb` (`id`, `name`, `lat`, `long`, `plus_code`, `last_updated_at`) VALUES
(1, 'HUPBD', 23.8293120000, 90.3693390000, 'R9H9+MP Dhaka', '2024-08-11 18:57:10'),
(2, 'SBB Blood Bank', 23.8292600000, 90.3635560000, 'R9H7+PC Dhaka', '2024-08-13 04:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id_price` smallint(5) NOT NULL,
  `bbname` varchar(128) NOT NULL COMMENT 'Name_of_the_blood_bank',
  `aPOS` int(16) NOT NULL COMMENT 'Price',
  `bPOS` int(16) NOT NULL COMMENT 'Price',
  `abPOS` int(16) NOT NULL COMMENT 'Price',
  `oPOS` int(16) NOT NULL COMMENT 'Price',
  `aNEG` int(16) NOT NULL COMMENT 'Price',
  `bNEG` int(16) NOT NULL COMMENT 'Price',
  `abNEG` int(16) NOT NULL COMMENT 'Price',
  `oNEG` int(16) NOT NULL COMMENT 'Price',
  `last_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='price';

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id_price`, `bbname`, `aPOS`, `bPOS`, `abPOS`, `oPOS`, `aNEG`, `bNEG`, `abNEG`, `oNEG`, `last_updated_at`) VALUES
(20001, 'HUPBD', 45, 45, 55, 60, 90, 90, 110, 120, '2024-08-11 19:07:29'),
(20002, 'SBB Blood Bank', 450, 250, 350, 150, 700, 600, 560, 800, '2024-08-13 04:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id_state` smallint(5) NOT NULL,
  `bbname` varchar(128) NOT NULL COMMENT 'Name_of_the_blood_bank',
  `aPOS` int(16) NOT NULL COMMENT 'qty',
  `bPOS` int(16) NOT NULL COMMENT 'qty',
  `abPOS` int(16) NOT NULL COMMENT 'qty',
  `oPOS` int(16) NOT NULL COMMENT 'qty',
  `aNEG` int(16) NOT NULL COMMENT 'qty',
  `bNEG` int(16) NOT NULL COMMENT 'qty',
  `abNEG` int(16) NOT NULL COMMENT 'qty',
  `oNEG` int(16) NOT NULL COMMENT 'qty',
  `last_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='amount of blood available now';

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id_state`, `bbname`, `aPOS`, `bPOS`, `abPOS`, `oPOS`, `aNEG`, `bNEG`, `abNEG`, `oNEG`, `last_updated_at`) VALUES
(10001, 'HUPBD', 100, 160, 200, 250, 10, 16, 20, 25, '2024-08-11 19:06:41'),
(10002, 'SBB Blood Bank', 250, 150, 23, 235, 12, 45, 14, 7, '2024-08-13 04:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` smallint(5) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Name_of_the_blood_bank',
  `blood_gp` int(10) NOT NULL,
  `last_updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='test_table';

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `blood_gp`, `last_updated_at`) VALUES
(1, 'Basundhara Blood Bank', 55, '2024-08-11 14:12:16'),
(2, 'Shondhani', 1, '2024-08-11 14:12:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bbdb`
--
ALTER TABLE `bbdb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id_price`),
  ADD UNIQUE KEY `bbname` (`bbname`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id_state`),
  ADD UNIQUE KEY `bbname` (`bbname`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bbdb`
--
ALTER TABLE `bbdb`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id_price` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20003;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id_state` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`bbname`) REFERENCES `state` (`bbname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`bbname`) REFERENCES `bbdb` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
