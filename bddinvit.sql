-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 19 fév. 2024 à 09:41
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bddinvit`
--

-- --------------------------------------------------------

--
-- Structure de la table `cat??gories_invit??s`
--

DROP TABLE IF EXISTS `cat??gories_invit??s`;
CREATE TABLE IF NOT EXISTS `cat??gories_invit??s` (
  `Id_Type_Invités` int(11) NOT NULL AUTO_INCREMENT,
  `Désignation_Catégories_Invités` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id_Type_Invités`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories_evenement`
--

DROP TABLE IF EXISTS `categories_evenement`;
CREATE TABLE IF NOT EXISTS `categories_evenement` (
  `Id_Categories_Evenement` int(11) NOT NULL AUTO_INCREMENT,
  `Designation_Evenement` varchar(30) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_Categories_Evenement`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories_evenement`
--

INSERT INTO `categories_evenement` (`Id_Categories_Evenement`, `Designation_Evenement`, `date_creation`) VALUES
(1, 'Exposition', '2024-02-10 15:05:19'),
(2, 'Conférence', '2024-02-10 15:05:19'),
(3, 'Anniversaire', '2024-02-10 15:05:19'),
(4, 'Mariage', '2024-02-10 15:05:19'),
(5, 'Concert', '2024-02-10 15:05:19'),
(6, 'Journée Culturelle', '2024-02-10 15:05:19'),
(7, 'Gala', '2024-02-10 15:05:19'),
(8, 'Festival', '2024-02-10 15:05:19'),
(9, 'Rassemblement', '2024-02-10 15:05:19'),
(10, 'Pic Nic', '2024-02-10 15:05:19');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `Id_Commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `Commentaire` varchar(200) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL,
  `Id_Invités` int(11) NOT NULL,
  PRIMARY KEY (`Id_Commentaire`),
  KEY `Id_Invités` (`Id_Invités`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `convier`
--

DROP TABLE IF EXISTS `convier`;
CREATE TABLE IF NOT EXISTS `convier` (
  `Id_Evenement` int(11) NOT NULL,
  `Id_Invités` int(11) NOT NULL,
  `Heure_Arrivée` time DEFAULT NULL,
  PRIMARY KEY (`Id_Evenement`,`Id_Invités`),
  KEY `Id_Invités` (`Id_Invités`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `Id_Evenement` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) DEFAULT NULL,
  `Date_Event` date DEFAULT NULL,
  `Lieu` varchar(30) DEFAULT NULL,
  `Affiche` text,
  `Adresse` varchar(50) DEFAULT NULL,
  `Heure` time DEFAULT NULL,
  `Id_Categories_Evenement` int(11) DEFAULT NULL,
  `Type_Evenement` int(1) DEFAULT NULL,
  `mode` varchar(10) DEFAULT NULL,
  `Id_User` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Evenement`),
  KEY `Id_Categories_Evenement` (`Id_Categories_Evenement`),
  KEY `Id_User` (`Id_User`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`Id_Evenement`, `Titre`, `Date_Event`, `Lieu`, `Affiche`, `Adresse`, `Heure`, `Id_Categories_Evenement`, `Type_Evenement`, `mode`, `Id_User`) VALUES
(1, 'Mariage Adam Alame', '2024-02-15', 'Congo Loisir', 'images/65ce1522aa114.Screenshot_20230510-090137.png', 'Av/ Jeunesse Q/ Musey', '14:42:00', 4, 1, 'presence', 122),
(2, 'Match', '2024-02-14', 'Stade de Martyr', 'images/65ce1a7819b1d.DSC_0404.jpg', 'Kinshasa', '15:07:00', 5, 2, 'ligne', 122),
(3, 'Mariage Adam Alame', '2024-02-15', 'Congo Loisir', 'images/65ce22a8c135f.DSC_0402.jpg', 'Av/ Jeunesse Q/ Musey', '17:33:00', 2, 1, 'ligne', 122),
(4, 'DEVFEST', '2024-02-18', 'Orange Digital Center', 'images/65d221720d532.IMG-20230909-WA0042.jpg', 'Lingwala', '16:25:00', 2, 2, 'presence', 122);

-- --------------------------------------------------------

--
-- Structure de la table `interresser`
--

DROP TABLE IF EXISTS `interresser`;
CREATE TABLE IF NOT EXISTS `interresser` (
  `Id_User` int(11) NOT NULL,
  `Id_Evenement` int(11) NOT NULL,
  `Etat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id_User`,`Id_Evenement`),
  KEY `Id_Evenement` (`Id_Evenement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `invit??s`
--

DROP TABLE IF EXISTS `invit??s`;
CREATE TABLE IF NOT EXISTS `invit??s` (
  `Id_Invités` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Complet` varchar(30) DEFAULT NULL,
  `Téléphone` varchar(15) DEFAULT NULL,
  `Id_Table` int(11) NOT NULL,
  `Id_Type_Invités` int(11) NOT NULL,
  PRIMARY KEY (`Id_Invités`),
  KEY `Id_Table` (`Id_Table`),
  KEY `Id_Type_Invités` (`Id_Type_Invités`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `organiser`
--

DROP TABLE IF EXISTS `organiser`;
CREATE TABLE IF NOT EXISTS `organiser` (
  `Id_User` int(11) NOT NULL,
  `Id_Evenement` int(11) NOT NULL,
  PRIMARY KEY (`Id_User`,`Id_Evenement`),
  KEY `Id_Evenement` (`Id_Evenement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
CREATE TABLE IF NOT EXISTS `preferences` (
  `Id_User` int(11) NOT NULL,
  `Id_Categories_Evenement` int(11) NOT NULL,
  PRIMARY KEY (`Id_User`),
  KEY `Id_Categories_Evenement` (`Id_Categories_Evenement`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `Id_Table` int(11) NOT NULL AUTO_INCREMENT,
  `Désignation_Table` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id_Table`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `Id_User` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `telephone` int(15) DEFAULT NULL,
  `password` text,
  `image` text,
  `ip` varchar(20) DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_User`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id_User`, `username`, `telephone`, `password`, `image`, `ip`, `date_creation`) VALUES
(122, 'Adam Alame', 976187614, '$2y$12$AsaiBZyfOHgOIeIeoRVFK.0ufg3M3nnYf88vcuwEXfgqmD8SmWn6.', 'images/65c370ac3263e.IMG-20230224-WA0015.jpg', '::1', '2024-02-07 12:59:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
