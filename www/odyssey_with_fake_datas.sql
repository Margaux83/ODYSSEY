-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : dim. 25 juil. 2021 à 11:07
-- Version du serveur : 5.7.35
-- Version de PHP : 7.4.20

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
(1, 'Des brebis et des hommes : un Ã©tÃ© dans les pÃ¢turages', '<p>De l&rsquo;Ari&egrave;ge aux Pyr&eacute;n&eacute;es-Atlantiques, &agrave; la belle saison, direction les estives pour les troupeaux et leurs bergers. Un monde &agrave; part fait de concerts de cloches, de pentes herbeuses et de temps qui s&rsquo;&eacute;coule lentement.</p>\r\n<p>La sonnerie du portable de Marion Poinssot nous r&eacute;veille. Il est 5 h 45, le jour commence &agrave; poindre. La jeune femme enfile un tee-shirt et un jean, allume sa frontale et commence par pr&eacute;parer le caf&eacute;. Quelques minutes plus tard, c&rsquo;est au tour de Maxim Cain de se lever. Premier r&eacute;flexe, sortir voir le temps qu&rsquo;il fait et retrouver ses chiens.</p>\r\n<p>La montagne est encore silencieuse, la mer de nuages juste en dessous. Les brebis dorment sur le pla de Montcamp, tout pr&egrave;s de la cabane du Sasc, en Ari&egrave;ge. Une succession de for&ecirc;ts, de pentes herbeuses et de cr&ecirc;tes arrondies au milieu des sommets ari&eacute;geois dont l&rsquo;&eacute;l&eacute;gante pique Rouge de Bassi&egrave;s (2 676 m&egrave;tres). C&rsquo;est dans cet abri, avec eau, &eacute;lectricit&eacute; et grandes ouvertures sur le paysage que Marion Poinssot et Maxim Cain d&eacute;butent leur saison. Fin juin, ils quittent le quartier bas de leur estive pour filer vers les quartiers hauts, chacun dans sa cabane, elle &agrave; la Unarde, lui &agrave; Bayle.</p>\r\n<p>&nbsp;</p>\r\n<section class=\"article__content article__content--restricted\">\r\n<p class=\"article__paragraph article__paragraph--lf\"><img class=\"n3VNCb\" style=\"width: 326px; height: 209px; margin: 0px auto; display: block;\" src=\"https://img.20mn.fr/AwOg3Ts_QheATJUKzc7dFA/830x532_agneaux-illustration.jpg\" alt=\"Luxembourg: Une brebis met au monde six agneaux, un fait rare\" data-noaft=\"1\" /></p>\r\n</section>', 'Les brebis dans les pÃ¢turages', 4, 1, 0, 0, '2021-07-24 19:58:46', '2021-07-24 20:07:18', 1, '/article/des-brebis-et-des-hommes-un-ete-dans-les-paturages'),
(2, 'Du Mexique Ã  DubaÃ¯, nos envies dâ€™ailleurs pour respirer Ã  nouveau', '<p>Une itin&eacute;rance m&ecirc;lant nature et bien-&ecirc;tre au Costa Rica, un safari &agrave; pied dans le Masa&iuml; Mara, une parenth&egrave;se baln&eacute;aire aux Bahamas&hellip; Voyager n&rsquo;est pas ais&eacute; en ces temps perturb&eacute;s, mais cela reste possible: la preuve avec ces suggestions aux couleurs de l&rsquo;&eacute;vasion.</p>\r\n<p>S&rsquo;il n&rsquo;est pas question ici de nier l&rsquo;&eacute;vidence de la prudence dont il nous faut tous redoubler, nous tenons tout autant &agrave; garder bien vivace la flamme du r&ecirc;ve&hellip; Tandis que la morosit&eacute; gagne du terrain, c&rsquo;est m&ecirc;me une quasi-obligation morale que de vous offrir cette respiration.</p>\r\n<p>Le confinement a exacerb&eacute; le besoin d&rsquo;&eacute;vasion et nombre d&rsquo;entre vous l&rsquo;ont assouvi cet &eacute;t&eacute; en sillonnant notre beau pays. Mais &agrave; l&rsquo;approche de l&rsquo;hiver, l&rsquo;appel du lointain, de son soleil que nous ne trouverons pas sous nos latitudes, de ses promesses de d&eacute;couvertes (le masque n&rsquo;emp&ecirc;che nullement d&rsquo;avoir les yeux grands ouverts!), nous taraude plus que jamais.</p>\r\n<p>En prenant les pr&eacute;cautions qui s&rsquo;imposent, pour nous et pour les autres, voyager est encore possible. Nous avons s&eacute;lectionn&eacute; des destinations qui, au moment o&ugrave; nous &eacute;crivons ces lignes, n&rsquo;imposent pas de quarantaine &agrave; l&rsquo;arriv&eacute;e, et des propositions qui r&eacute;pondent &agrave; toutes les envies: voguer, buller, p&eacute;r&eacute;griner, observer&hellip;</p>\r\n<p>&nbsp;</p>\r\n<p><img class=\"n3VNCb\" style=\"width: 515px; height: 233px; margin: 0px auto; display: block;\" src=\"https://www.epaillote.com/project/resources/img/original/ilescaraibes.png\" alt=\"Iles des Cara&iuml;bes\" data-noaft=\"1\" /></p>', 'Voyage dans les caraÃ¯bes', 4, 1, 0, 0, '2021-07-24 20:04:22', '2021-07-24 20:06:19', 1, '/article/du-mexique-dubai-nos-envies-d-ailleurs-pour-respirer-a-nouveau'),
(3, 'Voyage Ã  Bali', '<p>&nbsp;</p>\r\n<p><img class=\"n3VNCb\" style=\"width: 442px; height: 261.222px; margin: 0px auto; display: block;\" src=\"http://blog.showroomprive.com/content/uploads/2020/05/Article_Blog_Slider_Blog_-5.jpg\" alt=\"VoyagezChezVous : rencontre avec Bali et ses embl&eacute;matiques rizi&egrave;res |  VOYAGES &amp; LOISIRS\" data-noaft=\"1\" /></p>\r\n<p>Hello tout le monde et bienvenue sur notre page d&eacute;di&eacute;e &agrave; notre destination pr&eacute;f&eacute;r&eacute;e : Bali. Ici nous allons vous faire visiter Bali, cette &icirc;le indon&eacute;sienne paradisiaque tr&egrave;s touristique dont tout le monde parle mais que peu connaissent vraiment. La preuve avec nous d&rsquo;ailleurs, nous r&eacute;alisons un voyage Indonesie chaque ann&eacute;e pour d&eacute;couvrir de nouveaux endroits. Mais au bout de trois voyages &agrave; Bali, nous avions vraiment envie de vous en parler, en toute transparence (comme d&rsquo;habitude !). L&rsquo;&icirc;le de Bali est de plus en plus populaire car c&rsquo;est la plus connue d&rsquo;Indon&eacute;sie. Elle s&rsquo;est d&eacute;velopp&eacute;e tr&egrave;s vite et le tourisme de masse est aujourd&rsquo;hui bien pr&eacute;sent. En 2015 d&eacute;j&agrave;, quand nous y sommes all&eacute;s pour la premi&egrave;re fois, nous avons d&eacute;couvert une &icirc;le qui vivait &agrave; 100 &agrave; l&rsquo;heure, blind&eacute;e de monde, d&rsquo;h&ocirc;tels, de restaurants&hellip; pour le plus grand bonheurs des touristes. Mais pas pour nous ! Nous arrivions d&rsquo;Australie, o&ugrave; les terres sont vastes et o&ugrave; il y a de l&rsquo;espace. Alors je vous avoue que nous nous sentions un peu oppress&eacute;s &agrave; lors de ce premier voyage Bali. Mais heureusement, on a vite fuit cette foule qui grouillait autour de Kuta et Seminyak et nous sommes rendus dans des endroit plus recul&eacute;s (&agrave; l&rsquo;&eacute;poque) comme Canggu et Ubud.</p>\r\n<p>Canggu c&rsquo;est le paradis des surfeurs-hipsters ! Le coin chill de Bali o&ugrave; on vit autant le jour que la nuit. Ubud est dans les terres, au centre de l&rsquo;&icirc;le, et c&rsquo;est le paradis des temples et des rizi&egrave;res. On se retrouve au coeur de la nature avec les singes et les balinais qui cultivent leurs champs. On a ador&eacute; l&rsquo;ambiance relaxante et ce c&ocirc;t&eacute; bien-&ecirc;tre que pr&ocirc;ne les habitants de cette petite ville. Nous avons &eacute;galement d&eacute;couvert Jimbaran et la r&eacute;gion d&rsquo;Uluwatu, dans le sud de Bali. Un vrai petit cocon d&rsquo;expatri&eacute;s venant du monde entier, pour surfer et vivre au rythme du soleil balinais. Il nous tarde de d&eacute;couvrir et escalader les diff&eacute;rents volcans comme le Mont Batur pour assister &agrave; un magnifique lever de soleil.</p>\r\n<p>Et puis il y a aussi le reste de Bali, avec les supers spots de plong&eacute;e sous-marine &agrave; l&rsquo;est vers Amed. La fraicheur des montagnes, les cascades, le Mont Agung. Ou encore le nord de Bali avec le d&eacute;sormais tr&egrave;s connu Munduk et ses balan&ccedil;oires. La Sekumpul Waterfall, les rizi&egrave;res en terrasses de Jatiluwih, class&eacute;es au patrimoine mondial de l&rsquo;UNESCO.</p>\r\n<p>Mais voyager &agrave; Bali c&rsquo;est aussi d&eacute;couvrir des &icirc;les aux alentours o&ugrave; il y a plein de choses &agrave; faire comme &agrave; Nusa Lembongan, Nusa Ceningan et Nusa Penida, cette derni&egrave;re qui fut un gros coup de coeur et que nous allons vous pr&eacute;senter dans les articles ci-dessous. Bonne lecture &agrave; tous et n&rsquo;h&eacute;sitez pas &agrave; nous laisser un petit commentaire en bas des articles pour nous questionner ou &eacute;changer sur cette destination qu&rsquo;on adore !</p>', 'Voyage Ã  Bali', 4, 1, 0, 0, '2021-07-24 20:09:01', '2021-07-24 20:09:33', 1, '/article/voyage-a-bali');

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
(1, 'Pas de catÃ©gorie', '2021-07-24 19:55:02', NULL, 0),
(2, 'Voyage', '2021-07-24 19:55:22', NULL, 0),
(3, 'Nature', '2021-07-24 19:55:25', NULL, 0),
(4, 'Pays', '2021-07-24 19:55:30', NULL, 0),
(5, 'DÃ©couverte', '2021-07-24 19:55:46', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Category_Article`
--

CREATE TABLE `ody_Category_Article` (
  `id` int(11) NOT NULL,
  `id_Article` int(11) UNSIGNED NOT NULL,
  `id_Category` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Category_Article`
--

INSERT INTO `ody_Category_Article` (`id`, `id_Article`, `id_Category`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 4);

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
(1, 'Trop beau', 0, '2021-07-24 20:19:01', NULL, 1, 1, NULL, 1);

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

--
-- Déchargement des données de la table `ody_Config`
--

INSERT INTO `ody_Config` (`id`, `options`, `value`, `creationDate`, `updateDate`) VALUES
(1, 'theme', 'theme_classic/', '2021-07-24 21:11:34', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ody_Media`
--

CREATE TABLE `ody_Media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `media` varchar(255) COLLATE utf8_bin NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Media`
--

INSERT INTO `ody_Media` (`id`, `name`, `media`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Barcelone', 'barcelona.jpeg', 0, '2021-07-24 20:22:31', '2021-07-25 10:33:01'),
(2, 'San juan ', 'san_juan.jpg', 0, '2021-07-24 20:23:25', '2021-07-25 10:33:08'),
(3, 'Le transsibÃ©rien', 'transsiberian.jpeg', 0, '2021-07-24 20:25:41', '2021-07-25 10:33:11');

-- --------------------------------------------------------

--
-- Structure de la table `ody_Menu`
--

CREATE TABLE `ody_Menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `contentMenu` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ody_Menu`
--

INSERT INTO `ody_Menu` (`id`, `name`, `contentMenu`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Menu header', '[{\"object\":\"Article\",\"id\":\"55\",\"order\":0},{\"id\":\"7\",\"object\":\"Article\",\"order\":0},{\"id\":\"15\",\"object\":\"Article\",\"order\":0},{\"id\":\"3\",\"object\":\"Page\",\"order\":0},{\"id\":\"3\",\"object\":\"Article\",\"order\":0},{\"id\":\"8\",\"object\":\"Page\",\"order\":1},{\"id\":\"2\",\"object\":\"Page\",\"order\":1},{\"id\":\"7\",\"object\":\"Page\",\"order\":\"100\"}]', 0, '2021-06-23 16:11:10', '2021-07-25 10:59:47'),
(2, 'Menu footer', '[{\"id\":\"2\",\"object\":\"Page\",\"order\":\"100\"}]', 0, '2021-06-23 22:21:36', '2021-07-25 11:00:16');

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
(1, 'Accueil', '<p>Bienvenue sur la page d\'accueil :)</p>', 'Accueil', 1, 4, 0, '2021-07-13 17:04:55', '2021-07-25 12:51:33', 1, '/accueil'),
(2, 'Qui sommes-nous ?', '<h2>Un voyage autour du monde inattendu</h2>\r\n<p>Tout commence il y a quelques ann&eacute;es, en 2008 plus exactement. Je viens de terminer ma premi&egrave;re ann&eacute;e universitaire et pour me lib&eacute;rer l&rsquo;esprit, je d&eacute;cide de me prendre un aller-retour pour le Vietnam, &agrave; Hanoi. Dur&eacute;e du s&eacute;jour : deux semaines. C&rsquo;est la premi&egrave;re fois que je pars aussi loin. Je n&rsquo;ai que 210 euros sur mon compte et seulement un sac &agrave; dos de 20 litres pour ce voyage. Je me dis que ce doit &ecirc;tre amplement suffisant pour un p&eacute;riple de 14 jours&hellip;<br />Sauf qu&rsquo;&agrave; ce moment-l&agrave; je suis loin de me douter que cette escapade ne se passera pas comme pr&eacute;vu et qu&rsquo;elle changera radicalement ma vie &hellip;</p>\r\n<p>Durant ce voyage, au cours duquel je ne reste que dans la capitale vietnamienne, je rencontre plusieurs voyageurs plus fabuleux et int&eacute;ressant les uns que les autres.<br />L&rsquo;un de ces <strong>globetrotters</strong>, Alex, un Australien qui parcourt le monde depuis de longues ann&eacute;es, m&rsquo;apprend beaucoup de choses, dont le fait de ne pas forc&eacute;ment avoir besoin d&rsquo;un compte en banque bien rempli pour voyager.</p>\r\n<p>Lors d&rsquo;une discussion dans un bar &agrave; Hano&iuml; je n&rsquo;arr&ecirc;te pas de lui r&eacute;p&eacute;ter la chance qu&rsquo;il a de pouvoir voyager autour du monde, comme &ccedil;a , n&rsquo;importe o&ugrave; et n&rsquo;importe quand.<br />Et il me dit ces mots, ces mots dont nous avons tous conscience sans forc&eacute;ment mesurer la puissance qu&rsquo;ils impliquent :</p>\r\n<blockquote>\r\n<p><strong>Alex :</strong> Tu es ce que tu dis.<br /><strong>Ryan :</strong> Je suis ce que je dis ?<br /><strong>Alex :</strong> Oui. Tu es ma&icirc;tre de tes limites et de tes croyances. Tes mots, tes paroles, tes pens&eacute;es construisent ton univers. [&hellip;]</p>\r\n</blockquote>\r\n<p>Cette conversation qui dure plus de deux heures , m&rsquo;ouvre les yeux sur pas mal de choses et me fait r&eacute;fl&eacute;chir pendant mes deux derniers jours &agrave; Hano&iuml;.</p>\r\n<p>Deux jours plus tard, hasard ou destin, le taxi qui me m&egrave;ne vers l&rsquo;a&eacute;roport pour rentrer en France se retrouve bloqu&eacute; dans les embouteillages de la ville. Je manque &eacute;videmment mon vol.<br />&Agrave; partir de l&agrave; deux choix s&rsquo;offrent &agrave; moi.</p>\r\n<ul>\r\n<li>Utiliser l&rsquo;argent de secours que m&rsquo;a envoy&eacute; un proche pour acheter un nouveau billet et retourner &agrave; ma vie parisienne.</li>\r\n<li>utiliser l&rsquo;argent de secours pour rester plus longtemps afin d&rsquo;explorer le pays et vivre un vrai voyage.</li>\r\n</ul>\r\n<p>Devinez ce que j&rsquo;ai fait ?</p>\r\n<h2>De touriste &agrave; globe trotter</h2>\r\n<p>Mon voyage devait durer 14 jours, je ne suis rentr&eacute; chez moi que 124 jours plus tard.<br />Durant ces 4 mois , je voyage &agrave; travers le Vietnam, le Laos et la Tha&iuml;lande allant toujours de l&rsquo;avant, voulant toujours voir ce qui se passe plus loin, refusant de revenir sur mes pas !<br />On dit que les voyages font grandir, et en effet, ils ouvrent votre esprit au monde et aux autres, vous donnent un point de vue diff&eacute;rent de la vie, vous apportent une d&eacute;finition diff&eacute;rente du bonheur et du besoin. Les voyages vous apprennent &agrave; &eacute;couter, &agrave; appr&eacute;cier.<br />Cette exp&eacute;rience fut la plus enrichissante de ma vie !</p>\r\n<p>Une fois de retour j&rsquo;ai su qu&rsquo;il me serait impossible de revenir &agrave; ma vie d&rsquo;avant. J&rsquo;ai attrap&eacute; cette maladie du voyage. Cette soif de d&eacute;couverte et de rencontre.<br />Depuis 4 ans, je suis un voyageur permanent.</p>\r\n<h2>Pourquoi ce blog sur le voyage?</h2>\r\n<p>J&rsquo;ai cr&eacute;&eacute; ce blog voyage pour inspirer d&rsquo;autres personnes, de la m&ecirc;me fa&ccedil;on que ce globe-trotter Alex et les autres voyageurs que j&rsquo;ai rencontr&eacute;s durant ce p&eacute;riple, m&rsquo;ont inspir&eacute;.<br />Ce blog qui relate mes voyages autour du monde est l&agrave; pour vous montrer qu&rsquo;il est possible de voyager de mani&egrave;re permanente sans forc&eacute;ment avoir un gros compte en banque.</p>\r\n<p>Les personnes que je rencontre, ou les personnes de mon entourage disent souvent m&rsquo;envier, m&ecirc;me pour un voyage d&rsquo;une plus courte p&eacute;riode. Ce blog de voyage a &eacute;t&eacute; cr&eacute;&eacute; pour vous montrer qu&rsquo;il est possible de le r&eacute;aliser et vous montre comment y arriver.<br />Ma premi&egrave;re exp&eacute;rience de 4 mois en est la preuve, alors que je n&rsquo;avais rien pr&eacute;par&eacute;, rien pr&eacute;m&eacute;dit&eacute; et que je n&rsquo;avais que 210 euros en poche au d&eacute;part.</p>\r\n<p>&nbsp;</p>', 'Page Ã  propos', 1, 4, 0, '2021-07-24 20:12:41', '2021-07-24 22:13:08', 1, '/qui-sommes-nous');

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
(2, 'Editeur', '{\"\\/admin\\/pages\":\"1\",\"\\/admin\\/add-page\":\"1\",\"\\/admin\\/edit-page\":\"1\",\"\\/admin\\/delete-page\":\"1\",\"\\/admin\\/articles\":\"1\",\"\\/admin\\/add-article\":\"1\",\"\\/admin\\/edit-article\":\"1\",\"\\/admin\\/delete-article\":\"1\",\"\\/admin\\/comments\":\"1\"}', 0),
(3, 'Auteur', '{\"\\/admin\\/pages\":\"1\",\"\\/admin\\/add-page\":\"1\",\"\\/admin\\/articles\":\"1\",\"\\/admin\\/add-article\":\"1\"}', 0);

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

--
-- Déchargement des données de la table `ody_User`
--

INSERT INTO `ody_User` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `phone`, `status`, `token`, `isVerified`, `lastConnexionDate`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Admin', 'Louis', 'admin@gmail.com', '$2y$10$WG.3paYCoOlaeuK9fvU90eFxQTHrs0NJV0qycwo2pwTIp22pJ0aWm', 1, '0764859586', NULL, '', 1, '2021-07-24 08:44:45', 0, '2021-07-23 22:13:34', '2021-07-24 00:29:04'),
(2, 'Margaux', 'HEBERT', 'margauxhebert83@gmail.com', '$2y$10$WG.3paYCoOlaeuK9fvU90eFxQTHrs0NJV0qycwo2pwTIp22pJ0aWm', 3, '0154785424', NULL, '', 1, '2021-07-25 10:59:05', 0, '2021-07-24 20:14:18', '2021-07-24 23:08:17');

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
-- Index pour la table `ody_Config`
--
ALTER TABLE `ody_Config`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `ody_Media`
--
ALTER TABLE `ody_Media`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ody_Article`
--
ALTER TABLE `ody_Article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ody_Category`
--
ALTER TABLE `ody_Category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ody_Category_Article`
--
ALTER TABLE `ody_Category_Article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ody_Comment`
--
ALTER TABLE `ody_Comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ody_Config`
--
ALTER TABLE `ody_Config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ody_Media`
--
ALTER TABLE `ody_Media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ody_Menu`
--
ALTER TABLE `ody_Menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ody_Page`
--
ALTER TABLE `ody_Page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ody_Role`
--
ALTER TABLE `ody_Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ody_User`
--
ALTER TABLE `ody_User`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
