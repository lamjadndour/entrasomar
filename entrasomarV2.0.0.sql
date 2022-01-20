-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 19 jan. 2022 à 20:52
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `entrasomarv2`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwords` varchar(100) NOT NULL,
  `role` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `passwords`, `role`) VALUES
(1, 'test', 'test', 'superadmin');

-- --------------------------------------------------------

--
-- Structure de la table `boat`
--

CREATE TABLE `boat` (
  `id-boat` int(11) NOT NULL,
  `id-sup` int(11) NOT NULL,
  `name-boat` varchar(250) NOT NULL,
  `name-capitane-boat` varchar(250) NOT NULL,
  `capitane-phone-boat` varchar(250) NOT NULL,
  `mecanisien-name` varchar(200) NOT NULL,
  `phone-mecanisien` varchar(200) NOT NULL,
  `type-boat` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boat`
--

INSERT INTO `boat` (`id-boat`, `id-sup`, `name-boat`, `name-capitane-boat`, `capitane-phone-boat`, `mecanisien-name`, `phone-mecanisien`, `type-boat`, `date`) VALUES
(3, 1, 'hooooooo', 'abdilah', '888888888', 'ahmed', '0616534343', 'type1', '2021-12-08 00:00:00'),
(7, 4, 'nnnn', 'bhn', 'kolm', 'azize', '0523435465', 'type2', '2021-12-09 00:00:00'),
(8, 14, 'othmane hannoune', 'othmane hannoune', '0645454545', 'othmane hannoune', '0687766565', 'type3', '2021-12-08 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
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
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id-facture`, `id-sup`, `id-boat`, `id-mission`, `num_facture`, `avance`, `total`, `reste`, `remise`, `status`) VALUES
(11, 4, 7, 5, '350/8', 0, 4700, 2500, 2500, 'Progress'),
(12, 14, 8, 11, '351/9', 200, 3060, 2300, 2500, 'Progress');

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id-mission` int(11) NOT NULL,
  `status-mission` varchar(250) NOT NULL,
  `id-boat` int(11) NOT NULL,
  `date-start` date NOT NULL,
  `date-end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id-mission`, `status-mission`, `id-boat`, `date-start`, `date-end`) VALUES
(5, 'Progress', 7, '2021-12-03', '2021-12-09'),
(7, 'Done', 8, '2021-12-09', '2021-12-09'),
(11, 'Progress', 8, '2022-01-19', '2022-01-19');

-- --------------------------------------------------------

--
-- Structure de la table `plangeur`
--

CREATE TABLE `plangeur` (
  `id-plangeur` int(11) NOT NULL,
  `name-plangeur` varchar(250) NOT NULL,
  `phone-plangeur` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `plangeur`
--

INSERT INTO `plangeur` (`id-plangeur`, `name-plangeur`, `phone-plangeur`) VALUES
(4, 'khorziii', '0612345678'),
(5, '3oobo ', '0612345678');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id-service` int(11) NOT NULL,
  `name-service` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id-service`, `name-service`) VALUES
(5, 'categorie1');

-- --------------------------------------------------------

--
-- Structure de la table `sup`
--

CREATE TABLE `sup` (
  `id-sup` int(11) NOT NULL,
  `name-sup` varchar(250) NOT NULL,
  `phone-sup` varchar(250) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sup`
--

INSERT INTO `sup` (`id-sup`, `name-sup`, `phone-sup`, `date`) VALUES
(1, 'name1-sup', '0612345678', '0000-00-00'),
(2, 'testsup', '0612345678', '0000-00-00'),
(4, 'lkjoij', 'ijoijo', '2021-11-18'),
(14, 'waloooo', '0623434543', '2021-12-03');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id-tache` int(11) NOT NULL,
  `tache-name` varchar(200) NOT NULL,
  `id-mission` int(11) NOT NULL,
  `category` varchar(250) NOT NULL,
  `id-plangeur` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantite` int(11) NOT NULL,
  `status-tache` varchar(250) NOT NULL,
  `prime` varchar(250) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id-tache`, `tache-name`, `id-mission`, `category`, `id-plangeur`, `price`, `quantite`, `status-tache`, `prime`, `date`) VALUES
(15, 'controle122', 5, '5', 5, 2001, 1, 'Done', 'non', '2022-01-13'),
(16, 'controle 3', 5, '5', 5, 1700, 3, 'Progress', 'non', '2022-01-19'),
(19, 'tache 1', 11, '5', 5, 3050, 1, 'Progress', 'non', '2022-01-19'),
(20, 'tache', 11, '5', 5, 10, 2, 'Progress', 'oui', '2022-01-19'),
(21, 'tache1', 7, '5', 5, 3000, 3, 'Progress', 'non', '2022-01-19');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `boat`
--
ALTER TABLE `boat`
  ADD PRIMARY KEY (`id-boat`),
  ADD KEY `id-sup` (`id-sup`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id-facture`),
  ADD KEY `id-sup` (`id-sup`),
  ADD KEY `id-boat` (`id-boat`),
  ADD KEY `id-mission` (`id-mission`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id-mission`),
  ADD KEY `id-boat` (`id-boat`);

--
-- Index pour la table `plangeur`
--
ALTER TABLE `plangeur`
  ADD PRIMARY KEY (`id-plangeur`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id-service`);

--
-- Index pour la table `sup`
--
ALTER TABLE `sup`
  ADD PRIMARY KEY (`id-sup`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id-tache`),
  ADD KEY `id-mission` (`id-mission`),
  ADD KEY `id-service` (`category`),
  ADD KEY `id-plangeur` (`id-plangeur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `boat`
--
ALTER TABLE `boat`
  MODIFY `id-boat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id-facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id-mission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `plangeur`
--
ALTER TABLE `plangeur`
  MODIFY `id-plangeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id-service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sup`
--
ALTER TABLE `sup`
  MODIFY `id-sup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id-tache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boat`
--
ALTER TABLE `boat`
  ADD CONSTRAINT `boat_ibfk_1` FOREIGN KEY (`id-sup`) REFERENCES `sup` (`id-sup`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
