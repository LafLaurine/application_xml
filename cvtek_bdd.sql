-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 21 mars 2018 à 17:04
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
-- Base de données :  `cvtek_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `appel_offre`
--

DROP TABLE IF EXISTS `appel_offre`;
CREATE TABLE IF NOT EXISTS `appel_offre` (
  `id_entr` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL AUTO_INCREMENT,
  `titre_poste` varchar(128) NOT NULL,
  `type_contrat` varchar(32) NOT NULL,
  `remuneration` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `oa_fk` (`id_entr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `centre_interet`
--

DROP TABLE IF EXISTS `centre_interet`;
CREATE TABLE IF NOT EXISTS `centre_interet` (
  `id_centre_interet` int(11) NOT NULL AUTO_INCREMENT,
  `activite` varchar(255) NOT NULL,
  `id_CV` int(11) NOT NULL,
  PRIMARY KEY (`id_centre_interet`),
  KEY `CV_centre_fk` (`id_CV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id_competence` int(11) NOT NULL AUTO_INCREMENT,
  `competence` varchar(255) NOT NULL,
  `niveau_competence` varchar(255) NOT NULL,
  `type_competence` varchar(255) NOT NULL,
  `id_CV` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_competence`),
  KEY `CV_comp_fk` (`id_CV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

DROP TABLE IF EXISTS `cv`;
CREATE TABLE IF NOT EXISTS `cv` (
  `id_CV` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cv` varchar(255) NOT NULL,
  `prenom_cv` varchar(255) NOT NULL,
  `date_naiss_cv` date NOT NULL,
  `rue_cv` varchar(255) NOT NULL,
  `ville_cv` varchar(255) NOT NULL,
  `cp_cv` decimal(5,0) NOT NULL,
  `email_cv` varchar(255) NOT NULL,
  `telephone_cv` decimal(10,0) DEFAULT NULL,
  `portfolio_cv` varchar(255) DEFAULT NULL,
  `poste_cv` varchar(255) NOT NULL,
  `type_contrat` varchar(255) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  PRIMARY KEY (`id_CV`),
  KEY `etu_fk` (`id_etudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cv`
--

INSERT INTO `cv` (`id_CV`, `nom_cv`, `prenom_cv`, `date_naiss_cv`, `rue_cv`, `ville_cv`, `cp_cv`, `email_cv`, `telephone_cv`, `portfolio_cv`, `poste_cv`, `type_contrat`, `id_etudiant`) VALUES
(1, 'souvant', 'angelique', '2018-03-02', 'coquelicots', 'sevran', '93270', 'angelique.souvant@gmail.com', '659949046', 'http://angeliquesouvant.fr', 'poste', 'longtemps', 12),
(3, 'souvant', 'angelique', '2018-03-02', 'coquelicots', 'sevran', '93270', 'angelique.souvant@gmail.com', '659949046', 'http://angeliquesouvant.fr', 'poste', 'longtemps', 12);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entr` int(11) NOT NULL AUTO_INCREMENT,
  `nom_entr` varchar(255) NOT NULL,
  `email_entr` varchar(255) DEFAULT NULL,
  `telephone_entr` decimal(10,0) DEFAULT NULL,
  `mdp_entr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_entr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entr`, `nom_entr`, `email_entr`, `telephone_entr`, `mdp_entr`) VALUES
(1, 'venuzy', 'venuzy@gmail.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(2, 'venuzy', 'ceffev@efv.fr', NULL, '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e'),
(3, 'zohra', 'zohra@gmail.com', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(4, 'venuzy', 'ergt@ggff.fr', NULL, '1a0105893f4d33953d3b10c33e2aa12a1c3f93b7e793bc5a139b58fb6fd67486'),
(5, 'Flexus', 'l@laurine.fr', NULL, '5f4bd3ec1057f96455b1f3e5fbf707f712ccf93c37a60ed013887d8ed3660b02'),
(6, 'Entreprise', 'lzurine@l.fr', '546456', '5f4bd3ec1057f96455b1f3e5fbf707f712ccf93c37a60ed013887d8ed3660b02');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etu` varchar(255) NOT NULL,
  `prenom_etu` varchar(255) NOT NULL,
  `email_etu` varchar(255) DEFAULT NULL,
  `telephone_etu` varchar(255) DEFAULT NULL,
  `mdp_etu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom_etu`, `prenom_etu`, `email_etu`, `telephone_etu`, `mdp_etu`) VALUES
(1, 'evrev', 'zohra', 'gb@rbr.com', '0611317875', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(2, 'zakaria', 'bour', 'kenkvjf@fvf.com', '0611317875', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e'),
(3, 'zafez', 'rgerbge', 'drh@yjyuk.fr', '0611317875', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(4, 'zdef', 'drghbdf', 'egftn@thyt.fr', '0123456978', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(5, 'zzzz', 'dfff', 'eget@rht.com', '1472586', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(6, 'zohra', 'egte', 'qfrsg@rtjty.fr', '1472583691', '1a0105893f4d33953d3b10c33e2aa12a1c3f93b7e793bc5a139b58fb6fd67486'),
(7, 'Lafontaine', 'Laurine', 'p@p.fr', '0139875460', 'eaa2bded32cc585d3f37c5319abe8890ad28a697ed66d5823f10536cc9c0fdb9'),
(8, 'rtdr', 'tred', 'aaa@a.fr', '745413', 'ed02457b5c41d964dbd2f2a609d63fe1bb7528dbe55e1abf5b52c249cd735797'),
(9, 'Bidoudou', 'Lol', 'bidou@fr.fr', '41111', 'eaa2bded32cc585d3f37c5319abe8890ad28a697ed66d5823f10536cc9c0fdb9'),
(10, 'Lalala', 'Lololo', 'lll@l.fr', '48763546', '5f4bd3ec1057f96455b1f3e5fbf707f712ccf93c37a60ed013887d8ed3660b02'),
(11, 'Lafontaine', 'Laurine', 'laurine@l.fr', '01789', 'eaa2bded32cc585d3f37c5319abe8890ad28a697ed66d5823f10536cc9c0fdb9'),
(12, 'Souvant', 'Angélique', 'angelique.souvant@gmail.com', '0659949046', 'b56f34b92977b77bd09c659bc863ba2f997fb1a439627d531a9fd3e3eb3b30bc');

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
CREATE TABLE IF NOT EXISTS `experiences` (
  `id_exp` int(11) NOT NULL AUTO_INCREMENT,
  `experience` varchar(255) NOT NULL,
  `entreprise_exp` varchar(255) NOT NULL,
  `localisation_exp` varchar(255) NOT NULL,
  `mission_exp` varchar(255) NOT NULL,
  `type_competence_exp` varchar(255) NOT NULL,
  `id_CV` int(11) NOT NULL,
  PRIMARY KEY (`id_exp`),
  KEY `CV_exp_fk` (`id_CV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id_formation` int(11) NOT NULL AUTO_INCREMENT,
  `formation` varchar(255) NOT NULL,
  `diplome` varchar(255) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `mention` varchar(2) NOT NULL,
  `etablissement_formation` varchar(255) DEFAULT NULL,
  `ville_formation` varchar(255) DEFAULT NULL,
  `id_CV` int(11) NOT NULL,
  PRIMARY KEY (`id_formation`),
  KEY `CV_forma_fk` (`id_CV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `info_entreprise`
--

DROP TABLE IF EXISTS `info_entreprise`;
CREATE TABLE IF NOT EXISTS `info_entreprise` (
  `nom_entreprise` varchar(64) NOT NULL,
  `ville_entreprise` varchar(64) NOT NULL,
  `cp_entreprise` decimal(5,0) NOT NULL,
  `description_entreprise` text NOT NULL,
  `mail` varchar(64) NOT NULL,
  `id_offre` varchar(255) NOT NULL,
  KEY `appel_offre_fk` (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

DROP TABLE IF EXISTS `langues`;
CREATE TABLE IF NOT EXISTS `langues` (
  `id_langue` int(11) NOT NULL AUTO_INCREMENT,
  `langue` varchar(255) NOT NULL,
  `niveau_lang` varchar(2) NOT NULL,
  `id_CV` int(11) NOT NULL,
  PRIMARY KEY (`id_langue`),
  KEY `CV_lang_fk` (`id_CV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mission_entreprise`
--

DROP TABLE IF EXISTS `mission_entreprise`;
CREATE TABLE IF NOT EXISTS `mission_entreprise` (
  `descprition_mission_entreprise` text NOT NULL,
  `id_offre` int(11) NOT NULL,
  KEY `appel_offre_fk` (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profil_rechercher`
--

DROP TABLE IF EXISTS `profil_rechercher`;
CREATE TABLE IF NOT EXISTS `profil_rechercher` (
  `id_pr` int(11) NOT NULL AUTO_INCREMENT,
  `competence_offre` varchar(255) NOT NULL,
  `nv_etude_offre` varchar(128) NOT NULL,
  `id_offre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pr`),
  KEY `appel_offre_fk` (`id_offre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `centre_interet`
--
ALTER TABLE `centre_interet`
  ADD CONSTRAINT `CV_centre_fk` FOREIGN KEY (`id_CV`) REFERENCES `cv` (`id_CV`);

--
-- Contraintes pour la table `competences`
--
ALTER TABLE `competences`
  ADD CONSTRAINT `CV_comp_fk` FOREIGN KEY (`id_CV`) REFERENCES `cv` (`id_CV`);

--
-- Contraintes pour la table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `etu_fk` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);

--
-- Contraintes pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `CV_exp_fk` FOREIGN KEY (`id_CV`) REFERENCES `cv` (`id_CV`);

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `CV_forma_fk` FOREIGN KEY (`id_CV`) REFERENCES `cv` (`id_CV`);

--
-- Contraintes pour la table `langues`
--
ALTER TABLE `langues`
  ADD CONSTRAINT `CV_lang_fk` FOREIGN KEY (`id_CV`) REFERENCES `cv` (`id_CV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
