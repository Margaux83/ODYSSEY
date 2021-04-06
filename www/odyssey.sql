-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mar. 06 avr. 2021 à 20:24
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `odyssey`
--

-- --------------------------------------------------------

--
-- Structure de la table `ody_Article`
--

CREATE TABLE `ody_Article` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) COLLATE utf8_bin NOT NULL,
  `Content` text COLLATE utf8_bin NOT NULL,
  `DateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateEdit` datetime DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Visibility` tinyint(4) NOT NULL,
  `isDraft` tinyint(4) NOT NULL,
  `Description` text COLLATE utf8_bin,
  `id_Category` int(11) UNSIGNED NOT NULL,
  `id_User` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Article_Page`
--

CREATE TABLE `ody_Article_Page` (
  `ID` int(11) UNSIGNED NOT NULL,
  `id_Article` int(11) UNSIGNED NOT NULL,
  `id_Page` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Category`
--

CREATE TABLE `ody_Category` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8_bin NOT NULL,
  `Type` varchar(255) COLLATE utf8_bin NOT NULL,
  `DateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Comment`
--

CREATE TABLE `ody_Comment` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) COLLATE utf8_bin NOT NULL,
  `Content` text COLLATE utf8_bin NOT NULL,
  `DateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateEdit` datetime DEFAULT NULL,
  `Firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_Article` int(11) UNSIGNED NOT NULL,
  `Lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(320) COLLATE utf8_bin NOT NULL,
  `isDeleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Config`
--

CREATE TABLE `ody_Config` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Database_name` varchar(120) COLLATE utf8_bin NOT NULL,
  `Website_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `URL_name` text COLLATE utf8_bin NOT NULL,
  `Langue` varchar(255) COLLATE utf8_bin NOT NULL,
  `Timezone` varchar(255) COLLATE utf8_bin NOT NULL,
  `Server_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `Port` char(4) COLLATE utf8_bin NOT NULL,
  `DateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateEdit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Page`
--

CREATE TABLE `ody_Page` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) COLLATE utf8_bin NOT NULL,
  `Content` text COLLATE utf8_bin NOT NULL,
  `DateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateEdit` datetime DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `isDraft` tinyint(4) NOT NULL,
  `Visibility` tinyint(4) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Description` text COLLATE utf8_bin,
  `id_Category` int(11) UNSIGNED NOT NULL,
  `id_User` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_User`
--

CREATE TABLE `ody_User` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Firstname` varchar(120) COLLATE utf8_bin NOT NULL,
  `Lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(320) COLLATE utf8_bin NOT NULL,
  `Password` varchar(255) COLLATE utf8_bin NOT NULL,
  `Role` tinyint(4) NOT NULL,
  `Phone` int(11) NOT NULL,
  `DateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateEdit` datetime DEFAULT NULL,
  `Status` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ody_Article`
--
ALTER TABLE `ody_Article`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `id_Category` (`id_Category`),
  ADD KEY `id_User` (`id_User`);

--
-- Index pour la table `ody_Article_Page`
--
ALTER TABLE `ody_Article_Page`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `id_Article` (`id_Article`),
  ADD KEY `id_Page` (`id_Page`);

--
-- Index pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_Article` (`id_Article`);

--
-- Index pour la table `ody_Config`
--
ALTER TABLE `ody_Config`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `id_Category` (`id_Category`),
  ADD KEY `id_User` (`id_User`);

--
-- Index pour la table `ody_User`
--
ALTER TABLE `ody_User`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ody_Article`
--
ALTER TABLE `ody_Article`
  ADD CONSTRAINT `ody_Article_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `ody_Comment` (`id_Article`),
  ADD CONSTRAINT `ody_Article_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `ody_Article_Page` (`id_Article`);

--
-- Contraintes pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  ADD CONSTRAINT `ody_Category_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `ody_Page` (`id_Category`),
  ADD CONSTRAINT `ody_Category_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `ody_Article` (`id_Category`);

--
-- Contraintes pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  ADD CONSTRAINT `ody_Page_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `ody_Article_Page` (`id_Page`);

--
-- Contraintes pour la table `ody_User`
--
ALTER TABLE `ody_User`
  ADD CONSTRAINT `ody_User_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `ody_Article` (`id_User`),
  ADD CONSTRAINT `ody_User_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `ody_Page` (`id_User`),
  ADD CONSTRAINT `ody_User_ibfk_3` FOREIGN KEY (`ID`) REFERENCES `ody_Page` (`id_User`),
  ADD CONSTRAINT `ody_User_ibfk_4` FOREIGN KEY (`ID`) REFERENCES `ody_Page` (`id_User`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
