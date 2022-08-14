-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 07:40 PM
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
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `AddressID` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `Street` int(11) NOT NULL,
  `City` int(11) NOT NULL,
  `Zip` int(11) NOT NULL,
  `State` int(11) NOT NULL,
  `Country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CatID` int(255) NOT NULL,
  `CatName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(255) NOT NULL,
  `OrderStatus` int(1) DEFAULT NULL,
  `UserID` int(255) NOT NULL,
  `ProductID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `ProductID` int(255) NOT NULL,
  `CatID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productorder`
--

CREATE TABLE `productorder` (
  `ProductID` int(255) NOT NULL,
  `OrderID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Cost` double(5,2) NOT NULL,
  `Details` varchar(2200) NOT NULL,
  `Count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(255) NOT NULL,
  `AdminID` tinyint(1) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Userpass` varchar(32) DEFAULT NULL,
  `Email` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AddressID`),
  ADD UNIQUE KEY `AddressID` (`AddressID`,`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CatID`),
  ADD UNIQUE KEY `CatID_2` (`CatID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `OrderID` (`OrderID`,`UserID`,`ProductID`),
  ADD KEY `OrderID_2` (`OrderID`,`UserID`,`ProductID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD KEY `ProductID` (`ProductID`,`CatID`);

--
-- Indexes for table `productorder`
--
ALTER TABLE `productorder`
  ADD KEY `ProductID` (`ProductID`,`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD UNIQUE KEY `ProductID_2` (`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
