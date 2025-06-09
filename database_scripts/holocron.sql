-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 juin 2025 à 15:55
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
-- Base de données : `holocron`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `type_element` enum('film','serie','personnage','planete') NOT NULL,
  `id_element` int(11) NOT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `date_avis` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `type_element`, `id_element`, `auteur`, `commentaire`, `date_avis`) VALUES
(1, 'film', 1, 'sergio', 'le film est bien', '2025-06-09 15:15:43'),
(2, 'film', 1, 'thomas', 'le film est mauvais', '2025-06-09 15:16:42');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id_film` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `resume` text DEFAULT NULL,
  `annee_de_sortie` varchar(20) DEFAULT NULL,
  `type` enum('film','serie') NOT NULL,
  `epoque` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id_film`, `titre`, `resume`, `annee_de_sortie`, `type`, `image_url`) VALUES
(1, 'La Menace Fantôme', 'Deux Jedi découvrent un jeune esclave sensible à la Force, tandis qu’une menace obscure plane sur la République.', '1999', 'film', 'films/SW1.jpg'),
(2, 'L’Attaque des Clones', 'Anakin Skywalker grandit tandis qu’un complot séparatiste plonge la galaxie dans le chaos et la guerre.', '2002', 'film', 'films/SW2.webp'),
(3, 'The Clone Wars – Le Film', 'Une introduction à la série animée qui explore la Guerre des Clones.', '2008', 'film', 'films/clonewars_film.webp'),
(4, 'La Revanche des Sith', 'Les Jedi luttent contre les Séparatistes dans une mission dangereuse pour sauver la République.', '2005', 'film', 'films/SW3.webp'),
(5, 'Solo – A Star Wars Story', 'Le jeune Han Solo devient contrebandier, rencontre Chewbacca et vole le Faucon Millenium.', '2018', 'film', 'films/solo.webp'),
(6, 'Rogue One – A Star Wars Story', 'Un groupe rebelle vole les plans de l’Étoile de la Mort au prix d’un immense sacrifice.', '2016', 'film', 'films/rogue.jpg'),
(7, 'Un Nouvel Espoir (Épisode IV)', 'Un jeune fermier nommé Luke Skywalker rejoint la Rébellion contre l’Empire Galactique.', '1977', 'film', 'films/SW4.jpg'),
(8, 'L’Empire Contre-Attaque', 'L’Empire contre-attaque les rebelles, tandis que Luke affronte une vérité bouleversante.', '1980', 'film', 'films/SW5.jpg'),
(9, 'Le Retour du Jedi', 'Luke affronte Dark Vador et l’Empereur dans un ultime combat pour sauver la galaxie.', '1983', 'film', 'films/SW6.jpg'),
(10, 'Le Réveil de la Force', 'Une nouvelle héroïne, Rey, découvre ses pouvoirs alors que le Premier Ordre menace la paix.', '2015', 'film', 'films/SW7.jpg'),
(11, 'Les Derniers Jedi', 'Rey cherche l’enseignement de Luke tandis que la Résistance tente de survivre au Premier Ordre.', '2017', 'film', 'films/SW8.jpg'),
(12, 'L’Ascension de Skywalker', 'Rey et ses alliés affrontent l’Empereur ressuscité dans un ultime combat du Bien contre le Mal.', '2019', 'film', 'films/SW9.jpg'),
(13, 'Acolyte', 'Une série se déroulant à la fin de l’ère de la Haute République, explorant l’émergence du côté obscur.', '2024', 'serie', 'series/acolyte.jpg'),
(14, 'The Clone Wars', 'Une série animée explorant les événements de la Guerre des Clones.', '2008', 'serie', 'series/clonewars.jpg'),
(15, 'The Bad Batch', 'Les aventures d’un groupe de clones génétiquement modifiés après la Guerre des Clones.', '2021', 'serie', 'series/badbatch.jpg'),
(16, 'Kenobi', 'Obi-Wan Kenobi est traqué par l’Empire après l’Ordre 66.', '2022', 'serie', 'series/kenobi.jpg'),
(17, 'Andor', 'L’histoire d’un espion rebelle, Cassian Andor, aux débuts de la Rébellion.', '2022', 'serie', 'series/andor.webp'),
(18, 'Rebels', 'Une bande de jeunes rebelles lutte contre l’Empire.', '2014', 'serie', 'series/rebels.jpg'),
(19, 'Mandalorien', 'Un chasseur de primes solitaire parcourt la galaxie et protège un mystérieux enfant sensible à la Force.', '2019', 'serie', 'series/mando.jpg'),
(20, 'Book of Boba Fett', 'Boba Fett tente de prendre le contrôle du territoire autrefois dirigé par Jabba le Hutt.', '2021', 'serie', 'series/boba.jpg'),
(21, 'Ahsoka', 'Ahsoka Tano et son élève Sabine Wren affrontent une nouvelle menace galactique.', '2023', 'serie', 'series/ahsoka.webp'),
(22, 'Skeleton Crew', 'Un groupe d’enfants perdus dans l’espace tente de retrouver son chemin.', '2024', 'serie', 'series/skeleton.jpg'),
(23, 'Resistance', 'Un pilote résistant infiltre une base pour contrer la menace grandissante du Premier Ordre.', '2018', 'serie', 'series/resistance.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `film_personnage`
--

CREATE TABLE `film_personnage` (
  `id_film` int(11) NOT NULL,
  `id_personnage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `film_planete`
--

CREATE TABLE `film_planete` (
  `id_film` int(11) NOT NULL,
  `id_planete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnages`
--

CREATE TABLE `personnages` (
  `id_personnage` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `sound_url` varchar(255) DEFAULT NULL,
  `id_planete_origine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnages`
--

INSERT INTO `personnages` (`id_personnage`, `nom`, `description`, `image_url`,`sound_url`) VALUES
(1, 'Luke Skywalker', 'Héros de la Rébellion et Jedi légendaire', 'personnages/luke.jpg', 'luke.mp3'),
(2, 'Qui-Gon Jinn', 'Maître Jedi sage et respecté', 'personnages/quigon.jpg', 'quigon.mp3'),
(3, 'Obi-Wan Kenobi', 'Jedi loyal ayant formé Anakin Skywalker', 'personnages/obiwan.jpg', 'obiwan.mp3'),
(4, 'Padmé Amidala', 'Sénatrice et ancienne Reine de Naboo', 'personnages/padme.jpg', 'padme.mp3'),
(5, 'Dark Maul', 'Sith redoutable à double sabre laser', 'personnages/maul.jpg', 'maul.mp3'),
(6, 'Anakin Skywalker', 'Élu de la Force, devenu Dark Vador', 'personnages/anakin.jpg', 'anakin.mp3'),
(7, 'Yoda', 'Grand Maître Jedi', 'personnages/yoda.jpg', 'yoda.mp3'),
(8, 'Mace Windu', 'Membre influent du Conseil Jedi', 'personnages/windu.jpg', 'windu.mp3'),
(9, 'Ahsoka Tano', 'Padawan d’Anakin, devenue indépendante', 'personnages/ahsoka.jpg', 'ahsoka.mp3'),
(10, 'Jabba le Hutt', 'Seigneur du crime sur Tatooine', 'personnages/jabba.jpg', 'jabba.mp3'),
(11, 'Capitaine Rex', 'Clone loyal ayant combattu durant la Guerre des Clones', 'personnages/rex.jpg', 'rex.mp3'),
(12, 'Palpatine', 'Chancelier suprême et Seigneur Sith', 'personnages/palpatine.jpg', 'palpatine.mp3'),
(13, 'La Bad Batch', 'Équipe de clones génétiquement modifiés', 'personnages/badbatch.jpg', 'badbatch.mp3'),
(14, 'Han Solo', 'Contrebandier devenu héros rebelle', 'personnages/hansolo.jpg', 'hansolo.mp3'),
(15, 'Chewbacca', 'Wookiee coéquipier de Han Solo', 'personnages/chewie.jpg', 'chewie.mp3'),
(16, 'Leia Organa', 'Princesse, sénatrice et générale de la Résistance', 'personnages/leia.jpg', 'leia.mp3'),
(17, 'Cassian Andor', 'Espion rebelle courageux et déterminé', 'personnages/andor.jpg', 'andor.mp3'),
(18, 'Ezra Bridger', 'Jeune Jedi rebelle', 'personnages/ezra.jpg', 'ezra.mp3'),
(19, 'Kanan Jarrus', 'Jedi survivant de l\'Ordre 66', 'personnages/kanan.jpg', 'kanan.mp3'),
(20, 'Sabine Wren', 'Guerrière mandalorienne et artiste', 'personnages/sabine.jpg', 'sabine.mp3'),
(21, 'Grand Amiral Thrawn', 'Stratège génial de l\'Empire', 'personnages/thrawn.jpg', 'thrawn.mp3'),
(22, 'Jyn Erso', 'Fille du concepteur de l\'Étoile de la Mort', 'personnages/jyn.jpg', 'jyn.mp3'),
(23, 'R2-D2', 'Droïde astromechano des Skywalker', 'personnages/R2.jpg', 'R2.mp3'),
(24, 'C-3PO', 'Droide de protocole doré', 'personnages/C3po.jpg', 'C3po.mp3'),
(25, 'Din Djarin', 'Chasseur de primes mandalorien', 'personnages/mando.jpg', 'mando.mp3'),
(26, 'Grogu', 'Enfant sensible à la Force', 'personnages/grogu.jpg', 'grogu.mp3'),
(27, 'Boba Fett', 'Célèbre chasseur de primes', 'personnages/boba.jpg', 'boba.mp3'),
(28, 'Rey', 'Orpheline puissante dans la Force', 'personnages/rey.jpg', 'rey.mp3'),
(29, 'Finn', 'Stormtrooper devenu héros de la Résistance', 'personnages/finn.jpg', 'finn.mp3'),
(30, 'Kylo Ren', 'Fils de Leia et Han, tenté par le côté obscur', 'personnages/kylo.jpg', 'kylo.mp3');

-- --------------------------------------------------------

--
-- Structure de la table `planetes`
--

CREATE TABLE `planetes` (
  `id_planete` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `infos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `planetes`
--

INSERT INTO `planetes` (`id_planete`, `nom`, `description`, `image_url`, `infos`) VALUES
(1, 'Ach-Tao', 'Planète isolée où Luke Skywalker s’est exilé.', 'planetes/Ach-Tao.jpg', NULL),
(2, 'Alderaan', 'Monde natal de Leia Organa, détruit par l’Étoile de la mort.', 'planetes/alderaan.jpg', NULL),
(3, 'At Attin', 'Planète peu connue apparaissant dans “Screw”.', 'planetes/AtAttin.jpg', NULL),
(4, 'Atollon', 'Planète utilisée comme base par les rebelles.', 'planetes/Atollon.jpg', NULL),
(5, 'Bespin', 'Géante gazeuse avec la Cité des Nuages.', 'planetes/Bespin.jpg', NULL),
(6, 'Brendok', 'Planète mystérieuse vue dans The Acolyte.', 'planetes/Brendok.jpg', NULL),
(7, 'Cantonica', 'Planète casino, vue dans “Les Derniers Jedi”.', 'planetes/Cantonica.jpg', NULL),
(8, 'Corellia', 'Planète industrielle, d’origine de Han Solo.', 'planetes/Corellia.jpg', NULL),
(9, 'Coruscant', 'Capitale galactique, cœur du pouvoir impérial et républicain.', 'planetes/Coruscant.jpg', NULL),
(10, 'Crait', 'Planète de sel rouge, vue dans “Les Derniers Jedi”.', 'planetes/Crait.jpg', NULL),
(11, 'Dagobah', 'Planète marécageuse, refuge de Yoda.', 'planetes/Dagobah.jpg', NULL),
(12, 'Dathomir', 'Planète natale des Sœurs de la Nuit.', 'planetes/Dathomir.jpg', NULL),
(13, 'Endor', 'Forêt abritant les Ewoks et la bataille finale de l’Épisode VI.', 'planetes/Endor.jpg', NULL),
(14, 'Exegol', 'Planète Sith cachée, repaire de l’Empereur ressuscité.', 'planetes/Exegol.jpg', NULL),
(15, 'Ferrix', 'Planète industrielle où débute la série “Andor”.', 'planetes/Ferrix.jpg', NULL),
(17, 'Ghorman', 'Site d’un massacre impérial, motivant la rébellion.', 'planetes/Ghorman.jpg', NULL),
(18, 'Hoth', 'Planète glacée, abritant une base rebelle.', 'planetes/Hoth.jpg', NULL),
(19, 'Illum', 'Planète de cristaux Kyber, transformée en arme par le Premier Ordre.', 'planetes/Illum.jpg', NULL),
(20, 'Jabiim', 'Planète boueuse vue dans “Kenobi”.', 'planetes/jabiim.jpg', NULL),
(21, 'Jacku', 'Planète désertique où vit Rey au début de la postlogie.', 'planetes/Jakku.jpg', NULL),
(22, 'Jehda', 'Planète sainte pour les Jedi, détruite par l’Étoile de la mort.', 'planetes/jehda.jpg', NULL),
(23, 'Kamino', 'Planète océanique des cloneurs.', 'planetes/Kamino.jpg', NULL),
(24, 'Kashyyyk', 'Monde natal des Wookiees.', 'planetes/Kashyyyk.jpg', NULL),
(25, 'Kessel', 'Planète des mines d’épice et du raid de Han Solo.', 'planetes/kessel.jpg', NULL),
(26, 'Kijimi', 'Planète gelée détruite par le Premier Ordre.', 'planetes/Kijimi.jpg', NULL),
(27, 'Lothal', 'Planète principale dans la série “Rebels”.', 'planetes/lothal.jpg', NULL),
(28, 'Mandalore', 'Planète guerrière et divisée des Mandaloriens.', 'planetes/mandalore.jpg', NULL),
(29, 'Mimban', 'Planète boueuse et en guerre dans “Solo”.', 'planetes/Mimban.jpg', NULL),
(30, 'Mustafar', 'Planète volcanique, repaire de Dark Vador.', 'planetes/Mustafar.jpg', NULL),
(31, 'Naboo', 'Planète royale, natale de Padmé Amidala.', 'planetes/Naboo.jpg', NULL),
(32, 'Nevarro', 'Planète des chasseurs de primes dans “The Mandalorian”.', 'planetes/Nevarro.jpg', NULL),
(34, 'Pabu', 'Planète paisible accueillant des réfugiés.', 'planetes/Pabu.jpg', NULL),
(35, 'Pasaana', 'Planète désertique visitée dans “L’Ascension de Skywalker”.', 'planetes/Pasaana.jpg', NULL),
(36, 'Perridea', 'Planète extragalactique vue dans “Ahsoka”.', 'planetes/Perridea.jpg', NULL),
(37, 'Scarif', 'Planète des archives impériales, détruite par l’Étoile de la mort.', 'planetes/Scarif.jpg', NULL),
(38, 'Seatos', 'Planète mystérieuse explorée dans “Ahsoka”.', 'planetes/Seatos.jpg', NULL),
(39, 'Takodana', 'Planète du château de Maz Kanata.', 'planetes/Takodana.jpg', NULL),
(40, 'Tatooine', 'Planète désertique iconique, natale de Luke et Anakin.', 'planetes/Tatooine.jpg', NULL),
(41, 'Teth', 'Planète montagneuse dans “The Clone Wars”.', 'planetes/Teth.jpg', NULL),
(42, 'Utapau', 'Planète où Obi-Wan affronte Grievous.', 'planetes/Utapau.jpg', NULL),
(43, 'Wayland', 'Planète secrète dans “The Bad Batch”.', 'planetes/Wayland.jpg', NULL),
(44, 'Yavin', 'Lune Yavin IV, base rebelle dans l’Épisode IV.', 'planetes/Yavin.jpg', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`);

--
-- Index pour la table `film_personnage`
--
ALTER TABLE `film_personnage`
  ADD PRIMARY KEY (`id_film`,`id_personnage`),
  ADD KEY `id_personnage` (`id_personnage`);

--
-- Index pour la table `film_planete`
--
ALTER TABLE `film_planete`
  ADD PRIMARY KEY (`id_film`,`id_planete`),
  ADD KEY `id_planete` (`id_planete`);

--
-- Index pour la table `personnages`
--
ALTER TABLE `personnages`
  ADD PRIMARY KEY (`id_personnage`),
  ADD KEY `id_planete_origine` (`id_planete_origine`);

--
-- Index pour la table `planetes`
--
ALTER TABLE `planetes`
  ADD PRIMARY KEY (`id_planete`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `personnages`
--
ALTER TABLE `personnages`
  MODIFY `id_personnage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `planetes`
--
ALTER TABLE `planetes`
  MODIFY `id_planete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `film_personnage`
--
ALTER TABLE `film_personnage`
  ADD CONSTRAINT `film_personnage_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `film_personnage_ibfk_2` FOREIGN KEY (`id_personnage`) REFERENCES `personnages` (`id_personnage`) ON DELETE CASCADE;

--
-- Contraintes pour la table `film_planete`
--
ALTER TABLE `film_planete`
  ADD CONSTRAINT `film_planete_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `film_planete_ibfk_2` FOREIGN KEY (`id_planete`) REFERENCES `planetes` (`id_planete`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personnages`
--
ALTER TABLE `personnages`
  ADD CONSTRAINT `personnages_ibfk_1` FOREIGN KEY (`id_planete_origine`) REFERENCES `planetes` (`id_planete`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
