-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: sql3.cluster1.easy-hebergement.net
-- Generation Time: Jun 24, 2025 at 04:00 PM
-- Server version: 10.3.8-MariaDB-1:10.3.8+maria~wheezy-log
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harfleurpokerc`
--

-- --------------------------------------------------------

--
-- Table structure for table `classement`
--

CREATE TABLE `classement` (
  `id_cla` int(11) NOT NULL,
  `cla_nomjoueur` varchar(50) NOT NULL,
  `cla_rang` int(11) NOT NULL,
  `cla_points` int(11) NOT NULL,
  `id_uti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classement_general`
--

CREATE TABLE `classement_general` (
  `id_gen` int(11) NOT NULL,
  `id_uti` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `bounty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `id_eve` int(11) NOT NULL,
  `eve_titre` varchar(200) NOT NULL,
  `eve_date` date NOT NULL,
  `eve_heure` time NOT NULL,
  `eve_lieu` varchar(100) NOT NULL,
  `eve_description` varchar(500) NOT NULL,
  `id_type_eve` int(11) NOT NULL,
  `eve_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `s_inscrit_a`
--

CREATE TABLE `s_inscrit_a` (
  `id_uti` int(11) NOT NULL,
  `id_eve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trombinoscope`
--

CREATE TABLE `trombinoscope` (
  `id_tro` int(11) NOT NULL,
  `tro_pseudo` varchar(100) NOT NULL,
  `tro_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_evenement`
--

CREATE TABLE `type_evenement` (
  `id_type_eve` int(11) NOT NULL,
  `type_eve` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_evenement`
--

INSERT INTO `type_evenement` (`id_type_eve`, `type_eve`) VALUES
(1, 'Actualité'),
(2, 'Tournoi');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_uti` int(11) NOT NULL,
  `uti_nom` varchar(100) NOT NULL,
  `uti_email` varchar(100) DEFAULT NULL,
  `uti_age` int(11) DEFAULT NULL,
  `uti_mdp` varchar(255) NOT NULL,
  `uti_admin` tinyint(1) NOT NULL DEFAULT 0,
  `uti_approved` tinyint(1) NOT NULL DEFAULT 0,
  `uti_approval_token` varchar(64) DEFAULT NULL,
  `uti_reset_token` varchar(64) DEFAULT NULL,
  `uti_reset_expires` datetime DEFAULT NULL,
  `uti_image_consent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classement`
--
ALTER TABLE `classement`
  ADD PRIMARY KEY (`id_cla`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_eve`);

--
-- Indexes for table `trombinoscope`
--
ALTER TABLE `trombinoscope`
  ADD PRIMARY KEY (`id_tro`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_uti`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classement`
--
ALTER TABLE `classement`
  MODIFY `id_cla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_eve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `trombinoscope`
--
ALTER TABLE `trombinoscope`
  MODIFY `id_tro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `classement_general`
--
ALTER TABLE `classement_general`
  MODIFY `id_gen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_uti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

-- --------------------------------------------------------
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
