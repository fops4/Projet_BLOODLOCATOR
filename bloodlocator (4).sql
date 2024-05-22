-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 06 fév. 2024 à 13:30
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bloodlocator`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `blood_stock`
--

DROP TABLE IF EXISTS `blood_stock`;
CREATE TABLE IF NOT EXISTS `blood_stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_blood_type` (`user_id`,`blood_type`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `blood_stock`
--

INSERT INTO `blood_stock` (`id`, `user_id`, `blood_type`, `quantity`) VALUES
(29, 29, 'A+', 9),
(30, 29, 'A-', 25),
(31, 29, 'B-', 10),
(32, 30, 'A+', 60),
(33, 31, 'B-', 10),
(34, 31, 'A+', 0),
(35, 30, 'B+', 45),
(36, 30, 'O+', 12),
(37, 30, 'AB+', 23),
(38, 30, 'A-', 12);

-- --------------------------------------------------------

--
-- Structure de la table `donneur`
--

DROP TABLE IF EXISTS `donneur`;
CREATE TABLE IF NOT EXISTS `donneur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sexe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `groupe_sanguin` varchar(5) NOT NULL DEFAULT 'O+',
  `unique_id` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Active now',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `donneur`
--

INSERT INTO `donneur` (`id`, `nom`, `prenom`, `sexe`, `date`, `lieu`, `email`, `telephone`, `password`, `image`, `groupe_sanguin`, `unique_id`, `status`) VALUES
(39, '', 'anas', 'Masculin', '2001-04-12', 'foumban', 'latifnjimoluh@gmail.com', '', '$2y$10$Fifw1iHrL7UDmla1DIhUgeYRAOg/c5S0LQzWZxIUsM.ufz/zfU4Zi', '', '', 6431, 'Offline now'),
(40, 'fopi', 'arnold', 'Masculin', '2001-04-12', 'mbouda', 'fops415@gmail.com', '676405824', '$2y$10$mq2B7WnLg3CoU3iTKahaCeeUAHujPr88RUAHAkWG0Njyw/t0UqGE.', '', 'O+', 26743, 'Active now'),
(41, 'douanla', 'bostel', 'Masculin', '2024-01-31', 'mbouda', 'bostel57@gmail.com', '671806404', '$2y$10$FMTIl53FzNaS04baCD6d3.OV6qBzbOPPe6kCG3VhgqemUCJxP6Dx.', '', 'O+', 3523, 'Active now');

-- --------------------------------------------------------

--
-- Structure de la table `hopital`
--

DROP TABLE IF EXISTS `hopital`;
CREATE TABLE IF NOT EXISTS `hopital` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hopitalname` varchar(255) NOT NULL,
  `hopitaladress` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `creationDate` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `unique_id` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Active now',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hopital`
--

INSERT INTO `hopital` (`id`, `hopitalname`, `hopitaladress`, `phone`, `email`, `creationDate`, `password`, `image`, `unique_id`, `status`) VALUES
(30, 'hopital jamot', 'carrefour regie', '673672628', 'jamot@gmail.com', '2001-02-12', '$2y$10$Cz/0Z7t8ga5Cue5JVMUQ.e58EczYDJkqc0cpFqq.fA.UMYmqtMQt2', 'images_hopital/jamot.jpg', 1, 'Offline now'),
(31, 'hopital la caisse', 'Avenue germiaine', '693833827', 'caisse@gmail.com', '2001-12-11', '$2y$10$l208Oj.E1G42/1Rz9oXWKeBPIe3CZ2OmsoxGJbUO8ih1TXamUFC/a', 'images_hopital/caisse.jpg', 306724444, 'Offline now'),
(32, 'Clinique FOuda', 'Fouda', '695023758', 'fouda@gmail.com', '2024-01-31', '$2y$10$N0D6.HW9VMT18PrzTxM4Lu.kDVPIXAa6mHD2Kh/OEON4mBZ2SqWRO', 'images_hopital/fouda.jpg', 781375424, 'Offline now');

-- --------------------------------------------------------

--
-- Structure de la table `kyc`
--

DROP TABLE IF EXISTS `kyc`;
CREATE TABLE IF NOT EXISTS `kyc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `kycName` varchar(50) NOT NULL DEFAULT '0',
  `kycID` varchar(50) NOT NULL DEFAULT '0',
  `kycFrontPhoto` varchar(50) NOT NULL DEFAULT '0',
  `kycBackPhoto` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `kyc`
--

INSERT INTO `kyc` (`id`, `user_id`, `kycName`, `kycID`, `kycFrontPhoto`, `kycBackPhoto`) VALUES
(20, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(21, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(22, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(23, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(24, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(25, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(26, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(27, 40, 'a', '', '../hopital/gestion_hopital/dossier_kyc/Gold Luxury', '../hopital/gestion_hopital/dossier_kyc/Gold Luxury'),
(28, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(29, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im'),
(30, 39, 'a', 'h', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im', '../hopital/gestion_hopital/dossier_kyc/WhatsApp Im');

-- --------------------------------------------------------

--
-- Structure de la table `kyc_data`
--

DROP TABLE IF EXISTS `kyc_data`;
CREATE TABLE IF NOT EXISTS `kyc_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `kyc_name` varchar(255) DEFAULT NULL,
  `kyc_id` varchar(255) DEFAULT NULL,
  `kyc_front_photo` varchar(255) DEFAULT NULL,
  `kyc_back_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `kyc_data`
--

INSERT INTO `kyc_data` (`id`, `user_id`, `kyc_name`, `kyc_id`, `kyc_front_photo`, `kyc_back_photo`) VALUES
(8, 29, 'a', 'a', 'dossier_kyc/Gold Luxury Initial Circle Logo (1).png', 'dossier_kyc/Gold Luxury Initial Circle Logo (2).png'),
(9, 34, 'ertyuio', 'rtyuiop', 'dossier_kyc/photo_2024-02-06_09-54-24.jpg', 'dossier_kyc/pexels-photo-2280549.webp');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `time`) VALUES
(160, 374721013, 781375424, 'yr', '2024-02-04 23:19:20'),
(161, 781375424, 374721013, 'rpoe', '2024-02-04 23:19:25'),
(162, 374721013, 306724444, 'yo', '2024-02-05 03:12:45'),
(163, 374721013, 2, 'yo', '2024-02-05 03:18:09'),
(164, 374721013, 2, 'yo', '2024-02-05 03:19:11'),
(165, 374721013, 306724444, 'k', '2024-02-05 03:23:00'),
(166, 374721013, 306724444, 'nkh', '2024-02-05 03:24:13'),
(167, 374721013, 2, 'h', '2024-02-05 03:24:26'),
(168, 374721013, 2, 'hj', '2024-02-05 03:28:31'),
(169, 374721013, 306724444, 'nkh', '2024-02-05 03:28:39'),
(170, 374721013, 306724444, 'yo', '2024-02-05 03:29:02'),
(171, 374721013, 306724444, 'y', '2024-02-05 03:30:32'),
(172, 306724444, 2, 'yo', '2024-02-05 03:32:07'),
(173, 2, 306724444, 'yo', '2024-02-05 03:32:22'),
(174, 2, 306724444, 'bjghg', '2024-02-05 03:38:47'),
(175, 374721013, 306724444, 'khh', '2024-02-05 03:42:59'),
(176, 2, 306724444, 'yo', '2024-02-05 04:01:35'),
(177, 374721013, 1, 'yo', '2024-02-05 04:34:18'),
(178, 2, 1, 'yo', '2024-02-05 04:34:35'),
(179, 4, 2, 'yo', '2024-02-05 04:53:07'),
(180, 2, 1, 'yo', '2024-02-05 04:58:59'),
(181, 374721013, 2, 'yo', '2024-02-05 05:23:15'),
(182, 374721013, 2, 'jkkh', '2024-02-05 08:21:45'),
(183, 374721013, 2, 'uie', '2024-02-05 10:18:48'),
(184, 374721013, 2, 'eu', '2024-02-05 10:18:50'),
(185, 374721013, 1, 'oiu', '2024-02-05 10:19:56'),
(186, 374721013, 2, 'iuyt', '2024-02-05 10:20:16'),
(187, 2, 1, '0987', '2024-02-05 10:20:38'),
(188, 1, 2, 'poiuy', '2024-02-05 10:20:59'),
(189, 306724444, 781375424, 'rtyui', '2024-02-05 15:08:17'),
(190, 781375424, 1, 'bonjour', '2024-02-05 15:23:32'),
(191, 1, 781375424, 'bonjour', '2024-02-05 15:23:44'),
(192, 781375424, 1, 'salut', '2024-02-06 12:42:09');

-- --------------------------------------------------------

--
-- Structure de la table `temoignage`
--

DROP TABLE IF EXISTS `temoignage`;
CREATE TABLE IF NOT EXISTS `temoignage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `temoignage` varchar(340) NOT NULL,
  `profession` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `temoignage`
--

INSERT INTO `temoignage` (`id`, `name`, `image`, `temoignage`, `profession`) VALUES
(10, 'Njimoluh Anas', 'nexus.jpg', 'Trouver du sang en temps réel pour mon père atteint d\'une maladie sanguine a été un soulagement immense. Les donneurs de sang sont de véritables héros. Encourageons tous ceux qui le peuvent à participer à cette chaîne de solidarité vitale, car donner du sang c\'est sauver une vie.', 'Etudiant'),
(12, 'Douanla Bostel', 'boboski.jpg', 'En tant que donneur de sang régulier, voir concrètement l\'impact de mon don est extrêmement gratifiant. Savoir que mon sang est utilisé pour aider quelqu\'un dans le besoin crée un lien humain profond. Chacun devrait ressentir cette satisfaction personnelle en contribuant à une cause aussi vitale.', 'Etudiant'),
(11, 'Fopi Arnold', 'fops.jpg', 'Mon enfant a dû subir une intervention chirurgicale d\'urgence, et l\'accès à du sang compatible en temps réel était crucial. Grâce à la disponibilité du sang donné par des personnes généreuses, l\'opération a été un succès. Cela souligne vraiment l\'importance de disposer de réserves de sang suffisantes.', 'Etudiant'),
(13, 'Atangana Sammy', 'sammy.jpg', 'Après avoir bénéficié d\'une transfusion sanguine en urgence, je tiens à exprimer ma gratitude envers les donneurs de sang. Leur acte altruiste a littéralement sauvé ma vie. C\'est incroyable de penser que le sang que j\'ai reçu provenait d\'une personne qui a pris le temps de donner. Merci aux donneurs.', 'Etudiant'),
(14, 'NoahHenri', 'merlin.jpg', 'J\'ai récemment été impliqué dans un accident de la route et j\'ai perdu beaucoup de sang. Le personnel médical a agi avec une rapidité impressionnante pour trouver du sang compatible en temps réel. Chaque don compte, et je suis la preuve vivante que cela fait réellement la différence.', 'Etudiant');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
