-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 04:22 AM
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
-- Database: `greatproducts`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Aug 13, 2022 at 01:52 AM
-- Last update: Aug 14, 2022 at 02:21 AM
--

CREATE TABLE `user` (
  `UserID` int(255) NOT NULL,
  `AdminID` tinyint(1) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Userpass` varchar(32) DEFAULT NULL,
  `Email` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `user`:
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `AdminID`, `Username`, `Userpass`, `Email`) VALUES
(2, 0, 'sysUser', NULL, NULL),
(3, 1, 'ngestiehr', 'pass', 'gestiehrn1@nku.edu'),
(5, 1, 'Kenneth Welch', 'hi', 'Kwelch@nku.edu'),
(6, 0, 'Qu Eerie', 'pun', 'dummysearch@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `UserID` (`UserID`),
  ADD UNIQUE KEY `UserID_2` (`UserID`,`AdminID`),
  ADD KEY `UserID_3` (`UserID`,`AdminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
