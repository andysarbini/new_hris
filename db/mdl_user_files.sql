-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 03:04 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_hris`
--

-- --------------------------------------------------------

--
-- Table structure for table `mdl_user_files`
--

CREATE TABLE `mdl_user_files` (
  `file_id` int(11) NOT NULL,
  `usr_id` int(6) NOT NULL,
  `tipeberkas` varchar(32) NOT NULL,
  `path_file` text NOT NULL,
  `date_inp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` int(1) NOT NULL DEFAULT '0' COMMENT '0 exist 1 delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdl_user_files`
--

INSERT INTO `mdl_user_files` (`file_id`, `usr_id`, `tipeberkas`, `path_file`, `date_inp`, `is_delete`) VALUES
(2, 4, 'KK', 'tantra23.png', '2019-07-22 08:03:32', 0),
(3, 4, 'npwp', 'rangap.png', '2019-07-22 08:03:52', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_user_files`
--
ALTER TABLE `mdl_user_files`
  ADD PRIMARY KEY (`file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_user_files`
--
ALTER TABLE `mdl_user_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
