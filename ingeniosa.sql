-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 18 juil. 2021 à 15:23
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ingeniosa`
--

-- --------------------------------------------------------

--
-- Structure de la table `code_postal`
--

DROP TABLE IF EXISTS `code_postal`;
CREATE TABLE IF NOT EXISTS `code_postal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `code_postal`
--

INSERT INTO `code_postal` (`id`, `name`) VALUES
(2, '101'),
(3, '105'),
(4, '106'),
(5, '303');

-- --------------------------------------------------------

--
-- Structure de la table `dirigeant`
--

DROP TABLE IF EXISTS `dirigeant`;
CREATE TABLE IF NOT EXISTS `dirigeant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `society_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` int(11) NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BEC71E71E6389D24` (`society_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dirigeant`
--

INSERT INTO `dirigeant` (`id`, `society_id`, `name`, `sexe`, `lastname`, `email`) VALUES
(1, 1, 'nomenarisoa', 2, 'Randrianindindrina', 'nomenarisoa.hajalalaina@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210717123357', '2021-07-17 12:35:47', 55),
('DoctrineMigrations\\Version20210717153812', '2021-07-17 15:38:28', 38),
('DoctrineMigrations\\Version20210717175157', '2021-07-17 17:52:10', 359),
('DoctrineMigrations\\Version20210717193424', '2021-07-17 19:34:42', 90);

-- --------------------------------------------------------

--
-- Structure de la table `society`
--

DROP TABLE IF EXISTS `society`;
CREATE TABLE IF NOT EXISTS `society` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_postal_id` int(11) DEFAULT NULL,
  `ville_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D6461F2B2B59251` (`code_postal_id`),
  KEY `IDX_D6461F2A73F0036` (`ville_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `society`
--

INSERT INTO `society` (`id`, `code_postal_id`, `ville_id`, `name`, `description`) VALUES
(1, 3, 3, 'Nomenarisoa', 'Cognitis enim pilatorum caesorumque funeribus nemo deinde ad has stationes appulit navem, sed ut Scironis praerupta letalia declinantes litoribus Cypriis contigui navigabant, quae Isauriae scopulis sunt controversa.'),
(2, 2, 2, 'TELMA', 'Ut enim benefici liberalesque sumus, non ut exigamus gratiam (neque enim beneficium faeneramur sed natura propensi ad liberalitatem sumus), sic amicitiam non spe mercedis adducti sed quod omnis eius fructus in ipso amore inest, expetendam putamus.');

-- --------------------------------------------------------

--
-- Structure de la table `society_type_society`
--

DROP TABLE IF EXISTS `society_type_society`;
CREATE TABLE IF NOT EXISTS `society_type_society` (
  `society_id` int(11) NOT NULL,
  `type_society_id` int(11) NOT NULL,
  PRIMARY KEY (`society_id`,`type_society_id`),
  KEY `IDX_A3D8CE1BE6389D24` (`society_id`),
  KEY `IDX_A3D8CE1BFB3B4B01` (`type_society_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `society_type_society`
--

INSERT INTO `society_type_society` (`society_id`, `type_society_id`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_society`
--

DROP TABLE IF EXISTS `type_society`;
CREATE TABLE IF NOT EXISTS `type_society` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_society`
--

INSERT INTO `type_society` (`id`, `name`) VALUES
(1, 'SA'),
(2, 'SARL');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_43C3D9C3B2B59251` (`code_postal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `name`, `code_postal_id`) VALUES
(2, 'Antananarivo', 2),
(3, 'Ambohitrimanjaka', 3),
(5, 'Analakely', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dirigeant`
--
ALTER TABLE `dirigeant`
  ADD CONSTRAINT `FK_BEC71E71E6389D24` FOREIGN KEY (`society_id`) REFERENCES `society` (`id`);

--
-- Contraintes pour la table `society`
--
ALTER TABLE `society`
  ADD CONSTRAINT `FK_D6461F2A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`),
  ADD CONSTRAINT `FK_D6461F2B2B59251` FOREIGN KEY (`code_postal_id`) REFERENCES `code_postal` (`id`);

--
-- Contraintes pour la table `society_type_society`
--
ALTER TABLE `society_type_society`
  ADD CONSTRAINT `FK_A3D8CE1BE6389D24` FOREIGN KEY (`society_id`) REFERENCES `society` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A3D8CE1BFB3B4B01` FOREIGN KEY (`type_society_id`) REFERENCES `type_society` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `FK_43C3D9C3B2B59251` FOREIGN KEY (`code_postal_id`) REFERENCES `code_postal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
