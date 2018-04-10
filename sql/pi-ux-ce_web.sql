-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-pi-ux-ce.alwaysdata.net
-- Generation Time: Apr 10, 2018 at 04:22 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pi-ux-ce_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `aimer`
--

CREATE TABLE `aimer` (
  `IdUsers` int(11) NOT NULL,
  `IdImages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aimer`
--

INSERT INTO `aimer` (`IdUsers`, `IdImages`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `IdCategorie` int(11) NOT NULL,
  `Categorie` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`IdCategorie`, `Categorie`) VALUES
(1, 'Informatique'),
(2, 'Vetements'),
(3, 'Cuisine');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `IdCommande` int(11) NOT NULL,
  `DateCommande` date DEFAULT NULL,
  `Paye` tinyint(1) DEFAULT NULL,
  `IdUsers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`IdCommande`, `DateCommande`, `Paye`, `IdUsers`) VALUES
(1, '2018-04-11', 0, 1),
(2, '2018-04-09', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `IdCom` int(11) NOT NULL,
  `commentaire` longtext,
  `DateComment` date DEFAULT NULL,
  `IdImages` int(11) DEFAULT NULL,
  `IdUsers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`IdCom`, `commentaire`, `DateComment`, `IdImages`, `IdUsers`) VALUES
(1, 'conviviale', '2018-04-10', 3, 1),
(2, 'good', '2018-04-05', 1, 3),
(3, 'interessant', '2018-04-06', 1, 4),
(4, 'rigolo', '2018-04-10', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `contenir`
--

CREATE TABLE `contenir` (
  `IdCommande` int(11) NOT NULL,
  `IdProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contenir`
--

INSERT INTO `contenir` (`IdCommande`, `IdProduit`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

CREATE TABLE `evenements` (
  `IdEvenement` int(11) NOT NULL,
  `evenement` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `DateEvent` date DEFAULT NULL,
  `validation` tinyint(1) DEFAULT NULL,
  `IdUsers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evenements`
--

INSERT INTO `evenements` (`IdEvenement`, `evenement`, `description`, `DateEvent`, `validation`, `IdUsers`) VALUES
(1, 'foot', 'L\'association de sport voudrai organiser un tournoie de foot au stade de Beaurain', NULL, 0, 3),
(2, 'hotdog', 'Exiamiam voudrait vous proposer des hot dog le midi du 04/04/2018', '2018-04-04', 0, 2),
(3, 'don de sang', 'Nous vous invitons à participer au don du sang organiser par l\'exia le 08/04/2018', '2018-04-08', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `IdImages` int(11) NOT NULL,
  `url` varchar(250) DEFAULT NULL,
  `Likes` int(11) DEFAULT NULL,
  `IdUsers` int(11) DEFAULT NULL,
  `IdEvenement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`IdImages`, `url`, `Likes`, `IdUsers`, `IdEvenement`) VALUES
(1, 'images/event/hotdog1.png', 2, 2, 2),
(2, 'images/event/hotdog2.png', 2, 2, 2),
(3, 'images/event/sang1.png', 1, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `inscrire`
--

CREATE TABLE `inscrire` (
  `IdUsers` int(11) NOT NULL,
  `IdEvenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inscrire`
--

INSERT INTO `inscrire` (`IdUsers`, `IdEvenement`) VALUES
(2, 1),
(2, 2),
(3, 1),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `IdProduit` int(11) NOT NULL,
  `Nom` varchar(250) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `Prix` int(11) DEFAULT NULL,
  `Url` varchar(25) DEFAULT NULL,
  `IdCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`IdProduit`, `Nom`, `description`, `Prix`, `Url`, `IdCategorie`) VALUES
(1, 'souris', NULL, 10, 'Images/souris.png', 1),
(2, 'tapis de souris', NULL, 5, 'Images/tapisSouris.png', 1),
(3, 'mug', NULL, 5, 'Images/mug.png', 3),
(4, 'T-shirt', NULL, 10, 'Images/tShirt.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `IdUsers` int(11) NOT NULL,
  `Nom` varchar(25) DEFAULT NULL,
  `Prenom` varchar(25) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Mdp` varchar(250) DEFAULT NULL,
  `Statut` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`IdUsers`, `Nom`, `Prenom`, `Email`, `Mdp`, `Statut`) VALUES
(1, 'brunelot', 'romain', 'rbrunelot@cesi.fr', 'K666', 'tuteur'),
(2, 'lecomte', 'alexandre', 'alexandre.lecomte@viacesi.fr', 'PowerEdge1', 'eleve'),
(3, 'exiamiam', 'president', 'exiamiam@viacesi.fr', 'Exiamiam2', 'eleve'),
(4, 'prussel', 'loic', 'lprussel@cesi.fr', 'Prussel0', 'tuteur');

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `IdUsers` int(11) NOT NULL,
  `IdEvenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`IdUsers`, `IdEvenement`) VALUES
(1, 3),
(2, 2),
(3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aimer`
--
ALTER TABLE `aimer`
  ADD PRIMARY KEY (`IdUsers`,`IdImages`),
  ADD KEY `FK_aimer_IdImages` (`IdImages`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`IdCategorie`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`IdCommande`),
  ADD KEY `FK_commande_IdUsers` (`IdUsers`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`IdCom`),
  ADD KEY `FK_commentaires_IdImages` (`IdImages`),
  ADD KEY `FK_commentaires_IdUsers` (`IdUsers`);

--
-- Indexes for table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`IdCommande`,`IdProduit`),
  ADD KEY `FK_contenir_IdProduit` (`IdProduit`);

--
-- Indexes for table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`IdEvenement`),
  ADD KEY `FK_evenement_IdUsers` (`IdUsers`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`IdImages`),
  ADD KEY `FK_images_IdUsers` (`IdUsers`),
  ADD KEY `FK_images_IdEvenement` (`IdEvenement`);

--
-- Indexes for table `inscrire`
--
ALTER TABLE `inscrire`
  ADD PRIMARY KEY (`IdUsers`,`IdEvenement`),
  ADD KEY `FK_inscrire_IdEvenement` (`IdEvenement`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`IdProduit`),
  ADD KEY `FK_produits_IdCategorie` (`IdCategorie`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`IdUsers`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`IdUsers`,`IdEvenement`),
  ADD KEY `FK_voter_IdEvenement` (`IdEvenement`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `IdCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `IdCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `IdCom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `IdEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `IdImages` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `IdProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `IdUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aimer`
--
ALTER TABLE `aimer`
  ADD CONSTRAINT `FK_aimer_IdImages` FOREIGN KEY (`IdImages`) REFERENCES `images` (`IdImages`),
  ADD CONSTRAINT `FK_aimer_IdUsers` FOREIGN KEY (`IdUsers`) REFERENCES `utilisateurs` (`IdUsers`);

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_commande_IdUsers` FOREIGN KEY (`IdUsers`) REFERENCES `utilisateurs` (`IdUsers`);

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_commentaires_IdImages` FOREIGN KEY (`IdImages`) REFERENCES `images` (`IdImages`),
  ADD CONSTRAINT `FK_commentaires_IdUsers` FOREIGN KEY (`IdUsers`) REFERENCES `utilisateurs` (`IdUsers`);

--
-- Constraints for table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_contenir_IdCommande` FOREIGN KEY (`IdCommande`) REFERENCES `commandes` (`IdCommande`),
  ADD CONSTRAINT `FK_contenir_IdProduit` FOREIGN KEY (`IdProduit`) REFERENCES `produits` (`IdProduit`);

--
-- Constraints for table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `FK_evenement_IdUsers` FOREIGN KEY (`IdUsers`) REFERENCES `utilisateurs` (`IdUsers`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_images_IdEvenement` FOREIGN KEY (`IdEvenement`) REFERENCES `evenements` (`IdEvenement`),
  ADD CONSTRAINT `FK_images_IdUsers` FOREIGN KEY (`IdUsers`) REFERENCES `utilisateurs` (`IdUsers`);

--
-- Constraints for table `inscrire`
--
ALTER TABLE `inscrire`
  ADD CONSTRAINT `FK_inscrire_IdEvenement` FOREIGN KEY (`IdEvenement`) REFERENCES `evenements` (`IdEvenement`),
  ADD CONSTRAINT `FK_inscrire_IdUsers` FOREIGN KEY (`IdUsers`) REFERENCES `utilisateurs` (`IdUsers`);

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_produits_IdCategorie` FOREIGN KEY (`IdCategorie`) REFERENCES `categories` (`IdCategorie`);

--
-- Constraints for table `voter`
--
ALTER TABLE `voter`
  ADD CONSTRAINT `FK_voter_IdEvenement` FOREIGN KEY (`IdEvenement`) REFERENCES `evenements` (`IdEvenement`),
  ADD CONSTRAINT `FK_voter_IdUsers` FOREIGN KEY (`IdUsers`) REFERENCES `utilisateurs` (`IdUsers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
