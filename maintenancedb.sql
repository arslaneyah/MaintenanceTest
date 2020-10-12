-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 oct. 2020 à 09:26
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `maintenancedb`
--

-- --------------------------------------------------------

--
-- Structure de la table `alimentation_cuves`
--

CREATE TABLE `alimentation_cuves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cuve_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `quantite` double(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fournisseur_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cuves`
--

CREATE TABLE `cuves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacite` double(8,2) NOT NULL,
  `unite_id` bigint(20) UNSIGNED NOT NULL,
  `quantite_gasoil` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cuves`
--

INSERT INTO `cuves` (`id`, `nom`, `capacite`, `unite_id`, `quantite_gasoil`, `created_at`, `updated_at`) VALUES
(1, 'Cuve Setif', 46000.00, 33, 45380.00, NULL, '2020-10-05 08:08:13'),
(2, 'Cuve Biskra', 30000.00, 3307, 15000.00, NULL, '2020-09-07 13:17:22'),
(3, 'Cuve Skikda', 60000.00, 37, 50000.00, NULL, NULL),
(4, 'Cuve DG Constantine', 8000.00, 3725, 6720.00, NULL, '2020-10-11 13:02:41'),
(99, 'Autre', 999999.99, 3725, 999999.99, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `prix`, `created_at`, `updated_at`, `etat`) VALUES
(2, 'Naftal', 29.01, '2020-10-07 09:17:39', '2020-10-07 09:17:39', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gasoils`
--

CREATE TABLE `gasoils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kilometrage_id` bigint(20) UNSIGNED NOT NULL,
  `litres` double(8,2) NOT NULL,
  `fournisseur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cuve_id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gasoils`
--

INSERT INTO `gasoils` (`id`, `kilometrage_id`, `litres`, `fournisseur_id`, `created_at`, `updated_at`, `cuve_id`, `type`) VALUES
(21, 29, 50.00, 2, '2020-10-11 12:57:27', '2020-10-11 12:57:27', 4, 1),
(22, 30, 60.00, 2, '2020-10-11 12:58:06', '2020-10-11 12:58:06', 4, 1),
(23, 31, 50.00, 2, '2020-10-11 13:02:41', '2020-10-11 13:02:41', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `kilometrages`
--

CREATE TABLE `kilometrages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` datetime NOT NULL,
  `dernier_km` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vehicule_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `kilometrages`
--

INSERT INTO `kilometrages` (`id`, `created_at`, `updated_at`, `date`, `dernier_km`, `user_id`, `vehicule_id`) VALUES
(29, '2020-10-11 12:57:27', '2020-10-11 12:57:27', '2020-10-01 14:57:00', 25000, 3, 93),
(30, '2020-10-11 12:58:05', '2020-10-11 12:58:05', '2020-09-01 14:57:00', 26000, 3, 72),
(31, '2020-10-11 13:02:41', '2020-10-11 13:02:41', '2020-10-11 15:02:00', 25400, 3, 93);

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id`, `nom`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Hyundai', 1, NULL, NULL),
(2, 'SNVI', 1, NULL, NULL),
(3, 'Iveco', 1, NULL, NULL),
(4, 'Toyota', 1, NULL, NULL),
(5, 'Mercedes Benz', 1, NULL, NULL),
(6, 'Vanhool', 1, NULL, NULL),
(7, 'Nissan', 3, '2020-10-08 06:48:13', '2020-10-08 06:48:13');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_08_30_082941_create_unites_table', 1),
(10, '2020_08_30_083013_create_wilayas_table', 1),
(11, '2020_08_30_083036_create_vehicules_table', 1),
(12, '2020_08_30_092932_create_kilometrages_table', 1),
(13, '2020_08_30_120806_create_gasoils_table', 2),
(14, '2020_08_30_122659_create_gasoils_table', 3),
(21, '2020_09_01_073437_add_date_column_to_kilometrage', 4),
(22, '2020_09_01_074638_add_unite_wilaya_to_vehicules', 5),
(23, '2020_09_01_084406_add_userid_to_gasoils', 6),
(25, '2020_09_01_084543_create_marques_table', 7),
(26, '2020_09_01_084624_create_modeles_table', 7),
(27, '2020_09_01_102617_add_modele_to_vehicules', 8),
(28, '2020_09_01_120641_create_fournisseurs_table', 9),
(29, '2020_09_01_122337_drop_prix_column', 10),
(32, '2020_09_01_123726_add_role_to_users', 11),
(33, '2020_09_01_124802_add_wilaya_to_unites', 12),
(34, '2020_09_01_140307_add_park_chasis_to_vehicules', 13),
(43, '2020_09_07_072543_create_cuves_table', 14),
(44, '2020_09_07_073143_create_alimentation__cuves_table', 14),
(45, '2020_09_07_081636_add_cuve_id_to__gasoils', 14),
(46, '2020_09_07_083525_add_fournisseur_to__alimentation_cuve', 14),
(47, '2020_09_27_135829_add_type_to_gasoils', 15),
(48, '2020_10_05_072856_add_vehicule_id_to_kilometrages', 16),
(50, '2020_10_06_090218_add_unite_id_to_users', 17);

-- --------------------------------------------------------

--
-- Structure de la table `modeles`
--

CREATE TABLE `modeles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modeles`
--

INSERT INTO `modeles` (`id`, `modele`, `marque_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Universe', 1, 1, NULL, NULL),
(2, '100L6', 2, 1, NULL, NULL),
(3, '100V8', 2, 1, NULL, NULL),
(4, '25L4', 2, 1, NULL, NULL),
(5, '70L6', 2, 1, NULL, NULL),
(6, 'Arway Euro3', 3, 1, NULL, NULL),
(7, 'Coaster', 4, 1, NULL, NULL),
(8, 'County', 1, 1, NULL, NULL),
(9, 'H350', 1, 1, NULL, NULL),
(10, 'Safir', 2, 1, NULL, NULL),
(11, 'Sprinter', 5, 1, NULL, NULL),
(12, 'T815', 6, 1, NULL, NULL),
(13, 'T915', 6, 1, NULL, NULL),
(14, 'T915GLS', 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE `unites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wilaya_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `unites`
--

INSERT INTO `unites` (`id`, `name`, `created_at`, `updated_at`, `wilaya_id`) VALUES
(33, 'Unite 33', NULL, NULL, 19),
(37, 'Unite 37', NULL, NULL, 21),
(3307, 'Unite 33 -Biskra-', NULL, NULL, 7),
(3330, 'Unite 33 -Ouargla-', NULL, NULL, 30),
(3723, 'Unite 37 -Annaba-', NULL, NULL, 23),
(3725, 'Unite 37 -DG Constantine-', NULL, NULL, 25);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unite_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `created_by`, `role`, `unite_id`) VALUES
(1, 'Yahiouche Arslane', 'yahiouchearslane97@gmail.com', NULL, '$2y$10$eNLJjXbXBnm6wK6k4nlpPOM0kecykyQDBy7cEQHTer9I.vUcB/IgC', NULL, NULL, NULL, 1, 'admin', 3725),
(2, 'Agent Setif', 'agentsetif@mail.com', NULL, '$2y$10$DjuIGXMhmZvIt8utyvUsm.ivMSvHX2QMWZqN652qA3UgVFtE9vFxO', NULL, NULL, NULL, 1, 'agent', 33),
(3, 'esma', 'esma@mail.com', NULL, '$2y$10$xTH2.b30bBBx8pqr4gjCGOBp26B07NxMGq/ZTC5fOGeEAo3TWrhBy', NULL, '2020-10-07 08:39:14', '2020-10-07 08:39:14', 1, 'agent', 3725),
(4, 'kamel', 'kamel@mail.com', NULL, '$2y$10$c4JanluC06Fjl.hjpSWRCu45eupQeYk.mIEfaGxjYPrpP9o5TW7iO', NULL, '2020-10-07 08:41:09', '2020-10-07 08:41:09', 1, 'admin', 3725);

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE `vehicules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `n_park` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_chassis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele_id` bigint(20) UNSIGNED NOT NULL,
  `unite_id` bigint(20) UNSIGNED NOT NULL,
  `annee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`id`, `n_park`, `n_chassis`, `matricule`, `modele_id`, `unite_id`, `annee`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '33C01', 'C901410', '16180 - 408 - 19', 1, 33, 2008, NULL, NULL, 1),
(2, '33C02', 'C901835', '15821 - 409 - 19', 1, 33, 2009, NULL, NULL, 1),
(3, '37 C01', 'C900936', '04112-408-21', 1, 37, 2008, NULL, NULL, 1),
(4, '37 C02', 'C901413', '04113-408-21', 1, 37, 2008, NULL, NULL, 1),
(5, '37 C03', 'C901836', '03032-409-21', 1, 37, 2009, NULL, NULL, 1),
(6, '37C04', 'C901412', '05449-408-21', 1, 37, 2008, NULL, NULL, 1),
(7, '4C01', 'C900941', '04115 - 408 - 21', 1, 33, 2008, NULL, NULL, 1),
(8, '4C02', 'C901354', '04114 - 408 - 21', 1, 33, 2008, NULL, NULL, 1),
(9, '4C03', 'C901837', '04214 - 409 - 21', 1, 33, 2009, NULL, NULL, 1),
(10, '3781001', 'C70000775', '00008-413-25', 2, 37, 2013, NULL, NULL, 1),
(11, '3781002', 'C70000778', '00014-413-25', 2, 37, 2013, NULL, NULL, 1),
(12, '3781003', 'C70000780', '00011-413-25', 2, 37, 2013, NULL, NULL, 1),
(13, '3781004', 'C70000781', '00010-413-25', 2, 37, 2013, NULL, NULL, 1),
(14, '3781005', 'C70000782', '00012-413-25', 2, 37, 2013, NULL, NULL, 1),
(15, '3781006', 'C70000813', '00009-413-25', 2, 37, 2013, NULL, NULL, 1),
(16, '3781007', 'C70000826', '00013-413-25', 2, 37, 2013, NULL, NULL, 1),
(17, '3781008', 'C70000836', '00026-413-25', 2, 37, 2013, NULL, NULL, 1),
(18, '3781009', 'C70000841', '00019-413-25', 2, 37, 2013, NULL, NULL, 1),
(19, '3781010', 'C70000834', '00020-413-25', 2, 37, 2013, NULL, NULL, 1),
(20, '3781011', 'C70000835', '00023-413-25', 2, 37, 2013, NULL, NULL, 1),
(21, '3781012', 'C70000840', '00025-413-25', 2, 37, 2013, NULL, NULL, 1),
(22, '3781013', 'C70000831', '00024-413-25', 2, 37, 2013, NULL, NULL, 1),
(23, '3781014', 'C70000838', '00018-413-25', 2, 37, 2013, NULL, NULL, 1),
(24, '3761010', '12 TF 2283', '02741-495-21', 3, 37, 1995, NULL, NULL, 1),
(25, '3375001', '8S2791', '10414-403-19', 4, 33, 2003, NULL, NULL, 1),
(26, '3371001', '10T0502', '10459- 403 - 19', 5, 33, 2003, NULL, NULL, 1),
(27, '3771001', '10T0506', '00074-403-25', 5, 37, 2003, NULL, NULL, 1),
(28, '19101', 'M022512', '06821-415-19', 6, 33, 2015, NULL, NULL, 1),
(29, '19102', 'M022514', '06823-415-19', 6, 33, 2015, NULL, NULL, 1),
(30, '19103', 'M022517', '06824-415-19', 6, 33, 2015, NULL, NULL, 1),
(31, '19104', 'M022521', '09692-415-19', 6, 33, 2015, NULL, NULL, 1),
(32, '19105', 'M022526', '06826-415-19', 6, 33, 2015, NULL, NULL, 1),
(33, '19106', 'M022528', '09694-415-19', 6, 33, 2015, NULL, NULL, 1),
(34, '19107', 'M022493', '02369-415-21', 6, 33, 2015, NULL, NULL, 1),
(35, '21101', 'M022486', '02367-415-21', 6, 37, 2015, NULL, NULL, 1),
(36, '21102', 'M022491', '02366-415-21', 6, 37, 2015, NULL, NULL, 1),
(37, '21104', 'M022497', '02370-415-21', 6, 37, 2015, NULL, NULL, 1),
(38, '21105', 'M022501', '02371-415-21', 6, 37, 2015, NULL, NULL, 1),
(39, '21106', 'M022503', '02364-415-21', 6, 37, 2015, NULL, NULL, 1),
(40, '21107', 'M022507', '02368-415-21', 6, 37, 2015, NULL, NULL, 1),
(41, '7101', 'M022535', '00015-415-07', 6, 33, 2015, NULL, NULL, 1),
(42, '7102', 'M022539', '00012-415-07', 6, 33, 2015, NULL, NULL, 1),
(43, '7103', 'M022543', '00013-415-07', 6, 33, 2015, NULL, NULL, 1),
(44, '7104', 'M022546', '00011-415-07', 6, 33, 2015, NULL, NULL, 1),
(45, '7105', 'M022548', '00010-415-07', 6, 33, 2015, NULL, NULL, 1),
(46, '7106', 'M022553', '00014-415-07', 6, 33, 2015, NULL, NULL, 1),
(47, '7 B 01', 'X01010053', '02864-404-21', 7, 37, 2004, NULL, NULL, 1),
(48, '37 D01', '41541', '01687-409-21', 8, 37, 2009, NULL, NULL, 1),
(49, '37 D02', '41555', '01683-409-21', 8, 37, 2009, NULL, NULL, 1),
(50, '4D01', 'C041543', '00908-409-21', 8, 33, 2009, NULL, NULL, 1),
(51, '19401', 'KMFAB27RPLK018403', '00008-420-25', 9, 33, 2020, NULL, NULL, 1),
(52, '21401', 'KMFAB27RPLK018433', '00009 - 420 - 25', 9, 37, 2020, NULL, NULL, 1),
(53, '21402', 'KMFAB27RPLK018404', '00005 - 420 - 25', 9, 37, 2020, NULL, NULL, 1),
(54, '21404', 'KMFAB27RPLK018457', '00010 - 420 - 25', 9, 37, 2020, NULL, NULL, 1),
(55, '21405', 'KMFAB27RPLK018326', '00007 - 420 - 25', 9, 37, 2020, NULL, NULL, 1),
(56, '21406', 'KMFAB27RPLK018338', '00004 - 420 - 25', 9, 37, 2020, NULL, NULL, 1),
(57, '21407', 'KMFAB27RPLK018339', '00006 - 420 - 25', 9, 37, 2020, NULL, NULL, 1),
(58, '21408', 'KMFAB27RPLK018395', '00011 - 420 - 25', 9, 37, 2020, NULL, NULL, 1),
(59, '3391001', 'C60000109', '19999-414-19', 10, 33, 2014, NULL, NULL, 1),
(60, '3391002', 'C60000C126', '19405-414-19', 10, 33, 2014, NULL, NULL, 1),
(61, '3391003', 'C60000C123', '19414-414-19', 10, 33, 2014, NULL, NULL, 1),
(62, '3391004', 'C60000C115', '19416 - 414 - 19', 10, 33, 2014, NULL, NULL, 1),
(63, '3391005', 'C60000C113', '19415 - 414 - 19', 10, 33, 2014, NULL, NULL, 1),
(64, '3791001', 'C60000103', '00011-414-25', 10, 37, 2014, NULL, NULL, 1),
(65, '3791002', 'C60000121', '00040-414-25', 10, 37, 2014, NULL, NULL, 1),
(66, '3491001', 'C60000095', '00022-413-25', 10, 37, 2014, NULL, NULL, 1),
(67, '3491003', 'C60000110', '00038-414-25', 10, 37, 2014, NULL, NULL, 1),
(68, '3491002', 'C60000096', '00021-413-25', 10, 33, 2013, NULL, NULL, 1),
(69, '3491004', 'C60000117', '00037-414-25', 10, 33, 2014, NULL, NULL, 1),
(70, '19301', 'BR19066111B400141', '03279 - 116 - 25', 11, 33, 2016, NULL, NULL, 1),
(71, '19302', 'BR19066111B400188', '03280 - 116 - 25', 11, 33, 2016, NULL, NULL, 1),
(72, '19303', 'BR19066331B401955', '00011 - 116 - 25', 11, 33, 2016, NULL, NULL, 1),
(73, '19306', 'BR19066331B401766', '00012 - 116 - 25', 11, 33, 2016, NULL, NULL, 1),
(74, '19307', 'BR19066111B400354', '03277 - 116 - 25', 11, 33, 2016, NULL, NULL, 1),
(75, '19308', 'BR19066111B400164', '00477 - 117 - 25', 11, 33, 2017, NULL, NULL, 1),
(76, '19309', 'BR19066111B400166', '00476 - 117 - 25', 11, 33, 2017, NULL, NULL, 1),
(77, '19310', 'BR19066111B400186', '00486 - 117 - 25', 11, 33, 2017, NULL, NULL, 1),
(78, '19311', 'BR19066111B400189', '00475 - 117 - 25', 11, 33, 2017, NULL, NULL, 1),
(79, '19312', 'BR19066111B400275', '00474 - 117 - 25', 11, 33, 2017, NULL, NULL, 1),
(80, '19305', 'BR19066111B400831', '00487 - 117 - 25', 11, 33, 2017, NULL, NULL, 1),
(81, '19304', 'BR19066111B400153', '00470 - 117 - 25', 11, 33, 2017, NULL, NULL, 1),
(82, '19314', 'BR19066571B405151', '00008 - 118 - 25', 11, 33, 2018, NULL, NULL, 1),
(83, '19315', 'BR19066571B403732', '00007 - 118 - 25', 11, 33, 2018, NULL, NULL, 1),
(84, '19316', 'BR19066571B403751', '00010 - 118 - 25', 11, 33, 2018, NULL, NULL, 1),
(85, '19317', 'BR19066571B403779', '00011 - 118 - 25', 11, 33, 2018, NULL, NULL, 1),
(86, '19318', 'BR19066571B416720', '00012 - 118 - 25', 11, 33, 2018, NULL, NULL, 1),
(87, '19319', 'BR19066571B401619', '00013 - 116 - 25', 11, 33, 2016, NULL, NULL, 1),
(88, '21301', 'BR19066111B400986', '00489 -117 - 25', 11, 37, 2017, NULL, NULL, 1),
(89, '21302', 'BR19066571B401599', '00014 - 416 - 25', 11, 37, 2016, NULL, NULL, 1),
(90, '21303', 'BR19066111B400387', '03282 - 116 - 25', 11, 37, 2016, NULL, NULL, 1),
(91, '21304', 'BR19066111B400308', '03283 - 116 - 25', 11, 37, 2016, NULL, NULL, 1),
(92, '21305', 'BR19066111B400433', '03284 - 116 - 25', 11, 37, 2016, NULL, NULL, 1),
(93, '21306', 'BR19066111B400181', '03285 - 116 - 25', 11, 37, 2016, NULL, NULL, 1),
(94, '21307', 'BR19066111B400425', '03517 - 116 - 25', 11, 37, 2016, NULL, NULL, 1),
(95, '21308', 'BR19066571B403591', '00009 - 418 - 25', 11, 37, 2018, NULL, NULL, 1),
(96, '21310', 'BR19066571B417939', '00014 - 419 - 23', 11, 37, 2019, NULL, NULL, 1),
(97, '21311', 'BR19066571B418543', '00015 - 419 - 23', 11, 37, 2019, NULL, NULL, 1),
(98, '3A16', '26171', '08975-494-19', 12, 33, 1994, NULL, NULL, 1),
(99, '7 A 04', '26175', '03173-494-21', 12, 37, 1994, NULL, NULL, 1),
(100, '7 A 05', '26180', '03169-494-21', 12, 37, 1994, NULL, NULL, 1),
(101, '7A 06', '26181', '03172-494-21', 12, 37, 1994, NULL, NULL, 1),
(102, '19202', 'D55678', '13601-415-19', 13, 33, 2015, NULL, NULL, 1),
(103, '19203', 'D55679', '13602-415-19', 13, 33, 2015, NULL, NULL, 1),
(104, '19204', 'D55680', '13605-415-19', 13, 33, 2015, NULL, NULL, 1),
(105, '19205', 'D55684', '14995-415-19', 13, 33, 2015, NULL, NULL, 1),
(106, '19206', 'D55685', '15285-415-19', 13, 33, 2015, NULL, NULL, 1),
(107, '19209', 'D55734', '15307-415-19', 13, 33, 2015, NULL, NULL, 1),
(108, '21201', 'D55690', '04672-415-21', 13, 37, 2015, NULL, NULL, 1),
(109, '21202', 'D55691', '04671-415-21', 13, 37, 2015, NULL, NULL, 1),
(110, '21203', 'D55692', '04673-415-21', 13, 37, 2015, NULL, NULL, 1),
(111, '21204', 'D55693', '04659-415-21', 13, 37, 2015, NULL, NULL, 1),
(112, '21205', 'D55705', '03473-415-21', 13, 37, 2015, NULL, NULL, 1),
(113, '21206', 'D55706', '03472-415-21', 13, 37, 2015, NULL, NULL, 1),
(114, '21207', 'D55738', '05120-415-21', 13, 37, 2015, NULL, NULL, 1),
(115, '21208', 'D55739', '05118-415-21', 13, 37, 2015, NULL, NULL, 1),
(116, '19201', 'D55677', '13603-415-19', 13, 37, 2015, NULL, NULL, 1),
(117, '19207', 'D55686', '15284-415-19', 13, 37, 2015, NULL, NULL, 1),
(118, '19208', 'D55687', '15306-415-19', 13, 37, 2015, NULL, NULL, 1),
(119, '7201', 'D55681', '00022-415-07', 13, 33, 2015, NULL, NULL, 1),
(120, '7202', 'D55682', '00023-415-07', 13, 33, 2015, NULL, NULL, 1),
(121, '7203', 'D55683', '00021-415-07', 13, 33, 2015, NULL, NULL, 1),
(122, '7204', 'D55688', '00030-415-07', 13, 33, 2015, NULL, NULL, 1),
(123, '7205', 'D55689', '00031-415-07', 13, 33, 2015, NULL, NULL, 1),
(124, '7206', 'D55704', '00020-415-07', 13, 33, 2015, NULL, NULL, 1),
(125, '7207', 'D55735', '00029-415-07', 13, 33, 2015, NULL, NULL, 1),
(126, '7208', 'D55736', '00028-415-07', 13, 33, 2015, NULL, NULL, 1),
(127, '7209', 'D55737', '00032-415-07', 13, 33, 2015, NULL, NULL, 1),
(128, '19210', 'D55743', '15304-415-19', 14, 33, 2015, NULL, NULL, 1),
(129, '21209', 'D55745', '05122-415-21', 14, 37, 2015, NULL, NULL, 1),
(130, '21210', 'D55746', '05121-415-21', 14, 37, 2015, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `wilayas`
--

CREATE TABLE `wilayas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wilayas`
--

INSERT INTO `wilayas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Adrar', NULL, NULL),
(2, 'Chlef', NULL, NULL),
(3, 'Laghouat', NULL, NULL),
(4, 'Oum El Bouaghi', NULL, NULL),
(5, 'Batna', NULL, NULL),
(6, 'Bejaia', NULL, NULL),
(7, 'Biskra', NULL, NULL),
(8, 'Bechar', NULL, NULL),
(9, 'Blida', NULL, NULL),
(10, 'Bouira', NULL, NULL),
(11, 'Tamanrasset', NULL, NULL),
(12, 'Tebessa', NULL, NULL),
(13, 'Tlemcen', NULL, NULL),
(14, 'Tiaret', NULL, NULL),
(15, 'Tizi Ouzou', NULL, NULL),
(16, 'Alger', NULL, NULL),
(17, 'Djelfa', NULL, NULL),
(18, 'Jijel', NULL, NULL),
(19, 'Setif', NULL, NULL),
(20, 'Saida', NULL, NULL),
(21, 'Skikda', NULL, NULL),
(22, 'Sidi Bel Abbes', NULL, NULL),
(23, 'Annaba', NULL, NULL),
(24, 'Guelma', NULL, NULL),
(25, 'Constantine', NULL, NULL),
(26, 'Medea', NULL, NULL),
(27, 'Mostaganem', NULL, NULL),
(28, 'M\'Sila', NULL, NULL),
(29, 'Mascara', NULL, NULL),
(30, 'Ouargla', NULL, NULL),
(31, 'Oran', NULL, NULL),
(32, 'El Bayadh', NULL, NULL),
(33, 'Illizi', NULL, NULL),
(34, 'Bordj Bou Arreridj', NULL, NULL),
(35, 'Boumerdes', NULL, NULL),
(36, 'El Tarf', NULL, NULL),
(37, 'Tindouf', NULL, NULL),
(38, 'Tissemsilt', NULL, NULL),
(39, 'El Oued', NULL, NULL),
(40, 'Khenchela', NULL, NULL),
(41, 'Souk Ahras', NULL, NULL),
(42, 'Tipaza', NULL, NULL),
(43, 'Mila', NULL, NULL),
(44, 'Ain Defla', NULL, NULL),
(45, 'Naama', NULL, NULL),
(46, 'Ain Timouchent', NULL, NULL),
(47, 'Ghardaia', NULL, NULL),
(48, 'Relizane', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alimentation_cuves`
--
ALTER TABLE `alimentation_cuves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alimentation_cuves_cuve_id_foreign` (`cuve_id`),
  ADD KEY `alimentation_cuves_user_id_foreign` (`user_id`),
  ADD KEY `alimentation_cuves_fournisseur_id_foreign` (`fournisseur_id`);

--
-- Index pour la table `cuves`
--
ALTER TABLE `cuves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuves_unite_id_foreign` (`unite_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gasoils`
--
ALTER TABLE `gasoils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gasoils_kilometrage_id_foreign` (`kilometrage_id`),
  ADD KEY `gasoils_fournisseur_id_foreign` (`fournisseur_id`),
  ADD KEY `gasoils_cuve_id_foreign` (`cuve_id`);

--
-- Index pour la table `kilometrages`
--
ALTER TABLE `kilometrages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kilometrages_user_id_foreign` (`user_id`),
  ADD KEY `kilometrages_vehicule_id_foreign` (`vehicule_id`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `marques_user_id_foreign` (`user_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modeles`
--
ALTER TABLE `modeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modeles_marque_id_foreign` (`marque_id`),
  ADD KEY `modeles_user_id_foreign` (`user_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `unites`
--
ALTER TABLE `unites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unites_wilaya_id_foreign` (`wilaya_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_unite_id_foreign` (`unite_id`);

--
-- Index pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicules_unite_id_foreign` (`unite_id`),
  ADD KEY `vehicules_user_id_foreign` (`user_id`),
  ADD KEY `vehicules_modele_id_foreign` (`modele_id`);

--
-- Index pour la table `wilayas`
--
ALTER TABLE `wilayas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alimentation_cuves`
--
ALTER TABLE `alimentation_cuves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `cuves`
--
ALTER TABLE `cuves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `gasoils`
--
ALTER TABLE `gasoils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `kilometrages`
--
ALTER TABLE `kilometrages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `modeles`
--
ALTER TABLE `modeles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `unites`
--
ALTER TABLE `unites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3727;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19204;

--
-- AUTO_INCREMENT pour la table `wilayas`
--
ALTER TABLE `wilayas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alimentation_cuves`
--
ALTER TABLE `alimentation_cuves`
  ADD CONSTRAINT `alimentation_cuves_cuve_id_foreign` FOREIGN KEY (`cuve_id`) REFERENCES `cuves` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alimentation_cuves_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alimentation_cuves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cuves`
--
ALTER TABLE `cuves`
  ADD CONSTRAINT `cuves_unite_id_foreign` FOREIGN KEY (`unite_id`) REFERENCES `unites` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gasoils`
--
ALTER TABLE `gasoils`
  ADD CONSTRAINT `gasoils_cuve_id_foreign` FOREIGN KEY (`cuve_id`) REFERENCES `cuves` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gasoils_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gasoils_kilometrage_id_foreign` FOREIGN KEY (`kilometrage_id`) REFERENCES `kilometrages` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `kilometrages`
--
ALTER TABLE `kilometrages`
  ADD CONSTRAINT `kilometrages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kilometrages_vehicule_id_foreign` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicules` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `marques`
--
ALTER TABLE `marques`
  ADD CONSTRAINT `marques_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `modeles`
--
ALTER TABLE `modeles`
  ADD CONSTRAINT `modeles_marque_id_foreign` FOREIGN KEY (`marque_id`) REFERENCES `marques` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modeles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `unites`
--
ALTER TABLE `unites`
  ADD CONSTRAINT `unites_wilaya_id_foreign` FOREIGN KEY (`wilaya_id`) REFERENCES `wilayas` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_unite_id_foreign` FOREIGN KEY (`unite_id`) REFERENCES `unites` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `vehicules_modele_id_foreign` FOREIGN KEY (`modele_id`) REFERENCES `modeles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicules_unite_id_foreign` FOREIGN KEY (`unite_id`) REFERENCES `unites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
