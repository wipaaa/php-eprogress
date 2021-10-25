-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 11:59 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progress`
--
CREATE DATABASE IF NOT EXISTS `progress` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `progress`;

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

DROP TABLE IF EXISTS `akses`;
CREATE TABLE IF NOT EXISTS `akses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `akses`
--

TRUNCATE TABLE `akses`;
--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `nama`) VALUES
(1, 'Admin'),
(2, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT 'password',
  `nama` varchar(100) NOT NULL,
  `nim` char(9) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `akses` int(10) UNSIGNED DEFAULT 2,
  `prodi` int(10) UNSIGNED DEFAULT NULL,
  `avatar` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prodi` (`prodi`),
  KEY `akses` (`akses`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `mahasiswa`
--

TRUNCATE TABLE `mahasiswa`;
--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `email`, `password`, `nama`, `nim`, `phone`, `akses`, `prodi`, `avatar`) VALUES
(1, 'admin@progress.com', 'password', 'Admin', '000000000', '0000000000000', 1, 1, 'profile/profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

DROP TABLE IF EXISTS `prodi`;
CREATE TABLE IF NOT EXISTS `prodi` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alias` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `prodi`
--

TRUNCATE TABLE `prodi`;
--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `alias`) VALUES
(1, 'Sistem Informasi', 'SI'),
(2, 'Sistem Komputer', 'SK'),
(3, 'Bisnis Digital', 'BD');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
