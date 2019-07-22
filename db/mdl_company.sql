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
-- Table structure for table `mdl_company`
--

CREATE TABLE `mdl_company` (
  `company_id` int(3) NOT NULL,
  `company` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `kodepos` varchar(7) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdl_company`
--

INSERT INTO `mdl_company` (`company_id`, `company`, `alamat`, `telepon`, `kodepos`, `keterangan`) VALUES
(1, 'Telkom Akses', 'Jakarta', '021-9999999', '444444', 'Telkom'),
(2, 'PT. HGT', 'Nusa Tenggara Barat', '90909090', '9999999', 'TELKOmmmmm'),
(3, 'PT. Angin ribut', 'jakarta', '909090', '1919191', 'retail');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_company`
--
ALTER TABLE `mdl_company`
  ADD PRIMARY KEY (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_company`
--
ALTER TABLE `mdl_company`
  MODIFY `company_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
