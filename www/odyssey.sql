SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `odyssey` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `odyssey`;

CREATE TABLE `{DBPREFIX}Article` (
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

CREATE TABLE `{DBPREFIX}Category` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `{DBPREFIX}Category_Article` (
  `id` int(11) NOT NULL,
  `id_Article` int(11) UNSIGNED NOT NULL,
  `id_Category` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `{DBPREFIX}Comment` (
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

CREATE TABLE `{DBPREFIX}Config` (
  `id` int(10) UNSIGNED NOT NULL,
  `options` varchar(500) COLLATE utf8_bin NOT NULL,
  `value` varchar(500) COLLATE utf8_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `{DBPREFIX}Media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `media` varchar(255) COLLATE utf8_bin NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `{DBPREFIX}Menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contentMenu` varchar(1000) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `{DBPREFIX}Menu` (`id`, `name`, `contentMenu`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Menu header', '[{\"object\":\"Article\",\"id\":\"55\",\"order\":0},{\"id\":\"7\",\"object\":\"Article\",\"order\":0},{\"object\":\"Page\",\"id\":\"1\",\"order\":1},{\"id\":\"3\",\"object\":\"Page\",\"order\":2},{\"id\":\"2\",\"object\":\"Article\",\"order\":3},{\"id\":\"7\",\"object\":\"Page\",\"order\":\"100\"}]', 0, '2021-06-23 16:11:10', '2021-07-13 17:22:10'),
(2, 'Menu footer', '[{\"id\":\"1\",\"object\":\"Page\",\"order\":\"100\"}]', 0, '2021-06-23 22:21:36', '2021-07-24 08:30:03');

CREATE TABLE `{DBPREFIX}Page` (
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

INSERT INTO `{DBPREFIX}Page` (`id`, `title`, `content`, `description`, `isVisible`, `status`, `isDeleted`, `creationDate`, `updateDate`, `id_User`, `uri`) VALUES
(6, 'Accueil', '  Bienvenue sur la page d\'accueil :)', 'accueil', 1, 4, 0, '2021-07-13 17:04:55', '2021-07-13 19:21:52', 1, '/accueil');

CREATE TABLE `{DBPREFIX}Role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `value` longtext CHARACTER SET latin1 NOT NULL,
  `isDeleted` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Role` (`id`, `name`, `value`, `isDeleted`) VALUES
(1, 'Admin', '{\"all_perms\":\"1\"}', 0);

CREATE TABLE `{DBPREFIX}User` (
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

INSERT INTO `{DBPREFIX}User` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `phone`, `status`, `token`, `isVerified`, `lastConnexionDate`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Admin', 'Louis', 'admin@gmail.com', '$2y$10$WG.3paYCoOlaeuK9fvU90eFxQTHrs0NJV0qycwo2pwTIp22pJ0aWm', 1, '0764859586', NULL, '', 1, '2021-07-24 08:44:45', 0, '2021-07-23 22:13:34', '2021-07-24 00:29:04');

ALTER TABLE `{DBPREFIX}Article`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_User` (`id_User`);

ALTER TABLE `{DBPREFIX}Category`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `{DBPREFIX}Category_Article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_Article` (`id_Article`,`id_Category`),
  ADD KEY `id_Category` (`id_Category`);

ALTER TABLE `{DBPREFIX}Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Article` (`id_Article`),
  ADD KEY `id_Comment` (`id_Comment`) USING BTREE,
  ADD KEY `id_User` (`id_User`) USING BTREE;

ALTER TABLE `{DBPREFIX}Config`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `{DBPREFIX}Media`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `{DBPREFIX}Menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `{DBPREFIX}Page`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_User` (`id_User`);

ALTER TABLE `{DBPREFIX}Role`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `{DBPREFIX}User`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `{DBPREFIX}Article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `{DBPREFIX}Category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `{DBPREFIX}Category_Article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `{DBPREFIX}Comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `{DBPREFIX}Config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `{DBPREFIX}Media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `{DBPREFIX}Menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `{DBPREFIX}Page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `{DBPREFIX}Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `{DBPREFIX}User`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `{DBPREFIX}Category_Article`
  ADD CONSTRAINT `{DBPREFIX}Category_Article_ibfk_1` FOREIGN KEY (`id_Article`) REFERENCES `{DBPREFIX}Article` (`id`),
  ADD CONSTRAINT `{DBPREFIX}Category_Article_ibfk_2` FOREIGN KEY (`id_Category`) REFERENCES `{DBPREFIX}Category` (`id`);

ALTER TABLE `{DBPREFIX}Comment`
  ADD CONSTRAINT `{DBPREFIX}Comment_ibfk_1` FOREIGN KEY (`id_Article`) REFERENCES `{DBPREFIX}Article` (`id`),
  ADD CONSTRAINT `{DBPREFIX}Comment_ibfk_2` FOREIGN KEY (`id_Comment`) REFERENCES `{DBPREFIX}Comment` (`id`),
  ADD CONSTRAINT `{DBPREFIX}Comment_ibfk_3` FOREIGN KEY (`id_User`) REFERENCES `{DBPREFIX}User` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
