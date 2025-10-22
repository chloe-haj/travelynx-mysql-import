-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 06, 2024 at 12:30 PM
-- Server version: 10.5.23-MariaDB-0+deb11u1
-- PHP Version: 8.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travels`
--

-- --------------------------------------------------------

--
-- Table structure for table `travelynx`
--

CREATE TABLE `travelynx` (
  `type` varchar(6) DEFAULT NULL,
  `line` varchar(5) DEFAULT NULL,
  `number` varchar(6) DEFAULT NULL,
  `departure stop name` text DEFAULT NULL,
  `departure stop id` varchar(9) DEFAULT NULL,
  `arrival stop name` text DEFAULT NULL,
  `arrival stop id` varchar(9) DEFAULT NULL,
  `scheduled departure` varchar(16) DEFAULT NULL,
  `real-time departure` varchar(16) DEFAULT NULL,
  `scheduled arrival` varchar(16) DEFAULT NULL,
  `real-time arrival` varchar(16) DEFAULT NULL,
  `operator` text DEFAULT NULL,
  `carriage type` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `id` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `travelynx`
--
ALTER TABLE `travelynx`
  ADD UNIQUE KEY `ID` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
