-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 08 2024 г., 13:23
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `final-project-db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `userId`) VALUES
(1, 4),
(5, 8),
(8, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `basketToProductsCoffee`
--

CREATE TABLE `basketToProductsCoffee` (
  `id` int NOT NULL,
  `basketId` int NOT NULL,
  `productsCoffeeId` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `basketToProductsCoffee`
--

INSERT INTO `basketToProductsCoffee` (`id`, `basketId`, `productsCoffeeId`, `count`) VALUES
(19, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `userName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payOffline` tinyint(1) NOT NULL,
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `userId`, `userName`, `adress`, `phone`, `payOffline`, `completed`) VALUES
(16, 4, 'Таня', 'Владивосток', '55555557', 0, 1),
(17, 8, 'Анна', 'Санк-Петербург', '78748996', 0, 1),
(18, 11, 'Иван', 'Владивосток', '88005552233', 0, 1),
(19, 4, 'Татьяна', 'Владивосток', '+79020790177', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ordersToProductsCoffee`
--

CREATE TABLE `ordersToProductsCoffee` (
  `id` int NOT NULL,
  `orderId` int NOT NULL,
  `productsCoffeeId` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ordersToProductsCoffee`
--

INSERT INTO `ordersToProductsCoffee` (`id`, `orderId`, `productsCoffeeId`, `count`) VALUES
(24, 16, 1, 2),
(25, 16, 2, 1),
(26, 17, 2, 2),
(27, 18, 6, 10),
(28, 18, 5, 1),
(29, 19, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `productsCoffee`
--

CREATE TABLE `productsCoffee` (
  `id` int NOT NULL,
  `header` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `composition` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `imgSrc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `productsCoffee`
--

INSERT INTO `productsCoffee` (`id`, `header`, `description`, `composition`, `weight`, `price`, `imgSrc`) VALUES
(1, 'Lavazza Crema E Gusto Espresso Classico, 1 кг', 'Крепкий, насыщенный вкус, густая пенка. Пряные ноты.', 'арабика, робуста', '1', 1600, 'img-project-coffee/coffee-cardProduct-img/LavazzaEGusto.png'),
(2, 'Lavazza ORO, 1 кг', 'Смесь лучших сортов арабики. Сладковатый вкус с приятной кислинкой.', '100% арабика', '1', 2000, 'img-project-coffee/coffee-cardProduct-img/LavazzaOro.png'),
(3, 'Lavazza Qualita Rossa, 1 кг', 'Неповторимый вкус с шоколадными нотками. Универсальная смесь.', 'арабика, робуста', '1 ', 2050, 'img-project-coffee/coffee-cardProduct-img/LavazzaRossa.png'),
(4, 'Broceliande Costa-Rica, 1 кг', 'Высокогорный кофе. Мягкий тонкий вкус. Цитрусовые нотки, чернослив, груша.', '100% арабика', '1', 1600, 'img-project-coffee/coffee-cardProduct-img/CostaRica.png'),
(5, 'Broceliande Madagascar, 1 кг', 'Сбалансированный вкус, шоколадные и ванильные нотки. Купаж из лучших зерен.', '100% арабика', '1', 1900, 'img-project-coffee/coffee-cardProduct-img/Madagascar.png'),
(6, 'Broceliande Nepal, 1 кг', 'Уникальный купаж имеет ароматы какао и леденцов. Нотки имбиря во вкусе.', '100% арабика', '1', 1700, 'img-project-coffee/coffee-cardProduct-img/Nepal.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `role`, `phone`, `email`, `pass`) VALUES
(4, 'Tatiana', 'Татьяна', 'admin', '+7(908)555-85-77', '123@mail.ru', 'd8578edf8458ce06fbc5bb76a58c5ca4'),
(8, 'AnnaK', 'Анна', 'user', '+7(952)555-99-77', 'anna@mail.ru', '25d55ad283aa400af464c76d713c07ad'),
(11, 'IvanIvanov', 'Иван', 'user', '88002223366', 'ivan@mail.ru', '4297f44b13955235245b2497399d7a93');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `basketToProductsCoffee`
--
ALTER TABLE `basketToProductsCoffee`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ordersToProductsCoffee`
--
ALTER TABLE `ordersToProductsCoffee`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productsCoffee`
--
ALTER TABLE `productsCoffee`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `basketToProductsCoffee`
--
ALTER TABLE `basketToProductsCoffee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `ordersToProductsCoffee`
--
ALTER TABLE `ordersToProductsCoffee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `productsCoffee`
--
ALTER TABLE `productsCoffee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
