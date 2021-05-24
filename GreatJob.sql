-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2019 г., 23:11
-- Версия сервера: 5.7.20-log
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `GreatJob`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ozdobluvalni-roboti', 'Оздоблювальні роботи', '2019-05-20 08:52:07', '2019-05-20 08:52:07'),
(3, 1, 'remont-kvartir', 'Ремонт квартир', '2019-05-20 08:52:58', '2019-05-20 08:52:59'),
(4, 1, 'ukladka-plitki', 'Укладка плитки', '2019-05-20 08:53:29', '2019-05-20 08:53:30'),
(5, 1, 'shtukaturni-roboti', 'Штукатурні роботи', '2019-05-20 08:54:06', '2019-05-20 08:54:06'),
(7, 1, 'malyarni-roboti', 'Малярні роботи', '2019-05-20 08:54:50', '2019-05-20 08:54:50'),
(8, 1, 'pidlogovi-roboti', 'Підлогові роботи', '2019-05-20 08:55:55', '2019-05-20 08:55:56'),
(10, 1, 'vstanovlennya-dverey', 'Встановлення дверей', '2019-05-20 08:57:02', '2019-05-20 08:57:02'),
(12, 1, 'demontazhni-roboti', 'Демонтажні роботи', '2019-05-20 08:58:01', '2019-05-20 08:58:01'),
(13, 1, 'steljovi-roboti', 'Стельові роботи', '2019-05-20 08:58:51', '2019-05-20 08:58:52'),
(15, 1, 'fasadni-roboti', 'Фасадні роботи', '2019-05-20 08:59:34', '2019-05-20 08:59:34'),
(16, NULL, 'budivnitstvo', 'Будівництво', '2019-05-20 09:00:23', '2019-05-20 09:00:24'),
(18, 16, 'riznorobochi', 'Різноробочі', '2019-05-20 09:00:57', '2019-05-20 09:00:57'),
(19, 16, 'svarochi-roboti', 'Сварочні роботи', '2019-05-20 09:01:18', '2019-05-20 09:01:18'),
(20, 16, 'tokarni-roboti', 'Токарні роботи', '2019-05-20 09:01:36', '2019-05-20 09:01:36'),
(21, 16, 'kladka-cegli', 'Кладка целги', '2019-05-20 09:02:13', '2019-05-20 09:02:13'),
(23, 16, 'pokrivelni-roboti', 'Покрівельні роботи', '2019-05-20 09:02:52', '2019-05-20 09:02:52'),
(24, 16, 'betonni-roboti', 'Бетонні роботи', '2019-05-20 09:03:10', '2019-05-20 09:03:10');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_13_145036_create_categories_table', 1),
(4, '2019_05_14_090716_create_tasks_table', 1),
(5, '2019_05_17_111035_create_performer_categories_table', 1),
(6, '2019_05_17_112258_create_performer_exmaples_table', 1),
(7, '2019_05_18_110921_create_user_reviews_table', 1),
(8, '2019_05_19_202551_create_task_offers_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `performer_categories`
--

CREATE TABLE `performer_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `performer_categories`
--

INSERT INTO `performer_categories` (`id`, `user_id`, `category_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 10000, '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(2, 5, 12, 3000, '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(3, 5, 18, 8000, '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(4, 5, 10, 4000, '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(5, 9, 10, 800, '2019-05-21 09:27:07', '2019-05-21 09:27:07'),
(6, 4, 3, 2500, '2019-05-30 07:34:53', '2019-05-30 07:34:53'),
(7, 4, 8, 5000, '2019-05-30 07:34:53', '2019-05-30 07:34:53'),
(8, 4, 13, 3000, '2019-05-30 07:34:53', '2019-05-30 07:34:53');

-- --------------------------------------------------------

--
-- Структура таблицы `performer_examples`
--

CREATE TABLE `performer_examples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `example_picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `performer_examples`
--

INSERT INTO `performer_examples` (`id`, `user_id`, `example_picture`, `created_at`, `updated_at`) VALUES
(1, 5, '931500d7b8b3477dc28e5dca8ecff92b.jpg', '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(2, 5, 'fccf245b7d90718184ea26e3cac7490d.jpg', '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(3, 5, '60fbcb000e46442148dfa2f96df45c99.jpg', '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(4, 5, '82bc1e1ca95405ed698b1fd8440ea6b7.jpg', '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(5, 5, 'c6746f9b43c3df6e3f3ae841e5fdb28c.jpg', '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(6, 5, 'b5e1e4902277f8b7f117057d70c172d5.jpg', '2019-05-20 09:25:42', '2019-05-20 09:25:42'),
(7, 4, '142657154ab130c532ff590338cf13f8.png', '2019-05-30 07:34:54', '2019-05-30 07:34:54'),
(8, 4, '5738fa599956d5ad7064a40a9772384c.png', '2019-05-30 07:34:55', '2019-05-30 07:34:55');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `performer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('OPEN','CLOS','DONE','PROG','DEL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `cost_contract` tinyint(4) NOT NULL DEFAULT '0',
  `needBeginDate` date NOT NULL,
  `needEndDate` date NOT NULL,
  `accepted_at` datetime DEFAULT NULL,
  `done_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `category_id`, `user_id`, `performer_id`, `status`, `title`, `description`, `contacts`, `cost`, `cost_contract`, `needBeginDate`, `needEndDate`, `accepted_at`, `done_at`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, 'OPEN', 'Шпаклювати', 'Пошпаклювати стіни та потолки', 'Валентин\r\nviber: 380955223001', 350, 1, '2019-05-20', '2019-05-24', NULL, NULL, '2019-05-20 09:07:03', '2019-05-20 09:07:03'),
(2, 3, 2, NULL, 'OPEN', 'Ремонт квартири', 'Площа приміщення, м ²: 33\r\n1. Зняти старі шпалери.\r\n2. Зашити стояк гіпсокартоном і вставити дверцята для лічильників.\r\n3. Поклеїти шпалери.\r\n4. Зробити навісну стелю в кімнаті 13,8 кв м. Загальна площа приміщення, в якому потрібно зробити ремонт - 33,1 кв. м.', 'Людмила, 380963214587', 20000, 1, '2019-05-20', '2019-06-08', NULL, NULL, '2019-05-20 09:11:43', '2019-05-20 09:11:43'),
(3, 10, 3, NULL, 'OPEN', 'Встановити 6ть міжкімнатних дверей', 'Необхідно встановити 6 ть міжкімнатних дверей, замки і петлі врізані. Потрібно зібрати коробки, підготувати отвори по висоті, висота отвору на 5-10 см більше ніж потрібно.', 'с. Личанка, Києво-Святошинський р-н. 15 хв на маршрутці від м. Житомирська', 3200, 1, '2019-05-20', '2019-05-25', NULL, NULL, '2019-05-20 09:13:56', '2019-05-20 09:13:56'),
(4, 3, 4, 5, 'DONE', 'Косметичний ремонт 3к квартири', 'Зняти шпалери зі стін у передпокої і 3-х кімнатах і стель по всій квартирі. Поклеїти шпалери в передпокої і в 3-х кімнатах, пофарбувати стелі по всій квартирі, постелити лінолеум в одній кімнаті, покрити лаком дерев\'яні підлоги в 2-х кімнатах, замінити плінтуса в передпокої і 3-х кімнатах (можливо до цього переліку додасться ще що -то, але потрібна консультація). Потрібні будуть послуги електрика (заміна та перенесення розеток, заміна вимикачів і т.д.). Для більш детального опису масштабів роботи і оцінки вартості, потрібна консультація майстра. РЕМОНТ ПОТРІБНО ЗРОБИТИ В найкоротші терміни!', 'маріуполь, торгова вул. 71', 5000, 0, '2019-05-20', '2019-05-24', '2019-05-20 12:26:50', '2019-05-20 12:26:57', '2019-05-20 09:17:36', '2019-05-20 09:26:57'),
(5, 21, 4, NULL, 'OPEN', 'Кладка цегли', 'Звичайний чорновий цегла М100, перегородки 120 mm в півцеглини, в квартирі, 2500 шт, об\'єкт в Солом\'янському районі, весь матеріал вже в квартирі, 200 грн м / кв', 'Барак Обама, президент США (колишній)', 15000, 1, '2019-05-20', '2019-05-25', NULL, NULL, '2019-05-20 09:21:20', '2019-05-20 09:21:20'),
(6, 3, 6, 5, 'DONE', 'зробити реионт', '3к квартира вдаддалдва', 'оаріваоро\r\n114521', 15000, 1, '2019-05-20', '2019-05-24', '2019-05-20 13:49:41', '2019-05-20 14:58:30', '2019-05-20 10:45:20', '2019-05-20 11:58:30'),
(7, 3, 7, 5, 'PROG', 'вкопати столбы', 'вкопати столбы для установки турника', 'туриникист', 1500, 1, '2019-05-20', '2019-05-20', '2019-05-20 21:07:54', NULL, '2019-05-20 17:56:56', '2019-05-20 18:07:54'),
(8, 3, 8, NULL, 'OPEN', 'поклеить обои в детской комнате', 'штукатурка стен, поклейка обоев , покраска потолка', 'Вася Пупкин 0503523234', 2000, 1, '2019-06-20', '2019-06-25', NULL, NULL, '2019-05-20 18:15:44', '2019-05-20 18:20:55'),
(9, 3, 10, NULL, 'OPEN', 'Звукоизоляция потолка и одной стены', 'необхідно зробити звукоізоляцію', 'немає шо робити', 5040, 1, '2019-05-22', '2019-05-31', NULL, NULL, '2019-05-22 07:40:29', '2019-05-22 07:40:29'),
(10, 3, 5, NULL, 'OPEN', 'Зробити ремонт 3-кімнатної квартири', 'Хочу зробити ремонт але не вмію, будь ласка допомжіть! плс халп', 'Пучков Євген Євген Євген', 25000, 1, '2019-06-01', '2019-06-09', NULL, NULL, '2019-05-30 07:15:37', '2019-05-30 07:15:37');

-- --------------------------------------------------------

--
-- Структура таблицы `task_offers`
--

CREATE TABLE `task_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `performer_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Привіт! Я хочу запропонувати Вам свої послуги. Зв''яжитесь зі мною...',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `task_offers`
--

INSERT INTO `task_offers` (`id`, `performer_id`, `task_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 5, 4, 'Привіт! Я хочу запропонувати Вам свої послуги. Зв\'яжитесь зі мною...', '2019-05-20 09:26:19', '2019-05-20 09:26:19'),
(2, 5, 6, 'Привіт! Я хочу запропонувати Вам свої послуги. Зв\'яжитесь зі мною...', '2019-05-20 10:49:02', '2019-05-20 10:49:02'),
(3, 5, 7, 'Я вкопаю (путін лох)', '2019-05-20 17:58:38', '2019-05-20 17:58:38'),
(4, 5, 8, 'Привіт! Я хочу запропонувати Вам свої послуги. Зв\'яжитесь зі мною...', '2019-05-20 18:17:23', '2019-05-20 18:17:23'),
(5, 5, 5, 'Привіт! Я хочу запропонувати Вам свої послуги. Зв\'яжитесь зі мною...', '2019-05-30 07:27:01', '2019-05-30 07:27:01'),
(6, 5, 2, 'Привіт! Я хочу запропонувати Вам свої послуги. Зв\'яжитесь зі мною...', '2019-06-17 15:55:54', '2019-06-17 15:55:54');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `isPerformer` tinyint(1) NOT NULL DEFAULT '0',
  `about` text COLLATE utf8mb4_unicode_ci,
  `rating` double NOT NULL DEFAULT '0',
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_userpic.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `city`, `verified`, `isPerformer`, `about`, `rating`, `picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Валентин Степанович', 'pucha@mail.com', NULL, '$2y$10$9hEzgUwTFj.lhLg2NLLT3ezWMOMCN/9PWvi1EucUnmgy9NbHhtx.C', '0973251587', 'Маріуполь', 0, 0, NULL, 0, '1_picture1558343332.jpg', NULL, '2019-05-20 09:04:34', '2019-05-20 09:08:52'),
(2, 'Валерій', 'pucha1@mail.com', NULL, '$2y$10$P0OoZ3nUliYIEsTp6rwKq.ntv5hSWKPuuvgX8zBpO5zArCnIx96Ce', '0962541254', 'Маріуполь', 0, 0, NULL, 0, 'default_userpic.png', NULL, '2019-05-20 09:09:26', '2019-05-20 09:09:26'),
(3, 'Людмила', 'pucha2@mail.ru', NULL, '$2y$10$45eaBXhy7JbqRcifQ1nuieGbFMqnBfHBEffQINjKuLU.eYRphxvGW', '0678541254', 'Маріуполь', 0, 0, NULL, 0, '3_picture1558343675.jpg', NULL, '2019-05-20 09:13:10', '2019-05-20 09:14:36'),
(4, 'Барак Обама', 'pucha3@mail.com', NULL, '$2y$10$WO8eOtjxg6PSImi4IK5V6.lJ.TpVH0dBwN2uGnOeCG/fYyfU4g8ae', '0655410011', 'Маріуполь', 0, 1, 'Я дуже гарно вмію робити багато чого! Бо у колишньому я був президентом (не сир!)', 0, '4_picture1558343874.jpg', NULL, '2019-05-20 09:16:27', '2019-05-30 07:34:55'),
(5, 'Євген Пучков', 'pucha1998@gmail.com', NULL, '$2y$10$afVwDAV2P9ORjQ2TxnZZEeqx47JNO8PGZQoBx8a8IJrEHsGLsj58e', '0956225324', 'Маріуполь', 0, 1, 'Професійний ремонт і обслуговування бойлерів (електроводонагрівачі)\r\n\r\n   Ремонт і чистка бойлерів і все, що з ними пов\'язано.\r\nЗапчастини високої якості, завжди в наявності, великий офіційний досвід робіт. З гарантією.\r\n\r\n   Cозвонімся або VIBER. Безкоштовна консультація по телефону.\r\nЄ можливість вирішення питань по електриці, сантехніці, кондиціонерів і фільтрів.\r\nВиконану мною роботу, а також відгуки можна побачити в моєму профілі. Дякую за правильний вибір :)', 93.33333333333333, '5_picture1558344364.png', 'pzTsGjc1RelKl2Yb2AbDX59stOjPdYhsnpWGk7ABL2dEB10y4OHpeoZx2JIQ', '2019-05-20 09:22:02', '2019-05-20 09:31:28'),
(6, 'Анжела', 'Luiza17061998@gmail.com', NULL, '$2y$10$iAkatfeFlHdfzEJK0jyMvOI6NGmIZ9ju80aHyb1IMqlpuG2reFWrS', '0506412578', 'Маріуполь', 0, 0, NULL, 100, 'default_userpic.png', NULL, '2019-05-20 10:43:31', '2019-05-20 11:59:04'),
(7, 'pappuc', 'ed.puchkov@gmail.com', NULL, '$2y$10$q/dt51IOCLchjbo2UEWazuwMvH/1J.aGbGtfUmBZSkTlE0pk9telm', '0506264942', 'мариуполь', 0, 0, NULL, 0, 'default_userpic.png', NULL, '2019-05-20 17:54:23', '2019-05-20 17:54:23'),
(8, 'Василий', 'vasya.1969@gmail.com', NULL, '$2y$10$KK.mXyqTgDO/Q6TxB8I3MOqt3Np2DCEI6yTcLzt/IpOvDKNuY6RAa', '0503523234', 'Мариуполь', 0, 0, NULL, 0, 'default_userpic.png', NULL, '2019-05-20 18:12:54', '2019-05-20 18:12:54'),
(9, 'test', 'qq@mail.ru', NULL, '$2y$10$96d8bbnDVqJoLIfQL.byfuwbYUO60qCG5ihWJBhOpCNn40iq0dCnK', '8924157151', 'Мисто-хуисто', 0, 1, 'цпрцрйурецйеецнйцнцкнцй', 0, 'default_userpic.png', NULL, '2019-05-21 09:25:08', '2019-05-21 09:27:07'),
(10, 'Альберт', 'albert@albert', NULL, '$2y$10$Ang7VHJWwAYTGEnJbFMiAuQgJRVcrCBirJQwsfu9mMyKK6NhuepIK', '0874565125', 'Гданськ', 0, 0, NULL, 0, 'default_userpic.png', NULL, '2019-05-22 07:39:46', '2019-05-22 07:39:46');

-- --------------------------------------------------------

--
-- Структура таблицы `user_reviews`
--

CREATE TABLE `user_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_user_id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_grade` int(11) DEFAULT NULL,
  `grade_speed` int(11) DEFAULT NULL,
  `grade_quality` int(11) DEFAULT NULL,
  `grade_cost` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_reviews`
--

INSERT INTO `user_reviews` (`id`, `to_user_id`, `from_user_id`, `task_id`, `message`, `user_grade`, `grade_speed`, `grade_quality`, `grade_cost`, `created_at`, `updated_at`) VALUES
(1, 5, 4, 4, 'Все зроблено на совість, але коштовність злегка велика... Дуже дякую, пане Євген!', NULL, 5, 5, 4, '2019-05-20 09:31:28', '2019-05-20 09:31:28'),
(2, 6, 5, 6, 'Гарна праця', 5, NULL, NULL, NULL, '2019-05-20 11:59:04', '2019-05-20 11:59:04');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `performer_categories`
--
ALTER TABLE `performer_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performer_categories_user_id_index` (`user_id`),
  ADD KEY `performer_categories_category_id_index` (`category_id`);

--
-- Индексы таблицы `performer_examples`
--
ALTER TABLE `performer_examples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `performer_examples_user_id_index` (`user_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_category_id_index` (`category_id`),
  ADD KEY `tasks_user_id_index` (`user_id`),
  ADD KEY `tasks_performer_id_index` (`performer_id`);

--
-- Индексы таблицы `task_offers`
--
ALTER TABLE `task_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_offers_performer_id_index` (`performer_id`),
  ADD KEY `task_offers_task_id_index` (`task_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Индексы таблицы `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_reviews_to_user_id_index` (`to_user_id`),
  ADD KEY `user_reviews_from_user_id_index` (`from_user_id`),
  ADD KEY `user_reviews_task_id_index` (`task_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `performer_categories`
--
ALTER TABLE `performer_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `performer_examples`
--
ALTER TABLE `performer_examples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `task_offers`
--
ALTER TABLE `task_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `performer_categories`
--
ALTER TABLE `performer_categories`
  ADD CONSTRAINT `performer_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `performer_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `performer_examples`
--
ALTER TABLE `performer_examples`
  ADD CONSTRAINT `performer_examples_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_performer_id_foreign` FOREIGN KEY (`performer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `task_offers`
--
ALTER TABLE `task_offers`
  ADD CONSTRAINT `task_offers_performer_id_foreign` FOREIGN KEY (`performer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_offers_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD CONSTRAINT `user_reviews_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_reviews_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `user_reviews_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
