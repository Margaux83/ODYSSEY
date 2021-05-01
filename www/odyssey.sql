-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mar. 27 avr. 2021 à 11:59
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
  `DateEdit` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Status` tinyint(4) NOT NULL,
  `Visibility` tinyint(4) NOT NULL,
  `isDraft` tinyint(4) NOT NULL,
  `Description` text COLLATE utf8_bin,
  `id_Category` int(11) UNSIGNED NOT NULL,
  `id_User` int(11) UNSIGNED NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Article`
--

INSERT INTO `ody_Article` (`ID`, `Title`, `Content`, `DateCreation`, `DateEdit`, `Status`, `Visibility`, `isDraft`, `Description`, `id_Category`, `id_User`, `isDeleted`) VALUES
(3, 'xgfxf', '<p>wfdgdfgw<br></p>', '2021-04-16 21:39:05', '2021-04-25 21:12:07', 1, 1, 0, NULL, 1, 1, 0),
(4, 'sshdfhtfd', '&lt;h1&gt;dhsxtfhdddt&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h2&gt;cghgfh&lt;br&gt;&lt;/h2&gt;', '2021-04-16 21:42:33', '2021-04-25 21:12:09', 3, 2, 0, NULL, 3, 1, 0),
(5, 'sshdfhtfd', '&lt;h1&gt;dhsxtfhdddt&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h2&gt;cghgfh&lt;br&gt;&lt;/h2&gt;', '2021-04-16 21:45:40', NULL, 3, 2, 0, NULL, 3, 1, 0),
(6, 'sshdfhtfd', '&lt;h1&gt;dhsxtfhdddt&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h2&gt;cghgfh&lt;br&gt;&lt;/h2&gt;', '2021-04-16 21:46:48', NULL, 3, 2, 0, NULL, 3, 1, 0),
(7, 'Hello world', '&lt;p&gt;drtdry&lt;br&gt;&lt;/p&gt;', '2021-04-18 17:15:28', '2021-04-27 10:20:58', 1, 1, 0, NULL, 1, 1, 0),
(8, 'srgxtf', '<p>xdhf<br></p>', '2021-04-20 20:53:56', NULL, 1, 1, 0, NULL, 1, 1, 0),
(12, 'ergre', '<p>z</p>', '2021-04-21 20:47:24', NULL, 1, 1, 0, NULL, 1, 1, 0),
(13, 'qefsd', '<p>d<br></p>', '2021-04-21 20:47:55', NULL, 1, 1, 0, NULL, 1, 1, 0),
(14, 'qefsd', '<p>d<br></p>', '2021-04-21 20:48:53', NULL, 1, 1, 0, NULL, 1, 1, 0),
(15, 'dgdwf', '<p>d<br></p>', '2021-04-21 20:49:00', NULL, 1, 1, 0, NULL, 1, 1, 0),
(16, 'cvcvn', '<p>&nbsp;vvvvbv</p>', '2021-04-27 09:59:58', NULL, 1, 1, 0, NULL, 1, 1, 0),
(17, 'Article', '<p>gvnvhj</p>', '2021-04-27 10:21:35', NULL, 1, 1, 0, NULL, 1, 1, 0),
(18, 'drgt', '<p>dh<br></p>', '2021-04-27 11:24:39', NULL, 1, 1, 0, NULL, 1, 1, 0);

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

--
-- Déchargement des données de la table `ody_Category`
--

INSERT INTO `ody_Category` (`ID`, `Name`, `Type`, `DateCreation`) VALUES
(1, 'dxfdfgfg', 'xfh', '2021-04-27 09:08:57');

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
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
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
-- Structure de la table `ody_Menus`
--

CREATE TABLE `ody_Menus` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Edit_Date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Order_Menu` tinyint(4) NOT NULL,
  `PrimaryMenu` tinyint(4) DEFAULT NULL,
  `SecondaryMenu` tinyint(4) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `isDraft` tinyint(4) NOT NULL,
  `Visibility` tinyint(4) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Description` text COLLATE utf8_bin,
  `id_Category` int(11) UNSIGNED NOT NULL,
  `id_User` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Page`
--

INSERT INTO `ody_Page` (`ID`, `Title`, `Content`, `DateCreation`, `DateEdit`, `isDeleted`, `isDraft`, `Visibility`, `Status`, `Description`, `id_Category`, `id_User`) VALUES
(1, 'fxfgxdfgd', 'dfdxgxdfg', '2021-04-27 08:37:43', NULL, 0, 0, 1, 1, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Reservations`
--

CREATE TABLE `ody_Reservations` (
  `ID` int(11) NOT NULL,
  `isCanceled` tinyint(4) NOT NULL DEFAULT '0',
  `ReservationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_User` int(10) UNSIGNED NOT NULL,
  `id_Voyage` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `Role` tinyint(4) NOT NULL DEFAULT '1',
  `Phone` int(11) NOT NULL,
  `DateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateEdit` datetime DEFAULT NULL,
  `Status` tinyint(4) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_User`
--

INSERT INTO `ody_User` (`ID`, `Firstname`, `Lastname`, `Email`, `Password`, `Role`, `Phone`, `DateCreation`, `DateEdit`, `Status`, `isDeleted`) VALUES
(1, 'xhxchg', 'dswgd', 'wdwsgg@gmail.com', '1234', 1, 654852136, '2021-04-25 20:56:21', NULL, 2, 0),
(2, 'dgxdfg', 'dfgxfdg', 'fxdgfg@wdgdfg.com', 'wdgsd', 1, 632584762, '2021-04-27 08:42:05', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Voyage`
--

CREATE TABLE `ody_Voyage` (
  `ID` int(11) NOT NULL,
  `Arrival` varchar(255) NOT NULL,
  `Departure` varchar(255) NOT NULL,
  `ArrivaDate` date NOT NULL,
  `DepartureDate` date NOT NULL,
  `ArrivalHour` time NOT NULL,
  `DepartureHour` time NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EditDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`ID`) USING BTREE;

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
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Index pour la table `ody_Menus`
--
ALTER TABLE `ody_Menus`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `id_Category` (`id_Category`),
  ADD KEY `id_User` (`id_User`);

--
-- Index pour la table `ody_Reservations`
--
ALTER TABLE `ody_Reservations`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `id_User` (`id_User`),
  ADD UNIQUE KEY `id_Voyage` (`id_Voyage`) USING BTREE;

--
-- Index pour la table `ody_User`
--
ALTER TABLE `ody_User`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Index pour la table `ody_Voyage`
--
ALTER TABLE `ody_Voyage`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ody_Article`
--
ALTER TABLE `ody_Article`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `ody_Article_Page`
--
ALTER TABLE `ody_Article_Page`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Config`
--
ALTER TABLE `ody_Config`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Menus`
--
ALTER TABLE `ody_Menus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ody_Reservations`
--
ALTER TABLE `ody_Reservations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_User`
--
ALTER TABLE `ody_User`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ody_Voyage`
--
ALTER TABLE `ody_Voyage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ody_Article`
--
ALTER TABLE `ody_Article`
  ADD CONSTRAINT `ody_Article_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `ody_User` (`ID`);

--
-- Contraintes pour la table `ody_Article_Page`
--
ALTER TABLE `ody_Article_Page`
  ADD CONSTRAINT `ody_Article_Page_ibfk_1` FOREIGN KEY (`id_Article`) REFERENCES `ody_Article` (`ID`),
  ADD CONSTRAINT `ody_Article_Page_ibfk_2` FOREIGN KEY (`id_Article`) REFERENCES `ody_Article` (`ID`);

--
-- Contraintes pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  ADD CONSTRAINT `ody_Category_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `ody_Article` (`id_Category`);

--
-- Contraintes pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  ADD CONSTRAINT `ody_Comment_ibfk_1` FOREIGN KEY (`id_Article`) REFERENCES `ody_Article` (`ID`);

--
-- Contraintes pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  ADD CONSTRAINT `ody_Page_ibfk_2` FOREIGN KEY (`id_User`) REFERENCES `ody_User` (`ID`);

--
-- Contraintes pour la table `ody_Reservations`
--
ALTER TABLE `ody_Reservations`
  ADD CONSTRAINT `ody_Reservations_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `ody_User` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
