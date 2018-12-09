-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 09 déc. 2018 à 17:23
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecrivain`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapter`
--

DROP TABLE IF EXISTS `chapter`;
CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chapter`
--

INSERT INTO `chapter` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'Chapitre 1', '<h2>New York !</h2>\r\n<p><br /> <br /> D\'abord j\'ai &eacute;t&eacute; confondu par ta beaut&eacute;, ces grandes filles d\'or aux jambes longues.<br /> Si timide d\'abord devant tes yeux de m&eacute;tal bleu, ton sourire de givre<br /> Si timide. Et l\'angoisse au fond des rues &agrave; gratte-ciel<br /> Levant des yeux de chouette parmi l\'&eacute;clipse du soleil.<br /> Sulfureuse ta lumi&egrave;re et les f&ucirc;ts livides, dont les t&ecirc;tes foudroient le ciel<br /> Les gratte-ciel qui d&eacute;fient les cyclones sur leurs muscles d\'acier et leur peau patin&eacute;e de pierres.<br /> Mais quinze jours sur les trottoirs chauves de Manhattan<br /> &ndash; C\'est au bout de la troisi&egrave;me semaine que vous saisit la fi&egrave;vre en un bond de jaguar<br /> Quinze jours sans un puits ni p&acirc;turage, tous les oiseaux de l\'air<br /> Tombant soudain et morts sous les hautes cendres des terrasses.<br /> Pas un rire d\'enfant en fleur, sa main dans ma main fra&icirc;che<br /> Pas un sein maternel, des jambes de nylon. Des jambes et des seins sans sueur ni odeur.<br /> Pas un mot tendre en l\'absence de l&egrave;vres, rien que des c&oelig;urs artificiels pay&eacute;s en monnaie forte<br /> Et pas un livre o&ugrave; lire la sagesse. La palette du peintre fleurit des cristaux de corail.<br /> Nuits d\'insomnie &ocirc; nuits de Manhattan ! si agit&eacute;es de feux follets, tandis que les klaxons hurlent des heures vides<br /> Et que les eaux obscures charrient des amours hygi&eacute;niques, tels des fleuves en crue des cadavres d\'enfants.<br /> <br /> <br /> [...]<br /> <br /> <br /> <br /> Extrait de A New York - L&eacute;opold S&eacute;dar Senghor.</p>', '2018-12-08 21:14:30');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `signaled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C579F4768` (`chapter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `chapter_id`, `author`, `content`, `created_at`, `signaled`) VALUES
(1, 1, 'Nin', 'Test!!!!', '2018-12-08 21:15:15', 0),
(2, 1, 'Nin13', 'çà marche!!!! :)', '2018-12-09 08:57:10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181208211012');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `roles`) VALUES
(1, 'Forteroche', '$2y$12$vV2fFg/NXhLeTYAm3Se6c.id.Wc/fwFyrIardmfW27kKgeA3.sD/6', '[\"ROLE_ADMIN\"]');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C579F4768` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
