-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2023 at 02:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

create database expense;
use expense;

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Food'),
(12, 'Travel'),
(13, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `details` text NOT NULL,
  `expense_date` date NOT NULL,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `category_id`, `item`, `price`, `details`, `expense_date`, `added_on`, `added_by`) VALUES
(4, 1, 'Dosa', 300, 'Test', '2023-01-15', '2023-01-15 13:59:59', 5),
(5, 12, 'Cab', 400, 'Client', '2023-01-15', '2023-01-15 09:50:53', 5),
(6, 1, 'Tea', 50, 'Client Visit', '2023-01-15', '2023-01-15 01:58:16', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(4, 'admin', '$2y$10$.UBqBaQzZWNyCK.JV77lRu0TnNS7/2YrXgpRxAnJWeEGAs.vEfMJW', 'Admin'),
(5, 'vishal', '$2y$10$ANnX1pGE/b6H.4A6v/ti9ud/UuAx/lp/wgnQ65Cyi6EZsf.OlO4EW', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
