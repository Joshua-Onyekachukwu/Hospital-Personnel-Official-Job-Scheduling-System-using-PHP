-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2022 at 02:27 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hpojssdb`
--
CREATE DATABASE IF NOT EXISTS `hpojssdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hpojssdb`;

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8979555558, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-10-11 04:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

DROP TABLE IF EXISTS `tbldepartment`;
CREATE TABLE IF NOT EXISTS `tbldepartment` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`ID`, `DepartmentName`, `CreationDate`) VALUES
(10, 'Doctor ', '2022-12-16 14:02:54'),
(11, 'Nurse', '2022-12-16 14:03:07'),
(12, 'Pharmacist', '2022-12-16 14:03:15'),
(13, 'Cleaners', '2022-12-16 14:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `tblpersonel`
--

DROP TABLE IF EXISTS `tblpersonel`;
CREATE TABLE IF NOT EXISTS `tblpersonel` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(5) DEFAULT NULL,
  `EmpId` varchar(100) DEFAULT NULL,
  `EmpName` varchar(200) DEFAULT NULL,
  `EmpEmail` varchar(200) DEFAULT NULL,
  `EmpContactNumber` bigint(10) DEFAULT NULL,
  `Designation` varchar(200) DEFAULT NULL,
  `EmpDateofbirth` date DEFAULT NULL,
  `EmpAddress` varchar(250) DEFAULT NULL,
  `EmpDateofjoining` date DEFAULT NULL,
  `Description` mediumtext,
  `Password` varchar(200) DEFAULT NULL,
  `ProfilePic` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpersonel`
--

INSERT INTO `tblpersonel` (`ID`, `DepartmentID`, `EmpId`, `EmpName`, `EmpEmail`, `EmpContactNumber`, `Designation`, `EmpDateofbirth`, `EmpAddress`, `EmpDateofjoining`, `Description`, `Password`, `ProfilePic`, `CreationDate`, `UpdationDate`) VALUES
(6, 11, 'N 101', 'Grace James', 'gracejames@gmail.com', 803729273, 'Nurse', '1997-09-23', 'University of Nigeria, Nsukka', '2022-12-18', 'Tall and Fine', '15e5c87b18c1289d45bb4a72961b58e8', '4ead5b00a2eaf10476864fc39b8c27011671373161.jpg', '2022-12-18 14:19:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

DROP TABLE IF EXISTS `tblschedule`;
CREATE TABLE IF NOT EXISTS `tblschedule` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `DeptID` int(5) DEFAULT NULL,
  `AssignScheduleto` int(5) DEFAULT NULL,
  `SchedulePriority` varchar(100) DEFAULT NULL,
  `ScheduleTitle` varchar(250) DEFAULT NULL,
  `ScheduleDescription` mediumtext,
  `ScheduleEduedate` date DEFAULT NULL,
  `ScheduleAssigndate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(200) DEFAULT NULL,
  `WorkCompleted` varchar(250) DEFAULT NULL,
  `Remark` varchar(250) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblschedule`
--

INSERT INTO `tblschedule` (`ID`, `DeptID`, `AssignScheduleto`, `SchedulePriority`, `ScheduleTitle`, `ScheduleDescription`, `ScheduleEduedate`, `ScheduleAssigndate`, `Status`, `WorkCompleted`, `Remark`, `UpdationDate`) VALUES
(6, 11, 6, 'Urgent', 'Check UP', 'Check all the sick persons', '2022-12-18', '2022-12-18 14:20:07', 'Completed', '100', 'Patient is ready to leave', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblscheduletracking`
--

DROP TABLE IF EXISTS `tblscheduletracking`;
CREATE TABLE IF NOT EXISTS `tblscheduletracking` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `SceduleID` int(10) DEFAULT NULL,
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `WorkCompleted` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblscheduletracking`
--

INSERT INTO `tblscheduletracking` (`ID`, `SceduleID`, `Remark`, `Status`, `WorkCompleted`, `UpdationDate`) VALUES
(8, 6, 'The Patient is better now', 'Inprogress', '70', '2022-12-18 14:21:47'),
(9, 6, 'Patient is ready to leave', 'Completed', '100', '2022-12-18 14:22:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
