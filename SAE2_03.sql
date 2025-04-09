-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 09 avr. 2025 à 09:43
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
-- Base de données : `nepomiachty1`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Comédie'),
(3, 'Drame'),
(4, 'Science-fiction'),
(5, 'Animation'),
(6, 'Thriller'),
(7, 'Horreur'),
(8, 'Aventure'),
(9, 'Fantaisie'),
(10, 'Documentaire');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `min_age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `name`, `year`, `length`, `description`, `director`, `id_category`, `image`, `trailer`, `min_age`) VALUES
(7, 'Interstellar', 2014, 169, 'Un groupe d\'astronautes qui utilisent une faille dans l\'espace-temps pour explorer de nouvelles planètes, cherchant un nouvel habitat pour l\'humanité alors que la Terre est en train de s\'effondrer à cause d\'une crise environnementale.', 'Christopher Nolan', 4, 'interstellar.jpg', 'VaOijhK3CRU', 12),
(12, 'La Liste de Schindler', 1993, 195, 'Nous suivons l\'histoire d\'Oskar Schindler, un homme d\'affaires allemand qui devient un humanitaire improbable pendant le règne nazi allemand. Schindler transforme son usine en refuge pour les Juifs, alors que les Allemands installés en Pologne regroupent les Juifs dans des ghettos dans le but de s\'en servir comme main d\'oeuvre bon marché.', 'Steven Spielberg', 3, 'schindler.webp', 'ONWtyxzl-GE', 16),
(17, 'Your Name', 2016, 107, 'Mitsuha, adolescente coincée dans une famille traditionnelle, rêve de quitter ses montagnes natales pour découvrir la vie trépidante de Tokyo. Elle est loin d’imaginer pouvoir vivre l’aventure urbaine dans la peau de… Taki, un jeune lycéen vivant à Tokyo, occupé entre son petit boulot dans un restaurant italien et ses nombreux amis. À travers ses rêves, Mitsuha se voit littéralement propulsée dans la vie du jeune garçon au point qu’elle croit vivre la réalité... Tout bascule lorsqu’elle réalise que Taki rêve également d’une vie dans les montagnes, entouré d’une famille traditionnelle… dans la peau d’une jeune fille ! Une étrange relation s’installe entre leurs deux corps qu’ils accaparent mutuellement. Quel mystère se cache derrière ces rêves étranges qui unissent deux destinées que tout oppose et qui ne se sont jamais rencontrées ?', 'Makoto Shinkai', 5, 'your_name.jpg', 'AROOK45LXXg', 10),
(27, 'Le Bon, la Brute et le Truand', 1966, 161, 'Ce film se déroulant pendant la Guerre de Sécession. Joe et son complice Tuco cherchent un trésor caché par les Nordistes. Le cruel Setenza est également à leur poursuite. Le film est un mélange d\'action, d\'humour et de suspense.', 'Sergio Leone', 8, 'bon_brute_truand.jpg', 'WA1hCZFOPqs', 12),
(49, 'Shrek', 2001, 90, 'un ogre laid et misanthrope, Shrek, qui vit tranquille et heureux dans la saleté au milieu d\'un marais qu\'il croit un havre de paix.', 'Andrew Adamson', 2, 'shrek.webp', 'CwXOrWvPBPk', 6),
(50, 'Dream BBQ', 2025, 90, 'ENA à la recherche du Boss que tout le monde rêve d\'être. À travers des portes, elle explore des mondes étranges, accepte des missions annexes et rencontre des personnages aussi bien doux qu\'amers tout au long de son aventure.', 'Brian Zavala', 9, 'Dream_BBQ.png', 'yzNcZdCYat0', 13),
(51, 'Un film Minecraft', 2025, 101, 'Lassé de son quotidien, Steve retrouve son âme jugée enfantine d\'explorateur au cours d\'une pause déjeuner et s\'empresse de retourner à la mine où il trouve un mystérieux artefact qui ouvre alors un portail vers un mode cubique appelé la Surface', 'Jared Hess', 8, 'minecraft.jpeg', 'R59ZeaOcUbY', 10),
(52, 'Retour vers le futur', 1985, 116, 'Marty McFly, un adolescent qui voyage dans le passé à bord d\'une machine à voyager dans le temps fabriquée par son ami le docteur Emmett Brown à partir d\'une voiture DeLorean DMC-12. Parti de l\'année 1985 et propulsé le 5 novembre 1955', 'Robert Zemeckis', 4, 'Retour_vers_le_futur.jpg', 'cU5BREZ9ke0', 11),
(53, 'Jurassic Park', 1993, 127, 'Ne pas réveiller le chat qui dort... C\'est ce que le milliardaire John Hammond aurait dû se rappeler avant de se lancer dans le \"clonage\" de dinosaures. C\'est à partir d\'une goutte de sang absorbée par un moustique fossilisé que John Hammond et son équipe ont réussi à faire renaître une dizaine d\'espèces de dinosaures. Il s\'apprête maintenant avec la complicité du docteur Alan Grant, paléontologue de renom, et de son amie Ellie, à ouvrir le plus grand parc à thème du monde. Mais c\'était sans compter la cupidité et la malveillance de l\'informaticien Dennis Nedry, et éventuellement des dinosaures, seuls maîtres sur l\'île', 'Michael Crichton', 1, 'jurassic_park.jpeg', 'QWBKEmWWL38', 10),
(54, 'Vendredi 13', 1980, 95, 'Un vendredi 13, jour anniversaire des décès survenus vingt-trois ans plus tôt. Lors de la préparation du camp pour l\'été', 'Sean S. Cunningham', 7, 'Vendredi_13.webp', 'x5b3QPElG3Q', 13),
(55, 'The Dark Knight', 2008, 152, 'Batman aborde une phase décisive de sa guerre contre le crime à Gotham City', 'Christopher Nolan', 6, 'the_dark_kinght.jpeg', 'EXeTwQWrcwY', 13),
(56, 'Sonic, le film', 2020, 99, 'Sur une planète éloignée de la Terre, Sonic, un petit hérisson bleu anthropomorphe qui a la capacité de courir à une vitesse prodigieuse, est recherché par une tribu d\'échidnés anthropomorphes qui convoitent son pouvoir. Sa protectrice, Longclaw, une chouette, lui confie un sac rempli d\'anneaux qui créent des portails permettant de se téléporter où l\'on souhaite. Elle en utilise un pour envoyer Sonic sur Terre et se sacrifie pour le protéger des échidnés.', 'Jeff Fowler', 8, 'sonic.jpeg', 'NCZTYdAP6w0', 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
