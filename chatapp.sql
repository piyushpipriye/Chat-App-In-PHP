-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 03:57 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `userchat`
--

CREATE TABLE `userchat` (
  `msg_id` int(11) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `receiver_name` varchar(100) NOT NULL,
  `msg_content` varchar(100) NOT NULL,
  `msg_status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userchat`
--

INSERT INTO `userchat` (`msg_id`, `sender_name`, `receiver_name`, `msg_content`, `msg_status`, `msg_date`) VALUES
(47, 'Piyush', 'varun ', 'hi varun', 'read', '2020-04-24 12:58:06'),
(49, 'Piyush', 'Piyush', 'hi', 'read', '2020-04-24 13:00:10'),
(50, 'Piyush', 'varun ', 'ky hua', 'read', '2020-04-24 13:00:41'),
(51, 'varun ', 'Piyush', 'kuch nhi ', 'read', '2020-04-24 13:02:19'),
(52, 'Piyush', 'varun ', 'okk', 'read', '2020-04-24 13:46:59'),
(53, 'varun ', 'Piyush', 'hmm.', 'read', '2020-04-24 13:47:28'),
(54, 'varun ', 'Piyush', 'accha', 'read', '2020-04-24 13:49:00'),
(55, 'varun ', 'Piyush', 'okk', 'read', '2020-04-24 13:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_profile` varchar(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `forgotten_answer` varchar(100) NOT NULL,
  `log_in` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_profile`, `user_country`, `user_gender`, `forgotten_answer`, `log_in`) VALUES
(23, 'Piyush', 'piyush#12', 'pipriyepiyush00@gmail.com', 'Jellyfish.jpg', 'U.S.A.', 'Male', 'omkar', 'Online'),
(25, 'varun ', 'varun#123', 'varun@gmail.com', 'Koala.jpg', 'India', 'Male', 'someone', 'Offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userchat`
--
ALTER TABLE `userchat`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userchat`
--
ALTER TABLE `userchat`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
