-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2020 at 01:24 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truevoting`
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
  `house` varchar(191) DEFAULT NULL,
  `vote` int(11) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `position`, `gender`, `house`, `vote`, `image`, `created_at`) VALUES
(1, 'FIIFI GEEK', 'PRESIDENT', 'Male', NULL, 2, 'cand_architecture-3309203_640.jpg', '2020-11-22 18:41:00'),
(2, 'GRACE SARPONG', 'PRESIDENT', 'Female', NULL, 0, 'cand_church-2464899_640.jpg', '2020-11-22 18:42:00'),
(3, 'OHENEMAA FIDELIA', 'PRESIDENT', 'Female', NULL, 0, 'cand_bed-142517_640.jpg', '2020-11-22 18:42:00'),
(4, 'KWAKYE CHRISTIANA ABIGAIL', 'GENERAL SECRETARY', 'Female', NULL, 2, 'cand_bathroom-1228427_640.jpg', '2020-11-22 18:42:00'),
(5, 'KWAME MILTON', 'PRO', 'Male', NULL, 1, 'cand_dining-room-3108037_640.jpg', '2020-11-22 18:43:00'),
(6, 'GALLY SANDRA', 'PRO', 'Female', NULL, 1, 'cand_lifestyle-3107041_640.jpg', '2020-11-22 18:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `p_name` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `timer` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `name`, `timer`) VALUES
(1, 'VibTech University of Ghana', '2020-11-22 23:16');

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
(1, 'PRESIDENT', 'General', 'All', 3, '2020-11-22 18:41:00'),
(2, 'GENERAL SECRETARY', 'General', 'All', 1, '2020-11-22 18:41:00'),
(3, 'PRO', 'General', 'All', 2, '2020-11-22 18:41:00');

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
(1, 'Fiifi Geek', 'admin', '$2y$10$oN.gOI/sDARA/CbwY9sIJugMhwx52tY0gDVOyXJUBdhHNRG1c1ZYq', 'administrator', '2020-02-24 06:23:00'),
(2, 'FIIFI GEEK', 'verifier', '$2y$10$EvOhomZaokvlHA9Uv1fFjeCec4A2guXpfa/j3kNlkKSFSwc/FSyEG', 'verifier', '2020-11-22 21:52:43'),
(3, 'Geek', 'geek', '$2y$10$QuikBMgHlQmN4sPNSaojUeQ8lug4MzM9vhMETG0gRwLbBCFpM9/v6', 'ec', '2020-11-22 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `access_number` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `gender` varchar(191) NOT NULL,
  `house` varchar(191) DEFAULT NULL,
  `cls` varchar(191) DEFAULT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `access_number`, `name`, `gender`, `house`, `cls`, `verify`, `status`, `created_at`) VALUES
(1, '12344', 'FIIFI GEEK', 'Male', NULL, NULL, 1, 1, '2020-11-22 19:34:00'),
(2, '12345', 'GRACE SARPONG', 'Female', NULL, NULL, 1, 1, '2020-11-22 19:36:00'),
(3, '12346', 'OHENEMAA FIDELIA', 'Female', NULL, NULL, 1, 1, '2020-11-22 19:36:00'),
(4, '12347', 'KWAKYE CHRISTIANA ABIGAIL', 'Female', NULL, NULL, 1, 0, '2020-11-22 19:47:00'),
(5, '12348', 'GENEVIEVE ARABA ANSAH', 'Female', NULL, NULL, 1, 0, '2020-11-22 19:48:00');

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

--
-- Dumping data for table `voter_carts`
--

INSERT INTO `voter_carts` (`id`, `voter_id`, `candidate`, `position`, `created_at`) VALUES
(1, 1, 'FIIFI GEEK', 'PRESIDENT', '2020-11-22 20:29:00'),
(2, 1, 'KWAKYE CHRISTIANA ABIGAIL', 'GENERAL SECRETARY', '2020-11-22 20:29:00'),
(3, 1, 'GALLY SANDRA', 'PRO', '2020-11-22 20:29:00'),
(4, 2, 'FIIFI GEEK', 'PRESIDENT', '2020-11-22 20:29:00'),
(5, 2, 'KWAKYE CHRISTIANA ABIGAIL', 'GENERAL SECRETARY', '2020-11-22 20:29:00'),
(6, 2, 'Skipped', 'PRO', '2020-11-22 20:29:00'),
(10, 3, 'Skipped', 'PRESIDENT', '2020-11-22 20:34:00'),
(11, 3, 'No', 'GENERAL SECRETARY', '2020-11-22 20:34:00'),
(12, 3, 'KWAME MILTON', 'PRO', '2020-11-22 20:34:00');

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
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `candidate`, `created_at`) VALUES
(1, 1, 'FIIFI GEEK', '2020-11-22 20:29:00'),
(2, 1, 'KWAKYE CHRISTIANA ABIGAIL', '2020-11-22 20:29:00'),
(3, 1, 'GALLY SANDRA', '2020-11-22 20:29:00'),
(4, 2, 'FIIFI GEEK', '2020-11-22 20:29:00'),
(5, 2, 'KWAKYE CHRISTIANA ABIGAIL', '2020-11-22 20:29:00'),
(6, 2, 'Skipped', '2020-11-22 20:29:00'),
(10, 3, 'Skipped', '2020-11-22 20:34:00'),
(11, 3, 'No', '2020-11-22 20:34:00'),
(12, 3, 'KWAME MILTON', '2020-11-22 20:34:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voter_carts`
--
ALTER TABLE `voter_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
