-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 08:50 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `businessunit`
--

CREATE TABLE `businessunit` (
  `buid` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businessunit`
--

INSERT INTO `businessunit` (`buid`, `descr`, `active`) VALUES
(1, 'Cable Network', 'Y'),
(2, 'Roku', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `formdata`
--

CREATE TABLE `formdata` (
  `formid` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `formurl` varchar(255) NOT NULL,
  `jsfile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formdata`
--

INSERT INTO `formdata` (`formid`, `descr`, `formurl`, `jsfile`) VALUES
(1, 'Navigation', 'sdk/navigation', ''),
(2, 'Add Customer', 'customer/add', 'party/main,party/partyadd'),
(3, 'View Customer', 'customer/view', 'party/main'),
(4, 'Item', 'master/item', ''),
(5, 'Users', 'administrator/users', ''),
(6, 'User Level', 'administrator/userlevel', ''),
(7, 'User Rights', 'administrator/userrights', ''),
(8, 'Gate Entry', 'inventory/gateentry', 'gate/main');

-- --------------------------------------------------------

--
-- Table structure for table `nav`
--

CREATE TABLE `nav` (
  `navid` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nav`
--

INSERT INTO `nav` (`navid`, `descr`, `parentid`, `url`, `icon`, `active`) VALUES
(1, 'Dashboard', 0, '', 'bi bi-grid', 'Y'),
(2, 'Add Customer', 0, 'crmform/2/2', 'bi bi-person', 'Y'),
(3, 'View Customer', 0, 'crmform/3/3', 'bi bi-people', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `navfeatures`
--

CREATE TABLE `navfeatures` (
  `navfeaturesid` int(11) NOT NULL,
  `navid` int(11) NOT NULL,
  `descr` varchar(10) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'Y',
  `modelname` varchar(255) NOT NULL,
  `functionname` varchar(255) NOT NULL,
  `findertable` varchar(20) NOT NULL,
  `visiblecolumns` varchar(255) NOT NULL,
  `parentcolumns` varchar(255) NOT NULL,
  `visiblecolumns_descr` varchar(255) NOT NULL,
  `visiblecolumns_width` varchar(255) NOT NULL,
  `preload_modelname` varchar(255) NOT NULL,
  `preload_method` varchar(255) NOT NULL,
  `finder_conditions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navfeatures`
--

INSERT INTO `navfeatures` (`navfeaturesid`, `navid`, `descr`, `active`, `modelname`, `functionname`, `findertable`, `visiblecolumns`, `parentcolumns`, `visiblecolumns_descr`, `visiblecolumns_width`, `preload_modelname`, `preload_method`, `finder_conditions`) VALUES
(1, 2, 'view', 'Y', 'Master/Partymodel', 'view', '', '', '', '', '', 'Customermodel', 'pre_view', ''),
(2, 2, 'add', 'Y', 'Master/Partymodel', 'save', '', '', '', '', '', '', '', ''),
(3, 2, 'revise', 'Y', 'Master/Partymodel', 'revise', '', '', '', '', '', '', '', ''),
(4, 2, 'find', 'Y', '', '', 'party', 'partyid,firstname,lastname', 'partyid', 'Customer Id,First Name,Last Name', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `partyid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `addressline1` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(10) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `buid` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`partyid`, `firstname`, `lastname`, `email`, `phone`, `addressline1`, `state`, `city`, `zipcode`, `buid`, `reason`, `created_by`, `updated_by`, `created_datetime`, `updated_datetime`) VALUES
(485, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(486, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(487, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(488, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(489, 'Joseph', 'Singh', 'dfsdfm@mail.com', '54513132', 'jsldk jl sdj', 'AK', 'Ludhiana', '141010', 0, '', 1, 0, '2023-04-27 00:14:54', '2023-04-27 00:14:54'),
(490, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(491, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(492, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(493, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(494, 'Joseph', 'Singh', 'dfsdfm@mail.com', '54513132', 'jsldk jl sdj', 'AK', 'Ludhiana', '141010', 0, '', 1, 0, '2023-04-27 00:14:54', '2023-04-27 00:14:54'),
(495, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(496, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(497, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(498, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(499, 'Joseph', 'Singh', 'dfsdfm@mail.com', '54513132', 'jsldk jl sdj', 'AK', 'Ludhiana', '141010', 0, '', 1, 0, '2023-04-27 00:14:54', '2023-04-27 00:14:54'),
(500, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(501, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(502, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, 'hjkh', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(503, 'Demo ', 'Singh', 'mail.dkd@mail.com', '2654654', 'kldsfj', 'MA', 'Ludhiana', '141008', 0, '', 1, 1, '2023-04-26 22:40:16', '2023-04-26 22:40:16'),
(504, 'Joseph', 'Singh', 'dfsdfm@mail.com', '54513132', '101 Manning Dr', 'NC', 'Chapel Hil', '27514', 0, 'cable tv', 1, 1, '2023-04-27 00:14:54', '2023-04-27 00:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `partycard`
--

CREATE TABLE `partycard` (
  `partycardid` int(11) NOT NULL,
  `partyid` int(11) NOT NULL,
  `cardno` varchar(255) NOT NULL,
  `expirydate` varchar(10) NOT NULL,
  `cvv` int(11) NOT NULL,
  `amount` float NOT NULL,
  `buid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partycard`
--

INSERT INTO `partycard` (`partycardid`, `partyid`, `cardno`, `expirydate`, `cvv`, `amount`, `buid`) VALUES
(1, 485, '545454654', '2022-05', 232, 21321, 1),
(2, 489, '54513215465', '2023-04', 551351, 546, 1);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state` varchar(22) NOT NULL,
  `state_code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state`, `state_code`) VALUES
('Alaska', 'AK'),
('Alabama', 'AL'),
('Arkansas', 'AR'),
('Arizona', 'AZ'),
('California', 'CA'),
('Colorado', 'CO'),
('Connecticut', 'CT'),
('District of Columbia', 'DC'),
('Delaware', 'DE'),
('Florida', 'FL'),
('Georgia', 'GA'),
('Hawaii', 'HI'),
('Iowa', 'IA'),
('Idaho', 'ID'),
('Illinois', 'IL'),
('Indiana', 'IN'),
('Kansas', 'KS'),
('Kentucky', 'KY'),
('Louisiana', 'LA'),
('Massachusetts', 'MA'),
('Maryland', 'MD'),
('Maine', 'ME'),
('Michigan', 'MI'),
('Minnesota', 'MN'),
('Missouri', 'MO'),
('Mississippi', 'MS'),
('Montana', 'MT'),
('North Carolina', 'NC'),
('North Dakota', 'ND'),
('Nebraska', 'NE'),
('New Hampshire', 'NH'),
('New Jersey', 'NJ'),
('New Mexico', 'NM'),
('Nevada', 'NV'),
('New York', 'NY'),
('Ohio', 'OH'),
('Oklahoma', 'OK'),
('Oregon', 'OR'),
('Pennsylvania', 'PA'),
('Rhode Island', 'RI'),
('South Carolina', 'SC'),
('South Dakota', 'SD'),
('Tennessee', 'TN'),
('Texas', 'TX'),
('Utah', 'UT'),
('Virginia', 'VA'),
('Vermont', 'VT'),
('Washington', 'WA'),
('Wisconsin', 'WI'),
('West Virginia', 'WV'),
('Wyoming', 'WY');

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE `userlevel` (
  `userlevelid` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `active` varchar(1) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`userlevelid`, `descr`, `active`, `created_by`) VALUES
(1, 'Administrator', 'Y', 1),
(2, 'Sales Agent', 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userright`
--

CREATE TABLE `userright` (
  `userrightid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `userlevel` int(11) NOT NULL,
  `descr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userright`
--

INSERT INTO `userright` (`userrightid`, `userid`, `userlevel`, `descr`) VALUES
(14, 0, 2, 'Sales Agent Permission');

-- --------------------------------------------------------

--
-- Table structure for table `userrightdet`
--

CREATE TABLE `userrightdet` (
  `userrightdetid` int(11) NOT NULL,
  `userrightid` int(11) NOT NULL,
  `navid` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userrightdet`
--

INSERT INTO `userrightdet` (`userrightdetid`, `userrightid`, `navid`, `active`) VALUES
(49, 14, 1, 'Y'),
(50, 14, 2, 'Y'),
(51, 14, 3, 'Y'),
(52, 14, 4, 'Y'),
(53, 14, 5, 'Y'),
(54, 14, 6, ''),
(55, 14, 7, ''),
(56, 14, 10, 'Y'),
(57, 14, 11, ''),
(58, 14, 12, ''),
(59, 14, 13, ''),
(60, 14, 14, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `hod` varchar(11) NOT NULL,
  `userlevel` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'Y',
  `super` char(1) NOT NULL DEFAULT 'N',
  `item_security` varchar(255) NOT NULL,
  `party_security` varchar(255) NOT NULL,
  `finderinnewtab` varchar(1) NOT NULL DEFAULT 'N',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `update_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `descr`, `hod`, `userlevel`, `active`, `super`, `item_security`, `party_security`, `finderinnewtab`, `created_by`, `updated_by`, `created_datetime`, `update_datetime`) VALUES
(1, 'ADMIN', 'admin', 'System Admin', '', 1, 'Y', 'Y', '', '', 'N', 1, 1, '2022-09-01 23:16:13', '2022-09-01 23:16:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businessunit`
--
ALTER TABLE `businessunit`
  ADD PRIMARY KEY (`buid`);

--
-- Indexes for table `formdata`
--
ALTER TABLE `formdata`
  ADD PRIMARY KEY (`formid`);

--
-- Indexes for table `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`navid`);

--
-- Indexes for table `navfeatures`
--
ALTER TABLE `navfeatures`
  ADD PRIMARY KEY (`navfeaturesid`),
  ADD KEY `navfeatures_fk` (`navid`),
  ADD KEY `navfeaturesid` (`navfeaturesid`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`partyid`),
  ADD KEY `partyid` (`partyid`),
  ADD KEY `partyid_2` (`partyid`);

--
-- Indexes for table `partycard`
--
ALTER TABLE `partycard`
  ADD PRIMARY KEY (`partycardid`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_code`);

--
-- Indexes for table `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `userright`
--
ALTER TABLE `userright`
  ADD PRIMARY KEY (`userrightid`);

--
-- Indexes for table `userrightdet`
--
ALTER TABLE `userrightdet`
  ADD PRIMARY KEY (`userrightdetid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `users_fk` (`hod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businessunit`
--
ALTER TABLE `businessunit`
  MODIFY `buid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `formdata`
--
ALTER TABLE `formdata`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nav`
--
ALTER TABLE `nav`
  MODIFY `navid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `navfeatures`
--
ALTER TABLE `navfeatures`
  MODIFY `navfeaturesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `partyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT for table `partycard`
--
ALTER TABLE `partycard`
  MODIFY `partycardid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlevel`
--
ALTER TABLE `userlevel`
  MODIFY `userlevelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userright`
--
ALTER TABLE `userright`
  MODIFY `userrightid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `userrightdet`
--
ALTER TABLE `userrightdet`
  MODIFY `userrightdetid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
