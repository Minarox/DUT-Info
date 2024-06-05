-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 13 déc. 2021 à 14:38
-- Version du serveur :  10.3.31-MariaDB-0+deb10u1
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ananke`
--

-- --------------------------------------------------------

--
-- Structure de la table `Adresses`
--

CREATE TABLE `Adresses` (
  `ID` int(11) NOT NULL,
  `ID_Utilisateur` varchar(50) NOT NULL COMMENT 'Adresse mail du client',
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Adresse` text NOT NULL,
  `ComplementAdresse` text DEFAULT NULL,
  `CodePostal` varchar(5) NOT NULL,
  `Ville` varchar(50) NOT NULL,
  `Facturation` tinyint(1) NOT NULL,
  `Livraison` tinyint(1) NOT NULL,
  `Telephone` char(10) DEFAULT NULL,
  `TelephonePortable` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Adresses`
--

INSERT INTO `Adresses` (`ID`, `ID_Utilisateur`, `Nom`, `Prenom`, `Adresse`, `ComplementAdresse`, `CodePostal`, `Ville`, `Facturation`, `Livraison`, `Telephone`, `TelephonePortable`) VALUES
(14, 'davidballard46000@gmail.com', 'dd', 'd', 'd', 'd', '46000', 'd', 0, 0, '', '0614151514'),
(15, 'davidballard46000@gmail.com', 'dd', 'dsgsg', 'sdsdgsdg', 'd', '46000', 'd', 0, 1, '', '0614151514');

-- --------------------------------------------------------

--
-- Structure de la table `Articles`
--

CREATE TABLE `Articles` (
  `ID` int(11) NOT NULL,
  `TITRE` varchar(50) NOT NULL,
  `MARQUE` varchar(50) NOT NULL,
  `MODELE` varchar(50) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `TYPE` varchar(50) NOT NULL,
  `SOUSTYPE` varchar(50) NOT NULL,
  `PRIX` decimal(10,0) NOT NULL,
  `CIBLE` varchar(50) NOT NULL COMMENT 'Catégorie',
  `SOLDES` int(11) NOT NULL DEFAULT 0,
  `DATEAJOUT` datetime NOT NULL DEFAULT current_timestamp(),
  `NBNOTES1` int(11) NOT NULL DEFAULT 0,
  `NBNOTES2` int(11) NOT NULL DEFAULT 0,
  `NBNOTES3` int(11) NOT NULL DEFAULT 0,
  `NBNOTES4` int(11) NOT NULL DEFAULT 0,
  `NBNOTES5` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ArticlesImages`
--

CREATE TABLE `ArticlesImages` (
  `ID` int(11) NOT NULL,
  `ID_Articles` int(11) NOT NULL,
  `Principale` tinyint(1) NOT NULL,
  `Couleurs` varchar(20) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ArticlesParametres`
--

CREATE TABLE `ArticlesParametres` (
  `ID` int(11) NOT NULL,
  `ID_Articles` int(11) NOT NULL,
  `Taille` varchar(5) NOT NULL,
  `Couleurs` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ArticlesUsager`
--

CREATE TABLE `ArticlesUsager` (
  `ID` int(11) NOT NULL,
  `ID_Usager` varchar(50) NOT NULL,
  `ID_Article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `CommentaireArticles`
--

CREATE TABLE `CommentaireArticles` (
  `ID` int(11) NOT NULL,
  `IdentifiantArticle` int(11) NOT NULL,
  `Notes` int(1) NOT NULL,
  `Texte` text NOT NULL,
  `DatePublication` datetime NOT NULL DEFAULT current_timestamp(),
  `IdentifiantClient` text NOT NULL,
  `Auteur` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `CommentaireArticles`
--

INSERT INTO `CommentaireArticles` (`ID`, `IdentifiantArticle`, `Notes`, `Texte`, `DatePublication`, `IdentifiantClient`, `Auteur`) VALUES
(12, 3, 3, 'Très beau nœud papillon !', '2020-06-24 13:29:19', 'fghjkloiuyt@yopmail.com', 'MARIE Pierrick');

-- --------------------------------------------------------

--
-- Structure de la table `Messagerie`
--

CREATE TABLE `Messagerie` (
  `ID` int(11) NOT NULL,
  `Grade` tinyint(1) NOT NULL,
  `Auteur` varchar(60) NOT NULL,
  `Message` text NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Localisation` varchar(60) NOT NULL,
  `CodeTemp` text NOT NULL,
  `Alerte` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Messagerie`
--

INSERT INTO `Messagerie` (`ID`, `Grade`, `Auteur`, `Message`, `Date`, `Localisation`, `CodeTemp`, `Alerte`) VALUES
(200, 2, 'SERRIERES MANIECKI Mathis', 'Bonjour', '2020-06-22 16:06:06', 'Accueil', '2f65c7fee568dc2f2a56023da4d0e7bfb546fa27fd3c2680011cbc3520e760b2eafeae80852f90c147467751a4c20c9da44f8bf9ff5916ec4e5bfc40c857e727', 0),
(201, 2, 'SERRIERES MANIECKI Mathis', 'test', '2020-06-22 21:27:26', 'Mon profil', '4b4f272247cd13fd3846320e3198f7a8471da40b8de896460063340028ff08fb1dcd135fc617d6e4990c99c593b214e8607aa44b9444ec54f9fa4b3e951afa8a', 0),
(202, 2, 'SERRIERES MANIECKI Mathis', 're test', '2020-06-22 21:30:29', 'Mon profil', '4b4f272247cd13fd3846320e3198f7a8471da40b8de896460063340028ff08fb1dcd135fc617d6e4990c99c593b214e8607aa44b9444ec54f9fa4b3e951afa8a', 0),
(203, 2, 'SERRIERES MANIECKI Mathis', 'Bonjour', '2020-06-22 21:39:44', 'Mon profil', '2f65c7fee568dc2f2a56023da4d0e7bfb546fa27fd3c2680011cbc3520e760b2eafeae80852f90c147467751a4c20c9da44f8bf9ff5916ec4e5bfc40c857e727', 0),
(204, 2, 'SERRIERES MANIECKI Mathis', 'Bonsoir', '2020-06-22 21:40:04', 'Mon profil', '4b4f272247cd13fd3846320e3198f7a8471da40b8de896460063340028ff08fb1dcd135fc617d6e4990c99c593b214e8607aa44b9444ec54f9fa4b3e951afa8a', 0);

-- --------------------------------------------------------

--
-- Structure de la table `QuestionArticle`
--

CREATE TABLE `QuestionArticle` (
  `ID` int(11) NOT NULL,
  `IdentifiantArticle` int(11) NOT NULL,
  `Texte` text NOT NULL,
  `DatePublication` datetime NOT NULL DEFAULT current_timestamp(),
  `IdentifiantClient` text NOT NULL,
  `Auteur` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `QuestionArticle`
--

INSERT INTO `QuestionArticle` (`ID`, `IdentifiantArticle`, `Texte`, `DatePublication`, `IdentifiantClient`, `Auteur`) VALUES
(4, 1, 'Je suis un teste de question.', '2020-06-16 16:16:33', 'mathis.sema@gmail.com', 'SERRIERES MANIECKI Mathis'),
(5, 1, 'test 2', '2020-06-16 16:33:05', 'mathis.sema@gmail.com', 'SERRIERES MANIECKI Mathis');

-- --------------------------------------------------------

--
-- Structure de la table `ReponseArticle`
--

CREATE TABLE `ReponseArticle` (
  `ID` int(11) NOT NULL,
  `IdentifiantArticle` int(11) NOT NULL,
  `IdentifiantQuestion` int(11) NOT NULL,
  `Texte` text NOT NULL,
  `DatePublication` datetime NOT NULL DEFAULT current_timestamp(),
  `IdentifiantClient` text NOT NULL,
  `Auteur` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ReponseArticle`
--

INSERT INTO `ReponseArticle` (`ID`, `IdentifiantArticle`, `IdentifiantQuestion`, `Texte`, `DatePublication`, `IdentifiantClient`, `Auteur`) VALUES
(3, 1, 4, 'test', '2020-06-16 17:18:56', 'mathis.sema@gmail.com', 'SERRIERES MANIECKI Mathis');

-- --------------------------------------------------------

--
-- Structure de la table `TypeArticle`
--

CREATE TABLE `TypeArticle` (
  `ID` int(11) NOT NULL,
  `NOMTYPE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `TypeArticle`
--

INSERT INTO `TypeArticle` (`ID`, `NOMTYPE`) VALUES
(1, 'Pantalon'),
(2, 'Chaussures'),
(3, 'SweatShirt'),
(4, 'SweatShirt'),
(5, 'Pull'),
(6, 'Veste'),
(7, 'TeeShirt'),
(8, 'Survetementdesport'),
(9, 'shorts'),
(10, 'sousvetements'),
(11, 'chemise');

-- --------------------------------------------------------

--
-- Structure de la table `Usager`
--

CREATE TABLE `Usager` (
  `Identifiant` varchar(50) NOT NULL COMMENT 'Adresse mail pour usager et code pour employé',
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `MotDePasse` text NOT NULL,
  `Verification` char(1) NOT NULL,
  `Grade` char(1) NOT NULL,
  `cle` text DEFAULT NULL,
  `clemdp` text DEFAULT NULL,
  `clemail` text DEFAULT NULL,
  `Image` text DEFAULT '../../../images/avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Usager`
--

INSERT INTO `Usager` (`Identifiant`, `Nom`, `Prenom`, `MotDePasse`, `Verification`, `Grade`, `cle`, `clemdp`, `clemail`, `Image`) VALUES
('', '', '', '$2y$10$lN8WNqRVpff5QhX08/XHneru0xtumDICEKfP3Dyn2U4cdkeNrsv5a', '0', '0', 'a32eec1443a3b2fc3852080c5fcdfc05', NULL, NULL, '../../../images/avatar.png'),
('contact@minarox.fr', 'SERRIERES MANIECKI', 'Jérémy', '$2y$10$0xzqg9mG6qbdFOVeOjvCmufAYj1ooV/ZmQhZ.FIKKY1nTnussfFIG', '1', '1', '4532faf67d77cffc593bf5c77d2a65f0', NULL, NULL, '../../../images/avatar.png'),
('davidballard46000@gmail.com', 'gfd', 'Balldfdfd', '$2y$10$rY7rq8T2BBExuNH1GokW/u8mz5GwKs3tQtYJWH9YALt24SySRkwKG', '1', '0', 'df4bb6bf6b8becada40e4f819b018461a40f892dc3a25c88b1227f67023bf44e797e3319a9ca7969b973a9a15b98bac6bb25e82d94c59b65cae148dcf7ab7178', 'c6c9efbaf4dd150104400b34ee9895d7', NULL, '../../../images/IMG-20200620-134200.jpg.png'),
('fghjkloiuyt@yopmail.com', 'MARIE', 'Pierrick', '$2y$10$WoQIsCmIqONpfu1L8ql75eAmSaOfMLhoVfrajblmD3dBoQ28Xy2Vu', '1', '0', 'c65531c18348e47924828484ef45c163acc90a1cb470503bddc77a11e1f817851ef770644a93d487a12b7550769fe618a74c62f0700ff532857eae6f158cc5c7', NULL, NULL, '../../../images/avatar.png'),
('livinustagne@gmail.com', 'Tagne', 'Livinus', '$2y$10$DouXnvn4Nm1hkDp8ek7Pp.ZUcc9.HO6v4Yxmq5tPTwWvcvy3Fg8v.', '0', '0', '1d7f416d95e2b0706340b96bd9046f70', NULL, NULL, '../../../images/avatar.png'),
('mathis.sema@gmail.com', 'SERRIERES MANIECKI', 'Mathis', '$2y$10$csfRxPyETpachnZvqIDkm.zhPHwuF0HfJRGISQDpE5ZMzJ4H7x7xa', '1', '2', NULL, NULL, NULL, '../../../images/Logo.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `villes_france_free`
--

CREATE TABLE `villes_france_free` (
  `ville_id` mediumint(8) UNSIGNED NOT NULL,
  `ville_nom` varchar(45) DEFAULT NULL,
  `ville_nom_simple` varchar(45) DEFAULT NULL,
  `ville_nom_reel` varchar(45) DEFAULT NULL,
  `ville_code_postal` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Adresses`
--
ALTER TABLE `Adresses`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ArticlesImages`
--
ALTER TABLE `ArticlesImages`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ArticlesParametres`
--
ALTER TABLE `ArticlesParametres`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ArticlesUsager`
--
ALTER TABLE `ArticlesUsager`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `CommentaireArticles`
--
ALTER TABLE `CommentaireArticles`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Messagerie`
--
ALTER TABLE `Messagerie`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `QuestionArticle`
--
ALTER TABLE `QuestionArticle`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ReponseArticle`
--
ALTER TABLE `ReponseArticle`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `TypeArticle`
--
ALTER TABLE `TypeArticle`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Usager`
--
ALTER TABLE `Usager`
  ADD PRIMARY KEY (`Identifiant`);

--
-- Index pour la table `villes_france_free`
--
ALTER TABLE `villes_france_free`
  ADD PRIMARY KEY (`ville_id`),
  ADD KEY `ville_nom` (`ville_nom`),
  ADD KEY `ville_nom_reel` (`ville_nom_reel`),
  ADD KEY `ville_code_postal` (`ville_code_postal`),
  ADD KEY `ville_nom_simple` (`ville_nom_simple`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Adresses`
--
ALTER TABLE `Adresses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `Articles`
--
ALTER TABLE `Articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ArticlesImages`
--
ALTER TABLE `ArticlesImages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `ArticlesParametres`
--
ALTER TABLE `ArticlesParametres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ArticlesUsager`
--
ALTER TABLE `ArticlesUsager`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `CommentaireArticles`
--
ALTER TABLE `CommentaireArticles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `Messagerie`
--
ALTER TABLE `Messagerie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT pour la table `QuestionArticle`
--
ALTER TABLE `QuestionArticle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ReponseArticle`
--
ALTER TABLE `ReponseArticle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `TypeArticle`
--
ALTER TABLE `TypeArticle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `villes_france_free`
--
ALTER TABLE `villes_france_free`
  MODIFY `ville_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36831;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
