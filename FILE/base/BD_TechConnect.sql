-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `BD_TechConnect`;
USE `BD_TechConnect`;

SET NAMES utf8mb4;

-- Структура таблицы `users`
CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `telegram_connect` bigint(11) DEFAULT NULL,
  `telegram_id` bigint(13) DEFAULT NULL,
  `Password` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы `users`
INSERT INTO `users` (`ID`, `Name`, `Email`, `phone_number`, `telegram_connect`, `telegram_id`, `Password`) VALUES
(1, 'USER1', '1@mail', NULL, NULL, NULL, '\$2y\$10$eJSehDhr9mp9m1Y22D7mDOHwTcA4TZEGi32n8ylLI0mZJZSBaXlsS'),
(2, 'USER2', NULL, 8922, NULL, NULL, NULL);

-- Индексы таблицы `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

-- AUTO_INCREMENT для таблицы `users`
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
