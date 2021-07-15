-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mar. 13 juil. 2021 à 17:23
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.16

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
CREATE DATABASE IF NOT EXISTS `odyssey` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `odyssey`;

-- --------------------------------------------------------

--
-- Structure de la table `ody_Article`
--

CREATE TABLE `ody_Article` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` longtext COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `status` tinyint(4) NOT NULL,
  `isVisible` tinyint(4) NOT NULL,
  `isDraft` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_User` int(11) UNSIGNED NOT NULL,
  `uri` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Article`
--

INSERT INTO `ody_Article` (`id`, `title`, `content`, `description`, `status`, `isVisible`, `isDraft`, `isDeleted`, `creationDate`, `updateDate`, `id_User`, `uri`) VALUES
(10, 'Mon voyage en Tanzanie', '&lt;p&gt;Voici mon superbe voyage en Tanzanie !&lt;/p&gt;', 'Description du voyage', 4, 1, 0, 0, '2021-07-13 17:02:00', NULL, 3, '/article/mon-voyage-en-tanzanie'),
(11, 'L\\\'angoisse en avion', '&lt;p&gt;Tellement stressant de prendre l\\\'avion sur des longs courriers...&lt;/p&gt;', '  ', 1, 1, 0, 0, '2021-07-13 17:03:32', NULL, 3, '/article/l-angoisse-en-avion');

-- --------------------------------------------------------

--
-- Structure de la table `ody_Category`
--

CREATE TABLE `ody_Category` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Category`
--

INSERT INTO `ody_Category` (`id`, `label`, `creationDate`, `updateDate`, `isDeleted`) VALUES
(21, 'Voyage', '2021-07-13 16:59:28', NULL, 0),
(22, 'HÃ´tel', '2021-07-13 16:59:48', '2021-07-13 16:59:54', 0),
(23, 'Culture', '2021-07-13 17:00:07', NULL, 0),
(24, 'ActualitÃ©', '2021-07-13 17:00:22', NULL, 0);

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
(1, 10, 21),
(2, 11, 21);

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
  `id_Comment` int(11) UNSIGNED DEFAULT NULL,
  `isVerified` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Comment`
--

INSERT INTO `ody_Comment` (`id`, `content`, `isDeleted`, `creationDate`, `updateDate`, `id_Article`, `id_User`, `id_Comment`, `isVerified`) VALUES
(4, 'Clairement c\'est hyper stressant !', 0, '2021-07-13 17:04:01', NULL, 11, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Menu`
--

CREATE TABLE `ody_Menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contentMenu` varchar(1000) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ody_Menu`
--

INSERT INTO `ody_Menu` (`id`, `name`, `contentMenu`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Menu header', '[{\"object\":\"Article\",\"id\":\"55\",\"order\":0},{\"id\":\"7\",\"object\":\"Article\",\"order\":0},{\"object\":\"Page\",\"id\":\"1\",\"order\":1},{\"id\":\"3\",\"object\":\"Page\",\"order\":2},{\"id\":\"2\",\"object\":\"Article\",\"order\":3},{\"id\":\"7\",\"object\":\"Page\",\"order\":\"100\"}]', 0, '2021-06-23 16:11:10', '2021-07-13 17:22:10'),
(2, 'Menu footer', '[{\"id\":\"1\",\"object\":\"Page\",\"order\":\"100\"},{\"id\":\"10\",\"object\":\"Article\",\"order\":\"100\"},{\"id\":\"11\",\"object\":\"Article\",\"order\":\"100\"}]', 0, '2021-06-23 22:21:36', '2021-07-13 17:19:02');

-- --------------------------------------------------------

--
-- Structure de la table `ody_Page`
--

CREATE TABLE `ody_Page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `isVisible` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL,
  `id_User` int(11) UNSIGNED NOT NULL,
  `uri` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Page`
--

INSERT INTO `ody_Page` (`id`, `title`, `content`, `description`, `isVisible`, `status`, `isDeleted`, `creationDate`, `updateDate`, `id_User`, `uri`) VALUES
(6, 'Accueil', '  Bienvenue sur la page d\\\\\\\'accueil :)', 'accueil', 1, 4, 0, '2021-07-13 17:04:55', '2021-07-13 19:21:52', 3, '/accueil'),
(7, 'Loisirs', '  Liste de mes loisirs :', 'loisirs, sports, Ã©ducation', 1, 4, 0, '2021-07-13 17:16:40', '2021-07-13 19:21:55', 3, '/loisirs');

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
-- Structure de la table `ody_Role`
--

CREATE TABLE `ody_Role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `value` longtext CHARACTER SET latin1 NOT NULL,
  `isDeleted` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Role`
--

INSERT INTO `ody_Role` (`id`, `name`, `value`, `isDeleted`) VALUES
(1, 'Admin', '{\"all_perms\":\"1\"}', 0),
(2, 'Editeur', '{\"\\/admin\\/pages\":\"1\",\"\\/admin\\/add-page\":\"1\",\"\\/admin\\/edit-page\":\"1\",\"\\/admin\\/delete-page\":\"1\",\"\\/admin\\/articles\":\"1\",\"\\/admin\\/add-article\":\"1\",\"\\/admin\\/edit-article\":\"1\",\"\\/admin\\/delete-article\":\"1\"}', 0),
(3, 'ModÃ©rateur', '{\"\\/admin\\/comments\":\"1\",\"\\/admin\\/roles\":\"1\",\"\\/admin\\/add-role\":\"1\",\"\\/admin\\/edit-role\":\"1\",\"\\/admin\\/delete-role\":\"1\"}', 0),
(4, 'Contributeur', '{\"\\/admin\\/add-page\":\"1\",\"\\/admin\\/add-article\":\"1\"}', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ody_User`
--

CREATE TABLE `ody_User` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(120) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(320) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `phone` varchar(10) COLLATE utf8_bin NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `isVerified` tinyint(4) NOT NULL DEFAULT '0',
  `lastConnexionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
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
-- Index pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Article` (`id_Article`),
  ADD KEY `id_Comment` (`id_Comment`) USING BTREE,
  ADD KEY `id_User` (`id_User`) USING BTREE;

--
-- Index pour la table `ody_Menu`
--
ALTER TABLE `ody_Menu`
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
-- Index pour la table `ody_Role`
--
ALTER TABLE `ody_Role`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `ody_Category_Article`
--
ALTER TABLE `ody_Category_Article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ody_Menu`
--
ALTER TABLE `ody_Menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ody_Reservations`
--
ALTER TABLE `ody_Reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ody_Role`
--
ALTER TABLE `ody_Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ody_User`
--
ALTER TABLE `ody_User`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
