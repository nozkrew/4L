-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 14 mai 2020 à 13:22
-- Version du serveur :  5.7.28
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `4l`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E66EE45BDBF` (`picture_id`),
  KEY `IDX_23A0E66F6BD1646` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638F6BD1646` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FF6BD1646` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image_site`
--

DROP TABLE IF EXISTS `image_site`;
CREATE TABLE IF NOT EXISTS `image_site` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `siteName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondUserFirstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondUserLastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondUserEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secondUserUsername` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B1DC7A1EA76ED395` (`user_id`),
  KEY `IDX_B1DC7A1E9A1887DC` (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partner`
--

DROP TABLE IF EXISTS `partner`;
CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_312B3E16EE45BDBF` (`picture_id`),
  KEY `IDX_312B3E16F6BD1646` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8D3DA5256D` (`image_id`),
  KEY `IDX_5A8A6C8DF6BD1646` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2D737AEFC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id`, `type_id`, `title`, `template`, `slug`) VALUES
(1, 1, 'Article', 'articles.html.twig', 'article'),
(2, 5, 'Contact', 'contact.html.twig', 'contact'),
(3, 3, 'Partenaires', 'nos-partenaires.html.twig', 'nos-partenaires'),
(4, 2, 'Photos', 'photos.html.twig', 'photos'),
(5, 4, 'Le 4L Trophy', 'le-4l-trophy.html.twig', 'le-4l-trophy'),
(6, 4, 'L\'équipage', 'l-equipage.html.twig', 'l-equipage');

-- --------------------------------------------------------

--
-- Structure de la table `section_site`
--

DROP TABLE IF EXISTS `section_site`;
CREATE TABLE IF NOT EXISTS `section_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ECFDE5EFD823E37A` (`section_id`),
  KEY `IDX_ECFDE5EFF6BD1646` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `section_site`
--

INSERT INTO `section_site` (`id`, `section_id`, `site_id`, `ordering`, `content`) VALUES
(1, 1, 1, 1, ''),
(2, 2, 1, 2, ''),
(3, 3, 1, 3, ''),
(4, 4, 1, 4, ''),
(5, 5, 1, 5, ' '),
(6, 6, 1, 6, ' ');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_id` int(11) DEFAULT NULL,
  `header_image_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createDate` datetime NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objectif` int(11) DEFAULT NULL,
  `actual` int(11) DEFAULT NULL,
  `displayProgressBar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_694309E45E237E06` (`name`),
  UNIQUE KEY `UNIQ_694309E48C782417` (`header_image_id`),
  KEY `IDX_694309E49A1887DC` (`subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`id`, `subscription_id`, `header_image_id`, `name`, `slug`, `createDate`, `twitter`, `facebook`, `instagram`, `objectif`, `actual`, `displayProgressBar`) VALUES
(1, 1, NULL, 'Nom du site', 'nom-du-site', '2020-05-14 15:00:34', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nbMonth` int(11) NOT NULL,
  `price` double NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `subscription`
--

INSERT INTO `subscription` (`id`, `nbMonth`, `price`, `name`, `slug`) VALUES
(1, 12, 59, 'Premium', 'premium');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `css` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9775E7085E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'article'),
(2, 'photo'),
(3, 'partenaires'),
(4, 'post'),
(5, 'contact');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`),
  KEY `IDX_8D93D649F6BD1646` (`site_id`),
  KEY `IDX_8D93D649EE45BDBF` (`picture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `site_id`, `picture_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `firstname`, `lastname`) VALUES
(1, 1, NULL, 'admin', 'admin', 'admin@mail.com', 'admin@mail.com', 1, '$2y$13$Dp0yQBu2dojPT67OLAjazOQghan9VqhLT673350eFlcYRNvOpdcge', '$2y$13$Dp0yQBu2dojPT67OLAjazOQghan9VqhLT673350eFlcYRNvOpdcge', '2020-05-14 13:14:35', NULL, NULL, 'a:0:{}', 'Admin', 'Admin');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66EE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `image` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_23A0E66F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `image_site`
--
ALTER TABLE `image_site`
  ADD CONSTRAINT `FK_9B79E37ABF396750` FOREIGN KEY (`id`) REFERENCES `image` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `FK_B1DC7A1E9A1887DC` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`),
  ADD CONSTRAINT `FK_B1DC7A1EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `partner`
--
ALTER TABLE `partner`
  ADD CONSTRAINT `FK_312B3E16EE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `image` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_312B3E16F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8D3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_5A8A6C8DF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `FK_2D737AEFC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `section_site`
--
ALTER TABLE `section_site`
  ADD CONSTRAINT `FK_ECFDE5EFD823E37A` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `FK_ECFDE5EFF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `FK_694309E48C782417` FOREIGN KEY (`header_image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_694309E49A1887DC` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649EE45BDBF` FOREIGN KEY (`picture_id`) REFERENCES `image` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_8D93D649F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
