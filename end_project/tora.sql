-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2023 at 12:05 AM
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
-- Database: `tora`
--

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `user_id` int(3) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `type` int(1) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`user_id`, `date`, `type`, `lesson_id`) VALUES
(1, '2023-04-19', 1, 1),
(1, '2023-04-19', 1, 1),
(2, '2023-04-19', 1, 1),
(3, '2023-04-19', 1, 1),
(1, '2023-04-19', 2, 1),
(1, '2023-04-19', 3, 1),
(2, '2023-04-19', 3, 1),
(2, '2023-04-19', 3, 5),
(2, '2023-04-19', 1, 13),
(1, '2023-04-19', 1, 13),
(1, '2023-04-19', 2, 14),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-19', 1, 5),
(1, '2023-04-20', 2, 13),
(1, '2023-04-20', 2, 13),
(1, '2023-04-20', 2, 1),
(1, '2023-04-20', 2, 17),
(1, '2023-04-20', 2, 17),
(1, '2023-04-20', 2, 17),
(1, '2023-04-20', 2, 17),
(1, '2023-04-20', 3, 0),
(1, '2023-04-20', 3, 0),
(1, '2023-04-20', 3, 13),
(1, '2023-04-20', 3, 13),
(1, '2023-04-20', 2, 17),
(1, '2023-04-20', 2, 17),
(1, '2023-04-20', 3, 13),
(3, '2023-04-21', 2, 17),
(3, '2023-04-21', 1, 13),
(3, '2023-04-21', 3, 14),
(4, '2023-04-21', 2, 17),
(4, '2023-04-21', 2, 14),
(4, '2023-04-21', 1, 13),
(4, '2023-04-21', 2, 5),
(4, '2023-04-21', 2, 5),
(4, '2023-04-21', 3, 13),
(4, '2023-04-21', 2, 17),
(4, '2023-04-21', 2, 17),
(1, '2023-04-21', 2, 13),
(1, '2023-04-21', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-22', 3, 13),
(1, '2023-04-23', 3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(6) NOT NULL,
  `lesson_id` int(5) NOT NULL,
  `text` varchar(150) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `lesson_id`, `text`, `date`, `user_id`) VALUES
(1, 5, 'שיעור מצויין!', '2023-04-21', 1),
(2, 5, 'שיעור מצויין!', '2023-04-21', 2),
(3, 5, 'שלום! מקסים!', '2023-04-23', 1),
(4, 5, 'נחמד!', '2023-04-23', 4);

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
(4, 'user13', '13', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `שיעורים`
--

CREATE TABLE `שיעורים` (
  `נושא` int(3) NOT NULL,
  `דף מקורות` varchar(40) NOT NULL,
  `שם השיעור` varchar(30) NOT NULL,
  `id` int(11) NOT NULL,
  `קבצים נוספים` tinyint(1) NOT NULL DEFAULT 0,
  `record` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `שיעורים`
--

INSERT INTO `שיעורים` (`נושא`, `דף מקורות`, `שם השיעור`, `id`, `קבצים נוספים`, `record`) VALUES
(49, '1.docx', 'פרק א', 1, 0, ''),
(47, '2.pdf', 'פרק א', 5, 0, ''),
(47, '3.pdf', 'פרק 11', 13, 0, '4.mp3'),
(47, '4.docx', 'פרק 3', 14, 0, '3.mp3'),
(49, '5.docx', 'פרק ב', 15, 0, ''),
(48, 'yair_moshkovitz_cv.pdf', 'המפתח המוכשר', 17, 0, ''),
(47, '_text_2-1.pdf', '1qaz', 18, 0, ''),
(56, '_text_2.pdf', 'פרק א משנה א', 19, 0, ''),
(56, '206122384_2023_03.pdf', 'פרק ב משנה ב', 20, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `נושאים`
--

CREATE TABLE `נושאים` (
  `id` int(11) NOT NULL,
  `נושא` varchar(15) NOT NULL,
  `תמונת שער` varchar(40) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `נושאים`
--

INSERT INTO `נושאים` (`id`, `נושא`, `תמונת שער`, `date`) VALUES
(47, 'תהילים', '1.jpg', '2023-04-18'),
(48, 'איך לגייס?', 'who.jpg', '2023-04-18'),
(50, 'השקפה', '3.jpg', '2023-04-18'),
(51, 'בלון', '4.jpg', '2023-04-18'),
(52, 'אחדות', '5.jpg', '2023-04-20'),
(54, 'גמרא', '2.jpg', '2023-04-18'),
(55, 'אב יהושע', '20200406_160336.jpg', '2023-04-21'),
(56, 'פרקי אבות', '20200406_160328.jpg', '2023-04-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `שיעורים`
--
ALTER TABLE `שיעורים`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `נושאים`
--
ALTER TABLE `נושאים`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `נושא` (`נושא`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `שיעורים`
--
ALTER TABLE `שיעורים`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `נושאים`
--
ALTER TABLE `נושאים`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
