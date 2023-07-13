-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Cze 2023, 19:41
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `erpsystem`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rejestracja`
--

CREATE TABLE `rejestracja` (
  `id` int(2) NOT NULL,
  `nazwa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `haslo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `rola` int(1) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `aktywacja` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rejestracja`
--

INSERT INTO `rejestracja` (`id`, `nazwa`, `haslo`, `email`, `rola`, `token`, `aktywacja`) VALUES
(1, 'test', '05a671c66aefea124cc08b76ea6d30bb', 'test@wp.pl', 0, NULL, 0),
(2, 'admin', 'b73ca81b9a698682644461cd0e92a81c', 'carton@carton.pl', 2, NULL, 1),
(3, 'przelozony', '1751281ec12448c2d4709cf36832ea51', 'przelozony@test.pl', 1, NULL, 1),
(9, 'test1234', '16d7a4fca7442dda3ad93c9a726597e4', 'test1234@wp.pl', 0, NULL, 1),
(13, 'test2', '05a671c66aefea124cc08b76ea6d30bb', 'test@test.test', 0, NULL, 0),
(16, 'token123', '1fc34072660678ab6395a990ca908258', 'token123@token.pl', 0, '391b8272ad3298027c0789338cb5a046', 0),
(18, '12341234', 'ed2b1f468c5f915f3f1cf75d7068baae', '12341234@12.pl', 0, 'c1505d22561947827d66643334236310', 0),
(39, 'Patryk', '707d4571464411e49e44befdd1892582', 'patryk_kozlowski@yahoo.com', 0, 'd5c38dc50f0bee13c712c470b36b0e9d', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zarejestrowanegodziny`
--

CREATE TABLE `zarejestrowanegodziny` (
  `id` int(10) NOT NULL,
  `nazwa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `godziny` int(2) NOT NULL,
  `data_pracy` date NOT NULL,
  `weryfikacja` varchar(100) NOT NULL,
  `komentarz` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zarejestrowanegodziny`
--

INSERT INTO `zarejestrowanegodziny` (`id`, `nazwa`, `godziny`, `data_pracy`, `weryfikacja`, `komentarz`) VALUES
(22, 'test1234', 4, '2023-06-14', 'Zaakceptowane', 'xd'),
(23, 'test1234', 8, '2023-06-16', 'Do zatwierdzenia', 'halo kartus halo'),
(24, 'test1234', 2, '2023-06-01', 'Do zatwierdzenia', 'topory'),
(25, 'Patryk', 8, '2023-06-08', 'Zaakceptowane', 'Hello check test');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `rejestracja`
--
ALTER TABLE `rejestracja`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zarejestrowanegodziny`
--
ALTER TABLE `zarejestrowanegodziny`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `rejestracja`
--
ALTER TABLE `rejestracja`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT dla tabeli `zarejestrowanegodziny`
--
ALTER TABLE `zarejestrowanegodziny`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
