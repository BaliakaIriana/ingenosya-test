-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 juil. 2021 à 14:32
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ingenosya`
--

-- --------------------------------------------------------

--
-- Structure de la table `code_postal`
--

DROP TABLE IF EXISTS `code_postal`;
CREATE TABLE IF NOT EXISTS `code_postal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `code_postal`
--

INSERT INTO `code_postal` (`id`, `code`) VALUES
(1, 100),
(2, 200),
(3, 300);

-- --------------------------------------------------------

--
-- Structure de la table `dirigeant`
--

DROP TABLE IF EXISTS `dirigeant`;
CREATE TABLE IF NOT EXISTS `dirigeant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dirigeant`
--

INSERT INTO `dirigeant` (`id`, `nom_prenom`, `sexe`, `email`) VALUES
(1, 'baliaka', 1, 'baliaka@gmail.com'),
(2, 'miora', 1, 'miora@gmail.com');

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
('DoctrineMigrations\\Version20210713081632', '2021-07-13 08:17:11', 817),
('DoctrineMigrations\\Version20210713090037', '2021-07-13 09:01:02', 7658),
('DoctrineMigrations\\Version20210713091857', '2021-07-13 09:19:27', 241),
('DoctrineMigrations\\Version20210713095904', '2021-07-13 09:59:11', 1228);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

DROP TABLE IF EXISTS `societe`;
CREATE TABLE IF NOT EXISTS `societe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville_id` int(11) NOT NULL,
  `nom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_19653DBDA73F0036` (`ville_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `ville_id`, `nom`, `description`) VALUES
(1, 3, 'phael', 'azera'),
(2, 3, 'snovi', 'azer');

-- --------------------------------------------------------

--
-- Structure de la table `societe_type_societe`
--

DROP TABLE IF EXISTS `societe_type_societe`;
CREATE TABLE IF NOT EXISTS `societe_type_societe` (
  `societe_id` int(11) NOT NULL,
  `type_societe_id` int(11) NOT NULL,
  PRIMARY KEY (`societe_id`,`type_societe_id`),
  KEY `IDX_FB9E3F15FCF77503` (`societe_id`),
  KEY `IDX_FB9E3F15E1F4A326` (`type_societe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe_type_societe`
--

INSERT INTO `societe_type_societe` (`societe_id`, `type_societe_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 3),
(2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `type_societe`
--

DROP TABLE IF EXISTS `type_societe`;
CREATE TABLE IF NOT EXISTS `type_societe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_societe`
--

INSERT INTO `type_societe` (`id`, `designation`) VALUES
(1, 'SARL'),
(2, 'EURL'),
(3, 'SELARL'),
(4, 'SA'),
(5, 'SAS'),
(6, 'SASU'),
(7, 'SNC'),
(8, 'SCP');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_postal_id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_43C3D9C3B2B59251` (`code_postal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `code_postal_id`, `nom`) VALUES
(1, 1, 'Antsirabe'),
(2, 1, 'Antananarivo'),
(3, 3, 'Toliara'),
(4, 2, 'Fianarantsoa');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `FK_19653DBDA73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`);

--
-- Contraintes pour la table `societe_type_societe`
--
ALTER TABLE `societe_type_societe`
  ADD CONSTRAINT `FK_FB9E3F15E1F4A326` FOREIGN KEY (`type_societe_id`) REFERENCES `type_societe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FB9E3F15FCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `FK_43C3D9C3B2B59251` FOREIGN KEY (`code_postal_id`) REFERENCES `code_postal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
