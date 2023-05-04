-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 12:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `user_id` int(4) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `Line_of_credit` int(5) NOT NULL DEFAULT 1000,
  `privileges` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`user_id`, `balance`, `Line_of_credit`, `privileges`) VALUES
(1, 20097400, 10000, 10),
(2, 10936, 5000, 1),
(3, 7809, 2000, 2),
(4, 232, 1000, 1),
(5, 2147483647, 1000, 1),
(12, 0, 1000, 1),
(13, 0, 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `trans_id` int(11) NOT NULL,
  `transferor_id` int(4) NOT NULL,
  `receiver_id` int(4) NOT NULL,
  `money_to_trans` int(8) NOT NULL,
  `date_of_trans` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`trans_id`, `transferor_id`, `receiver_id`, `money_to_trans`, `date_of_trans`) VALUES
(1, 1, 3, 200, '2023-03-15'),
(2, 1, 2, 3000, '2023-03-15'),
(3, 2, 1, 100, '2023-03-16'),
(7, 1, 2, 200, '2023-03-27'),
(9, 4, 1, 200, '2023-03-16'),
(10, 4, 1, 200, '2023-03-16'),
(11, 4, 1, 200, '2023-03-16'),
(12, 4, 1, 200, '2023-03-16'),
(13, 1, 3, 133, '2023-03-18'),
(14, 4, 3, 233, '2023-03-18'),
(15, 4, 2, 12345, '2023-03-18'),
(16, 4, 3, 12, '2023-03-18'),
(17, 3, 1, 123, '2023-03-18'),
(18, 3, 2, 3333, '2023-03-18'),
(19, 3, 4, 444, '2023-03-18'),
(20, 1, 3, 200, '2023-03-18'),
(21, 1, 5, 1000, '2023-03-19'),
(22, 1, 5, 1000, '2023-03-19'),
(23, 1, 3, 200, '2023-03-19'),
(24, 1, 4, 200, '2023-03-19'),
(25, 1, 2, 22, '2023-03-19'),
(26, 1, 2, 22, '2023-03-19'),
(27, 1, 2, 22, '2023-03-19'),
(28, 1, 2, 22, '2023-03-19'),
(29, 1, 3, 33, '2023-03-19'),
(30, 1, 4, 12, '2023-03-19'),
(31, 2, 3, 20, '2023-03-19'),
(32, 2, 4, 20, '2023-03-19'),
(33, 2, 5, 20, '2023-03-19'),
(34, 5, 3, 9878, '2023-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `date`) VALUES
(1, 'admin', 'yair', '2023-03-15'),
(2, 'user1', '123', '2023-03-15'),
(3, 'user3', '123456', '2023-03-15'),
(4, 'user12', '12', '0000-00-00'),
(5, 'user2', '', '2023-03-19'),
(6, 'yyyy', 'yyyy', '2023-03-19'),
(7, '111', '111', '2023-03-19'),
(8, '222', '222', '2023-03-19'),
(9, 'y7y', 'y7y', '2023-03-19'),
(10, 'rrr', 'rrr', '2023-03-19'),
(11, 'ttt', 'ttt', '2023-03-19'),
(12, 'yyy', 'yyy', '2023-03-19'),
(13, 'asd', '123', '2023-03-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
