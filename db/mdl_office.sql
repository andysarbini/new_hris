-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 03:27 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_bluehrd`
--

-- --------------------------------------------------------

--
-- Table structure for table `mdl_office`
--

CREATE TABLE `mdl_office` (
  `office_id` int(11) NOT NULL,
  `office` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `company_id` int(2) NOT NULL,
  `lon` varchar(16) NOT NULL,
  `lat` varchar(16) NOT NULL,
  `gmt` int(1) NOT NULL DEFAULT '7' COMMENT 'default ada di WIB +7',
  `no_prop` int(2) NOT NULL,
  `no_kab` int(2) NOT NULL,
  `status_id` int(1) NOT NULL,
  `induksi_id` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdl_office`
--

INSERT INTO `mdl_office` (`office_id`, `office`, `alamat`, `company_id`, `lon`, `lat`, `gmt`, `no_prop`, `no_kab`, `status_id`, `induksi_id`) VALUES
(11, 'BANTAR GEBANG RAYON A', 'alamat_dummy', 1, '106.984584', '-6.319249', 7, 32, 16, 1, 1),
(12, 'BEKASI RAYON A', 'alamat_dummy', 1, '106.984584', '-6.319249', 7, 32, 16, 1, 1),
(13, 'BEKASI RAYON B', 'alamat_dummy', 1, '106.984584', '-6.319249', 7, 32, 16, 1, 1),
(14, 'CIBITUNG RAYON A', 'alamat_dummy', 3, '106.984584', '-6.319249', 7, 53, 11, 1, 1),
(15, 'CIBITUNG RAYON B', 'alamat_dummy', 1, '106.984584', '-6.319249', 7, 32, 16, 1, 1),
(16, 'BENOA RAYON', 'alamat_dummy', 2, '115.20996', '-8.80194', 8, 51, 1, 1, 1),
(17, 'KALIASEM RAYON A', 'alamat_dummy', 1, '115.02285', '-8.17619', 7, 51, 1, 1, 1),
(18, 'BIMA RAYON', 'alamat_dummy', 2, '118.728687', '-8.456958', 8, 52, 6, 1, 1),
(19, 'LOMBOK TENGAH', 'alamat_dummy', 3, '116.273239', '-8.762127', 7, 52, 1, 1, 1),
(20, 'LOMBOK TIMUR', 'alamat_dummy', 2, '116.092035', '-8.587546', 7, 53, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_office`
--
ALTER TABLE `mdl_office`
  ADD PRIMARY KEY (`office_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_office`
--
ALTER TABLE `mdl_office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
