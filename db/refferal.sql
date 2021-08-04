-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 02:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `refferal`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `ID` int(20) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Brief_desc` varchar(255) NOT NULL,
  `ImagePath` varchar(100) NOT NULL,
  `Article` varchar(10000) NOT NULL,
  `Date_published` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `Article_ID` varchar(255) NOT NULL,
  `Popularity` int(10) NOT NULL,
  `Tag` text NOT NULL,
  `Approved` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`ID`, `Author`, `Title`, `Brief_desc`, `ImagePath`, `Article`, `Date_published`, `Article_ID`, `Popularity`, `Tag`, `Approved`) VALUES
(9, 'bennkaiser', 'Write Something Inspiring', 'Write Something Inspiring', './static/images/jumbotron.png', 'Write Something Inspiring', '2021-08-01 15:24:03.155331', 'PxuM8lTJZuvpUnxH', 0, '', 0),
(21, 'bennkaiser', 'kanairo gathe kaka', 'holla bronathe', './static/images/uploads/z2jkhbZtQ2/0dedf802f71bda03f99358e928b3903c.jpg', 'holla bronathe', '2021-08-01 16:41:25.311768', 'nFSo8InFOz3xIE8Q', 1, '', 0),
(22, 'bennkaiser', 'programming', 'debbian sky hero', './static/images/uploads/z2jkhbZtQ2/0b2776fdb1b05c40e141a79b817b59a4.jpg', 'debbian sky hero', '2021-08-01 16:47:42.096421', 'kLkCRc4KKLfF3CC0', 0, '', 0),
(23, 'bennkaiser', 'programming', 'debbian sky hero', './static/images/uploads/z2jkhbZtQ2/0571daa787a591096849f59be6785724.jpg', 'debbian sky hero', '2021-08-01 16:49:05.692485', 'H9vls2mmERFBm3NJ', 0, '', 0),
(24, 'finnneron', 'Trespassing', 'Yolo', './static/images/uploads/odI6BTcSNQ/f55c99a02ce33fc83827b84898e8816c.jpg', 'Yolo', '2021-08-01 19:26:06.653294', 'bEiKKHWEoKP8Y5HO', 0, '', 0),
(25, 'finnneron', 'MAVERICKS', 'By using our internet service, you hereby expressly acknowledge and agree that there are significant security, privacy and confidentiality risks inherent in accessing or transmitting information through the internet, whether the connection is facilitated ', './static/images/uploads/odI6BTcSNQ/204aa355d95317715af0b3e61f2f583e.jpg', 'By using our internet service, you hereby expressly acknowledge and agree that there are significant security, privacy and confidentiality risks inherent in accessing or transmitting information through the internet, whether the connection is facilitated through wired or wireless technology. Security issues include, without limitation, interception of transmissions, loss of data, and the introduction or viruses and other programs that can corrupt or damage your computer.\r\n\r\nAccordingly, you agree that the owner and/or provider of this network is NOT liable for any interception or transmissions, computer worms or viruses, loss of data, file corruption, hacking or damage to your computer or other devices that result from the transmission or download of information or materials through the internet service provided.\r\n\r\nUse of the wireless network is subject to the general restrictions outlined below. If abnormal, illegal, or unauthorized behavior is detected, including heavy consumption of bandwidth, the network provider reserves the right to permanently disconnect the offending device from the wireless network.\r\n\r\nExamples of Illegal Uses\r\n\r\nThe following are representative examples only and do not comprise a comprehensive list of illegal uses:', '2021-08-01 19:28:11.082202', 'rkb1YedmkdF5g8pn', 0, '', 1),
(26, 'bennkaiser', 'Deductive fallacy of relevance', 'Ad hominem (look who is talking)\r\nAd hominem abusive\r\nAd hominem circumstancial\r\nArgumentum ad populum\r\nArgumentum ad Misericordian (inappropriate appeal to pity)\r\nArgumentum ad baculum ( appeal to force or appeal to scare tactics)\r\nstrawman fallacy ( dis', './static/images/uploads/z2jkhbZtQ2/30a70cc1546aef9017ecb358f4b3b16c.jpg', 'Ad hominem (look who is talking)\r\nAd hominem abusive\r\nAd hominem circumstancial\r\nArgumentum ad populum\r\nArgumentum ad Misericordian (inappropriate appeal to pity)\r\nArgumentum ad baculum ( appeal to force or appeal to scare tactics)\r\nstrawman fallacy ( distorting the argument )\r\ntwo wrongs make a right\r\nIgnoratio Elenchi ( fallacy of irrelevant conclusion)\r\n\r\n\r\ninductive\r\nArgumentum ad vericundilum (inappropriate appeal to authority)\r\nhasty generalization\r\nfallacy of questionable cause or false cause\r\nPost hoc fallacy ( therefore because of this )\r\nMere correlation fallacy\r\nOversimplified fallacy\r\nArgumentum ad ignoratium ( appeal to ignorance )\r\n\r\n\r\nfallacies of presumption\r\nFalse dichotomy', '2021-08-02 14:23:57.026245', '3eHooZon0isqFIXz', 0, '', 0),
(27, 'bennkaiser', 'Deductive fallacy of relevance', 'Snap', './static/images/uploads/z2jkhbZtQ2/1889ecbe7d3d8fbbf0970f43e37aacc5.png', 'Snap', '2021-08-02 21:03:51.254096', 'FpkIaCAToI8TDbV7', 0, '', 0),
(30, 'bennkaiser', 'System and Network Threat', 'Program threats typically use a breakdown in the protection mechanisms of a system to attack programs. In contrast, system and network threats involve the abuse of services and network connections. System and network threats create a situation in which op', './static/images/uploads/z2jkhbZtQ2/b7a0e329dcf6df15180936ad580ebcb6.png', 'Program threats typically use a breakdown in the protection mechanisms of a system to attack programs. In contrast, system and network threats involve the abuse of services and network connections. System and network threats create a situation in which operating-system resources and user files are misused. Sometimes, a system and network attack is used to launch a program attack, and vice versa.\r\na)	Worms\r\nA worm is a process that uses the spawn mechanism to duplicate itself. The worm spawns copies of itself, using up system resources and perhaps locking out all other processes. On computer networks, worms are particularly potent, since they may reproduce themselves among systems and thus shut down an entire network.\r\nb)	Port Scanning\r\nPort scanning is not an attack but rather a means for a cracker to detect a system’s vulnerabilities to attack. Port scanning typically is automated, involving a tool that attempts to create a TCP/IP connection to a specific port or a range of ports. Because port scans are detectable (Section 15.6.3), they frequently are launched from zombie systems. Such systems are previously compromised, independent systems that are serving their owners while being used for nefarious purposes, including denial-of-service attacks and spam relay. Zombies make crackers particularly difficult to prosecute because determining the source of the attack and the person that launched it is challenging. This is one of many reasons for securing “inconsequential” systems, not just systems containing “valuable” information or services', '2021-08-03 16:56:03.269120', '5u8oz7Q5LT1PNKVf', 0, '', 1),
(32, 'bennkaiser', 'System and Network Threat', 'Program threats typically use a breakdown in the protection mechanisms of a system to attack programs. In contrast, system and network threats involve the abuse of services and network connections. System and network threats create a situation in which op', './static/images/uploads/z2jkhbZtQ2/1c12f422ddd6f6779cb2e5aee0d429e8.png', 'Program threats typically use a breakdown in the protection mechanisms of a system to attack programs. In contrast, system and network threats involve the abuse of services and network connections. System and network threats create a situation in which operating-system resources and user files are misused. Sometimes, a system and network attack is used to launch a program attack, and vice versa.\r\na)	Worms\r\nA worm is a process that uses the spawn mechanism to duplicate itself. The worm spawns copies of itself, using up system resources and perhaps locking out all other processes. On computer networks, worms are particularly potent, since they may reproduce themselves among systems and thus shut down an entire network.\r\nb)	Port Scanning\r\nPort scanning is not an attack but rather a means for a cracker to detect a system’s vulnerabilities to attack. Port scanning typically is automated, involving a tool that attempts to create a TCP/IP connection to a specific port or a range of ports. Because port scans are detectable (Section 15.6.3), they frequently are launched from zombie systems. Such systems are previously compromised, independent systems that are serving their owners while being used for nefarious purposes, including denial-of-service attacks and spam relay. Zombies make crackers particularly difficult to prosecute because determining the source of the attack and the person that launched it is challenging. This is one of many reasons for securing “inconsequential” systems, not just systems containing “valuable” information or services.', '2021-08-03 17:15:30.571255', 'PHulKuGBMZUNNwmN', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `ID` int(10) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `AuthID` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Admin_Session` varchar(100) NOT NULL,
  `Trial` int(10) NOT NULL,
  `Approval` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `core`
--

INSERT INTO `core` (`ID`, `Username`, `AuthID`, `Password`, `Admin_Session`, `Trial`, `Approval`) VALUES
(2, 'bennkaiser', 'bennkaiser', '$2y$10$JaAjQ.dY71aeqFYJXWSZcOfCxR5O7VkDNThrlzvDIopxAESPidUEG', 'Q3IG29P9sI', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `ID` int(50) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `User_ID` varchar(100) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Ammount` int(255) NOT NULL,
  `Days_no` int(100) NOT NULL,
  `Time` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`ID`, `Username`, `User_ID`, `Type`, `Ammount`, `Days_no`, `Time`) VALUES
(0, 'bennkaiser', 'z2jkhbZtQ2', 'platinum', 200, 4, '2021-08-03 18:46:25.660424'),
(0, 'bennkaiser', 'z2jkhbZtQ2', 'platinum', 200, 4, '2021-08-03 18:54:22.391129'),
(0, 'bennkaiser', 'z2jkhbZtQ2', 'gold', 150, 14, '2021-08-03 20:02:19.432133');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `ID` int(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Subscribe_Date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`ID`, `Email`, `Username`, `Subscribe_Date`) VALUES
(1, 'dennis@gmail.com', 'Refferal Subscriber', '2021-08-02 13:12:00.861390'),
(2, 'bennkaiser1@gmail.com', 'bennkaiser', '2021-08-02 13:19:06.608363'),
(3, 'bennkaiser1@gmail.com', 'bennkaiser', '2021-08-02 13:42:14.996007'),
(4, 'finnneron@gmail.com', 'finnneron', '2021-08-02 14:16:45.347764');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(255) NOT NULL,
  `Username` text NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RefferalCode` smallint(100) NOT NULL,
  `SessionID` varchar(20) NOT NULL,
  `Verified` tinyint(10) NOT NULL,
  `UserId` varchar(100) NOT NULL,
  `Downlines` varchar(255) NOT NULL,
  `Balance` int(11) NOT NULL,
  `DateJoined` datetime NOT NULL DEFAULT current_timestamp(),
  `DescInvestments` varchar(10000) NOT NULL,
  `Active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Email`, `Password`, `RefferalCode`, `SessionID`, `Verified`, `UserId`, `Downlines`, `Balance`, `DateJoined`, `DescInvestments`, `Active`) VALUES
(20, 'commercialagents', 'commercialagents12@gmail.com', '$2y$10$Ntx0yIHYDI1KCc/YqQCFSuj/l2p5OKDEm.QkxdIeX5pO1szakLNyG', 0, 'RCsj2qQ8Jt9onS6Z', 1, 'VERiz7uuGpuIN', '', 0, '2021-07-31 15:04:03', '', 0),
(22, 'bennkaiser', 'bennkaiser1@gmail.com', '$2y$10$dlt9iTlnqA/h187Un0HbSua8Jiu/F6JmtawzZAs/5A7rx555T0bf.', 1, 'Cwy7vUOZQdtJp0Wz', 0, 'z2jkhbZtQ2', 'odI6BTcSNQ', 300, '2021-07-31 15:20:02', 'dennis:kibet:rono:5000:Platinum;Walter:kibet:Rono:500:Gold;', 0),
(24, 'finnneron', 'finnneron@gmail.com', '$2y$10$trXusygPLnHGrNDCfv6jNOif3TH.fpghIJcbS9XfM8wogkud4THA.', 2, '5LHL6ymg6s5pT4CQ', 0, 'odI6BTcSNQ', '', 0, '2021-07-31 15:27:52', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
