-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2021 at 05:51 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `invice`
--

CREATE TABLE `invice` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `c_id` varchar(300) NOT NULL,
  `pin_code` varchar(10) NOT NULL,
  `cell` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invice`
--

INSERT INTO `invice` (`id`, `name`, `c_id`, `pin_code`, `cell`, `address`) VALUES
(147, 'hgjjgj', '111', '444', '55', '555'),
(148, 'hgjjgj', '111', '444', '55', '555'),
(149, 'hgjjgj', '123455', '4', '66', '6cc'),
(150, '6655', '444', '6565', '76567', '565'),
(151, '665', '44', '56', '7656', '57'),
(152, 'hgjjgj', '32', '444', '33', '22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `c_id` varchar(300) NOT NULL,
  `p_name` varchar(300) NOT NULL,
  `p_category` varchar(300) NOT NULL,
  `p_qty` varchar(100) NOT NULL,
  `p_price` varchar(300) NOT NULL,
  `s_price` varchar(300) NOT NULL,
  `date` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `c_id`, `p_name`, `p_category`, `p_qty`, `p_price`, `s_price`, `date`) VALUES
(108, '123455', '655655', '656', '66', '5656', '65', '2021-08-01'),
(109, '555', 'fttyrty', 'jhgyu', '6576', '7656', '6675', '2021-08-01'),
(111, '44', 'trtyr', '6', '11', '44', '44', '2021-08-07'),
(112, '32', 'trtyr', 'rert', '6', '666', '66', '2021-08-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invice`
--
ALTER TABLE `invice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invice`
--
ALTER TABLE `invice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
