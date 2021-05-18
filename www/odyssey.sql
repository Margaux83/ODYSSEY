-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : sam. 01 mai 2021 à 15:04
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
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `status` tinyint(4) NOT NULL,
  `isVisible` tinyint(4) NOT NULL,
  `isDraft` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_User` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Article`
--

INSERT INTO `ody_Article` (`id`, `title`, `content`, `description`, `status`, `isVisible`, `isDraft`, `isDeleted`, `creationDate`, `updateDate`, `id_User`) VALUES
(3, 'xgfxf', '<p>wfdgdfgw<br></p>', NULL, 1, 1, 0, 0, '2021-04-16 21:39:05', '2021-04-25 21:12:07', 1),
(4, 'sshdfhtfd', '&lt;h1&gt;dhsxtfhdddt&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h2&gt;cghgfh&lt;br&gt;&lt;/h2&gt;', NULL, 3, 2, 0, 0, '2021-04-16 21:42:33', '2021-04-25 21:12:09', 1),
(5, 'sshdfhtfd', '&lt;h1&gt;dhsxtfhdddt&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h2&gt;cghgfh&lt;br&gt;&lt;/h2&gt;', NULL, 3, 2, 0, 0, '2021-04-16 21:45:40', NULL, 1),
(6, 'sshdfhtfd', '&lt;h1&gt;dhsxtfhdddt&lt;/h1&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h2&gt;cghgfh&lt;br&gt;&lt;/h2&gt;', NULL, 3, 2, 0, 0, '2021-04-16 21:46:48', NULL, 1),
(7, 'Hello', '&lt;p&gt;gfxdf&lt;/p&gt;', NULL, 1, 1, 0, 0, '2021-04-18 17:15:28', '2021-04-28 12:43:11', 1),
(8, 'srgxtf', '<p>xdhf<br></p>', NULL, 1, 1, 0, 0, '2021-04-20 20:53:56', NULL, 1),
(12, 'ergre', '<p>z</p>', NULL, 1, 1, 0, 0, '2021-04-21 20:47:24', NULL, 1),
(13, 'qefsd', '<p>d<br></p>', NULL, 1, 1, 0, 0, '2021-04-21 20:47:55', NULL, 1),
(14, 'qefsd', '<p>d<br></p>', NULL, 1, 1, 0, 0, '2021-04-21 20:48:53', NULL, 1),
(15, 'dgdwf', '<p>d<br></p>', NULL, 1, 1, 0, 0, '2021-04-21 20:49:00', NULL, 1),
(16, 'cvcvn', '<p>&nbsp;vvvvbv</p>', NULL, 1, 1, 0, 0, '2021-04-27 09:59:58', NULL, 1),
(17, 'Article', '<p>gvnvhj</p>', NULL, 1, 1, 0, 0, '2021-04-27 10:21:35', NULL, 1),
(18, 'drgt', '<p>dh<br></p>', NULL, 1, 1, 0, 0, '2021-04-27 11:24:39', NULL, 1),
(19, 'chgfh', '<p>dfgdxfh<br></p>', NULL, 1, 1, 0, 0, '2021-04-28 12:37:32', NULL, 1),
(20, 'Test', '<p>cchgfh</p>', NULL, 1, 1, 0, 0, '2021-04-28 12:42:25', NULL, 1),
(21, 'chh', 'chgchv', NULL, 1, 0, 0, 0, '2021-05-01 14:55:06', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Category`
--

CREATE TABLE `ody_Category` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Category`
--

INSERT INTO `ody_Category` (`id`, `label`, `creationDate`, `updateDate`) VALUES
(1, 'cgjgh', '2021-05-01 14:03:20', NULL),
(2, 'xghfg', '2021-05-01 14:09:31', NULL),
(3, 'xhffgh', '2021-05-01 14:09:37', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Category_Article`
--

CREATE TABLE `ody_Category_Article` (
  `id` int(11) NOT NULL,
  `id_Article` int(11) UNSIGNED NOT NULL,
  `id_Category` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ody_Category_Article`
--

INSERT INTO `ody_Category_Article` (`id`, `id_Article`, `id_Category`) VALUES
(2, 15, 1),
(1, 17, 1),
(3, 17, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Category_Page`
--

CREATE TABLE `ody_Category_Page` (
  `id` int(11) NOT NULL,
  `id_Category` int(10) UNSIGNED NOT NULL,
  `id_Page` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Comment`
--

CREATE TABLE `ody_Comment` (
  `id` int(11) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL,
  `id_Article` int(11) UNSIGNED NOT NULL,
  `id_User` int(11) UNSIGNED NOT NULL,
  `id_Comment` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Config`
--

CREATE TABLE `ody_Config` (
  `id` int(10) UNSIGNED NOT NULL,
  `options` varchar(500) COLLATE utf8_bin NOT NULL,
  `value` varchar(500) COLLATE utf8_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Menus`
--

CREATE TABLE `ody_Menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `orderMenu` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Page`
--

CREATE TABLE `ody_Page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `isDraft` tinyint(4) NOT NULL,
  `isVisible` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL,
  `id_User` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Page`
--

INSERT INTO `ody_Page` (`id`, `title`, `content`, `description`, `isDraft`, `isVisible`, `status`, `isDeleted`, `creationDate`, `updateDate`, `id_User`) VALUES
(1, 'fxfgxdfgd', 'dfdxgxdfg', NULL, 0, 1, 1, 0, '2021-04-27 08:37:43', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Reservations`
--

CREATE TABLE `ody_Reservations` (
  `id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_Voyage` int(11) UNSIGNED NOT NULL,
  `id_User` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ody_User`
--

CREATE TABLE `ody_User` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(120) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(320) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `phone` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `isVerified` tinyint(4) NOT NULL DEFAULT '0',
  `lastConnexionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_User`
--

INSERT INTO `ody_User` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `phone`, `status`, `isVerified`, `lastConnexionDate`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'xhxchg', 'dswgd', 'wdwsgg@gmail.com', '1234', 1, 654852136, 2, 0, '2021-05-01 12:20:03', 0, '2021-04-25 20:56:21', NULL),
(2, 'dgxdfg', 'dfgxfdg', 'fxdgfg@wdgdfg.com', 'wdgsd', 1, 632584762, 2, 0, '2021-05-01 12:20:03', 0, '2021-04-27 08:42:05', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Voyage`
--

CREATE TABLE `ody_Voyage` (
  `id` int(11) UNSIGNED NOT NULL,
  `arrival` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `departure` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `arrivalDate` date NOT NULL,
  `departureDate` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ody_Article`
--
ALTER TABLE `ody_Article`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_User` (`id_User`);

--
-- Index pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `ody_Category_Article`
--
ALTER TABLE `ody_Category_Article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_Article` (`id_Article`,`id_Category`),
  ADD KEY `id_Category` (`id_Category`);

--
-- Index pour la table `ody_Category_Page`
--
ALTER TABLE `ody_Category_Page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_Category` (`id_Category`),
  ADD KEY `id_Page` (`id_Page`);

--
-- Index pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_User` (`id_User`),
  ADD UNIQUE KEY `id_Comment` (`id_Comment`),
  ADD KEY `id_Article` (`id_Article`);

--
-- Index pour la table `ody_Config`
--
ALTER TABLE `ody_Config`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `ody_Menus`
--
ALTER TABLE `ody_Menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_User` (`id_User`);

--
-- Index pour la table `ody_Reservations`
--
ALTER TABLE `ody_Reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_User` (`id_User`),
  ADD UNIQUE KEY `id_Voyage` (`id_Voyage`) USING BTREE;

--
-- Index pour la table `ody_User`
--
ALTER TABLE `ody_User`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `ody_Voyage`
--
ALTER TABLE `ody_Voyage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ody_Article`
--
ALTER TABLE `ody_Article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ody_Category_Article`
--
ALTER TABLE `ody_Category_Article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ody_Category_Page`
--
ALTER TABLE `ody_Category_Page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Config`
--
ALTER TABLE `ody_Config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Menus`
--
ALTER TABLE `ody_Menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ody_Reservations`
--
ALTER TABLE `ody_Reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_User`
--
ALTER TABLE `ody_User`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ody_Voyage`
--
ALTER TABLE `ody_Voyage`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ody_Category_Article`
--
ALTER TABLE `ody_Category_Article`
  ADD CONSTRAINT `ody_Category_Article_ibfk_1` FOREIGN KEY (`id_Article`) REFERENCES `ody_Article` (`id`),
  ADD CONSTRAINT `ody_Category_Article_ibfk_2` FOREIGN KEY (`id_Category`) REFERENCES `ody_Category` (`id`);

--
-- Contraintes pour la table `ody_Category_Page`
--
ALTER TABLE `ody_Category_Page`
  ADD CONSTRAINT `ody_Category_Page_ibfk_1` FOREIGN KEY (`id_Category`) REFERENCES `ody_Category` (`id`),
  ADD CONSTRAINT `ody_Category_Page_ibfk_2` FOREIGN KEY (`id_Page`) REFERENCES `ody_Page` (`id`);

--
-- Contraintes pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  ADD CONSTRAINT `ody_Comment_ibfk_1` FOREIGN KEY (`id_Article`) REFERENCES `ody_Article` (`id`),
  ADD CONSTRAINT `ody_Comment_ibfk_2` FOREIGN KEY (`id_Comment`) REFERENCES `ody_Comment` (`id`),
  ADD CONSTRAINT `ody_Comment_ibfk_3` FOREIGN KEY (`id_User`) REFERENCES `ody_User` (`id`);

--
-- Contraintes pour la table `ody_Reservations`
--
ALTER TABLE `ody_Reservations`
  ADD CONSTRAINT `ody_Reservations_ibfk_1` FOREIGN KEY (`id_User`) REFERENCES `ody_User` (`id`),
  ADD CONSTRAINT `ody_Reservations_ibfk_2` FOREIGN KEY (`id_Voyage`) REFERENCES `ody_Voyage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
