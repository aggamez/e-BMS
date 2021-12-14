-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 03:26 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebims`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(16) NOT NULL,
  `adminName` text NOT NULL,
  `passwordHash` text NOT NULL,
  `adminDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `passwordHash`, `adminDate`) VALUES
('ad20211214101157', 'admin', '9f756378032582b389250d39f6f6945f', '2021-12-14 10:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `resID` varchar(8) NOT NULL,
  `familyName` text NOT NULL,
  `givenName` text NOT NULL,
  `middleName` text NOT NULL,
  `alias` text NOT NULL,
  `faceMarks` text NOT NULL,
  `birthDate` date NOT NULL,
  `birthPlace` text NOT NULL,
  `sex` varchar(1) NOT NULL,
  `civilStatus` varchar(1) NOT NULL,
  `nationality` text NOT NULL,
  `faith` text NOT NULL,
  `occupation` text NOT NULL,
  `sector` text NOT NULL,
  `spouseName` text DEFAULT NULL,
  `spouseOccu` int(11) DEFAULT NULL,
  `voterState` varchar(1) NOT NULL,
  `cityAdd` text NOT NULL,
  `provAdd` text NOT NULL,
  `purok` text NOT NULL,
  `homeNumbOne` text NOT NULL,
  `homeNumbTwo` text NOT NULL,
  `mobiNumbOne` text NOT NULL,
  `mobiNumbTwo` text NOT NULL,
  `email` text NOT NULL,
  `resType` varchar(3) NOT NULL,
  `resState` varchar(3) NOT NULL,
  `registerDate` text NOT NULL,
  `processedBy` varchar(16) NOT NULL,
  `transactID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `passwordHash` (`passwordHash`) USING HASH;

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`resID`),
  ADD KEY `hell` (`processedBy`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `hell` FOREIGN KEY (`processedBy`) REFERENCES `admin` (`adminID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
