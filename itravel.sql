-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 06:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(3) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_mobile` varchar(14) NOT NULL,
  `admin_dob` date NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_doj` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_mobile`, `admin_dob`, `admin_password`, `admin_doj`) VALUES
(2, 'jitt', 'jitt@gmail.com', '65554', '2024-06-07', '$2y$10$BC/FLTwQuEn0XQ69qqulO.uc8J58k./76n18YLn0tceslwxDBHTMC', '2025-03-10 12:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `contact_table`
--

CREATE TABLE `contact_table` (
  `contact_id` int(3) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `contact_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_table`
--

INSERT INTO `contact_table` (`contact_id`, `user_name`, `user_email`, `subject`, `contact_date`) VALUES
(3, 'jitt', 'dabhijitendra5927@gmail.com', 'vfgf', '2025-03-29 00:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `feedback_id` int(4) NOT NULL,
  `username` varchar(15) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `feedback_message` varchar(200) NOT NULL,
  `feedback_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_table`
--

INSERT INTO `feedback_table` (`feedback_id`, `username`, `user_email`, `feedback_message`, `feedback_date`) VALUES
(10, 'jitt', 'jitt@gmail.com', 'hii', '2025-03-29 00:26:39'),
(11, 'jitt', 'jitt@gmail.com', 'gygui', '2025-03-29 00:27:31'),
(12, 'jitt', 'jitt@gmail.com', 'gygui', '2025-03-29 00:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_mobile` varchar(14) NOT NULL,
  `user_dob` date NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_doj` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_email`, `user_mobile`, `user_dob`, `user_password`, `user_doj`) VALUES
(16, 'jitendra', 'jitendra@gmail.com', '326327896', '2001-10-12', '$2y$10$uiJcjMUnjUyKIocdqF5dbeU7ntHPNbLQ0uwbTN.nQL1AGYP/zVIJK', '2025-03-10 13:08:31'),
(17, 'jitt', 'jitt@gmail.com', '749091144', '2002-12-12', '$2y$10$iTo9BMSEAeuADjVMjOeEYu1U.8QXyddr0h1qPZKrE/F03Lie5ETOm', '2025-03-27 16:36:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contact_table`
--
ALTER TABLE `contact_table`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_table`
--
ALTER TABLE `contact_table`
  MODIFY `contact_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `feedback_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
