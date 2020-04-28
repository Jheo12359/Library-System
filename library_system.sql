-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 05:28 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `ISBN` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `ISBN`, `title`, `genre`, `status`, `date_added`) VALUES
(42, '978-1-60309-397-2123', 'ewewewtyuky', 'Fantasy', 'returned', '2020-03-13'),
(43, '978-1-60309-025-4', 'Beach Safari', 'Humor', 'returned', '2020-03-15'),
(44, '978-1-891830-40-000', 'test12345678', 'Fantasy', 'returned', '2020-03-15'),
(45, '978-1-60309-397-2123', 'test', 'Development', '', '2020-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `rent_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rent_year` year(4) NOT NULL,
  `rent_month` varchar(11) NOT NULL,
  `rent_week` int(11) NOT NULL,
  `rent_day` int(11) NOT NULL,
  `return_day` int(11) NOT NULL,
  `return_year` year(4) NOT NULL,
  `return_month` varchar(11) NOT NULL,
  `return_week` int(11) NOT NULL,
  `returned_day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`rent_id`, `book_id`, `user_id`, `status`, `rent_year`, `rent_month`, `rent_week`, `rent_day`, `return_day`, `return_year`, `return_month`, `return_week`, `returned_day`) VALUES
(82, 42, 14, 'returned', 2020, 'Mar', 11, 15, 16, 0000, '', 0, 0),
(83, 43, 14, 'returned', 2020, 'Mar', 11, 15, 16, 0000, '', 0, 0),
(84, 42, 14, 'returned', 0000, '', 0, 0, 0, 2020, 'Mar', 11, 15),
(85, 43, 14, 'returned', 0000, '', 0, 0, 0, 2020, 'Mar', 11, 15),
(86, 42, 14, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(87, 43, 14, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(88, 44, 14, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(89, 45, 14, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(90, 42, 14, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(91, 43, 14, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(92, 45, 14, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(93, 44, 14, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(94, 42, 15, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(95, 43, 15, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(96, 44, 15, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(97, 45, 15, 'returned', 2022, 'Aug', 33, 19, 20, 0000, '', 0, 0),
(98, 42, 15, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(99, 43, 15, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(100, 45, 15, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(101, 44, 15, 'returned', 0000, '', 0, 0, 0, 2022, 'Aug', 33, 19),
(102, 42, 14, 'returned', 2020, 'Mar', 12, 16, 17, 0000, '', 0, 0),
(103, 42, 14, 'returned', 0000, '', 0, 0, 0, 2020, 'Mar', 12, 16),
(104, 45, 14, 'returned', 2020, 'Mar', 12, 16, 17, 0000, '', 0, 0),
(105, 45, 14, 'returned', 0000, '', 0, 0, 0, 2020, 'Mar', 12, 16),
(106, 42, 16, 'returned', 2020, 'Mar', 12, 16, 17, 0000, '', 0, 0),
(107, 43, 16, 'returned', 2020, 'Mar', 12, 16, 17, 0000, '', 0, 0),
(108, 44, 16, 'returned', 2020, 'Mar', 12, 16, 17, 0000, '', 0, 0),
(109, 42, 16, 'returned', 0000, '', 0, 0, 0, 2020, 'Mar', 12, 18),
(110, 43, 16, 'returned', 0000, '', 0, 0, 0, 2020, 'Mar', 12, 18),
(111, 44, 16, 'returned', 0000, '', 0, 0, 0, 2020, 'Mar', 12, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `type`, `fname`, `lname`, `username`, `password`, `status`, `created`) VALUES
(13, 'admin', 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '2020-03-15'),
(15, 'lessee', 'jheo', 'corona', 'jeho123', '7815696ecbf1c96e6894b779456d330e', 'inactive', '2020-03-15'),
(16, 'lessee', 'test', 'test', 'test', '098f6bcd4621d373cade4e832627b4f6', '', '2020-03-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
