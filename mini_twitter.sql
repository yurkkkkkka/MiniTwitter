-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 12 2025 г., 11:44
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mini_twitter`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tweets`
--

INSERT INTO `tweets` (`id`, `user_id`, `content`, `created_at`) VALUES
(1, 2, 'ваіва', '2025-04-10 11:30:42'),
(2, 2, 'авіафіва', '2025-04-10 11:33:14'),
(3, 2, 'вафіва', '2025-04-10 11:33:16'),
(4, 2, 'dsadas', '2025-04-10 11:55:51'),
(5, 2, 'dsadasdfasdf', '2025-04-10 12:01:39'),
(6, 2, 'апвапвапва', '2025-04-10 12:20:22'),
(7, 2, 'як справи?\r\n', '2025-04-12 07:56:56'),
(8, 2, 'вафівафівафі', '2025-04-12 07:59:02'),
(9, 9, 'отак я думаю', '2025-04-12 08:10:21'),
(10, 10, 'віаіваів', '2025-04-12 08:14:37'),
(11, 10, 'ацуддбацац', '2025-04-12 08:14:39'),
(12, 10, 'авфавіфаф', '2025-04-12 08:22:42'),
(13, 10, 'кіберпанк', '2025-04-12 08:22:45');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `avatar`) VALUES
(1, '515', '$2y$10$lyXzePaiYUTS9XEKqivdCOrhDM9yDzjg5I1nbUn8Jz5UapDeKUfsS', NULL),
(2, 'testuser', '$2y$10$9utCcJktrd28p4T1iUPBOeDC9NBOZGHlLEs73VduMLSi1EcXu5jCO', 'avatars/testuser.png'),
(3, 'sdfsadfa', '$2y$10$TlK/S0QsgztVLWC/wdbuOe/w7V3QjGN/B6b9e8xLrkkqTK3Z0DxOm', NULL),
(4, 'sdfsadfa', '$2y$10$7F5OkdKgFk5MuSv/mCGIYOBcVvhARP3.ndslyyj0qJete9LW8FYU2', NULL),
(5, 'testuser1', '$2y$10$oe7Dxwr8eQ/QrORJEhQhU.wjj6Okcyc0diuMHeNhbCaRsSrcAh1ti', 'avatars/testuser.png'),
(6, 'testuser1', '$2y$10$1z3PvOWXgRcBFRyYmDK0EOCEuuIEhspC9rsU57g0nH/4R423UOhjq', NULL),
(7, 'dadada', '$2y$10$eVAKVo6yKZ788la2.ftDguirj6776oTnt7mpI2.xhAIy8gu3wm3fW', NULL),
(8, 'testuser1', '$2y$10$09UDp20rhUjKadlUB5hmFOZupzjtTaPdsdOBN9nfsW1u8KvexM9zC', NULL),
(9, 'testuser3', '$2y$10$Ni3Czssy8ff8XpacvRKhWO5adRFepIUZec2LpuCr8F9I6uxop68wu', NULL),
(10, 'testuser4', '$2y$10$jZvL.s2/vfbc9FkAF8pK..HtvVG66E5Wcg0NxHKur2WYpDqvyfEIq', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
