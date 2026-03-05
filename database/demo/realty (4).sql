-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2026 at 06:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realty`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(120) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'pBWueXnJC9BVEDXuCJAPpDbioJpwmEK6', 1, '2026-01-24 01:53:51', '2026-01-24 01:53:51', '2026-01-24 01:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `action_label` varchar(191) DEFAULT NULL,
  `action_url` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'admin@realty.com', '$2y$10$iSxs5panjCLNC0xp3al.Ieo5DwZr2mszMQQCIlzKunC8y3b4d20q.', '2026-02-17 05:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `expired_at` datetime DEFAULT NULL,
  `location` varchar(120) DEFAULT NULL,
  `key` varchar(120) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `clicked` bigint(20) NOT NULL DEFAULT 0,
  `order` int(11) DEFAULT 0,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT 1,
  `tablet_image` varchar(191) DEFAULT NULL,
  `mobile_image` varchar(191) DEFAULT NULL,
  `ads_type` varchar(191) DEFAULT NULL,
  `google_adsense_slot_id` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads_translations`
--

CREATE TABLE `ads_translations` (
  `lang_code` varchar(191) NOT NULL,
  `ads_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `tablet_image` varchar(191) DEFAULT NULL,
  `mobile_image` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `has_action` tinyint(1) NOT NULL DEFAULT 0,
  `action_label` varchar(60) DEFAULT NULL,
  `action_url` varchar(400) DEFAULT NULL,
  `action_open_new_tab` tinyint(1) NOT NULL DEFAULT 0,
  `dismissible` tinyint(1) NOT NULL DEFAULT 0,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `name`, `content`, `has_action`, `action_label`, `action_url`, `action_open_new_tab`, `dismissible`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Announcement 1', 'Explore Our Exciting New Property Listings Now Available in Prime Locations!', 0, NULL, NULL, 0, 1, '2026-01-24 08:54:10', NULL, 1, '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(2, 'Announcement 2', 'Join Us for Exclusive Open House Events This Weekend and Find Your Perfect Home!', 0, NULL, NULL, 0, 1, '2026-01-24 08:54:10', NULL, 1, '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(3, 'Announcement 3', 'Take Advantage of Limited-Time Offers on Luxury Homes with Stunning Features!', 0, NULL, NULL, 0, 1, '2026-01-24 08:54:10', NULL, 1, '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(4, 'Announcement 4', 'Discover Your Dream Home with Our Latest Listings and Personalized Services!', 0, NULL, NULL, 0, 1, '2026-01-24 08:54:10', NULL, 1, '2026-01-24 01:54:10', '2026-01-24 01:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `announcements_translations`
--

CREATE TABLE `announcements_translations` (
  `lang_code` varchar(191) NOT NULL,
  `announcements_id` bigint(20) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `action_label` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `image_url` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `image_url`, `active`, `created_at`) VALUES
(1, 'https://ik.imagekit.io/area24onestorage/assets/pexels-boonkong-boonpeng-442952-1134176_iKFLim281-.jpg', 1, '2026-02-21 06:59:17'),
(2, 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png', 1, '2026-02-21 07:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `audit_histories`
--

CREATE TABLE `audit_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) DEFAULT 'Botble\\ACL\\Models\\User',
  `module` varchar(60) NOT NULL,
  `request` longtext DEFAULT NULL,
  `action` varchar(120) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `actor_id` bigint(20) UNSIGNED NOT NULL,
  `actor_type` varchar(191) DEFAULT 'Botble\\ACL\\Models\\User',
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `reference_name` varchar(191) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_histories`
--

INSERT INTO `audit_histories` (`id`, `user_id`, `user_type`, `module`, `request`, `action`, `user_agent`, `ip_address`, `actor_id`, `actor_type`, `reference_id`, `reference_name`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Botble\\ACL\\Models\\User', 'to the system', NULL, 'logged in', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '127.0.0.1', 1, 'Botble\\ACL\\Models\\User', 1, 'System Admin', 'info', '2026-02-16 00:39:49', '2026-02-16 00:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `location` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `name`, `location`, `salary`, `description`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Senior Full Stack Engineer, Creator Success Full Time', 'San Francisco, United States', '$90,000 - $130,000', 'Lead development of innovative real estate solutions using modern technologies', '<h4 class=\"color-brand-1\">Responsibilities</h4>\n<p>Product knowledge: Deeply understand the technology and features of the product area to which you are assigned.</p>\n<p>Research: Provide human and business impact and insights for products.</p>\n<p>Deliverables: Create deliverables for your product area (for example competitive analyses, user flows, low fidelity wireframes, high fidelity mockups, prototypes, etc.) that solve real user problems through the user experience.</p>\n<p>Communication: Communicate the results of UX activities within your product area to the design team department, cross-functional partners within your product area, and other interested Superformula team members using clear language that simplifies complexity.</p>\n<h4 class=\"color-brand-1\">Requirements</h4>\n<ul>\n    <li>A portfolio demonstrating well thought through and polished end to end customer journeys</li>\n    <li>5+ years of industry experience in interactive design and / or visual design</li>\n    <li>Excellent interpersonal skills </li>\n    <li>Aware of trends in mobile, communications, and collaboration</li>\n    <li>Ability to create highly polished design prototypes, mockups, and other communication artifacts</li>\n    <li>The ability to scope and estimate efforts accurately and prioritize tasks and goals independently</li>\n    <li>History of impacting shipping products with your work</li>\n    <li>A Bachelor’s Degree in Design (or related field) or equivalent professional experience</li>\n    <li>Proficiency in a variety of design tools such as Figma, Photoshop, Illustrator, and Sketch</li>\n</ul>\n<h4 class=\"color-brand-1\">What\'s on Offer </h4>\n<ul>\n    <li>Annual bonus and holidays, social welfare, and health checks.</li>\n    <li>Training and attachment in Taiwan and other Greater China branches.</li>\n</ul>\n', 'published', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(2, 'Data Science Specialist, Analytics Division', 'New York, United States', '$90,000 - $130,000', 'Drive data-driven decisions through advanced analytics and machine learning models', '<h4 class=\"color-brand-1\">Responsibilities</h4>\n<p>Product knowledge: Deeply understand the technology and features of the product area to which you are assigned.</p>\n<p>Research: Provide human and business impact and insights for products.</p>\n<p>Deliverables: Create deliverables for your product area (for example competitive analyses, user flows, low fidelity wireframes, high fidelity mockups, prototypes, etc.) that solve real user problems through the user experience.</p>\n<p>Communication: Communicate the results of UX activities within your product area to the design team department, cross-functional partners within your product area, and other interested Superformula team members using clear language that simplifies complexity.</p>\n<h4 class=\"color-brand-1\">Requirements</h4>\n<ul>\n    <li>A portfolio demonstrating well thought through and polished end to end customer journeys</li>\n    <li>5+ years of industry experience in interactive design and / or visual design</li>\n    <li>Excellent interpersonal skills </li>\n    <li>Aware of trends in mobile, communications, and collaboration</li>\n    <li>Ability to create highly polished design prototypes, mockups, and other communication artifacts</li>\n    <li>The ability to scope and estimate efforts accurately and prioritize tasks and goals independently</li>\n    <li>History of impacting shipping products with your work</li>\n    <li>A Bachelor’s Degree in Design (or related field) or equivalent professional experience</li>\n    <li>Proficiency in a variety of design tools such as Figma, Photoshop, Illustrator, and Sketch</li>\n</ul>\n<h4 class=\"color-brand-1\">What\'s on Offer </h4>\n<ul>\n    <li>Annual bonus and holidays, social welfare, and health checks.</li>\n    <li>Training and attachment in Taiwan and other Greater China branches.</li>\n</ul>\n', 'published', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(3, 'Product Marketing Manager, Growth Team', 'Los Angeles, United States', '$60,000 - $90,000', 'Craft compelling marketing strategies to drive user acquisition and brand growth', '<h4 class=\"color-brand-1\">Responsibilities</h4>\n<p>Product knowledge: Deeply understand the technology and features of the product area to which you are assigned.</p>\n<p>Research: Provide human and business impact and insights for products.</p>\n<p>Deliverables: Create deliverables for your product area (for example competitive analyses, user flows, low fidelity wireframes, high fidelity mockups, prototypes, etc.) that solve real user problems through the user experience.</p>\n<p>Communication: Communicate the results of UX activities within your product area to the design team department, cross-functional partners within your product area, and other interested Superformula team members using clear language that simplifies complexity.</p>\n<h4 class=\"color-brand-1\">Requirements</h4>\n<ul>\n    <li>A portfolio demonstrating well thought through and polished end to end customer journeys</li>\n    <li>5+ years of industry experience in interactive design and / or visual design</li>\n    <li>Excellent interpersonal skills </li>\n    <li>Aware of trends in mobile, communications, and collaboration</li>\n    <li>Ability to create highly polished design prototypes, mockups, and other communication artifacts</li>\n    <li>The ability to scope and estimate efforts accurately and prioritize tasks and goals independently</li>\n    <li>History of impacting shipping products with your work</li>\n    <li>A Bachelor’s Degree in Design (or related field) or equivalent professional experience</li>\n    <li>Proficiency in a variety of design tools such as Figma, Photoshop, Illustrator, and Sketch</li>\n</ul>\n<h4 class=\"color-brand-1\">What\'s on Offer </h4>\n<ul>\n    <li>Annual bonus and holidays, social welfare, and health checks.</li>\n    <li>Training and attachment in Taiwan and other Greater China branches.</li>\n</ul>\n', 'published', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(4, 'UX/UI Designer, User Experience Team', 'Seattle, United States', '$90,000 - $130,000', 'Design intuitive user interfaces that deliver exceptional customer experiences', '<h4 class=\"color-brand-1\">Responsibilities</h4>\n<p>Product knowledge: Deeply understand the technology and features of the product area to which you are assigned.</p>\n<p>Research: Provide human and business impact and insights for products.</p>\n<p>Deliverables: Create deliverables for your product area (for example competitive analyses, user flows, low fidelity wireframes, high fidelity mockups, prototypes, etc.) that solve real user problems through the user experience.</p>\n<p>Communication: Communicate the results of UX activities within your product area to the design team department, cross-functional partners within your product area, and other interested Superformula team members using clear language that simplifies complexity.</p>\n<h4 class=\"color-brand-1\">Requirements</h4>\n<ul>\n    <li>A portfolio demonstrating well thought through and polished end to end customer journeys</li>\n    <li>5+ years of industry experience in interactive design and / or visual design</li>\n    <li>Excellent interpersonal skills </li>\n    <li>Aware of trends in mobile, communications, and collaboration</li>\n    <li>Ability to create highly polished design prototypes, mockups, and other communication artifacts</li>\n    <li>The ability to scope and estimate efforts accurately and prioritize tasks and goals independently</li>\n    <li>History of impacting shipping products with your work</li>\n    <li>A Bachelor’s Degree in Design (or related field) or equivalent professional experience</li>\n    <li>Proficiency in a variety of design tools such as Figma, Photoshop, Illustrator, and Sketch</li>\n</ul>\n<h4 class=\"color-brand-1\">What\'s on Offer </h4>\n<ul>\n    <li>Annual bonus and holidays, social welfare, and health checks.</li>\n    <li>Training and attachment in Taiwan and other Greater China branches.</li>\n</ul>\n', 'published', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(5, 'Operations Manager, Supply Chain Division', 'Chicago, United States', '$100,000 - $150,000', 'Optimize operational workflows and ensure seamless business processes', '<h4 class=\"color-brand-1\">Responsibilities</h4>\n<p>Product knowledge: Deeply understand the technology and features of the product area to which you are assigned.</p>\n<p>Research: Provide human and business impact and insights for products.</p>\n<p>Deliverables: Create deliverables for your product area (for example competitive analyses, user flows, low fidelity wireframes, high fidelity mockups, prototypes, etc.) that solve real user problems through the user experience.</p>\n<p>Communication: Communicate the results of UX activities within your product area to the design team department, cross-functional partners within your product area, and other interested Superformula team members using clear language that simplifies complexity.</p>\n<h4 class=\"color-brand-1\">Requirements</h4>\n<ul>\n    <li>A portfolio demonstrating well thought through and polished end to end customer journeys</li>\n    <li>5+ years of industry experience in interactive design and / or visual design</li>\n    <li>Excellent interpersonal skills </li>\n    <li>Aware of trends in mobile, communications, and collaboration</li>\n    <li>Ability to create highly polished design prototypes, mockups, and other communication artifacts</li>\n    <li>The ability to scope and estimate efforts accurately and prioritize tasks and goals independently</li>\n    <li>History of impacting shipping products with your work</li>\n    <li>A Bachelor’s Degree in Design (or related field) or equivalent professional experience</li>\n    <li>Proficiency in a variety of design tools such as Figma, Photoshop, Illustrator, and Sketch</li>\n</ul>\n<h4 class=\"color-brand-1\">What\'s on Offer </h4>\n<ul>\n    <li>Annual bonus and holidays, social welfare, and health checks.</li>\n    <li>Training and attachment in Taiwan and other Greater China branches.</li>\n</ul>\n', 'published', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(6, 'Financial Analyst, Investment Group', 'Boston, United States', '$60,000 - $90,000', 'Analyze market trends and investment opportunities for strategic decision-making', '<h4 class=\"color-brand-1\">Responsibilities</h4>\n<p>Product knowledge: Deeply understand the technology and features of the product area to which you are assigned.</p>\n<p>Research: Provide human and business impact and insights for products.</p>\n<p>Deliverables: Create deliverables for your product area (for example competitive analyses, user flows, low fidelity wireframes, high fidelity mockups, prototypes, etc.) that solve real user problems through the user experience.</p>\n<p>Communication: Communicate the results of UX activities within your product area to the design team department, cross-functional partners within your product area, and other interested Superformula team members using clear language that simplifies complexity.</p>\n<h4 class=\"color-brand-1\">Requirements</h4>\n<ul>\n    <li>A portfolio demonstrating well thought through and polished end to end customer journeys</li>\n    <li>5+ years of industry experience in interactive design and / or visual design</li>\n    <li>Excellent interpersonal skills </li>\n    <li>Aware of trends in mobile, communications, and collaboration</li>\n    <li>Ability to create highly polished design prototypes, mockups, and other communication artifacts</li>\n    <li>The ability to scope and estimate efforts accurately and prioritize tasks and goals independently</li>\n    <li>History of impacting shipping products with your work</li>\n    <li>A Bachelor’s Degree in Design (or related field) or equivalent professional experience</li>\n    <li>Proficiency in a variety of design tools such as Figma, Photoshop, Illustrator, and Sketch</li>\n</ul>\n<h4 class=\"color-brand-1\">What\'s on Offer </h4>\n<ul>\n    <li>Annual bonus and holidays, social welfare, and health checks.</li>\n    <li>Training and attachment in Taiwan and other Greater China branches.</li>\n</ul>\n', 'published', '2026-01-24 01:54:10', '2026-01-24 01:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `careers_translations`
--

CREATE TABLE `careers_translations` (
  `lang_code` varchar(191) NOT NULL,
  `careers_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `description` varchar(400) DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_type` varchar(191) NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `icon` varchar(60) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `description`, `status`, `author_id`, `author_type`, `icon`, `order`, `is_featured`, `is_default`, `created_at`, `updated_at`) VALUES
(7, 'test category', 0, '-', 'published', NULL, 'Botble\\ACL\\Models\\User', NULL, 0, 1, 0, '2026-02-21 09:54:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories_translations`
--

CREATE TABLE `categories_translations` (
  `lang_code` varchar(20) NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_id` varchar(40) DEFAULT NULL,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `slug`, `state_id`, `country_id`, `record_id`, `order`, `image`, `is_default`, `status`, `created_at`, `updated_at`, `zip_code`, `latitude`, `longitude`) VALUES
(31, 'Bengaluru', 'bengaluru', 11, 12, NULL, 1, NULL, 0, 'published', '2026-02-17 09:50:00', NULL, '560001', '12.976794', '77.590082'),
(33, 'Chennai', 'chennai', 33, 12, NULL, 2, NULL, 0, 'published', '2026-02-17 09:56:11', NULL, '600001', '13.083694', '80.270186');

-- --------------------------------------------------------

--
-- Table structure for table `cities_translations`
--

CREATE TABLE `cities_translations` (
  `lang_code` varchar(20) NOT NULL,
  `cities_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `slug` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `subject` varchar(120) DEFAULT NULL,
  `content` longtext NOT NULL,
  `custom_fields` text DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_custom_fields`
--

CREATE TABLE `contact_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `placeholder` varchar(191) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 999,
  `status` varchar(191) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_custom_fields_translations`
--

CREATE TABLE `contact_custom_fields_translations` (
  `contact_custom_fields_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(191) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `placeholder` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_custom_field_options`
--

CREATE TABLE `contact_custom_field_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_field_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) DEFAULT NULL,
  `value` varchar(191) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 999,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_custom_field_options_translations`
--

CREATE TABLE `contact_custom_field_options_translations` (
  `contact_custom_field_options_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(191) NOT NULL,
  `label` varchar(191) DEFAULT NULL,
  `value` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_replies`
--

CREATE TABLE `contact_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `nationality` varchar(120) DEFAULT NULL,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `nationality`, `order`, `image`, `is_default`, `status`, `created_at`, `updated_at`, `code`) VALUES
(12, 'India', NULL, 0, NULL, 0, 'published', '2026-02-17 06:56:22', NULL, 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `countries_translations`
--

CREATE TABLE `countries_translations` (
  `lang_code` varchar(20) NOT NULL,
  `countries_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `nationality` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_widgets`
--

CREATE TABLE `dashboard_widgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard_widgets`
--

INSERT INTO `dashboard_widgets` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'widget_total_1', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(2, 'widget_total_2', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(3, 'widget_total_3', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(4, 'widget_total_4', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(5, 'widget_total_themes', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(6, 'widget_total_users', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(7, 'widget_total_plugins', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(8, 'widget_total_pages', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(9, 'widget_posts_recent', '2026-02-16 00:39:51', '2026-02-16 00:39:51'),
(10, 'widget_audit_logs', '2026-02-16 00:39:53', '2026-02-16 00:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_widget_settings`
--

CREATE TABLE `dashboard_widget_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `settings` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `widget_id` bigint(20) UNSIGNED NOT NULL,
  `order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(191) NOT NULL,
  `platform` varchar(191) DEFAULT NULL,
  `app_version` varchar(191) DEFAULT NULL,
  `device_id` varchar(191) DEFAULT NULL,
  `user_type` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What steps are involved in buying a home?', 'The home buying process involves several steps including getting pre-approved for a mortgage, finding a real estate agent, searching for homes, making an offer, getting a home inspection, and closing the deal.', 1, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(2, 'What is the process of selling a home?', 'Selling a home involves preparing your home for sale, setting a competitive price, marketing the property, showing the home to potential buyers, negotiating offers, and closing the sale.', 1, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(3, 'How can I increase the value of my home before selling?', 'You can increase your home\'s value by making necessary repairs, updating outdated features, improving curb appeal, and ensuring the home is clean and well-maintained.', 1, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(4, 'What should I look for in a rental property?', 'When looking for a rental property, consider factors such as location, rent price, amenities, lease terms, and the condition of the property. It\'s also important to understand your rights as a tenant.', 1, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(5, 'What are the benefits of renting versus buying?', 'Renting offers flexibility and fewer maintenance responsibilities, while buying can provide long-term financial benefits and the freedom to customize your home. The decision depends on your financial situation, lifestyle, and future plans.', 1, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(6, 'How do I improve my credit score for a mortgage?', 'To improve your credit score, pay your bills on time, reduce your debt, avoid opening new credit accounts, and check your credit report for errors.', 1, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(7, 'What steps are involved in buying a home?', 'The home buying process involves several steps including getting pre-approved for a mortgage, finding a real estate agent, searching for homes, making an offer, getting a home inspection, and closing the deal.', 2, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(8, 'How do I determine my budget for buying a home?', 'To determine your budget, consider your income, debts, and savings. It is also important to get pre-approved for a mortgage to understand how much you can borrow.', 2, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(9, 'How can I increase the value of my home before selling?', 'You can increase your home\'s value by making necessary repairs, updating outdated features, improving curb appeal, and ensuring the home is clean and well-maintained.', 2, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(10, 'What should I look for in a rental property?', 'When looking for a rental property, consider factors such as location, rent price, amenities, lease terms, and the condition of the property. It\'s also important to understand your rights as a tenant.', 2, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(11, 'What are the benefits of renting versus buying?', 'Renting offers flexibility and fewer maintenance responsibilities, while buying can provide long-term financial benefits and the freedom to customize your home. The decision depends on your financial situation, lifestyle, and future plans.', 2, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(12, 'What types of financing options are available for homebuyers?', 'Common financing options include fixed-rate mortgages, adjustable-rate mortgages, FHA loans, VA loans, and USDA loans. Each has its own requirements and benefits.', 2, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(13, 'What steps are involved in buying a home?', 'The home buying process involves several steps including getting pre-approved for a mortgage, finding a real estate agent, searching for homes, making an offer, getting a home inspection, and closing the deal.', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(14, 'How do I determine my budget for buying a home?', 'To determine your budget, consider your income, debts, and savings. It is also important to get pre-approved for a mortgage to understand how much you can borrow.', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(15, 'What is the process of selling a home?', 'Selling a home involves preparing your home for sale, setting a competitive price, marketing the property, showing the home to potential buyers, negotiating offers, and closing the sale.', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(16, 'How can I increase the value of my home before selling?', 'You can increase your home\'s value by making necessary repairs, updating outdated features, improving curb appeal, and ensuring the home is clean and well-maintained.', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(17, 'What should I look for in a rental property?', 'When looking for a rental property, consider factors such as location, rent price, amenities, lease terms, and the condition of the property. It\'s also important to understand your rights as a tenant.', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(18, 'What are the benefits of renting versus buying?', 'Renting offers flexibility and fewer maintenance responsibilities, while buying can provide long-term financial benefits and the freedom to customize your home. The decision depends on your financial situation, lifestyle, and future plans.', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(19, 'How do I improve my credit score for a mortgage?', 'To improve your credit score, pay your bills on time, reduce your debt, avoid opening new credit accounts, and check your credit report for errors.', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(20, 'What steps are involved in buying a home?', 'The home buying process involves several steps including getting pre-approved for a mortgage, finding a real estate agent, searching for homes, making an offer, getting a home inspection, and closing the deal.', 4, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(21, 'How do I determine my budget for buying a home?', 'To determine your budget, consider your income, debts, and savings. It is also important to get pre-approved for a mortgage to understand how much you can borrow.', 4, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(22, 'What is the process of selling a home?', 'Selling a home involves preparing your home for sale, setting a competitive price, marketing the property, showing the home to potential buyers, negotiating offers, and closing the sale.', 4, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(23, 'How can I increase the value of my home before selling?', 'You can increase your home\'s value by making necessary repairs, updating outdated features, improving curb appeal, and ensuring the home is clean and well-maintained.', 4, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(24, 'What should I look for in a rental property?', 'When looking for a rental property, consider factors such as location, rent price, amenities, lease terms, and the condition of the property. It\'s also important to understand your rights as a tenant.', 4, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(25, 'What are the benefits of renting versus buying?', 'Renting offers flexibility and fewer maintenance responsibilities, while buying can provide long-term financial benefits and the freedom to customize your home. The decision depends on your financial situation, lifestyle, and future plans.', 4, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48'),
(26, 'How do I improve my credit score for a mortgage?', 'To improve your credit score, pay your bills on time, reduce your debt, avoid opening new credit accounts, and check your credit report for errors.', 4, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `faqs_translations`
--

CREATE TABLE `faqs_translations` (
  `lang_code` varchar(20) NOT NULL,
  `faqs_id` bigint(20) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`, `order`, `status`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Buying', 0, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48', NULL),
(2, 'Selling', 1, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48', NULL),
(3, 'Renting', 2, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48', NULL),
(4, 'Financing', 3, 'published', '2026-01-24 01:53:48', '2026-01-24 01:53:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories_translations`
--

CREATE TABLE `faq_categories_translations` (
  `lang_code` varchar(20) NOT NULL,
  `faq_categories_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` int(11) NOT NULL,
  `banner_image` text DEFAULT NULL,
  `mobile_banner` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero_sections`
--

INSERT INTO `hero_sections` (`id`, `banner_image`, `mobile_banner`, `active`, `created_at`) VALUES
(14, 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER_2__3__Wrw8JGKV2.png', 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER_mobile_view__1__7yjnIWhJZ.png', 1, '2026-02-26 05:50:39'),
(15, 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER_6_IkKPK5-02.png', 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER_mobile_view_4_mXzZ7afJF.png', 1, '2026-02-26 10:26:51'),
(16, 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER1_W6vYhXcOD1.png', 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER_mobile_view_5_XsA5ZSepS.png', 1, '2026-02-26 10:37:50'),
(17, 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER_3__2__65-29sJnY.png', 'https://ik.imagekit.io/area24onestorage/hero_sections/AREA24_REALTY_BANNER_mobile_view_6_iT-1hB2wG.png', 1, '2026-02-26 11:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `lang_name` varchar(120) NOT NULL,
  `lang_locale` varchar(20) NOT NULL,
  `lang_code` varchar(20) NOT NULL,
  `lang_flag` varchar(20) DEFAULT NULL,
  `lang_is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `lang_order` int(11) NOT NULL DEFAULT 0,
  `lang_is_rtl` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`lang_id`, `lang_name`, `lang_locale`, `lang_code`, `lang_flag`, `lang_is_default`, `lang_order`, `lang_is_rtl`) VALUES
(1, 'English', 'en', 'en_US', 'us', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language_meta`
--

CREATE TABLE `language_meta` (
  `lang_meta_id` bigint(20) UNSIGNED NOT NULL,
  `lang_meta_code` varchar(20) DEFAULT NULL,
  `lang_meta_origin` varchar(32) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language_meta`
--

INSERT INTO `language_meta` (`lang_meta_id`, `lang_meta_code`, `lang_meta_origin`, `reference_id`, `reference_type`) VALUES
(1, 'en_US', '96236a04f48463dcc41b3019bf825774', 1, 'Botble\\Menu\\Models\\MenuLocation'),
(2, 'en_US', 'c5d616664e03d2a1a3a9c42bbc16c700', 1, 'Botble\\Menu\\Models\\Menu');

-- --------------------------------------------------------

--
-- Table structure for table `media_files`
--

CREATE TABLE `media_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `alt` varchar(191) DEFAULT NULL,
  `folder_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `mime_type` varchar(120) NOT NULL,
  `size` int(11) NOT NULL,
  `url` varchar(191) NOT NULL,
  `options` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `visibility` varchar(191) NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_files`
--

INSERT INTO `media_files` (`id`, `user_id`, `name`, `alt`, `folder_id`, `mime_type`, `size`, `url`, `options`, `created_at`, `updated_at`, `deleted_at`, `visibility`) VALUES
(1, 0, '1', '1', 1, 'image/jpeg', 6977, 'locations/1.jpg', '[]', '2026-01-24 01:53:48', '2026-01-24 01:53:48', NULL, 'public'),
(2, 0, '10', '10', 1, 'image/jpeg', 6977, 'locations/10.jpg', '[]', '2026-01-24 01:53:48', '2026-01-24 01:53:48', NULL, 'public'),
(3, 0, '11', '11', 1, 'image/jpeg', 6977, 'locations/11.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(4, 0, '2', '2', 1, 'image/jpeg', 6977, 'locations/2.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(5, 0, '3', '3', 1, 'image/jpeg', 6977, 'locations/3.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(6, 0, '4', '4', 1, 'image/jpeg', 6977, 'locations/4.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(7, 0, '5', '5', 1, 'image/jpeg', 6977, 'locations/5.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(8, 0, '6', '6', 1, 'image/jpeg', 6977, 'locations/6.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(9, 0, '7', '7', 1, 'image/jpeg', 6977, 'locations/7.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(10, 0, '8', '8', 1, 'image/jpeg', 6977, 'locations/8.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(11, 0, '9', '9', 1, 'image/jpeg', 6977, 'locations/9.jpg', '[]', '2026-01-24 01:53:49', '2026-01-24 01:53:49', NULL, 'public'),
(12, 0, '1', '1', 2, 'image/jpeg', 71367, 'users/1.jpg', '[]', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, 'public'),
(13, 0, '1', '1', 3, 'image/jpeg', 3916, 'avatars/1.jpg', '[]', '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL, 'public'),
(14, 0, '10', '10', 3, 'image/jpeg', 3916, 'avatars/10.jpg', '[]', '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL, 'public'),
(15, 0, '11', '11', 3, 'image/jpeg', 3916, 'avatars/11.jpg', '[]', '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL, 'public'),
(16, 0, '2', '2', 3, 'image/jpeg', 3916, 'avatars/2.jpg', '[]', '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL, 'public'),
(17, 0, '3', '3', 3, 'image/jpeg', 3916, 'avatars/3.jpg', '[]', '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL, 'public'),
(18, 0, '4', '4', 3, 'image/jpeg', 3916, 'avatars/4.jpg', '[]', '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL, 'public'),
(19, 0, '5', '5', 3, 'image/jpeg', 3916, 'avatars/5.jpg', '[]', '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL, 'public'),
(20, 0, '6', '6', 3, 'image/jpeg', 3916, 'avatars/6.jpg', '[]', '2026-01-24 01:53:52', '2026-01-24 01:53:52', NULL, 'public'),
(21, 0, '7', '7', 3, 'image/jpeg', 3916, 'avatars/7.jpg', '[]', '2026-01-24 01:53:52', '2026-01-24 01:53:52', NULL, 'public'),
(22, 0, '8', '8', 3, 'image/jpeg', 3916, 'avatars/8.jpg', '[]', '2026-01-24 01:53:52', '2026-01-24 01:53:52', NULL, 'public'),
(23, 0, '9', '9', 3, 'image/jpeg', 3916, 'avatars/9.jpg', '[]', '2026-01-24 01:53:52', '2026-01-24 01:53:52', NULL, 'public'),
(24, 0, '1', '1', 4, 'image/jpeg', 9803, 'properties/1.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(25, 0, '10', '10', 4, 'image/jpeg', 9803, 'properties/10.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(26, 0, '11', '11', 4, 'image/jpeg', 9803, 'properties/11.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(27, 0, '12', '12', 4, 'image/jpeg', 9803, 'properties/12.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(28, 0, '13', '13', 4, 'image/jpeg', 9803, 'properties/13.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(29, 0, '2', '2', 4, 'image/jpeg', 9803, 'properties/2.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(30, 0, '3', '3', 4, 'image/jpeg', 9803, 'properties/3.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(31, 0, '4', '4', 4, 'image/jpeg', 9803, 'properties/4.jpg', '[]', '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL, 'public'),
(32, 0, '5', '5', 4, 'image/jpeg', 9803, 'properties/5.jpg', '[]', '2026-01-24 01:53:58', '2026-01-24 01:53:58', NULL, 'public'),
(33, 0, '6', '6', 4, 'image/jpeg', 9803, 'properties/6.jpg', '[]', '2026-01-24 01:53:58', '2026-01-24 01:53:58', NULL, 'public'),
(34, 0, '7', '7', 4, 'image/jpeg', 9803, 'properties/7.jpg', '[]', '2026-01-24 01:53:58', '2026-01-24 01:53:58', NULL, 'public'),
(35, 0, '8', '8', 4, 'image/jpeg', 9803, 'properties/8.jpg', '[]', '2026-01-24 01:53:58', '2026-01-24 01:53:58', NULL, 'public'),
(36, 0, '9', '9', 4, 'image/jpeg', 9803, 'properties/9.jpg', '[]', '2026-01-24 01:53:58', '2026-01-24 01:53:58', NULL, 'public'),
(37, 0, 'floor', 'floor', 4, 'image/png', 9803, 'properties/floor.png', '[]', '2026-01-24 01:53:58', '2026-01-24 01:53:58', NULL, 'public'),
(38, 0, '1', '1', 5, 'image/jpeg', 9803, 'posts/1.jpg', '[]', '2026-01-24 01:54:01', '2026-01-24 01:54:01', NULL, 'public'),
(39, 0, '10', '10', 5, 'image/jpeg', 9803, 'posts/10.jpg', '[]', '2026-01-24 01:54:01', '2026-01-24 01:54:01', NULL, 'public'),
(40, 0, '2', '2', 5, 'image/jpeg', 9803, 'posts/2.jpg', '[]', '2026-01-24 01:54:01', '2026-01-24 01:54:01', NULL, 'public'),
(41, 0, '3', '3', 5, 'image/jpeg', 9803, 'posts/3.jpg', '[]', '2026-01-24 01:54:01', '2026-01-24 01:54:01', NULL, 'public'),
(42, 0, '4', '4', 5, 'image/jpeg', 9803, 'posts/4.jpg', '[]', '2026-01-24 01:54:01', '2026-01-24 01:54:01', NULL, 'public'),
(43, 0, '5', '5', 5, 'image/jpeg', 9803, 'posts/5.jpg', '[]', '2026-01-24 01:54:02', '2026-01-24 01:54:02', NULL, 'public'),
(44, 0, '6', '6', 5, 'image/jpeg', 9803, 'posts/6.jpg', '[]', '2026-01-24 01:54:02', '2026-01-24 01:54:02', NULL, 'public'),
(45, 0, '7', '7', 5, 'image/jpeg', 9803, 'posts/7.jpg', '[]', '2026-01-24 01:54:02', '2026-01-24 01:54:02', NULL, 'public'),
(46, 0, '8', '8', 5, 'image/jpeg', 9803, 'posts/8.jpg', '[]', '2026-01-24 01:54:02', '2026-01-24 01:54:02', NULL, 'public'),
(47, 0, '9', '9', 5, 'image/jpeg', 9803, 'posts/9.jpg', '[]', '2026-01-24 01:54:02', '2026-01-24 01:54:02', NULL, 'public'),
(48, 0, 'md-1', 'md-1', 5, 'image/jpeg', 9803, 'posts/md-1.jpg', '[]', '2026-01-24 01:54:02', '2026-01-24 01:54:02', NULL, 'public'),
(49, 0, 'md-2', 'md-2', 5, 'image/jpeg', 9803, 'posts/md-2.jpg', '[]', '2026-01-24 01:54:02', '2026-01-24 01:54:02', NULL, 'public'),
(50, 0, 'about-us-contact', 'about-us-contact', 6, 'image/jpeg', 19409, 'pages/about-us-contact.jpg', '[]', '2026-01-24 01:54:03', '2026-01-24 01:54:03', NULL, 'public'),
(51, 0, 'about-us-video', 'about-us-video', 6, 'image/jpeg', 16191, 'pages/about-us-video.jpg', '[]', '2026-01-24 01:54:03', '2026-01-24 01:54:03', NULL, 'public'),
(52, 0, 'call-to-action', 'call-to-action', 6, 'image/png', 9051, 'pages/call-to-action.png', '[]', '2026-01-24 01:54:03', '2026-01-24 01:54:03', NULL, 'public'),
(53, 0, 'house-service', 'house-service', 6, 'image/png', 10923, 'pages/house-service.png', '[]', '2026-01-24 01:54:03', '2026-01-24 01:54:03', NULL, 'public'),
(54, 0, 'properties', 'properties', 6, 'image/png', 16974, 'pages/properties.png', '[]', '2026-01-24 01:54:03', '2026-01-24 01:54:03', NULL, 'public'),
(55, 0, 'service-1', 'service-1', 6, 'image/png', 21898, 'pages/service-1.png', '[]', '2026-01-24 01:54:03', '2026-01-24 01:54:03', NULL, 'public'),
(56, 0, 'service-2', 'service-2', 6, 'image/png', 21279, 'pages/service-2.png', '[]', '2026-01-24 01:54:04', '2026-01-24 01:54:04', NULL, 'public'),
(57, 0, 'service-3', 'service-3', 6, 'image/png', 23965, 'pages/service-3.png', '[]', '2026-01-24 01:54:04', '2026-01-24 01:54:04', NULL, 'public'),
(58, 0, 'service-4', 'service-4', 6, 'image/png', 32050, 'pages/service-4.png', '[]', '2026-01-24 01:54:04', '2026-01-24 01:54:04', NULL, 'public'),
(59, 0, 'service-5', 'service-5', 6, 'image/png', 25146, 'pages/service-5.png', '[]', '2026-01-24 01:54:04', '2026-01-24 01:54:04', NULL, 'public'),
(60, 0, 'service-6', 'service-6', 6, 'image/png', 31763, 'pages/service-6.png', '[]', '2026-01-24 01:54:04', '2026-01-24 01:54:04', NULL, 'public'),
(61, 0, 'slider-1', 'slider-1', 6, 'image/jpeg', 27445, 'pages/slider-1.jpg', '[]', '2026-01-24 01:54:05', '2026-01-24 01:54:05', NULL, 'public'),
(62, 0, 'slider-2', 'slider-2', 6, 'image/jpeg', 23889, 'pages/slider-2.jpg', '[]', '2026-01-24 01:54:05', '2026-01-24 01:54:05', NULL, 'public'),
(63, 0, 'slider-3', 'slider-3', 6, 'image/jpeg', 23889, 'pages/slider-3.jpg', '[]', '2026-01-24 01:54:05', '2026-01-24 01:54:05', NULL, 'public'),
(64, 0, 'slider-4', 'slider-4', 6, 'image/jpeg', 23889, 'pages/slider-4.jpg', '[]', '2026-01-24 01:54:06', '2026-01-24 01:54:06', NULL, 'public'),
(65, 0, 'slider-5', 'slider-5', 6, 'image/jpeg', 23889, 'pages/slider-5.jpg', '[]', '2026-01-24 01:54:06', '2026-01-24 01:54:06', NULL, 'public'),
(66, 0, 'slider-6', 'slider-6', 6, 'image/png', 33637, 'pages/slider-6.png', '[]', '2026-01-24 01:54:06', '2026-01-24 01:54:06', NULL, 'public'),
(67, 0, 'slider-left', 'slider-left', 6, 'image/jpeg', 11483, 'pages/slider-left.jpg', '[]', '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL, 'public'),
(68, 0, 'testimonial-banner', 'testimonial-banner', 6, 'image/png', 13232, 'pages/testimonial-banner.png', '[]', '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL, 'public'),
(69, 0, 'asana', 'asana', 7, 'image/png', 3510, 'partners/asana.png', '[]', '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL, 'public'),
(70, 0, 'github', 'github', 7, 'image/png', 3510, 'partners/github.png', '[]', '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL, 'public'),
(71, 0, 'lhtech', 'lhtech', 7, 'image/png', 3510, 'partners/lhtech.png', '[]', '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL, 'public'),
(72, 0, 'panadoxn', 'panadoxn', 7, 'image/png', 3510, 'partners/panadoxn.png', '[]', '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL, 'public'),
(73, 0, 'shangxi', 'shangxi', 7, 'image/png', 3510, 'partners/shangxi.png', '[]', '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL, 'public'),
(74, 0, 'tyaalpha', 'tyaalpha', 7, 'image/png', 3510, 'partners/tyaalpha.png', '[]', '2026-01-24 01:54:08', '2026-01-24 01:54:08', NULL, 'public'),
(75, 0, 'vanfaba', 'vanfaba', 7, 'image/png', 3510, 'partners/vanfaba.png', '[]', '2026-01-24 01:54:08', '2026-01-24 01:54:08', NULL, 'public'),
(76, 0, 'banner-footer', 'banner-footer', 8, 'image/png', 92460, 'general/banner-footer.png', '[]', '2026-01-24 01:54:08', '2026-01-24 01:54:08', NULL, 'public'),
(77, 0, 'favicon', 'favicon', 8, 'image/png', 1899, 'general/favicon.png', '[]', '2026-01-24 01:54:09', '2026-01-24 01:54:09', NULL, 'public'),
(78, 0, 'logo-light', 'logo-light', 8, 'image/png', 4519, 'general/logo-light.png', '[]', '2026-01-24 01:54:09', '2026-01-24 01:54:09', NULL, 'public'),
(79, 0, 'logo', 'logo', 8, 'image/png', 5451, 'general/logo.png', '[]', '2026-01-24 01:54:09', '2026-01-24 01:54:09', NULL, 'public'),
(80, 0, 'newsletter-image', 'newsletter-image', 8, 'image/jpeg', 100774, 'general/newsletter-image.jpg', '[]', '2026-01-24 01:54:09', '2026-01-24 01:54:09', NULL, 'public'),
(81, 0, 'placeholder', 'placeholder', 8, 'image/png', 12344, 'general/placeholder.png', '[]', '2026-01-24 01:54:09', '2026-01-24 01:54:09', NULL, 'public');

-- --------------------------------------------------------

--
-- Table structure for table `media_folders`
--

CREATE TABLE `media_folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_folders`
--

INSERT INTO `media_folders` (`id`, `user_id`, `name`, `color`, `slug`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'locations', NULL, 'locations', 0, '2026-01-24 01:53:48', '2026-01-24 01:53:48', NULL),
(2, 0, 'users', NULL, 'users', 0, '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL),
(3, 0, 'avatars', NULL, 'avatars', 0, '2026-01-24 01:53:51', '2026-01-24 01:53:51', NULL),
(4, 0, 'properties', NULL, 'properties', 0, '2026-01-24 01:53:57', '2026-01-24 01:53:57', NULL),
(5, 0, 'posts', NULL, 'posts', 0, '2026-01-24 01:54:01', '2026-01-24 01:54:01', NULL),
(6, 0, 'pages', NULL, 'pages', 0, '2026-01-24 01:54:03', '2026-01-24 01:54:03', NULL),
(7, 0, 'partners', NULL, 'partners', 0, '2026-01-24 01:54:07', '2026-01-24 01:54:07', NULL),
(8, 0, 'general', NULL, 'general', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_settings`
--

CREATE TABLE `media_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(120) NOT NULL,
  `value` text DEFAULT NULL,
  `media_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Main menu', 'main-menu', 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `menu_locations`
--

CREATE TABLE `menu_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_locations`
--

INSERT INTO `menu_locations` (`id`, `menu_id`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, 'main-menu', '2026-01-24 01:54:08', '2026-01-24 01:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `menu_nodes`
--

CREATE TABLE `menu_nodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_type` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `icon_font` varchar(191) DEFAULT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(191) DEFAULT NULL,
  `css_class` varchar(191) DEFAULT NULL,
  `target` varchar(20) NOT NULL DEFAULT '_self',
  `has_child` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_nodes`
--

INSERT INTO `menu_nodes` (`id`, `menu_id`, `parent_id`, `reference_id`, `reference_type`, `url`, `icon_font`, `position`, `title`, `css_class`, `target`, `has_child`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, NULL, NULL, NULL, 0, 'Home', NULL, '_self', 1, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(2, 1, 1, 1, 'Botble\\Page\\Models\\Page', '/homepage-1', NULL, 0, 'Homepage 1', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(3, 1, 1, 2, 'Botble\\Page\\Models\\Page', '/homepage-2', NULL, 1, 'Homepage 2', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(4, 1, 1, 3, 'Botble\\Page\\Models\\Page', '/homepage-3', NULL, 2, 'Homepage 3', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(5, 1, 1, 4, 'Botble\\Page\\Models\\Page', '/homepage-4', NULL, 3, 'Homepage 4', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(6, 1, 1, 5, 'Botble\\Page\\Models\\Page', '/homepage-5', NULL, 4, 'Homepage 5', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(7, 1, 0, NULL, NULL, '/projects', NULL, 1, 'Projects', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(8, 1, 0, NULL, NULL, '/properties', NULL, 2, 'Properties', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(9, 1, 0, NULL, NULL, '#', NULL, 3, 'Pages', NULL, '_self', 1, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(10, 1, 9, NULL, NULL, '/agents', NULL, 0, 'Agents', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(11, 1, 9, NULL, NULL, '/careers', NULL, 1, 'Careers', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(12, 1, 9, NULL, NULL, '/wishlist', NULL, 2, 'Wishlist', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(13, 1, 9, 10, 'Botble\\Page\\Models\\Page', '/about-us', NULL, 3, 'About Us', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(14, 1, 9, 8, 'Botble\\Page\\Models\\Page', '/our-services', NULL, 4, 'Our Services', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(15, 1, 9, 11, 'Botble\\Page\\Models\\Page', '/pricing-plans', NULL, 5, 'Pricing', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(16, 1, 9, 7, 'Botble\\Page\\Models\\Page', '/contact-us', NULL, 6, 'Contact Us', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(17, 1, 9, 9, 'Botble\\Page\\Models\\Page', '/faqs', NULL, 7, 'FAQs', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(18, 1, 9, 12, 'Botble\\Page\\Models\\Page', '/privacy-policy', NULL, 8, 'Privacy Policy', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(19, 1, 9, 13, 'Botble\\Page\\Models\\Page', '/coming-soon', NULL, 9, 'Coming Soon', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(20, 1, 0, NULL, NULL, '#', NULL, 4, 'Blog', NULL, '_self', 1, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(21, 1, 20, 6, 'Botble\\Page\\Models\\Page', '/blog', NULL, 0, 'Blog List', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(22, 1, 20, NULL, NULL, '/news/the-benefits-of-smart-home-technology', NULL, 1, 'Blog Detail', NULL, '_self', 0, '2026-01-24 01:54:08', '2026-01-24 01:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `meta_boxes`
--

CREATE TABLE `meta_boxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(191) NOT NULL,
  `meta_value` text DEFAULT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta_boxes`
--

INSERT INTO `meta_boxes` (`id`, `meta_key`, `meta_value`, `reference_id`, `reference_type`, `created_at`, `updated_at`) VALUES
(1, 'icon', '[\"ti ti-map\"]', 1, 'Botble\\RealEstate\\Models\\Category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(2, 'icon', '[\"ti ti-mail\"]', 2, 'Botble\\RealEstate\\Models\\Category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(3, 'icon', '[\"ti ti-home\"]', 3, 'Botble\\RealEstate\\Models\\Category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(4, 'icon', '[\"ti ti-shopping-cart\"]', 4, 'Botble\\RealEstate\\Models\\Category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(5, 'icon', '[\"ti ti-bell\"]', 5, 'Botble\\RealEstate\\Models\\Category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(6, 'icon', '[\"ti ti-calendar\"]', 6, 'Botble\\RealEstate\\Models\\Category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(7, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 1, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:53', '2026-01-24 01:53:53'),
(8, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 2, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:53', '2026-01-24 01:53:53'),
(9, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 3, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:54', '2026-01-24 01:53:54'),
(10, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 4, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:54', '2026-01-24 01:53:54'),
(11, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 5, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:54', '2026-01-24 01:53:54'),
(12, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 6, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:55', '2026-01-24 01:53:55'),
(13, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 7, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:55', '2026-01-24 01:53:55'),
(14, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 8, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:55', '2026-01-24 01:53:55'),
(15, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 9, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:56', '2026-01-24 01:53:56'),
(16, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 10, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:56', '2026-01-24 01:53:56'),
(17, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 11, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:56', '2026-01-24 01:53:56'),
(18, 'social_links', '[[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]]', 12, 'Botble\\RealEstate\\Models\\Account', '2026-01-24 01:53:57', '2026-01-24 01:53:57'),
(19, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 1, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(20, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 2, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(21, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 3, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(22, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 4, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(23, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 5, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(24, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 6, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(25, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 7, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(26, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 8, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(27, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 9, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(28, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 10, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(29, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 11, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(30, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 12, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(31, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 13, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(32, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 14, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(33, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 15, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(34, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 16, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(35, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 17, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(36, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 18, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(37, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 19, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(38, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 20, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(39, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 21, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(40, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 22, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(41, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 23, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(42, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 24, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(43, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 25, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(44, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 26, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(45, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 27, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(46, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 28, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(47, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 29, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(48, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 30, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(49, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 31, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(50, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 32, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(51, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 33, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(52, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 34, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(53, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 35, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(54, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 36, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(55, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 37, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(56, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 38, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(57, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 39, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(58, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 40, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(59, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 41, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(60, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 42, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(61, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 43, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(62, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 44, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(63, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 45, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(64, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 46, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(65, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 47, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(66, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 48, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(67, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 49, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(68, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 50, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(69, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 51, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(70, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 52, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(71, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 53, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(72, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 54, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(73, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 55, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(74, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 56, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(75, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 57, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(76, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 58, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(77, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 59, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(78, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 60, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(79, 'video_url', '[\"https:\\/\\/youtu.be\\/tRxGSHL8bI0?si=kbumCspOMG-kJvTT\"]', 61, 'Botble\\RealEstate\\Models\\Property', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(80, 'breadcrumb', '[\"no\"]', 1, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(81, 'breadcrumb', '[\"no\"]', 2, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(82, 'breadcrumb', '[\"no\"]', 3, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(83, 'breadcrumb', '[\"no\"]', 5, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(84, 'breadcrumb', '[\"yes\"]', 6, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(85, 'breadcrumb', '[\"yes\"]', 7, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(86, 'breadcrumb', '[\"yes\"]', 8, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(87, 'breadcrumb', '[\"yes\"]', 9, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(88, 'breadcrumb', '[\"yes\"]', 10, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(89, 'breadcrumb', '[\"yes\"]', 11, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(90, 'breadcrumb', '[\"yes\"]', 12, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(91, 'breadcrumb', '[\"no\"]', 13, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(92, 'breadcrumb', '[\"yes\"]', 16, 'Botble\\Page\\Models\\Page', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(93, 'image', '[\"general\\/job-details-thumb.png\"]', 1, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(94, 'icon', '[\"icons\\/icon1.png\"]', 1, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(95, 'apply_url', '[\"\\/contact\"]', 1, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(96, 'image', '[\"general\\/job-details-thumb.png\"]', 2, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(97, 'icon', '[\"icons\\/icon2.png\"]', 2, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(98, 'apply_url', '[\"\\/contact\"]', 2, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(99, 'image', '[\"general\\/job-details-thumb.png\"]', 3, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(100, 'icon', '[\"icons\\/icon3.png\"]', 3, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(101, 'apply_url', '[\"\\/contact\"]', 3, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(102, 'image', '[\"general\\/job-details-thumb.png\"]', 4, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(103, 'icon', '[\"icons\\/icon4.png\"]', 4, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(104, 'apply_url', '[\"\\/contact\"]', 4, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(105, 'image', '[\"general\\/job-details-thumb.png\"]', 5, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(106, 'icon', '[\"icons\\/icon5.png\"]', 5, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(107, 'apply_url', '[\"\\/contact\"]', 5, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(108, 'image', '[\"general\\/job-details-thumb.png\"]', 6, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(109, 'icon', '[\"icons\\/icon6.png\"]', 6, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(110, 'apply_url', '[\"\\/contact\"]', 6, 'ArchiElite\\Career\\Models\\Career', '2026-01-24 01:54:10', '2026-01-24 01:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '2013_04_09_032329_create_base_tables', 1),
(3, '2013_04_09_062329_create_revisions_table', 1),
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(6, '2016_06_10_230148_create_acl_tables', 1),
(7, '2016_06_14_230857_create_menus_table', 1),
(8, '2016_06_28_221418_create_pages_table', 1),
(9, '2016_10_05_074239_create_setting_table', 1),
(10, '2016_11_28_032840_create_dashboard_widget_tables', 1),
(11, '2016_12_16_084601_create_widgets_table', 1),
(12, '2017_05_09_070343_create_media_tables', 1),
(13, '2017_11_03_070450_create_slug_table', 1),
(14, '2019_01_05_053554_create_jobs_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2022_04_20_100851_add_index_to_media_table', 1),
(18, '2022_04_20_101046_add_index_to_menu_table', 1),
(19, '2022_07_10_034813_move_lang_folder_to_root', 1),
(20, '2022_08_04_051940_add_missing_column_expires_at', 1),
(21, '2022_09_01_000001_create_admin_notifications_tables', 1),
(22, '2022_10_14_024629_drop_column_is_featured', 1),
(23, '2022_11_18_063357_add_missing_timestamp_in_table_settings', 1),
(24, '2022_12_02_093615_update_slug_index_columns', 1),
(25, '2023_01_30_024431_add_alt_to_media_table', 1),
(26, '2023_02_16_042611_drop_table_password_resets', 1),
(27, '2023_04_23_005903_add_column_permissions_to_admin_notifications', 1),
(28, '2023_05_10_075124_drop_column_id_in_role_users_table', 1),
(29, '2023_08_21_090810_make_page_content_nullable', 1),
(30, '2023_09_14_021936_update_index_for_slugs_table', 1),
(31, '2023_12_07_095130_add_color_column_to_media_folders_table', 1),
(32, '2023_12_17_162208_make_sure_column_color_in_media_folders_nullable', 1),
(33, '2024_04_04_110758_update_value_column_in_user_meta_table', 1),
(34, '2024_05_12_091229_add_column_visibility_to_table_media_files', 1),
(35, '2024_07_03_162029_remove_plugin_team', 1),
(36, '2024_07_07_091316_fix_column_url_in_menu_nodes_table', 1),
(37, '2024_07_12_100000_change_random_hash_for_media', 1),
(38, '2024_09_30_024515_create_sessions_table', 1),
(39, '2024_12_01_000000_add_indexes_to_pages_translations_table', 1),
(40, '2024_12_01_000000_add_key_prefix_index_to_slugs_table', 1),
(41, '2024_12_19_000001_create_device_tokens_table', 1),
(42, '2024_12_19_000002_create_push_notifications_table', 1),
(43, '2024_12_19_000003_create_push_notification_recipients_table', 1),
(44, '2024_12_30_000001_create_user_settings_table', 1),
(45, '2025_07_06_030754_add_phone_to_users_table', 1),
(46, '2025_07_31_add_performance_indexes_to_slugs_table', 1),
(47, '2025_11_10_000000_cleanup_duplicate_widgets', 1),
(48, '2025_11_30_100000_add_sessions_invalidated_at_to_users_table', 1),
(49, '2020_11_18_150916_ads_create_ads_table', 2),
(50, '2021_12_02_035301_add_ads_translations_table', 2),
(51, '2023_04_17_062645_add_open_in_new_tab', 2),
(52, '2023_11_07_023805_add_tablet_mobile_image', 2),
(53, '2024_04_01_043317_add_google_adsense_slot_id_to_ads_table', 2),
(54, '2025_04_21_000000_add_tablet_mobile_image_to_ads_translations_table', 2),
(55, '2024_04_27_100730_improve_analytics_setting', 3),
(56, '2023_08_11_060908_create_announcements_table', 4),
(57, '2025_02_11_153025_add_action_label_to_announcement_translations', 4),
(58, '2015_06_29_025744_create_audit_history', 5),
(59, '2023_11_14_033417_change_request_column_in_table_audit_histories', 5),
(60, '2025_05_05_000001_add_user_type_to_audit_histories_table', 5),
(61, '2025_11_07_000001_add_actor_type_to_audit_histories_table', 5),
(62, '2015_06_18_033822_create_blog_table', 6),
(63, '2021_02_16_092633_remove_default_value_for_author_type', 6),
(64, '2021_12_03_030600_create_blog_translations', 6),
(65, '2022_04_19_113923_add_index_to_table_posts', 6),
(66, '2023_08_29_074620_make_column_author_id_nullable', 6),
(67, '2024_07_30_091615_fix_order_column_in_categories_table', 6),
(68, '2024_12_01_000000_add_indexes_to_blog_translations_tables', 6),
(69, '2025_01_06_033807_add_default_value_for_categories_author_type', 6),
(70, '2019_06_24_211801_create_career_table', 7),
(71, '2021_12_04_095357_create_careers_translations_table', 7),
(72, '2023_09_20_050420_add_missing_translation_column', 7),
(73, '2016_06_17_091537_create_contacts_table', 8),
(74, '2023_11_10_080225_migrate_contact_blacklist_email_domains_to_core', 8),
(75, '2024_03_20_080001_migrate_change_attribute_email_to_nullable_form_contacts_table', 8),
(76, '2024_03_25_000001_update_captcha_settings_for_contact', 8),
(77, '2024_04_19_063914_create_custom_fields_table', 8),
(78, '2024_12_01_000000_add_indexes_to_contact_translations_tables', 8),
(79, '2018_07_09_221238_create_faq_table', 9),
(80, '2021_12_03_082134_create_faq_translations', 9),
(81, '2023_11_17_063408_add_description_column_to_faq_categories_table', 9),
(82, '2016_10_03_032336_create_languages_table', 10),
(83, '2023_09_14_022423_add_index_for_language_table', 10),
(84, '2021_10_25_021023_fix-priority-load-for-language-advanced', 11),
(85, '2021_12_03_075608_create_page_translations', 11),
(86, '2023_07_06_011444_create_slug_translations_table', 11),
(87, '2024_12_01_000000_add_indexes_to_slugs_translations_table', 11),
(88, '2019_11_18_061011_create_country_table', 12),
(89, '2021_12_03_084118_create_location_translations', 12),
(90, '2021_12_03_094518_migrate_old_location_data', 12),
(91, '2021_12_10_034440_switch_plugin_location_to_use_language_advanced', 12),
(92, '2022_01_16_085908_improve_plugin_location', 12),
(93, '2022_08_04_052122_delete_location_backup_tables', 12),
(94, '2023_04_23_061847_increase_state_translations_abbreviation_column', 12),
(95, '2023_07_26_041451_add_more_columns_to_location_table', 12),
(96, '2023_07_27_041451_add_more_columns_to_location_translation_table', 12),
(97, '2023_08_15_073307_drop_unique_in_states_cities_translations', 12),
(98, '2023_10_21_065016_make_state_id_in_table_cities_nullable', 12),
(99, '2024_08_17_094600_add_image_into_countries', 12),
(100, '2025_01_08_093652_add_zip_code_to_cities', 12),
(101, '2025_07_31_083459_add_indexes_for_location_search_performance', 12),
(102, '2017_10_24_154832_create_newsletter_table', 13),
(103, '2024_03_25_000001_update_captcha_settings_for_newsletter', 13),
(104, '2017_05_18_080441_create_payment_tables', 14),
(105, '2021_03_27_144913_add_customer_type_into_table_payments', 14),
(106, '2021_05_24_034720_make_column_currency_nullable', 14),
(107, '2021_08_09_161302_add_metadata_column_to_payments_table', 14),
(108, '2021_10_19_020859_update_metadata_field', 14),
(109, '2022_06_28_151901_activate_paypal_stripe_plugin', 14),
(110, '2022_07_07_153354_update_charge_id_in_table_payments', 14),
(111, '2024_07_04_083133_create_payment_logs_table', 14),
(112, '2025_04_12_000003_add_payment_fee_to_payments_table', 14),
(113, '2025_05_22_000001_add_payment_fee_type_to_settings_table', 14),
(114, '2018_06_22_032304_create_real_estate_table', 15),
(115, '2021_02_11_031126_update_price_column_in_projects_and_properties', 15),
(116, '2021_03_08_024049_add_lat_long_into_real_estate_tables', 15),
(117, '2021_06_10_091950_add_column_is_featured_to_table_re_accounts', 15),
(118, '2021_07_07_021757_update_table_account_activity_logs', 15),
(119, '2021_09_29_042758_create_re_categories_multilevel_table', 15),
(120, '2021_10_31_031254_add_company_to_accounts_table', 15),
(121, '2021_12_10_034807_create_real_estate_translation_tables', 15),
(122, '2021_12_18_081636_add_property_project_views_count', 15),
(123, '2022_05_04_033044_update_column_images_in_real_estate_tables', 15),
(124, '2022_07_02_081723_fix_expired_date_column', 15),
(125, '2022_08_01_090213_update_table_properties_and_projects', 15),
(126, '2023_01_31_023233_create_re_custom_fields_table', 15),
(127, '2023_02_06_000000_add_location_to_re_accounts_table', 15),
(128, '2023_02_06_024257_add_package_translations', 15),
(129, '2023_02_08_062457_add_custom_fields_translation_table', 15),
(130, '2023_02_15_024644_create_re_reviews_table', 15),
(131, '2023_02_20_072604_create_re_invoices_table', 15),
(132, '2023_02_20_081251_create_re_account_packages_table', 15),
(133, '2023_04_04_030709_add_unique_id_to_properties_and_projects_table', 15),
(134, '2023_04_14_164811_make_phone_and_email_in_table_re_consults_nullable', 15),
(135, '2023_05_09_062031_unique_reviews_table', 15),
(136, '2023_05_26_034353_fix_properties_projects_image', 15),
(137, '2023_05_27_004215_add_column_ip_into_table_re_consults', 15),
(138, '2023_07_25_034513_create_re_coupons_table', 15),
(139, '2023_07_25_034672_add_coupon_code_column_to_jb_invoices_table', 15),
(140, '2023_08_02_074208_change_square_column_to_float', 15),
(141, '2023_08_07_000001_add_is_public_profile_column_to_re_accounts_table', 15),
(142, '2023_08_09_004607_make_column_project_id_nullable', 15),
(143, '2023_09_11_084630_update_mandatory_fields_in_consult_form_table', 15),
(144, '2023_11_21_071820_add_missing_slug_for_agents', 15),
(145, '2024_01_11_084816_add_investor_translations_table', 15),
(146, '2024_01_31_022842_add_description_to_re_packages_table', 15),
(147, '2024_03_13_000001_drop_type_column_from_custom_field_translations_table', 15),
(148, '2024_04_23_124505_add_features_column_to_re_packages', 15),
(149, '2024_04_23_135106_add_columns_to_re_investors', 15),
(150, '2024_05_25_000001_update_captcha_settings_for_real_estate', 15),
(151, '2024_06_16_163428_make_investor_id_nullable', 15),
(152, '2024_06_20_103539_create_consult_custom_fields_table', 15),
(153, '2024_07_08_235824_fix_facilities_primary_key', 15),
(154, '2024_07_26_090340_add_private_notes_column_to_re_properties_projects_table', 15),
(155, '2024_08_09_075542_add_accounts_translations', 15),
(156, '2024_08_12_124528_add_approved_at_column_to_re_accounts_table', 15),
(157, '2024_08_31_074158_add_floor_plans_columns_to_re_properties_table', 15),
(158, '2024_09_04_130921_add_reject_reason_column_to_re_properties_table', 15),
(159, '2024_09_19_021436_make_email_in_accounts_table_nullable', 15),
(160, '2024_11_18_023706_add_floor_plan_to_table_re_properties_translations', 15),
(161, '2024_12_01_000000_add_floor_plans_column_to_re_projects_table', 15),
(162, '2024_12_01_000000_add_indexes_to_real_estate_translations_tables', 15),
(163, '2024_12_18_000000_add_blocked_at_column_to_re_accounts_table', 15),
(164, '2024_12_18_000001_add_blocked_reason_column_to_re_accounts_table', 15),
(165, '2025_04_12_161730_add_featured_priority_to_re_properties_table', 15),
(166, '2025_04_12_165120_add_featured_priority_to_re_projects_table', 15),
(167, '2025_04_23_034738_make_featured_priority_nullable', 15),
(168, '2025_05_19_000001_add_zip_code_to_properties_and_projects_tables', 15),
(169, '2025_07_31_083138_add_indexes_for_real_estate_location_search', 15),
(170, '2025_08_12_085710_add_verification_fields_to_re_accounts_table', 15),
(171, '2025_08_14_025316_change_column_description_in_re_accounts_translations_to_text', 15),
(172, '2025_09_30_103625_add_performance_indexes_to_re_properties_table', 15),
(173, '2025_09_30_103746_add_status_index_to_re_reviews_table', 15),
(174, '2025_09_30_103813_add_composite_query_index_to_re_properties_table', 15),
(175, '2025_09_30_104436_add_performance_indexes_to_re_categories_table', 15),
(176, '2025_10_10_093314_add_number_format_style_and_space_to_re_currencies_table', 15),
(177, '2025_10_22_000001_add_whatsapp_to_re_accounts_table', 15),
(178, '2025_11_24_142748_add_privacy_settings_to_re_accounts_table', 15),
(179, '2026_01_22_105507_change_re_categories_description_to_text', 15),
(180, '2026_01_22_105908_add_content_column_to_re_categories_table', 15),
(181, '2025_04_08_040931_create_social_logins_table', 16),
(182, '2018_07_09_214610_create_testimonial_table', 17),
(183, '2021_12_03_083642_create_testimonials_translations', 17),
(184, '2024_12_01_000000_add_indexes_to_testimonials_translations_table', 17),
(185, '2016_10_07_193005_create_translations_table', 18),
(186, '2023_12_12_105220_drop_translations_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(120) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'subscribed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `content` longtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `template` varchar(60) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `content`, `user_id`, `image`, `template`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Homepage 1', '[hero-banner style=\"1\" title=\"Find Your\" animation_text=\"Dream Home,Perfect Home,Real Estate\" description=\"We are a real estate agency that will help you find the best residence you dream of, let’s discuss for your dream house?\" background_image=\"pages/slider-1.jpg\" search_box_enabled=\"1\" projects_search_enabled=\"1\" default_search_type=\"project\"][/hero-banner]\n[properties style=\"2\" title=\"Recommended For You\" subtitle=\"Features Properties\" category_ids=\"1,2,3,4,5,6\" type=\"rent\" is_featured=\"\" limit=\"6\" button_label=\"View All Properties\" button_url=\"/properties\" enable_lazy_loading=\"yes\"][/properties]\n[location title=\"Our Location For You\" subtitle=\"Explore Cities\" type=\"city\" city_ids=\"1,2,3,4,5,6,7\" destination=\"property\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/location]\n[services style=\"1\" title=\"What We Do?\" subtitle=\"Our Services\" background_color=\"transparent\" services_quantity=\"3\" services_title_1=\"Buy A New Home\" services_description_1=\"Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.\" services_button_label_1=\"Learn More\" services_button_url_1=\"/\" services_icon_image_1=\"pages/service-1.png\" services_title_2=\"Rent A Home\" services_description_2=\"Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.\" services_button_label_2=\"Learn More\" services_button_url_2=\"/\" services_icon_image_2=\"pages/service-2.png\" services_title_3=\"Sell A Home\" services_description_3=\"Sell confidently with expert guidance and effective strategies, showcasing your property\'s best features for a successful sale.\" services_button_label_3=\"Learn More\" services_button_url_3=\"/\" services_icon_image_3=\"pages/service-3.png\" counters_quantity=\"4\" counters_label_1=\"SATISFIED CLIENTS\" counters_number_1=\"85\" counters_label_2=\"AWARDS RECEIVED\" counters_number_2=\"112\" counters_label_3=\"SUCCESSFUL TRANSACTIONS\" counters_number_3=\"32\" counters_label_4=\"MONTHLY TRAFFIC\" counters_number_4=\"66\" button_label=\"View All Services\" button_url=\"/\" enable_lazy_loading=\"yes\"][/services]\n[services style=\"1\" title=\"Why Choose Homzen\" subtitle=\"Our Benefit\" background_color=\"#f7f7f7\" services_quantity=\"3\" services_title_1=\"Proven Expertise\" services_description_1=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" services_icon_image_1=\"pages/service-1.png\" services_title_2=\"Customized Solutions\" services_description_2=\"We pride ourselves on crafting personalized strategies to match your unique goals, ensuring a seamless real estate journey.\" services_icon_image_2=\"pages/service-2.png\" services_title_3=\"Transparent Partnerships\" services_description_3=\"Transparency is key in our client relationships. We prioritize clear communication and ethical practices, fostering trust and reliability throughout.\" services_icon_image_3=\"pages/service-3.png\" counters_quantity=\"1\" centered_content=\"1\" enable_lazy_loading=\"yes\"][/services]\n[properties style=\"1\" title=\"Best Property Value\" subtitle=\"Top Properties\" is_featured=\"1\" limit=\"4\" button_label=\"View All\" button_url=\"/properties\" enable_lazy_loading=\"yes\"][/properties]\n[testimonials style=\"1\" title=\"What’s People Say’s\" subtitle=\"Top Properties\" description=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" testimonial_ids=\"1,2,3,4\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/testimonials]\n[agents style=\"1\" title=\"Meet Our Agents\" subtitle=\"Our Teams\" account_ids=\"1,2,3,4\" enable_lazy_loading=\"yes\"][/agents]\n[mortgage-calculator style=\"default\" layout=\"horizontal\" form_style=\"modern\" form_size=\"xl\" form_alignment=\"center\" form_margin=\"50px 0\" form_title=\"Mortgage Calculator\" form_description=\"Calculate your monthly mortgage payments\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/mortgage-calculator]\n[blog-posts style=\"1\" title=\"Helpful Homzen Guides\" subtitle=\"Latest News\" type=\"recent\" limit=\"3\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/blog-posts]\n[image-slider background_color=\"transparent\" quantity=\"7\" name_1=\"GitHub\" image_1=\"partners/github.png\" url_1=\"https://github.com\" open_in_new_tab_1=\"\" name_2=\"LH.Tech\" image_2=\"partners/lhtech.png\" url_2=\"https://lhtech.com.my\" open_in_new_tab_2=\"\" name_3=\"Panadoxn\" image_3=\"partners/panadoxn.png\" url_3=\"/\" open_in_new_tab_3=\"\" name_4=\"Shangxi\" image_4=\"partners/shangxi.png\" url_4=\"/\" open_in_new_tab_4=\"\" name_5=\"Tyaalpha\" image_5=\"partners/tyaalpha.png\" url_5=\"/\" open_in_new_tab_5=\"\" name_6=\"Vanfaba\" image_6=\"partners/vanfaba.png\" url_6=\"/\" open_in_new_tab_6=\"\" name_7=\"Asana\" image_7=\"partners/asana.png\" url_7=\"https://asana.com\" open_in_new_tab_7=\"\" enable_lazy_loading=\"yes\"][/image-slider]', 1, NULL, 'full-width', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(2, 'Homepage 2', '[hero-banner style=\"2\" title=\"Find A Home That\" animation_text=\"Perfectly,Dream Home\" description=\"We are a real estate agency that will help you find the best residence you dream of.\" background_image=\"pages/slider-left.jpg\" slider_image_1=\"pages/slider-2.jpg\" slider_image_2=\"pages/slider-3.jpg\" slider_image_3=\"pages/slider-4.jpg\" slider_image_4=\"pages/slider-5.jpg\" search_box_enabled=\"1\" projects_search_enabled=\"1\" default_search_type=\"project\"][/hero-banner]\n[property-categories style=\"1\" title=\"Try Searching For\" subtitle=\"PROPERTY TYPE\" category_ids=\"1,2,3,4,5,6\" background_color=\"transparent\" button_label=\"View All\" button_url=\"/categories\" enable_lazy_loading=\"yes\"][/property-categories]\n[properties style=\"4\" title=\"Discover Homzen\'s Finest Properties For Your Dream Home\" subtitle=\"Featured Properties\" limit=\"8\" button_label=\"View All Properties\" button_url=\"/properties\" enable_lazy_loading=\"yes\"][/properties]\n[services style=\"3\" title=\"Discover What Sets Our Real Estate Expertise Apart\" subtitle=\"Why Choose Us\" description=\"At Homzen, our unwavering commitment lies in crafting unparalleled real estate journeys. Our seasoned professionals, armed with extensive market knowledge, walk alongside you through every phase of your property endeavor. We prioritize understanding your unique aspirations, tailoring our expertise to match your vision.\" checklist=\"Transparent Partnerships,Proven Expertise,Customized Solutions,Local Area Knowledge\" background_color=\"#f7f7f7\" services_quantity=\"3\" services_title_1=\"Buy A New Home\" services_description_1=\"Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.\" services_button_label_1=\"Learn More\" services_button_url_1=\"/\" services_icon_image_1=\"pages/service-1.png\" services_title_2=\"Rent A Home\" services_description_2=\"Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.\" services_button_label_2=\"Learn More\" services_button_url_2=\"/\" services_icon_image_2=\"pages/service-2.png\" services_title_3=\"Sell A Home\" services_description_3=\"Sell confidently with expert guidance and effective strategies, showcasing your property\'s best features for a successful sale.\" services_button_label_3=\"Learn More\" services_button_url_3=\"/\" services_icon_image_3=\"pages/service-3.png\" counters_quantity=\"1\" button_label=\"Contact Us\" button_url=\"/contact-us\" centered_content=\"\" enable_lazy_loading=\"yes\"][/services]\n[location style=\"2\" title=\"Our Location For You\" subtitle=\"Explore States\" type=\"state\" state_ids=\"1,2,3,4,5,6\" destination=\"property\" background_color=\"transparent\" enable_lazy_loading=\"yes\"][/location]\n[properties style=\"3\" title=\"Best Property Value\" subtitle=\"Top Properties\" is_featured=\"1\" limit=\"4\" button_label=\"View All\" button_url=\"/properties\" enable_lazy_loading=\"yes\" background_color=\"#f7f7f7\"][/properties]\n[agents style=\"1\" title=\"Meet Our Agents\" subtitle=\"Our Teams\" account_ids=\"1,2,3,4\" enable_lazy_loading=\"yes\"][/agents]\n[mortgage-calculator style=\"default\" layout=\"horizontal\" form_style=\"modern\" form_size=\"xl\" form_alignment=\"center\" form_margin=\"50px 0\" form_title=\"Mortgage Calculator\" form_description=\"Calculate your monthly mortgage payments\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/mortgage-calculator]\n[testimonials style=\"3\" title=\"What\'s People Say\'s\" subtitle=\"Our Testimonials\" description=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" testimonial_ids=\"1,2,3,4\" enable_lazy_loading=\"yes\"][/testimonials]\n[blog-posts style=\"1\" title=\"Helpful Homzen Guides\" subtitle=\"Latest News\" type=\"recent\" limit=\"3\" enable_lazy_loading=\"yes\"][/blog-posts]', 1, NULL, 'full-width', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(3, 'Homepage 3', '[hero-banner style=\"3\" title=\"Indulge in Your\" animation_text=\"Sanctuary,Safe House\" description=\"Discover your private oasis at Homzen, where every corner, from the spacious garden to the relaxing pool, is crafted for your comfort and enjoyment.\" background_image=\"pages/slider-6.png\" search_box_enabled=\"1\" projects_search_enabled=\"1\" default_search_type=\"project\" button_label=\"Contact Us\" button_url=\"/contact\"][/hero-banner]\n[location style=\"3\" title=\"Properties By Cities\" subtitle=\"EXPLORE CITIES\" type=\"city\" city_ids=\"1,2,3,4,5,6,7,21,24\" destination=\"property\" background_color=\"#f7f7f7\" button_label=\"View All Properties\" button_url=\"/properties\" enable_lazy_loading=\"yes\"][/location]\n[properties style=\"2\" title=\"Recommended For You\" subtitle=\"Features Properties\" category_ids=\"1,2,3,4,5,6\" type=\"rent\" is_featured=\"\" limit=\"6\" button_label=\"View All Properties\" button_url=\"/properties\" enable_lazy_loading=\"yes\"][/properties]\n[property-categories style=\"2\" title=\"Try Searching For\" subtitle=\"PROPERTY TYPE\" category_ids=\"1,2,3,4,5,6\" background_color=\"#161e2d\" enable_lazy_loading=\"yes\"][/property-categories]\n[services style=\"2\" title=\"What We Do?\" subtitle=\"Our Services\" background_color=\"transparent\" services_quantity=\"3\" services_title_1=\"Buy A New Home\" services_description_1=\"Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.\" services_button_label_1=\"Learn More\" services_button_url_1=\"/\" services_icon_image_1=\"pages/service-1.png\" services_title_2=\"Rent A Home\" services_description_2=\"Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.\" services_button_label_2=\"Learn More\" services_button_url_2=\"/\" services_icon_image_2=\"pages/service-2.png\" services_title_3=\"Sell A Home\" services_description_3=\"Sell confidently with expert guidance and effective strategies, showcasing your property\'s best features for a successful sale.\" services_button_label_3=\"Learn More\" services_button_url_3=\"/\" services_icon_image_3=\"pages/service-3.png\" enable_lazy_loading=\"yes\"][/services]\n[testimonials style=\"4\" title=\"What’s People Say’s\" subtitle=\"Our Testimonials\" description=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" testimonial_ids=\"1,2,3,4\" background_color=\"#f7f7f7\" background_image=\"pages/testimonial-banner.png\" enable_lazy_loading=\"yes\"][/testimonials]\n[agents style=\"2\" title=\"Meet Our Agents\" subtitle=\"Our Teams\" account_ids=\"1,2,3,4\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/agents]\n[mortgage-calculator style=\"default\" layout=\"horizontal\" form_style=\"modern\" form_size=\"xl\" form_alignment=\"center\" form_margin=\"50px 0\" form_title=\"Mortgage Calculator\" form_description=\"Calculate your monthly mortgage payments\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/mortgage-calculator]\n[blog-posts style=\"2\" title=\"Helpful Homzen Guides\" subtitle=\"Latest News\" type=\"recent\" limit=\"4\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/blog-posts]', 1, NULL, 'full-width', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(4, 'Homepage 4', '[hero-banner style=\"4\" search_box_enabled=\"1\" projects_search_enabled=\"1\" default_search_type=\"project\"][/hero-banner]\n[properties style=\"5\" title=\"Discover Homzen\'s Finest Properties For Your Dream Home\" subtitle=\"FEATURED PROPERTIES\" is_featured=\"1\" limit=\"6\" button_label=\"View All Properties\" button_url=\"/properties\" background_color=\"transparent\" enable_lazy_loading=\"yes\"][/properties]\n[services style=\"4\" title=\"Discover What Sets Our\" subtitle=\"WHAT WE DO\" description=\"At Homzen, our unwavering commitment lies in crafting unparalleled real estate journeys.\" background_color=\"transparent\" services_quantity=\"3\" services_title_1=\"Buy A New Home\" services_description_1=\"Explore diverse properties and expert guidance for a seamless buying experience.\" services_icon_1=\"ti ti-12-hours\" services_icon_image_1=\"pages/service-1.png\" services_button_label_1=\"Learn More\" services_button_url_1=\"/contact\" services_title_2=\"Rent A Home\" services_description_2=\"Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.\" services_icon_image_2=\"pages/service-2.png\" services_button_label_2=\"Learn More\" services_button_url_2=\"/contact\" services_title_3=\"Buy A New Home\" services_description_3=\"Showcasing your property\'s best features for a successful sale.\" services_icon_image_3=\"pages/service-3.png\" services_button_label_3=\"Learn More\" services_button_url_3=\"/contact\" counters_quantity=\"1\" background_image=\"pages/house-service.png\" centered_content=\"\" enable_lazy_loading=\"yes\"][/services]\n[location title=\"Our Location For You\" subtitle=\"Explore Cities\" type=\"city\" city_ids=\"1,2,3,4,5,6\" destination=\"property\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/location]\n[agents style=\"1\" title=\"Meet Our Agents\" subtitle=\"OUR TEAMS\" account_ids=\"1,2,3\" background_color=\"transparent\" items_per_row=\"3\" enable_lazy_loading=\"yes\"][/agents]\n[mortgage-calculator style=\"default\" layout=\"horizontal\" form_style=\"modern\" form_size=\"xl\" form_alignment=\"center\" form_margin=\"50px 0\" form_title=\"Mortgage Calculator\" form_description=\"Calculate your monthly mortgage payments\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/mortgage-calculator]\n[properties style=\"6\" title=\"Recommended for you\" subtitle=\"TOP PROPERTIES\" is_featured=\"1\" limit=\"4\" background_image=\"pages/properties.png\" background_color=\"transparent\" enable_lazy_loading=\"yes\"][/properties]\n[testimonials style=\"2\" title=\"What\'s People Say\'s\" subtitle=\"OUR TESTIMONIALS\" testimonial_ids=\"1,2,3,4\" enable_lazy_loading=\"yes\"][/testimonials]\n[services style=\"5\" title=\"Why Choose Homzen\" subtitle=\"OUR BENIFIT\" description=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" background_color=\"transparent\" services_quantity=\"8\" services_title_1=\"Buy A New Home\" services_description_1=\"Explore diverse properties and expert guidance for a seamless buying experience.\" services_icon_1=\"ti ti-home\" services_title_2=\"Sell Your Property\" services_description_2=\"Get the best value with our professional selling strategies and market insights.\" services_icon_2=\"ti ti-currency-dollar\" services_title_3=\"Rent A Property\" services_description_3=\"Find the perfect rental property with our extensive listings and support.\" services_icon_3=\"ti ti-building\" services_title_4=\"Property Management\" services_description_4=\"Professional management services to keep your property in top condition.\" services_icon_4=\"ti ti-settings\" services_title_5=\"Real Estate Consulting\" services_description_5=\"Expert advice and insights to help you make informed real estate decisions.\" services_icon_5=\"ti ti-chart-bar\" services_title_6=\"Mortgage Services\" services_description_6=\"Find the best mortgage rates and options with our comprehensive services.\" services_icon_6=\"ti ti-credit-card\" services_title_7=\"Investment Properties\" services_description_7=\"Discover lucrative investment opportunities and maximize your returns.\" services_icon_7=\"ti ti-briefcase\" services_title_8=\"Relocation Services\" services_description_8=\"Smooth and hassle-free relocation services to help you move with ease.\" services_icon_8=\"ti ti-truck\" counters_quantity=\"1\" centered_content=\"\" enable_lazy_loading=\"yes\"][/services]\n[blog-posts style=\"1\" title=\"Helpful Homzen Guides\" subtitle=\"LATEST NEWS\" type=\"recent\" limit=\"3\" enable_lazy_loading=\"yes\"][/blog-posts]\n[call-to-action title=\"List Your Properties On Homzen, Join Us Now!\" subtitle=\"BECOME PARTNERS\" button_label=\"Become A Hosting\" button_url=\"/contact\" image=\"pages/call-to-action.png\" enable_lazy_loading=\"yes\"][/call-to-action]', 1, NULL, 'full-width', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(5, 'Homepage 5', '[hero-banner style=\"5\" property_id=\"4\" search_box_enabled=\"1\" projects_search_enabled=\"1\" default_search_type=\"project\"][/hero-banner]\n[services style=\"2\" title=\"Why Choose Homzen\" subtitle=\"Our Benefit\" background_color=\"#f7f7f7\" services_quantity=\"3\" services_title_1=\"Buy A New Home\" services_description_1=\"Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.\" services_button_label_1=\"Learn More\" services_button_url_1=\"/\" services_icon_image_1=\"pages/service-1.png\" services_title_2=\"Rent A Home\" services_description_2=\"Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.\" services_button_label_2=\"Learn More\" services_button_url_2=\"/\" services_icon_image_2=\"pages/service-2.png\" services_title_3=\"Sell A Home\" services_description_3=\"Sell confidently with expert guidance and effective strategies, showcasing your property\'s best features for a successful sale.\" services_button_label_3=\"Learn More\" services_button_url_3=\"/\" services_icon_image_3=\"pages/service-3.png\" counters_quantity=\"1\" centered_content=\"1\" enable_lazy_loading=\"yes\"][/services]\n[properties style=\"4\" title=\"Discover Homzen\'s Finest Properties For Your Dream Home\" subtitle=\"FEATURED PROPERTIES\" is_featured=\"1\" limit=\"8\" button_label=\"View All Properties\" button_url=\"/properties\" background_color=\"transparent\" enable_lazy_loading=\"yes\"][/properties]\n[location style=\"4\" title=\"Our Location For You\" subtitle=\"EXPLORE CITIES\" type=\"city\" city_ids=\"1,3,5,6,11,23\" destination=\"property\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/location]\n[properties style=\"7\" title=\"Recommended For You\" subtitle=\"TOP PROPERTIES\" is_featured=\"1\" limit=\"4\" background_color=\"transparent\" enable_lazy_loading=\"yes\"][/properties]\n[services style=\"5\" title=\"Why Choose Homzen\" subtitle=\"OUR BENIFIT\" description=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" background_color=\"transparent\" services_quantity=\"8\" services_title_1=\"Buy A New Home\" services_description_1=\"Explore diverse properties and expert guidance for a seamless buying experience.\" services_icon_1=\"ti ti-home\" services_title_2=\"Sell Your Property\" services_description_2=\"Get the best value with our professional selling strategies and market insights.\" services_icon_2=\"ti ti-currency-dollar\" services_title_3=\"Rent A Property\" services_description_3=\"Find the perfect rental property with our extensive listings and support.\" services_icon_3=\"ti ti-building\" services_title_4=\"Property Management\" services_description_4=\"Professional management services to keep your property in top condition.\" services_icon_4=\"ti ti-settings\" services_title_5=\"Real Estate Consulting\" services_description_5=\"Expert advice and insights to help you make informed real estate decisions.\" services_icon_5=\"ti ti-chart-bar\" services_title_6=\"Mortgage Services\" services_description_6=\"Find the best mortgage rates and options with our comprehensive services.\" services_icon_6=\"ti ti-credit-card\" services_title_7=\"Investment Properties\" services_description_7=\"Discover lucrative investment opportunities and maximize your returns.\" services_icon_7=\"ti ti-briefcase\" services_title_8=\"Relocation Services\" services_description_8=\"Smooth and hassle-free relocation services to help you move with ease.\" services_icon_8=\"ti ti-truck\" counters_quantity=\"1\" centered_content=\"\" enable_lazy_loading=\"yes\"][/services]\n[agents style=\"2\" title=\"Meet Our Agents\" subtitle=\"OUR TEAMS\" account_ids=\"1,2,3,4\" background_color=\"transparent\" items_per_row=\"2\" enable_lazy_loading=\"yes\"][/agents]\n[mortgage-calculator style=\"default\" layout=\"horizontal\" form_style=\"modern\" form_size=\"xl\" form_alignment=\"center\" form_margin=\"50px 0\" form_title=\"Mortgage Calculator\" form_description=\"Calculate your monthly mortgage payments\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/mortgage-calculator]\n[testimonials style=\"1\" title=\"What\'s People Say\'s\" subtitle=\"TOP PROPERTIES\" description=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" testimonial_ids=\"1,2,3,4\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/testimonials]\n[blog-posts style=\"2\" title=\"The Most Recent Estate\" subtitle=\"LATEST NEWS\" type=\"recent\" limit=\"4\" enable_lazy_loading=\"yes\"][/blog-posts]\n[mortgage-calculator style=\"default\" layout=\"horizontal\" form_style=\"modern\" form_size=\"lg\" form_alignment=\"center\" form_title=\"Mortgage Calculator\" form_description=\"Calculate your monthly mortgage payments\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/mortgage-calculator]', 1, NULL, 'full-width', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(6, 'Blog', NULL, 1, NULL, NULL, NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(7, 'Contact Us', '[contact-form display_fields=\"phone,email,subject,address\" mandatory_fields=\"email\" style=\"1\" title=\"Drop Us A Line\" description=\"Feel free to connect with us through our online channels for updates, news, and more.\" show_information_box=\"1\" contact_title=\"Contact Us\" quantity=\"3\" label_1=\"Address:\" content_1=\"101 E 129th St, East Chicago, IN 46312 United States\" label_2=\"Information:\" content_2=\"1-333-345-6868 hi.themesflat@gmail.com\" label_3=\"Open time:\" content_3=\"Monday - Friday: 08:00 - 20:00 Saturday - Sunday: 10:00 - 18:00\" show_social_links=\"1\"][/contact-form]\n[google-map]101 E 129th St, East Chicago, IN 46312 United States[/google-map]', 1, NULL, NULL, NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(8, 'Our Services', '[services style=\"2\" title=\"Why Choose Homzen\" subtitle=\"Our Benefit\" background_color=\"#ffffff\" services_quantity=\"3\" services_title_1=\"Buy A New Home\" services_description_1=\"Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.\" services_button_label_1=\"Learn More\" services_button_url_1=\"/\" services_icon_image_1=\"pages/service-1.png\" services_title_2=\"Rent A Home\" services_description_2=\"Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.\" services_button_label_2=\"Learn More\" services_button_url_2=\"/\" services_icon_image_2=\"pages/service-2.png\" services_title_3=\"Sell A Home\" services_description_3=\"Sell confidently with expert guidance and effective strategies, showcasing your property\'s best features for a successful sale.\" services_button_label_3=\"Learn More\" services_button_url_3=\"/\" services_icon_image_3=\"pages/service-3.png\" counters_quantity=\"1\" centered_content=\"1\" enable_lazy_loading=\"yes\"][/services]\n[testimonials style=\"1\" title=\"What’s People Say’s\" subtitle=\"Top Properties\" description=\"Our seasoned team excels in real estate with years of successful market navigation, offering informed decisions and optimal results.\" testimonial_ids=\"1,2,3,4\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/testimonials]\n[faqs title=\"Quick Answers To Questions\" subtitle=\"FAQs\" category_ids=\"1,2,3,4\" display_type=\"list\" limit=\"5\" expand_first_time=\"1\" enable_lazy_loading=\"yes\"][/faqs]\n[call-to-action title=\"List your Properties on Homzen, join Us Now!\" subtitle=\"Become Partners\" button_label=\"Become A Hosting\" button_url=\"/\" image=\"pages/call-to-action.png\" enable_lazy_loading=\"yes\"][/call-to-action]', 1, NULL, 'full-width', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(9, 'FAQs', '[faqs category_ids=\"1,2,3\" display_type=\"group\" expand_first_time=\"1\" enable_lazy_loading=\"yes\"][/faqs]', 1, NULL, NULL, NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(10, 'About Us', '[about-us title=\"Welcome To The &lt;br&gt; Homzen\" description=\"Welcome to Homzen, where we turn houses into homes and dreams into reality. At Homzen, we understand that a home is more than just a physical space; it\'s a place where memories are created, families grow, and life unfolds.\" button_label=\"Learn More\" button_url=\"/\" image=\"pages/about-us-video.jpg\" video_url=\"https://youtu.be/tRxGSHL8bI0\"][/about-us]\n[services style=\"3\" title=\"Discover What Sets Our Real Estate Expertise Apart\" subtitle=\"Why Choose Us\" description=\"At Homzen, our unwavering commitment lies in crafting unparalleled real estate journeys. Our seasoned professionals, armed with extensive market knowledge, walk alongside you through every phase of your property endeavor. We prioritize understanding your unique aspirations, tailoring our expertise to match your vision.\" checklist=\"Transparent Partnerships,Proven Expertise,Customized Solutions,Local Area Knowledge\" background_color=\"#f7f7f7\" services_quantity=\"3\" services_title_1=\"Buy A New Home\" services_description_1=\"Discover your dream home effortlessly. Explore diverse properties and expert guidance for a seamless buying experience.\" services_button_label_1=\"Learn More\" services_button_url_1=\"/\" services_icon_image_1=\"pages/service-1.png\" services_title_2=\"Rent A Home\" services_description_2=\"Discover your perfect rental effortlessly. Explore a diverse variety of listings tailored precisely to suit your unique lifestyle needs.\" services_button_label_2=\"Learn More\" services_button_url_2=\"/\" services_icon_image_2=\"pages/service-2.png\" services_title_3=\"Sell A Home\" services_description_3=\"Sell confidently with expert guidance and effective strategies, showcasing your property\'s best features for a successful sale.\" services_button_label_3=\"Learn More\" services_button_url_3=\"/\" services_icon_image_3=\"pages/service-3.png\" counters_quantity=\"1\" button_label=\"Contact Us\" button_url=\"/contact-us\" centered_content=\"\" enable_lazy_loading=\"yes\"][/services]\n[testimonials style=\"2\" title=\"What’s People Say’s\" subtitle=\"Top Properties\" testimonial_ids=\"1,2,3,4\" background_color=\"#f7f7f7\" enable_lazy_loading=\"yes\"][/testimonials]\n[image-slider background_color=\"transparent\" quantity=\"7\" name_1=\"GitHub\" image_1=\"partners/github.png\" url_1=\"https://github.com\" open_in_new_tab_1=\"\" name_2=\"LH.Tech\" image_2=\"partners/lhtech.png\" url_2=\"https://lhtech.com.my\" open_in_new_tab_2=\"\" name_3=\"Panadoxn\" image_3=\"partners/panadoxn.png\" url_3=\"/\" open_in_new_tab_3=\"\" name_4=\"Shangxi\" image_4=\"partners/shangxi.png\" url_4=\"/\" open_in_new_tab_4=\"\" name_5=\"Tyaalpha\" image_5=\"partners/tyaalpha.png\" url_5=\"/\" open_in_new_tab_5=\"\" name_6=\"Vanfaba\" image_6=\"partners/vanfaba.png\" url_6=\"/\" open_in_new_tab_6=\"\" name_7=\"Asana\" image_7=\"partners/asana.png\" url_7=\"https://asana.com\" open_in_new_tab_7=\"\" enable_lazy_loading=\"yes\"][/image-slider]\n[contact-form display_fields=\"phone,email,subject,address\" mandatory_fields=\"email\" style=\"2\" title=\"We\'re Always Eager To Hear From You!\" subtitle=\"Contact Us\" description=\"Sed ullamcorper nulla egestas at. Aenean eget tortor nec elit sagittis molestie. Pellentesque tempus massa in.r nulla egestas at. Aenean eget tortor nec elit sagittis mole\" background_image=\"pages/about-us-contact.jpg\"][/contact-form]\n[agents style=\"1\" title=\"Meet Our Agents\" subtitle=\"Our Teams\" account_ids=\"1,2,3,4\" items_per_row=\"4\" enable_lazy_loading=\"yes\"][/agents]\n[call-to-action title=\"List your Properties on Homzen, join Us Now!\" subtitle=\"Become Partners\" button_label=\"Become A Hosting\" button_url=\"/\" image=\"pages/call-to-action.png\" enable_lazy_loading=\"yes\"][/call-to-action]', 1, NULL, 'full-width', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(11, 'Pricing Plans', '[pricing-plan title=\"Our Subscription\" subtitle=\"Pricing\" package_ids=\"1,2,3,4\" enable_lazy_loading=\"yes\"][/pricing-plan]\n[faqs title=\"Quick Answers To Questions\" subtitle=\"FAQs\" category_ids=\"1\" display_type=\"list\" limit=\"5\" expand_first_time=\"1\" enable_lazy_loading=\"yes\"][/faqs]', 1, NULL, NULL, NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(12, 'Privacy Policy', '[content-tab title=\"Terms Of Use\" quantity=\"5\" title_1=\"Terms\" content_1=\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed euismod justo, sit amet efficitur dui. Aliquam sodales vestibulum velit, eget sollicitudin quam. Donec non aliquam eros. Etiam sit amet lectus vel justo dignissim condimentum. In malesuada neque quis libero laoreet posuere. In consequat vitae ligula quis rutrum. Morbi dolor orci, maximus a pulvinar sed, bibendum ac lacus. Suspendisse in consectetur lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam elementum, est sed interdum cursus, felis ex pharetra nisi, ut elementum tortor urna eu nulla. Donec rhoncus in purus quis blandit. Etiam eleifend metus at nunc ultricies facilisis. Morbi finibus tristique interdum. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie\" title_2=\"Limitations\" content_2=\"Etiam eleifend metus at nunc ultricies facilisis. Morbi finibus tristique interdum. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie a, finibus nec ex. Aliquam elementum, est sed interdum cursus, felis ex pharetra nisi, ut elementum tortor urna eu nulla. Donec rhoncus in purus quis blandit. Etiam eleifend metus at nunc ultricies facilisis. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie a, finibus nec ex. Etiam eleifend metus at nunc ultricies facilisis. Morbi finibus tristique interdum. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie\" title_3=\"Revisions and errata\" content_3=\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed euismod justo, sit amet efficitur dui. Aliquam sodales vestibulum velit, eget sollicitudin quam. Donec non aliquam eros. Etiam sit amet lectus vel justo dignissim condimentum. In malesuada neque quis libero laoreet posuere. In consequat vitae ligula quis rutrum. Morbi dolor orci, maximus a pulvinar sed, bibendum ac lacus. Suspendisse in consectetur lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam elementum, est sed interdum cursus, felis ex pharetra nisi, ut elementum tortor urna eu nulla. Donec rhoncus in purus quis Etiam eleifend metus at nunc ultricies facilisis. Morbi finibus tristique interdum. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie a, finibus nec ex.\" title_4=\"Site terms of use modifications\" content_4=\"Etiam eleifend metus at nunc ultricies facilisis. Morbi finibus tristique interdum. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie Aliquam elementum, est sed interdum cursus, felis ex pharetra nisi, ut elementum tortor urna eu nulla. Donec rhoncus in purus quis blandit. Etiam eleifend metus at nunc ultricies facilisis. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie a, finibus nec ex. Etiam eleifend metus at nunc ultricies facilisis. Morbi finibus tristique interdum. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie\" title_5=\"Risks\" content_5=\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed euismod justo, sit amet efficitur dui. Aliquam sodales vestibulum velit, eget sollicitudin quam. Donec non aliquam eros. Etiam sit amet lectus vel justo dignissim condimentum. In malesuada neque quis libero laoreet posuere. In consequat vitae ligula quis rutrum. Morbi dolor orci, maximus a pulvinar sed, bibendum ac lacus. Suspendisse in consectetur lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam elementum, est sed interdum cursus, felis ex pharetra nisi, ut elementum tortor urna eu nulla. Donec rhoncus in purus quis blandit. Etiam eleifend metus at nunc ultricies facilisis. Morbi finibus tristique interdum. Nullam vel eleifend est, eu posuere risus. Vestibulum ligula ex, ullamcorper sit amet molestie\" enable_lazy_loading=\"yes\"][/content-tab]', 1, NULL, NULL, NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(13, 'Coming Soon', '[coming-soon title=\"Get Notified When We Launch\" countdown_time=\"2026-02-23 08:54:08\" address=\"58 Street Commercial Road Fratton, Australia\" hotline=\"+123456789\" business_hours=\"Mon – Sat: 8 am – 5 pm, Sunday: CLOSED\" show_social_links=\"1\" image=\"pages/properties.png\"][/coming-soon]', 1, NULL, 'no-layout', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(14, 'Properties', '', 1, NULL, 'no-layout', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(15, 'Projects', '', 1, NULL, 'no-layout', NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(16, 'Cookie Policy', '<h3>EU Cookie Consent</h3><p>To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.</p><h4>Essential Data</h4><p>The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.</p><p>- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.</p><p>- XSRF-Token Cookie: Laravel automatically generates a CSRF \"token\" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.</p>', 1, NULL, NULL, NULL, 'published', '2026-01-24 01:54:08', '2026-01-24 01:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `pages_translations`
--

CREATE TABLE `pages_translations` (
  `lang_code` varchar(20) NOT NULL,
  `pages_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_seo`
--

CREATE TABLE `page_seo` (
  `id` int(11) NOT NULL,
  `page_path` varchar(191) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `og_image` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(120) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `charge_id` varchar(191) DEFAULT NULL,
  `payment_channel` varchar(60) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `amount` decimal(15,2) UNSIGNED NOT NULL,
  `payment_fee` decimal(15,2) DEFAULT 0.00,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(60) DEFAULT 'pending',
  `payment_type` varchar(191) DEFAULT 'confirm',
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `refunded_amount` decimal(15,2) UNSIGNED DEFAULT NULL,
  `refund_note` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_type` varchar(191) DEFAULT NULL,
  `metadata` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(191) NOT NULL,
  `request` longtext DEFAULT NULL,
  `response` longtext DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_type` varchar(191) NOT NULL,
  `is_featured` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `format_type` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `description`, `content`, `status`, `author_id`, `author_type`, `is_featured`, `image`, `views`, `format_type`, `created_at`, `updated_at`) VALUES
(1, 'Top 10 Tips for First-time Home Buyers', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'posts/4.jpg', 1118, NULL, '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(2, 'How to Stage Your Home for a Quick Sale', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'posts/9.jpg', 2475, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(3, 'Understanding the Current Real Estate Market Trends', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'posts/10.jpg', 720, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(4, 'DIY Home Improvement Projects That Add Value', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'posts/7.jpg', 2084, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(5, 'A Beginner’s Guide to Real Estate Investing', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 1, 'posts/5.jpg', 2132, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(6, 'How to Choose the Right Neighborhood for Your Family', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/6.jpg', 1492, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(7, 'Luxury Homes: What to Look For', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/2.jpg', 1042, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(8, 'Property Management: Best Practices for Landlords', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/1.jpg', 1687, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(9, 'Renovation Ideas to Increase Your Home’s Value', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/2.jpg', 823, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(10, 'The Ultimate Guide to Buying a Vacation Home', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/4.jpg', 641, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(11, 'How to Successfully Sell Your Home in a Buyer’s Market', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/7.jpg', 296, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(12, 'Home Inspection: What to Expect and How to Prepare', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/3.jpg', 671, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(13, 'Eco-friendly Home Improvements for Sustainable Living', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/5.jpg', 372, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(14, 'How to Navigate the Mortgage Process', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/3.jpg', 2424, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(15, 'Real Estate Market Analysis: What You Need to Know', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/1.jpg', 742, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(16, 'Tips for Renting Out Your Property', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/6.jpg', 1134, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(17, 'Understanding Property Taxes and How to Lower Them', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/10.jpg', 2124, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(18, 'The Benefits of Smart Home Technology', 'Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.', '<h5>Understanding Housing Stocks</h5>\n<p>\n    Housing stocks encompass companies involved in\n    various aspects of the real estate industry, including home builders, developers, and\n    related service providers. Factors influencing these stocks range from interest\n    rates and economic indicators to trends in home ownership rates.\n</p>\n<p>\n    Pay close attention to economic indicators such as\n    employment rates, GDP growth, and consumer confidence. A strong economy often\n    correlates with increased demand for housing, benefiting related stocks.\n</p>\n[content-quote message=\"Lower rates can boost home buying activity, benefiting housing stocks, while higher rates may have the opposite effect.\" author=\"Nelson Mandela\"][/content-quote]\n\n[content-image number_of_columns=\"col-2\" quantity=\"2\" image_1=\"posts/md-1.jpg\" image_2=\"posts/md-2.jpg\"][/content-image]\n\n<h5>Identify Emerging Trends</h5>\n<p>\n    Stay informed about emerging trends in the housing\n    market, such as the demand for sustainable homes, technological advancements, and\n    demographic shifts. Companies aligning with these trends may present attractive\n    investment opportunities.\n</p>\n<p>\n    Take a long-term investment approach if you believe in\n    the stability and growth potential of the housing sector. Look for companies with\n    solid fundamentals and a track record of success. For short-term traders, capitalize\n    on market fluctuations driven by economic reports, interest rate changes, or\n    industry-specific news. Keep a close eye on earnings reports and government housing\n    data releases.\n</p>\n\n<ul>\n    <li><strong>Affordability:</strong> Compared to larger apartments, 1BHK units are more budget-friendly, making them\n        ideal for individuals and young professionals.\n    </li>\n    <li><strong>Convenience:</strong> These apartments are easier to maintain and are perfect for those who prefer a minimalist\n        lifestyle.\n    </li>\n    <li><strong>Modern Amenities:</strong> Many 1BHK apartments in Dubai come with state-of-the-art facilities such as\n        gyms, swimming pools, and 24/7 security.\n    </li>\n</ul>\n', 'published', 1, 'Botble\\ACL\\Models\\User', 0, 'posts/7.jpg', 944, NULL, '2026-01-24 01:54:03', '2026-01-24 01:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts_translations`
--

CREATE TABLE `posts_translations` (
  `lang_code` varchar(20) NOT NULL,
  `posts_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`category_id`, `post_id`) VALUES
(2, 1),
(5, 1),
(5, 2),
(4, 2),
(2, 3),
(6, 3),
(6, 4),
(2, 4),
(6, 5),
(5, 5),
(6, 6),
(3, 6),
(4, 7),
(3, 8),
(6, 8),
(2, 9),
(4, 9),
(6, 10),
(2, 10),
(3, 11),
(5, 12),
(3, 13),
(5, 13),
(4, 14),
(5, 14),
(2, 15),
(5, 16),
(2, 17),
(6, 18),
(5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`tag_id`, `post_id`) VALUES
(6, 1),
(2, 1),
(2, 2),
(1, 2),
(4, 2),
(2, 3),
(7, 3),
(3, 4),
(2, 4),
(1, 5),
(2, 5),
(3, 5),
(1, 6),
(3, 6),
(6, 6),
(4, 7),
(3, 7),
(2, 8),
(3, 8),
(8, 8),
(4, 9),
(8, 9),
(5, 10),
(4, 10),
(8, 10),
(2, 11),
(4, 11),
(1, 11),
(3, 12),
(7, 12),
(4, 13),
(6, 13),
(5, 13),
(5, 14),
(1, 14),
(6, 14),
(1, 15),
(6, 15),
(4, 16),
(5, 16),
(2, 16),
(5, 17),
(8, 17),
(3, 18),
(1, 18),
(7, 18);

-- --------------------------------------------------------

--
-- Table structure for table `push_notifications`
--

CREATE TABLE `push_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'general',
  `target_type` varchar(191) DEFAULT NULL,
  `target_value` varchar(191) DEFAULT NULL,
  `action_url` varchar(191) DEFAULT NULL,
  `image_url` varchar(191) DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `status` varchar(191) NOT NULL DEFAULT 'sent',
  `sent_count` int(11) NOT NULL DEFAULT 0,
  `failed_count` int(11) NOT NULL DEFAULT 0,
  `delivered_count` int(11) NOT NULL DEFAULT 0,
  `read_count` int(11) NOT NULL DEFAULT 0,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_recipients`
--

CREATE TABLE `push_notification_recipients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `push_notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `device_token` varchar(191) DEFAULT NULL,
  `platform` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'sent',
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `clicked_at` timestamp NULL DEFAULT NULL,
  `fcm_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fcm_response`)),
  `error_message` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE `revisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `revisionable_type` varchar(191) NOT NULL,
  `revisionable_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `key` varchar(120) NOT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_accounts`
--

CREATE TABLE `re_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(120) NOT NULL,
  `last_name` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `avatar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `whatsapp` varchar(25) DEFAULT NULL,
  `credits` int(10) UNSIGNED DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `email_verify_token` varchar(120) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verification_note` text DEFAULT NULL,
  `is_public_profile` tinyint(1) NOT NULL DEFAULT 0,
  `hide_phone` tinyint(1) NOT NULL DEFAULT 0,
  `hide_email` tinyint(1) NOT NULL DEFAULT 0,
  `company` varchar(191) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `blocked_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_accounts`
--

INSERT INTO `re_accounts` (`id`, `first_name`, `last_name`, `description`, `gender`, `email`, `username`, `password`, `avatar_id`, `dob`, `phone`, `whatsapp`, `credits`, `confirmed_at`, `email_verify_token`, `remember_token`, `created_at`, `updated_at`, `is_featured`, `is_verified`, `verified_at`, `verified_by`, `verification_note`, `is_public_profile`, `hide_phone`, `hide_email`, `company`, `country_id`, `state_id`, `city_id`, `approved_at`, `blocked_at`, `blocked_reason`) VALUES
(1, 'John', 'Smith', 'Committed to making your real estate dreams a reality.', NULL, 'john.smith@botble.com', 'john-smith-621', '$2y$12$xZYvUVDdYH8e0rdUPmpaS.VFKpDeineVTyl3EJaZBW2fzz2pDe8Eq', 13, '1989-04-14', '+14155551234', '+14155551234', 10, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:53', '2026-01-24 01:53:53', 0, 1, '2025-12-29 01:53:53', 1, 'Verified trusted agent', 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(2, 'Sarah', 'Johnson', 'Experienced agent specializing in luxury homes and investment properties.', NULL, 'agent@botble.com', 'sarah-johnson-613', '$2y$12$RKXhyhMYQExn4X0q7a3ALOqp1U5ntwcJ.s2w/kognH0pmO.M4g4fO', 23, '1995-09-25', '+12125559876', '+12125559876', 10, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:53', '2026-01-24 01:53:53', 0, 0, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(3, 'Michael', 'Garcia', 'Passionate about helping clients find their perfect home.', NULL, 'michael.garcia1@example.com', 'michael-garcia-724', '$2y$12$r70P82hslfavqtOL7/HQbeYvmUoGQM5q7Q0t/p06qd95riiDkdiCW', 21, '1971-01-02', '+12125559876', '+12125559876', 7, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:54', '2026-01-24 01:53:54', 1, 1, '2025-10-28 01:53:54', 1, '', 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(4, 'Emily', 'Miller', 'Full-service real estate professional for buyers and sellers.', NULL, 'emily.miller2@example.com', 'emily-miller-900', '$2y$12$Gs0hzT5YtP1FIe5KCeDCNORgrJpX5cEb80K1byvkD/7HZBjddtING', 16, '1998-12-20', '+13105557890', '+13105557890', 1, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:54', '2026-01-24 01:53:54', 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(5, 'David', 'Davis', 'Committed to making your real estate dreams a reality.', NULL, 'david.davis3@example.com', 'david-davis-181', '$2y$12$TzRl47kLghdnP2aLFggAM.1K94yWC3NForsqSsUpiGGreeCSP9geq', 18, '1981-01-01', '+17185554321', '+17185554321', 1, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:54', '2026-01-24 01:53:54', 1, 1, '2025-01-27 01:53:54', 1, 'Documents verified successfully', 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(6, 'Jennifer', 'Rodriguez', 'Top-performing agent with strong negotiation skills.', NULL, 'jennifer.rodriguez4@example.com', 'jennifer-rodriguez-446', '$2y$12$TttaRI./9vdGHwOeSmx3EeR6yOzj457KHcQfC/5QAuBzmXO27b39O', 14, '1982-04-03', '+16505558765', '+16505558765', 6, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:55', '2026-01-24 01:53:55', 0, 1, '2026-01-19 01:53:55', 1, 'Premium agent - verified', 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(7, 'Robert', 'Martinez', 'Passionate about helping clients find their perfect home.', NULL, 'robert.martinez5@example.com', 'robert-martinez-743', '$2y$12$2kPlMduAy4z29NZB5/PlVOARydZmvBA6Gtzyr26aDSb3CGwUEbcdy', 19, '1994-04-24', '+16465553456', '+16465553456', 6, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:55', '2026-01-24 01:53:55', 0, 0, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(8, 'Lisa', 'Wilson', 'Passionate about helping clients find their perfect home.', NULL, 'lisa.wilson6@example.com', 'lisa-wilson-209', '$2y$12$93Obv3j1jB5viVx0qNorwOv5Crfq5NkJoqOAQ0hKAmx7/VFW04thy', 18, '1991-01-10', '+14085552468', '+14085552468', 1, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:55', '2026-01-24 01:53:55', 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(9, 'James', 'Anderson', 'Passionate about helping clients find their perfect home.', NULL, 'james.anderson7@example.com', 'james-anderson-425', '$2y$12$.nWvY3Z8MxL4IV/Et36h9eJD9SD513SpSq0RXteyMiUNKh3bLRzx2', 16, '1971-09-12', '+15105551357', '+15105551357', 1, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:56', '2026-01-24 01:53:56', 1, 1, '2025-08-08 01:53:56', 1, 'Verified trusted partner', 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(10, 'Amanda', 'Smith', 'Experienced agent specializing in luxury homes and investment properties.', NULL, 'amanda.smith8@example.com', 'amanda-smith-921', '$2y$12$WZ2Ye3V0mrTqxyhM14mJL.HY/NoB4/Ak.epjc9NE41I9izDdy2lIa', 16, '1975-08-25', '+16195559630', '+16195559630', 3, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:56', '2026-01-24 01:53:56', 1, 0, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(11, 'William', 'Johnson', 'Full-service real estate professional for buyers and sellers.', NULL, 'william.johnson9@example.com', 'william-johnson-493', '$2y$12$H.W8I2zFOp1Jqy/.vAzE0..s.LzRyBZW3pHbOs66vdwq310shgsEO', 15, '1971-02-20', '+19495558520', '+19495558520', 8, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:56', '2026-01-24 01:53:56', 1, 1, '2025-10-04 01:53:56', 1, '', 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL),
(12, 'Jessica', 'Williams', 'Customer-focused agent delivering outstanding results.', NULL, 'jessica.williams10@example.com', 'jessica-williams-946', '$2y$12$tJq1fMh3uRT5AKb6DvbzMu.XcEbuRHdCzbADJ0m0De9/L27aNvawG', 17, '1989-12-01', '+13235557410', '+13235557410', 2, '2026-01-24 08:53:52', NULL, NULL, '2026-01-24 01:53:57', '2026-01-24 01:53:57', 0, 0, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, NULL, NULL, '2026-01-24 08:53:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `re_accounts_translations`
--

CREATE TABLE `re_accounts_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_accounts_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_account_activity_logs`
--

CREATE TABLE `re_account_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(120) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `reference_url` varchar(191) DEFAULT NULL,
  `reference_name` varchar(191) DEFAULT NULL,
  `ip_address` varchar(39) DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_account_packages`
--

CREATE TABLE `re_account_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_account_password_resets`
--

CREATE TABLE `re_account_password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_consults`
--

CREATE TABLE `re_consults` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(39) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `custom_fields` text DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_consult_custom_fields`
--

CREATE TABLE `re_consult_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(191) NOT NULL,
  `placeholder` varchar(191) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 999,
  `status` varchar(191) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_consult_custom_fields`
--

INSERT INTO `re_consult_custom_fields` (`id`, `type`, `required`, `name`, `placeholder`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'date', 0, 'Schedule a Tour (optional)', NULL, 999, 'published', '2026-01-24 01:54:10', '2026-01-24 01:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `re_consult_custom_fields_translations`
--

CREATE TABLE `re_consult_custom_fields_translations` (
  `re_consult_custom_fields_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(191) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `placeholder` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_consult_custom_field_options`
--

CREATE TABLE `re_consult_custom_field_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_field_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) DEFAULT NULL,
  `value` varchar(191) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 999,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_consult_custom_field_options_translations`
--

CREATE TABLE `re_consult_custom_field_options_translations` (
  `re_consult_custom_field_options_id` bigint(20) UNSIGNED NOT NULL,
  `lang_code` varchar(191) NOT NULL,
  `label` varchar(191) DEFAULT NULL,
  `value` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_coupons`
--

CREATE TABLE `re_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `code` varchar(20) NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_used` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `expires_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_currencies`
--

CREATE TABLE `re_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(60) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `is_prefix_symbol` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `decimals` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `number_format_style` varchar(50) NOT NULL DEFAULT 'western',
  `space_between_price_and_currency` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `exchange_rate` double NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_currencies`
--

INSERT INTO `re_currencies` (`id`, `title`, `symbol`, `is_prefix_symbol`, `decimals`, `number_format_style`, `space_between_price_and_currency`, `order`, `is_default`, `exchange_rate`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 1, 0, 'western', 0, 0, 1, 1, '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(2, 'EUR', '€', 0, 0, 'western', 0, 1, 0, 0.91, '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(3, 'VND', '₫', 0, 0, 'western', 0, 2, 0, 23717.5, '2026-01-24 01:53:50', '2026-01-24 01:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `re_custom_fields`
--

CREATE TABLE `re_custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `type` varchar(60) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 999,
  `is_global` tinyint(1) NOT NULL DEFAULT 0,
  `authorable_type` varchar(191) DEFAULT NULL,
  `authorable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_custom_fields_translations`
--

CREATE TABLE `re_custom_fields_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_custom_fields_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_custom_field_options`
--

CREATE TABLE `re_custom_field_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_field_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) DEFAULT NULL,
  `value` varchar(191) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 999,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_custom_field_options_translations`
--

CREATE TABLE `re_custom_field_options_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_custom_field_options_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(191) DEFAULT NULL,
  `value` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_custom_field_values`
--

CREATE TABLE `re_custom_field_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `value` varchar(191) DEFAULT NULL,
  `reference_type` varchar(191) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `custom_field_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_custom_field_values_translations`
--

CREATE TABLE `re_custom_field_values_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_custom_field_values_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `value` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_facilities`
--

CREATE TABLE `re_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `icon` varchar(60) DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_facilities`
--

INSERT INTO `re_facilities` (`id`, `name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hospital', 'ti ti-hospital', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(2, 'Super Market', 'ti ti-shopping-cart', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(3, 'School', 'ti ti-school', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(4, 'Entertainment', 'ti ti-movie', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(5, 'Pharmacy', 'ti ti-pill', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(6, 'Airport', 'ti ti-plane-departure', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(7, 'Railways', 'ti ti-train', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(8, 'Bus Stop', 'ti ti-bus', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(9, 'Beach', 'ti ti-beach', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(10, 'Mall', 'ti ti-shopping-cart', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(11, 'Bank', 'ti ti-building-bank', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `re_facilities_distances`
--

CREATE TABLE `re_facilities_distances` (
  `facility_id` bigint(20) UNSIGNED NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(191) NOT NULL,
  `distance` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_facilities_distances`
--

INSERT INTO `re_facilities_distances` (`facility_id`, `reference_id`, `reference_type`, `distance`) VALUES
(1, 1, 'Botble\\RealEstate\\Models\\Project', '14km'),
(1, 1, 'Botble\\RealEstate\\Models\\Property', '15km'),
(1, 2, 'Botble\\RealEstate\\Models\\Project', '5km'),
(1, 2, 'Botble\\RealEstate\\Models\\Property', '3km'),
(1, 3, 'Botble\\RealEstate\\Models\\Project', '9km'),
(1, 3, 'Botble\\RealEstate\\Models\\Property', '4km'),
(1, 4, 'Botble\\RealEstate\\Models\\Project', '7km'),
(1, 4, 'Botble\\RealEstate\\Models\\Property', '10km'),
(1, 5, 'Botble\\RealEstate\\Models\\Project', '19km'),
(1, 5, 'Botble\\RealEstate\\Models\\Property', '6km'),
(1, 6, 'Botble\\RealEstate\\Models\\Project', '12km'),
(1, 6, 'Botble\\RealEstate\\Models\\Property', '10km'),
(1, 7, 'Botble\\RealEstate\\Models\\Project', '8km'),
(1, 7, 'Botble\\RealEstate\\Models\\Property', '16km'),
(1, 8, 'Botble\\RealEstate\\Models\\Project', '14km'),
(1, 8, 'Botble\\RealEstate\\Models\\Property', '1km'),
(1, 9, 'Botble\\RealEstate\\Models\\Project', '13km'),
(1, 9, 'Botble\\RealEstate\\Models\\Property', '19km'),
(1, 10, 'Botble\\RealEstate\\Models\\Project', '14km'),
(1, 10, 'Botble\\RealEstate\\Models\\Property', '14km'),
(1, 11, 'Botble\\RealEstate\\Models\\Project', '20km'),
(1, 11, 'Botble\\RealEstate\\Models\\Property', '17km'),
(1, 12, 'Botble\\RealEstate\\Models\\Project', '6km'),
(1, 12, 'Botble\\RealEstate\\Models\\Property', '7km'),
(1, 13, 'Botble\\RealEstate\\Models\\Project', '6km'),
(1, 13, 'Botble\\RealEstate\\Models\\Property', '12km'),
(1, 14, 'Botble\\RealEstate\\Models\\Project', '14km'),
(1, 14, 'Botble\\RealEstate\\Models\\Property', '4km'),
(1, 15, 'Botble\\RealEstate\\Models\\Project', '19km'),
(1, 15, 'Botble\\RealEstate\\Models\\Property', '16km'),
(1, 16, 'Botble\\RealEstate\\Models\\Project', '16km'),
(1, 16, 'Botble\\RealEstate\\Models\\Property', '4km'),
(1, 17, 'Botble\\RealEstate\\Models\\Project', '9km'),
(1, 17, 'Botble\\RealEstate\\Models\\Property', '3km'),
(1, 18, 'Botble\\RealEstate\\Models\\Project', '19km'),
(1, 18, 'Botble\\RealEstate\\Models\\Property', '10km'),
(1, 19, 'Botble\\RealEstate\\Models\\Property', '4km'),
(1, 20, 'Botble\\RealEstate\\Models\\Property', '7km'),
(1, 21, 'Botble\\RealEstate\\Models\\Property', '9km'),
(1, 22, 'Botble\\RealEstate\\Models\\Property', '12km'),
(1, 23, 'Botble\\RealEstate\\Models\\Property', '3km'),
(1, 24, 'Botble\\RealEstate\\Models\\Property', '17km'),
(1, 25, 'Botble\\RealEstate\\Models\\Property', '5km'),
(1, 26, 'Botble\\RealEstate\\Models\\Property', '2km'),
(1, 27, 'Botble\\RealEstate\\Models\\Property', '1km'),
(1, 28, 'Botble\\RealEstate\\Models\\Property', '13km'),
(1, 29, 'Botble\\RealEstate\\Models\\Property', '2km'),
(1, 30, 'Botble\\RealEstate\\Models\\Property', '4km'),
(1, 31, 'Botble\\RealEstate\\Models\\Property', '16km'),
(1, 32, 'Botble\\RealEstate\\Models\\Property', '6km'),
(1, 33, 'Botble\\RealEstate\\Models\\Property', '18km'),
(1, 34, 'Botble\\RealEstate\\Models\\Property', '14km'),
(1, 35, 'Botble\\RealEstate\\Models\\Property', '18km'),
(1, 36, 'Botble\\RealEstate\\Models\\Property', '11km'),
(1, 37, 'Botble\\RealEstate\\Models\\Property', '13km'),
(1, 38, 'Botble\\RealEstate\\Models\\Property', '6km'),
(1, 39, 'Botble\\RealEstate\\Models\\Property', '6km'),
(1, 40, 'Botble\\RealEstate\\Models\\Property', '15km'),
(1, 41, 'Botble\\RealEstate\\Models\\Property', '4km'),
(1, 42, 'Botble\\RealEstate\\Models\\Property', '14km'),
(1, 43, 'Botble\\RealEstate\\Models\\Property', '9km'),
(1, 44, 'Botble\\RealEstate\\Models\\Property', '6km'),
(1, 45, 'Botble\\RealEstate\\Models\\Property', '17km'),
(1, 46, 'Botble\\RealEstate\\Models\\Property', '12km'),
(1, 47, 'Botble\\RealEstate\\Models\\Property', '12km'),
(1, 48, 'Botble\\RealEstate\\Models\\Property', '13km'),
(1, 49, 'Botble\\RealEstate\\Models\\Property', '7km'),
(1, 50, 'Botble\\RealEstate\\Models\\Property', '15km'),
(1, 51, 'Botble\\RealEstate\\Models\\Property', '6km'),
(1, 52, 'Botble\\RealEstate\\Models\\Property', '9km'),
(1, 53, 'Botble\\RealEstate\\Models\\Property', '19km'),
(1, 54, 'Botble\\RealEstate\\Models\\Property', '19km'),
(1, 55, 'Botble\\RealEstate\\Models\\Property', '5km'),
(1, 56, 'Botble\\RealEstate\\Models\\Property', '7km'),
(1, 57, 'Botble\\RealEstate\\Models\\Property', '17km'),
(1, 58, 'Botble\\RealEstate\\Models\\Property', '7km'),
(1, 59, 'Botble\\RealEstate\\Models\\Property', '2km'),
(1, 60, 'Botble\\RealEstate\\Models\\Property', '11km'),
(1, 61, 'Botble\\RealEstate\\Models\\Property', '16km'),
(2, 1, 'Botble\\RealEstate\\Models\\Project', '19km'),
(2, 1, 'Botble\\RealEstate\\Models\\Property', '16km'),
(2, 2, 'Botble\\RealEstate\\Models\\Project', '6km'),
(2, 2, 'Botble\\RealEstate\\Models\\Property', '17km'),
(2, 3, 'Botble\\RealEstate\\Models\\Project', '11km'),
(2, 3, 'Botble\\RealEstate\\Models\\Property', '8km'),
(2, 4, 'Botble\\RealEstate\\Models\\Project', '1km'),
(2, 4, 'Botble\\RealEstate\\Models\\Property', '10km'),
(2, 5, 'Botble\\RealEstate\\Models\\Project', '15km'),
(2, 5, 'Botble\\RealEstate\\Models\\Property', '14km'),
(2, 6, 'Botble\\RealEstate\\Models\\Project', '18km'),
(2, 6, 'Botble\\RealEstate\\Models\\Property', '9km'),
(2, 7, 'Botble\\RealEstate\\Models\\Project', '13km'),
(2, 7, 'Botble\\RealEstate\\Models\\Property', '8km'),
(2, 8, 'Botble\\RealEstate\\Models\\Project', '7km'),
(2, 8, 'Botble\\RealEstate\\Models\\Property', '3km'),
(2, 9, 'Botble\\RealEstate\\Models\\Project', '19km'),
(2, 9, 'Botble\\RealEstate\\Models\\Property', '1km'),
(2, 10, 'Botble\\RealEstate\\Models\\Project', '6km'),
(2, 10, 'Botble\\RealEstate\\Models\\Property', '19km'),
(2, 11, 'Botble\\RealEstate\\Models\\Project', '20km'),
(2, 11, 'Botble\\RealEstate\\Models\\Property', '17km'),
(2, 12, 'Botble\\RealEstate\\Models\\Project', '2km'),
(2, 12, 'Botble\\RealEstate\\Models\\Property', '11km'),
(2, 13, 'Botble\\RealEstate\\Models\\Project', '1km'),
(2, 13, 'Botble\\RealEstate\\Models\\Property', '6km'),
(2, 14, 'Botble\\RealEstate\\Models\\Project', '18km'),
(2, 14, 'Botble\\RealEstate\\Models\\Property', '13km'),
(2, 15, 'Botble\\RealEstate\\Models\\Project', '11km'),
(2, 15, 'Botble\\RealEstate\\Models\\Property', '10km'),
(2, 16, 'Botble\\RealEstate\\Models\\Project', '12km'),
(2, 16, 'Botble\\RealEstate\\Models\\Property', '13km'),
(2, 17, 'Botble\\RealEstate\\Models\\Project', '16km'),
(2, 17, 'Botble\\RealEstate\\Models\\Property', '14km'),
(2, 18, 'Botble\\RealEstate\\Models\\Project', '13km'),
(2, 18, 'Botble\\RealEstate\\Models\\Property', '1km'),
(2, 19, 'Botble\\RealEstate\\Models\\Property', '14km'),
(2, 20, 'Botble\\RealEstate\\Models\\Property', '20km'),
(2, 21, 'Botble\\RealEstate\\Models\\Property', '8km'),
(2, 22, 'Botble\\RealEstate\\Models\\Property', '3km'),
(2, 23, 'Botble\\RealEstate\\Models\\Property', '15km'),
(2, 24, 'Botble\\RealEstate\\Models\\Property', '14km'),
(2, 25, 'Botble\\RealEstate\\Models\\Property', '15km'),
(2, 26, 'Botble\\RealEstate\\Models\\Property', '8km'),
(2, 27, 'Botble\\RealEstate\\Models\\Property', '17km'),
(2, 28, 'Botble\\RealEstate\\Models\\Property', '12km'),
(2, 29, 'Botble\\RealEstate\\Models\\Property', '14km'),
(2, 30, 'Botble\\RealEstate\\Models\\Property', '20km'),
(2, 31, 'Botble\\RealEstate\\Models\\Property', '19km'),
(2, 32, 'Botble\\RealEstate\\Models\\Property', '12km'),
(2, 33, 'Botble\\RealEstate\\Models\\Property', '14km'),
(2, 34, 'Botble\\RealEstate\\Models\\Property', '8km'),
(2, 35, 'Botble\\RealEstate\\Models\\Property', '1km'),
(2, 36, 'Botble\\RealEstate\\Models\\Property', '18km'),
(2, 37, 'Botble\\RealEstate\\Models\\Property', '20km'),
(2, 38, 'Botble\\RealEstate\\Models\\Property', '5km'),
(2, 39, 'Botble\\RealEstate\\Models\\Property', '1km'),
(2, 40, 'Botble\\RealEstate\\Models\\Property', '12km'),
(2, 41, 'Botble\\RealEstate\\Models\\Property', '1km'),
(2, 42, 'Botble\\RealEstate\\Models\\Property', '13km'),
(2, 43, 'Botble\\RealEstate\\Models\\Property', '6km'),
(2, 44, 'Botble\\RealEstate\\Models\\Property', '10km'),
(2, 45, 'Botble\\RealEstate\\Models\\Property', '18km'),
(2, 46, 'Botble\\RealEstate\\Models\\Property', '12km'),
(2, 47, 'Botble\\RealEstate\\Models\\Property', '18km'),
(2, 48, 'Botble\\RealEstate\\Models\\Property', '13km'),
(2, 49, 'Botble\\RealEstate\\Models\\Property', '17km'),
(2, 50, 'Botble\\RealEstate\\Models\\Property', '18km'),
(2, 51, 'Botble\\RealEstate\\Models\\Property', '6km'),
(2, 52, 'Botble\\RealEstate\\Models\\Property', '2km'),
(2, 53, 'Botble\\RealEstate\\Models\\Property', '13km'),
(2, 54, 'Botble\\RealEstate\\Models\\Property', '16km'),
(2, 55, 'Botble\\RealEstate\\Models\\Property', '9km'),
(2, 56, 'Botble\\RealEstate\\Models\\Property', '20km'),
(2, 57, 'Botble\\RealEstate\\Models\\Property', '11km'),
(2, 58, 'Botble\\RealEstate\\Models\\Property', '11km'),
(2, 59, 'Botble\\RealEstate\\Models\\Property', '13km'),
(2, 60, 'Botble\\RealEstate\\Models\\Property', '8km'),
(2, 61, 'Botble\\RealEstate\\Models\\Property', '13km'),
(3, 1, 'Botble\\RealEstate\\Models\\Project', '3km'),
(3, 1, 'Botble\\RealEstate\\Models\\Property', '11km'),
(3, 2, 'Botble\\RealEstate\\Models\\Project', '19km'),
(3, 2, 'Botble\\RealEstate\\Models\\Property', '13km'),
(3, 3, 'Botble\\RealEstate\\Models\\Project', '8km'),
(3, 3, 'Botble\\RealEstate\\Models\\Property', '13km'),
(3, 4, 'Botble\\RealEstate\\Models\\Project', '17km'),
(3, 4, 'Botble\\RealEstate\\Models\\Property', '17km'),
(3, 5, 'Botble\\RealEstate\\Models\\Project', '13km'),
(3, 5, 'Botble\\RealEstate\\Models\\Property', '7km'),
(3, 6, 'Botble\\RealEstate\\Models\\Project', '9km'),
(3, 6, 'Botble\\RealEstate\\Models\\Property', '20km'),
(3, 7, 'Botble\\RealEstate\\Models\\Project', '11km'),
(3, 7, 'Botble\\RealEstate\\Models\\Property', '16km'),
(3, 8, 'Botble\\RealEstate\\Models\\Project', '12km'),
(3, 8, 'Botble\\RealEstate\\Models\\Property', '5km'),
(3, 9, 'Botble\\RealEstate\\Models\\Project', '7km'),
(3, 9, 'Botble\\RealEstate\\Models\\Property', '6km'),
(3, 10, 'Botble\\RealEstate\\Models\\Project', '10km'),
(3, 10, 'Botble\\RealEstate\\Models\\Property', '7km'),
(3, 11, 'Botble\\RealEstate\\Models\\Project', '3km'),
(3, 11, 'Botble\\RealEstate\\Models\\Property', '18km'),
(3, 12, 'Botble\\RealEstate\\Models\\Project', '7km'),
(3, 12, 'Botble\\RealEstate\\Models\\Property', '7km'),
(3, 13, 'Botble\\RealEstate\\Models\\Project', '11km'),
(3, 13, 'Botble\\RealEstate\\Models\\Property', '6km'),
(3, 14, 'Botble\\RealEstate\\Models\\Project', '16km'),
(3, 14, 'Botble\\RealEstate\\Models\\Property', '8km'),
(3, 15, 'Botble\\RealEstate\\Models\\Project', '17km'),
(3, 15, 'Botble\\RealEstate\\Models\\Property', '13km'),
(3, 16, 'Botble\\RealEstate\\Models\\Project', '1km'),
(3, 16, 'Botble\\RealEstate\\Models\\Property', '3km'),
(3, 17, 'Botble\\RealEstate\\Models\\Project', '18km'),
(3, 17, 'Botble\\RealEstate\\Models\\Property', '4km'),
(3, 18, 'Botble\\RealEstate\\Models\\Project', '12km'),
(3, 18, 'Botble\\RealEstate\\Models\\Property', '11km'),
(3, 19, 'Botble\\RealEstate\\Models\\Property', '4km'),
(3, 20, 'Botble\\RealEstate\\Models\\Property', '19km'),
(3, 21, 'Botble\\RealEstate\\Models\\Property', '13km'),
(3, 22, 'Botble\\RealEstate\\Models\\Property', '10km'),
(3, 23, 'Botble\\RealEstate\\Models\\Property', '2km'),
(3, 24, 'Botble\\RealEstate\\Models\\Property', '19km'),
(3, 25, 'Botble\\RealEstate\\Models\\Property', '12km'),
(3, 26, 'Botble\\RealEstate\\Models\\Property', '2km'),
(3, 27, 'Botble\\RealEstate\\Models\\Property', '8km'),
(3, 28, 'Botble\\RealEstate\\Models\\Property', '4km'),
(3, 29, 'Botble\\RealEstate\\Models\\Property', '14km'),
(3, 30, 'Botble\\RealEstate\\Models\\Property', '18km'),
(3, 31, 'Botble\\RealEstate\\Models\\Property', '12km'),
(3, 32, 'Botble\\RealEstate\\Models\\Property', '2km'),
(3, 33, 'Botble\\RealEstate\\Models\\Property', '13km'),
(3, 34, 'Botble\\RealEstate\\Models\\Property', '9km'),
(3, 35, 'Botble\\RealEstate\\Models\\Property', '15km'),
(3, 36, 'Botble\\RealEstate\\Models\\Property', '20km'),
(3, 37, 'Botble\\RealEstate\\Models\\Property', '18km'),
(3, 38, 'Botble\\RealEstate\\Models\\Property', '6km'),
(3, 39, 'Botble\\RealEstate\\Models\\Property', '6km'),
(3, 40, 'Botble\\RealEstate\\Models\\Property', '4km'),
(3, 41, 'Botble\\RealEstate\\Models\\Property', '8km'),
(3, 42, 'Botble\\RealEstate\\Models\\Property', '9km'),
(3, 43, 'Botble\\RealEstate\\Models\\Property', '9km'),
(3, 44, 'Botble\\RealEstate\\Models\\Property', '8km'),
(3, 45, 'Botble\\RealEstate\\Models\\Property', '11km'),
(3, 46, 'Botble\\RealEstate\\Models\\Property', '10km'),
(3, 47, 'Botble\\RealEstate\\Models\\Property', '1km'),
(3, 48, 'Botble\\RealEstate\\Models\\Property', '9km'),
(3, 49, 'Botble\\RealEstate\\Models\\Property', '1km'),
(3, 50, 'Botble\\RealEstate\\Models\\Property', '8km'),
(3, 51, 'Botble\\RealEstate\\Models\\Property', '4km'),
(3, 52, 'Botble\\RealEstate\\Models\\Property', '1km'),
(3, 53, 'Botble\\RealEstate\\Models\\Property', '18km'),
(3, 54, 'Botble\\RealEstate\\Models\\Property', '10km'),
(3, 55, 'Botble\\RealEstate\\Models\\Property', '4km'),
(3, 56, 'Botble\\RealEstate\\Models\\Property', '8km'),
(3, 57, 'Botble\\RealEstate\\Models\\Property', '5km'),
(3, 58, 'Botble\\RealEstate\\Models\\Property', '6km'),
(3, 59, 'Botble\\RealEstate\\Models\\Property', '11km'),
(3, 60, 'Botble\\RealEstate\\Models\\Property', '10km'),
(3, 61, 'Botble\\RealEstate\\Models\\Property', '2km'),
(4, 1, 'Botble\\RealEstate\\Models\\Project', '20km'),
(4, 1, 'Botble\\RealEstate\\Models\\Property', '6km'),
(4, 2, 'Botble\\RealEstate\\Models\\Project', '2km'),
(4, 2, 'Botble\\RealEstate\\Models\\Property', '4km'),
(4, 3, 'Botble\\RealEstate\\Models\\Project', '15km'),
(4, 3, 'Botble\\RealEstate\\Models\\Property', '11km'),
(4, 4, 'Botble\\RealEstate\\Models\\Project', '12km'),
(4, 4, 'Botble\\RealEstate\\Models\\Property', '17km'),
(4, 5, 'Botble\\RealEstate\\Models\\Project', '17km'),
(4, 5, 'Botble\\RealEstate\\Models\\Property', '6km'),
(4, 6, 'Botble\\RealEstate\\Models\\Project', '6km'),
(4, 6, 'Botble\\RealEstate\\Models\\Property', '8km'),
(4, 7, 'Botble\\RealEstate\\Models\\Project', '15km'),
(4, 7, 'Botble\\RealEstate\\Models\\Property', '14km'),
(4, 8, 'Botble\\RealEstate\\Models\\Project', '2km'),
(4, 8, 'Botble\\RealEstate\\Models\\Property', '11km'),
(4, 9, 'Botble\\RealEstate\\Models\\Project', '11km'),
(4, 9, 'Botble\\RealEstate\\Models\\Property', '14km'),
(4, 10, 'Botble\\RealEstate\\Models\\Project', '17km'),
(4, 10, 'Botble\\RealEstate\\Models\\Property', '13km'),
(4, 11, 'Botble\\RealEstate\\Models\\Project', '13km'),
(4, 11, 'Botble\\RealEstate\\Models\\Property', '7km'),
(4, 12, 'Botble\\RealEstate\\Models\\Project', '6km'),
(4, 12, 'Botble\\RealEstate\\Models\\Property', '11km'),
(4, 13, 'Botble\\RealEstate\\Models\\Project', '19km'),
(4, 13, 'Botble\\RealEstate\\Models\\Property', '5km'),
(4, 14, 'Botble\\RealEstate\\Models\\Project', '4km'),
(4, 14, 'Botble\\RealEstate\\Models\\Property', '11km'),
(4, 15, 'Botble\\RealEstate\\Models\\Project', '10km'),
(4, 15, 'Botble\\RealEstate\\Models\\Property', '7km'),
(4, 16, 'Botble\\RealEstate\\Models\\Project', '7km'),
(4, 16, 'Botble\\RealEstate\\Models\\Property', '6km'),
(4, 17, 'Botble\\RealEstate\\Models\\Project', '4km'),
(4, 17, 'Botble\\RealEstate\\Models\\Property', '4km'),
(4, 18, 'Botble\\RealEstate\\Models\\Project', '18km'),
(4, 18, 'Botble\\RealEstate\\Models\\Property', '15km'),
(4, 19, 'Botble\\RealEstate\\Models\\Property', '2km'),
(4, 20, 'Botble\\RealEstate\\Models\\Property', '10km'),
(4, 21, 'Botble\\RealEstate\\Models\\Property', '8km'),
(4, 22, 'Botble\\RealEstate\\Models\\Property', '7km'),
(4, 23, 'Botble\\RealEstate\\Models\\Property', '1km'),
(4, 24, 'Botble\\RealEstate\\Models\\Property', '1km'),
(4, 25, 'Botble\\RealEstate\\Models\\Property', '6km'),
(4, 26, 'Botble\\RealEstate\\Models\\Property', '8km'),
(4, 27, 'Botble\\RealEstate\\Models\\Property', '7km'),
(4, 28, 'Botble\\RealEstate\\Models\\Property', '14km'),
(4, 29, 'Botble\\RealEstate\\Models\\Property', '13km'),
(4, 30, 'Botble\\RealEstate\\Models\\Property', '18km'),
(4, 31, 'Botble\\RealEstate\\Models\\Property', '18km'),
(4, 32, 'Botble\\RealEstate\\Models\\Property', '3km'),
(4, 33, 'Botble\\RealEstate\\Models\\Property', '3km'),
(4, 34, 'Botble\\RealEstate\\Models\\Property', '17km'),
(4, 35, 'Botble\\RealEstate\\Models\\Property', '10km'),
(4, 36, 'Botble\\RealEstate\\Models\\Property', '7km'),
(4, 37, 'Botble\\RealEstate\\Models\\Property', '8km'),
(4, 38, 'Botble\\RealEstate\\Models\\Property', '16km'),
(4, 39, 'Botble\\RealEstate\\Models\\Property', '7km'),
(4, 40, 'Botble\\RealEstate\\Models\\Property', '3km'),
(4, 41, 'Botble\\RealEstate\\Models\\Property', '10km'),
(4, 42, 'Botble\\RealEstate\\Models\\Property', '13km'),
(4, 43, 'Botble\\RealEstate\\Models\\Property', '15km'),
(4, 44, 'Botble\\RealEstate\\Models\\Property', '3km'),
(4, 45, 'Botble\\RealEstate\\Models\\Property', '1km'),
(4, 46, 'Botble\\RealEstate\\Models\\Property', '2km'),
(4, 47, 'Botble\\RealEstate\\Models\\Property', '8km'),
(4, 48, 'Botble\\RealEstate\\Models\\Property', '12km'),
(4, 49, 'Botble\\RealEstate\\Models\\Property', '11km'),
(4, 50, 'Botble\\RealEstate\\Models\\Property', '5km'),
(4, 51, 'Botble\\RealEstate\\Models\\Property', '14km'),
(4, 52, 'Botble\\RealEstate\\Models\\Property', '20km'),
(4, 53, 'Botble\\RealEstate\\Models\\Property', '16km'),
(4, 54, 'Botble\\RealEstate\\Models\\Property', '17km'),
(4, 55, 'Botble\\RealEstate\\Models\\Property', '6km'),
(4, 56, 'Botble\\RealEstate\\Models\\Property', '2km'),
(4, 57, 'Botble\\RealEstate\\Models\\Property', '2km'),
(4, 58, 'Botble\\RealEstate\\Models\\Property', '14km'),
(4, 59, 'Botble\\RealEstate\\Models\\Property', '13km'),
(4, 60, 'Botble\\RealEstate\\Models\\Property', '6km'),
(4, 61, 'Botble\\RealEstate\\Models\\Property', '13km'),
(5, 1, 'Botble\\RealEstate\\Models\\Project', '10km'),
(5, 1, 'Botble\\RealEstate\\Models\\Property', '11km'),
(5, 2, 'Botble\\RealEstate\\Models\\Project', '2km'),
(5, 2, 'Botble\\RealEstate\\Models\\Property', '16km'),
(5, 3, 'Botble\\RealEstate\\Models\\Project', '3km'),
(5, 3, 'Botble\\RealEstate\\Models\\Property', '6km'),
(5, 4, 'Botble\\RealEstate\\Models\\Project', '2km'),
(5, 4, 'Botble\\RealEstate\\Models\\Property', '8km'),
(5, 5, 'Botble\\RealEstate\\Models\\Project', '19km'),
(5, 5, 'Botble\\RealEstate\\Models\\Property', '19km'),
(5, 6, 'Botble\\RealEstate\\Models\\Project', '3km'),
(5, 6, 'Botble\\RealEstate\\Models\\Property', '8km'),
(5, 7, 'Botble\\RealEstate\\Models\\Project', '1km'),
(5, 7, 'Botble\\RealEstate\\Models\\Property', '11km'),
(5, 8, 'Botble\\RealEstate\\Models\\Project', '8km'),
(5, 8, 'Botble\\RealEstate\\Models\\Property', '17km'),
(5, 9, 'Botble\\RealEstate\\Models\\Project', '6km'),
(5, 9, 'Botble\\RealEstate\\Models\\Property', '16km'),
(5, 10, 'Botble\\RealEstate\\Models\\Project', '8km'),
(5, 10, 'Botble\\RealEstate\\Models\\Property', '3km'),
(5, 11, 'Botble\\RealEstate\\Models\\Project', '18km'),
(5, 11, 'Botble\\RealEstate\\Models\\Property', '2km'),
(5, 12, 'Botble\\RealEstate\\Models\\Project', '4km'),
(5, 12, 'Botble\\RealEstate\\Models\\Property', '9km'),
(5, 13, 'Botble\\RealEstate\\Models\\Project', '16km'),
(5, 13, 'Botble\\RealEstate\\Models\\Property', '1km'),
(5, 14, 'Botble\\RealEstate\\Models\\Project', '15km'),
(5, 14, 'Botble\\RealEstate\\Models\\Property', '1km'),
(5, 15, 'Botble\\RealEstate\\Models\\Project', '9km'),
(5, 15, 'Botble\\RealEstate\\Models\\Property', '19km'),
(5, 16, 'Botble\\RealEstate\\Models\\Project', '17km'),
(5, 16, 'Botble\\RealEstate\\Models\\Property', '19km'),
(5, 17, 'Botble\\RealEstate\\Models\\Project', '8km'),
(5, 17, 'Botble\\RealEstate\\Models\\Property', '18km'),
(5, 18, 'Botble\\RealEstate\\Models\\Project', '16km'),
(5, 18, 'Botble\\RealEstate\\Models\\Property', '6km'),
(5, 19, 'Botble\\RealEstate\\Models\\Property', '3km'),
(5, 20, 'Botble\\RealEstate\\Models\\Property', '6km'),
(5, 21, 'Botble\\RealEstate\\Models\\Property', '5km'),
(5, 22, 'Botble\\RealEstate\\Models\\Property', '4km'),
(5, 23, 'Botble\\RealEstate\\Models\\Property', '16km'),
(5, 24, 'Botble\\RealEstate\\Models\\Property', '16km'),
(5, 25, 'Botble\\RealEstate\\Models\\Property', '15km'),
(5, 26, 'Botble\\RealEstate\\Models\\Property', '17km'),
(5, 27, 'Botble\\RealEstate\\Models\\Property', '16km'),
(5, 28, 'Botble\\RealEstate\\Models\\Property', '1km'),
(5, 29, 'Botble\\RealEstate\\Models\\Property', '4km'),
(5, 30, 'Botble\\RealEstate\\Models\\Property', '16km'),
(5, 31, 'Botble\\RealEstate\\Models\\Property', '3km'),
(5, 32, 'Botble\\RealEstate\\Models\\Property', '18km'),
(5, 33, 'Botble\\RealEstate\\Models\\Property', '18km'),
(5, 34, 'Botble\\RealEstate\\Models\\Property', '3km'),
(5, 35, 'Botble\\RealEstate\\Models\\Property', '13km'),
(5, 36, 'Botble\\RealEstate\\Models\\Property', '15km'),
(5, 37, 'Botble\\RealEstate\\Models\\Property', '11km'),
(5, 38, 'Botble\\RealEstate\\Models\\Property', '17km'),
(5, 39, 'Botble\\RealEstate\\Models\\Property', '6km'),
(5, 40, 'Botble\\RealEstate\\Models\\Property', '7km'),
(5, 41, 'Botble\\RealEstate\\Models\\Property', '12km'),
(5, 42, 'Botble\\RealEstate\\Models\\Property', '15km'),
(5, 43, 'Botble\\RealEstate\\Models\\Property', '11km'),
(5, 44, 'Botble\\RealEstate\\Models\\Property', '18km'),
(5, 45, 'Botble\\RealEstate\\Models\\Property', '15km'),
(5, 46, 'Botble\\RealEstate\\Models\\Property', '4km'),
(5, 47, 'Botble\\RealEstate\\Models\\Property', '8km'),
(5, 48, 'Botble\\RealEstate\\Models\\Property', '20km'),
(5, 49, 'Botble\\RealEstate\\Models\\Property', '14km'),
(5, 50, 'Botble\\RealEstate\\Models\\Property', '9km'),
(5, 51, 'Botble\\RealEstate\\Models\\Property', '12km'),
(5, 52, 'Botble\\RealEstate\\Models\\Property', '12km'),
(5, 53, 'Botble\\RealEstate\\Models\\Property', '2km'),
(5, 54, 'Botble\\RealEstate\\Models\\Property', '20km'),
(5, 55, 'Botble\\RealEstate\\Models\\Property', '9km'),
(5, 56, 'Botble\\RealEstate\\Models\\Property', '1km'),
(5, 57, 'Botble\\RealEstate\\Models\\Property', '10km'),
(5, 58, 'Botble\\RealEstate\\Models\\Property', '12km'),
(5, 59, 'Botble\\RealEstate\\Models\\Property', '11km'),
(5, 60, 'Botble\\RealEstate\\Models\\Property', '19km'),
(5, 61, 'Botble\\RealEstate\\Models\\Property', '20km'),
(6, 1, 'Botble\\RealEstate\\Models\\Project', '7km'),
(6, 1, 'Botble\\RealEstate\\Models\\Property', '11km'),
(6, 2, 'Botble\\RealEstate\\Models\\Project', '6km'),
(6, 2, 'Botble\\RealEstate\\Models\\Property', '14km'),
(6, 3, 'Botble\\RealEstate\\Models\\Project', '15km'),
(6, 3, 'Botble\\RealEstate\\Models\\Property', '2km'),
(6, 4, 'Botble\\RealEstate\\Models\\Project', '4km'),
(6, 4, 'Botble\\RealEstate\\Models\\Property', '14km'),
(6, 5, 'Botble\\RealEstate\\Models\\Project', '5km'),
(6, 5, 'Botble\\RealEstate\\Models\\Property', '9km'),
(6, 6, 'Botble\\RealEstate\\Models\\Project', '9km'),
(6, 6, 'Botble\\RealEstate\\Models\\Property', '8km'),
(6, 7, 'Botble\\RealEstate\\Models\\Project', '8km'),
(6, 7, 'Botble\\RealEstate\\Models\\Property', '19km'),
(6, 8, 'Botble\\RealEstate\\Models\\Project', '11km'),
(6, 8, 'Botble\\RealEstate\\Models\\Property', '2km'),
(6, 9, 'Botble\\RealEstate\\Models\\Project', '18km'),
(6, 9, 'Botble\\RealEstate\\Models\\Property', '6km'),
(6, 10, 'Botble\\RealEstate\\Models\\Project', '3km'),
(6, 10, 'Botble\\RealEstate\\Models\\Property', '18km'),
(6, 11, 'Botble\\RealEstate\\Models\\Project', '7km'),
(6, 11, 'Botble\\RealEstate\\Models\\Property', '20km'),
(6, 12, 'Botble\\RealEstate\\Models\\Project', '13km'),
(6, 12, 'Botble\\RealEstate\\Models\\Property', '15km'),
(6, 13, 'Botble\\RealEstate\\Models\\Project', '5km'),
(6, 13, 'Botble\\RealEstate\\Models\\Property', '19km'),
(6, 14, 'Botble\\RealEstate\\Models\\Project', '18km'),
(6, 14, 'Botble\\RealEstate\\Models\\Property', '8km'),
(6, 15, 'Botble\\RealEstate\\Models\\Project', '2km'),
(6, 15, 'Botble\\RealEstate\\Models\\Property', '4km'),
(6, 16, 'Botble\\RealEstate\\Models\\Project', '2km'),
(6, 16, 'Botble\\RealEstate\\Models\\Property', '12km'),
(6, 17, 'Botble\\RealEstate\\Models\\Project', '19km'),
(6, 17, 'Botble\\RealEstate\\Models\\Property', '4km'),
(6, 18, 'Botble\\RealEstate\\Models\\Project', '1km'),
(6, 18, 'Botble\\RealEstate\\Models\\Property', '16km'),
(6, 19, 'Botble\\RealEstate\\Models\\Property', '1km'),
(6, 20, 'Botble\\RealEstate\\Models\\Property', '3km'),
(6, 21, 'Botble\\RealEstate\\Models\\Property', '14km'),
(6, 22, 'Botble\\RealEstate\\Models\\Property', '10km'),
(6, 23, 'Botble\\RealEstate\\Models\\Property', '3km'),
(6, 24, 'Botble\\RealEstate\\Models\\Property', '11km'),
(6, 25, 'Botble\\RealEstate\\Models\\Property', '18km'),
(6, 26, 'Botble\\RealEstate\\Models\\Property', '15km'),
(6, 27, 'Botble\\RealEstate\\Models\\Property', '5km'),
(6, 28, 'Botble\\RealEstate\\Models\\Property', '10km'),
(6, 29, 'Botble\\RealEstate\\Models\\Property', '10km'),
(6, 30, 'Botble\\RealEstate\\Models\\Property', '7km'),
(6, 31, 'Botble\\RealEstate\\Models\\Property', '12km'),
(6, 32, 'Botble\\RealEstate\\Models\\Property', '8km'),
(6, 33, 'Botble\\RealEstate\\Models\\Property', '2km'),
(6, 34, 'Botble\\RealEstate\\Models\\Property', '6km'),
(6, 35, 'Botble\\RealEstate\\Models\\Property', '11km'),
(6, 36, 'Botble\\RealEstate\\Models\\Property', '13km'),
(6, 37, 'Botble\\RealEstate\\Models\\Property', '19km'),
(6, 38, 'Botble\\RealEstate\\Models\\Property', '5km'),
(6, 39, 'Botble\\RealEstate\\Models\\Property', '4km'),
(6, 40, 'Botble\\RealEstate\\Models\\Property', '3km'),
(6, 41, 'Botble\\RealEstate\\Models\\Property', '11km'),
(6, 42, 'Botble\\RealEstate\\Models\\Property', '5km'),
(6, 43, 'Botble\\RealEstate\\Models\\Property', '5km'),
(6, 44, 'Botble\\RealEstate\\Models\\Property', '15km'),
(6, 45, 'Botble\\RealEstate\\Models\\Property', '11km'),
(6, 46, 'Botble\\RealEstate\\Models\\Property', '1km'),
(6, 47, 'Botble\\RealEstate\\Models\\Property', '8km'),
(6, 48, 'Botble\\RealEstate\\Models\\Property', '1km'),
(6, 49, 'Botble\\RealEstate\\Models\\Property', '2km'),
(6, 50, 'Botble\\RealEstate\\Models\\Property', '12km'),
(6, 51, 'Botble\\RealEstate\\Models\\Property', '10km'),
(6, 52, 'Botble\\RealEstate\\Models\\Property', '9km'),
(6, 53, 'Botble\\RealEstate\\Models\\Property', '2km'),
(6, 54, 'Botble\\RealEstate\\Models\\Property', '17km'),
(6, 55, 'Botble\\RealEstate\\Models\\Property', '1km'),
(6, 56, 'Botble\\RealEstate\\Models\\Property', '20km'),
(6, 57, 'Botble\\RealEstate\\Models\\Property', '7km'),
(6, 58, 'Botble\\RealEstate\\Models\\Property', '14km'),
(6, 59, 'Botble\\RealEstate\\Models\\Property', '9km'),
(6, 60, 'Botble\\RealEstate\\Models\\Property', '13km'),
(6, 61, 'Botble\\RealEstate\\Models\\Property', '1km'),
(7, 1, 'Botble\\RealEstate\\Models\\Project', '6km'),
(7, 1, 'Botble\\RealEstate\\Models\\Property', '19km'),
(7, 2, 'Botble\\RealEstate\\Models\\Project', '5km'),
(7, 2, 'Botble\\RealEstate\\Models\\Property', '7km'),
(7, 3, 'Botble\\RealEstate\\Models\\Project', '8km'),
(7, 3, 'Botble\\RealEstate\\Models\\Property', '7km'),
(7, 4, 'Botble\\RealEstate\\Models\\Project', '20km'),
(7, 4, 'Botble\\RealEstate\\Models\\Property', '8km'),
(7, 5, 'Botble\\RealEstate\\Models\\Project', '11km'),
(7, 5, 'Botble\\RealEstate\\Models\\Property', '16km'),
(7, 6, 'Botble\\RealEstate\\Models\\Project', '17km'),
(7, 6, 'Botble\\RealEstate\\Models\\Property', '6km'),
(7, 7, 'Botble\\RealEstate\\Models\\Project', '7km'),
(7, 7, 'Botble\\RealEstate\\Models\\Property', '10km'),
(7, 8, 'Botble\\RealEstate\\Models\\Project', '18km'),
(7, 8, 'Botble\\RealEstate\\Models\\Property', '15km'),
(7, 9, 'Botble\\RealEstate\\Models\\Project', '6km'),
(7, 9, 'Botble\\RealEstate\\Models\\Property', '8km'),
(7, 10, 'Botble\\RealEstate\\Models\\Project', '8km'),
(7, 10, 'Botble\\RealEstate\\Models\\Property', '4km'),
(7, 11, 'Botble\\RealEstate\\Models\\Project', '5km'),
(7, 11, 'Botble\\RealEstate\\Models\\Property', '4km'),
(7, 12, 'Botble\\RealEstate\\Models\\Project', '2km'),
(7, 12, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 13, 'Botble\\RealEstate\\Models\\Project', '20km'),
(7, 13, 'Botble\\RealEstate\\Models\\Property', '7km'),
(7, 14, 'Botble\\RealEstate\\Models\\Project', '1km'),
(7, 14, 'Botble\\RealEstate\\Models\\Property', '11km'),
(7, 15, 'Botble\\RealEstate\\Models\\Project', '16km'),
(7, 15, 'Botble\\RealEstate\\Models\\Property', '16km'),
(7, 16, 'Botble\\RealEstate\\Models\\Project', '9km'),
(7, 16, 'Botble\\RealEstate\\Models\\Property', '12km'),
(7, 17, 'Botble\\RealEstate\\Models\\Project', '8km'),
(7, 17, 'Botble\\RealEstate\\Models\\Property', '3km'),
(7, 18, 'Botble\\RealEstate\\Models\\Project', '14km'),
(7, 18, 'Botble\\RealEstate\\Models\\Property', '11km'),
(7, 19, 'Botble\\RealEstate\\Models\\Property', '11km'),
(7, 20, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 21, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 22, 'Botble\\RealEstate\\Models\\Property', '3km'),
(7, 23, 'Botble\\RealEstate\\Models\\Property', '4km'),
(7, 24, 'Botble\\RealEstate\\Models\\Property', '6km'),
(7, 25, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 26, 'Botble\\RealEstate\\Models\\Property', '16km'),
(7, 27, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 28, 'Botble\\RealEstate\\Models\\Property', '11km'),
(7, 29, 'Botble\\RealEstate\\Models\\Property', '8km'),
(7, 30, 'Botble\\RealEstate\\Models\\Property', '16km'),
(7, 31, 'Botble\\RealEstate\\Models\\Property', '6km'),
(7, 32, 'Botble\\RealEstate\\Models\\Property', '4km'),
(7, 33, 'Botble\\RealEstate\\Models\\Property', '17km'),
(7, 34, 'Botble\\RealEstate\\Models\\Property', '10km'),
(7, 35, 'Botble\\RealEstate\\Models\\Property', '17km'),
(7, 36, 'Botble\\RealEstate\\Models\\Property', '10km'),
(7, 37, 'Botble\\RealEstate\\Models\\Property', '7km'),
(7, 38, 'Botble\\RealEstate\\Models\\Property', '2km'),
(7, 39, 'Botble\\RealEstate\\Models\\Property', '8km'),
(7, 40, 'Botble\\RealEstate\\Models\\Property', '13km'),
(7, 41, 'Botble\\RealEstate\\Models\\Property', '5km'),
(7, 42, 'Botble\\RealEstate\\Models\\Property', '11km'),
(7, 43, 'Botble\\RealEstate\\Models\\Property', '2km'),
(7, 44, 'Botble\\RealEstate\\Models\\Property', '20km'),
(7, 45, 'Botble\\RealEstate\\Models\\Property', '6km'),
(7, 46, 'Botble\\RealEstate\\Models\\Property', '9km'),
(7, 47, 'Botble\\RealEstate\\Models\\Property', '10km'),
(7, 48, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 49, 'Botble\\RealEstate\\Models\\Property', '10km'),
(7, 50, 'Botble\\RealEstate\\Models\\Property', '20km'),
(7, 51, 'Botble\\RealEstate\\Models\\Property', '5km'),
(7, 52, 'Botble\\RealEstate\\Models\\Property', '4km'),
(7, 53, 'Botble\\RealEstate\\Models\\Property', '5km'),
(7, 54, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 55, 'Botble\\RealEstate\\Models\\Property', '14km'),
(7, 56, 'Botble\\RealEstate\\Models\\Property', '5km'),
(7, 57, 'Botble\\RealEstate\\Models\\Property', '20km'),
(7, 58, 'Botble\\RealEstate\\Models\\Property', '1km'),
(7, 59, 'Botble\\RealEstate\\Models\\Property', '3km'),
(7, 60, 'Botble\\RealEstate\\Models\\Property', '4km'),
(7, 61, 'Botble\\RealEstate\\Models\\Property', '1km'),
(8, 1, 'Botble\\RealEstate\\Models\\Project', '19km'),
(8, 1, 'Botble\\RealEstate\\Models\\Property', '4km'),
(8, 2, 'Botble\\RealEstate\\Models\\Project', '3km'),
(8, 2, 'Botble\\RealEstate\\Models\\Property', '1km'),
(8, 3, 'Botble\\RealEstate\\Models\\Project', '16km'),
(8, 3, 'Botble\\RealEstate\\Models\\Property', '16km'),
(8, 4, 'Botble\\RealEstate\\Models\\Project', '19km'),
(8, 4, 'Botble\\RealEstate\\Models\\Property', '13km'),
(8, 5, 'Botble\\RealEstate\\Models\\Project', '9km'),
(8, 5, 'Botble\\RealEstate\\Models\\Property', '15km'),
(8, 6, 'Botble\\RealEstate\\Models\\Project', '2km'),
(8, 6, 'Botble\\RealEstate\\Models\\Property', '16km'),
(8, 7, 'Botble\\RealEstate\\Models\\Project', '13km'),
(8, 7, 'Botble\\RealEstate\\Models\\Property', '4km'),
(8, 8, 'Botble\\RealEstate\\Models\\Project', '14km'),
(8, 8, 'Botble\\RealEstate\\Models\\Property', '7km'),
(8, 9, 'Botble\\RealEstate\\Models\\Project', '19km'),
(8, 9, 'Botble\\RealEstate\\Models\\Property', '4km'),
(8, 10, 'Botble\\RealEstate\\Models\\Project', '8km'),
(8, 10, 'Botble\\RealEstate\\Models\\Property', '19km'),
(8, 11, 'Botble\\RealEstate\\Models\\Project', '11km'),
(8, 11, 'Botble\\RealEstate\\Models\\Property', '3km'),
(8, 12, 'Botble\\RealEstate\\Models\\Project', '7km'),
(8, 12, 'Botble\\RealEstate\\Models\\Property', '7km'),
(8, 13, 'Botble\\RealEstate\\Models\\Project', '19km'),
(8, 13, 'Botble\\RealEstate\\Models\\Property', '5km'),
(8, 14, 'Botble\\RealEstate\\Models\\Project', '5km'),
(8, 14, 'Botble\\RealEstate\\Models\\Property', '18km'),
(8, 15, 'Botble\\RealEstate\\Models\\Project', '3km'),
(8, 15, 'Botble\\RealEstate\\Models\\Property', '3km'),
(8, 16, 'Botble\\RealEstate\\Models\\Project', '8km'),
(8, 16, 'Botble\\RealEstate\\Models\\Property', '11km'),
(8, 17, 'Botble\\RealEstate\\Models\\Project', '13km'),
(8, 17, 'Botble\\RealEstate\\Models\\Property', '3km'),
(8, 18, 'Botble\\RealEstate\\Models\\Project', '3km'),
(8, 18, 'Botble\\RealEstate\\Models\\Property', '5km'),
(8, 19, 'Botble\\RealEstate\\Models\\Property', '12km'),
(8, 20, 'Botble\\RealEstate\\Models\\Property', '15km'),
(8, 21, 'Botble\\RealEstate\\Models\\Property', '18km'),
(8, 22, 'Botble\\RealEstate\\Models\\Property', '4km'),
(8, 23, 'Botble\\RealEstate\\Models\\Property', '8km'),
(8, 24, 'Botble\\RealEstate\\Models\\Property', '9km'),
(8, 25, 'Botble\\RealEstate\\Models\\Property', '1km'),
(8, 26, 'Botble\\RealEstate\\Models\\Property', '2km'),
(8, 27, 'Botble\\RealEstate\\Models\\Property', '3km'),
(8, 28, 'Botble\\RealEstate\\Models\\Property', '5km'),
(8, 29, 'Botble\\RealEstate\\Models\\Property', '11km'),
(8, 30, 'Botble\\RealEstate\\Models\\Property', '11km'),
(8, 31, 'Botble\\RealEstate\\Models\\Property', '8km'),
(8, 32, 'Botble\\RealEstate\\Models\\Property', '18km'),
(8, 33, 'Botble\\RealEstate\\Models\\Property', '14km'),
(8, 34, 'Botble\\RealEstate\\Models\\Property', '16km'),
(8, 35, 'Botble\\RealEstate\\Models\\Property', '15km'),
(8, 36, 'Botble\\RealEstate\\Models\\Property', '15km'),
(8, 37, 'Botble\\RealEstate\\Models\\Property', '18km'),
(8, 38, 'Botble\\RealEstate\\Models\\Property', '16km'),
(8, 39, 'Botble\\RealEstate\\Models\\Property', '12km'),
(8, 40, 'Botble\\RealEstate\\Models\\Property', '20km'),
(8, 41, 'Botble\\RealEstate\\Models\\Property', '13km'),
(8, 42, 'Botble\\RealEstate\\Models\\Property', '17km'),
(8, 43, 'Botble\\RealEstate\\Models\\Property', '10km'),
(8, 44, 'Botble\\RealEstate\\Models\\Property', '19km'),
(8, 45, 'Botble\\RealEstate\\Models\\Property', '7km'),
(8, 46, 'Botble\\RealEstate\\Models\\Property', '12km'),
(8, 47, 'Botble\\RealEstate\\Models\\Property', '16km'),
(8, 48, 'Botble\\RealEstate\\Models\\Property', '8km'),
(8, 49, 'Botble\\RealEstate\\Models\\Property', '6km'),
(8, 50, 'Botble\\RealEstate\\Models\\Property', '10km'),
(8, 51, 'Botble\\RealEstate\\Models\\Property', '6km'),
(8, 52, 'Botble\\RealEstate\\Models\\Property', '2km'),
(8, 53, 'Botble\\RealEstate\\Models\\Property', '8km'),
(8, 54, 'Botble\\RealEstate\\Models\\Property', '19km'),
(8, 55, 'Botble\\RealEstate\\Models\\Property', '19km'),
(8, 56, 'Botble\\RealEstate\\Models\\Property', '2km'),
(8, 57, 'Botble\\RealEstate\\Models\\Property', '4km'),
(8, 58, 'Botble\\RealEstate\\Models\\Property', '14km'),
(8, 59, 'Botble\\RealEstate\\Models\\Property', '9km'),
(8, 60, 'Botble\\RealEstate\\Models\\Property', '16km'),
(8, 61, 'Botble\\RealEstate\\Models\\Property', '14km'),
(9, 1, 'Botble\\RealEstate\\Models\\Project', '2km'),
(9, 1, 'Botble\\RealEstate\\Models\\Property', '18km'),
(9, 2, 'Botble\\RealEstate\\Models\\Project', '15km'),
(9, 2, 'Botble\\RealEstate\\Models\\Property', '7km'),
(9, 3, 'Botble\\RealEstate\\Models\\Project', '8km'),
(9, 3, 'Botble\\RealEstate\\Models\\Property', '19km'),
(9, 4, 'Botble\\RealEstate\\Models\\Project', '6km'),
(9, 4, 'Botble\\RealEstate\\Models\\Property', '9km'),
(9, 5, 'Botble\\RealEstate\\Models\\Project', '18km'),
(9, 5, 'Botble\\RealEstate\\Models\\Property', '8km'),
(9, 6, 'Botble\\RealEstate\\Models\\Project', '5km'),
(9, 6, 'Botble\\RealEstate\\Models\\Property', '1km'),
(9, 7, 'Botble\\RealEstate\\Models\\Project', '4km'),
(9, 7, 'Botble\\RealEstate\\Models\\Property', '1km'),
(9, 8, 'Botble\\RealEstate\\Models\\Project', '9km'),
(9, 8, 'Botble\\RealEstate\\Models\\Property', '8km'),
(9, 9, 'Botble\\RealEstate\\Models\\Project', '17km'),
(9, 9, 'Botble\\RealEstate\\Models\\Property', '15km'),
(9, 10, 'Botble\\RealEstate\\Models\\Project', '10km'),
(9, 10, 'Botble\\RealEstate\\Models\\Property', '4km'),
(9, 11, 'Botble\\RealEstate\\Models\\Project', '6km'),
(9, 11, 'Botble\\RealEstate\\Models\\Property', '11km'),
(9, 12, 'Botble\\RealEstate\\Models\\Project', '16km'),
(9, 12, 'Botble\\RealEstate\\Models\\Property', '11km'),
(9, 13, 'Botble\\RealEstate\\Models\\Project', '19km'),
(9, 13, 'Botble\\RealEstate\\Models\\Property', '6km'),
(9, 14, 'Botble\\RealEstate\\Models\\Project', '16km'),
(9, 14, 'Botble\\RealEstate\\Models\\Property', '19km'),
(9, 15, 'Botble\\RealEstate\\Models\\Project', '3km'),
(9, 15, 'Botble\\RealEstate\\Models\\Property', '12km'),
(9, 16, 'Botble\\RealEstate\\Models\\Project', '4km'),
(9, 16, 'Botble\\RealEstate\\Models\\Property', '1km'),
(9, 17, 'Botble\\RealEstate\\Models\\Project', '14km'),
(9, 17, 'Botble\\RealEstate\\Models\\Property', '3km'),
(9, 18, 'Botble\\RealEstate\\Models\\Project', '9km'),
(9, 18, 'Botble\\RealEstate\\Models\\Property', '13km'),
(9, 19, 'Botble\\RealEstate\\Models\\Property', '19km'),
(9, 20, 'Botble\\RealEstate\\Models\\Property', '6km'),
(9, 21, 'Botble\\RealEstate\\Models\\Property', '17km'),
(9, 22, 'Botble\\RealEstate\\Models\\Property', '14km'),
(9, 23, 'Botble\\RealEstate\\Models\\Property', '6km'),
(9, 24, 'Botble\\RealEstate\\Models\\Property', '18km'),
(9, 25, 'Botble\\RealEstate\\Models\\Property', '17km'),
(9, 26, 'Botble\\RealEstate\\Models\\Property', '1km'),
(9, 27, 'Botble\\RealEstate\\Models\\Property', '13km'),
(9, 28, 'Botble\\RealEstate\\Models\\Property', '9km'),
(9, 29, 'Botble\\RealEstate\\Models\\Property', '15km'),
(9, 30, 'Botble\\RealEstate\\Models\\Property', '4km'),
(9, 31, 'Botble\\RealEstate\\Models\\Property', '2km'),
(9, 32, 'Botble\\RealEstate\\Models\\Property', '8km'),
(9, 33, 'Botble\\RealEstate\\Models\\Property', '2km'),
(9, 34, 'Botble\\RealEstate\\Models\\Property', '8km'),
(9, 35, 'Botble\\RealEstate\\Models\\Property', '7km'),
(9, 36, 'Botble\\RealEstate\\Models\\Property', '18km'),
(9, 37, 'Botble\\RealEstate\\Models\\Property', '20km'),
(9, 38, 'Botble\\RealEstate\\Models\\Property', '19km'),
(9, 39, 'Botble\\RealEstate\\Models\\Property', '12km'),
(9, 40, 'Botble\\RealEstate\\Models\\Property', '7km'),
(9, 41, 'Botble\\RealEstate\\Models\\Property', '14km'),
(9, 42, 'Botble\\RealEstate\\Models\\Property', '10km'),
(9, 43, 'Botble\\RealEstate\\Models\\Property', '3km'),
(9, 44, 'Botble\\RealEstate\\Models\\Property', '7km'),
(9, 45, 'Botble\\RealEstate\\Models\\Property', '12km'),
(9, 46, 'Botble\\RealEstate\\Models\\Property', '19km'),
(9, 47, 'Botble\\RealEstate\\Models\\Property', '14km'),
(9, 48, 'Botble\\RealEstate\\Models\\Property', '5km'),
(9, 49, 'Botble\\RealEstate\\Models\\Property', '6km'),
(9, 50, 'Botble\\RealEstate\\Models\\Property', '12km'),
(9, 51, 'Botble\\RealEstate\\Models\\Property', '17km'),
(9, 52, 'Botble\\RealEstate\\Models\\Property', '5km'),
(9, 53, 'Botble\\RealEstate\\Models\\Property', '11km'),
(9, 54, 'Botble\\RealEstate\\Models\\Property', '19km'),
(9, 55, 'Botble\\RealEstate\\Models\\Property', '16km'),
(9, 56, 'Botble\\RealEstate\\Models\\Property', '9km'),
(9, 57, 'Botble\\RealEstate\\Models\\Property', '15km'),
(9, 58, 'Botble\\RealEstate\\Models\\Property', '4km'),
(9, 59, 'Botble\\RealEstate\\Models\\Property', '11km'),
(9, 60, 'Botble\\RealEstate\\Models\\Property', '17km'),
(9, 61, 'Botble\\RealEstate\\Models\\Property', '15km'),
(10, 1, 'Botble\\RealEstate\\Models\\Project', '4km'),
(10, 1, 'Botble\\RealEstate\\Models\\Property', '6km'),
(10, 2, 'Botble\\RealEstate\\Models\\Project', '8km'),
(10, 2, 'Botble\\RealEstate\\Models\\Property', '4km'),
(10, 3, 'Botble\\RealEstate\\Models\\Project', '11km'),
(10, 3, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 4, 'Botble\\RealEstate\\Models\\Project', '16km'),
(10, 4, 'Botble\\RealEstate\\Models\\Property', '18km'),
(10, 5, 'Botble\\RealEstate\\Models\\Project', '19km'),
(10, 5, 'Botble\\RealEstate\\Models\\Property', '10km'),
(10, 6, 'Botble\\RealEstate\\Models\\Project', '14km'),
(10, 6, 'Botble\\RealEstate\\Models\\Property', '7km'),
(10, 7, 'Botble\\RealEstate\\Models\\Project', '1km'),
(10, 7, 'Botble\\RealEstate\\Models\\Property', '16km'),
(10, 8, 'Botble\\RealEstate\\Models\\Project', '19km'),
(10, 8, 'Botble\\RealEstate\\Models\\Property', '10km'),
(10, 9, 'Botble\\RealEstate\\Models\\Project', '5km'),
(10, 9, 'Botble\\RealEstate\\Models\\Property', '19km'),
(10, 10, 'Botble\\RealEstate\\Models\\Project', '18km'),
(10, 10, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 11, 'Botble\\RealEstate\\Models\\Project', '5km'),
(10, 11, 'Botble\\RealEstate\\Models\\Property', '14km'),
(10, 12, 'Botble\\RealEstate\\Models\\Project', '6km'),
(10, 12, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 13, 'Botble\\RealEstate\\Models\\Project', '4km'),
(10, 13, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 14, 'Botble\\RealEstate\\Models\\Project', '6km'),
(10, 14, 'Botble\\RealEstate\\Models\\Property', '14km'),
(10, 15, 'Botble\\RealEstate\\Models\\Project', '8km'),
(10, 15, 'Botble\\RealEstate\\Models\\Property', '15km'),
(10, 16, 'Botble\\RealEstate\\Models\\Project', '19km'),
(10, 16, 'Botble\\RealEstate\\Models\\Property', '6km'),
(10, 17, 'Botble\\RealEstate\\Models\\Project', '8km'),
(10, 17, 'Botble\\RealEstate\\Models\\Property', '6km'),
(10, 18, 'Botble\\RealEstate\\Models\\Project', '1km'),
(10, 18, 'Botble\\RealEstate\\Models\\Property', '9km'),
(10, 19, 'Botble\\RealEstate\\Models\\Property', '12km'),
(10, 20, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 21, 'Botble\\RealEstate\\Models\\Property', '20km'),
(10, 22, 'Botble\\RealEstate\\Models\\Property', '14km'),
(10, 23, 'Botble\\RealEstate\\Models\\Property', '9km'),
(10, 24, 'Botble\\RealEstate\\Models\\Property', '17km'),
(10, 25, 'Botble\\RealEstate\\Models\\Property', '7km'),
(10, 26, 'Botble\\RealEstate\\Models\\Property', '6km'),
(10, 27, 'Botble\\RealEstate\\Models\\Property', '3km'),
(10, 28, 'Botble\\RealEstate\\Models\\Property', '6km'),
(10, 29, 'Botble\\RealEstate\\Models\\Property', '8km'),
(10, 30, 'Botble\\RealEstate\\Models\\Property', '5km'),
(10, 31, 'Botble\\RealEstate\\Models\\Property', '11km'),
(10, 32, 'Botble\\RealEstate\\Models\\Property', '16km'),
(10, 33, 'Botble\\RealEstate\\Models\\Property', '12km'),
(10, 34, 'Botble\\RealEstate\\Models\\Property', '6km'),
(10, 35, 'Botble\\RealEstate\\Models\\Property', '17km'),
(10, 36, 'Botble\\RealEstate\\Models\\Property', '5km'),
(10, 37, 'Botble\\RealEstate\\Models\\Property', '9km'),
(10, 38, 'Botble\\RealEstate\\Models\\Property', '19km'),
(10, 39, 'Botble\\RealEstate\\Models\\Property', '5km'),
(10, 40, 'Botble\\RealEstate\\Models\\Property', '19km'),
(10, 41, 'Botble\\RealEstate\\Models\\Property', '4km'),
(10, 42, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 43, 'Botble\\RealEstate\\Models\\Property', '7km'),
(10, 44, 'Botble\\RealEstate\\Models\\Property', '17km'),
(10, 45, 'Botble\\RealEstate\\Models\\Property', '2km'),
(10, 46, 'Botble\\RealEstate\\Models\\Property', '9km'),
(10, 47, 'Botble\\RealEstate\\Models\\Property', '1km'),
(10, 48, 'Botble\\RealEstate\\Models\\Property', '3km'),
(10, 49, 'Botble\\RealEstate\\Models\\Property', '19km'),
(10, 50, 'Botble\\RealEstate\\Models\\Property', '11km'),
(10, 51, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 52, 'Botble\\RealEstate\\Models\\Property', '14km'),
(10, 53, 'Botble\\RealEstate\\Models\\Property', '20km'),
(10, 54, 'Botble\\RealEstate\\Models\\Property', '13km'),
(10, 55, 'Botble\\RealEstate\\Models\\Property', '16km'),
(10, 56, 'Botble\\RealEstate\\Models\\Property', '1km'),
(10, 57, 'Botble\\RealEstate\\Models\\Property', '5km'),
(10, 58, 'Botble\\RealEstate\\Models\\Property', '12km'),
(10, 59, 'Botble\\RealEstate\\Models\\Property', '2km'),
(10, 60, 'Botble\\RealEstate\\Models\\Property', '7km'),
(10, 61, 'Botble\\RealEstate\\Models\\Property', '11km'),
(11, 1, 'Botble\\RealEstate\\Models\\Project', '4km'),
(11, 1, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 2, 'Botble\\RealEstate\\Models\\Project', '14km'),
(11, 2, 'Botble\\RealEstate\\Models\\Property', '11km'),
(11, 3, 'Botble\\RealEstate\\Models\\Project', '5km'),
(11, 3, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 4, 'Botble\\RealEstate\\Models\\Project', '2km'),
(11, 4, 'Botble\\RealEstate\\Models\\Property', '2km'),
(11, 5, 'Botble\\RealEstate\\Models\\Project', '1km'),
(11, 5, 'Botble\\RealEstate\\Models\\Property', '8km'),
(11, 6, 'Botble\\RealEstate\\Models\\Project', '7km'),
(11, 6, 'Botble\\RealEstate\\Models\\Property', '1km'),
(11, 7, 'Botble\\RealEstate\\Models\\Project', '3km'),
(11, 7, 'Botble\\RealEstate\\Models\\Property', '6km'),
(11, 8, 'Botble\\RealEstate\\Models\\Project', '17km'),
(11, 8, 'Botble\\RealEstate\\Models\\Property', '2km'),
(11, 9, 'Botble\\RealEstate\\Models\\Project', '19km'),
(11, 9, 'Botble\\RealEstate\\Models\\Property', '5km'),
(11, 10, 'Botble\\RealEstate\\Models\\Project', '13km'),
(11, 10, 'Botble\\RealEstate\\Models\\Property', '4km'),
(11, 11, 'Botble\\RealEstate\\Models\\Project', '3km'),
(11, 11, 'Botble\\RealEstate\\Models\\Property', '7km'),
(11, 12, 'Botble\\RealEstate\\Models\\Project', '9km'),
(11, 12, 'Botble\\RealEstate\\Models\\Property', '13km'),
(11, 13, 'Botble\\RealEstate\\Models\\Project', '20km'),
(11, 13, 'Botble\\RealEstate\\Models\\Property', '10km'),
(11, 14, 'Botble\\RealEstate\\Models\\Project', '1km'),
(11, 14, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 15, 'Botble\\RealEstate\\Models\\Project', '20km'),
(11, 15, 'Botble\\RealEstate\\Models\\Property', '8km'),
(11, 16, 'Botble\\RealEstate\\Models\\Project', '14km'),
(11, 16, 'Botble\\RealEstate\\Models\\Property', '18km'),
(11, 17, 'Botble\\RealEstate\\Models\\Project', '14km'),
(11, 17, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 18, 'Botble\\RealEstate\\Models\\Project', '18km'),
(11, 18, 'Botble\\RealEstate\\Models\\Property', '3km'),
(11, 19, 'Botble\\RealEstate\\Models\\Property', '12km'),
(11, 20, 'Botble\\RealEstate\\Models\\Property', '4km'),
(11, 21, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 22, 'Botble\\RealEstate\\Models\\Property', '13km'),
(11, 23, 'Botble\\RealEstate\\Models\\Property', '5km'),
(11, 24, 'Botble\\RealEstate\\Models\\Property', '2km'),
(11, 25, 'Botble\\RealEstate\\Models\\Property', '20km'),
(11, 26, 'Botble\\RealEstate\\Models\\Property', '5km'),
(11, 27, 'Botble\\RealEstate\\Models\\Property', '11km'),
(11, 28, 'Botble\\RealEstate\\Models\\Property', '3km'),
(11, 29, 'Botble\\RealEstate\\Models\\Property', '2km'),
(11, 30, 'Botble\\RealEstate\\Models\\Property', '12km'),
(11, 31, 'Botble\\RealEstate\\Models\\Property', '19km'),
(11, 32, 'Botble\\RealEstate\\Models\\Property', '4km'),
(11, 33, 'Botble\\RealEstate\\Models\\Property', '2km'),
(11, 34, 'Botble\\RealEstate\\Models\\Property', '6km'),
(11, 35, 'Botble\\RealEstate\\Models\\Property', '20km'),
(11, 36, 'Botble\\RealEstate\\Models\\Property', '3km'),
(11, 37, 'Botble\\RealEstate\\Models\\Property', '17km'),
(11, 38, 'Botble\\RealEstate\\Models\\Property', '13km'),
(11, 39, 'Botble\\RealEstate\\Models\\Property', '11km'),
(11, 40, 'Botble\\RealEstate\\Models\\Property', '1km'),
(11, 41, 'Botble\\RealEstate\\Models\\Property', '12km'),
(11, 42, 'Botble\\RealEstate\\Models\\Property', '6km'),
(11, 43, 'Botble\\RealEstate\\Models\\Property', '1km'),
(11, 44, 'Botble\\RealEstate\\Models\\Property', '7km'),
(11, 45, 'Botble\\RealEstate\\Models\\Property', '11km'),
(11, 46, 'Botble\\RealEstate\\Models\\Property', '12km'),
(11, 47, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 48, 'Botble\\RealEstate\\Models\\Property', '12km'),
(11, 49, 'Botble\\RealEstate\\Models\\Property', '2km'),
(11, 50, 'Botble\\RealEstate\\Models\\Property', '16km'),
(11, 51, 'Botble\\RealEstate\\Models\\Property', '2km'),
(11, 52, 'Botble\\RealEstate\\Models\\Property', '16km'),
(11, 53, 'Botble\\RealEstate\\Models\\Property', '3km'),
(11, 54, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 55, 'Botble\\RealEstate\\Models\\Property', '6km'),
(11, 56, 'Botble\\RealEstate\\Models\\Property', '3km'),
(11, 57, 'Botble\\RealEstate\\Models\\Property', '5km'),
(11, 58, 'Botble\\RealEstate\\Models\\Property', '15km'),
(11, 59, 'Botble\\RealEstate\\Models\\Property', '8km'),
(11, 60, 'Botble\\RealEstate\\Models\\Property', '7km'),
(11, 61, 'Botble\\RealEstate\\Models\\Property', '2km');

-- --------------------------------------------------------

--
-- Table structure for table `re_facilities_translations`
--

CREATE TABLE `re_facilities_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_facilities_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_investors`
--

CREATE TABLE `re_investors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_investors`
--

INSERT INTO `re_investors` (`id`, `name`, `status`, `created_at`, `updated_at`, `description`, `avatar`) VALUES
(2, 'Generali', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, NULL),
(4, 'China Investment Corporation', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, NULL),
(8, 'HOOPP', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, NULL),
(9, 'BT Group', 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `re_investors_translations`
--

CREATE TABLE `re_investors_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_investors_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_invoices`
--

CREATE TABLE `re_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_type` varchar(191) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `sub_total` decimal(15,2) UNSIGNED NOT NULL,
  `tax_amount` decimal(15,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(15,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `coupon_code` varchar(191) DEFAULT NULL,
  `amount` decimal(15,2) UNSIGNED NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_invoice_items`
--

CREATE TABLE `re_invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `sub_total` decimal(15,2) UNSIGNED NOT NULL,
  `tax_amount` decimal(15,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(15,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `amount` decimal(15,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_packages`
--

CREATE TABLE `re_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `percent_save` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `number_of_listings` int(10) UNSIGNED NOT NULL,
  `account_limit` int(10) UNSIGNED DEFAULT NULL,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `features` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_packages`
--

INSERT INTO `re_packages` (`id`, `name`, `price`, `currency_id`, `percent_save`, `number_of_listings`, `account_limit`, `order`, `is_default`, `status`, `created_at`, `updated_at`, `description`, `features`) VALUES
(1, 'Free Trial', 0, 1, 0, 1, 1, 1, 0, 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, '[[{\"key\":\"text\",\"value\":\"Limited time trial period\"}],[{\"key\":\"text\",\"value\":\"1 listing allowed\"}],[{\"key\":\"text\",\"value\":\"Basic support\"}]]'),
(2, 'Basic Listing', 250, 1, 0, 1, 5, 2, 1, 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, '[[{\"key\":\"text\",\"value\":\"1 listing allowed\"}],[{\"key\":\"text\",\"value\":\"5 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Basic support\"}]]'),
(3, 'Standard Package', 1000, 1, 20, 5, 10, 3, 0, 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, '[[{\"key\":\"text\",\"value\":\"5 listings allowed\"}],[{\"key\":\"text\",\"value\":\"10 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Priority support\"}]]'),
(4, 'Professional Package', 1800, 1, 28, 10, 15, 4, 0, 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, '[[{\"key\":\"text\",\"value\":\"10 listings allowed\"}],[{\"key\":\"text\",\"value\":\"15 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Premium support\"}],[{\"key\":\"text\",\"value\":\"Featured listings\"}]]'),
(5, 'Premium Package', 2500, 1, 33, 15, 20, 5, 0, 'published', '2026-01-24 01:53:50', '2026-01-24 01:53:50', NULL, '[[{\"key\":\"text\",\"value\":\"15 listings allowed\"}],[{\"key\":\"text\",\"value\":\"20 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Premium support\"}],[{\"key\":\"text\",\"value\":\"Featured listings\"}],[{\"key\":\"text\",\"value\":\"Priority listing placement\"}]]');

-- --------------------------------------------------------

--
-- Table structure for table `re_packages_translations`
--

CREATE TABLE `re_packages_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_packages_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `features` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_projects`
--

CREATE TABLE `re_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `images` text DEFAULT NULL,
  `floor_plans` longtext DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `investor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `number_block` int(11) DEFAULT NULL,
  `number_floor` smallint(6) DEFAULT NULL,
  `number_flat` smallint(6) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `featured_priority` int(11) DEFAULT 0,
  `date_finish` date DEFAULT NULL,
  `date_sell` date DEFAULT NULL,
  `price_from` decimal(15,0) DEFAULT NULL,
  `price_to` decimal(15,0) DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'selling',
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_type` varchar(191) NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT 1,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unique_id` varchar(191) DEFAULT NULL,
  `private_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_projects_translations`
--

CREATE TABLE `re_projects_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_projects_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `floor_plans` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_project_categories`
--

CREATE TABLE `re_project_categories` (
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_project_categories`
--

INSERT INTO `re_project_categories` (`project_id`, `category_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(2, 2),
(2, 4),
(3, 1),
(3, 2),
(3, 4),
(4, 4),
(4, 5),
(4, 6),
(5, 3),
(5, 4),
(5, 6),
(6, 5),
(7, 1),
(7, 2),
(7, 5),
(8, 1),
(8, 4),
(8, 5),
(9, 2),
(9, 5),
(10, 5),
(11, 6),
(12, 1),
(12, 6),
(13, 1),
(13, 6),
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 3),
(15, 5),
(16, 4),
(16, 6),
(17, 1),
(17, 4),
(17, 6),
(18, 1),
(18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `re_project_features`
--

CREATE TABLE `re_project_features` (
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_project_features`
--

INSERT INTO `re_project_features` (`project_id`, `feature_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 10),
(1, 11),
(1, 12),
(2, 2),
(2, 3),
(2, 4),
(2, 6),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(3, 3),
(3, 8),
(3, 9),
(3, 11),
(3, 12),
(4, 5),
(4, 8),
(4, 9),
(4, 10),
(4, 12),
(5, 1),
(5, 4),
(5, 6),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 7),
(6, 12),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 6),
(7, 7),
(7, 8),
(7, 9),
(7, 10),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(9, 1),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 10),
(9, 11),
(9, 12),
(10, 2),
(10, 4),
(10, 6),
(10, 7),
(10, 8),
(11, 2),
(11, 9),
(11, 10),
(11, 11),
(12, 3),
(12, 4),
(12, 7),
(12, 10),
(13, 3),
(13, 7),
(13, 11),
(13, 12),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 6),
(14, 8),
(14, 12),
(15, 1),
(15, 3),
(15, 4),
(15, 6),
(15, 7),
(15, 8),
(15, 9),
(15, 10),
(15, 11),
(16, 1),
(16, 2),
(16, 5),
(16, 6),
(16, 10),
(17, 1),
(17, 3),
(17, 4),
(17, 5),
(17, 6),
(17, 7),
(17, 8),
(17, 9),
(17, 10),
(17, 11),
(17, 12),
(18, 1),
(18, 3),
(18, 6),
(18, 7),
(18, 8);

-- --------------------------------------------------------

--
-- Table structure for table `re_properties`
--

CREATE TABLE `re_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'sale',
  `description` varchar(400) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `floor_plans` longtext DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT 0,
  `number_bedroom` int(11) DEFAULT NULL,
  `number_bathroom` int(11) DEFAULT NULL,
  `number_floor` int(11) DEFAULT NULL,
  `square` double DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `featured_priority` int(11) DEFAULT 0,
  `is_project` tinyint(1) DEFAULT 0,
  `developer_name` varchar(191) DEFAULT NULL,
  `payment_plan` varchar(191) DEFAULT NULL,
  `handover_date` varchar(100) DEFAULT NULL,
  `property_category` varchar(50) DEFAULT NULL,
  `property_subtype` varchar(50) DEFAULT NULL,
  `completion_status` varchar(20) DEFAULT NULL,
  `tour_type` varchar(50) DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `period` varchar(30) NOT NULL DEFAULT 'month',
  `status` varchar(60) NOT NULL DEFAULT 'selling',
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_type` varchar(191) NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `moderation_status` varchar(60) NOT NULL DEFAULT 'pending',
  `reject_reason` varchar(400) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `auto_renew` tinyint(1) NOT NULL DEFAULT 0,
  `never_expired` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `country_id` bigint(20) UNSIGNED DEFAULT 1,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unique_id` varchar(191) DEFAULT NULL,
  `private_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_properties`
--

INSERT INTO `re_properties` (`id`, `name`, `type`, `description`, `content`, `location`, `images`, `floor_plans`, `project_id`, `number_bedroom`, `number_bathroom`, `number_floor`, `square`, `price`, `currency_id`, `is_featured`, `featured_priority`, `is_project`, `developer_name`, `payment_plan`, `handover_date`, `property_category`, `property_subtype`, `completion_status`, `tour_type`, `city_id`, `period`, `status`, `author_id`, `author_type`, `moderation_status`, `reject_reason`, `expire_date`, `auto_renew`, `never_expired`, `created_at`, `updated_at`, `latitude`, `longitude`, `zip_code`, `views`, `country_id`, `state_id`, `unique_id`, `private_notes`) VALUES
(63, 'luxury budget villa', 'rent', 'Contemporary living at its finest. This property boasts state-of-the-art amenities and a sleek, modern aesthetic throughout.', NULL, 'Gubbi Thotadappa Road, Cottonpete, Bengaluru Central City Corporation, Bengaluru, Bangalore North, Bengaluru Urban, Karnataka, 560001, India', 'https://ik.imagekit.io/area24onestorage/properties/gallery/AREA24_REALTY_BANNER_2__1__IrnrqXXjl.png', 'https://ik.imagekit.io/area24onestorage/properties/floor_plans/pexels-kelly-3030307_iqcd4-udE.jpg', 0, 7, 4, NULL, 800, 113700.00, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, 'year', 'rented', NULL, 'Botble\\ACL\\Models\\User', 'approved', NULL, NULL, 0, 0, '2026-02-18 10:20:00', NULL, '12.979097', '77.570343', '560001', 0, 12, 11, NULL, NULL),
(64, 'test properties', 'rent', 'Meticulously maintained property with upgrades throughout. Features include hardwood floors, granite countertops, and stainless appliances.', NULL, 'Subramanyeshwara Temple, 5th Cross Road, Dattatreya Ward, Bengaluru Central City Corporation, Bengaluru, Bangalore North, Bengaluru Urban, Karnataka, 560003, India', 'https://ik.imagekit.io/area24onestorage/properties/gallery/pexels-wiki15-canton-598594475-28681439_mtCnjRC5d.jpg,https://ik.imagekit.io/area24onestorage/properties/gallery/pexels-boonkong-boonpeng-442952-1134176_eZjMNu7_1.jpg,https://ik.imagekit.io/area24onestorage/properties/gallery/pexels-kelly-3030307_rZl8O1xLdA.jpg', 'https://ik.imagekit.io/area24onestorage/properties/floor_plans/pexels-wiki15-canton-598594475-28681439_ZHj5hmTLv.jpg', 0, 4, 6, NULL, 540, 30000.00, NULL, 1, 2, 0, 'BT Group', '70/30', 'Q4 2026', 'residential', 'apartment', 'off-plan', '', 31, 'month', 'renting', NULL, 'Botble\\ACL\\Models\\User', 'approved', NULL, NULL, 0, 0, '2026-02-18 11:51:39', NULL, '12.997162', '77.573433', '560003', 0, 12, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `re_properties_translations`
--

CREATE TABLE `re_properties_translations` (
  `lang_code` varchar(191) NOT NULL,
  `re_properties_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `floor_plans` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_property_categories`
--

CREATE TABLE `re_property_categories` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_property_categories_main`
--

CREATE TABLE `re_property_categories_main` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` varchar(20) DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `re_property_categories_main`
--

INSERT INTO `re_property_categories_main` (`id`, `name`, `slug`, `icon`, `sort_order`, `status`, `created_at`) VALUES
(2, 'Commercial', 'commercial', NULL, 2, 'published', '2026-02-21 10:05:50'),
(4, 'Agricultural', 'agricultural', NULL, 4, 'published', '2026-02-21 10:05:50'),
(5, 'Residential', 'residential', NULL, 1, 'published', '2026-02-21 11:10:55'),
(6, 'Industrial', 'industrial', NULL, 3, 'published', '2026-02-21 11:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `re_property_features`
--

CREATE TABLE `re_property_features` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `feature_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_property_projects`
--

CREATE TABLE `re_property_projects` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re_property_types`
--

CREATE TABLE `re_property_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` varchar(20) DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `re_property_types`
--

INSERT INTO `re_property_types` (`id`, `name`, `slug`, `category`, `icon`, `sort_order`, `status`, `created_at`) VALUES
(208, 'Apartment', 'apartment', 'residential', NULL, 1, 'published', '2026-02-21 10:16:38'),
(209, 'Villa', 'villa', 'residential', NULL, 2, 'published', '2026-02-21 10:16:38'),
(210, 'Townhouse', 'townhouse', 'residential', NULL, 3, 'published', '2026-02-21 10:16:38'),
(211, 'Penthouse', 'penthouse', 'residential', NULL, 4, 'published', '2026-02-21 10:16:38'),
(212, 'Villa Compound', 'villa-compound', 'residential', NULL, 5, 'published', '2026-02-21 10:16:38'),
(213, 'Hotel Apartment', 'hotel-apartment', 'residential', NULL, 6, 'published', '2026-02-21 10:16:38'),
(214, 'Residential Land', 'residential-land', 'residential', NULL, 7, 'published', '2026-02-21 10:16:38'),
(215, 'Residential Floor', 'residential-floor', 'residential', NULL, 8, 'published', '2026-02-21 10:16:38'),
(216, 'Residential Building', 'residential-building', 'residential', NULL, 9, 'published', '2026-02-21 10:16:38'),
(217, 'Office', 'office', 'commercial', NULL, 1, 'published', '2026-02-21 10:16:38'),
(218, 'Shop', 'shop', 'commercial', NULL, 2, 'published', '2026-02-21 10:16:38'),
(219, 'Warehouse', 'warehouse', 'commercial', NULL, 3, 'published', '2026-02-21 10:16:38'),
(220, 'Labour Camp', 'labour-camp', 'commercial', NULL, 4, 'published', '2026-02-21 10:16:38'),
(221, 'Commercial Villa', 'commercial-villa', 'commercial', NULL, 5, 'published', '2026-02-21 10:16:38'),
(222, 'Bulk Unit', 'bulk-unit', 'commercial', NULL, 6, 'published', '2026-02-21 10:16:38'),
(223, 'Commercial Land', 'commercial-land', 'commercial', NULL, 7, 'published', '2026-02-21 10:16:38'),
(224, 'Commercial Floor', 'commercial-floor', 'commercial', NULL, 8, 'published', '2026-02-21 10:16:38'),
(225, 'Commercial Building', 'commercial-building', 'commercial', NULL, 9, 'published', '2026-02-21 10:16:38'),
(226, 'Factory', 'factory', 'commercial', NULL, 10, 'published', '2026-02-21 10:16:38'),
(227, 'Industrial Land', 'industrial-land', 'commercial', NULL, 11, 'published', '2026-02-21 10:16:38'),
(228, 'Mixed Use Land', 'mixed-use-land', 'commercial', NULL, 12, 'published', '2026-02-21 10:16:38'),
(229, 'Showroom', 'showroom', 'commercial', NULL, 13, 'published', '2026-02-21 10:16:38'),
(230, 'Other Commercial', 'other-commercial', 'commercial', NULL, 14, 'published', '2026-02-21 10:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `re_reviews`
--

CREATE TABLE `re_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `reviewable_type` varchar(191) NOT NULL,
  `reviewable_id` bigint(20) UNSIGNED NOT NULL,
  `star` tinyint(4) NOT NULL,
  `content` varchar(500) NOT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `re_reviews`
--

INSERT INTO `re_reviews` (`id`, `account_id`, `reviewable_type`, `reviewable_id`, `star`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Botble\\RealEstate\\Models\\Property', 28, 5, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-21 01:54:09', '2026-01-24 01:54:09'),
(2, 9, 'Botble\\RealEstate\\Models\\Project', 9, 5, 'Sound insulation between units is excellent. No noise complaints whatsoever.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(3, 12, 'Botble\\RealEstate\\Models\\Property', 57, 3, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2026-01-11 01:54:09', '2026-01-24 01:54:09'),
(4, 12, 'Botble\\RealEstate\\Models\\Project', 7, 1, 'The project timeline was met and the final result is stunning. Very professional team behind this development.', 'approved', '2026-01-13 01:54:09', '2026-01-24 01:54:09'),
(5, 11, 'Botble\\RealEstate\\Models\\Property', 25, 5, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2026-01-23 01:54:09', '2026-01-24 01:54:09'),
(6, 7, 'Botble\\RealEstate\\Models\\Project', 11, 2, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(7, 7, 'Botble\\RealEstate\\Models\\Property', 58, 5, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-11-24 01:54:09', '2026-01-24 01:54:09'),
(8, 4, 'Botble\\RealEstate\\Models\\Project', 17, 2, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2026-01-10 01:54:09', '2026-01-24 01:54:09'),
(9, 11, 'Botble\\RealEstate\\Models\\Property', 10, 5, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2026-01-06 01:54:09', '2026-01-24 01:54:09'),
(10, 12, 'Botble\\RealEstate\\Models\\Project', 11, 3, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2025-12-11 01:54:09', '2026-01-24 01:54:09'),
(11, 9, 'Botble\\RealEstate\\Models\\Property', 42, 4, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(12, 8, 'Botble\\RealEstate\\Models\\Project', 2, 2, 'Looking forward to the next phase of this development. The first phase has been outstanding.', 'approved', '2025-10-05 01:54:09', '2026-01-24 01:54:09'),
(13, 9, 'Botble\\RealEstate\\Models\\Property', 53, 4, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(14, 10, 'Botble\\RealEstate\\Models\\Project', 5, 3, 'Child-friendly design throughout the project with safe play areas and family amenities.', 'approved', '2025-12-06 01:54:09', '2026-01-24 01:54:09'),
(15, 11, 'Botble\\RealEstate\\Models\\Property', 3, 4, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-11-01 01:54:09', '2026-01-24 01:54:09'),
(16, 9, 'Botble\\RealEstate\\Models\\Project', 18, 4, 'The landscaping around this project is beautiful. Green spaces make the community feel alive.', 'approved', '2025-10-22 01:54:09', '2026-01-24 01:54:09'),
(17, 8, 'Botble\\RealEstate\\Models\\Property', 20, 5, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(18, 7, 'Botble\\RealEstate\\Models\\Project', 12, 4, 'Security features throughout the project are state-of-the-art. Feel safe living here.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(19, 2, 'Botble\\RealEstate\\Models\\Property', 3, 3, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-11-09 01:54:09', '2026-01-24 01:54:09'),
(21, 1, 'Botble\\RealEstate\\Models\\Property', 11, 3, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2026-01-21 01:54:09', '2026-01-24 01:54:09'),
(22, 10, 'Botble\\RealEstate\\Models\\Project', 2, 2, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-11-18 01:54:09', '2026-01-24 01:54:09'),
(23, 5, 'Botble\\RealEstate\\Models\\Property', 34, 5, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-11-02 01:54:09', '2026-01-24 01:54:09'),
(24, 2, 'Botble\\RealEstate\\Models\\Project', 13, 1, 'The amenities included in this project are world-class. Swimming pool, gym, and community spaces are all beautifully designed.', 'approved', '2025-11-16 01:54:09', '2026-01-24 01:54:09'),
(25, 12, 'Botble\\RealEstate\\Models\\Property', 43, 2, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-12-06 01:54:09', '2026-01-24 01:54:09'),
(26, 12, 'Botble\\RealEstate\\Models\\Project', 15, 2, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-11-06 01:54:09', '2026-01-24 01:54:09'),
(27, 3, 'Botble\\RealEstate\\Models\\Property', 46, 4, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-11-04 01:54:09', '2026-01-24 01:54:09'),
(28, 11, 'Botble\\RealEstate\\Models\\Project', 12, 5, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(29, 10, 'Botble\\RealEstate\\Models\\Property', 39, 2, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2026-01-03 01:54:09', '2026-01-24 01:54:09'),
(30, 7, 'Botble\\RealEstate\\Models\\Project', 13, 2, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2025-12-27 01:54:09', '2026-01-24 01:54:09'),
(31, 4, 'Botble\\RealEstate\\Models\\Property', 48, 5, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2026-01-04 01:54:09', '2026-01-24 01:54:09'),
(32, 2, 'Botble\\RealEstate\\Models\\Project', 4, 3, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-10-05 01:54:09', '2026-01-24 01:54:09'),
(33, 10, 'Botble\\RealEstate\\Models\\Property', 21, 3, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-19 01:54:09', '2026-01-24 01:54:09'),
(34, 7, 'Botble\\RealEstate\\Models\\Project', 5, 5, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2025-12-09 01:54:09', '2026-01-24 01:54:09'),
(35, 6, 'Botble\\RealEstate\\Models\\Property', 9, 3, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(36, 11, 'Botble\\RealEstate\\Models\\Project', 1, 2, 'The developer provided excellent after-sales service. Any snags were fixed promptly.', 'approved', '2025-12-20 01:54:09', '2026-01-24 01:54:09'),
(37, 12, 'Botble\\RealEstate\\Models\\Property', 42, 4, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2025-10-16 01:54:09', '2026-01-24 01:54:09'),
(38, 10, 'Botble\\RealEstate\\Models\\Project', 1, 5, 'The project has enhanced property values in the entire area.', 'approved', '2025-10-18 01:54:09', '2026-01-24 01:54:09'),
(39, 1, 'Botble\\RealEstate\\Models\\Property', 44, 4, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2026-01-16 01:54:09', '2026-01-24 01:54:09'),
(40, 2, 'Botble\\RealEstate\\Models\\Project', 5, 1, 'Developer reputation speaks for itself. This project maintains their high standards.', 'approved', '2025-11-05 01:54:09', '2026-01-24 01:54:09'),
(41, 8, 'Botble\\RealEstate\\Models\\Property', 53, 2, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-12-15 01:54:09', '2026-01-24 01:54:09'),
(42, 7, 'Botble\\RealEstate\\Models\\Project', 18, 1, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(43, 1, 'Botble\\RealEstate\\Models\\Property', 27, 3, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-11-17 01:54:09', '2026-01-24 01:54:09'),
(44, 12, 'Botble\\RealEstate\\Models\\Project', 9, 1, 'The project completion ahead of schedule shows excellent project management.', 'approved', '2025-11-28 01:54:09', '2026-01-24 01:54:09'),
(45, 11, 'Botble\\RealEstate\\Models\\Property', 50, 4, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-12-22 01:54:09', '2026-01-24 01:54:09'),
(47, 7, 'Botble\\RealEstate\\Models\\Property', 15, 4, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-12-06 01:54:09', '2026-01-24 01:54:09'),
(48, 3, 'Botble\\RealEstate\\Models\\Project', 15, 5, 'The common areas in this project are exceptionally well-designed. Perfect blend of functionality and beauty.', 'approved', '2025-11-19 01:54:09', '2026-01-24 01:54:09'),
(49, 5, 'Botble\\RealEstate\\Models\\Property', 7, 3, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-12-14 01:54:09', '2026-01-24 01:54:09'),
(50, 7, 'Botble\\RealEstate\\Models\\Project', 3, 1, 'Sound insulation between units is excellent. No noise complaints whatsoever.', 'approved', '2025-10-07 01:54:09', '2026-01-24 01:54:09'),
(51, 5, 'Botble\\RealEstate\\Models\\Property', 57, 5, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-10-12 01:54:09', '2026-01-24 01:54:09'),
(52, 9, 'Botble\\RealEstate\\Models\\Project', 13, 5, 'The project offers great variety in unit sizes. Something for everyone - singles, couples, and families.', 'approved', '2025-10-28 01:54:09', '2026-01-24 01:54:09'),
(53, 6, 'Botble\\RealEstate\\Models\\Property', 47, 4, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(54, 3, 'Botble\\RealEstate\\Models\\Project', 4, 5, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2025-10-01 01:54:09', '2026-01-24 01:54:09'),
(55, 7, 'Botble\\RealEstate\\Models\\Property', 54, 1, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-10-29 01:54:09', '2026-01-24 01:54:09'),
(56, 2, 'Botble\\RealEstate\\Models\\Project', 6, 5, 'Energy-efficient design reduces monthly utility costs significantly.', 'approved', '2026-01-22 01:54:09', '2026-01-24 01:54:09'),
(57, 3, 'Botble\\RealEstate\\Models\\Property', 6, 5, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2026-01-10 01:54:09', '2026-01-24 01:54:09'),
(58, 11, 'Botble\\RealEstate\\Models\\Project', 15, 4, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2026-01-08 01:54:09', '2026-01-24 01:54:09'),
(61, 3, 'Botble\\RealEstate\\Models\\Property', 9, 3, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2026-01-20 01:54:09', '2026-01-24 01:54:09'),
(62, 5, 'Botble\\RealEstate\\Models\\Project', 8, 5, 'The lobby and entrance areas make a great first impression on visitors.', 'approved', '2025-11-05 01:54:09', '2026-01-24 01:54:09'),
(63, 3, 'Botble\\RealEstate\\Models\\Property', 7, 3, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-01 01:54:09', '2026-01-24 01:54:09'),
(64, 7, 'Botble\\RealEstate\\Models\\Project', 16, 3, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-10-08 01:54:09', '2026-01-24 01:54:09'),
(65, 6, 'Botble\\RealEstate\\Models\\Property', 52, 5, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2026-01-15 01:54:09', '2026-01-24 01:54:09'),
(66, 1, 'Botble\\RealEstate\\Models\\Project', 12, 1, 'Developer reputation speaks for itself. This project maintains their high standards.', 'approved', '2025-11-28 01:54:09', '2026-01-24 01:54:09'),
(67, 9, 'Botble\\RealEstate\\Models\\Property', 10, 1, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2025-11-10 01:54:09', '2026-01-24 01:54:09'),
(68, 10, 'Botble\\RealEstate\\Models\\Project', 15, 2, 'The lobby and entrance areas make a great first impression on visitors.', 'approved', '2025-10-29 01:54:09', '2026-01-24 01:54:09'),
(69, 8, 'Botble\\RealEstate\\Models\\Property', 4, 1, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-12-14 01:54:09', '2026-01-24 01:54:09'),
(71, 10, 'Botble\\RealEstate\\Models\\Property', 22, 5, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-10-23 01:54:09', '2026-01-24 01:54:09'),
(72, 6, 'Botble\\RealEstate\\Models\\Project', 13, 1, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-10-01 01:54:09', '2026-01-24 01:54:09'),
(73, 7, 'Botble\\RealEstate\\Models\\Property', 27, 5, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2026-01-21 01:54:09', '2026-01-24 01:54:09'),
(74, 11, 'Botble\\RealEstate\\Models\\Project', 14, 3, 'The project has enhanced property values in the entire area.', 'approved', '2026-01-14 01:54:09', '2026-01-24 01:54:09'),
(75, 5, 'Botble\\RealEstate\\Models\\Property', 25, 4, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-12-16 01:54:09', '2026-01-24 01:54:09'),
(76, 8, 'Botble\\RealEstate\\Models\\Project', 14, 1, 'High-quality materials used in construction. You can see the attention to detail in every corner.', 'approved', '2025-10-10 01:54:09', '2026-01-24 01:54:09'),
(77, 7, 'Botble\\RealEstate\\Models\\Property', 9, 3, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-10-01 01:54:09', '2026-01-24 01:54:09'),
(78, 6, 'Botble\\RealEstate\\Models\\Project', 10, 4, 'The project completion ahead of schedule shows excellent project management.', 'approved', '2026-01-06 01:54:09', '2026-01-24 01:54:09'),
(80, 1, 'Botble\\RealEstate\\Models\\Project', 8, 3, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2025-12-10 01:54:09', '2026-01-24 01:54:09'),
(81, 4, 'Botble\\RealEstate\\Models\\Property', 10, 1, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2026-01-07 01:54:09', '2026-01-24 01:54:09'),
(82, 4, 'Botble\\RealEstate\\Models\\Project', 9, 4, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-09-29 01:54:09', '2026-01-24 01:54:09'),
(83, 12, 'Botble\\RealEstate\\Models\\Property', 6, 3, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-09-26 01:54:09', '2026-01-24 01:54:09'),
(85, 2, 'Botble\\RealEstate\\Models\\Property', 42, 2, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-12-17 01:54:09', '2026-01-24 01:54:09'),
(86, 3, 'Botble\\RealEstate\\Models\\Project', 8, 4, 'The project has won multiple awards for its design and sustainability features.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(87, 9, 'Botble\\RealEstate\\Models\\Property', 21, 4, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-11-07 01:54:09', '2026-01-24 01:54:09'),
(88, 11, 'Botble\\RealEstate\\Models\\Project', 5, 3, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-12-23 01:54:09', '2026-01-24 01:54:09'),
(89, 1, 'Botble\\RealEstate\\Models\\Property', 26, 2, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2026-01-22 01:54:09', '2026-01-24 01:54:09'),
(90, 11, 'Botble\\RealEstate\\Models\\Project', 11, 4, 'Looking forward to the next phase of this development. The first phase has been outstanding.', 'approved', '2026-01-03 01:54:09', '2026-01-24 01:54:09'),
(91, 10, 'Botble\\RealEstate\\Models\\Property', 33, 3, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-10-30 01:54:09', '2026-01-24 01:54:09'),
(92, 9, 'Botble\\RealEstate\\Models\\Project', 5, 1, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2026-01-18 01:54:09', '2026-01-24 01:54:09'),
(93, 8, 'Botble\\RealEstate\\Models\\Property', 49, 2, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-10-03 01:54:09', '2026-01-24 01:54:09'),
(94, 3, 'Botble\\RealEstate\\Models\\Project', 16, 5, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-12-10 01:54:09', '2026-01-24 01:54:09'),
(95, 5, 'Botble\\RealEstate\\Models\\Property', 60, 1, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-09-26 01:54:09', '2026-01-24 01:54:09'),
(96, 9, 'Botble\\RealEstate\\Models\\Project', 6, 4, 'Energy-efficient design reduces monthly utility costs significantly.', 'approved', '2026-01-02 01:54:09', '2026-01-24 01:54:09'),
(97, 5, 'Botble\\RealEstate\\Models\\Property', 21, 5, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-11-26 01:54:09', '2026-01-24 01:54:09'),
(98, 3, 'Botble\\RealEstate\\Models\\Project', 14, 3, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(99, 4, 'Botble\\RealEstate\\Models\\Property', 8, 2, 'Love the outdoor space - perfect for gardening and entertaining guests.', 'approved', '2025-10-19 01:54:09', '2026-01-24 01:54:09'),
(100, 1, 'Botble\\RealEstate\\Models\\Project', 5, 1, 'Project management was transparent throughout the development phase. Regular updates kept buyers informed.', 'approved', '2025-10-21 01:54:09', '2026-01-24 01:54:09'),
(101, 6, 'Botble\\RealEstate\\Models\\Property', 39, 2, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-09-27 01:54:09', '2026-01-24 01:54:09'),
(102, 3, 'Botble\\RealEstate\\Models\\Project', 12, 5, 'The project timeline was met and the final result is stunning. Very professional team behind this development.', 'approved', '2025-11-20 01:54:09', '2026-01-24 01:54:09'),
(103, 4, 'Botble\\RealEstate\\Models\\Property', 24, 4, 'Love the outdoor space - perfect for gardening and entertaining guests.', 'approved', '2025-10-19 01:54:09', '2026-01-24 01:54:09'),
(105, 2, 'Botble\\RealEstate\\Models\\Property', 31, 5, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2026-01-21 01:54:09', '2026-01-24 01:54:09'),
(108, 6, 'Botble\\RealEstate\\Models\\Project', 18, 4, 'This development project has exceeded all expectations. The architects have done an amazing job balancing aesthetics with functionality.', 'approved', '2025-12-09 01:54:09', '2026-01-24 01:54:09'),
(109, 8, 'Botble\\RealEstate\\Models\\Property', 56, 5, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-12-13 01:54:09', '2026-01-24 01:54:09'),
(110, 10, 'Botble\\RealEstate\\Models\\Project', 6, 5, 'Security features throughout the project are state-of-the-art. Feel safe living here.', 'approved', '2025-12-10 01:54:09', '2026-01-24 01:54:09'),
(111, 11, 'Botble\\RealEstate\\Models\\Property', 11, 1, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2026-01-07 01:54:09', '2026-01-24 01:54:09'),
(112, 9, 'Botble\\RealEstate\\Models\\Project', 4, 5, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-11-22 01:54:09', '2026-01-24 01:54:09'),
(113, 9, 'Botble\\RealEstate\\Models\\Property', 55, 3, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2026-01-22 01:54:09', '2026-01-24 01:54:09'),
(114, 12, 'Botble\\RealEstate\\Models\\Project', 4, 3, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-12-27 01:54:09', '2026-01-24 01:54:09'),
(115, 10, 'Botble\\RealEstate\\Models\\Property', 20, 1, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-12-25 01:54:09', '2026-01-24 01:54:09'),
(116, 11, 'Botble\\RealEstate\\Models\\Project', 13, 2, 'The landscaping around this project is beautiful. Green spaces make the community feel alive.', 'approved', '2025-11-09 01:54:09', '2026-01-24 01:54:09'),
(117, 9, 'Botble\\RealEstate\\Models\\Property', 16, 4, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2026-01-10 01:54:09', '2026-01-24 01:54:09'),
(118, 2, 'Botble\\RealEstate\\Models\\Project', 11, 4, 'The project has excellent connectivity to major roads and public transportation.', 'approved', '2025-11-22 01:54:09', '2026-01-24 01:54:09'),
(119, 12, 'Botble\\RealEstate\\Models\\Property', 61, 4, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-12-09 01:54:09', '2026-01-24 01:54:09'),
(120, 4, 'Botble\\RealEstate\\Models\\Project', 3, 5, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-11-26 01:54:09', '2026-01-24 01:54:09'),
(121, 4, 'Botble\\RealEstate\\Models\\Property', 14, 1, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-05 01:54:09', '2026-01-24 01:54:09'),
(124, 5, 'Botble\\RealEstate\\Models\\Project', 12, 1, 'Project management was transparent throughout the development phase. Regular updates kept buyers informed.', 'approved', '2025-10-21 01:54:09', '2026-01-24 01:54:09'),
(125, 7, 'Botble\\RealEstate\\Models\\Property', 44, 1, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-11-06 01:54:09', '2026-01-24 01:54:09'),
(126, 5, 'Botble\\RealEstate\\Models\\Project', 9, 3, 'The common areas in this project are exceptionally well-designed. Perfect blend of functionality and beauty.', 'approved', '2025-10-05 01:54:09', '2026-01-24 01:54:09'),
(127, 3, 'Botble\\RealEstate\\Models\\Property', 21, 1, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-09-28 01:54:09', '2026-01-24 01:54:09'),
(128, 8, 'Botble\\RealEstate\\Models\\Project', 5, 4, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(129, 10, 'Botble\\RealEstate\\Models\\Property', 4, 3, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(130, 4, 'Botble\\RealEstate\\Models\\Project', 4, 2, 'Sound insulation between units is excellent. No noise complaints whatsoever.', 'approved', '2025-12-31 01:54:09', '2026-01-24 01:54:09'),
(133, 5, 'Botble\\RealEstate\\Models\\Property', 49, 1, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-11-04 01:54:09', '2026-01-24 01:54:09'),
(135, 2, 'Botble\\RealEstate\\Models\\Property', 7, 4, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-10-11 01:54:09', '2026-01-24 01:54:09'),
(136, 7, 'Botble\\RealEstate\\Models\\Project', 17, 2, 'The common areas in this project are exceptionally well-designed. Perfect blend of functionality and beauty.', 'approved', '2025-11-02 01:54:09', '2026-01-24 01:54:09'),
(137, 7, 'Botble\\RealEstate\\Models\\Property', 11, 3, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-10-30 01:54:09', '2026-01-24 01:54:09'),
(139, 7, 'Botble\\RealEstate\\Models\\Property', 3, 4, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-12-02 01:54:09', '2026-01-24 01:54:09'),
(141, 10, 'Botble\\RealEstate\\Models\\Property', 28, 2, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-09-27 01:54:09', '2026-01-24 01:54:09'),
(142, 8, 'Botble\\RealEstate\\Models\\Project', 8, 4, 'The landscaping around this project is beautiful. Green spaces make the community feel alive.', 'approved', '2025-11-13 01:54:09', '2026-01-24 01:54:09'),
(143, 12, 'Botble\\RealEstate\\Models\\Property', 31, 3, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-11-22 01:54:09', '2026-01-24 01:54:09'),
(144, 9, 'Botble\\RealEstate\\Models\\Project', 8, 2, 'The landscaping around this project is beautiful. Green spaces make the community feel alive.', 'approved', '2026-01-05 01:54:09', '2026-01-24 01:54:09'),
(145, 5, 'Botble\\RealEstate\\Models\\Property', 58, 1, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-10-27 01:54:09', '2026-01-24 01:54:09'),
(147, 4, 'Botble\\RealEstate\\Models\\Property', 58, 5, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-10-19 01:54:09', '2026-01-24 01:54:09'),
(148, 9, 'Botble\\RealEstate\\Models\\Project', 14, 3, 'The project has enhanced property values in the entire area.', 'approved', '2025-12-22 01:54:09', '2026-01-24 01:54:09'),
(149, 2, 'Botble\\RealEstate\\Models\\Property', 48, 4, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2026-01-03 01:54:09', '2026-01-24 01:54:09'),
(150, 8, 'Botble\\RealEstate\\Models\\Project', 4, 3, 'The developer provided excellent after-sales service. Any snags were fixed promptly.', 'approved', '2025-11-17 01:54:09', '2026-01-24 01:54:09'),
(151, 9, 'Botble\\RealEstate\\Models\\Property', 28, 2, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-10-22 01:54:09', '2026-01-24 01:54:09'),
(152, 1, 'Botble\\RealEstate\\Models\\Project', 10, 5, 'The developer provided excellent after-sales service. Any snags were fixed promptly.', 'approved', '2025-10-03 01:54:09', '2026-01-24 01:54:09'),
(153, 2, 'Botble\\RealEstate\\Models\\Property', 12, 4, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-10-11 01:54:09', '2026-01-24 01:54:09'),
(154, 11, 'Botble\\RealEstate\\Models\\Project', 10, 5, 'The project has won multiple awards for its design and sustainability features.', 'approved', '2026-01-03 01:54:09', '2026-01-24 01:54:09'),
(155, 1, 'Botble\\RealEstate\\Models\\Property', 17, 3, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-12-09 01:54:09', '2026-01-24 01:54:09'),
(158, 8, 'Botble\\RealEstate\\Models\\Project', 9, 1, 'The lobby and entrance areas make a great first impression on visitors.', 'approved', '2025-11-09 01:54:09', '2026-01-24 01:54:09'),
(159, 3, 'Botble\\RealEstate\\Models\\Property', 28, 3, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-10-22 01:54:09', '2026-01-24 01:54:09'),
(160, 5, 'Botble\\RealEstate\\Models\\Project', 16, 5, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-10-25 01:54:09', '2026-01-24 01:54:09'),
(161, 4, 'Botble\\RealEstate\\Models\\Property', 49, 5, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-11-07 01:54:09', '2026-01-24 01:54:09'),
(162, 10, 'Botble\\RealEstate\\Models\\Project', 7, 3, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-12-10 01:54:09', '2026-01-24 01:54:09'),
(163, 5, 'Botble\\RealEstate\\Models\\Property', 46, 5, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-12-09 01:54:09', '2026-01-24 01:54:09'),
(164, 8, 'Botble\\RealEstate\\Models\\Project', 16, 3, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-10-06 01:54:09', '2026-01-24 01:54:09'),
(165, 6, 'Botble\\RealEstate\\Models\\Property', 33, 1, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-11-30 01:54:09', '2026-01-24 01:54:09'),
(167, 5, 'Botble\\RealEstate\\Models\\Property', 26, 2, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-12-16 01:54:09', '2026-01-24 01:54:09'),
(168, 12, 'Botble\\RealEstate\\Models\\Project', 14, 5, 'This development project has exceeded all expectations. The architects have done an amazing job balancing aesthetics with functionality.', 'approved', '2025-11-03 01:54:09', '2026-01-24 01:54:09'),
(169, 1, 'Botble\\RealEstate\\Models\\Property', 3, 2, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-09-27 01:54:09', '2026-01-24 01:54:09'),
(171, 2, 'Botble\\RealEstate\\Models\\Property', 36, 2, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-10-25 01:54:09', '2026-01-24 01:54:09'),
(172, 7, 'Botble\\RealEstate\\Models\\Project', 6, 4, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-12-21 01:54:09', '2026-01-24 01:54:09'),
(173, 11, 'Botble\\RealEstate\\Models\\Property', 45, 1, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2026-01-16 01:54:09', '2026-01-24 01:54:09'),
(174, 5, 'Botble\\RealEstate\\Models\\Project', 13, 5, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-10-16 01:54:09', '2026-01-24 01:54:09'),
(175, 1, 'Botble\\RealEstate\\Models\\Property', 10, 3, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2026-01-23 01:54:09', '2026-01-24 01:54:09'),
(176, 10, 'Botble\\RealEstate\\Models\\Project', 4, 5, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-09-29 01:54:09', '2026-01-24 01:54:09'),
(177, 5, 'Botble\\RealEstate\\Models\\Property', 14, 1, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-09-27 01:54:09', '2026-01-24 01:54:09'),
(178, 5, 'Botble\\RealEstate\\Models\\Project', 7, 4, 'The project offers great variety in unit sizes. Something for everyone - singles, couples, and families.', 'approved', '2025-10-17 01:54:09', '2026-01-24 01:54:09'),
(179, 4, 'Botble\\RealEstate\\Models\\Property', 55, 3, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(180, 9, 'Botble\\RealEstate\\Models\\Project', 17, 3, 'Looking forward to the next phase of this development. The first phase has been outstanding.', 'approved', '2026-01-20 01:54:09', '2026-01-24 01:54:09'),
(181, 9, 'Botble\\RealEstate\\Models\\Property', 30, 5, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(182, 1, 'Botble\\RealEstate\\Models\\Project', 16, 5, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-11-07 01:54:09', '2026-01-24 01:54:09'),
(183, 10, 'Botble\\RealEstate\\Models\\Property', 1, 1, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-20 01:54:09', '2026-01-24 01:54:09'),
(184, 4, 'Botble\\RealEstate\\Models\\Project', 10, 4, 'The project has excellent connectivity to major roads and public transportation.', 'approved', '2025-12-02 01:54:09', '2026-01-24 01:54:09'),
(186, 3, 'Botble\\RealEstate\\Models\\Project', 6, 3, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2025-10-28 01:54:09', '2026-01-24 01:54:09'),
(187, 11, 'Botble\\RealEstate\\Models\\Property', 12, 4, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-10-07 01:54:09', '2026-01-24 01:54:09'),
(188, 2, 'Botble\\RealEstate\\Models\\Project', 9, 3, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-12-02 01:54:09', '2026-01-24 01:54:09'),
(189, 7, 'Botble\\RealEstate\\Models\\Property', 31, 4, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2026-01-17 01:54:09', '2026-01-24 01:54:09'),
(190, 5, 'Botble\\RealEstate\\Models\\Project', 11, 5, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-10-30 01:54:09', '2026-01-24 01:54:09'),
(191, 3, 'Botble\\RealEstate\\Models\\Property', 17, 3, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-11-01 01:54:09', '2026-01-24 01:54:09'),
(192, 11, 'Botble\\RealEstate\\Models\\Project', 2, 5, 'Security features throughout the project are state-of-the-art. Feel safe living here.', 'approved', '2025-10-21 01:54:09', '2026-01-24 01:54:09'),
(193, 3, 'Botble\\RealEstate\\Models\\Property', 59, 2, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-09-27 01:54:09', '2026-01-24 01:54:09'),
(194, 6, 'Botble\\RealEstate\\Models\\Project', 1, 3, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(195, 7, 'Botble\\RealEstate\\Models\\Property', 25, 1, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-12-23 01:54:09', '2026-01-24 01:54:09'),
(197, 4, 'Botble\\RealEstate\\Models\\Property', 17, 5, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-10-16 01:54:09', '2026-01-24 01:54:09'),
(199, 3, 'Botble\\RealEstate\\Models\\Property', 61, 3, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2026-01-20 01:54:09', '2026-01-24 01:54:09'),
(200, 2, 'Botble\\RealEstate\\Models\\Project', 18, 5, 'Project management was transparent throughout the development phase. Regular updates kept buyers informed.', 'approved', '2025-11-07 01:54:09', '2026-01-24 01:54:09'),
(201, 7, 'Botble\\RealEstate\\Models\\Property', 18, 5, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-12-05 01:54:09', '2026-01-24 01:54:09'),
(203, 12, 'Botble\\RealEstate\\Models\\Property', 40, 2, 'Great natural lighting throughout the day. The south-facing windows make a huge difference.', 'approved', '2025-11-22 01:54:09', '2026-01-24 01:54:09'),
(204, 6, 'Botble\\RealEstate\\Models\\Project', 8, 5, 'The landscaping around this project is beautiful. Green spaces make the community feel alive.', 'approved', '2026-01-12 01:54:09', '2026-01-24 01:54:09'),
(205, 12, 'Botble\\RealEstate\\Models\\Property', 22, 2, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-12-20 01:54:09', '2026-01-24 01:54:09'),
(207, 7, 'Botble\\RealEstate\\Models\\Property', 40, 3, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-12-15 01:54:09', '2026-01-24 01:54:09'),
(208, 4, 'Botble\\RealEstate\\Models\\Project', 12, 5, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2026-01-08 01:54:09', '2026-01-24 01:54:09'),
(209, 6, 'Botble\\RealEstate\\Models\\Property', 1, 1, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-10-14 01:54:09', '2026-01-24 01:54:09'),
(210, 7, 'Botble\\RealEstate\\Models\\Project', 10, 5, 'Developer reputation speaks for itself. This project maintains their high standards.', 'approved', '2025-12-29 01:54:09', '2026-01-24 01:54:09'),
(211, 1, 'Botble\\RealEstate\\Models\\Property', 43, 1, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-10-05 01:54:09', '2026-01-24 01:54:09'),
(212, 12, 'Botble\\RealEstate\\Models\\Project', 18, 1, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-10-16 01:54:09', '2026-01-24 01:54:09'),
(213, 5, 'Botble\\RealEstate\\Models\\Property', 17, 5, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-03 01:54:09', '2026-01-24 01:54:09'),
(214, 12, 'Botble\\RealEstate\\Models\\Project', 3, 1, 'Energy-efficient design reduces monthly utility costs significantly.', 'approved', '2025-10-03 01:54:09', '2026-01-24 01:54:09'),
(215, 11, 'Botble\\RealEstate\\Models\\Property', 5, 1, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-11-02 01:54:09', '2026-01-24 01:54:09'),
(216, 2, 'Botble\\RealEstate\\Models\\Project', 17, 1, 'Project management was transparent throughout the development phase. Regular updates kept buyers informed.', 'approved', '2025-12-01 01:54:09', '2026-01-24 01:54:09'),
(217, 2, 'Botble\\RealEstate\\Models\\Property', 44, 5, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-12-02 01:54:09', '2026-01-24 01:54:09'),
(219, 2, 'Botble\\RealEstate\\Models\\Property', 28, 1, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-11-11 01:54:09', '2026-01-24 01:54:09'),
(220, 1, 'Botble\\RealEstate\\Models\\Project', 13, 2, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-11-06 01:54:09', '2026-01-24 01:54:09'),
(221, 12, 'Botble\\RealEstate\\Models\\Property', 3, 4, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-12-03 01:54:09', '2026-01-24 01:54:09'),
(222, 10, 'Botble\\RealEstate\\Models\\Project', 3, 1, 'The project has enhanced property values in the entire area.', 'approved', '2025-11-19 01:54:09', '2026-01-24 01:54:09'),
(223, 6, 'Botble\\RealEstate\\Models\\Property', 57, 5, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-10-10 01:54:09', '2026-01-24 01:54:09'),
(224, 6, 'Botble\\RealEstate\\Models\\Project', 5, 5, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-11-04 01:54:09', '2026-01-24 01:54:09'),
(225, 8, 'Botble\\RealEstate\\Models\\Property', 17, 2, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-12-19 01:54:09', '2026-01-24 01:54:09'),
(226, 4, 'Botble\\RealEstate\\Models\\Project', 2, 1, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-10-26 01:54:09', '2026-01-24 01:54:09'),
(227, 1, 'Botble\\RealEstate\\Models\\Property', 20, 1, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-12-28 01:54:09', '2026-01-24 01:54:09'),
(228, 4, 'Botble\\RealEstate\\Models\\Project', 11, 5, 'This development project has exceeded all expectations. The architects have done an amazing job balancing aesthetics with functionality.', 'approved', '2026-01-04 01:54:09', '2026-01-24 01:54:09'),
(229, 9, 'Botble\\RealEstate\\Models\\Property', 54, 2, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-10-19 01:54:09', '2026-01-24 01:54:09'),
(233, 11, 'Botble\\RealEstate\\Models\\Property', 6, 1, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-11-17 01:54:09', '2026-01-24 01:54:09'),
(234, 8, 'Botble\\RealEstate\\Models\\Project', 18, 5, 'Beautiful architectural design that stands out in the neighborhood.', 'approved', '2025-11-20 01:54:09', '2026-01-24 01:54:09'),
(235, 12, 'Botble\\RealEstate\\Models\\Property', 32, 2, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-11-16 01:54:09', '2026-01-24 01:54:09'),
(237, 12, 'Botble\\RealEstate\\Models\\Property', 48, 4, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-12-26 01:54:09', '2026-01-24 01:54:09'),
(239, 3, 'Botble\\RealEstate\\Models\\Property', 36, 3, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-21 01:54:09', '2026-01-24 01:54:09'),
(240, 2, 'Botble\\RealEstate\\Models\\Project', 7, 3, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2026-01-04 01:54:09', '2026-01-24 01:54:09'),
(241, 7, 'Botble\\RealEstate\\Models\\Property', 37, 5, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-10-02 01:54:09', '2026-01-24 01:54:09'),
(243, 7, 'Botble\\RealEstate\\Models\\Property', 41, 1, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(245, 4, 'Botble\\RealEstate\\Models\\Property', 36, 5, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-12-22 01:54:09', '2026-01-24 01:54:09'),
(246, 5, 'Botble\\RealEstate\\Models\\Project', 2, 5, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-12-29 01:54:09', '2026-01-24 01:54:09'),
(247, 12, 'Botble\\RealEstate\\Models\\Property', 10, 4, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-11-10 01:54:09', '2026-01-24 01:54:09'),
(248, 11, 'Botble\\RealEstate\\Models\\Project', 4, 1, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-10-03 01:54:09', '2026-01-24 01:54:09'),
(251, 4, 'Botble\\RealEstate\\Models\\Property', 31, 3, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2026-01-11 01:54:09', '2026-01-24 01:54:09'),
(253, 4, 'Botble\\RealEstate\\Models\\Property', 7, 3, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(254, 7, 'Botble\\RealEstate\\Models\\Project', 9, 4, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-12-23 01:54:09', '2026-01-24 01:54:09'),
(255, 7, 'Botble\\RealEstate\\Models\\Property', 16, 2, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-12-06 01:54:09', '2026-01-24 01:54:09'),
(256, 4, 'Botble\\RealEstate\\Models\\Project', 5, 5, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-10-06 01:54:09', '2026-01-24 01:54:09'),
(257, 9, 'Botble\\RealEstate\\Models\\Property', 12, 1, 'Great natural lighting throughout the day. The south-facing windows make a huge difference.', 'approved', '2025-09-28 01:54:09', '2026-01-24 01:54:09'),
(259, 1, 'Botble\\RealEstate\\Models\\Property', 14, 4, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-10-29 01:54:09', '2026-01-24 01:54:09'),
(261, 10, 'Botble\\RealEstate\\Models\\Property', 26, 2, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-19 01:54:09', '2026-01-24 01:54:09'),
(263, 1, 'Botble\\RealEstate\\Models\\Property', 50, 5, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-11-13 01:54:09', '2026-01-24 01:54:09'),
(264, 7, 'Botble\\RealEstate\\Models\\Project', 15, 3, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-12-27 01:54:09', '2026-01-24 01:54:09'),
(265, 9, 'Botble\\RealEstate\\Models\\Property', 17, 4, 'Great natural lighting throughout the day. The south-facing windows make a huge difference.', 'approved', '2026-01-04 01:54:09', '2026-01-24 01:54:09'),
(266, 2, 'Botble\\RealEstate\\Models\\Project', 8, 2, 'The common areas in this project are exceptionally well-designed. Perfect blend of functionality and beauty.', 'approved', '2025-10-27 01:54:09', '2026-01-24 01:54:09'),
(267, 10, 'Botble\\RealEstate\\Models\\Property', 7, 3, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-10-02 01:54:09', '2026-01-24 01:54:09'),
(268, 1, 'Botble\\RealEstate\\Models\\Project', 14, 2, 'Security features throughout the project are state-of-the-art. Feel safe living here.', 'approved', '2025-09-28 01:54:09', '2026-01-24 01:54:09'),
(269, 3, 'Botble\\RealEstate\\Models\\Property', 13, 2, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-12-04 01:54:09', '2026-01-24 01:54:09'),
(270, 6, 'Botble\\RealEstate\\Models\\Project', 3, 2, 'The project has enhanced property values in the entire area.', 'approved', '2025-11-19 01:54:09', '2026-01-24 01:54:09'),
(271, 9, 'Botble\\RealEstate\\Models\\Property', 1, 2, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-12-21 01:54:09', '2026-01-24 01:54:09'),
(272, 9, 'Botble\\RealEstate\\Models\\Project', 1, 3, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-11-10 01:54:09', '2026-01-24 01:54:09'),
(273, 7, 'Botble\\RealEstate\\Models\\Property', 24, 4, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-20 01:54:09', '2026-01-24 01:54:09'),
(274, 2, 'Botble\\RealEstate\\Models\\Project', 10, 4, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-10-26 01:54:09', '2026-01-24 01:54:09');
INSERT INTO `re_reviews` (`id`, `account_id`, `reviewable_type`, `reviewable_id`, `star`, `content`, `status`, `created_at`, `updated_at`) VALUES
(275, 6, 'Botble\\RealEstate\\Models\\Property', 24, 2, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-10-17 01:54:09', '2026-01-24 01:54:09'),
(276, 3, 'Botble\\RealEstate\\Models\\Project', 7, 4, 'High-quality materials used in construction. You can see the attention to detail in every corner.', 'approved', '2026-01-12 01:54:09', '2026-01-24 01:54:09'),
(277, 1, 'Botble\\RealEstate\\Models\\Property', 41, 3, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2026-01-20 01:54:09', '2026-01-24 01:54:09'),
(278, 10, 'Botble\\RealEstate\\Models\\Project', 12, 4, 'Sustainable building practices were used throughout this project. Appreciate the eco-friendly approach.', 'approved', '2026-01-09 01:54:09', '2026-01-24 01:54:09'),
(279, 10, 'Botble\\RealEstate\\Models\\Property', 23, 1, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(281, 8, 'Botble\\RealEstate\\Models\\Property', 33, 1, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-10-08 01:54:09', '2026-01-24 01:54:09'),
(282, 1, 'Botble\\RealEstate\\Models\\Project', 7, 2, 'Looking forward to the next phase of this development. The first phase has been outstanding.', 'approved', '2025-11-05 01:54:09', '2026-01-24 01:54:09'),
(283, 11, 'Botble\\RealEstate\\Models\\Property', 29, 5, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-10-17 01:54:09', '2026-01-24 01:54:09'),
(284, 7, 'Botble\\RealEstate\\Models\\Project', 14, 3, 'Looking forward to the next phase of this development. The first phase has been outstanding.', 'approved', '2025-10-24 01:54:09', '2026-01-24 01:54:09'),
(285, 7, 'Botble\\RealEstate\\Models\\Property', 39, 2, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-09-28 01:54:09', '2026-01-24 01:54:09'),
(287, 4, 'Botble\\RealEstate\\Models\\Property', 33, 4, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2025-11-29 01:54:09', '2026-01-24 01:54:09'),
(289, 6, 'Botble\\RealEstate\\Models\\Property', 7, 4, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-11-10 01:54:09', '2026-01-24 01:54:09'),
(291, 12, 'Botble\\RealEstate\\Models\\Property', 13, 5, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2026-01-13 01:54:09', '2026-01-24 01:54:09'),
(292, 4, 'Botble\\RealEstate\\Models\\Project', 13, 4, 'The project has enhanced property values in the entire area.', 'approved', '2026-01-01 01:54:09', '2026-01-24 01:54:09'),
(293, 5, 'Botble\\RealEstate\\Models\\Property', 8, 1, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-15 01:54:09', '2026-01-24 01:54:09'),
(295, 1, 'Botble\\RealEstate\\Models\\Property', 31, 4, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-09-28 01:54:09', '2026-01-24 01:54:09'),
(296, 6, 'Botble\\RealEstate\\Models\\Project', 7, 1, 'Beautiful architectural design that stands out in the neighborhood.', 'approved', '2025-11-28 01:54:09', '2026-01-24 01:54:09'),
(297, 12, 'Botble\\RealEstate\\Models\\Property', 52, 1, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-16 01:54:09', '2026-01-24 01:54:09'),
(298, 5, 'Botble\\RealEstate\\Models\\Project', 4, 4, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2026-01-22 01:54:09', '2026-01-24 01:54:09'),
(299, 9, 'Botble\\RealEstate\\Models\\Property', 27, 3, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-10-07 01:54:09', '2026-01-24 01:54:09'),
(300, 5, 'Botble\\RealEstate\\Models\\Project', 6, 5, 'The project has excellent connectivity to major roads and public transportation.', 'approved', '2026-01-07 01:54:09', '2026-01-24 01:54:09'),
(301, 4, 'Botble\\RealEstate\\Models\\Property', 35, 1, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-11-11 01:54:09', '2026-01-24 01:54:09'),
(302, 3, 'Botble\\RealEstate\\Models\\Project', 3, 5, 'Security features throughout the project are state-of-the-art. Feel safe living here.', 'approved', '2025-10-21 01:54:09', '2026-01-24 01:54:09'),
(303, 11, 'Botble\\RealEstate\\Models\\Property', 7, 5, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-12-29 01:54:09', '2026-01-24 01:54:09'),
(305, 2, 'Botble\\RealEstate\\Models\\Property', 55, 5, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(307, 8, 'Botble\\RealEstate\\Models\\Property', 44, 1, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2026-01-19 01:54:09', '2026-01-24 01:54:09'),
(308, 11, 'Botble\\RealEstate\\Models\\Project', 16, 2, 'The project offers great variety in unit sizes. Something for everyone - singles, couples, and families.', 'approved', '2025-11-28 01:54:09', '2026-01-24 01:54:09'),
(309, 12, 'Botble\\RealEstate\\Models\\Property', 58, 1, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(310, 2, 'Botble\\RealEstate\\Models\\Project', 3, 1, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(311, 10, 'Botble\\RealEstate\\Models\\Property', 32, 5, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-11-15 01:54:09', '2026-01-24 01:54:09'),
(313, 4, 'Botble\\RealEstate\\Models\\Property', 2, 4, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-10-11 01:54:09', '2026-01-24 01:54:09'),
(314, 1, 'Botble\\RealEstate\\Models\\Project', 6, 4, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2025-11-25 01:54:09', '2026-01-24 01:54:09'),
(315, 1, 'Botble\\RealEstate\\Models\\Property', 23, 3, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-12-23 01:54:09', '2026-01-24 01:54:09'),
(316, 8, 'Botble\\RealEstate\\Models\\Project', 6, 2, 'High-quality materials used in construction. You can see the attention to detail in every corner.', 'approved', '2026-01-17 01:54:09', '2026-01-24 01:54:09'),
(317, 4, 'Botble\\RealEstate\\Models\\Property', 18, 3, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-12-19 01:54:09', '2026-01-24 01:54:09'),
(318, 12, 'Botble\\RealEstate\\Models\\Project', 2, 4, 'Energy-efficient design reduces monthly utility costs significantly.', 'approved', '2025-12-23 01:54:09', '2026-01-24 01:54:09'),
(319, 12, 'Botble\\RealEstate\\Models\\Property', 28, 4, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-11-28 01:54:09', '2026-01-24 01:54:09'),
(320, 12, 'Botble\\RealEstate\\Models\\Project', 13, 1, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-11-26 01:54:09', '2026-01-24 01:54:09'),
(323, 7, 'Botble\\RealEstate\\Models\\Property', 30, 3, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-12-04 01:54:09', '2026-01-24 01:54:09'),
(325, 12, 'Botble\\RealEstate\\Models\\Property', 50, 1, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-12-20 01:54:09', '2026-01-24 01:54:09'),
(328, 4, 'Botble\\RealEstate\\Models\\Project', 15, 4, 'The amenities included in this project are world-class. Swimming pool, gym, and community spaces are all beautifully designed.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(329, 3, 'Botble\\RealEstate\\Models\\Property', 27, 3, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-10-18 01:54:09', '2026-01-24 01:54:09'),
(331, 1, 'Botble\\RealEstate\\Models\\Property', 49, 4, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-11-07 01:54:09', '2026-01-24 01:54:09'),
(333, 12, 'Botble\\RealEstate\\Models\\Property', 46, 2, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-11-22 01:54:09', '2026-01-24 01:54:09'),
(335, 8, 'Botble\\RealEstate\\Models\\Property', 61, 3, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-11-20 01:54:09', '2026-01-24 01:54:09'),
(336, 5, 'Botble\\RealEstate\\Models\\Project', 1, 1, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-10-26 01:54:09', '2026-01-24 01:54:09'),
(337, 6, 'Botble\\RealEstate\\Models\\Property', 4, 5, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-09-28 01:54:09', '2026-01-24 01:54:09'),
(339, 3, 'Botble\\RealEstate\\Models\\Property', 60, 4, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(340, 12, 'Botble\\RealEstate\\Models\\Project', 10, 3, 'Looking forward to the next phase of this development. The first phase has been outstanding.', 'approved', '2025-12-28 01:54:09', '2026-01-24 01:54:09'),
(343, 8, 'Botble\\RealEstate\\Models\\Property', 8, 3, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-08 01:54:09', '2026-01-24 01:54:09'),
(344, 11, 'Botble\\RealEstate\\Models\\Project', 18, 1, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2026-01-16 01:54:09', '2026-01-24 01:54:09'),
(345, 2, 'Botble\\RealEstate\\Models\\Property', 9, 3, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-11-23 01:54:09', '2026-01-24 01:54:09'),
(347, 12, 'Botble\\RealEstate\\Models\\Property', 47, 3, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-10-25 01:54:09', '2026-01-24 01:54:09'),
(349, 2, 'Botble\\RealEstate\\Models\\Property', 53, 2, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-12-16 01:54:09', '2026-01-24 01:54:09'),
(352, 12, 'Botble\\RealEstate\\Models\\Project', 6, 5, 'Sustainable building practices were used throughout this project. Appreciate the eco-friendly approach.', 'approved', '2025-12-16 01:54:09', '2026-01-24 01:54:09'),
(353, 7, 'Botble\\RealEstate\\Models\\Property', 49, 1, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-10-16 01:54:09', '2026-01-24 01:54:09'),
(355, 9, 'Botble\\RealEstate\\Models\\Property', 52, 2, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2026-01-11 01:54:09', '2026-01-24 01:54:09'),
(356, 2, 'Botble\\RealEstate\\Models\\Project', 16, 1, 'This development project has exceeded all expectations. The architects have done an amazing job balancing aesthetics with functionality.', 'approved', '2026-01-02 01:54:09', '2026-01-24 01:54:09'),
(359, 9, 'Botble\\RealEstate\\Models\\Property', 20, 3, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-12-25 01:54:09', '2026-01-24 01:54:09'),
(361, 7, 'Botble\\RealEstate\\Models\\Property', 57, 2, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-12-07 01:54:09', '2026-01-24 01:54:09'),
(363, 2, 'Botble\\RealEstate\\Models\\Property', 34, 3, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-11-07 01:54:09', '2026-01-24 01:54:09'),
(364, 1, 'Botble\\RealEstate\\Models\\Project', 17, 5, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-11-03 01:54:09', '2026-01-24 01:54:09'),
(365, 9, 'Botble\\RealEstate\\Models\\Property', 51, 5, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-12-05 01:54:09', '2026-01-24 01:54:09'),
(367, 11, 'Botble\\RealEstate\\Models\\Property', 30, 4, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-10-20 01:54:09', '2026-01-24 01:54:09'),
(368, 12, 'Botble\\RealEstate\\Models\\Project', 12, 1, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-12-27 01:54:09', '2026-01-24 01:54:09'),
(369, 1, 'Botble\\RealEstate\\Models\\Property', 56, 5, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-07 01:54:09', '2026-01-24 01:54:09'),
(371, 3, 'Botble\\RealEstate\\Models\\Property', 15, 2, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-10-26 01:54:09', '2026-01-24 01:54:09'),
(372, 5, 'Botble\\RealEstate\\Models\\Project', 5, 2, 'The project has won multiple awards for its design and sustainability features.', 'approved', '2025-12-13 01:54:09', '2026-01-24 01:54:09'),
(373, 10, 'Botble\\RealEstate\\Models\\Property', 55, 2, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-10-30 01:54:09', '2026-01-24 01:54:09'),
(374, 1, 'Botble\\RealEstate\\Models\\Project', 11, 5, 'The common areas in this project are exceptionally well-designed. Perfect blend of functionality and beauty.', 'approved', '2026-01-13 01:54:09', '2026-01-24 01:54:09'),
(375, 3, 'Botble\\RealEstate\\Models\\Property', 22, 1, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-12-14 01:54:09', '2026-01-24 01:54:09'),
(377, 6, 'Botble\\RealEstate\\Models\\Property', 20, 3, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2026-01-15 01:54:09', '2026-01-24 01:54:09'),
(378, 8, 'Botble\\RealEstate\\Models\\Project', 7, 4, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2025-10-04 01:54:09', '2026-01-24 01:54:09'),
(379, 1, 'Botble\\RealEstate\\Models\\Property', 32, 1, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-10-12 01:54:09', '2026-01-24 01:54:09'),
(383, 4, 'Botble\\RealEstate\\Models\\Property', 50, 4, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-10-21 01:54:09', '2026-01-24 01:54:09'),
(385, 3, 'Botble\\RealEstate\\Models\\Property', 32, 3, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2026-01-24 01:54:09', '2026-01-24 01:54:09'),
(386, 9, 'Botble\\RealEstate\\Models\\Project', 16, 5, 'Project management was transparent throughout the development phase. Regular updates kept buyers informed.', 'approved', '2025-11-22 01:54:09', '2026-01-24 01:54:09'),
(387, 10, 'Botble\\RealEstate\\Models\\Property', 59, 4, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-09-29 01:54:09', '2026-01-24 01:54:09'),
(389, 11, 'Botble\\RealEstate\\Models\\Property', 42, 5, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2026-01-11 01:54:09', '2026-01-24 01:54:09'),
(391, 3, 'Botble\\RealEstate\\Models\\Property', 5, 4, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-12-11 01:54:09', '2026-01-24 01:54:09'),
(393, 7, 'Botble\\RealEstate\\Models\\Property', 26, 1, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2026-01-05 01:54:09', '2026-01-24 01:54:09'),
(395, 9, 'Botble\\RealEstate\\Models\\Property', 40, 2, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2026-01-05 01:54:09', '2026-01-24 01:54:09'),
(400, 10, 'Botble\\RealEstate\\Models\\Project', 10, 4, 'The project has excellent connectivity to major roads and public transportation.', 'approved', '2026-01-20 01:54:09', '2026-01-24 01:54:09'),
(401, 11, 'Botble\\RealEstate\\Models\\Property', 2, 1, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-10-06 01:54:09', '2026-01-24 01:54:09'),
(403, 11, 'Botble\\RealEstate\\Models\\Property', 47, 3, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-10-23 01:54:09', '2026-01-24 01:54:09'),
(405, 2, 'Botble\\RealEstate\\Models\\Property', 57, 2, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2026-01-20 01:54:09', '2026-01-24 01:54:09'),
(407, 10, 'Botble\\RealEstate\\Models\\Property', 29, 4, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-11-18 01:54:09', '2026-01-24 01:54:09'),
(409, 6, 'Botble\\RealEstate\\Models\\Property', 14, 3, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(413, 4, 'Botble\\RealEstate\\Models\\Property', 56, 4, 'Great natural lighting throughout the day. The south-facing windows make a huge difference.', 'approved', '2026-01-10 01:54:09', '2026-01-24 01:54:09'),
(415, 6, 'Botble\\RealEstate\\Models\\Property', 51, 3, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2026-01-06 01:54:09', '2026-01-24 01:54:09'),
(419, 1, 'Botble\\RealEstate\\Models\\Property', 24, 5, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2026-01-04 01:54:09', '2026-01-24 01:54:09'),
(423, 3, 'Botble\\RealEstate\\Models\\Property', 43, 4, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-10-23 01:54:09', '2026-01-24 01:54:09'),
(425, 4, 'Botble\\RealEstate\\Models\\Property', 29, 2, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-12-11 01:54:09', '2026-01-24 01:54:09'),
(427, 3, 'Botble\\RealEstate\\Models\\Property', 26, 2, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-11-19 01:54:09', '2026-01-24 01:54:09'),
(428, 4, 'Botble\\RealEstate\\Models\\Project', 16, 2, 'High-quality materials used in construction. You can see the attention to detail in every corner.', 'approved', '2025-10-30 01:54:09', '2026-01-24 01:54:09'),
(429, 10, 'Botble\\RealEstate\\Models\\Property', 48, 3, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-12-12 01:54:09', '2026-01-24 01:54:09'),
(430, 6, 'Botble\\RealEstate\\Models\\Project', 6, 3, 'The amenities included in this project are world-class. Swimming pool, gym, and community spaces are all beautifully designed.', 'approved', '2025-12-20 01:54:09', '2026-01-24 01:54:09'),
(432, 7, 'Botble\\RealEstate\\Models\\Project', 7, 2, 'Project management was transparent throughout the development phase. Regular updates kept buyers informed.', 'approved', '2026-01-09 01:54:09', '2026-01-24 01:54:09'),
(435, 8, 'Botble\\RealEstate\\Models\\Property', 22, 3, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-11-08 01:54:09', '2026-01-24 01:54:09'),
(436, 9, 'Botble\\RealEstate\\Models\\Project', 2, 1, 'The project timeline was met and the final result is stunning. Very professional team behind this development.', 'approved', '2025-12-27 01:54:09', '2026-01-24 01:54:09'),
(437, 11, 'Botble\\RealEstate\\Models\\Property', 21, 5, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(439, 10, 'Botble\\RealEstate\\Models\\Property', 24, 4, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(441, 6, 'Botble\\RealEstate\\Models\\Property', 60, 1, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-12-17 01:54:09', '2026-01-24 01:54:09'),
(443, 4, 'Botble\\RealEstate\\Models\\Property', 19, 5, 'Great natural lighting throughout the day. The south-facing windows make a huge difference.', 'approved', '2026-01-10 01:54:09', '2026-01-24 01:54:09'),
(445, 6, 'Botble\\RealEstate\\Models\\Property', 45, 3, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-12-14 01:54:09', '2026-01-24 01:54:09'),
(447, 2, 'Botble\\RealEstate\\Models\\Property', 39, 1, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-11-10 01:54:09', '2026-01-24 01:54:09'),
(448, 9, 'Botble\\RealEstate\\Models\\Project', 12, 5, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-12-22 01:54:09', '2026-01-24 01:54:09'),
(452, 8, 'Botble\\RealEstate\\Models\\Project', 17, 3, 'Security features throughout the project are state-of-the-art. Feel safe living here.', 'approved', '2025-10-08 01:54:09', '2026-01-24 01:54:09'),
(454, 9, 'Botble\\RealEstate\\Models\\Project', 3, 4, 'The project has enhanced property values in the entire area.', 'approved', '2025-12-16 01:54:09', '2026-01-24 01:54:09'),
(455, 1, 'Botble\\RealEstate\\Models\\Property', 38, 1, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-12-19 01:54:09', '2026-01-24 01:54:09'),
(456, 3, 'Botble\\RealEstate\\Models\\Project', 17, 2, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-10-19 01:54:09', '2026-01-24 01:54:09'),
(457, 5, 'Botble\\RealEstate\\Models\\Property', 43, 1, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2026-01-10 01:54:09', '2026-01-24 01:54:09'),
(460, 5, 'Botble\\RealEstate\\Models\\Project', 18, 5, 'Pet-friendly project with designated areas for dogs and cats.', 'approved', '2025-11-18 01:54:09', '2026-01-24 01:54:09'),
(461, 11, 'Botble\\RealEstate\\Models\\Property', 59, 2, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-10-28 01:54:09', '2026-01-24 01:54:09'),
(462, 6, 'Botble\\RealEstate\\Models\\Project', 16, 5, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-12-04 01:54:09', '2026-01-24 01:54:09'),
(464, 6, 'Botble\\RealEstate\\Models\\Project', 11, 3, 'The project has enhanced property values in the entire area.', 'approved', '2026-01-16 01:54:09', '2026-01-24 01:54:09'),
(465, 2, 'Botble\\RealEstate\\Models\\Property', 4, 5, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2026-01-13 01:54:09', '2026-01-24 01:54:09'),
(467, 3, 'Botble\\RealEstate\\Models\\Property', 53, 2, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2026-01-20 01:54:09', '2026-01-24 01:54:09'),
(469, 1, 'Botble\\RealEstate\\Models\\Property', 46, 3, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-11-04 01:54:09', '2026-01-24 01:54:09'),
(471, 11, 'Botble\\RealEstate\\Models\\Property', 9, 3, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-11-09 01:54:09', '2026-01-24 01:54:09'),
(473, 7, 'Botble\\RealEstate\\Models\\Property', 14, 1, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-10-26 01:54:09', '2026-01-24 01:54:09'),
(477, 10, 'Botble\\RealEstate\\Models\\Property', 38, 3, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2026-01-06 01:54:09', '2026-01-24 01:54:09'),
(479, 7, 'Botble\\RealEstate\\Models\\Property', 33, 5, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-11-26 01:54:09', '2026-01-24 01:54:09'),
(481, 12, 'Botble\\RealEstate\\Models\\Property', 7, 4, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2026-01-05 01:54:09', '2026-01-24 01:54:09'),
(482, 10, 'Botble\\RealEstate\\Models\\Project', 11, 5, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-11-08 01:54:09', '2026-01-24 01:54:09'),
(483, 3, 'Botble\\RealEstate\\Models\\Property', 54, 4, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-12-08 01:54:09', '2026-01-24 01:54:09'),
(484, 2, 'Botble\\RealEstate\\Models\\Project', 15, 2, 'Sound insulation between units is excellent. No noise complaints whatsoever.', 'approved', '2025-10-30 01:54:09', '2026-01-24 01:54:09'),
(487, 8, 'Botble\\RealEstate\\Models\\Property', 48, 4, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-10-27 01:54:09', '2026-01-24 01:54:09'),
(489, 3, 'Botble\\RealEstate\\Models\\Property', 51, 4, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(491, 3, 'Botble\\RealEstate\\Models\\Property', 14, 3, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-10-07 01:54:09', '2026-01-24 01:54:09'),
(494, 10, 'Botble\\RealEstate\\Models\\Project', 18, 1, 'The project has won multiple awards for its design and sustainability features.', 'approved', '2026-01-17 01:54:09', '2026-01-24 01:54:09'),
(495, 11, 'Botble\\RealEstate\\Models\\Property', 51, 1, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2025-10-01 01:54:09', '2026-01-24 01:54:09'),
(497, 10, 'Botble\\RealEstate\\Models\\Property', 47, 2, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-10-29 01:54:09', '2026-01-24 01:54:09'),
(503, 7, 'Botble\\RealEstate\\Models\\Property', 52, 5, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-12-10 01:54:09', '2026-01-24 01:54:09'),
(505, 6, 'Botble\\RealEstate\\Models\\Property', 40, 1, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2026-01-17 01:54:09', '2026-01-24 01:54:09'),
(507, 10, 'Botble\\RealEstate\\Models\\Property', 41, 1, 'Love the outdoor space - perfect for gardening and entertaining guests.', 'approved', '2025-11-04 01:54:09', '2026-01-24 01:54:09'),
(508, 10, 'Botble\\RealEstate\\Models\\Project', 8, 5, 'Energy-efficient design reduces monthly utility costs significantly.', 'approved', '2026-01-03 01:54:09', '2026-01-24 01:54:09'),
(509, 9, 'Botble\\RealEstate\\Models\\Property', 49, 1, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-10-25 01:54:09', '2026-01-24 01:54:09'),
(511, 8, 'Botble\\RealEstate\\Models\\Property', 15, 4, 'Love the outdoor space - perfect for gardening and entertaining guests.', 'approved', '2025-11-28 01:54:09', '2026-01-24 01:54:09'),
(514, 3, 'Botble\\RealEstate\\Models\\Project', 9, 5, 'Child-friendly design throughout the project with safe play areas and family amenities.', 'approved', '2025-11-27 01:54:09', '2026-01-24 01:54:09'),
(516, 12, 'Botble\\RealEstate\\Models\\Project', 8, 1, 'The landscaping around this project is beautiful. Green spaces make the community feel alive.', 'approved', '2026-01-14 01:54:09', '2026-01-24 01:54:09'),
(517, 5, 'Botble\\RealEstate\\Models\\Property', 35, 5, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-11-03 01:54:09', '2026-01-24 01:54:09'),
(523, 12, 'Botble\\RealEstate\\Models\\Property', 24, 1, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-12-03 01:54:09', '2026-01-24 01:54:09'),
(530, 1, 'Botble\\RealEstate\\Models\\Project', 9, 2, 'Sustainable building practices were used throughout this project. Appreciate the eco-friendly approach.', 'approved', '2025-11-19 01:54:09', '2026-01-24 01:54:09'),
(533, 1, 'Botble\\RealEstate\\Models\\Property', 45, 5, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-12-04 01:54:09', '2026-01-24 01:54:09'),
(536, 3, 'Botble\\RealEstate\\Models\\Project', 2, 1, 'The project has won multiple awards for its design and sustainability features.', 'approved', '2025-11-01 01:54:09', '2026-01-24 01:54:09'),
(539, 3, 'Botble\\RealEstate\\Models\\Property', 4, 1, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-11-26 01:54:09', '2026-01-24 01:54:09'),
(540, 12, 'Botble\\RealEstate\\Models\\Project', 17, 5, 'The project has excellent connectivity to major roads and public transportation.', 'approved', '2025-11-17 01:54:09', '2026-01-24 01:54:09'),
(542, 3, 'Botble\\RealEstate\\Models\\Project', 18, 1, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-11-11 01:54:09', '2026-01-24 01:54:09'),
(544, 3, 'Botble\\RealEstate\\Models\\Project', 1, 4, 'The project timeline was met and the final result is stunning. Very professional team behind this development.', 'approved', '2025-11-28 01:54:09', '2026-01-24 01:54:09'),
(546, 8, 'Botble\\RealEstate\\Models\\Project', 10, 4, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-10-27 01:54:09', '2026-01-24 01:54:09'),
(547, 4, 'Botble\\RealEstate\\Models\\Property', 52, 1, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2026-01-01 01:54:09', '2026-01-24 01:54:09'),
(553, 9, 'Botble\\RealEstate\\Models\\Property', 3, 4, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2025-10-11 01:54:09', '2026-01-24 01:54:09'),
(556, 5, 'Botble\\RealEstate\\Models\\Project', 3, 2, 'The fitness center in this project rivals professional gyms. Very well-equipped.', 'approved', '2025-12-27 01:54:09', '2026-01-24 01:54:09'),
(558, 8, 'Botble\\RealEstate\\Models\\Project', 12, 1, 'The amenities included in this project are world-class. Swimming pool, gym, and community spaces are all beautifully designed.', 'approved', '2025-11-29 01:54:09', '2026-01-24 01:54:09'),
(561, 3, 'Botble\\RealEstate\\Models\\Property', 58, 5, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-12-29 01:54:09', '2026-01-24 01:54:09'),
(565, 7, 'Botble\\RealEstate\\Models\\Property', 4, 4, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2026-01-13 01:54:09', '2026-01-24 01:54:09'),
(566, 4, 'Botble\\RealEstate\\Models\\Project', 6, 5, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-11-14 01:54:09', '2026-01-24 01:54:09'),
(569, 10, 'Botble\\RealEstate\\Models\\Property', 13, 5, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-11-26 01:54:09', '2026-01-24 01:54:09'),
(573, 12, 'Botble\\RealEstate\\Models\\Property', 17, 5, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-12-30 01:54:09', '2026-01-24 01:54:09'),
(579, 10, 'Botble\\RealEstate\\Models\\Property', 46, 3, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-10-21 01:54:09', '2026-01-24 01:54:09'),
(581, 5, 'Botble\\RealEstate\\Models\\Property', 29, 3, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2026-01-08 01:54:09', '2026-01-24 01:54:09'),
(583, 12, 'Botble\\RealEstate\\Models\\Property', 25, 1, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-12-25 01:54:09', '2026-01-24 01:54:09'),
(589, 11, 'Botble\\RealEstate\\Models\\Property', 57, 4, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2026-01-16 01:54:09', '2026-01-24 01:54:09'),
(590, 2, 'Botble\\RealEstate\\Models\\Project', 14, 3, 'Beautiful architectural design that stands out in the neighborhood.', 'approved', '2025-12-01 01:54:09', '2026-01-24 01:54:09'),
(591, 5, 'Botble\\RealEstate\\Models\\Property', 31, 5, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-10-31 01:54:09', '2026-01-24 01:54:09'),
(593, 8, 'Botble\\RealEstate\\Models\\Property', 52, 5, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-09-27 01:54:09', '2026-01-24 01:54:09'),
(595, 2, 'Botble\\RealEstate\\Models\\Property', 33, 3, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-25 01:54:09', '2026-01-24 01:54:09'),
(597, 4, 'Botble\\RealEstate\\Models\\Property', 1, 1, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-12-07 01:54:09', '2026-01-24 01:54:09'),
(601, 8, 'Botble\\RealEstate\\Models\\Property', 11, 5, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-10-26 01:54:09', '2026-01-24 01:54:09'),
(605, 6, 'Botble\\RealEstate\\Models\\Property', 44, 5, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-11-02 01:54:09', '2026-01-24 01:54:09'),
(613, 12, 'Botble\\RealEstate\\Models\\Property', 38, 4, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-12-26 01:54:09', '2026-01-24 01:54:09'),
(614, 8, 'Botble\\RealEstate\\Models\\Project', 13, 5, 'The project has enhanced property values in the entire area.', 'approved', '2025-12-02 01:54:09', '2026-01-24 01:54:09'),
(617, 4, 'Botble\\RealEstate\\Models\\Property', 12, 1, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-11-11 01:54:09', '2026-01-24 01:54:09'),
(623, 3, 'Botble\\RealEstate\\Models\\Property', 39, 1, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-12-11 01:54:10', '2026-01-24 01:54:09'),
(624, 2, 'Botble\\RealEstate\\Models\\Project', 12, 4, 'Sound insulation between units is excellent. No noise complaints whatsoever.', 'approved', '2025-11-26 01:54:10', '2026-01-24 01:54:09'),
(625, 3, 'Botble\\RealEstate\\Models\\Property', 1, 4, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-10-28 01:54:10', '2026-01-24 01:54:09'),
(629, 9, 'Botble\\RealEstate\\Models\\Property', 29, 2, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-12-16 01:54:10', '2026-01-24 01:54:09'),
(631, 12, 'Botble\\RealEstate\\Models\\Property', 15, 1, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-11-12 01:54:10', '2026-01-24 01:54:09'),
(633, 10, 'Botble\\RealEstate\\Models\\Property', 12, 3, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-09-30 01:54:10', '2026-01-24 01:54:09'),
(635, 11, 'Botble\\RealEstate\\Models\\Property', 8, 3, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-10-13 01:54:10', '2026-01-24 01:54:09'),
(636, 6, 'Botble\\RealEstate\\Models\\Project', 12, 4, 'The project has enhanced property values in the entire area.', 'approved', '2025-12-26 01:54:10', '2026-01-24 01:54:09'),
(640, 10, 'Botble\\RealEstate\\Models\\Project', 17, 4, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-12-23 01:54:10', '2026-01-24 01:54:09'),
(641, 2, 'Botble\\RealEstate\\Models\\Property', 24, 5, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-11-03 01:54:10', '2026-01-24 01:54:09'),
(642, 5, 'Botble\\RealEstate\\Models\\Project', 14, 3, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-11-06 01:54:10', '2026-01-24 01:54:09'),
(647, 11, 'Botble\\RealEstate\\Models\\Property', 22, 4, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-11-20 01:54:10', '2026-01-24 01:54:09'),
(648, 8, 'Botble\\RealEstate\\Models\\Project', 11, 1, 'Energy-efficient design reduces monthly utility costs significantly.', 'approved', '2025-10-09 01:54:10', '2026-01-24 01:54:09'),
(649, 8, 'Botble\\RealEstate\\Models\\Property', 6, 3, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2026-01-06 01:54:10', '2026-01-24 01:54:09'),
(653, 2, 'Botble\\RealEstate\\Models\\Property', 27, 3, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-11-16 01:54:10', '2026-01-24 01:54:09'),
(657, 5, 'Botble\\RealEstate\\Models\\Property', 12, 4, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-10-15 01:54:10', '2026-01-24 01:54:09'),
(662, 11, 'Botble\\RealEstate\\Models\\Project', 7, 4, 'High-quality materials used in construction. You can see the attention to detail in every corner.', 'approved', '2025-12-14 01:54:10', '2026-01-24 01:54:09'),
(663, 5, 'Botble\\RealEstate\\Models\\Property', 24, 2, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-09-26 01:54:10', '2026-01-24 01:54:09'),
(664, 3, 'Botble\\RealEstate\\Models\\Project', 5, 5, 'Developer reputation speaks for itself. This project maintains their high standards.', 'approved', '2026-01-06 01:54:10', '2026-01-24 01:54:09'),
(665, 6, 'Botble\\RealEstate\\Models\\Property', 61, 3, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-12-01 01:54:10', '2026-01-24 01:54:09'),
(667, 2, 'Botble\\RealEstate\\Models\\Property', 30, 1, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2026-01-20 01:54:10', '2026-01-24 01:54:09'),
(669, 8, 'Botble\\RealEstate\\Models\\Property', 27, 1, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2026-01-10 01:54:10', '2026-01-24 01:54:09'),
(671, 4, 'Botble\\RealEstate\\Models\\Property', 39, 4, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-27 01:54:10', '2026-01-24 01:54:09'),
(673, 6, 'Botble\\RealEstate\\Models\\Property', 22, 5, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-12-14 01:54:10', '2026-01-24 01:54:09'),
(677, 8, 'Botble\\RealEstate\\Models\\Property', 14, 4, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-12-14 01:54:10', '2026-01-24 01:54:09'),
(678, 5, 'Botble\\RealEstate\\Models\\Project', 15, 2, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-11-18 01:54:10', '2026-01-24 01:54:09'),
(679, 1, 'Botble\\RealEstate\\Models\\Property', 8, 2, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-12-07 01:54:10', '2026-01-24 01:54:09'),
(685, 4, 'Botble\\RealEstate\\Models\\Property', 25, 4, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2026-01-02 01:54:10', '2026-01-24 01:54:09'),
(686, 10, 'Botble\\RealEstate\\Models\\Project', 13, 5, 'The amenities included in this project are world-class. Swimming pool, gym, and community spaces are all beautifully designed.', 'approved', '2025-12-23 01:54:10', '2026-01-24 01:54:09'),
(687, 5, 'Botble\\RealEstate\\Models\\Property', 55, 4, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-10-26 01:54:10', '2026-01-24 01:54:09'),
(690, 8, 'Botble\\RealEstate\\Models\\Project', 1, 2, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2026-01-17 01:54:10', '2026-01-24 01:54:09'),
(691, 9, 'Botble\\RealEstate\\Models\\Property', 47, 3, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-12-04 01:54:10', '2026-01-24 01:54:09'),
(692, 1, 'Botble\\RealEstate\\Models\\Project', 4, 3, 'The common areas in this project are exceptionally well-designed. Perfect blend of functionality and beauty.', 'approved', '2025-11-18 01:54:10', '2026-01-24 01:54:09'),
(695, 12, 'Botble\\RealEstate\\Models\\Property', 5, 5, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-09 01:54:10', '2026-01-24 01:54:09'),
(696, 2, 'Botble\\RealEstate\\Models\\Project', 2, 1, 'The developer provided excellent after-sales service. Any snags were fixed promptly.', 'approved', '2025-11-14 01:54:10', '2026-01-24 01:54:09'),
(699, 12, 'Botble\\RealEstate\\Models\\Property', 4, 4, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-11-11 01:54:10', '2026-01-24 01:54:09'),
(701, 4, 'Botble\\RealEstate\\Models\\Property', 57, 3, 'Great natural lighting throughout the day. The south-facing windows make a huge difference.', 'approved', '2025-10-17 01:54:10', '2026-01-24 01:54:09'),
(704, 1, 'Botble\\RealEstate\\Models\\Project', 1, 4, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2025-12-31 01:54:10', '2026-01-24 01:54:09'),
(705, 12, 'Botble\\RealEstate\\Models\\Property', 49, 4, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-12-06 01:54:10', '2026-01-24 01:54:09'),
(709, 4, 'Botble\\RealEstate\\Models\\Property', 32, 4, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-10-23 01:54:10', '2026-01-24 01:54:09'),
(711, 4, 'Botble\\RealEstate\\Models\\Property', 59, 4, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-12-07 01:54:10', '2026-01-24 01:54:09'),
(715, 11, 'Botble\\RealEstate\\Models\\Property', 60, 4, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-10-05 01:54:10', '2026-01-24 01:54:09'),
(717, 6, 'Botble\\RealEstate\\Models\\Property', 58, 4, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-11-10 01:54:10', '2026-01-24 01:54:09'),
(721, 3, 'Botble\\RealEstate\\Models\\Property', 30, 2, 'Great natural lighting throughout the day. The south-facing windows make a huge difference.', 'approved', '2025-11-30 01:54:10', '2026-01-24 01:54:09'),
(723, 10, 'Botble\\RealEstate\\Models\\Property', 31, 5, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-12-18 01:54:10', '2026-01-24 01:54:09'),
(725, 7, 'Botble\\RealEstate\\Models\\Property', 8, 1, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-11-24 01:54:10', '2026-01-24 01:54:09'),
(727, 12, 'Botble\\RealEstate\\Models\\Property', 54, 2, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-11-17 01:54:10', '2026-01-24 01:54:09'),
(729, 3, 'Botble\\RealEstate\\Models\\Property', 49, 4, 'Love the outdoor space - perfect for gardening and entertaining guests.', 'approved', '2026-01-21 01:54:10', '2026-01-24 01:54:09'),
(731, 11, 'Botble\\RealEstate\\Models\\Property', 41, 5, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-17 01:54:10', '2026-01-24 01:54:09'),
(732, 9, 'Botble\\RealEstate\\Models\\Project', 11, 1, 'The project timeline was met and the final result is stunning. Very professional team behind this development.', 'approved', '2025-12-16 01:54:10', '2026-01-24 01:54:09'),
(733, 12, 'Botble\\RealEstate\\Models\\Property', 33, 4, 'Quiet neighbors and a peaceful atmosphere. Perfect for working from home.', 'approved', '2025-12-13 01:54:10', '2026-01-24 01:54:09'),
(739, 12, 'Botble\\RealEstate\\Models\\Property', 18, 1, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2026-01-11 01:54:10', '2026-01-24 01:54:09');
INSERT INTO `re_reviews` (`id`, `account_id`, `reviewable_type`, `reviewable_id`, `star`, `content`, `status`, `created_at`, `updated_at`) VALUES
(740, 12, 'Botble\\RealEstate\\Models\\Project', 16, 5, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-11-09 01:54:10', '2026-01-24 01:54:09'),
(741, 10, 'Botble\\RealEstate\\Models\\Property', 2, 1, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-12-31 01:54:10', '2026-01-24 01:54:09'),
(742, 11, 'Botble\\RealEstate\\Models\\Project', 17, 1, 'The developer provided excellent after-sales service. Any snags were fixed promptly.', 'approved', '2025-09-28 01:54:10', '2026-01-24 01:54:09'),
(746, 7, 'Botble\\RealEstate\\Models\\Project', 1, 5, 'The developer provided excellent after-sales service. Any snags were fixed promptly.', 'approved', '2025-11-05 01:54:10', '2026-01-24 01:54:09'),
(747, 10, 'Botble\\RealEstate\\Models\\Property', 49, 1, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-12-20 01:54:10', '2026-01-24 01:54:09'),
(749, 3, 'Botble\\RealEstate\\Models\\Property', 18, 4, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-12-09 01:54:10', '2026-01-24 01:54:09'),
(753, 1, 'Botble\\RealEstate\\Models\\Property', 34, 1, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2026-01-17 01:54:10', '2026-01-24 01:54:09'),
(757, 4, 'Botble\\RealEstate\\Models\\Property', 37, 2, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-11-07 01:54:10', '2026-01-24 01:54:09'),
(761, 6, 'Botble\\RealEstate\\Models\\Property', 35, 1, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2026-01-12 01:54:10', '2026-01-24 01:54:09'),
(764, 6, 'Botble\\RealEstate\\Models\\Project', 14, 2, 'Impressive project with top-notch facilities. The developers have clearly prioritized quality over quantity.', 'approved', '2025-10-07 01:54:10', '2026-01-24 01:54:09'),
(766, 3, 'Botble\\RealEstate\\Models\\Project', 11, 5, 'Community events organized by the management create a wonderful neighborhood atmosphere.', 'approved', '2025-10-09 01:54:10', '2026-01-24 01:54:09'),
(769, 7, 'Botble\\RealEstate\\Models\\Property', 10, 4, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-11-03 01:54:10', '2026-01-24 01:54:09'),
(770, 9, 'Botble\\RealEstate\\Models\\Project', 15, 5, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2025-10-31 01:54:10', '2026-01-24 01:54:09'),
(771, 1, 'Botble\\RealEstate\\Models\\Property', 33, 1, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-11-01 01:54:10', '2026-01-24 01:54:09'),
(773, 10, 'Botble\\RealEstate\\Models\\Property', 35, 5, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-12-08 01:54:10', '2026-01-24 01:54:09'),
(774, 1, 'Botble\\RealEstate\\Models\\Project', 2, 1, 'This development project has exceeded all expectations. The architects have done an amazing job balancing aesthetics with functionality.', 'approved', '2025-11-08 01:54:10', '2026-01-24 01:54:09'),
(775, 2, 'Botble\\RealEstate\\Models\\Property', 56, 4, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-11-30 01:54:10', '2026-01-24 01:54:09'),
(777, 5, 'Botble\\RealEstate\\Models\\Property', 27, 1, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-11-28 01:54:10', '2026-01-24 01:54:09'),
(779, 2, 'Botble\\RealEstate\\Models\\Property', 49, 1, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-12-01 01:54:10', '2026-01-24 01:54:09'),
(783, 8, 'Botble\\RealEstate\\Models\\Property', 42, 1, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2026-01-14 01:54:10', '2026-01-24 01:54:09'),
(786, 12, 'Botble\\RealEstate\\Models\\Project', 5, 3, 'Great investment opportunity. The project is in a rapidly developing area with strong growth potential.', 'approved', '2025-10-29 01:54:10', '2026-01-24 01:54:09'),
(793, 4, 'Botble\\RealEstate\\Models\\Property', 23, 5, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-12-13 01:54:10', '2026-01-24 01:54:09'),
(797, 11, 'Botble\\RealEstate\\Models\\Property', 28, 1, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2026-01-22 01:54:10', '2026-01-24 01:54:09'),
(799, 5, 'Botble\\RealEstate\\Models\\Property', 30, 2, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-11-15 01:54:10', '2026-01-24 01:54:09'),
(801, 7, 'Botble\\RealEstate\\Models\\Property', 59, 2, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-11-05 01:54:10', '2026-01-24 01:54:09'),
(803, 1, 'Botble\\RealEstate\\Models\\Property', 53, 4, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2026-01-15 01:54:10', '2026-01-24 01:54:09'),
(805, 10, 'Botble\\RealEstate\\Models\\Property', 36, 2, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-10-15 01:54:10', '2026-01-24 01:54:09'),
(807, 10, 'Botble\\RealEstate\\Models\\Property', 37, 4, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-12-11 01:54:10', '2026-01-24 01:54:09'),
(809, 5, 'Botble\\RealEstate\\Models\\Property', 22, 5, 'Love the outdoor space - perfect for gardening and entertaining guests.', 'approved', '2026-01-17 01:54:10', '2026-01-24 01:54:09'),
(811, 11, 'Botble\\RealEstate\\Models\\Property', 27, 5, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-11-14 01:54:10', '2026-01-24 01:54:09'),
(812, 8, 'Botble\\RealEstate\\Models\\Project', 15, 5, 'Child-friendly design throughout the project with safe play areas and family amenities.', 'approved', '2025-11-25 01:54:10', '2026-01-24 01:54:09'),
(817, 2, 'Botble\\RealEstate\\Models\\Property', 35, 3, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-10-16 01:54:10', '2026-01-24 01:54:09'),
(819, 8, 'Botble\\RealEstate\\Models\\Property', 29, 4, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-11-28 01:54:10', '2026-01-24 01:54:09'),
(820, 7, 'Botble\\RealEstate\\Models\\Project', 4, 2, 'Beautiful architectural design that stands out in the neighborhood.', 'approved', '2026-01-20 01:54:10', '2026-01-24 01:54:09'),
(821, 5, 'Botble\\RealEstate\\Models\\Property', 38, 4, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-10-10 01:54:10', '2026-01-24 01:54:09'),
(823, 6, 'Botble\\RealEstate\\Models\\Property', 12, 3, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2026-01-23 01:54:10', '2026-01-24 01:54:09'),
(826, 4, 'Botble\\RealEstate\\Models\\Project', 18, 3, 'The amenities included in this project are world-class. Swimming pool, gym, and community spaces are all beautifully designed.', 'approved', '2025-10-12 01:54:10', '2026-01-24 01:54:09'),
(828, 4, 'Botble\\RealEstate\\Models\\Project', 1, 3, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-12-24 01:54:10', '2026-01-24 01:54:09'),
(831, 5, 'Botble\\RealEstate\\Models\\Property', 1, 5, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2025-12-16 01:54:10', '2026-01-24 01:54:09'),
(835, 8, 'Botble\\RealEstate\\Models\\Property', 45, 2, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-11-18 01:54:10', '2026-01-24 01:54:09'),
(837, 3, 'Botble\\RealEstate\\Models\\Property', 23, 2, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-18 01:54:10', '2026-01-24 01:54:09'),
(841, 2, 'Botble\\RealEstate\\Models\\Property', 32, 3, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2026-01-03 01:54:10', '2026-01-24 01:54:09'),
(845, 10, 'Botble\\RealEstate\\Models\\Property', 52, 5, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-11-06 01:54:10', '2026-01-24 01:54:09'),
(851, 8, 'Botble\\RealEstate\\Models\\Property', 30, 4, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2026-01-12 01:54:10', '2026-01-24 01:54:09'),
(852, 4, 'Botble\\RealEstate\\Models\\Project', 8, 4, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2025-12-22 01:54:10', '2026-01-24 01:54:09'),
(853, 5, 'Botble\\RealEstate\\Models\\Property', 33, 3, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-11-12 01:54:10', '2026-01-24 01:54:09'),
(855, 7, 'Botble\\RealEstate\\Models\\Property', 34, 4, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2025-12-22 01:54:10', '2026-01-24 01:54:09'),
(857, 2, 'Botble\\RealEstate\\Models\\Property', 14, 4, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-09-26 01:54:10', '2026-01-24 01:54:09'),
(859, 11, 'Botble\\RealEstate\\Models\\Property', 26, 3, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-12-04 01:54:10', '2026-01-24 01:54:09'),
(860, 5, 'Botble\\RealEstate\\Models\\Project', 17, 2, 'Energy-efficient design reduces monthly utility costs significantly.', 'approved', '2026-01-24 01:54:10', '2026-01-24 01:54:09'),
(861, 9, 'Botble\\RealEstate\\Models\\Property', 60, 2, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-12-26 01:54:10', '2026-01-24 01:54:09'),
(863, 10, 'Botble\\RealEstate\\Models\\Property', 45, 1, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-11-05 01:54:10', '2026-01-24 01:54:09'),
(865, 9, 'Botble\\RealEstate\\Models\\Property', 19, 2, 'Family-friendly community with excellent schools nearby. Safe streets for children to play.', 'approved', '2026-01-24 01:54:10', '2026-01-24 01:54:09'),
(867, 11, 'Botble\\RealEstate\\Models\\Property', 32, 4, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-11-05 01:54:10', '2026-01-24 01:54:09'),
(869, 8, 'Botble\\RealEstate\\Models\\Property', 26, 2, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-09-28 01:54:10', '2026-01-24 01:54:09'),
(872, 11, 'Botble\\RealEstate\\Models\\Project', 9, 4, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2025-12-09 01:54:10', '2026-01-24 01:54:09'),
(873, 1, 'Botble\\RealEstate\\Models\\Property', 9, 3, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-10-18 01:54:10', '2026-01-24 01:54:09'),
(875, 8, 'Botble\\RealEstate\\Models\\Property', 13, 2, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-12-29 01:54:10', '2026-01-24 01:54:09'),
(876, 6, 'Botble\\RealEstate\\Models\\Project', 17, 2, 'The project has enhanced property values in the entire area.', 'approved', '2025-11-13 01:54:10', '2026-01-24 01:54:09'),
(877, 11, 'Botble\\RealEstate\\Models\\Property', 23, 2, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2026-01-02 01:54:10', '2026-01-24 01:54:09'),
(879, 3, 'Botble\\RealEstate\\Models\\Property', 10, 1, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-11-21 01:54:10', '2026-01-24 01:54:09'),
(882, 5, 'Botble\\RealEstate\\Models\\Project', 10, 3, 'The common areas in this project are exceptionally well-designed. Perfect blend of functionality and beauty.', 'approved', '2025-10-13 01:54:10', '2026-01-24 01:54:09'),
(883, 12, 'Botble\\RealEstate\\Models\\Property', 14, 5, 'The property is well-maintained and in a prime location. Close to schools, shopping centers, and public transportation. Perfect for families.', 'approved', '2025-11-25 01:54:10', '2026-01-24 01:54:09'),
(889, 9, 'Botble\\RealEstate\\Models\\Property', 33, 3, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-10-07 01:54:10', '2026-01-24 01:54:09'),
(890, 10, 'Botble\\RealEstate\\Models\\Project', 9, 1, 'The landscaping around this project is beautiful. Green spaces make the community feel alive.', 'approved', '2026-01-03 01:54:10', '2026-01-24 01:54:09'),
(892, 9, 'Botble\\RealEstate\\Models\\Project', 7, 5, 'Sustainable building practices were used throughout this project. Appreciate the eco-friendly approach.', 'approved', '2026-01-10 01:54:10', '2026-01-24 01:54:09'),
(893, 6, 'Botble\\RealEstate\\Models\\Property', 48, 5, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-12-08 01:54:10', '2026-01-24 01:54:09'),
(897, 6, 'Botble\\RealEstate\\Models\\Property', 32, 2, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2026-01-10 01:54:10', '2026-01-24 01:54:09'),
(899, 2, 'Botble\\RealEstate\\Models\\Property', 25, 4, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-10-19 01:54:10', '2026-01-24 01:54:09'),
(907, 9, 'Botble\\RealEstate\\Models\\Property', 43, 3, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2026-01-07 01:54:10', '2026-01-24 01:54:09'),
(908, 3, 'Botble\\RealEstate\\Models\\Project', 13, 3, 'High-quality materials used in construction. You can see the attention to detail in every corner.', 'approved', '2026-01-22 01:54:10', '2026-01-24 01:54:09'),
(913, 12, 'Botble\\RealEstate\\Models\\Property', 36, 1, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-11-25 01:54:10', '2026-01-24 01:54:09'),
(915, 3, 'Botble\\RealEstate\\Models\\Property', 2, 3, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2026-01-24 01:54:10', '2026-01-24 01:54:09'),
(916, 1, 'Botble\\RealEstate\\Models\\Project', 3, 3, 'The lobby and entrance areas make a great first impression on visitors.', 'approved', '2025-12-02 01:54:10', '2026-01-24 01:54:09'),
(918, 2, 'Botble\\RealEstate\\Models\\Project', 1, 3, 'Security features throughout the project are state-of-the-art. Feel safe living here.', 'approved', '2025-11-14 01:54:10', '2026-01-24 01:54:09'),
(921, 6, 'Botble\\RealEstate\\Models\\Property', 2, 1, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-12-26 01:54:10', '2026-01-24 01:54:09'),
(925, 2, 'Botble\\RealEstate\\Models\\Property', 20, 4, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-12-14 01:54:10', '2026-01-24 01:54:09'),
(927, 12, 'Botble\\RealEstate\\Models\\Property', 53, 2, 'Wonderful experience from viewing to move-in. The agent was professional and answered all my questions thoroughly.', 'approved', '2025-12-07 01:54:10', '2026-01-24 01:54:09'),
(929, 12, 'Botble\\RealEstate\\Models\\Property', 29, 2, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-12-11 01:54:10', '2026-01-24 01:54:09'),
(931, 7, 'Botble\\RealEstate\\Models\\Property', 1, 3, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-11-14 01:54:10', '2026-01-24 01:54:09'),
(936, 11, 'Botble\\RealEstate\\Models\\Project', 6, 1, 'Project management was transparent throughout the development phase. Regular updates kept buyers informed.', 'approved', '2025-09-28 01:54:10', '2026-01-24 01:54:09'),
(939, 4, 'Botble\\RealEstate\\Models\\Property', 45, 4, 'The property has great resale potential. Smart investment for the future.', 'approved', '2026-01-15 01:54:10', '2026-01-24 01:54:09'),
(941, 6, 'Botble\\RealEstate\\Models\\Property', 38, 1, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2025-12-14 01:54:10', '2026-01-24 01:54:09'),
(942, 7, 'Botble\\RealEstate\\Models\\Project', 2, 3, 'The project completion ahead of schedule shows excellent project management.', 'approved', '2025-09-26 01:54:10', '2026-01-24 01:54:09'),
(943, 11, 'Botble\\RealEstate\\Models\\Property', 34, 3, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2026-01-12 01:54:10', '2026-01-24 01:54:09'),
(945, 2, 'Botble\\RealEstate\\Models\\Property', 47, 1, 'Modern smart home features throughout. Energy-efficient appliances save on monthly bills.', 'approved', '2026-01-19 01:54:10', '2026-01-24 01:54:09'),
(949, 2, 'Botble\\RealEstate\\Models\\Property', 8, 3, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-23 01:54:10', '2026-01-24 01:54:09'),
(951, 5, 'Botble\\RealEstate\\Models\\Property', 5, 5, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-12-28 01:54:10', '2026-01-24 01:54:09'),
(955, 12, 'Botble\\RealEstate\\Models\\Property', 9, 4, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2025-10-17 01:54:10', '2026-01-24 01:54:09'),
(959, 9, 'Botble\\RealEstate\\Models\\Property', 4, 5, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2026-01-23 01:54:10', '2026-01-24 01:54:09'),
(960, 12, 'Botble\\RealEstate\\Models\\Project', 1, 5, 'The rooftop amenities are a standout feature of this project. Great views and relaxation spaces.', 'approved', '2026-01-23 01:54:10', '2026-01-24 01:54:09'),
(961, 8, 'Botble\\RealEstate\\Models\\Property', 40, 5, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-10-23 01:54:10', '2026-01-24 01:54:09'),
(963, 8, 'Botble\\RealEstate\\Models\\Property', 32, 3, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2026-01-03 01:54:10', '2026-01-24 01:54:09'),
(968, 3, 'Botble\\RealEstate\\Models\\Project', 10, 5, 'Smart home integration throughout the project. Modern living at its finest.', 'approved', '2025-11-07 01:54:10', '2026-01-24 01:54:09'),
(975, 9, 'Botble\\RealEstate\\Models\\Property', 36, 5, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-11-08 01:54:10', '2026-01-24 01:54:09'),
(977, 6, 'Botble\\RealEstate\\Models\\Property', 15, 2, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-21 01:54:10', '2026-01-24 01:54:09'),
(981, 6, 'Botble\\RealEstate\\Models\\Property', 29, 3, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-10-22 01:54:10', '2026-01-24 01:54:09'),
(987, 4, 'Botble\\RealEstate\\Models\\Property', 21, 3, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-10-29 01:54:10', '2026-01-24 01:54:09'),
(989, 7, 'Botble\\RealEstate\\Models\\Property', 6, 1, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-10-08 01:54:10', '2026-01-24 01:54:09'),
(993, 7, 'Botble\\RealEstate\\Models\\Property', 19, 4, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-10-19 01:54:10', '2026-01-24 01:54:09'),
(995, 1, 'Botble\\RealEstate\\Models\\Property', 5, 1, 'Perfect starter home for young couples. Affordable yet comfortable with all necessary amenities. Great community atmosphere.', 'approved', '2025-12-25 01:54:10', '2026-01-24 01:54:09'),
(1001, 5, 'Botble\\RealEstate\\Models\\Property', 48, 4, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2025-12-11 01:54:10', '2026-01-24 01:54:09'),
(1005, 5, 'Botble\\RealEstate\\Models\\Property', 2, 2, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2025-10-08 01:54:10', '2026-01-24 01:54:09'),
(1007, 12, 'Botble\\RealEstate\\Models\\Property', 30, 2, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-10-10 01:54:10', '2026-01-24 01:54:09'),
(1009, 9, 'Botble\\RealEstate\\Models\\Property', 57, 5, 'Prime location near downtown but surprisingly quiet. Best of both worlds - urban convenience with suburban peace.', 'approved', '2026-01-14 01:54:10', '2026-01-24 01:54:09'),
(1013, 7, 'Botble\\RealEstate\\Models\\Property', 42, 1, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-11-02 01:54:10', '2026-01-24 01:54:09'),
(1015, 10, 'Botble\\RealEstate\\Models\\Property', 27, 3, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-09-30 01:54:10', '2026-01-24 01:54:09'),
(1019, 10, 'Botble\\RealEstate\\Models\\Property', 25, 1, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-11-08 01:54:10', '2026-01-24 01:54:09'),
(1029, 3, 'Botble\\RealEstate\\Models\\Property', 8, 2, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-12-12 01:54:10', '2026-01-24 01:54:09'),
(1035, 1, 'Botble\\RealEstate\\Models\\Property', 52, 4, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-11-30 01:54:10', '2026-01-24 01:54:09'),
(1043, 6, 'Botble\\RealEstate\\Models\\Property', 8, 3, 'Outstanding property management. Any issues were addressed promptly. The security features give peace of mind.', 'approved', '2025-12-29 01:54:10', '2026-01-24 01:54:09'),
(1047, 6, 'Botble\\RealEstate\\Models\\Property', 59, 3, 'Great property with modern amenities. The kitchen is spacious and well-equipped. Only wish the parking area was a bit larger.', 'approved', '2026-01-19 01:54:10', '2026-01-24 01:54:09'),
(1048, 10, 'Botble\\RealEstate\\Models\\Project', 14, 4, 'The developer provided excellent after-sales service. Any snags were fixed promptly.', 'approved', '2026-01-09 01:54:10', '2026-01-24 01:54:09'),
(1049, 5, 'Botble\\RealEstate\\Models\\Property', 37, 4, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2026-01-18 01:54:10', '2026-01-24 01:54:09'),
(1053, 11, 'Botble\\RealEstate\\Models\\Property', 16, 1, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-12-15 01:54:10', '2026-01-24 01:54:09'),
(1061, 5, 'Botble\\RealEstate\\Models\\Property', 19, 1, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2026-01-14 01:54:10', '2026-01-24 01:54:09'),
(1063, 11, 'Botble\\RealEstate\\Models\\Property', 52, 4, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-11-10 01:54:10', '2026-01-24 01:54:09'),
(1071, 2, 'Botble\\RealEstate\\Models\\Property', 2, 4, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-13 01:54:10', '2026-01-24 01:54:09'),
(1073, 3, 'Botble\\RealEstate\\Models\\Property', 56, 5, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-10-28 01:54:10', '2026-01-24 01:54:09'),
(1077, 5, 'Botble\\RealEstate\\Models\\Property', 16, 2, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2025-10-21 01:54:10', '2026-01-24 01:54:09'),
(1079, 5, 'Botble\\RealEstate\\Models\\Property', 3, 1, 'Exceptional customer service from the real estate team. They made the entire process smooth and stress-free.', 'approved', '2026-01-17 01:54:10', '2026-01-24 01:54:09'),
(1081, 4, 'Botble\\RealEstate\\Models\\Property', 3, 5, 'Beautiful home with amazing natural light. The garden is well-maintained and perfect for weekend barbecues. Very happy with my decision.', 'approved', '2025-12-19 01:54:10', '2026-01-24 01:54:09'),
(1083, 1, 'Botble\\RealEstate\\Models\\Property', 4, 3, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-11-23 01:54:10', '2026-01-24 01:54:09'),
(1091, 4, 'Botble\\RealEstate\\Models\\Property', 46, 2, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-12-29 01:54:10', '2026-01-24 01:54:09'),
(1101, 8, 'Botble\\RealEstate\\Models\\Property', 51, 4, 'The neighborhood is vibrant with lots of cafes and restaurants nearby. Perfect for young professionals.', 'approved', '2025-11-02 01:54:10', '2026-01-24 01:54:09'),
(1103, 9, 'Botble\\RealEstate\\Models\\Property', 58, 3, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-11-05 01:54:10', '2026-01-24 01:54:09'),
(1115, 12, 'Botble\\RealEstate\\Models\\Property', 56, 3, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2026-01-05 01:54:10', '2026-01-24 01:54:09'),
(1119, 1, 'Botble\\RealEstate\\Models\\Property', 61, 5, 'Excellent value for money. The property exceeded my expectations in terms of quality and comfort. The landlord was very responsive and helpful throughout.', 'approved', '2025-11-10 01:54:10', '2026-01-24 01:54:09'),
(1123, 12, 'Botble\\RealEstate\\Models\\Property', 44, 4, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-12-25 01:54:10', '2026-01-24 01:54:09'),
(1125, 9, 'Botble\\RealEstate\\Models\\Property', 56, 5, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-11-25 01:54:10', '2026-01-24 01:54:09'),
(1126, 10, 'Botble\\RealEstate\\Models\\Project', 16, 4, 'Parking facilities are well-planned with ample space for residents and visitors.', 'approved', '2025-10-23 01:54:10', '2026-01-24 01:54:09'),
(1133, 5, 'Botble\\RealEstate\\Models\\Property', 28, 1, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2026-01-06 01:54:10', '2026-01-24 01:54:09'),
(1135, 9, 'Botble\\RealEstate\\Models\\Property', 48, 1, 'Generous closet space and built-in storage solutions. Perfect for those who value organization.', 'approved', '2025-10-25 01:54:10', '2026-01-24 01:54:09'),
(1143, 2, 'Botble\\RealEstate\\Models\\Property', 50, 1, 'The property photos were accurate and the space is even better in person. Move-in ready and professionally cleaned.', 'approved', '2025-10-26 01:54:10', '2026-01-24 01:54:09'),
(1145, 8, 'Botble\\RealEstate\\Models\\Property', 21, 2, 'The property has great resale potential. Smart investment for the future.', 'approved', '2026-01-18 01:54:10', '2026-01-24 01:54:09'),
(1147, 10, 'Botble\\RealEstate\\Models\\Property', 19, 1, 'Central location means everything is just minutes away. Very convenient for daily errands.', 'approved', '2025-12-27 01:54:10', '2026-01-24 01:54:09'),
(1157, 2, 'Botble\\RealEstate\\Models\\Property', 13, 1, 'The attention to detail in this property is impressive. Quality fixtures and finishes throughout.', 'approved', '2025-12-15 01:54:10', '2026-01-24 01:54:09'),
(1161, 7, 'Botble\\RealEstate\\Models\\Property', 48, 2, 'Love the outdoor space - perfect for gardening and entertaining guests.', 'approved', '2025-11-06 01:54:10', '2026-01-24 01:54:09'),
(1171, 10, 'Botble\\RealEstate\\Models\\Property', 30, 4, 'Great investment property. Already seeing good returns. Location ensures consistent demand from tenants.', 'approved', '2025-12-06 01:54:10', '2026-01-24 01:54:09'),
(1173, 2, 'Botble\\RealEstate\\Models\\Property', 29, 4, 'The property has great resale potential. Smart investment for the future.', 'approved', '2025-12-27 01:54:10', '2026-01-24 01:54:09'),
(1177, 6, 'Botble\\RealEstate\\Models\\Property', 10, 1, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-10-22 01:54:10', '2026-01-24 01:54:09'),
(1185, 7, 'Botble\\RealEstate\\Models\\Property', 51, 1, 'High-quality construction materials visible throughout. This property was built to last.', 'approved', '2025-10-22 01:54:10', '2026-01-24 01:54:09'),
(1189, 5, 'Botble\\RealEstate\\Models\\Property', 40, 1, 'The community amenities are fantastic - pool, gym, and clubhouse all well-maintained.', 'approved', '2025-11-16 01:54:10', '2026-01-24 01:54:09'),
(1191, 8, 'Botble\\RealEstate\\Models\\Property', 38, 2, 'Stunning views from the balcony. The interior design is modern and tasteful. Highly recommend for professionals seeking a quiet retreat.', 'approved', '2025-11-16 01:54:10', '2026-01-24 01:54:09'),
(1193, 7, 'Botble\\RealEstate\\Models\\Property', 29, 2, 'The layout is practical and space-efficient. Every square foot is well utilized.', 'approved', '2025-12-13 01:54:10', '2026-01-24 01:54:09'),
(1195, 3, 'Botble\\RealEstate\\Models\\Property', 41, 1, 'Well-insulated property keeps energy costs low. Comfortable in both summer and winter.', 'approved', '2026-01-17 01:54:10', '2026-01-24 01:54:09'),
(1199, 7, 'Botble\\RealEstate\\Models\\Property', 53, 3, 'The property has character and charm while still offering modern conveniences. Best of both worlds.', 'approved', '2026-01-16 01:54:10', '2026-01-24 01:54:09'),
(1205, 10, 'Botble\\RealEstate\\Models\\Property', 60, 5, 'Loved the open floor plan and high ceilings. Natural ventilation is excellent, reducing energy costs significantly.', 'approved', '2025-10-23 01:54:10', '2026-01-24 01:54:09'),
(1209, 9, 'Botble\\RealEstate\\Models\\Property', 18, 1, 'Spacious rooms and excellent storage space. The property has been recently renovated and everything looks brand new.', 'approved', '2025-10-30 01:54:10', '2026-01-24 01:54:09'),
(1211, 7, 'Botble\\RealEstate\\Models\\Property', 23, 4, 'Absolutely loved this property! The location is perfect for commuting to work, and the neighborhood is very safe and friendly. Would highly recommend to anyone looking for a great place to live.', 'approved', '2025-12-30 01:54:10', '2026-01-24 01:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(120) NOT NULL,
  `name` varchar(120) NOT NULL,
  `permissions` text DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `description`, `is_default`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', '{\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"core.system\":true,\"core.cms\":true,\"core.manage.license\":true,\"systems.cronjob\":true,\"core.tools\":true,\"tools.data-synchronize\":true,\"media.index\":true,\"files.index\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.destroy\":true,\"folders.index\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.destroy\":true,\"settings.index\":true,\"settings.common\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true,\"settings.admin-appearance\":true,\"settings.cache\":true,\"settings.datatables\":true,\"settings.email.rules\":true,\"settings.phone-number\":true,\"settings.others\":true,\"menus.index\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.destroy\":true,\"optimize.settings\":true,\"pages.index\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"plugins.marketplace\":true,\"sitemap.settings\":true,\"core.appearance\":true,\"theme.index\":true,\"theme.activate\":true,\"theme.remove\":true,\"theme.options\":true,\"theme.custom-css\":true,\"theme.custom-js\":true,\"theme.custom-html\":true,\"theme.robots-txt\":true,\"settings.website-tracking\":true,\"widgets.index\":true,\"ads.index\":true,\"ads.create\":true,\"ads.edit\":true,\"ads.destroy\":true,\"ads.settings\":true,\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"analytics.settings\":true,\"announcements.index\":true,\"announcements.create\":true,\"announcements.edit\":true,\"announcements.destroy\":true,\"announcements.settings\":true,\"audit-log.index\":true,\"audit-log.destroy\":true,\"backups.index\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.destroy\":true,\"plugins.blog\":true,\"posts.index\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.destroy\":true,\"categories.index\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.destroy\":true,\"tags.index\":true,\"blog.reports\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.destroy\":true,\"blog.settings\":true,\"posts.export\":true,\"posts.import\":true,\"captcha.settings\":true,\"careers.index\":true,\"careers.create\":true,\"careers.edit\":true,\"careers.destroy\":true,\"contacts.index\":true,\"contacts.edit\":true,\"contacts.destroy\":true,\"contact.custom-fields\":true,\"contact.settings\":true,\"plugin.faq\":true,\"faq.index\":true,\"faq.create\":true,\"faq.edit\":true,\"faq.destroy\":true,\"faq_category.index\":true,\"faq_category.create\":true,\"faq_category.edit\":true,\"faq_category.destroy\":true,\"faqs.settings\":true,\"languages.index\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.destroy\":true,\"translations.import\":true,\"translations.export\":true,\"property-translations.import\":true,\"property-translations.export\":true,\"plugin.location\":true,\"country.index\":true,\"country.create\":true,\"country.edit\":true,\"country.destroy\":true,\"state.index\":true,\"state.create\":true,\"state.edit\":true,\"state.destroy\":true,\"city.index\":true,\"city.create\":true,\"city.edit\":true,\"city.destroy\":true,\"newsletter.index\":true,\"newsletter.destroy\":true,\"newsletter.settings\":true,\"payment.index\":true,\"payments.settings\":true,\"payment.destroy\":true,\"payments.logs\":true,\"payments.logs.show\":true,\"payments.logs.destroy\":true,\"plugins.real-estate\":true,\"real-estate.settings\":true,\"property.index\":true,\"property.create\":true,\"property.edit\":true,\"property.destroy\":true,\"project.index\":true,\"project.create\":true,\"project.edit\":true,\"project.destroy\":true,\"property_feature.index\":true,\"property_feature.create\":true,\"property_feature.edit\":true,\"property_feature.destroy\":true,\"investor.index\":true,\"investor.create\":true,\"investor.edit\":true,\"investor.destroy\":true,\"review.index\":true,\"review.create\":true,\"review.edit\":true,\"review.destroy\":true,\"consult.index\":true,\"consult.edit\":true,\"consult.destroy\":true,\"property_category.index\":true,\"property_category.create\":true,\"property_category.edit\":true,\"property_category.destroy\":true,\"facility.index\":true,\"facility.create\":true,\"facility.edit\":true,\"facility.destroy\":true,\"account.index\":true,\"account.create\":true,\"account.edit\":true,\"account.destroy\":true,\"unverified-accounts.index\":true,\"package.index\":true,\"package.create\":true,\"package.edit\":true,\"package.destroy\":true,\"consults.index\":true,\"consults.edit\":true,\"consults.destroy\":true,\"real-estate.custom-fields.index\":true,\"real-estate.custom-fields.create\":true,\"real-estate.custom-fields.edit\":true,\"real-estate.custom-fields.destroy\":true,\"invoice.index\":true,\"invoice.edit\":true,\"invoice.destroy\":true,\"invoice.template\":true,\"import-properties.index\":true,\"coupons.index\":true,\"coupons.destroy\":true,\"real-estate.settings.general\":true,\"real-estate.settings.currencies\":true,\"real-estate.settings.accounts\":true,\"real-estate.settings.invoices\":true,\"real-estate.settings.invoice-template\":true,\"reports.index\":true,\"property.export\":true,\"property.import\":true,\"project.export\":true,\"project.import\":true,\"social-login.settings\":true,\"testimonial.index\":true,\"testimonial.create\":true,\"testimonial.edit\":true,\"testimonial.destroy\":true,\"plugins.translation\":true,\"translations.locales\":true,\"translations.theme-translations\":true,\"translations.index\":true,\"theme-translations.export\":true,\"other-translations.export\":true,\"theme-translations.import\":true,\"other-translations.import\":true,\"api.settings\":true,\"api.sanctum-token.index\":true,\"api.sanctum-token.create\":true,\"api.sanctum-token.destroy\":true}', 'Admin users role', 1, 1, 1, '2026-01-24 01:53:51', '2026-01-24 01:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'media_random_hash', '88cecd6751e3a362b13d80bc2b5db025', NULL, '2026-01-24 01:54:10'),
(2, 'api_enabled', '0', NULL, '2026-01-24 01:54:10'),
(3, 'activated_plugins', '[\"language\",\"language-advanced\",\"ads\",\"analytics\",\"announcement\",\"audit-log\",\"backup\",\"blog\",\"captcha\",\"career\",\"contact\",\"cookie-consent\",\"faq\",\"fob-mortgage-calculator\",\"location\",\"mollie\",\"newsletter\",\"payment\",\"paypal\",\"paystack\",\"razorpay\",\"real-estate\",\"rss-feed\",\"social-login\",\"sslcommerz\",\"stripe\",\"testimonial\",\"translation\"]', NULL, '2026-01-24 01:54:10'),
(4, 'analytics_dashboard_widgets', '0', '2026-01-24 01:53:43', '2026-01-24 01:53:43'),
(5, 'enable_recaptcha_botble_contact_forms_fronts_contact_form', '1', '2026-01-24 01:53:44', '2026-01-24 01:53:44'),
(6, 'enable_recaptcha_botble_newsletter_forms_fronts_newsletter_form', '1', '2026-01-24 01:53:45', '2026-01-24 01:53:45'),
(7, 'payment_cod_fee_type', 'fixed', NULL, '2026-01-24 01:54:10'),
(8, 'payment_bank_transfer_fee_type', 'fixed', NULL, '2026-01-24 01:54:10'),
(9, 'real_estate_mandatory_fields_at_consult_form', '[\"email\"]', NULL, '2026-01-24 01:54:10'),
(10, 'theme', 'homzen', NULL, '2026-01-24 01:54:10'),
(11, 'show_admin_bar', '1', NULL, '2026-01-24 01:54:10'),
(12, 'language_hide_default', '1', NULL, '2026-01-24 01:54:10'),
(13, 'language_switcher_display', 'dropdown', NULL, '2026-01-24 01:54:10'),
(14, 'language_display', 'all', NULL, '2026-01-24 01:54:10'),
(15, 'language_hide_languages', '[]', NULL, '2026-01-24 01:54:10'),
(16, 'permalink-botble-blog-models-post', 'news', NULL, '2026-01-24 01:54:10'),
(17, 'permalink-botble-blog-models-category', 'news', NULL, '2026-01-24 01:54:10'),
(18, 'payment_cod_status', '1', NULL, '2026-01-24 01:54:10'),
(19, 'payment_cod_description', 'Please pay money directly to the postman, if you choose cash on delivery method (COD).', NULL, '2026-01-24 01:54:10'),
(20, 'payment_bank_transfer_status', '1', NULL, '2026-01-24 01:54:10'),
(21, 'payment_bank_transfer_description', 'Please send money to our bank account: ACB - 69270 213 19.', NULL, '2026-01-24 01:54:10'),
(22, 'payment_stripe_payment_type', 'stripe_checkout', NULL, '2026-01-24 01:54:10'),
(23, 'real_estate_display_views_count_in_detail_page', '1', NULL, '2026-01-24 01:54:10'),
(24, 'theme-homzen-site_title', 'Homzen', NULL, '2026-01-24 01:54:10'),
(25, 'theme-homzen-seo_description', 'Find your favorite homes at Homzen', NULL, '2026-01-24 01:54:10'),
(26, 'theme-homzen-copyright', '©%Y Homzen is Proudly Powered by Botble Team.', NULL, '2026-01-24 01:54:10'),
(27, 'theme-homzen-favicon', 'general/favicon.png', NULL, '2026-01-24 01:54:10'),
(28, 'theme-homzen-logo', 'general/logo.png', NULL, '2026-01-24 01:54:10'),
(29, 'theme-homzen-logo_light', 'general/logo-light.png', NULL, '2026-01-24 01:54:10'),
(30, 'theme-homzen-preloader_enabled', 'yes', NULL, '2026-01-24 01:54:10'),
(31, 'theme-homzen-preloader_version', 'v2', NULL, '2026-01-24 01:54:10'),
(32, 'theme-homzen-social_links', '[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\"}],[{\"key\":\"name\",\"value\":\"X (Twitter)\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/x.com\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-linkedin\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.linkedin.com\"}]]', NULL, '2026-01-24 01:54:10'),
(33, 'theme-homzen-social_sharing', '[[{\"key\":\"social\",\"value\":\"facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"}],[{\"key\":\"social\",\"value\":\"x\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"}],[{\"key\":\"social\",\"value\":\"pinterest\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-pinterest\"}],[{\"key\":\"social\",\"value\":\"linkedin\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-linkedin\"}],[{\"key\":\"social\",\"value\":\"whatsapp\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-whatsapp\"}],[{\"key\":\"social\",\"value\":\"email\"},{\"key\":\"icon\",\"value\":\"ti ti-mail\"}]]', NULL, '2026-01-24 01:54:10'),
(34, 'theme-homzen-primary_color', '#db1d23', NULL, '2026-01-24 01:54:10'),
(35, 'theme-homzen-hover_color', '#cd380f', NULL, '2026-01-24 01:54:10'),
(36, 'theme-homzen-footer_background_color', '#161e2d', NULL, '2026-01-24 01:54:10'),
(37, 'theme-homzen-footer_background_image', 'general/banner-footer.png', NULL, '2026-01-24 01:54:10'),
(38, 'theme-homzen-use_modal_for_authentication', '1', NULL, '2026-01-24 01:54:10'),
(39, 'theme-homzen-homepage_id', '1', NULL, '2026-01-24 01:54:10'),
(40, 'theme-homzen-blog_page_id', '6', NULL, '2026-01-24 01:54:10'),
(41, 'theme-homzen-hotline', '0123 456 789', NULL, '2026-01-24 01:54:10'),
(42, 'theme-homzen-email', 'contact@botble.com', NULL, '2026-01-24 01:54:10'),
(43, 'theme-homzen-breadcrumb_background_color', '#f7f7f7', NULL, '2026-01-24 01:54:10'),
(44, 'theme-homzen-breadcrumb_text_color', '#161e2d', NULL, '2026-01-24 01:54:10'),
(45, 'theme-homzen-lazy_load_images', '1', NULL, '2026-01-24 01:54:10'),
(46, 'theme-homzen-lazy_load_placeholder_image', 'general/placeholder.png', NULL, '2026-01-24 01:54:10'),
(47, 'theme-homzen-newsletter_popup_enable', '1', NULL, '2026-01-24 01:54:10'),
(48, 'theme-homzen-newsletter_popup_image', 'general/newsletter-image.jpg', NULL, '2026-01-24 01:54:10'),
(49, 'theme-homzen-newsletter_popup_title', 'Let’s join our newsletter!', NULL, '2026-01-24 01:54:10'),
(50, 'theme-homzen-newsletter_popup_subtitle', 'Weekly Updates', NULL, '2026-01-24 01:54:10'),
(51, 'theme-homzen-newsletter_popup_description', 'Do not worry we don’t spam!', NULL, '2026-01-24 01:54:10'),
(52, 'theme-homzen-properties_list_page_id', '14', NULL, '2026-01-24 01:54:10'),
(53, 'theme-homzen-projects_list_page_id', '15', NULL, '2026-01-24 01:54:10'),
(54, 'announcement_max_width', '2481', NULL, NULL),
(55, 'announcement_text_color', '#161e2d', NULL, NULL),
(56, 'announcement_background_color', 'transparent', NULL, NULL),
(57, 'announcement_text_alignment', 'start', NULL, NULL),
(58, 'announcement_dismissible', '0', NULL, NULL),
(59, 'announcement_placement', 'theme', NULL, NULL),
(60, 'announcement_autoplay', '1', NULL, NULL),
(61, 'announcement_autoplay_delay', '5000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_banners`
--

CREATE TABLE `site_banners` (
  `id` int(11) NOT NULL,
  `banner_key` varchar(100) DEFAULT NULL,
  `web_image` text DEFAULT NULL,
  `mobile_image` text DEFAULT NULL,
  `link_url` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `sub_title` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL DEFAULT 1,
  `primary_color` varchar(50) DEFAULT '#1e3a8a',
  `secondary_color` varchar(50) DEFAULT '#d4af37',
  `accent_color` varchar(50) DEFAULT '#102a43',
  `logo_url` text DEFAULT NULL,
  `favicon_32` text DEFAULT NULL,
  `favicon_180` text DEFAULT NULL,
  `favicon_512` text DEFAULT NULL,
  `apple_icon` text DEFAULT NULL,
  `google_map_key` text DEFAULT NULL,
  `imagekit_url` text DEFAULT NULL,
  `imagekit_public` text DEFAULT NULL,
  `imagekit_private` text DEFAULT NULL,
  `font_family` varchar(100) DEFAULT 'Manrope',
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `primary_color`, `secondary_color`, `accent_color`, `logo_url`, `favicon_32`, `favicon_180`, `favicon_512`, `apple_icon`, `google_map_key`, `imagekit_url`, `imagekit_public`, `imagekit_private`, `font_family`, `meta_title`, `meta_description`, `meta_keywords`, `updated_at`) VALUES
(1, '#1e3a8a', '#d4af37', '#102a43', 'https://ik.imagekit.io/area24onestorage/favicons/realty%20512.png?updatedAt=1771487836640', 'https://ik.imagekit.io/area24onestorage/favicons/realty%2032.png?updatedAt=1771487836602', 'https://ik.imagekit.io/area24onestorage/favicons/realty%20180.png?updatedAt=1771487836600', 'https://ik.imagekit.io/area24onestorage/favicons/realty%20512.png?updatedAt=1771487836640', '', NULL, NULL, NULL, NULL, 'Manrope', NULL, NULL, NULL, '2026-02-26 11:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `slugs`
--

CREATE TABLE `slugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(191) NOT NULL,
  `prefix` varchar(120) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slugs`
--

INSERT INTO `slugs` (`id`, `key`, `reference_id`, `reference_type`, `prefix`, `created_at`, `updated_at`) VALUES
(1, 'apartment', 1, 'Botble\\RealEstate\\Models\\Category', 'property-category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(2, 'villa', 2, 'Botble\\RealEstate\\Models\\Category', 'property-category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(3, 'condo', 3, 'Botble\\RealEstate\\Models\\Category', 'property-category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(4, 'house', 4, 'Botble\\RealEstate\\Models\\Category', 'property-category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(5, 'land', 5, 'Botble\\RealEstate\\Models\\Category', 'property-category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(6, 'commercial-property', 6, 'Botble\\RealEstate\\Models\\Category', 'property-category', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(7, 'walnut-park-apartments', 1, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:58', '2026-01-24 01:53:58'),
(8, 'sunshine-wonder-villas', 2, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:58', '2026-01-24 01:53:58'),
(9, 'diamond-island', 3, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:58', '2026-01-24 01:53:58'),
(10, 'the-nassim', 4, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:58', '2026-01-24 01:53:58'),
(11, 'vinhomes-grand-park', 5, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:58', '2026-01-24 01:53:58'),
(12, 'the-metropole-thu-thiem', 6, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:58', '2026-01-24 01:53:58'),
(13, 'villa-on-grand-avenue', 7, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(14, 'traditional-food-restaurant', 8, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(15, 'villa-on-hollywood-boulevard', 9, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(16, 'office-space-at-northwest-107th', 10, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(17, 'home-in-merrick-way', 11, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(18, 'adarsh-greens', 12, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(19, 'rustomjee-evershine-global-city', 13, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(20, 'godrej-exquisite', 14, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(21, 'godrej-prime', 15, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(22, 'ps-panache', 16, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(23, 'upturn-atmiya-centria', 17, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(24, 'brigade-oasis', 18, 'Botble\\RealEstate\\Models\\Project', 'projects', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(25, '3-beds-villa-calpe-alicante', 1, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(26, 'lavida-plus-office-tel-1-bedroom', 2, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(27, 'vinhomes-grand-park-studio-1-bedroom', 3, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(28, 'the-sun-avenue-office-tel-1-bedroom', 4, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(29, 'property-for-sale-johannesburg-south-africa', 5, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(30, 'stunning-french-inspired-manor', 6, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(31, 'villa-for-sale-at-bermuda-dunes', 7, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(32, 'walnut-park-apartment', 8, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(33, '5-beds-luxury-house', 9, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(34, 'family-victorian-view-home', 10, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(35, 'osaka-heights-apartment', 11, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(36, 'private-estate-magnificent-views', 12, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(37, 'thompson-road-house-for-rent', 13, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(38, 'brand-new-1-bedroom-apartment-in-first-class-location', 14, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(39, 'elegant-family-home-presents-premium-modern-living', 15, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:53:59', '2026-01-24 01:53:59'),
(40, 'luxury-apartments-in-singapore-for-sale', 16, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(41, '5-room-luxury-penthouse-for-sale-in-kuala-lumpur', 17, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(42, '2-floor-house-in-compound-pejaten-barat-kemang', 18, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(43, 'apartment-muiderstraatweg-in-diemen', 19, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(44, 'nice-apartment-for-rent-in-berlin', 20, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(45, 'pumpkin-key-private-island', 21, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(46, 'maplewood-estates', 22, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(47, 'pine-ridge-manor', 23, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(48, 'oak-hill-residences', 24, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(49, 'sunnybrook-villas', 25, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(50, 'riverstone-condominiums', 26, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(51, 'cedar-park-apartments', 27, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(52, 'lakeside-retreat', 28, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(53, 'willow-creek-homes', 29, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(54, 'grandview-heights', 30, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(55, 'forest-glen-cottages', 31, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(56, 'harborview-towers', 32, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(57, 'meadowlands-estates', 33, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(58, 'highland-meadows', 34, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(59, 'brookfield-gardens', 35, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(60, 'silverwood-villas', 36, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(61, 'evergreen-terrace', 37, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(62, 'golden-gate-residences', 38, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(63, 'spring-blossom-park', 39, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(64, 'horizon-pointe', 40, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(65, 'whispering-pines-lodge', 41, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(66, 'sunset-ridge', 42, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(67, 'timberline-estates', 43, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(68, 'crystal-lake-condos', 44, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(69, 'briarwood-apartments', 45, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(70, 'summit-view', 46, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(71, 'elmwood-park', 47, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:00', '2026-01-24 01:54:00'),
(72, 'stonegate-homes', 48, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(73, 'rosewood-villas', 49, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(74, 'prairie-meadows', 50, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(75, 'hawthorne-heights', 51, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(76, 'sierra-vista', 52, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(77, 'autumn-leaves', 53, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(78, 'blue-sky-residences', 54, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(79, 'pebble-creek', 55, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(80, 'magnolia-manor', 56, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(81, 'cherry-blossom-estates', 57, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(82, 'windsor-park', 58, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(83, 'seaside-villas', 59, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(84, 'mountain-view-retreat', 60, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(85, 'amberwood-apartments', 61, 'Botble\\RealEstate\\Models\\Property', 'properties', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(86, 'buying-a-home', 1, 'Botble\\Blog\\Models\\Category', 'news', '2026-01-24 01:54:02', '2026-01-24 01:54:03'),
(87, 'selling-a-home', 2, 'Botble\\Blog\\Models\\Category', 'news', '2026-01-24 01:54:02', '2026-01-24 01:54:03'),
(88, 'market-trends', 3, 'Botble\\Blog\\Models\\Category', 'news', '2026-01-24 01:54:02', '2026-01-24 01:54:03'),
(89, 'home-improvement', 4, 'Botble\\Blog\\Models\\Category', 'news', '2026-01-24 01:54:02', '2026-01-24 01:54:03'),
(90, 'real-estate-investing', 5, 'Botble\\Blog\\Models\\Category', 'news', '2026-01-24 01:54:02', '2026-01-24 01:54:03'),
(91, 'neighborhood-guides', 6, 'Botble\\Blog\\Models\\Category', 'news', '2026-01-24 01:54:02', '2026-01-24 01:54:03'),
(92, 'tips', 1, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(93, 'investing', 2, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(94, 'market-analysis', 3, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(95, 'diy', 4, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(96, 'luxury-homes', 5, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(97, 'first-time-buyers', 6, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(98, 'property-management', 7, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(99, 'renovation', 8, 'Botble\\Blog\\Models\\Tag', 'tag', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(100, 'top-10-tips-for-first-time-home-buyers', 1, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(101, 'how-to-stage-your-home-for-a-quick-sale', 2, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(102, 'understanding-the-current-real-estate-market-trends', 3, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(103, 'diy-home-improvement-projects-that-add-value', 4, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(104, 'a-beginners-guide-to-real-estate-investing', 5, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(105, 'how-to-choose-the-right-neighborhood-for-your-family', 6, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(106, 'luxury-homes-what-to-look-for', 7, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(107, 'property-management-best-practices-for-landlords', 8, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(108, 'renovation-ideas-to-increase-your-homes-value', 9, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(109, 'the-ultimate-guide-to-buying-a-vacation-home', 10, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(110, 'how-to-successfully-sell-your-home-in-a-buyers-market', 11, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(111, 'home-inspection-what-to-expect-and-how-to-prepare', 12, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(112, 'eco-friendly-home-improvements-for-sustainable-living', 13, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(113, 'how-to-navigate-the-mortgage-process', 14, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(114, 'real-estate-market-analysis-what-you-need-to-know', 15, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(115, 'tips-for-renting-out-your-property', 16, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(116, 'understanding-property-taxes-and-how-to-lower-them', 17, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(117, 'the-benefits-of-smart-home-technology', 18, 'Botble\\Blog\\Models\\Post', 'news', '2026-01-24 01:54:03', '2026-01-24 01:54:03'),
(118, 'homepage-1', 1, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(119, 'homepage-2', 2, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(120, 'homepage-3', 3, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(121, 'homepage-4', 4, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(122, 'homepage-5', 5, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(123, 'blog', 6, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(124, 'contact-us', 7, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(125, 'our-services', 8, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(126, 'faqs', 9, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(127, 'about-us', 10, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(128, 'pricing-plans', 11, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(129, 'privacy-policy', 12, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(130, 'coming-soon', 13, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(131, 'properties', 14, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(132, 'projects', 15, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(133, 'cookie-policy', 16, 'Botble\\Page\\Models\\Page', '', '2026-01-24 01:54:08', '2026-01-24 01:54:08'),
(134, 'senior-full-stack-engineer-creator-success-full-time', 1, 'ArchiElite\\Career\\Models\\Career', 'careers', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(135, 'data-science-specialist-analytics-division', 2, 'ArchiElite\\Career\\Models\\Career', 'careers', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(136, 'product-marketing-manager-growth-team', 3, 'ArchiElite\\Career\\Models\\Career', 'careers', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(137, 'uxui-designer-user-experience-team', 4, 'ArchiElite\\Career\\Models\\Career', 'careers', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(138, 'operations-manager-supply-chain-division', 5, 'ArchiElite\\Career\\Models\\Career', 'careers', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(139, 'financial-analyst-investment-group', 6, 'ArchiElite\\Career\\Models\\Career', 'careers', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(140, 'john', 1, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(141, 'sarah', 2, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(142, 'michael', 3, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(143, 'emily', 4, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(144, 'david', 5, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(145, 'jennifer', 6, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(146, 'robert', 7, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(147, 'lisa', 8, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(148, 'james', 9, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(149, 'amanda', 10, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(150, 'william', 11, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10'),
(151, 'jessica', 12, 'Botble\\RealEstate\\Models\\Account', 'agents', '2026-01-24 01:54:10', '2026-01-24 01:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `slugs_translations`
--

CREATE TABLE `slugs_translations` (
  `lang_code` varchar(20) NOT NULL,
  `slugs_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) DEFAULT NULL,
  `prefix` varchar(120) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(191) NOT NULL,
  `provider_id` varchar(191) NOT NULL,
  `token` text DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `provider_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`provider_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `abbreviation` varchar(10) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `slug`, `abbreviation`, `country_id`, `order`, `image`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Karnataka', NULL, 'KNT', 12, 0, NULL, 0, 'published', '2026-02-17 06:57:31', NULL),
(12, 'Andhra Pradesh', NULL, 'AP', 12, 1, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(13, 'Arunachal Pradesh', NULL, 'AR', 12, 2, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(14, 'Assam', NULL, 'AS', 12, 3, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(15, 'Bihar', NULL, 'BR', 12, 4, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(16, 'Chhattisgarh', NULL, 'CT', 12, 5, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(17, 'Goa', NULL, 'GA', 12, 6, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(18, 'Gujarat', NULL, 'GJ', 12, 7, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(19, 'Haryana', NULL, 'HR', 12, 8, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(20, 'Himachal Pradesh', NULL, 'HP', 12, 9, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(21, 'Jharkhand', NULL, 'JH', 12, 10, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(22, 'Kerala', NULL, 'KL', 12, 12, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(23, 'Madhya Pradesh', NULL, 'MP', 12, 13, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(24, 'Maharashtra', NULL, 'MH', 12, 14, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(25, 'Manipur', NULL, 'MN', 12, 15, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(26, 'Meghalaya', NULL, 'ML', 12, 16, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(27, 'Mizoram', NULL, 'MZ', 12, 17, NULL, 0, 'published', '2026-02-17 09:58:45', NULL),
(28, 'Nagaland', NULL, 'NL', 12, 18, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(29, 'Odisha', NULL, 'OD', 12, 19, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(30, 'Punjab', NULL, 'PB', 12, 20, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(31, 'Rajasthan', NULL, 'RJ', 12, 21, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(32, 'Sikkim', NULL, 'SK', 12, 22, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(33, 'Tamil Nadu', NULL, 'TN', 12, 23, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(34, 'Telangana', NULL, 'TS', 12, 24, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(35, 'Tripura', NULL, 'TR', 12, 25, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(36, 'Uttar Pradesh', NULL, 'UP', 12, 26, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(37, 'Uttarakhand', NULL, 'UT', 12, 27, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(38, 'West Bengal', NULL, 'WB', 12, 28, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(39, 'Andaman and Nicobar Islands', NULL, 'AN', 12, 29, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(40, 'Chandigarh', NULL, 'CH', 12, 30, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(41, 'Dadra and Nagar Haveli and Daman and Diu', NULL, 'DN', 12, 31, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(42, 'Delhi', NULL, 'DL', 12, 32, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(43, 'Jammu and Kashmir', NULL, 'JK', 12, 33, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(44, 'Ladakh', NULL, 'LA', 12, 34, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(45, 'Lakshadweep', NULL, 'LD', 12, 35, NULL, 0, 'published', '2026-02-17 09:58:46', NULL),
(46, 'Puducherry', NULL, 'PY', 12, 36, NULL, 0, 'published', '2026-02-17 09:58:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states_translations`
--

CREATE TABLE `states_translations` (
  `lang_code` varchar(20) NOT NULL,
  `states_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `abbreviation` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_type` varchar(191) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `author_id`, `author_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tips', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(2, 'Investing', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(3, 'Market Analysis', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(4, 'DIY', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(5, 'Luxury Homes', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(6, 'First-time Buyers', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(7, 'Property Management', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02'),
(8, 'Renovation', 1, 'Botble\\ACL\\Models\\User', NULL, 'published', '2026-01-24 01:54:02', '2026-01-24 01:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `tags_translations`
--

CREATE TABLE `tags_translations` (
  `lang_code` varchar(20) NOT NULL,
  `tags_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `company` varchar(120) DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `content`, `image`, `company`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jennifer Lee', 'From the initial consultation to closing day, the real estate team went above and beyond to ensure I found the perfect home. Their dedication and professionalism made the entire process seamless. Thank you!', 'avatars/10.jpg', 'Happy Home Seeker', 'published', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(2, 'Robert Evans', 'I am impressed by the level of expertise and commitment demonstrated by this real estate team. Their insights into the market helped me make informed investment decisions, and I couldn\'t be happier with the results.', 'avatars/1.jpg', 'Property Investor', 'published', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(3, 'Jessica White', 'Selling my home with the help of this real estate team was a breeze. They provided valuable advice, staged my property beautifully, and negotiated a great deal. I highly recommend their services to anyone looking to sell their home!', 'avatars/9.jpg', 'Delighted Home Seller', 'published', '2026-01-24 01:54:01', '2026-01-24 01:54:01'),
(4, 'Daniel Miller', 'Thanks to the expertise and guidance of this real estate team, I am now the proud owner of my dream home. They listened to my preferences, answered all my questions, and made the entire home buying process a positive experience.', 'avatars/7.jpg', 'Happy New Homeowner', 'published', '2026-01-24 01:54:01', '2026-01-24 01:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials_translations`
--

CREATE TABLE `testimonials_translations` (
  `lang_code` varchar(20) NOT NULL,
  `testimonials_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `company` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `credits` int(10) UNSIGNED NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'add',
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(120) DEFAULT NULL,
  `last_name` varchar(120) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `avatar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT 0,
  `manage_supers` tinyint(1) NOT NULL DEFAULT 0,
  `permissions` text DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `sessions_invalidated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `first_name`, `last_name`, `username`, `avatar_id`, `super_user`, `manage_supers`, `permissions`, `last_login`, `sessions_invalidated_at`) VALUES
(1, 'admin@company.com', NULL, NULL, '$2y$12$4gxFVyp.o7JZxYNgpZVtgeT1cKpdmEM7wM.qKSV3u10q.K3Q4VS4y', '6zgSubnYhyHwikUDhZiKk2ZgOrSyJF34dlKM4fTlsZCJPpBJl3mTWpfgHbrP', '2026-01-24 01:53:51', '2026-02-16 00:39:49', 'System', 'Admin', 'admin', 12, 1, 1, NULL, '2026-02-16 00:39:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(120) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`value`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `widget_id` varchar(120) NOT NULL,
  `sidebar_id` varchar(120) NOT NULL,
  `theme` varchar(120) NOT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `widget_id`, `sidebar_id`, `theme`, `position`, `data`, `created_at`, `updated_at`) VALUES
(1, 'SiteLogoWidget', 'top_footer_sidebar', 'homzen', 1, '[]', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(2, 'SocialLinksWidget', 'top_footer_sidebar', 'homzen', 2, '{\"title\":\"Follow Us:\"}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(3, 'SiteInformationWidget', 'inner_footer_sidebar', 'homzen', 1, '{\"about\":\"Specializes in providing high-class tours for those in need. Contact Us\",\"items\":[[{\"key\":\"icon\",\"value\":\"ti ti-map-pin\"},{\"key\":\"text\",\"value\":\"101 E 129th St, East Chicago, IN 46312, US\"}],[{\"key\":\"icon\",\"value\":\"ti ti-phone-call\"},{\"key\":\"text\",\"value\":\"1-333-345-6868\"}],[{\"key\":\"icon\",\"value\":\"ti ti-mail\"},{\"key\":\"text\",\"value\":\"contact@botble.com\"}]]}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(4, 'Botble\\Widget\\Widgets\\CoreSimpleMenu', 'inner_footer_sidebar', 'homzen', 2, '{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\CoreSimpleMenu\",\"name\":\"Categories\",\"items\":[[{\"key\":\"label\",\"value\":\"Pricing Plans\"},{\"key\":\"url\",\"value\":\"\\/pricing-plans\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Our Services\"},{\"key\":\"url\",\"value\":\"\\/our-services\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"About Us\"},{\"key\":\"url\",\"value\":\"\\/about-us\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Contact Us\"},{\"key\":\"url\",\"value\":\"\\/contact-us\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}]]}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(5, 'Botble\\Widget\\Widgets\\CoreSimpleMenu', 'inner_footer_sidebar', 'homzen', 3, '{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\CoreSimpleMenu\",\"name\":\"Our Company\",\"items\":[[{\"key\":\"label\",\"value\":\"Property For Sale\"},{\"key\":\"url\",\"value\":\"\\/properties?type=sale\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Property For Rent\"},{\"key\":\"url\",\"value\":\"\\/properties?type=rent\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Privacy Policy\"},{\"key\":\"url\",\"value\":\"\\/privacy-policy\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Our Agents\"},{\"key\":\"url\",\"value\":\"\\/agents\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}]]}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(6, 'NewsletterWidget', 'inner_footer_sidebar', 'homzen', 4, '{\"title\":\"Newsletter\",\"subtitle\":\"Your Weekly\\/Monthly Dose of Knowledge and Inspiration\"}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(7, 'SiteCopyrightWidget', 'bottom_footer_sidebar', 'homzen', 1, '[]', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(8, 'Botble\\Widget\\Widgets\\CoreSimpleMenu', 'bottom_footer_sidebar', 'homzen', 2, '{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\CoreSimpleMenu\",\"items\":[[{\"key\":\"label\",\"value\":\"Terms Of Services\"},{\"key\":\"url\",\"value\":\"\\/our-services\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Privacy Policy\"},{\"key\":\"url\",\"value\":\"\\/privacy-policy\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Cookie Policy\"},{\"key\":\"url\",\"value\":\"\\/cookie-policy\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}]]}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(9, 'BlogSearchWidget', 'blog_sidebar', 'homzen', 1, '{\"name\":\"Search\"}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(10, 'BlogPostsWidget', 'blog_sidebar', 'homzen', 2, '{\"name\":\"Recent Posts\",\"limit\":3}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(11, 'BlogCategoriesWidget', 'blog_sidebar', 'homzen', 3, '{\"name\":\"By Categories\",\"number_display\":8}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(12, 'BlogTagsWidget', 'blog_sidebar', 'homzen', 4, '{\"name\":\"Popular Tag\",\"number_display\":9}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(13, 'RelatedPostsWidget', 'bottom_post_detail_sidebar', 'homzen', 1, '{\"title\":\"News insight\",\"subtitle\":\"Related Posts\",\"limit\":3}', '2026-01-24 01:53:50', '2026-01-24 01:53:50'),
(14, 'FriendsOfBotble\\MortgageCalculator\\Widgets\\MortgageCalculatorWidget', 'bottom_property_detail_sidebar', 'homzen', 1, '{\"id\":\"FriendsOfBotble\\\\MortgageCalculator\\\\Widgets\\\\MortgageCalculatorWidget\",\"name\":\"Mortgage Calculator\",\"style\":\"default\",\"layout\":\"horizontal\",\"form_style\":\"default\",\"form_margin\":\"40px 0 40px\",\"form_padding\":\"\",\"default_price\":\"\",\"default_term\":\"\",\"default_rate\":\"\",\"default_down_payment_type\":\"\",\"default_down_payment_value\":\"\",\"show_extra_costs\":\"0\"}', '2026-01-24 01:53:50', '2026-01-24 01:53:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activations_user_id_index` (`user_id`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ads_key_unique` (`key`);

--
-- Indexes for table `ads_translations`
--
ALTER TABLE `ads_translations`
  ADD PRIMARY KEY (`lang_code`,`ads_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements_translations`
--
ALTER TABLE `announcements_translations`
  ADD PRIMARY KEY (`lang_code`,`announcements_id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_histories`
--
ALTER TABLE `audit_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_histories_user_id_index` (`user_id`),
  ADD KEY `audit_histories_module_index` (`module`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers_translations`
--
ALTER TABLE `careers_translations`
  ADD PRIMARY KEY (`lang_code`,`careers_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_index` (`parent_id`),
  ADD KEY `categories_status_index` (`status`),
  ADD KEY `categories_created_at_index` (`created_at`);

--
-- Indexes for table `categories_translations`
--
ALTER TABLE `categories_translations`
  ADD PRIMARY KEY (`lang_code`,`categories_id`),
  ADD KEY `idx_categories_trans_categories_id` (`categories_id`),
  ADD KEY `idx_categories_trans_category_lang` (`categories_id`,`lang_code`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_slug_unique` (`slug`),
  ADD KEY `idx_cities_name` (`name`),
  ADD KEY `idx_cities_state_status` (`state_id`,`status`),
  ADD KEY `idx_cities_status` (`status`),
  ADD KEY `idx_cities_state_id` (`state_id`);

--
-- Indexes for table `cities_translations`
--
ALTER TABLE `cities_translations`
  ADD PRIMARY KEY (`lang_code`,`cities_id`),
  ADD KEY `idx_cities_trans_city_lang` (`cities_id`,`lang_code`),
  ADD KEY `idx_cities_trans_name` (`name`),
  ADD KEY `idx_cities_trans_cities_id` (`cities_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_custom_fields`
--
ALTER TABLE `contact_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_custom_fields_translations`
--
ALTER TABLE `contact_custom_fields_translations`
  ADD PRIMARY KEY (`lang_code`,`contact_custom_fields_id`),
  ADD KEY `idx_contact_cf_trans_cf_id` (`contact_custom_fields_id`),
  ADD KEY `idx_contact_cf_trans_cf_lang` (`contact_custom_fields_id`,`lang_code`);

--
-- Indexes for table `contact_custom_field_options`
--
ALTER TABLE `contact_custom_field_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_custom_field_options_translations`
--
ALTER TABLE `contact_custom_field_options_translations`
  ADD PRIMARY KEY (`lang_code`,`contact_custom_field_options_id`),
  ADD KEY `idx_contact_cfo_trans_cfo_id` (`contact_custom_field_options_id`),
  ADD KEY `idx_contact_cfo_trans_cfo_lang` (`contact_custom_field_options_id`,`lang_code`);

--
-- Indexes for table `contact_replies`
--
ALTER TABLE `contact_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_countries_name` (`name`),
  ADD KEY `idx_countries_status` (`status`);

--
-- Indexes for table `countries_translations`
--
ALTER TABLE `countries_translations`
  ADD PRIMARY KEY (`lang_code`,`countries_id`),
  ADD KEY `idx_countries_trans_country_lang` (`countries_id`,`lang_code`),
  ADD KEY `idx_countries_trans_name` (`name`),
  ADD KEY `idx_countries_trans_countries_id` (`countries_id`);

--
-- Indexes for table `dashboard_widgets`
--
ALTER TABLE `dashboard_widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard_widget_settings`
--
ALTER TABLE `dashboard_widget_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  ADD KEY `dashboard_widget_settings_widget_id_index` (`widget_id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_tokens_token_unique` (`token`),
  ADD KEY `device_tokens_user_type_user_id_index` (`user_type`,`user_id`),
  ADD KEY `device_tokens_platform_is_active_index` (`platform`,`is_active`),
  ADD KEY `device_tokens_is_active_index` (`is_active`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs_translations`
--
ALTER TABLE `faqs_translations`
  ADD PRIMARY KEY (`lang_code`,`faqs_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_categories_translations`
--
ALTER TABLE `faq_categories_translations`
  ADD PRIMARY KEY (`lang_code`,`faq_categories_id`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`lang_id`),
  ADD KEY `lang_locale_index` (`lang_locale`),
  ADD KEY `lang_code_index` (`lang_code`),
  ADD KEY `lang_is_default_index` (`lang_is_default`);

--
-- Indexes for table `language_meta`
--
ALTER TABLE `language_meta`
  ADD PRIMARY KEY (`lang_meta_id`),
  ADD KEY `language_meta_reference_id_index` (`reference_id`),
  ADD KEY `meta_code_index` (`lang_meta_code`),
  ADD KEY `meta_origin_index` (`lang_meta_origin`),
  ADD KEY `meta_reference_type_index` (`reference_type`);

--
-- Indexes for table `media_files`
--
ALTER TABLE `media_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_files_user_id_index` (`user_id`),
  ADD KEY `media_files_index` (`folder_id`,`user_id`,`created_at`);

--
-- Indexes for table `media_folders`
--
ALTER TABLE `media_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_folders_user_id_index` (`user_id`),
  ADD KEY `media_folders_index` (`parent_id`,`user_id`,`created_at`);

--
-- Indexes for table `media_settings`
--
ALTER TABLE `media_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`);

--
-- Indexes for table `menu_locations`
--
ALTER TABLE `menu_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_locations_menu_id_created_at_index` (`menu_id`,`created_at`);

--
-- Indexes for table `menu_nodes`
--
ALTER TABLE `menu_nodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_nodes_menu_id_index` (`menu_id`),
  ADD KEY `menu_nodes_parent_id_index` (`parent_id`),
  ADD KEY `reference_id` (`reference_id`),
  ADD KEY `reference_type` (`reference_type`);

--
-- Indexes for table `meta_boxes`
--
ALTER TABLE `meta_boxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_boxes_reference_id_index` (`reference_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_user_id_index` (`user_id`);

--
-- Indexes for table `pages_translations`
--
ALTER TABLE `pages_translations`
  ADD PRIMARY KEY (`lang_code`,`pages_id`);

--
-- Indexes for table `page_seo`
--
ALTER TABLE `page_seo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_path` (`page_path`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_status_index` (`status`),
  ADD KEY `posts_author_id_index` (`author_id`),
  ADD KEY `posts_author_type_index` (`author_type`),
  ADD KEY `posts_created_at_index` (`created_at`);

--
-- Indexes for table `posts_translations`
--
ALTER TABLE `posts_translations`
  ADD PRIMARY KEY (`lang_code`,`posts_id`),
  ADD KEY `idx_posts_trans_posts_id` (`posts_id`),
  ADD KEY `idx_posts_trans_post_lang` (`posts_id`,`lang_code`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD KEY `post_categories_category_id_index` (`category_id`),
  ADD KEY `post_categories_post_id_index` (`post_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD KEY `post_tags_tag_id_index` (`tag_id`),
  ADD KEY `post_tags_post_id_index` (`post_id`);

--
-- Indexes for table `push_notifications`
--
ALTER TABLE `push_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `push_notifications_type_created_at_index` (`type`,`created_at`),
  ADD KEY `push_notifications_status_scheduled_at_index` (`status`,`scheduled_at`),
  ADD KEY `push_notifications_created_by_index` (`created_by`);

--
-- Indexes for table `push_notification_recipients`
--
ALTER TABLE `push_notification_recipients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pnr_notification_user_index` (`push_notification_id`,`user_type`,`user_id`),
  ADD KEY `pnr_user_status_index` (`user_type`,`user_id`,`status`),
  ADD KEY `pnr_user_read_index` (`user_type`,`user_id`,`read_at`),
  ADD KEY `pnr_status_index` (`status`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`);

--
-- Indexes for table `re_accounts`
--
ALTER TABLE `re_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `re_accounts_email_unique` (`email`),
  ADD UNIQUE KEY `re_accounts_username_unique` (`username`);

--
-- Indexes for table `re_accounts_translations`
--
ALTER TABLE `re_accounts_translations`
  ADD PRIMARY KEY (`lang_code`,`re_accounts_id`),
  ADD KEY `idx_re_accounts_trans_fk` (`re_accounts_id`),
  ADD KEY `idx_re_accounts_trans_fk_lang` (`re_accounts_id`,`lang_code`);

--
-- Indexes for table `re_account_activity_logs`
--
ALTER TABLE `re_account_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `re_account_activity_logs_account_id_index` (`account_id`);

--
-- Indexes for table `re_account_packages`
--
ALTER TABLE `re_account_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_account_password_resets`
--
ALTER TABLE `re_account_password_resets`
  ADD KEY `re_account_password_resets_email_index` (`email`),
  ADD KEY `re_account_password_resets_token_index` (`token`);

--
-- Indexes for table `re_consults`
--
ALTER TABLE `re_consults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_consult_custom_fields`
--
ALTER TABLE `re_consult_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_consult_custom_fields_translations`
--
ALTER TABLE `re_consult_custom_fields_translations`
  ADD PRIMARY KEY (`lang_code`,`re_consult_custom_fields_id`),
  ADD KEY `idx_re_ccf_trans_fk` (`re_consult_custom_fields_id`),
  ADD KEY `idx_re_ccf_trans_fk_lang` (`re_consult_custom_fields_id`,`lang_code`);

--
-- Indexes for table `re_consult_custom_field_options`
--
ALTER TABLE `re_consult_custom_field_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_consult_custom_field_options_translations`
--
ALTER TABLE `re_consult_custom_field_options_translations`
  ADD PRIMARY KEY (`lang_code`,`re_consult_custom_field_options_id`),
  ADD KEY `idx_re_ccfo_trans_fk` (`re_consult_custom_field_options_id`),
  ADD KEY `idx_re_ccfo_trans_fk_lang` (`re_consult_custom_field_options_id`,`lang_code`);

--
-- Indexes for table `re_coupons`
--
ALTER TABLE `re_coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `re_coupons_code_unique` (`code`);

--
-- Indexes for table `re_currencies`
--
ALTER TABLE `re_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_custom_fields`
--
ALTER TABLE `re_custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `re_custom_fields_authorable_type_authorable_id_index` (`authorable_type`,`authorable_id`);

--
-- Indexes for table `re_custom_fields_translations`
--
ALTER TABLE `re_custom_fields_translations`
  ADD PRIMARY KEY (`lang_code`,`re_custom_fields_id`),
  ADD KEY `idx_re_cf_trans_fk` (`re_custom_fields_id`),
  ADD KEY `idx_re_cf_trans_fk_lang` (`re_custom_fields_id`,`lang_code`);

--
-- Indexes for table `re_custom_field_options`
--
ALTER TABLE `re_custom_field_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_custom_field_options_translations`
--
ALTER TABLE `re_custom_field_options_translations`
  ADD PRIMARY KEY (`lang_code`,`re_custom_field_options_id`),
  ADD KEY `idx_re_cfo_trans_fk` (`re_custom_field_options_id`),
  ADD KEY `idx_re_cfo_trans_fk_lang` (`re_custom_field_options_id`,`lang_code`);

--
-- Indexes for table `re_custom_field_values`
--
ALTER TABLE `re_custom_field_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `re_custom_field_values_reference_type_reference_id_index` (`reference_type`,`reference_id`);

--
-- Indexes for table `re_custom_field_values_translations`
--
ALTER TABLE `re_custom_field_values_translations`
  ADD PRIMARY KEY (`lang_code`,`re_custom_field_values_id`),
  ADD KEY `idx_re_cfv_trans_fk` (`re_custom_field_values_id`),
  ADD KEY `idx_re_cfv_trans_fk_lang` (`re_custom_field_values_id`,`lang_code`);

--
-- Indexes for table `re_facilities`
--
ALTER TABLE `re_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_facilities_distances`
--
ALTER TABLE `re_facilities_distances`
  ADD PRIMARY KEY (`facility_id`,`reference_id`,`reference_type`);

--
-- Indexes for table `re_facilities_translations`
--
ALTER TABLE `re_facilities_translations`
  ADD PRIMARY KEY (`lang_code`,`re_facilities_id`),
  ADD KEY `idx_re_facilities_trans_fk` (`re_facilities_id`),
  ADD KEY `idx_re_facilities_trans_fk_lang` (`re_facilities_id`,`lang_code`);

--
-- Indexes for table `re_investors`
--
ALTER TABLE `re_investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_investors_translations`
--
ALTER TABLE `re_investors_translations`
  ADD PRIMARY KEY (`lang_code`,`re_investors_id`),
  ADD KEY `idx_re_investors_trans_fk` (`re_investors_id`),
  ADD KEY `idx_re_investors_trans_fk_lang` (`re_investors_id`,`lang_code`);

--
-- Indexes for table `re_invoices`
--
ALTER TABLE `re_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `re_invoices_code_unique` (`code`),
  ADD KEY `re_invoices_reference_type_reference_id_index` (`reference_type`,`reference_id`),
  ADD KEY `re_invoices_payment_id_index` (`payment_id`),
  ADD KEY `re_invoices_status_index` (`status`);

--
-- Indexes for table `re_invoice_items`
--
ALTER TABLE `re_invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_packages`
--
ALTER TABLE `re_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_packages_translations`
--
ALTER TABLE `re_packages_translations`
  ADD PRIMARY KEY (`lang_code`,`re_packages_id`),
  ADD KEY `idx_re_packages_trans_fk` (`re_packages_id`),
  ADD KEY `idx_re_packages_trans_fk_lang` (`re_packages_id`,`lang_code`);

--
-- Indexes for table `re_projects`
--
ALTER TABLE `re_projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `re_projects_unique_id_unique` (`unique_id`),
  ADD KEY `idx_re_projects_status` (`status`),
  ADD KEY `idx_re_projects_location` (`location`),
  ADD KEY `idx_re_projects_city_status` (`city_id`,`status`),
  ADD KEY `idx_re_projects_state_status` (`state_id`,`status`),
  ADD KEY `idx_re_projects_featured_sort` (`is_featured`,`featured_priority`,`created_at`);

--
-- Indexes for table `re_projects_translations`
--
ALTER TABLE `re_projects_translations`
  ADD PRIMARY KEY (`lang_code`,`re_projects_id`),
  ADD KEY `idx_re_projects_trans_proj_lang` (`re_projects_id`,`lang_code`),
  ADD KEY `idx_re_projects_trans_location` (`location`);

--
-- Indexes for table `re_project_categories`
--
ALTER TABLE `re_project_categories`
  ADD PRIMARY KEY (`project_id`,`category_id`);

--
-- Indexes for table `re_properties`
--
ALTER TABLE `re_properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `re_properties_unique_id_unique` (`unique_id`),
  ADD KEY `idx_re_properties_status` (`status`),
  ADD KEY `idx_re_properties_location` (`location`),
  ADD KEY `idx_re_properties_city_status` (`city_id`,`status`),
  ADD KEY `idx_re_properties_state_status` (`state_id`,`status`),
  ADD KEY `idx_re_properties_featured_sort` (`is_featured`,`featured_priority`,`created_at`),
  ADD KEY `idx_re_properties_moderation_status` (`moderation_status`),
  ADD KEY `idx_re_properties_expire_date` (`expire_date`),
  ADD KEY `idx_re_properties_type` (`type`),
  ADD KEY `idx_re_properties_never_expired` (`never_expired`),
  ADD KEY `idx_re_properties_mod_status` (`moderation_status`,`status`),
  ADD KEY `idx_re_properties_price` (`price`),
  ADD KEY `idx_re_properties_square` (`square`),
  ADD KEY `idx_re_properties_bedroom` (`number_bedroom`),
  ADD KEY `idx_re_properties_bathroom` (`number_bathroom`),
  ADD KEY `idx_re_properties_floor` (`number_floor`),
  ADD KEY `idx_re_properties_project_id` (`project_id`),
  ADD KEY `idx_re_properties_author` (`author_id`,`author_type`),
  ADD KEY `idx_re_properties_country_id` (`country_id`),
  ADD KEY `idx_re_properties_currency_id` (`currency_id`),
  ADD KEY `idx_re_properties_active_featured_sort` (`moderation_status`,`status`,`expire_date`,`never_expired`,`is_featured`,`created_at`);

--
-- Indexes for table `re_properties_translations`
--
ALTER TABLE `re_properties_translations`
  ADD PRIMARY KEY (`lang_code`,`re_properties_id`),
  ADD KEY `idx_re_properties_trans_prop_lang` (`re_properties_id`,`lang_code`),
  ADD KEY `idx_re_properties_trans_location` (`location`);

--
-- Indexes for table `re_property_categories`
--
ALTER TABLE `re_property_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_property_categories_main`
--
ALTER TABLE `re_property_categories_main`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `re_property_features`
--
ALTER TABLE `re_property_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_property_projects`
--
ALTER TABLE `re_property_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_property_types`
--
ALTER TABLE `re_property_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `re_reviews`
--
ALTER TABLE `re_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_unique` (`account_id`,`reviewable_id`,`reviewable_type`),
  ADD KEY `re_reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`),
  ADD KEY `idx_reviews_reviewable_status` (`reviewable_type`,`reviewable_id`,`status`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`),
  ADD KEY `roles_created_by_index` (`created_by`),
  ADD KEY `roles_updated_by_index` (`updated_by`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_users_user_id_index` (`user_id`),
  ADD KEY `role_users_role_id_index` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `site_banners`
--
ALTER TABLE `site_banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banner_key` (`banner_key`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slugs`
--
ALTER TABLE `slugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slugs_reference_id_index` (`reference_id`),
  ADD KEY `slugs_key_index` (`key`),
  ADD KEY `slugs_prefix_index` (`prefix`),
  ADD KEY `slugs_reference_index` (`reference_id`,`reference_type`),
  ADD KEY `idx_key_prefix` (`key`,`prefix`),
  ADD KEY `idx_slugs_reference` (`reference_type`,`reference_id`);

--
-- Indexes for table `slugs_translations`
--
ALTER TABLE `slugs_translations`
  ADD PRIMARY KEY (`lang_code`,`slugs_id`),
  ADD KEY `idx_slugid_key_prefix` (`slugs_id`,`key`,`prefix`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_logins_provider_provider_id_unique` (`provider`,`provider_id`),
  ADD KEY `social_logins_user_type_user_id_index` (`user_type`,`user_id`),
  ADD KEY `social_logins_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `states_slug_unique` (`slug`),
  ADD KEY `idx_states_name` (`name`),
  ADD KEY `idx_states_status` (`status`),
  ADD KEY `idx_states_country_id` (`country_id`);

--
-- Indexes for table `states_translations`
--
ALTER TABLE `states_translations`
  ADD PRIMARY KEY (`lang_code`,`states_id`),
  ADD KEY `idx_states_trans_state_lang` (`states_id`,`lang_code`),
  ADD KEY `idx_states_trans_name` (`name`),
  ADD KEY `idx_states_trans_states_id` (`states_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_translations`
--
ALTER TABLE `tags_translations`
  ADD PRIMARY KEY (`lang_code`,`tags_id`),
  ADD KEY `idx_tags_trans_tags_id` (`tags_id`),
  ADD KEY `idx_tags_trans_tag_lang` (`tags_id`,`lang_code`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials_translations`
--
ALTER TABLE `testimonials_translations`
  ADD PRIMARY KEY (`lang_code`,`testimonials_id`),
  ADD KEY `idx_testimonials_trans_testimonials_id` (`testimonials_id`),
  ADD KEY `idx_testimonials_trans_testimonial_lang` (`testimonials_id`,`lang_code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_meta_user_id_index` (`user_id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_settings_user_type_user_id_key_unique` (`user_type`,`user_id`,`key`),
  ADD KEY `user_settings_user_type_user_id_index` (`user_type`,`user_id`),
  ADD KEY `user_settings_key_index` (`key`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `widgets_unique_index` (`theme`,`sidebar_id`,`widget_id`,`position`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_histories`
--
ALTER TABLE `audit_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_custom_fields`
--
ALTER TABLE `contact_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_custom_field_options`
--
ALTER TABLE `contact_custom_field_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_replies`
--
ALTER TABLE `contact_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dashboard_widgets`
--
ALTER TABLE `dashboard_widgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dashboard_widget_settings`
--
ALTER TABLE `dashboard_widget_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `lang_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `language_meta`
--
ALTER TABLE `language_meta`
  MODIFY `lang_meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media_files`
--
ALTER TABLE `media_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `media_folders`
--
ALTER TABLE `media_folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `media_settings`
--
ALTER TABLE `media_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_locations`
--
ALTER TABLE `menu_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_nodes`
--
ALTER TABLE `menu_nodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `meta_boxes`
--
ALTER TABLE `meta_boxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `page_seo`
--
ALTER TABLE `page_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `push_notifications`
--
ALTER TABLE `push_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `push_notification_recipients`
--
ALTER TABLE `push_notification_recipients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_accounts`
--
ALTER TABLE `re_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `re_account_activity_logs`
--
ALTER TABLE `re_account_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_account_packages`
--
ALTER TABLE `re_account_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_consults`
--
ALTER TABLE `re_consults`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_consult_custom_fields`
--
ALTER TABLE `re_consult_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `re_consult_custom_field_options`
--
ALTER TABLE `re_consult_custom_field_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_coupons`
--
ALTER TABLE `re_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_currencies`
--
ALTER TABLE `re_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `re_custom_fields`
--
ALTER TABLE `re_custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_custom_field_options`
--
ALTER TABLE `re_custom_field_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_custom_field_values`
--
ALTER TABLE `re_custom_field_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_facilities`
--
ALTER TABLE `re_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `re_investors`
--
ALTER TABLE `re_investors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `re_invoices`
--
ALTER TABLE `re_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_invoice_items`
--
ALTER TABLE `re_invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_packages`
--
ALTER TABLE `re_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `re_projects`
--
ALTER TABLE `re_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `re_properties`
--
ALTER TABLE `re_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `re_property_categories`
--
ALTER TABLE `re_property_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_property_categories_main`
--
ALTER TABLE `re_property_categories_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `re_property_features`
--
ALTER TABLE `re_property_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_property_projects`
--
ALTER TABLE `re_property_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `re_property_types`
--
ALTER TABLE `re_property_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `re_reviews`
--
ALTER TABLE `re_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1221;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `site_banners`
--
ALTER TABLE `site_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slugs`
--
ALTER TABLE `slugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
