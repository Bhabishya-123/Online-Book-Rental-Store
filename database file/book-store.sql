-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 05:55 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `book_price` int(120) NOT NULL,
  `book_desc` text NOT NULL,
  `book_date` varchar(100) NOT NULL,
  `book_img` varchar(256) NOT NULL,
  `book_author` varchar(100) NOT NULL DEFAULT 'admin',
  `book_catag` varchar(100) NOT NULL,
  `book_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `book_price`, `book_desc`, `book_date`, `book_img`, `book_author`, `book_catag`, `book_type`) VALUES
(22, 'Java', 33, 'sdfasdfsda', '2016-05-20', 'img_4.jpg', 'ramgopal', 'adventure', 'new'),
(23, 'HTML', 55, 'dfasdfdsaf', '2020/3/5', 'img_8.jpg', 'Roger Paulin', 'adventure', 'old');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `sid` int(11) NOT NULL,
  `pid` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `product` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `return_date` varchar(120) NOT NULL,
  `rent_charge` int(10) NOT NULL,
  `status` enum('active','purchased') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(100) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pwd` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_role` varchar(50) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_pwd`, `customer_phone`, `customer_address`, `customer_role`) VALUES
(30, 'admin', 'admin@gmail.com', 'admin', '9812345169', 'baneshwor, kathmandu', 'admin'),
(39, 'test', 'test@gmail.com', 'test', '9845353444', 'kathmandu', 'normal'),
(40, 'bhabishya', 'bhabishyaghimire88@gmail.com', 'samaj123', '9817604185', 'Bayalbas,Sarlahi', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL DEFAULT 'nepal',
  `message` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `fname`, `lname`, `country`, `message`) VALUES
(14, 'sita', 'yadav', 'nepal', 'You are so good'),
(16, 'ram', 'bhabishyaghimire', 'nepal', 'provide 1x book');

-- --------------------------------------------------------

--
-- Table structure for table `rentorders`
--

CREATE TABLE `rentorders` (
  `id` int(11) NOT NULL,
  `cid` int(50) NOT NULL,
  `bid` int(50) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT 1,
  `price` int(10) NOT NULL,
  `date` varchar(60) NOT NULL,
  `return_date` varchar(120) NOT NULL,
  `delivered_status` enum('pending','delivered') NOT NULL DEFAULT 'pending',
  `returned_status` enum('pending','returned') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rentorders`
--

INSERT INTO `rentorders` (`id`, `cid`, `bid`, `quantity`, `price`, `date`, `return_date`, `delivered_status`, `returned_status`) VALUES
(8565, 40, 22, 3, 11, '2023/9/27/', '2023-09-21', 'pending', 'pending'),
(8566, 40, 22, 3, 11, '2023/9/28/', '2023-09-21', 'pending', 'pending'),
(8567, 40, 22, 1, 11, '2023/9/28/', '2023-09-14', 'pending', 'pending'),
(8568, 30, 22, 1, 14, '2023/9/28/', '2023-10-27', 'pending', 'pending'),
(8569, 40, 22, 2, 11, '2023/9/28/', '2023-09-09', 'pending', 'pending'),
(8570, 30, 22, 1, 11, '2023/9/28/', '2023-09-29', 'pending', 'pending'),
(8571, 30, 22, 1, 11, '2023/9/28/', '2023-09-01', 'pending', 'pending'),
(8572, 30, 22, 3, 11, '2023/9/28/', '2023-09-20', 'pending', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `return_request`
--

CREATE TABLE `return_request` (
  `id` int(11) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `book_id` int(50) NOT NULL,
  `returned_status` enum('pending','returned') NOT NULL,
  `return_date` varchar(120) NOT NULL,
  `requested_date` varchar(120) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `rentorders`
--
ALTER TABLE `rentorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_request`
--
ALTER TABLE `return_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rentorders`
--
ALTER TABLE `rentorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8573;

--
-- AUTO_INCREMENT for table `return_request`
--
ALTER TABLE `return_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
