-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 13 déc. 2021 à 15:38
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
-- Base de données : `messagerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `Id` int(11) NOT NULL,
  `Date` varchar(10) NOT NULL,
  `Heure` varchar(30) NOT NULL,
  `Auteur` varchar(50) NOT NULL,
  `Message` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`Id`, `Date`, `Heure`, `Auteur`, `Message`) VALUES
(1, '01/04/2020', '22:55:53', 'SERRIERES MANIECKI Mathis', 'Bonjour à tous !'),
(2, '01/04/2020', '22:59:27', 'SERRIERES MANIECKI Mathis', 'Vous allez bien ?'),
(3, '01/04/2020', '22:59:44', 'Rivero Benjamin', 'Oui bonjour bonsoir'),
(4, '01/04/2020', '22:59:52', 'SERRIERES MANIECKI Mathis', 'Incroyable'),
(5, '01/04/2020', '23:00:16', 'Rivero Benjamin', 'C\'est beau la technologie'),
(6, '01/04/2020', '23:00:32', 'SERRIERES MANIECKI Mathis', 'Ouais, c\'est trop bien !'),
(7, '01/04/2020', '23:01:59', 'SERRIERES MANIECKI Mathis', '👌'),
(8, '01/04/2020', '23:02:48', 'lorenzo bassini', ' salut la commu'),
(9, '01/04/2020', '23:03:16', 'SERRIERES MANIECKI Mathis', 'Beaucoup d’interactions dans ce tchat !'),
(10, '01/04/2020', '23:23:34', 'Rivero Benjamin', 'N\'hésitez pas à interagir dans le chat'),
(11, '28/04/2020', '10:54:19', 'WALID YOUNES', 'BONJOUR'),
(12, '28/04/2020', '10:54:22', 'WALID YOUNES', 'CECI EST UN TEST '),
(13, '28/04/2020', '10:54:34', 'WALID YOUNES', 'CA MARCHE '),
(14, '28/04/2020', '10:54:50', 'WALID YOUNES', 'JE TESTE ENCORE'),
(15, '28/04/2020', '10:55:42', 'WALID YOUNES', 'IL Y A PLUS DE 10 MESSAGES AFFICHE'),
(16, '28/04/2020', '10:57:20', 'WALID YOUNES', 'IL FAUT QUE CA FONCTIONNE SANS RAFRAICHIR LA PAGE'),
(17, '14/12/2020', '10:26:05', 'wsh wsh', 'wsh!'),
(18, '15/08/2021', '14:00:34', 'Zerdstone', 'test'),
(19, '24/08/2021', '02:33:14', 'qsd', 'sqd'),
(20, '24/08/2021', '02:33:19', 'qsd', 'fsdfsqf'),
(21, '27/08/2021', '15:49:17', 'test', 'effectivement'),
(22, '11/10/2021', '13:31:20', 'niklass hardbass', 'ok'),
(23, '27/10/2021', '12:55:20', 'Samuel Douay', 'test'),
(24, '27/10/2021', '12:55:36', 'Samuel Douay', 'rzqr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
