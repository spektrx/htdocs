-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 24 2025 г., 16:35
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `transactions`
--

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_time` datetime DEFAULT current_timestamp(),
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `operation_type` enum('transfer','deposit','withdraw') NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_time`, `sender_id`, `receiver_id`, `sender_name`, `receiver_name`, `operation_type`, `amount`) VALUES
(1, '2025-02-24 16:17:35', 2, 1, 'Николай', 'Виктор', 'transfer', 1),
(2, '2025-02-24 16:17:51', 2, 1, 'Николай', 'Виктор', 'transfer', 800),
(3, '2025-02-24 16:20:09', 2, 1, 'Николай', 'Виктор', 'transfer', 9),
(4, '2025-02-24 16:20:20', 2, 1, 'Николай', 'Виктор', 'transfer', 9),
(5, '2025-02-24 16:20:20', 2, 1, 'Николай', 'Виктор', 'transfer', 9),
(6, '2025-02-24 16:23:56', 1, 1, 'Виктор', 'Виктор', 'transfer', 1),
(7, '2025-02-24 16:24:10', 1, 1, 'Виктор', 'Виктор', 'transfer', 1),
(8, '2025-02-24 16:24:27', 1, 2, 'Виктор', 'Николай', 'transfer', 30),
(9, '2025-02-24 16:34:49', 1, 2, 'Виктор', 'Николай', 'transfer', 1000),
(10, '2025-02-24 18:24:19', 1, 2, 'Виктор', 'Николай', 'transfer', 3242);

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_in`
--

CREATE TABLE `transactions_in` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `transactions_in`
--

INSERT INTO `transactions_in` (`id`, `user_id`, `sum`) VALUES
(1, 1, 900),
(2, 5, 200),
(3, 4, 1000),
(4, 3, 9000),
(5, 2, 5000);

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_out`
--

CREATE TABLE `transactions_out` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `transactions_out`
--

INSERT INTO `transactions_out` (`id`, `user_id`, `sum`) VALUES
(1, 1, 100),
(2, 5, 600),
(3, 4, 2000),
(4, 3, 4000),
(5, 2, 22000);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `balance`) VALUES
(1, 'Виктор', 2758),
(2, 'Николай', 4444),
(3, 'Паша', 696969),
(4, 'Денчик', 288288),
(5, 'Юлия', 12000),
(6, 'Ольга', 20000);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transactions_in`
--
ALTER TABLE `transactions_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Индексы таблицы `transactions_out`
--
ALTER TABLE `transactions_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `transactions_in`
--
ALTER TABLE `transactions_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `transactions_out`
--
ALTER TABLE `transactions_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `transactions_in`
--
ALTER TABLE `transactions_in`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `transactions_out`
--
ALTER TABLE `transactions_out`
  ADD CONSTRAINT `transactions_out_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
