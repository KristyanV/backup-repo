-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2026 at 05:28 AM
-- Server version: 8.4.7
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dtr`
--
CREATE DATABASE IF NOT EXISTS `dtr` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dtr`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'daisy', 'daisy');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_reports`
--

DROP TABLE IF EXISTS `attendance_reports`;
CREATE TABLE IF NOT EXISTS `attendance_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `division` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `total_employees` int DEFAULT NULL,
  `total_absent` int DEFAULT NULL,
  `total_present` int DEFAULT NULL,
  `absentees` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `not_in_uniform` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `submitted_by` int DEFAULT NULL,
  `submitted_by_name` varchar(255) DEFAULT NULL,
  `submitted_by_role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewed` int NOT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `attendance_reports`
--

INSERT INTO `attendance_reports` (`id`, `division`, `report_date`, `total_employees`, `total_absent`, `total_present`, `absentees`, `not_in_uniform`, `submitted_by`, `submitted_by_name`, `submitted_by_role`, `created_at`, `viewed`) VALUES
(1, 'FAD', '2026-01-12', 18, 3, 18, '[{\"name\":\"KENT SOLIVA\",\"informed\":\"Informed\",\"cause\":\"none\"}]', '[{\"name\":\"KENT SOLIVA\",\"remarks\":\"WALAY SHOES\"}]', '2026-01-12 06:18:41', 1),
(2, 'FAD', '2026-01-12', 18, 0, 18, '[{\"name\":\"None\",\"informed\":\"Informed\",\"cause\":\"none\"}]', '[{\"name\":\"All Goods\",\"remarks\":\"n\\/a\"}]', '2026-01-12 06:20:00', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
