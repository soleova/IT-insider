-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2018 at 05:50 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poslovi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `sifra` int(11) NOT NULL,
  `kompanija` varchar(30) COLLATE utf8_bin NOT NULL,
  `pozicija` varchar(30) COLLATE utf8_bin NOT NULL,
  `ocena_beneficije` int(11) NOT NULL,
  `ocena_napredovanje` int(11) NOT NULL,
  `ocena_balans` int(11) NOT NULL,
  `prosecna_ocena` float NOT NULL,
  `komentar` varchar(1000) COLLATE utf8_bin NOT NULL,
  `preporuka` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pozicije`
--

CREATE TABLE `pozicije` (
  `sifra` varchar(10) COLLATE utf8_bin NOT NULL,
  `id_nivoa` smallint(6) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pozicije`
--

INSERT INTO `pozicije` (`sifra`, `id_nivoa`, `naziv`) VALUES
('fed', 1, 'Front End Developer'),
('bed', 1, 'Back End Developer'),
('se', 2, 'Software Engineer'),
('netd', 2, '.NET Developer'),
('da', 2, 'Database Administrator'),
('jd', 1, 'Java Developer'),
('wd', 2, 'Web Developer'),
('sd', 2, 'Software Developer'),
('qae', 1, 'QA Engineer'),
('fsd', 2, 'Full Stack Developer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`sifra`);

--
-- Indexes for table `pozicije`
--
ALTER TABLE `pozicije`
  ADD PRIMARY KEY (`sifra`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `sifra` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
