-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 10:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fifa_card`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `player_id` int(10) NOT NULL,
  `fifa_username` varchar(255) NOT NULL,
  `quantity` int(7) NOT NULL,
  `visible` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `player_id`, `fifa_username`, `quantity`, `visible`) VALUES
(1, 2, 'elite', 3, 1),
(2, 3, 'elite', 3, 1),
(3, 12, 'elite', 1, 1),
(4, 4, 'elite', 1, 1),
(5, 5, 'elite', 1, 1),
(6, 6, 'elite', 3, 1),
(7, 7, 'elite', 1, 1),
(8, 8, 'elite', 4, 1),
(9, 9, 'elite', 1, 1),
(10, 10, 'elite', 1, 1),
(11, 11, 'elite', 3, 1),
(12, 14, 'elite', 2, 1),
(13, 13, 'sakib', 1, 1),
(14, 7, 'sakib', 1, 1),
(15, 10, 'sakib', 3, 1),
(16, 2, 'sakib', 4, 1),
(17, 9, 'sakib', 2, 1),
(18, 13, 'sakib', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `club` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `pace` int(10) NOT NULL,
  `shoot` int(10) NOT NULL,
  `pass` int(10) NOT NULL,
  `dribble` int(10) NOT NULL,
  `defend` int(10) NOT NULL,
  `physical` int(10) NOT NULL,
  `price` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `club`, `country`, `position`, `pace`, `shoot`, `pass`, `dribble`, `defend`, `physical`, `price`) VALUES
(1, 'messi', 'psg', 'argentina', 'rw', 85, 92, 91, 95, 34, 65, 1500000),
(2, 'neymar', 'psg', 'brazil', 'lw', 91, 85, 86, 94, 36, 59, 1200000),
(3, 'cristiano ronaldo', 'mun', 'portugal', 'st', 88, 93, 80, 90, 34, 77, 1400000),
(4, 'van dijk', 'liv', 'netherland', 'cb', 76, 60, 71, 72, 91, 86, 1000000),
(5, 'marcelo', 'rma', 'brazil', 'lb', 79, 73, 80, 88, 76, 76, 1050000),
(6, 'alexander-arnold', 'liv', 'england', 'rb', 80, 66, 87, 80, 80, 71, 1080000),
(7, 'casemiro', 'rma', 'brazil', 'cdm', 65, 73, 76, 73, 86, 91, 1080000),
(8, 'kante', 'che', 'france', 'cdm', 77, 66, 76, 81, 86, 82, 1010000),
(9, 'de bruyne', 'mci', 'belgium', 'cam', 76, 86, 93, 88, 64, 78, 1100000),
(10, 'kroos', 'rma', 'germany', 'cm', 54, 81, 91, 81, 71, 69, 1005000),
(11, 'mbappe', 'psg', 'france', 'st', 96, 86, 78, 90, 38, 76, 1150000),
(12, 'messi(fut)', 'psg', 'argentina', 'cam', 98, 99, 99, 99, 47, 90, 1900000),
(13, 'neymar(fut)', 'psg', 'brazil', 'lm', 97, 94, 95, 99, 42, 70, 1700000),
(14, 'alisson', 'liv', 'brazil', 'gk', 60, 40, 40, 20, 70, 90, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `id` int(11) NOT NULL,
  `user1` varchar(255) NOT NULL,
  `user2` varchar(255) NOT NULL,
  `card1` int(11) NOT NULL,
  `card2` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trades`
--

INSERT INTO `trades` (`id`, `user1`, `user2`, `card1`, `card2`, `status`) VALUES
(2, 'sakib', 'elite', 0, 0, 'Pending'),
(3, 'sakib', 'elite', 0, 0, 'Pending'),
(4, 'sakib', 'elite', 9, 0, ''),
(5, 'elite', 'sakib', 0, 14, ''),
(6, 'sakib', 'elite', 10, 0, ''),
(7, 'elite', 'sakib', 0, 8, ''),
(8, 'sakib', 'elite', 2, 0, ''),
(9, 'elite', 'sakib', 0, 8, ''),
(10, 'sakib', 'elite', 2, 0, ''),
(11, 'elite', 'sakib', 0, 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `fifa_username` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL DEFAULT 0,
  `otp` varchar(11) NOT NULL,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL,
  `sub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`fifa_username`, `username`, `email`, `password`, `verification_code`, `is_verified`, `otp`, `resettoken`, `resettokenexpire`, `sub`) VALUES
('elite', 'elite', 'sakibibrahim34@gmail.com', '$2y$10$fzL6kCtonmqqqza9T9V48.xC9sEfp4Xi8cqQpWlgh/ChPwi6rPnA.', 'b32c5addd67fcaee2b5ea35b1011b70c', 1, '39980', NULL, NULL, 0),
('sakib', '', 'sakibibrahim36@gmail.com', '', '', 0, '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
