-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 08:53 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garbage`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver_info`
--

CREATE TABLE `driver_info` (
  `id` int(10) NOT NULL,
  `complain_id` int(10) NOT NULL,
  `driverID` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_info`
--

INSERT INTO `driver_info` (`id`, `complain_id`, `driverID`, `status`, `date`) VALUES
(2, 12, 49, 'Complete', '2023-07-21'),
(3, 13, 50, 'Complete', '2023-07-21'),
(4, 14, 50, 'Complete', '2023-07-21'),
(5, 15, 49, 'Pass', '2023-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `lodgedcomplain`
--

CREATE TABLE `lodgedcomplain` (
  `complain_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL COMMENT 'Trash container image',
  `status` varchar(10) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lodgedcomplain`
--

INSERT INTO `lodgedcomplain` (`complain_id`, `user_id`, `region`, `municipal`, `street`, `house_no`, `image`, `status`, `date`) VALUES
(12, 53, 'Arusha', 'Arusha Urban', 'mianzini', '1234', '../UploadIMG/065ef76deecefa37e19d6629155d28a4.jpg', 'Complete', '2023-07-21 09:12 03 AM'),
(13, 52, 'Arusha', 'Arusha Urban', 'sombetini', '12345', '../UploadIMG/52e556432d4404e3070b35c66997ff04.jpg', 'Complete', '2023-07-21 09:14 42 AM'),
(14, 53, 'Arusha', 'Arusha Urban', 'sekei', '234', '../UploadIMG/9e2a00d078895b1575d32d440e85b9f6.jpg', 'Complete', '2023-07-21 09:34 46 AM'),
(15, 53, 'Arusha', 'Arusha Urban', 'kijenge', '234', '../UploadIMG/6b7b03c7c825e7fb6bab24f0a3781f6c.jpg', 'InProgress', '2023-07-21 09:52 10 AM');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL COMMENT 'Admin  001 , User 002 , Dv 003 , '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `fname`, `lname`, `email`, `phone_no`, `username`, `password`, `date`, `status`, `user_type`) VALUES
(42, 'godwin', 'nilla', 'godwinnillah@gmail.com', '0624261151', 'nillah', '687d9cad46e3aa59171c7e98d0443611ec2a2b9a', '2023-07-19', 'active', '001'),
(47, 'Joseph', 'Tesha', 'tesha@gmail.com', '0675483456', 'tesha', '6f23a92bf4744e10408ad6ea1aa62d75ef9a9d21', '2023-07-21', 'active', '001'),
(49, 'Danilo', 'Pereira', 'danilopereira@gmail.com', '065435678', 'danilo', 'a73ea233e90dcf7bf60cc5843b4026cb0358ed1c', '2023-07-21', 'active', '003'),
(50, 'Joseph', 'Maguguli', 'maguguli@gmail.com', '0765431234', 'maguguli', '7b7043c23bfd5737020b047d6a0698d3c63b1e90', '2023-07-21', 'active', '003'),
(51, 'Benito', 'Linze', 'benito@gmail.com', '0798654356', 'benito', 'b7e50e2b4689d8cb0c659131c70c670633d7623e', '2023-07-21', 'active', '003'),
(52, 'Mayunga', ' John', 'mayunga@gmail.com', '0745678913', 'mayunga', '4839a74af8ed3e0c73b49384ebf32f1177765da3', '2023-07-21', 'active', '002'),
(53, 'Atupelye', 'Simoni', 'atupeleye@gmail.com', '0712345676', 'atu', '851cd0bd553ddb8d7a5c910afa4055e1244594ac', '2023-07-21', 'active', '002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver_info`
--
ALTER TABLE `driver_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lodgedcomplain`
--
ALTER TABLE `lodgedcomplain`
  ADD PRIMARY KEY (`complain_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver_info`
--
ALTER TABLE `driver_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lodgedcomplain`
--
ALTER TABLE `lodgedcomplain`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
