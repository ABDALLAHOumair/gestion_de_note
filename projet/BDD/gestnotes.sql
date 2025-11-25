-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 03 nov. 2025 à 05:06
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestnotes`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `Id` int(11) NOT NULL,
  `Nom_Classe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`Id`, `Nom_Classe`) VALUES
(1, 'SIO1'),
(2, 'SIO2'),
(3, 'SIO1 A'),
(4, 'SIO1 A'),
(5, 'SIO B');

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Id_Classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`Id`, `Nom`, `Prenom`, `Id_Classe`) VALUES
(1, 'SAINDOU', 'Djanfar', 2),
(2, 'FAYADHUI', 'Nassur', 2),
(3, 'ABDALLAH', 'Oumaïr', 2),
(4, 'AHMED', 'Said', 2),
(5, 'MAHAVITENY', 'Azaly', 2);

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `Id` int(11) NOT NULL,
  `Nom_Matiere` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`Id`, `Nom_Matiere`) VALUES
(1, 'CEJM'),
(2, 'CYBERSECURITE'),
(3, 'FRANCAIS'),
(4, 'ANGLAIS');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL,
  `Note` float NOT NULL,
  `Date` date NOT NULL,
  `Id_Eleve` int(11) NOT NULL,
  `Id_Matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`Id`, `Note`, `Date`, `Id_Eleve`, `Id_Matiere`) VALUES
(1, 10, '2025-02-10', 1, 1),
(2, 5, '2025-05-13', 1, 2),
(3, 15, '2025-06-09', 1, 3),
(4, 15, '2025-12-09', 1, 4),
(5, 12, '2025-02-12', 2, 1),
(6, 8, '2025-05-14', 2, 2),
(7, 13, '2025-06-10', 2, 3),
(8, 14, '2025-12-11', 2, 4),
(9, 9, '2025-02-15', 3, 1),
(10, 11, '2025-06-16', 3, 2),
(11, 14, '2025-06-12', 3, 3),
(12, 10, '2025-12-17', 3, 4),
(13, 15, '2026-02-18', 4, 1),
(14, 12, '2025-10-21', 4, 2),
(15, 16, '2025-12-12', 4, 3),
(16, 13, '2025-08-12', 4, 4),
(17, 11, '2025-07-21', 5, 1),
(18, 7, '2025-08-11', 5, 2),
(19, 12, '2025-09-16', 5, 3),
(20, 14, '2025-09-12', 5, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Eleve_classe` (`Id_Classe`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Note_eleves` (`Id_Eleve`),
  ADD KEY `Note_matieres` (`Id_Matiere`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `Eleve_classe` FOREIGN KEY (`Id_Classe`) REFERENCES `classes` (`Id`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `Note_eleves` FOREIGN KEY (`Id_Eleve`) REFERENCES `eleves` (`Id`),
  ADD CONSTRAINT `Note_matieres` FOREIGN KEY (`Id_Matiere`) REFERENCES `matieres` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
