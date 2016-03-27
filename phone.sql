-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 27 2016 г., 09:16
-- Версия сервера: 5.6.26
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `phone`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1458835451),
('m160324_155110_user_table_creation', 1458836520),
('m160324_164514_admin_user_creation', 1458838511),
('m160326_082432_phone_table', 1459015381),
('m160327_044011_creating_fultext_indexes', 1459054168);

-- --------------------------------------------------------

--
-- Структура таблицы `phone`
--

CREATE TABLE IF NOT EXISTS `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(12) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`),
  FULLTEXT KEY `fullname_fulltext_idx` (`surname`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `phone`
--

INSERT INTO `phone` (`id`, `number`, `surname`, `name`, `address`, `description`) VALUES
(1, '101', 'Petrov', 'Ivan Ivanovich', 'Fire station', ''),
(2, '102', 'Sidorov', 'Peter Semenovich', 'Police station', ''),
(3, '103', 'Preobrajenskiy', 'Lev Alekseevich', 'Paramedics', ''),
(4, '74957660166', 'Mtsov', 'Boris Petrovich', 'MTS Hotline', ''),
(5, '128423334455', 'Tester', 'User', 'Test place', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `auth_key`, `password_hash`) VALUES
(1, 'admin@example.com', 'Administrator', 'EXIiPdC-NEWdG253vG4Rz8ltIanE1Bxe', '$2y$13$jgkGhS6s4NfyZF0N0uq5ve44pfMZVn7x3jMEq/z6DptZqY9eduidC'),
(6, 'john@doe.com', 'John Doe', 'FcbBZxIORNCFWjl6Fyrl9TKnY7zwlISD', '$2y$13$aKJhVo0YSuiHIKpcF9ZRY.ZU.gnkG9RoCZSAHP4Zo9F1bFSpehoRa'),
(7, 'john4@doe.com', 'John IV', '0hz5j_1DjerGukaBDCBMS0EjCYXFKnQv', '$2y$13$fzWS4RmzDZ.zzMI5MFI1JOiNTs9Q4dBniUdtaM8z1Xltjbk6Lxbxm');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
