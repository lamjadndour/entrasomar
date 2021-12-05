-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2021 at 07:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `entrasomar2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwords` varchar(100) NOT NULL,
  `role` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `passwords`, `role`) VALUES
(1, 'test', 'test', 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `boat`
--

CREATE TABLE `boat` (
  `id-boat` int(11) NOT NULL,
  `serie-boat` varchar(250) NOT NULL,
  `id-sup` int(11) NOT NULL,
  `name-boat` varchar(250) NOT NULL,
  `name-capitane-boat` varchar(250) NOT NULL,
  `type-boat` varchar(250) NOT NULL,
  `capitane-phone-boat` varchar(250) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boat`
--

INSERT INTO `boat` (`id-boat`, `serie-boat`, `id-sup`, `name-boat`, `name-capitane-boat`, `type-boat`, `capitane-phone-boat`, `date`) VALUES
(8, 'hhhhhff', 1, 'ffffffff', 'abdelilahdd', 'bna', 'kolm', '2021-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `id-facture` int(11) NOT NULL,
  `id-sup` int(11) NOT NULL,
  `id-boat` int(11) NOT NULL,
  `id-mission` int(11) NOT NULL,
  `num_facture` varchar(200) NOT NULL,
  `avance` double NOT NULL,
  `total` double NOT NULL,
  `reste` double NOT NULL,
  `remise` double NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`id-facture`, `id-sup`, `id-boat`, `id-mission`, `num_facture`, `avance`, `total`, `reste`, `remise`, `status`) VALUES
(9, 4, 7, 5, '351/9', 0, 3000, 2500, 2500, 'Progress'),
(10, 1, 8, 7, '899', 200, 500, 200, 400, 'Progress');

-- --------------------------------------------------------

--
-- Table structure for table `mission`
--

CREATE TABLE `mission` (
  `id-mission` int(11) NOT NULL,
  `status-mission` varchar(250) NOT NULL,
  `id-boat` int(11) NOT NULL,
  `date-start` date NOT NULL,
  `date-end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission`
--

INSERT INTO `mission` (`id-mission`, `status-mission`, `id-boat`, `date-start`, `date-end`) VALUES
(7, 'Progress', 8, '2021-12-04', '2021-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `plangeur`
--

CREATE TABLE `plangeur` (
  `id-plangeur` int(11) NOT NULL,
  `name-plangeur` varchar(250) NOT NULL,
  `phone-plangeur` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plangeur`
--

INSERT INTO `plangeur` (`id-plangeur`, `name-plangeur`, `phone-plangeur`) VALUES
(6, 'col', '99999999999'),
(7, 'bol', '77777777777777778');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id-service` int(11) NOT NULL,
  `name-service` varchar(250) NOT NULL,
  `price-service` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id-service`, `name-service`, `price-service`) VALUES
(6, 'test', 500),
(7, 'test2', 9999);

-- --------------------------------------------------------

--
-- Table structure for table `sup`
--

CREATE TABLE `sup` (
  `id-sup` int(11) NOT NULL,
  `name-sup` varchar(250) NOT NULL,
  `phone-sup` varchar(250) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup`
--

INSERT INTO `sup` (`id-sup`, `name-sup`, `phone-sup`, `date`) VALUES
(4, 'lkjoij', 'ijoijo', '2021-11-18'),
(5, 'opjo', 'oihoi', '2021-12-04'),
(6, 'ojp', 'pojpoj', '2021-11-12'),
(7, 'mokPOKPOK', 'pokpok', '2021-11-11'),
(15, 'frays', '8988999899889', '2021-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `id-tache` int(11) NOT NULL,
  `tache-name` varchar(200) NOT NULL,
  `id-mission` int(11) NOT NULL,
  `id-service` int(11) NOT NULL,
  `id-plangeur` int(11) NOT NULL,
  `status-tache` varchar(250) NOT NULL,
  `date-start` date NOT NULL,
  `date-end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`id-tache`, `tache-name`, `id-mission`, `id-service`, `id-plangeur`, `status-tache`, `date-start`, `date-end`) VALUES
(2, '', 1, 1, 2, 'Progress', '2021-11-26', '2021-12-08'),
(5, '', 2, 1, 1, 'Progress', '2021-11-27', '2021-11-27'),
(6, '', 1, 3, 1, 'Progress', '2021-11-28', '2021-12-05'),
(8, '', 3, 1, 1, 'Progress', '2021-11-29', '2021-12-29'),
(9, '', 1, 1, 1, 'Progress', '2021-11-29', '2021-11-30'),
(12, 'controle', 5, 1, 4, 'Progress', '2021-12-03', '2021-12-10'),
(13, 'NNNNN', 5, 2, 4, 'Progress', '2021-12-03', '2021-12-17'),
(15, 'fabric', 7, 6, 6, 'Progress', '2021-12-04', '2021-12-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `boat`
--
ALTER TABLE `boat`
  ADD PRIMARY KEY (`id-boat`),
  ADD KEY `id-sup` (`id-sup`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id-facture`),
  ADD KEY `id-sup` (`id-sup`),
  ADD KEY `id-boat` (`id-boat`),
  ADD KEY `id-mission` (`id-mission`);

--
-- Indexes for table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id-mission`),
  ADD KEY `id-boat` (`id-boat`);

--
-- Indexes for table `plangeur`
--
ALTER TABLE `plangeur`
  ADD PRIMARY KEY (`id-plangeur`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id-service`);

--
-- Indexes for table `sup`
--
ALTER TABLE `sup`
  ADD PRIMARY KEY (`id-sup`);

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id-tache`),
  ADD KEY `id-mission` (`id-mission`),
  ADD KEY `id-service` (`id-service`),
  ADD KEY `id-plangeur` (`id-plangeur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `boat`
--
ALTER TABLE `boat`
  MODIFY `id-boat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `id-facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mission`
--
ALTER TABLE `mission`
  MODIFY `id-mission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `plangeur`
--
ALTER TABLE `plangeur`
  MODIFY `id-plangeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id-service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sup`
--
ALTER TABLE `sup`
  MODIFY `id-sup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `id-tache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
