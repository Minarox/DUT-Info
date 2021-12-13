-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 13 déc. 2021 à 15:24
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
-- Base de données : `cabinet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Authentification`
--

CREATE TABLE `Authentification` (
  `Pseudo` varchar(10) NOT NULL,
  `Mdp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Authentification`
--

INSERT INTO `Authentification` (`Pseudo`, `Mdp`) VALUES
('Secretaire', 'MotDePasse');

-- --------------------------------------------------------

--
-- Structure de la table `Medecin`
--

CREATE TABLE `Medecin` (
  `ID` int(11) NOT NULL,
  `Civilite` varchar(3) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Medecin`
--

INSERT INTO `Medecin` (`ID`, `Civilite`, `Nom`, `Prenom`) VALUES
(4, 'Mr', 'Balkany', 'Patrick'),
(8, 'MMe', 'Isabelle', 'Isabelle'),
(15, 'Mr', 'sdds', 'tsdtezt');

-- --------------------------------------------------------

--
-- Structure de la table `RendezVous`
--

CREATE TABLE `RendezVous` (
  `Date_RDV` date NOT NULL,
  `Heure` time NOT NULL,
  `Id_Usager` int(11) NOT NULL,
  `Id_Medecin` varchar(50) NOT NULL,
  `Duree` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `RendezVous`
--

INSERT INTO `RendezVous` (`Date_RDV`, `Heure`, `Id_Usager`, `Id_Medecin`, `Duree`) VALUES
('2020-01-11', '15:55:00', 34, '4', 30),
('2020-01-17', '15:40:00', 35, '4', 30),
('2020-01-18', '15:55:00', 34, '8', 30),
('2020-01-20', '12:00:00', 34, '4', 30),
('2020-01-20', '12:20:00', 39, '4', 30),
('2020-01-21', '12:30:00', 34, '4', 30);

-- --------------------------------------------------------

--
-- Structure de la table `Usager`
--

CREATE TABLE `Usager` (
  `Id_Usager` int(11) NOT NULL,
  `Civilite` varchar(3) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Date_Naissance` date DEFAULT NULL,
  `Adresse` varchar(50) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `Code_Postal` varchar(5) DEFAULT NULL,
  `Lieu_Naissance` varchar(50) DEFAULT NULL,
  `Num_Securite_Sociale` bigint(11) DEFAULT NULL,
  `Medecin_T` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Usager`
--

INSERT INTO `Usager` (`Id_Usager`, `Civilite`, `Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Ville`, `Code_Postal`, `Lieu_Naissance`, `Num_Securite_Sociale`, `Medecin_T`) VALUES
(34, 'Mr', 'Benalla', 'Alexandre', '1991-09-08', 'Dans un bel appartement', 'Paris', '75000', 'Evreux', 45887587895, 4),
(35, 'MMe', 'LeCrayon', 'Marine', '1968-08-05', 'EnFrance', 'Paris', '75003', 'Neuilly-sur-Seine', 55555555555, NULL),
(38, 'Mr', 'sdfg', 'sdfg', '2020-01-06', 'sdfg', 'sdfg', '31320', 'sdfg', 11111111111, NULL),
(39, 'Mr', 'Emmanuel', 'Marron', '1977-12-21', 'LaBanque', 'Paris', '75006', 'Amienssdfgsdfg', 45875687584, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Authentification`
--
ALTER TABLE `Authentification`
  ADD PRIMARY KEY (`Pseudo`,`Mdp`);

--
-- Index pour la table `Medecin`
--
ALTER TABLE `Medecin`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `RendezVous`
--
ALTER TABLE `RendezVous`
  ADD PRIMARY KEY (`Date_RDV`,`Heure`,`Id_Usager`,`Id_Medecin`),
  ADD KEY `FK_Usager` (`Id_Usager`),
  ADD KEY `FK_Medecin` (`Id_Medecin`) USING BTREE;

--
-- Index pour la table `Usager`
--
ALTER TABLE `Usager`
  ADD PRIMARY KEY (`Id_Usager`),
  ADD KEY `fk_id_medecin` (`Medecin_T`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Medecin`
--
ALTER TABLE `Medecin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `Usager`
--
ALTER TABLE `Usager`
  MODIFY `Id_Usager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
