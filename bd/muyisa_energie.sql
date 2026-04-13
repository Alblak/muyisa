-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 avr. 2026 à 15:36
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `muyisa_energie`
--

-- --------------------------------------------------------

--
-- Structure de la table `bondesortie`
--

CREATE TABLE `bondesortie` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `libelle` text NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bondesortie`
--

INSERT INTO `bondesortie` (`id`, `dates`, `libelle`, `montant`, `supprimer`) VALUES
(1, '2025-05-13', 'achat materiel', 150, 0),
(2, '2025-05-13', 'frais de transport', 200, 1),
(3, '2025-05-13', 'payement logiciel', 88, 0),
(4, '2025-08-27', 'EMPRUNT cfr MOISE', 10, 0),
(5, '2026-01-12', 'nnnnnnnnn', 766, 0);

-- --------------------------------------------------------

--
-- Structure de la table `camion`
--

CREATE TABLE `camion` (
  `id` int(11) NOT NULL,
  `plaque` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `camion`
--

INSERT INTO `camion` (`id`, `plaque`, `supprimer`) VALUES
(1, 'RDC0666', 0),
(2, 'UG01944', 1),
(3, 'RDC0990', 0),
(4, 'SSD162A', 0),
(5, 'KKKKKKKKK', 1);

-- --------------------------------------------------------

--
-- Structure de la table `chargement`
--

CREATE TABLE `chargement` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `camion` int(11) NOT NULL,
  `commande` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chargement`
--

INSERT INTO `chargement` (`id`, `dates`, `camion`, `commande`, `supprimer`) VALUES
(2, '2025-06-05', 1, 14, 1),
(3, '2025-06-05', 1, 14, 0),
(4, '2025-06-27', 1, 15, 0),
(5, '2025-08-27', 3, 16, 0),
(6, '2025-08-27', 1, 17, 0),
(7, '2025-08-27', 4, 18, 0),
(8, '2025-08-27', 4, 19, 0),
(9, '2025-12-19', 1, 22, 1),
(10, '2025-12-19', 1, 22, 0);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `numero` varchar(50) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `photo` text NOT NULL,
  `genre` varchar(2) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`numero`, `nom`, `postnom`, `prenom`, `photo`, `genre`, `telephone`, `supprimer`) VALUES
('ME0001', 'kambale ', 'kilima', 'julien', '1745405356.jpg', 'M', '0977139499', 0),
('ME0002', 'kambale ', 'kamala', 'albert', '1745403341.jpg', 'M', '0971402590', 0),
('ME0003', 'kam', 'kok', 'kkk', '1745405631.jpg', 'F', '0977139490', 1),
('ME0004', 'kamla', 'lll', 'lll', '1745405932.jpg', 'F', '0977139490', 1),
('ME0005', 'kambale', 'kasika', 'joseph', '1747818765.jpg', 'M', '0991147629', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `client` text NOT NULL,
  `type` int(11) NOT NULL,
  `numfacture` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `dates`, `client`, `type`, `numfacture`, `statut`, `supprimer`) VALUES
(2, '2025-07-16', 'ME0001', 2, 1, 1, 0),
(4, '2025-07-16', 'kasereka', 1, 2, 1, 0),
(5, '2025-08-27', 'kaka', 1, 3, 1, 0),
(6, '2025-08-27', 'HAPPY', 1, 4, 1, 0),
(7, '2025-10-23', 'lydia', 1, 5, 1, 0),
(11, '2025-12-15', 'kambale', 1, 6, 1, 0),
(14, '2025-12-15', 'jjjjjjjjj', 1, 9, 1, 0),
(15, '2025-12-15', 'kasdfg', 1, 10, 1, 0),
(16, '2025-12-15', 'hhh', 1, 11, 1, 0),
(17, '2025-12-15', 'kkkkkkkkk', 1, 12, 0, 0),
(21, '2025-12-18', 'jjkkkkkk', 1, 14, 0, 0),
(22, '2025-12-18', 'jkkkkkkkkkk', 1, 15, 0, 0),
(23, '2025-12-18', 'hjjj', 1, 16, 1, 0),
(24, '2025-12-18', '243', 1, 17, 0, 0),
(25, '2025-12-29', 'AL', 1, 18, 1, 0),
(28, '2026-01-27', 'kkkkkkkkkkk', 1, 19, 1, 0),
(29, '2026-01-27', 'jjjjjjjjjj', 1, 20, 1, 0),
(30, '2026-02-10', 'ME0002', 2, 21, 1, 0),
(31, '2026-02-11', 'ME0001', 2, 22, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande_ap`
--

CREATE TABLE `commande_ap` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `fournisseur` int(11) NOT NULL,
  `numcommande` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_ap`
--

INSERT INTO `commande_ap` (`id`, `dates`, `fournisseur`, `numcommande`, `supprimer`) VALUES
(14, '2025-06-05', 1, 14, 0),
(15, '2025-06-27', 1, 15, 0),
(16, '2025-08-27', 1, 16, 0),
(17, '2025-08-27', 1, 17, 0),
(18, '2025-08-27', 1, 18, 0),
(19, '2025-08-27', 1, 19, 0),
(22, '2025-12-19', 3, 20, 0);

-- --------------------------------------------------------

--
-- Structure de la table `declarant`
--

CREATE TABLE `declarant` (
  `numero` varchar(20) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `genre` varchar(2) NOT NULL,
  `telephone` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `declarant`
--

INSERT INTO `declarant` (`numero`, `nom`, `postnom`, `prenom`, `genre`, `telephone`, `supprimer`) VALUES
('DE0001', 'kambale', 'kamala', 'albert', 'M', '0977139499', 0),
('DE0002', 'kkkkk', 'kkkkk', 'kkkkkk', 'F', '0971402590', 1),
('DE0003', 'jjjjjjjjjjJ', 'JJJJ', 'JJJJOO', 'F', '0977138488', 1);

-- --------------------------------------------------------

--
-- Structure de la table `declarer`
--

CREATE TABLE `declarer` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `chargement` int(11) NOT NULL,
  `declarant` varchar(20) NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `declarer`
--

INSERT INTO `declarer` (`id`, `dates`, `chargement`, `declarant`, `montant`, `supprimer`) VALUES
(2, '2025-06-05', 3, 'DE0001', 9000, 1),
(3, '2025-06-05', 3, 'DE0001', 9000, 0),
(4, '2025-06-27', 4, 'DE0001', 12000, 0),
(5, '2025-08-27', 5, 'DE0001', 10000, 0),
(6, '2025-08-27', 6, 'DE0001', 4000, 0),
(7, '2025-08-27', 7, 'DE0001', 6000, 0),
(8, '2025-12-19', 8, 'DE0001', 90000, 0),
(9, '2025-12-19', 10, 'DE0001', 90000, 1),
(10, '2025-12-19', 10, 'DE0001', 99999, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE `entree` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `type` text NOT NULL,
  `reste_argent` double NOT NULL,
  `PR` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entree`
--

INSERT INTO `entree` (`id`, `dates`, `commande`, `quantite`, `type`, `reste_argent`, `PR`, `supprimer`) VALUES
(1, '2025-07-07', 15, 60000, 'essence', 0, 2.2, 0),
(2, '2025-07-16', 14, 39000, 'mazout', 3400, 3.631, 0),
(3, '2025-08-27', 16, 38000, 'essence', 2000, 0.6315, 0),
(4, '2025-08-27', 17, 29000, 'mazout', 1000, 0.569, 0),
(5, '2025-08-27', 18, 40000, 'essence', 0, 0.525, 0),
(6, '2025-08-27', 19, 18000, 'essence', 2000, 0.5, 0),
(8, '2025-12-19', 22, 12000, 'mazout', 0, 0.0005, 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `adresse` text NOT NULL,
  `telephone` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `postnom`, `prenom`, `adresse`, `telephone`, `supprimer`) VALUES
(1, 'kiro', 'mwenge', 'laur', 'beni', '0971402590', 0),
(2, 'mmmmmmm', 'mjjj', 'jjjj', 'jjjj', 'oooooooooo', 1),
(3, 'kambale', 'kamala', 'albert', 'malera', '0977139499', 0),
(4, 'kamMM', 'mmm', 'mm', 'kkkkk', '0977139499', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `id` int(11) NOT NULL,
  `mois` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`id`, `mois`) VALUES
(1, 'janvier'),
(2, 'fevrier'),
(3, 'mars'),
(4, 'avril'),
(5, 'mai'),
(6, 'juin'),
(7, 'juillet'),
(8, 'Aout'),
(9, 'septembre'),
(10, 'octobre'),
(11, 'novembre'),
(12, 'decembre');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `mouvements_caisse_raw`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `mouvements_caisse_raw` (
`date_mouvement` date
,`source` varchar(14)
,`description` mediumtext
,`entree` double(19,2)
,`sortie` double(19,2)
,`ref_id` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `mouvements_caisse_with_solde`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `mouvements_caisse_with_solde` (
`date_mouvement` date
,`source` varchar(14)
,`description` mediumtext
,`entree` double(19,2)
,`sortie` double(19,2)
,`solde` double(19,2)
);

-- --------------------------------------------------------

--
-- Structure de la table `nonlivrer`
--

CREATE TABLE `nonlivrer` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite_essence` double NOT NULL,
  `quantite_mazout` double NOT NULL,
  `statut` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nonlivrer`
--

INSERT INTO `nonlivrer` (`id`, `dates`, `commande`, `quantite_essence`, `quantite_mazout`, `statut`, `supprimer`) VALUES
(1, '2025-05-16', 32, 27, 14, 1, 0),
(2, '2025-05-17', 33, 0, 70, 0, 0),
(3, '2025-05-21', 34, 14, 7, 1, 0),
(4, '2025-05-21', 35, 0, 5, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paiment_declaration`
--

CREATE TABLE `paiment_declaration` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `declaration` int(11) NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiment_declaration`
--

INSERT INTO `paiment_declaration` (`id`, `dates`, `declaration`, `montant`, `supprimer`) VALUES
(1, '2025-06-20', 3, 1000, 0),
(2, '2025-06-20', 3, 1000, 0),
(3, '2025-06-20', 3, 500, 0),
(4, '2025-06-20', 3, 1500, 0),
(5, '2025-06-20', 3, 2000, 0),
(6, '2025-06-20', 3, 3000, 0),
(7, '2025-06-27', 4, 2000, 0),
(8, '2025-06-29', 4, 1500, 0),
(9, '2025-06-29', 4, 500, 0),
(10, '2025-08-27', 5, 2000, 0),
(11, '2025-08-27', 5, 4000, 0),
(12, '2025-08-27', 5, 4000, 0),
(13, '2025-08-27', 6, 1000, 0),
(14, '2025-08-27', 6, 20, 0),
(15, '2025-08-27', 6, 80, 0),
(16, '2025-08-27', 6, 2900, 0),
(17, '2025-08-27', 7, 6000, 0),
(18, '2025-12-19', 8, 1200, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paiment_dette`
--

CREATE TABLE `paiment_dette` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `commande` int(11) NOT NULL,
  `montant` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiment_dette`
--

INSERT INTO `paiment_dette` (`id`, `dates`, `commande`, `montant`, `supprimer`) VALUES
(1, '2025-05-14', 9, 23, 0),
(2, '2025-05-14', 9, 20000, 0),
(3, '2025-05-14', 9, 254477, 0),
(4, '2025-05-14', 12, 500, 0),
(5, '2025-05-14', 19, 336000, 0),
(6, '2025-05-15', 8, 1000, 0),
(7, '2025-05-15', 22, 200, 0),
(8, '2025-05-17', 27, 500, 0),
(9, '2025-05-21', 26, 170, 0),
(10, '2025-05-21', 26, 30, 0),
(11, '2025-05-21', 32, 720, 0),
(12, '2025-05-22', 8, 500, 0),
(13, '2026-02-16', 2, 400, 0);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `commande` int(11) NOT NULL,
  `type` text NOT NULL,
  `type_achat` text NOT NULL,
  `quantite` double NOT NULL,
  `prixunitaire` double NOT NULL,
  `PR` double NOT NULL,
  `entree` int(11) NOT NULL,
  `resultat` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `commande`, `type`, `type_achat`, `quantite`, `prixunitaire`, `PR`, `entree`, `resultat`, `supprimer`) VALUES
(1, 2, 'essence', 'litre', 1, 2.4, 2.2, 1, 0.2, 0),
(4, 2, 'essence', 'fut', 1, 500, 2.2, 1, 44.6, 0),
(5, 4, 'essence', 'litre', 2, 2.4, 2.2, 1, 0.4, 0),
(6, 5, 'essence', 'litre', 5, 2.4, 2.2, 1, 1, 0),
(7, 5, 'mazout', 'litre', 5, 4.001, 3.631, 2, 1.85, 0),
(8, 6, 'essence', 'litre', 3000, 2.4, 2.2, 1, 600, 0),
(9, 7, 'essence', 'litre', 700, 1, 0.5, 6, 350, 0),
(11, 11, 'mazout', 'fut', 4, 300, 0.569, 4, 728.868, 0),
(12, 11, 'mazout', 'litre', 21, 1, 0.569, 4, 9.051, 0),
(13, 14, 'essence', 'fut', 1, 200, 0.5, 6, 96.5, 0),
(14, 15, 'essence', 'fut', 1, 200, 0.5, 6, 96.5, 0),
(15, 16, 'essence', 'litre', 1, 1, 0.5, 6, 0.5, 0),
(16, 17, 'mazout', 'fut', 1, 300, 0.569, 4, 182.217, 0),
(18, 20, 'mazout', 'fut', 4, 300, 0.569, 4, 728.868, 0),
(19, 21, 'essence', 'litre', 1, 1, 0.5, 6, 0.5, 0),
(20, 22, 'essence', 'litre', 5, 1, 0.5, 6, 2.5, 0),
(21, 23, 'essence', 'fut', 1, 200, 0.5, 6, 96.5, 0),
(22, 24, 'essence', 'fut', 2, 200, 0.5, 6, 193, 0),
(23, 25, 'essence', 'litre', 1, 1, 0.5, 6, 0.5, 0),
(24, 28, 'essence', 'litre', 23, 0.75, 0.5, 6, 5.75, 0),
(25, 29, 'mazout', 'litre', 1, 0.5, 0.0005, 8, 0.4995, 0),
(26, 30, 'essence', 'litre', 1, 1, 0.5, 6, 0.5, 0),
(27, 30, 'essence', 'fut', 1, 0.5, 0.5, 6, -103, 0),
(28, 30, 'mazout', 'litre', 1, 1.5, 0.0005, 8, 1.4995, 0),
(29, 30, 'mazout', 'fut', 1, 1, 0.0005, 8, 0.8965, 0),
(30, 31, 'essence', 'litre', 1, 1, 0.5, 6, 0.5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `panier_ap`
--

CREATE TABLE `panier_ap` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `commande` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `prixunitaire` double NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier_ap`
--

INSERT INTO `panier_ap` (`id`, `type`, `commande`, `quantite`, `prixunitaire`, `supprimer`) VALUES
(16, 'mazout', 14, 40, 3400, 0),
(17, 'essence', 15, 60, 2000, 0),
(18, 'essence', 16, 40, 1000, 0),
(19, 'mazout', 17, 30, 1000, 0),
(20, 'essence', 18, 40, 900, 0),
(21, 'essence', 19, 20, 1000, 0),
(24, 'mazout', 22, 12, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `matricule` varchar(15) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `photo` text NOT NULL,
  `genre` varchar(1) NOT NULL,
  `telephone` text NOT NULL,
  `fonction` text NOT NULL,
  `salaire` double NOT NULL,
  `date_embauche` date NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`matricule`, `nom`, `postnom`, `prenom`, `photo`, `genre`, `telephone`, `fonction`, `salaire`, `date_embauche`, `supprimer`) VALUES
('AG-0001', 'kambale', 'kamala', 'albert', '1746983396.jpg', 'M', '0977139499', 'gerant', 200, '2025-05-11', 0),
('AG-0002', 'kambale', 'Kilima', 'julien', '1747049990.jpg', 'M', '0977134499', 'comptable', 150, '2025-05-12', 0),
('AG-0003', 'kkkkk', 'kkkk', 'kkkk', '1768230734.jpg', 'F', '0977122345', 'magon', 23, '2026-01-12', 1);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `type` text NOT NULL,
  `prix_detail` double NOT NULL,
  `prix_gros` double NOT NULL,
  `entree` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `dates`, `type`, `prix_detail`, `prix_gros`, `entree`, `supprimer`) VALUES
(7, '2025-07-16', 'essence', 2.4, 500, 1, 0),
(8, '2025-07-17', 'mazout', 4.001, 810.007, 2, 0),
(18, '2025-09-08', 'essence', 1.6, 200, 3, 0),
(19, '2025-09-08', 'essence', 1, 200, 5, 0),
(20, '2025-09-08', 'essence', 1, 200, 6, 0),
(21, '2025-09-08', 'mazout', 1, 300, 4, 0),
(22, '2026-01-14', 'mazout', 0.5, 170, 8, 0),
(23, '2026-01-14', 'essence', 0.75, 200, 6, 0),
(24, '2026-02-10', 'essence', 1, 0.5, 6, 0),
(25, '2026-02-10', 'mazout', 1.5, 1, 8, 0);

-- --------------------------------------------------------

--
-- Structure de la table `remuneration`
--

CREATE TABLE `remuneration` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `personnel` text NOT NULL,
  `montant` double NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` year(4) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `remuneration`
--

INSERT INTO `remuneration` (`id`, `dates`, `personnel`, `montant`, `mois`, `annee`, `supprimer`) VALUES
(1, '2025-05-12', 'AG-0001', 40, 1, '2025', 0),
(2, '2025-05-12', 'AG-0001', 150, 1, '2025', 0),
(3, '2025-05-12', 'AG-0001', 8, 1, '2025', 0),
(4, '2025-05-12', 'AG-0001', 2, 1, '2025', 0),
(5, '2025-05-12', 'AG-0002', 150, 1, '2025', 0),
(6, '2025-05-12', 'AG-0002', 150, 2, '2025', 0),
(7, '2025-05-12', 'AG-0002', 150, 3, '2025', 0),
(8, '2025-05-12', 'AG-0002', 150, 4, '2025', 0),
(9, '2025-05-12', 'AG-0002', 50, 5, '2025', 0),
(11, '2025-05-12', 'AG-0001', 200, 2, '2025', 0),
(12, '2025-05-12', 'AG-0001', 100, 3, '2025', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `quantite` int(11) NOT NULL,
  `type` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taux`
--

CREATE TABLE `taux` (
  `id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `equivalent` int(11) NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `taux`
--

INSERT INTO `taux` (`id`, `dates`, `equivalent`, `supprimer`) VALUES
(1, '2025-04-22', 2850, 0),
(2, '2025-04-22', 2000, 0),
(3, '2025-04-22', 2900, 0),
(4, '2025-04-22', 2908, 0),
(5, '2025-04-22', 2900, 0),
(6, '2025-04-28', 2850, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `postnom` text NOT NULL,
  `prenom` text NOT NULL,
  `fonction` text NOT NULL,
  `photo` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `supprimer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `postnom`, `prenom`, `fonction`, `photo`, `username`, `password`, `supprimer`) VALUES
(1, 'kambale', 'kiLIM', 'julien', 'caissiere', '1745823599.jpg', 'julienkiLIM.@me.drc', '0101', 0),
(2, 'kmk', 'kkk', 'klkk', 'admin', 'sscru3.webp', 'klkkkkk.@me.drc', '8898', 0),
(3, 'kambale', 'kamala', 'albert', 'gerant', '1745404332.jpg', 'albertkamala.@me.drc', '0101', 0),
(4, 'muhindo', 'kombi', 'jospin', 'comptable', '1747163126.jpg', 'jospinkombi.@me.drc', '0101', 0),
(5, 'nbhbhbJ', 'JJJH', 'jjjjjjj', 'caissiere', '1769087524.jpg', 'jjjjjjjJJJH.@me.drc', 'jjnjjjn', 0);

-- --------------------------------------------------------

--
-- Structure de la vue `mouvements_caisse_raw`
--
DROP TABLE IF EXISTS `mouvements_caisse_raw`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mouvements_caisse_raw`  AS SELECT `t`.`date_mouvement` AS `date_mouvement`, `t`.`source` AS `source`, group_concat(distinct `t`.`description` order by `t`.`description` ASC separator '; ') AS `description`, round(sum(`t`.`entree`),2) AS `entree`, round(sum(`t`.`sortie`),2) AS `sortie`, min(`t`.`ref_id`) AS `ref_id` FROM (select `e`.`dates` AS `date_mouvement`,concat('Approvisionnement (reste) #',`e`.`id`) AS `description`,coalesce(`e`.`reste_argent`,0) AS `entree`,0.0 AS `sortie`,'entree' AS `source`,`e`.`id` AS `ref_id` from `entree` `e` where `e`.`supprimer` = 0 union all select `c`.`dates` AS `date_mouvement`,concat('Vente #',`c`.`id`) AS `description`,coalesce(sum(`p`.`prixunitaire` * `p`.`quantite`),0) AS `entree`,0.0 AS `sortie`,'vente' AS `source`,`c`.`id` AS `ref_id` from (`commande` `c` join `panier` `p` on(`p`.`commande` = `c`.`id`)) where `c`.`type` = 1 and `c`.`supprimer` = 0 group by `c`.`id`,`c`.`dates` union all select `pd`.`dates` AS `date_mouvement`,concat('Paiement dette #',`pd`.`id`) AS `description`,coalesce(`pd`.`montant`,0) AS `entree`,0.0 AS `sortie`,'paiement_dette' AS `source`,`pd`.`id` AS `ref_id` from `paiment_dette` `pd` where `pd`.`supprimer` = 0 union all select `r`.`dates` AS `date_mouvement`,concat('Rémunération - ',coalesce(`r`.`personnel`,'')) AS `description`,0.0 AS `entree`,coalesce(`r`.`montant`,0) AS `sortie`,'remuneration' AS `source`,`r`.`id` AS `ref_id` from `remuneration` `r` where `r`.`supprimer` = 0 union all select `b`.`dates` AS `date_mouvement`,concat('Bon de sortie - ',coalesce(`b`.`libelle`,'')) AS `description`,0.0 AS `entree`,coalesce(`b`.`montant`,0) AS `sortie`,'bondesortie' AS `source`,`b`.`id` AS `ref_id` from `bondesortie` `b` where `b`.`supprimer` = 0 union all select `ca`.`dates` AS `date_mouvement`,concat('Approvisionnement #',`ca`.`id`) AS `description`,0.0 AS `entree`,coalesce(sum(`pa`.`prixunitaire` * `pa`.`quantite`),0) AS `sortie`,'appro' AS `source`,`ca`.`id` AS `ref_id` from (`commande_ap` `ca` join `panier_ap` `pa` on(`pa`.`commande` = `ca`.`id`)) where `ca`.`supprimer` = 0 group by `ca`.`id`,`ca`.`dates`) AS `t` GROUP BY `t`.`date_mouvement`, `t`.`source` ;

-- --------------------------------------------------------

--
-- Structure de la vue `mouvements_caisse_with_solde`
--
DROP TABLE IF EXISTS `mouvements_caisse_with_solde`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mouvements_caisse_with_solde`  AS SELECT `mouvements_caisse_raw`.`date_mouvement` AS `date_mouvement`, `mouvements_caisse_raw`.`source` AS `source`, `mouvements_caisse_raw`.`description` AS `description`, `mouvements_caisse_raw`.`entree` AS `entree`, `mouvements_caisse_raw`.`sortie` AS `sortie`, round(sum(`mouvements_caisse_raw`.`entree` - `mouvements_caisse_raw`.`sortie`) over ( order by `mouvements_caisse_raw`.`date_mouvement`,`mouvements_caisse_raw`.`source`,`mouvements_caisse_raw`.`ref_id` rows between  unbounded  preceding and  current row ),2) AS `solde` FROM `mouvements_caisse_raw` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bondesortie`
--
ALTER TABLE `bondesortie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chargement`
--
ALTER TABLE `chargement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande_ap`
--
ALTER TABLE `commande_ap`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `declarant`
--
ALTER TABLE `declarant`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `declarer`
--
ALTER TABLE `declarer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entree`
--
ALTER TABLE `entree`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nonlivrer`
--
ALTER TABLE `nonlivrer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiment_declaration`
--
ALTER TABLE `paiment_declaration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiment_dette`
--
ALTER TABLE `paiment_dette`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier_ap`
--
ALTER TABLE `panier_ap`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`matricule`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `remuneration`
--
ALTER TABLE `remuneration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taux`
--
ALTER TABLE `taux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bondesortie`
--
ALTER TABLE `bondesortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `camion`
--
ALTER TABLE `camion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `chargement`
--
ALTER TABLE `chargement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `commande_ap`
--
ALTER TABLE `commande_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `declarer`
--
ALTER TABLE `declarer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `entree`
--
ALTER TABLE `entree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `mois`
--
ALTER TABLE `mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `nonlivrer`
--
ALTER TABLE `nonlivrer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `paiment_declaration`
--
ALTER TABLE `paiment_declaration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `paiment_dette`
--
ALTER TABLE `paiment_dette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `panier_ap`
--
ALTER TABLE `panier_ap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `remuneration`
--
ALTER TABLE `remuneration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taux`
--
ALTER TABLE `taux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
