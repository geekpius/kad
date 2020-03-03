-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2020 at 04:42 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kad`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `position` varchar(191) NOT NULL,
  `gender` varchar(191) NOT NULL,
  `house` varchar(191) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `position`, `gender`, `house`, `vote`, `image`, `created_at`) VALUES
(1, 'FIIFI PIUS', 'BOYS PREFECT', 'Male', 'House1', 0, 'cand_17993555.jpg', '2020-03-03 15:10:00'),
(2, 'KEZIAH OPOKU GYASI', 'GIRLS PREFECT', 'Female', 'House2', 0, 'cand_cand_ANGELA ANSERE BOATENG.jpg', '2020-03-03 15:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `timer` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `timer`) VALUES
(1, '2020-03-02 20:00');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `alias` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `name`, `alias`, `created_at`) VALUES
(1, 'YAA ASANTEWAA', 'House1', '2020-02-25 10:31:00'),
(2, 'MARY JOANNES', 'House2', '2020-02-25 11:43:00'),
(3, 'KOFI ANNAN', 'House1', '2020-03-03 14:18:00'),
(4, 'CHARLES LUANGA', 'House2', '2020-03-03 14:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `criteria` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `maxcon` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `criteria`, `type`, `maxcon`, `created_at`) VALUES
(1, 'BOYS PREFECT', 'General', 'All', 1, '2020-03-03 14:34:00'),
(2, 'GIRLS PREFECT', 'General', 'All', 2, '2020-03-03 15:07:00'),
(3, 'KOFI ANNAN HOUSE PREFECT', 'Male', 'House1', 2, '2020-03-03 15:08:00'),
(4, 'CHARLES LUANGA HOUSE PREFECT', 'Male', 'House2', 1, '2020-03-03 15:08:00'),
(5, 'YAA ASANTEWAA HOUSE PREFECT', 'Female', 'House1', 2, '2020-03-03 15:09:00'),
(6, 'MARY JOANNES HOUSE PREFECT', 'Female', 'House2', 2, '2020-03-03 15:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Fiifi Geek', 'admin', '$2y$10$oN.gOI/sDARA/CbwY9sIJugMhwx52tY0gDVOyXJUBdhHNRG1c1ZYq', 'administrator', '2020-02-24 06:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `access_number` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `gender` varchar(191) NOT NULL,
  `house` varchar(191) NOT NULL,
  `cls` varchar(191) NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `access_number`, `name`, `gender`, `house`, `cls`, `verify`, `status`, `created_at`) VALUES
(1, '11', 'KOFI OHENE', 'Male', 'House1', '1BVA', 1, 0, '2020-02-26 11:48:00'),
(2, '12', 'AFRAKOMA FORDJOUR', 'Female', 'House2', '1BVA', 1, 0, '2020-02-26 11:48:00'),
(3, '13', 'OSEI OWIREDU TOM', 'Male', 'House1', '1BV3', 0, 0, NULL),
(4, '14', 'GIFTY OBENG ASARE AKUA', 'Female', 'House1', '1BV4', 0, 0, NULL),
(5, '15', 'AKOSUA KYEREWAA ANN', 'Female', 'House2', '1BV5', 0, 0, NULL),
(7, '16', 'CHRISTIANA OPPONG', 'Female', 'House1', '1BV3', 0, 0, NULL),
(8, '17', 'OBENEWAA VENESSA', 'Female', 'House1', '1BV4', 0, 0, NULL),
(9, '18', 'KWAME NHYIRA', 'Male', 'House2', '1BV5', 0, 0, NULL),
(10, '19', 'CHRIS ADOMAKO', 'Male', 'House2', '2BVA', 0, 0, '2020-03-03 15:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `voter_carts`
--

CREATE TABLE `voter_carts` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `candidate` varchar(191) NOT NULL,
  `position` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `candidate` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_number` (`access_number`);

--
-- Indexes for table `voter_carts`
--
ALTER TABLE `voter_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `voter_carts`
--
ALTER TABLE `voter_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
