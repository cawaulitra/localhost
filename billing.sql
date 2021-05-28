-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2021 г., 20:18
-- Версия сервера: 10.4.12-MariaDB-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `billing`
--
CREATE DATABASE IF NOT EXISTS `billing` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `billing`;

-- --------------------------------------------------------

--
-- Структура таблицы `allowed_types`
--

CREATE TABLE `allowed_types` (
  `id` int(15) NOT NULL,
  `id_user` int(15) NOT NULL,
  `id_type` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `allowed_types`
--

INSERT INTO `allowed_types` (`id`, `id_user`, `id_type`) VALUES
(2, 3, 1),
(3, 3, 2),
(4, 3, 3),
(5, 4, 1),
(6, 4, 4),
(7, 4, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `files_messages`
--

CREATE TABLE `files_messages` (
  `id` int(15) NOT NULL,
  `id_message` int(15) NOT NULL,
  `name` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `files_tickets`
--

CREATE TABLE `files_tickets` (
  `id` int(15) NOT NULL,
  `id_ticket` int(15) NOT NULL,
  `name` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(15) NOT NULL,
  `id_ticket` int(15) NOT NULL,
  `id_user` int(15) NOT NULL,
  `text` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `id_ticket`, `id_user`, `text`) VALUES
(1, 1, 1, 'ab'),
(71, 1, 4, 'hjhj'),
(72, 1, 5, 'Прифки всем в этом чатеке'),
(73, 1, 4, 'hjhj'),
(74, 1, 4, 'прапрар'),
(75, 1, 4, 'уеапыуп'),
(76, 1, 4, 'уеапыуп'),
(77, 1, 4, 'уеапыуп'),
(78, 1, 5, ''),
(79, 14, 1, 'Тут кто-нибудь есть?');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(15) NOT NULL,
  `name` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Сотрудник'),
(3, 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(15) NOT NULL,
  `name` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Ожидание'),
(2, 'В процессе'),
(3, 'Выполнен');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` int(15) NOT NULL,
  `id_author` int(15) NOT NULL,
  `id_employee` int(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `id_type` int(15) NOT NULL,
  `text` mediumtext NOT NULL,
  `id_status` int(15) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `id_author`, `id_employee`, `title`, `id_type`, `text`, `id_status`, `create_date`, `start_date`, `end_date`) VALUES
(1, 1, 3, 'роорор', 1, 'ололо', 1, '2021-05-22 04:26:13', '2021-05-22 07:26:13', '2021-05-22 07:26:13'),
(2, 1, 3, 'однако', 1, 'я что-то всё таки умею', 1, '2021-05-22 04:26:36', '2021-05-22 07:26:36', '2021-05-22 07:26:36'),
(3, 1, 3, 'однако', 1, 'я что-то всё таки умею', 1, '2021-05-22 04:26:42', '2021-05-22 07:26:42', '2021-05-22 07:26:42'),
(4, 1, 3, 'лоророр', 1, 'ололол', 1, '2021-05-22 04:27:51', NULL, NULL),
(5, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:28:24', NULL, NULL),
(6, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:29:23', NULL, NULL),
(7, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:29:25', NULL, NULL),
(8, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:29:26', NULL, NULL),
(9, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:29:27', NULL, NULL),
(10, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:29:43', NULL, NULL),
(11, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:30:00', NULL, NULL),
(12, 1, 3, 'Помогите пожалуйста', 1, 'У меня страничка уехала вниз! Я не знаю что делать! Ещё сверху странные Warning появляются!\r\n\r\nЖду помощи!', 1, '2021-05-22 04:31:31', NULL, NULL),
(13, 1, 3, 'hjhjh', 1, 'jkjkjk', 1, '2021-05-24 05:25:30', NULL, NULL),
(14, 1, 4, 'ГДЗ', 5, 'Решите мне номер пожалуйста!', 1, '2021-05-28 16:17:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_type`
--

CREATE TABLE `ticket_type` (
  `id` int(15) NOT NULL,
  `name` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ticket_type`
--

INSERT INTO `ticket_type` (`id`, `name`) VALUES
(1, 'Биология'),
(2, 'Астрономия'),
(3, 'Кулинария'),
(4, 'Естествознание'),
(5, 'Русский язык');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `login` varchar(63) NOT NULL,
  `name` varchar(63) NOT NULL,
  `password` varchar(63) NOT NULL,
  `id_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `password`, `id_role`) VALUES
(1, 'cawaulitra', 'fio', '1cdbf9a1f7d756cf9420c6e8e1e4fb98', 3),
(3, 'cawaulitra_emp1', 'fio', '1cdbf9a1f7d756cf9420c6e8e1e4fb98', 2),
(4, 'cawaulitra_emp2', 'fio', 'd41d8cd98f00b204e9800998ecf8427e', 2),
(5, 'admin', 'fio', '150f15e73422e0a5ba5b59f997fc2350', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `allowed_types`
--
ALTER TABLE `allowed_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files_messages`
--
ALTER TABLE `files_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files_tickets`
--
ALTER TABLE `files_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `LOGIN` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `allowed_types`
--
ALTER TABLE `allowed_types`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `files_messages`
--
ALTER TABLE `files_messages`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `files_tickets`
--
ALTER TABLE `files_tickets`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
