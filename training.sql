-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2017 at 11:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training`
--
CREATE DATABASE IF NOT EXISTS `training` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `training`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(5) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `author` varchar(120) NOT NULL,
  `price` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `author`, `price`) VALUES
(1, 'Introduction to Reliability Workbench', 'Get a brief introduction to Reliability Workbench and the features on hand. ', 'Dr. Wiseman', '3000.00'),
(2, 'Introduction to Availability Workbench', 'Brief intro to AWB', 'Joe Belland', '3000.00'),
(3, 'Introduction to FaultTree', 'This is a small introduction to FaultTree', 'Joe Belland', '2700.00'),
(4, 'Test Course 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel diam nec ligula dapibus tincidunt ac et urna. Vestibulum dapibus id ex at tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vulputate orci vitae est rutrum vehicula. Nullam sodales lacus vel dapibus pharetra. Cras cursus eros ut fringilla faucibus. Nunc elit arcu, tincidunt non augue eu, molestie sagittis dui. Nam dignissim vulputate augue, sed varius lorem ultricies ut. Suspendisse molestie mattis lectus, vel faucibus quam tristique sit amet.', 'Connor McCarthy', '1000.00'),
(5, 'Test Course 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel diam nec ligula dapibus tincidunt ac et urna. Vestibulum dapibus id ex at tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vulputate orci vitae est rutrum vehicula. Nullam sodales lacus vel dapibus pharetra. Cras cursus eros ut fringilla faucibus. Nunc elit arcu, tincidunt non augue eu, molestie sagittis dui. Nam dignissim vulputate augue, sed varius lorem ultricies ut. Suspendisse molestie mattis lectus, vel faucibus quam tristique sit amet.', 'Connor McCarthy', '2000.00'),
(6, 'Test Course 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel diam nec ligula dapibus tincidunt ac et urna. Vestibulum dapibus id ex at tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vulputate orci vitae est rutrum vehicula. Nullam sodales lacus vel dapibus pharetra. Cras cursus eros ut fringilla faucibus. Nunc elit arcu, tincidunt non augue eu, molestie sagittis dui. Nam dignissim vulputate augue, sed varius lorem ultricies ut. Suspendisse molestie mattis lectus, vel faucibus quam tristique sit amet.', 'Connor McCarthy', '5000.00'),
(7, 'Test Course 9', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel diam nec ligula dapibus tincidunt ac et urna. Vestibulum dapibus id ex at tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vulputate orci vitae est rutrum vehicula. Nullam sodales lacus vel dapibus pharetra. Cras cursus eros ut fringilla faucibus. Nunc elit arcu, tincidunt non augue eu, molestie sagittis dui. Nam dignissim vulputate augue, sed varius lorem ultricies ut. Suspendisse molestie mattis lectus, vel faucibus quam tristique sit amet.', 'Connor McCarthy', '6000.00'),
(8, 'Test Course 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel diam nec ligula dapibus tincidunt ac et urna. Vestibulum dapibus id ex at tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vulputate orci vitae est rutrum vehicula. Nullam sodales lacus vel dapibus pharetra. Cras cursus eros ut fringilla faucibus. Nunc elit arcu, tincidunt non augue eu, molestie sagittis dui. Nam dignissim vulputate augue, sed varius lorem ultricies ut. Suspendisse molestie mattis lectus, vel faucibus quam tristique sit amet.', 'Connor McCarthy', '9000.00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `name` varchar(500) NOT NULL,
  `value` varchar(500) NOT NULL,
  `Display` varchar(6000) NOT NULL,
  `displayOrder` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`name`, `value`, `Display`, `displayOrder`) VALUES
('currency', '&pound;', 'Display Currency', 1),
('siteName', 'Isograph Training', 'Site Name', 0),
('stripe_publish', 'pk_test_qX4IU257eB0erFrYrpct27pd', 'Stripe Publishable Key', 2),
('stripe_secret', 'sk_test_agboEZpAQisDwKVPc4nmDAs9', 'Stripe Secret Key', 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(5) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `salt` varchar(300) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `profilePictureLocation` varchar(1000) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(900) DEFAULT NULL,
  `firstName` varchar(150) DEFAULT NULL,
  `lastName` varchar(150) DEFAULT NULL,
  `stripeCustomer` varchar(250) DEFAULT NULL,
  `stripeToken` varchar(250) DEFAULT NULL,
  `stripeSubscription` varchar(250) DEFAULT NULL,
  `stripeCard` varchar(250) DEFAULT NULL,
  `addr1` varchar(250) DEFAULT NULL,
  `addr2` varchar(250) DEFAULT NULL,
  `addr3` varchar(250) DEFAULT NULL,
  `town` varchar(250) DEFAULT NULL,
  `county` varchar(250) DEFAULT NULL,
  `postcode` varchar(250) DEFAULT NULL,
  `mobile` text,
  `emailSettings` tinyint(1) DEFAULT '1',
  `emailNewsletter` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstName`, `lastName`, `stripeCustomer`, `stripeToken`, `stripeSubscription`, `stripeCard`, `addr1`, `addr2`, `addr3`, `town`, `county`, `postcode`, `mobile`, `emailSettings`, `emailNewsletter`) VALUES
(27, 'cono.lfc@gmail.com', '6699709874cbdc49c152f690d3aa96869579d328', 'Connor', 'McCarthy', 'cus_BDElNUnXjygzcG', NULL, NULL, NULL, '34 Gleadmere', '', 'Widnes', 'Widnes', 'None (International)', 'WA8 4YQ', '078', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
