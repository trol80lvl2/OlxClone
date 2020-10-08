-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Чрв 19 2020 р., 10:59
-- Версія сервера: 10.3.22-MariaDB
-- Версія PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `olx`
--

-- --------------------------------------------------------

--
-- Структура таблиці `category`
--

CREATE TABLE `category` (
  `id_cat` int(11) NOT NULL,
  `name_cat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_cat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`id_cat`, `name_cat`, `img_cat`) VALUES
(0, 'Автомобілі', './content/iconka1.png'),
(1, 'Електроніка', './content/iconka2.png'),
(2, 'Тварини', './content/iconka3.png'),
(6, 'Дім та сад', './content/image/dim i sad.png'),
(7, 'Робота', './content/image/robota.png'),
(8, 'Одяг', './content/image/moda.png');

-- --------------------------------------------------------

--
-- Структура таблиці `filters`
--

CREATE TABLE `filters` (
  `id_fil` int(11) NOT NULL,
  `name_fil` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_fil` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `query` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `ogoloshennya`
--

CREATE TABLE `ogoloshennya` (
  `id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_subcat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_photo` varchar(1256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `added` date NOT NULL,
  `stan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `ogoloshennya`
--

INSERT INTO `ogoloshennya` (`id`, `id_cat`, `id_subcat`, `id_user`, `id_photo`, `name`, `opis`, `price`, `added`, `stan`) VALUES
(15, 0, 4, 1, './content/image/Без названия (2).jpg, ./content/image/, ', 'машіна убійца', 'огонь машіна', 2200, '2020-06-19', 'new'),
(17, 0, 4, 14, './content/image/Dit_tov.png, ', 'зверскій апарат', 'красата і сіла', 3000, '2020-06-18', 'bv'),
(18, 1, 5, 1, './content/image/3-800x800.jpg, ./content/image/3-800x800.jpg, ./content/image/, ', 'смартпен', 'Цифровая ручка Neo SmartPen N2 – незаменимый гаджет для оцифровки ручных записей и зарисовок. Это идеальная замена простой ручке – ведь помимо текста на бумаге вы получаете полностью оцифрованную информацию на любом из ваших устройств. Благодаря N2 вы почувствуете новые ощущения от письма или рисования.\r\n', 300, '2020-06-19', 'new'),
(19, 2, 2, 1, './content/image/1.jpg, ', 'цуцик', 'пес свійський', 100, '2020-06-19', 'bv'),
(20, 2, 2, 14, './content/image/, ', 'цуцик', 'пес свійський', 100, '2020-06-19', 'bv');

-- --------------------------------------------------------

--
-- Структура таблиці `subcategory`
--

CREATE TABLE `subcategory` (
  `id_sub` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `name_sub` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `subcategory`
--

INSERT INTO `subcategory` (`id_sub`, `id_cat`, `name_sub`) VALUES
(2, 2, 'Собака'),
(4, 0, 'Чотерьохколісні'),
(5, 1, 'Телефони'),
(6, 1, 'Смарт ручки');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `userstatus_id` int(11) NOT NULL,
  `since` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `phone`, `userstatus_id`, `since`) VALUES
(1, 'admin', 'admin', 'admin', '228-1337-02', 1, '2020-06-14'),
(2, 'Жмишенко Валерій Альбертович', 'zhmih@gmail.com', 'zhmih', '+380991488228', 3, '0000-00-00'),
(3, 'чяа', 'zhmih@gmail.com', '123', 'вчаваы', 3, '0000-00-00'),
(4, 'gf', 'admin', 'admin', 'gfgdg', 3, '0000-00-00'),
(5, 'admin', 'admin', 'admin', 'admin', 3, '0000-00-00'),
(6, 'admin1', 'admin1@gmail.com', 'admin1', 'admin1', 3, '0000-00-00'),
(7, 'admin2', 'admin2', 'admin2', 'admin2', 3, '0000-00-00'),
(8, 'Васьок', 'vasyok', 'vasyok', '380979889785', 3, '0000-00-00'),
(9, 'Вася', 'vasyok@g,aofdf', '123', '+3809798888552', 3, '0000-00-00'),
(10, 'admin', 'admin', 'admin', 'admin', 3, '0000-00-00'),
(11, 'gf 5', 'dfg', 'dgdg', 'gfgdggf', 3, '2014-06-20'),
(12, 'dfds', 'fsf', 'sdfs', 'fsf', 3, '2020-06-14'),
(13, 'gf', 'admin@gma', '123', 'gfgdg', 3, '2020-06-14'),
(14, 'volodenka', 'dmytro@volia.com', '123456', '0963546810', 3, '2020-06-18');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Індекси таблиці `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id_fil`);

--
-- Індекси таблиці `ogoloshennya`
--
ALTER TABLE `ogoloshennya`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id_sub`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userstatus_id` (`userstatus_id`),
  ADD KEY `id` (`id`),
  ADD KEY `userstatus_id_2` (`userstatus_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `ogoloshennya`
--
ALTER TABLE `ogoloshennya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
