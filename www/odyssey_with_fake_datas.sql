SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `{DBPREFIX}Article` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` longtext COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `isVisible` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_User` int(11) UNSIGNED NOT NULL,
  `uri` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Article` (`id`, `title`, `content`, `description`, `isVisible`, `isDeleted`, `creationDate`, `updateDate`, `id_User`, `uri`) VALUES
(1, 'Des brebis et des hommes : un Ã©tÃ© dans les pÃ¢turages', '<p>De l&rsquo;Ari&egrave;ge aux Pyr&eacute;n&eacute;es-Atlantiques, &agrave; la belle saison, direction les estives pour les troupeaux et leurs bergers. Un monde &agrave; part fait de concerts de cloches, de pentes herbeuses et de temps qui s&rsquo;&eacute;coule lentement.</p>\r\n<p>La sonnerie du portable de Marion Poinssot nous r&eacute;veille. Il est 5 h 45, le jour commence &agrave; poindre. La jeune femme enfile un tee-shirt et un jean, allume sa frontale et commence par pr&eacute;parer le caf&eacute;. Quelques minutes plus tard, c&rsquo;est au tour de Maxim Cain de se lever. Premier r&eacute;flexe, sortir voir le temps qu&rsquo;il fait et retrouver ses chiens.</p>\r\n<p>La montagne est encore silencieuse, la mer de nuages juste en dessous. Les brebis dorment sur le pla de Montcamp, tout pr&egrave;s de la cabane du Sasc, en Ari&egrave;ge. Une succession de for&ecirc;ts, de pentes herbeuses et de cr&ecirc;tes arrondies au milieu des sommets ari&eacute;geois dont l&rsquo;&eacute;l&eacute;gante pique Rouge de Bassi&egrave;s (2 676 m&egrave;tres). C&rsquo;est dans cet abri, avec eau, &eacute;lectricit&eacute; et grandes ouvertures sur le paysage que Marion Poinssot et Maxim Cain d&eacute;butent leur saison. Fin juin, ils quittent le quartier bas de leur estive pour filer vers les quartiers hauts, chacun dans sa cabane, elle &agrave; la Unarde, lui &agrave; Bayle.</p>\r\n<p>&nbsp;</p>\r\n<section class=\"article__content article__content--restricted\">\r\n<p class=\"article__paragraph article__paragraph--lf\"><img class=\"n3VNCb\" style=\"width: 326px; height: 209px; margin: 0px auto; display: block;\" src=\"https://img.20mn.fr/AwOg3Ts_QheATJUKzc7dFA/830x532_agneaux-illustration.jpg\" alt=\"Luxembourg: Une brebis met au monde six agneaux, un fait rare\" data-noaft=\"1\" /></p>\r\n</section>', 'Les brebis dans les pÃ¢turages', 1, 0, '2021-07-24 19:58:46', '2021-07-24 20:07:18', 1, '/article/des-brebis-et-des-hommes-un-ete-dans-les-paturages'),
(2, 'Du Mexique Ã  DubaÃ¯, nos envies dâ€™ailleurs pour respirer Ã  nouveau', '<p>Une itin&eacute;rance m&ecirc;lant nature et bien-&ecirc;tre au Costa Rica, un safari &agrave; pied dans le Masa&iuml; Mara, une parenth&egrave;se baln&eacute;aire aux Bahamas&hellip; Voyager n&rsquo;est pas ais&eacute; en ces temps perturb&eacute;s, mais cela reste possible: la preuve avec ces suggestions aux couleurs de l&rsquo;&eacute;vasion.</p>\r\n<p>S&rsquo;il n&rsquo;est pas question ici de nier l&rsquo;&eacute;vidence de la prudence dont il nous faut tous redoubler, nous tenons tout autant &agrave; garder bien vivace la flamme du r&ecirc;ve&hellip; Tandis que la morosit&eacute; gagne du terrain, c&rsquo;est m&ecirc;me une quasi-obligation morale que de vous offrir cette respiration.</p>\r\n<p>Le confinement a exacerb&eacute; le besoin d&rsquo;&eacute;vasion et nombre d&rsquo;entre vous l&rsquo;ont assouvi cet &eacute;t&eacute; en sillonnant notre beau pays. Mais &agrave; l&rsquo;approche de l&rsquo;hiver, l&rsquo;appel du lointain, de son soleil que nous ne trouverons pas sous nos latitudes, de ses promesses de d&eacute;couvertes (le masque n&rsquo;emp&ecirc;che nullement d&rsquo;avoir les yeux grands ouverts!), nous taraude plus que jamais.</p>\r\n<p>En prenant les pr&eacute;cautions qui s&rsquo;imposent, pour nous et pour les autres, voyager est encore possible. Nous avons s&eacute;lectionn&eacute; des destinations qui, au moment o&ugrave; nous &eacute;crivons ces lignes, n&rsquo;imposent pas de quarantaine &agrave; l&rsquo;arriv&eacute;e, et des propositions qui r&eacute;pondent &agrave; toutes les envies: voguer, buller, p&eacute;r&eacute;griner, observer&hellip;</p>\r\n<p>&nbsp;</p>\r\n<p><img class=\"n3VNCb\" style=\"width: 515px; height: 233px; margin: 0px auto; display: block;\" src=\"https://www.epaillote.com/project/resources/img/original/ilescaraibes.png\" alt=\"Iles des Cara&iuml;bes\" data-noaft=\"1\" /></p>', 'Voyage dans les caraÃ¯bes', 1, 0, '2021-07-24 20:04:22', '2021-07-24 20:06:19', 2, '/article/du-mexique-dubai-nos-envies-d-ailleurs-pour-respirer-a-nouveau'),
(3, 'Voyage Ã  Bali', '<p>&nbsp;</p>\r\n<p><img class=\"n3VNCb\" style=\"width: 442px; height: 261.222px; margin: 0px auto; display: block;\" src=\"http://blog.showroomprive.com/content/uploads/2020/05/Article_Blog_Slider_Blog_-5.jpg\" alt=\"VoyagezChezVous : rencontre avec Bali et ses embl&eacute;matiques rizi&egrave;res |  VOYAGES &amp; LOISIRS\" data-noaft=\"1\" /></p>\r\n<p>Hello tout le monde et bienvenue sur notre page d&eacute;di&eacute;e &agrave; notre destination pr&eacute;f&eacute;r&eacute;e : Bali. Ici nous allons vous faire visiter Bali, cette &icirc;le indon&eacute;sienne paradisiaque tr&egrave;s touristique dont tout le monde parle mais que peu connaissent vraiment. La preuve avec nous d&rsquo;ailleurs, nous r&eacute;alisons un voyage Indonesie chaque ann&eacute;e pour d&eacute;couvrir de nouveaux endroits. Mais au bout de trois voyages &agrave; Bali, nous avions vraiment envie de vous en parler, en toute transparence (comme d&rsquo;habitude !). L&rsquo;&icirc;le de Bali est de plus en plus populaire car c&rsquo;est la plus connue d&rsquo;Indon&eacute;sie. Elle s&rsquo;est d&eacute;velopp&eacute;e tr&egrave;s vite et le tourisme de masse est aujourd&rsquo;hui bien pr&eacute;sent. En 2015 d&eacute;j&agrave;, quand nous y sommes all&eacute;s pour la premi&egrave;re fois, nous avons d&eacute;couvert une &icirc;le qui vivait &agrave; 100 &agrave; l&rsquo;heure, blind&eacute;e de monde, d&rsquo;h&ocirc;tels, de restaurants&hellip; pour le plus grand bonheurs des touristes. Mais pas pour nous ! Nous arrivions d&rsquo;Australie, o&ugrave; les terres sont vastes et o&ugrave; il y a de l&rsquo;espace. Alors je vous avoue que nous nous sentions un peu oppress&eacute;s &agrave; lors de ce premier voyage Bali. Mais heureusement, on a vite fuit cette foule qui grouillait autour de Kuta et Seminyak et nous sommes rendus dans des endroit plus recul&eacute;s (&agrave; l&rsquo;&eacute;poque) comme Canggu et Ubud.</p>\r\n<p>Canggu c&rsquo;est le paradis des surfeurs-hipsters ! Le coin chill de Bali o&ugrave; on vit autant le jour que la nuit. Ubud est dans les terres, au centre de l&rsquo;&icirc;le, et c&rsquo;est le paradis des temples et des rizi&egrave;res. On se retrouve au coeur de la nature avec les singes et les balinais qui cultivent leurs champs. On a ador&eacute; l&rsquo;ambiance relaxante et ce c&ocirc;t&eacute; bien-&ecirc;tre que pr&ocirc;ne les habitants de cette petite ville. Nous avons &eacute;galement d&eacute;couvert Jimbaran et la r&eacute;gion d&rsquo;Uluwatu, dans le sud de Bali. Un vrai petit cocon d&rsquo;expatri&eacute;s venant du monde entier, pour surfer et vivre au rythme du soleil balinais. Il nous tarde de d&eacute;couvrir et escalader les diff&eacute;rents volcans comme le Mont Batur pour assister &agrave; un magnifique lever de soleil.</p>\r\n<p>Et puis il y a aussi le reste de Bali, avec les supers spots de plong&eacute;e sous-marine &agrave; l&rsquo;est vers Amed. La fraicheur des montagnes, les cascades, le Mont Agung. Ou encore le nord de Bali avec le d&eacute;sormais tr&egrave;s connu Munduk et ses balan&ccedil;oires. La Sekumpul Waterfall, les rizi&egrave;res en terrasses de Jatiluwih, class&eacute;es au patrimoine mondial de l&rsquo;UNESCO.</p>\r\n<p>Mais voyager &agrave; Bali c&rsquo;est aussi d&eacute;couvrir des &icirc;les aux alentours o&ugrave; il y a plein de choses &agrave; faire comme &agrave; Nusa Lembongan, Nusa Ceningan et Nusa Penida, cette derni&egrave;re qui fut un gros coup de coeur et que nous allons vous pr&eacute;senter dans les articles ci-dessous. Bonne lecture &agrave; tous et n&rsquo;h&eacute;sitez pas &agrave; nous laisser un petit commentaire en bas des articles pour nous questionner ou &eacute;changer sur cette destination qu&rsquo;on adore !</p>', 'Voyage Ã  Bali', 1, 0, '2021-07-24 20:09:01', '2021-07-24 20:09:33', 2, '/article/voyage-a-bali');

CREATE TABLE `{DBPREFIX}Category` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Category` (`id`, `label`, `creationDate`, `updateDate`, `isDeleted`) VALUES
(1, 'Pas de catÃ©gorie', '2021-07-24 19:55:02', NULL, 0),
(2, 'Voyage', '2021-07-24 19:55:22', NULL, 0),
(3, 'Nature', '2021-07-24 19:55:25', NULL, 0),
(4, 'Pays', '2021-07-24 19:55:30', NULL, 0),
(5, 'DÃ©couverte', '2021-07-24 19:55:46', NULL, 0),
(6, 'SÃ©jours', '2021-07-26 21:54:39', NULL, 0),
(7, 'Paris', '2021-07-26 21:55:05', NULL, 0),
(8, 'Monde', '2021-07-26 21:55:16', NULL, 0),
(9, 'Mer', '2021-07-26 21:55:31', NULL, 0),
(10, 'Monument', '2021-07-26 21:55:48', NULL, 0),
(11, 'Touristique', '2021-07-26 21:55:57', NULL, 0),
(12, 'MusÃ©e', '2021-07-26 21:56:27', NULL, 0);

CREATE TABLE `{DBPREFIX}Category_Article` (
  `id` int(11) NOT NULL,
  `id_Article` int(11) UNSIGNED NOT NULL,
  `id_Category` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Category_Article` (`id`, `id_Article`, `id_Category`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 4);

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

INSERT INTO `{DBPREFIX}Comment` (`id`, `content`, `isDeleted`, `creationDate`, `updateDate`, `id_Article`, `id_User`, `id_Comment`, `isVerified`) VALUES
(1, 'Trop beau', 0, '2021-07-24 20:19:01', NULL, 1, 2, NULL, 1);

CREATE TABLE `{DBPREFIX}Config` (
  `id` int(10) UNSIGNED NOT NULL,
  `options` varchar(500) COLLATE utf8_bin NOT NULL,
  `value` varchar(500) COLLATE utf8_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Config` (`id`, `options`, `value`, `creationDate`, `updateDate`) VALUES
(1, 'theme', 'theme_classic/', '2021-07-24 21:11:34', NULL);

CREATE TABLE `{DBPREFIX}Media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `media` varchar(255) COLLATE utf8_bin NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Media` (`id`, `name`, `media`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Barcelone', 'barcelona.jpeg', 0, '2021-07-24 20:22:31', '2021-07-25 10:33:01'),
(2, 'San juan ', 'san_juan.jpg', 0, '2021-07-24 20:23:25', '2021-07-25 10:33:08'),
(3, 'Le transsibÃ©rien', 'transsiberian.jpeg', 0, '2021-07-24 20:25:41', '2021-07-25 10:33:11');

CREATE TABLE `{DBPREFIX}Menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `contentMenu` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Menu` (`id`, `name`, `contentMenu`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Menu header', '[{\"id\":\"3\",\"object\":\"Article\",\"order\":0},{\"id\":\"2\",\"object\":\"Page\",\"order\":1}]', 0, '2021-07-26 23:21:21', '2021-07-26 23:21:36'),
(2, 'Menu footer', '[{\"id\":\"3\",\"object\":\"Page\",\"order\":0},{\"id\":\"2\",\"object\":\"Page\",\"order\":1}]', 0, '2021-07-26 23:25:31', '2021-07-26 23:25:43');

CREATE TABLE `{DBPREFIX}Page` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `isVisible` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL,
  `id_User` int(11) UNSIGNED NOT NULL,
  `uri` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Page` (`id`, `title`, `content`, `description`, `isVisible`, `isDeleted`, `creationDate`, `updateDate`, `id_User`, `uri`) VALUES
(1, 'Accueil', '<h2><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.autourdublog.fr/wp-content/uploads/2016/10/famous-buildings-round-the-world-travel-wallpaper.jpg\" alt=\"\" width=\"942\" height=\"589\" /></h2>\r\n<h2 style=\"text-align: center;\">A PROPOS DE MOI</h2>\r\n<p style=\"text-align: center;\"><span style=\"font-family: arial, helvetica, sans-serif;\">Bienvenue sur mon blog voyage. Moi c\'est Margaux. Il y a 27 ans je suis partie seule passer un an en Australie. C\'est ce premier voyage m\'a donn&eacute; le go&ucirc;t de l\'aventure. Apr&egrave;s plusieurs s&eacute;jours en Asie, en 2010 j\'ai pris une ann&eacute;e sabbatique et je suis partie voyager seule autour du monde, un voyage d\'un an qui a chang&eacute; ma vie.&nbsp;</span><br /><span style=\"font-family: arial, helvetica, sans-serif;\">Je vous raconte mes escapades chez moi &agrave; Nantes, en Loire Atlantique, en France ou ailleurs, toujours en vous d&eacute;livrant de nombreux conseils aux voyageurs.&nbsp;</span><br /><span style=\"font-family: arial, helvetica, sans-serif;\">Je vous souhaite un bon voyage virtuel dans ces colonnes !</span></p>\r\n<h2 style=\"text-align: center;\">RESTONS EN CONTACT</h2>\r\n<p style=\"text-align: center;\">margaux.voyage@gmail.com</p>', 'Accueil', 1, 0, '2021-07-13 17:04:55', '2021-07-27 21:45:52', 1, '/home'),
(2, 'Qui sommes-nous ?', '<h2>Un voyage autour du monde inattendu</h2>\r\n<p>Tout commence il y a quelques ann&eacute;es, en 2008 plus exactement. Je viens de terminer ma premi&egrave;re ann&eacute;e universitaire et pour me lib&eacute;rer l&rsquo;esprit, je d&eacute;cide de me prendre un aller-retour pour le Vietnam, &agrave; Hanoi. Dur&eacute;e du s&eacute;jour : deux semaines. C&rsquo;est la premi&egrave;re fois que je pars aussi loin. Je n&rsquo;ai que 210 euros sur mon compte et seulement un sac &agrave; dos de 20 litres pour ce voyage. Je me dis que ce doit &ecirc;tre amplement suffisant pour un p&eacute;riple de 14 jours&hellip;<br />Sauf qu&rsquo;&agrave; ce moment-l&agrave; je suis loin de me douter que cette escapade ne se passera pas comme pr&eacute;vu et qu&rsquo;elle changera radicalement ma vie &hellip;</p>\r\n<p>Durant ce voyage, au cours duquel je ne reste que dans la capitale vietnamienne, je rencontre plusieurs voyageurs plus fabuleux et int&eacute;ressant les uns que les autres.<br />L&rsquo;un de ces <strong>globetrotters</strong>, Alex, un Australien qui parcourt le monde depuis de longues ann&eacute;es, m&rsquo;apprend beaucoup de choses, dont le fait de ne pas forc&eacute;ment avoir besoin d&rsquo;un compte en banque bien rempli pour voyager.</p>\r\n<p>Lors d&rsquo;une discussion dans un bar &agrave; Hano&iuml; je n&rsquo;arr&ecirc;te pas de lui r&eacute;p&eacute;ter la chance qu&rsquo;il a de pouvoir voyager autour du monde, comme &ccedil;a , n&rsquo;importe o&ugrave; et n&rsquo;importe quand.<br />Et il me dit ces mots, ces mots dont nous avons tous conscience sans forc&eacute;ment mesurer la puissance qu&rsquo;ils impliquent :</p>\r\n<blockquote>\r\n<p><strong>Alex :</strong> Tu es ce que tu dis.<br /><strong>Ryan :</strong> Je suis ce que je dis ?<br /><strong>Alex :</strong> Oui. Tu es ma&icirc;tre de tes limites et de tes croyances. Tes mots, tes paroles, tes pens&eacute;es construisent ton univers. [&hellip;]</p>\r\n</blockquote>\r\n<p>Cette conversation qui dure plus de deux heures , m&rsquo;ouvre les yeux sur pas mal de choses et me fait r&eacute;fl&eacute;chir pendant mes deux derniers jours &agrave; Hano&iuml;.</p>\r\n<p>Deux jours plus tard, hasard ou destin, le taxi qui me m&egrave;ne vers l&rsquo;a&eacute;roport pour rentrer en France se retrouve bloqu&eacute; dans les embouteillages de la ville. Je manque &eacute;videmment mon vol.<br />&Agrave; partir de l&agrave; deux choix s&rsquo;offrent &agrave; moi.</p>\r\n<ul>\r\n<li>Utiliser l&rsquo;argent de secours que m&rsquo;a envoy&eacute; un proche pour acheter un nouveau billet et retourner &agrave; ma vie parisienne.</li>\r\n<li>utiliser l&rsquo;argent de secours pour rester plus longtemps afin d&rsquo;explorer le pays et vivre un vrai voyage.</li>\r\n</ul>\r\n<p>Devinez ce que j&rsquo;ai fait ?</p>\r\n<h2>De touriste &agrave; globe trotter</h2>\r\n<p>Mon voyage devait durer 14 jours, je ne suis rentr&eacute; chez moi que 124 jours plus tard.<br />Durant ces 4 mois , je voyage &agrave; travers le Vietnam, le Laos et la Tha&iuml;lande allant toujours de l&rsquo;avant, voulant toujours voir ce qui se passe plus loin, refusant de revenir sur mes pas !<br />On dit que les voyages font grandir, et en effet, ils ouvrent votre esprit au monde et aux autres, vous donnent un point de vue diff&eacute;rent de la vie, vous apportent une d&eacute;finition diff&eacute;rente du bonheur et du besoin. Les voyages vous apprennent &agrave; &eacute;couter, &agrave; appr&eacute;cier.<br />Cette exp&eacute;rience fut la plus enrichissante de ma vie !</p>\r\n<p>Une fois de retour j&rsquo;ai su qu&rsquo;il me serait impossible de revenir &agrave; ma vie d&rsquo;avant. J&rsquo;ai attrap&eacute; cette maladie du voyage. Cette soif de d&eacute;couverte et de rencontre.<br />Depuis 4 ans, je suis un voyageur permanent.</p>\r\n<h2>Pourquoi ce blog sur le voyage?</h2>\r\n<p>J&rsquo;ai cr&eacute;&eacute; ce blog voyage pour inspirer d&rsquo;autres personnes, de la m&ecirc;me fa&ccedil;on que ce globe-trotter Alex et les autres voyageurs que j&rsquo;ai rencontr&eacute;s durant ce p&eacute;riple, m&rsquo;ont inspir&eacute;.<br />Ce blog qui relate mes voyages autour du monde est l&agrave; pour vous montrer qu&rsquo;il est possible de voyager de mani&egrave;re permanente sans forc&eacute;ment avoir un gros compte en banque.</p>\r\n<p>Les personnes que je rencontre, ou les personnes de mon entourage disent souvent m&rsquo;envier, m&ecirc;me pour un voyage d&rsquo;une plus courte p&eacute;riode. Ce blog de voyage a &eacute;t&eacute; cr&eacute;&eacute; pour vous montrer qu&rsquo;il est possible de le r&eacute;aliser et vous montre comment y arriver.<br />Ma premi&egrave;re exp&eacute;rience de 4 mois en est la preuve, alors que je n&rsquo;avais rien pr&eacute;par&eacute;, rien pr&eacute;m&eacute;dit&eacute; et que je n&rsquo;avais que 210 euros en poche au d&eacute;part.</p>\r\n<p>&nbsp;</p>', 'Page Ã  propos', 1, 0, '2021-07-24 20:12:41', '2021-07-24 22:13:08', 1, '/qui-sommes-nous'),
(3, 'Politique de confidentialitÃ©', '<h3 id=\"introduction\">Introduction</h3>\r\n<p>Dans le cadre de son activit&eacute;, la soci&eacute;t&eacute; ODYSSEY, dont le si&egrave;ge social est situ&eacute; au 242 Rue du Faubourg Saint-Antoine, 75012 Paris, est amen&eacute;e &agrave; collecter et &agrave; traiter des informations dont certaines sont qualifi&eacute;es de \"donn&eacute;es personnelles\". ODYSSEY attache une grande importance au respect de la vie priv&eacute;e, et n&rsquo;utilise que des donnes de mani&egrave;re responsable et confidentielle et dans une finalit&eacute; pr&eacute;cise.</p>\r\n<h3 id=\"donn-es-personnelles\">Donn&eacute;es personnelles</h3>\r\n<p>Sur le site web odyssey.com, il y a 2 types de donn&eacute;es susceptibles d&rsquo;&ecirc;tre recueillies :</p>\r\n<ul>\r\n<li><strong>Les donn&eacute;es transmises directement</strong><br />Ces donn&eacute;es sont celles que vous nous transmettez directement, via un formulaire de contact ou bien par contact direct par email. Sont obligatoires dans le formulaire de contact le champs &laquo; pr&eacute;nom et nom &raquo;, &laquo; entreprise ou organisation &raquo; et &laquo; email &raquo;.</li>\r\n<li><strong>Les donn&eacute;es collect&eacute;es automatiquement</strong><br />Lors de vos visites, une fois votre consentement donn&eacute;, nous pouvons recueillir des informations de type &laquo; web analytics &raquo; relatives &agrave; votre navigation, la dur&eacute;e de votre consultation, votre adresse IP, votre type et version de navigateur. La technologie utilis&eacute;e est le cookie.</li>\r\n</ul>\r\n<h3 id=\"utilisation-des-donn-es\">Utilisation des donn&eacute;es</h3>\r\n<p>Les donn&eacute;es que vous nous transmettez directement sont utilis&eacute;es dans le but de vous re-contacter et/ou dans le cadre de la demande que vous nous faites. Les donn&eacute;es &laquo; web analytics &raquo; sont collect&eacute;es de forme anonyme (en enregistrant des adresses IP anonymes) par Google Analytics, et nous permettent de mesurer l\'audience de notre site web, les consultations et les &eacute;ventuelles erreurs afin d&rsquo;am&eacute;liorer constamment l&rsquo;exp&eacute;rience des utilisateurs. Ces donn&eacute;es sont utilis&eacute;es par ODYSSEY, responsable du traitement des donn&eacute;es, et ne seront jamais c&eacute;d&eacute;es &agrave; un tiers ni utilis&eacute;es &agrave; d&rsquo;autres fins que celles d&eacute;taill&eacute;es ci-dessus.</p>\r\n<h3 id=\"base-l-gale\">Base l&eacute;gale</h3>\r\n<p>Les donn&eacute;es personnelles ne sont collect&eacute;es qu&rsquo;apr&egrave;s consentement obligatoire de l&rsquo;utilisateur. Ce consentement est valablement recueilli (boutons et cases &agrave; cocher), libre, clair et sans &eacute;quivoque.</p>\r\n<h3 id=\"dur-e-de-conservation\">Dur&eacute;e de conservation</h3>\r\n<p>Les donn&eacute;es seront sauvegard&eacute;es durant une dur&eacute;e maximale de 3 ans.</p>\r\n<h3 id=\"cookies\">Cookies</h3>\r\n<p>Voici la liste des cookies utilis&eacute;es et leur objectif :</p>\r\n<ul>\r\n<li>Cookies Google Analytics (<a href=\"https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage\">liste exhaustive</a>) : Web analytics</li>\r\n</ul>\r\n<h3 id=\"vos-droits-concernant-les-donn-es-personnelles\">Vos droits concernant les donn&eacute;es personnelles</h3>\r\n<p>Vous avez le droit de consultation, demande de modification ou d&rsquo;effacement sur l&rsquo;ensemble de vos donn&eacute;es personnelles. Vous pouvez &eacute;galement retirer votre consentement au traitement de vos donn&eacute;es.</p>\r\n<h3 id=\"contact-d-l-gu-la-protection-des-donn-es\">Contact d&eacute;l&eacute;gu&eacute; &agrave; la protection des donn&eacute;es</h3>\r\n<p>Odyssey - odyssey@mail.com</p>', 'Politique de confidentialitÃ©', 1, 0, '2021-07-26 23:03:26', NULL, 2, '/politique-de-confidentialite'),
(4, 'Contact', '<h2 style=\"text-align: center;\">Contactez-moi</h2>\r\n<h2 style=\"text-align: center;\">E-mail: margaux.voyage@gmail.com<br />T&eacute;l: 0603450865</h2>\r\n<!-- Facebook Filled icon by Icons8 -->\r\n<p><iframe style=\"border: 0px; width: 1145px; height: 859px;\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d185895.77508925594!2d5.240412801235383!3d43.280305080770155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9bf4344da5333%3A0x40819a5fd970220!2sMarseille!5e0!3m2!1sfr!2sfr!4v1627415433063!5m2!1sfr!2sfr\" width=\"1205\" height=\"904\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></p>', 'Page de contact', 1, 0, '2021-07-27 19:47:41', '2021-07-27 21:57:01', 1, '/contact');

CREATE TABLE `{DBPREFIX}Role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `value` longtext CHARACTER SET latin1 NOT NULL,
  `isDeleted` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}Role` (`id`, `name`, `value`, `isDeleted`) VALUES
(1, 'Administrateur', '{\"all_perms\":\"1\"}', 0),
(2, 'Editeur', '{\"\\/admin\\/pages\":\"1\",\"\\/admin\\/add-page\":\"1\",\"\\/admin\\/edit-page\":\"1\",\"\\/admin\\/delete-page\":\"1\",\"\\/admin\\/articles\":\"1\",\"\\/admin\\/add-article\":\"1\",\"\\/admin\\/edit-article\":\"1\",\"\\/admin\\/delete-article\":\"1\",\"\\/admin\\/comments\":\"1\"}', 0),
(3, 'Auteur', '{\"\\/admin\\/pages\":\"1\",\"\\/admin\\/add-page\":\"1\",\"\\/admin\\/articles\":\"1\",\"\\/admin\\/add-article\":\"1\"}', 0),
(4, 'Visiteur', '', 0);

CREATE TABLE `{DBPREFIX}User` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(120) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(320) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `phone` varchar(10) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `isVerified` tinyint(4) NOT NULL DEFAULT '0',
  `lastConnexionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `{DBPREFIX}User` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `phone`, `token`, `isVerified`, `lastConnexionDate`, `isDeleted`, `creationDate`, `updateDate`) VALUES
(1, 'Admin', 'Louis', 'admin@gmail.com', '$2y$10$6xFy/sQZDlDdrH8upXyQRuj1tJSLCfgVAEzSVLQpIv34PBycjOEYe', 1, '0764859586', '', 1, '2021-07-24 08:44:45', 0, '2021-07-23 22:13:34', '2021-07-24 00:29:04'),
(2, 'Margaux', 'HEBERT', 'margauxhebert83@gmail.com', '$2y$10$WG.3paYCoOlaeuK9fvU90eFxQTHrs0NJV0qycwo2pwTIp22pJ0aWm', 2, '0154785424', '', 1, '2021-07-25 10:59:05', 0, '2021-07-24 20:14:18', '2021-07-24 23:08:17');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `{DBPREFIX}Category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `{DBPREFIX}Category_Article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `{DBPREFIX}Comment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `{DBPREFIX}Config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `{DBPREFIX}Media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `{DBPREFIX}Menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `{DBPREFIX}Page`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `{DBPREFIX}Role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `{DBPREFIX}User`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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