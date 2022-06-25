-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2022 at 10:56 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18262646_root`
--

-- --------------------------------------------------------

--
-- Table structure for table `actionsfirst`
--

CREATE TABLE `actionsfirst` (
  `id` int(255) NOT NULL,
  `buzzer1` varchar(255) DEFAULT NULL,
  `buzzer2` varchar(255) DEFAULT NULL,
  `bluetooth1` varchar(255) DEFAULT NULL,
  `bluetooth2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actionsfirst`
--

INSERT INTO `actionsfirst` (`id`, `buzzer1`, `buzzer2`, `bluetooth1`, `bluetooth2`) VALUES
(1, 'Of', 'Of', 'Unconnected', 'Unconnected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actionsfirst`
--
ALTER TABLE `actionsfirst`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actionsfirst`
--
ALTER TABLE `actionsfirst`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
