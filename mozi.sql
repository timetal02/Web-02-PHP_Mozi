-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2024. Nov 29. 19:39
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `mozi`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `eloadas`
--

CREATE TABLE `eloadas` (
  `filmid` int(11) NOT NULL,
  `moziid` int(11) NOT NULL,
  `datum` date NOT NULL,
  `nezoszam` int(11) DEFAULT NULL,
  `bevetel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `eloadas`
--

INSERT INTO `eloadas` (`filmid`, `moziid`, `datum`, `nezoszam`, `bevetel`) VALUES
(1, 18, '1999-01-01', 113, 26829),
(6, 15, '1999-01-01', 88, 23324),
(10, 7, '1999-01-01', 82, 36344),
(13, 20, '1999-01-01', 58, 14800),
(16, 9, '1999-01-01', 91, 44652),
(16, 19, '1999-01-01', 126, 38274),
(17, 17, '1999-01-01', 118, 24644),
(19, 2, '1999-01-01', 157, 70651),
(23, 4, '1999-01-01', 97, 43122),
(24, 12, '1999-01-01', 223, 77812),
(25, 6, '1999-01-01', 142, 70690),
(27, 3, '1999-01-01', 187, 53969),
(27, 11, '1999-01-01', 114, 48098),
(27, 13, '1999-01-01', 115, 25555),
(30, 10, '1999-01-01', 122, 36548),
(35, 8, '1999-01-01', 64, 31812),
(36, 16, '1999-01-01', 126, 44500),
(37, 5, '1999-01-01', 81, 30127),
(41, 1, '1999-01-01', 208, 85440),
(43, 14, '1999-01-01', 75, 36625);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `felh_ID` int(40) NOT NULL,
  `felh_nev` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `jogosultsag` enum('látogató','regisztrált látogató','admin','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`felh_ID`, `felh_nev`, `jelszo`, `jogosultsag`) VALUES
(1, 'admin', '$2y$10$yh2XzBb./p4sppOvRxus0OaS5WAtXaitQZ1zF16k.0yVDcGOLN9W.', 'admin'),
(2, 'regisztrált látogató', '$2y$10$nKSvrS5qltl/bGAS.0apy.2JXXgVzcwDBzbC9Bk/dxAoetelzEO7a', 'regisztrált látogató'),
(3, 'látogató', '$2y$10$bE5mzCoXMyMuf/G73BcXaOBqF8l99S.8LRDswKdouw0pIU6V2NF1G', 'látogató');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `cim` varchar(200) DEFAULT NULL,
  `ev` int(11) DEFAULT NULL,
  `hossz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `film`
--

INSERT INTO `film` (`id`, `cim`, `ev`, `hossz`) VALUES
(1, 'Csókolj meg, édes!', 1932, 67),
(2, 'Repülõ arany', 1932, 48),
(3, 'Piri mindent tud', 1932, 92),
(4, 'Az ellopott szerda', 1933, 72),
(5, 'Mindent a nõért', 1933, 57),
(6, 'Emmy', 1934, 83),
(7, 'Szerelmi álmok', 1935, 66),
(8, 'A titokzatos idegen', 1936, 59),
(9, 'Havi 200 fix', 1936, 86),
(10, 'Szerelembõl nõsültem', 1937, 67),
(11, 'Az ember néha téved', 1937, 49),
(12, 'Toroczkói menyasszony', 1937, 78),
(13, 'Borcsa Amerikában', 1936, 91),
(14, 'János Vitéz', 1938, 65),
(15, 'A leányvári boszorkány', 1938, 87),
(16, 'Nincsenek véletlenek', 1938, 73),
(17, 'A varieté csillagai', 1938, 81),
(18, 'Varjú a toronyórán', 1938, 59),
(19, 'Pénz beszél', 1940, 67),
(20, 'Igen, vagy nem?', 1940, 82),
(21, 'Az elkésett levél', 1940, 58),
(22, 'Kádár kontra Kerekes', 1941, 98),
(23, 'Bob herceg', 1941, 112),
(24, 'Negyedíziglen', 1942, 78),
(25, 'Bajtársak', 1942, 68),
(26, 'Egér a palotában', 1942, 94),
(27, 'Alkalom', 1942, 65),
(28, 'Kölcsönkért férjek', 1941, 84),
(29, 'Hegyek lánya', 1942, 69),
(30, 'Jómadár', 1943, 73),
(31, 'Tilos a szerelem', 1943, 76),
(32, 'Sárga kaszinó', 1943, 81),
(33, 'A huszonnyolcas', 1943, 51),
(34, 'Makacs Kata', 1943, 98),
(35, 'Kerek Ferkó', 1943, 74),
(36, 'Kölcsönadott élet', 1943, 79),
(37, 'Magyar sasok', 1943, 58),
(38, 'Idegen utakon', 1944, 67),
(39, 'Nevetõ Budapest', 1930, 92),
(40, 'Hölgyek elõnyben', 1939, 66),
(41, 'Beszállásolás', 1938, 62),
(42, 'Annamária', 1942, 85),
(43, 'Magyar feltámadás', 1939, 64),
(44, 'Rádbízom a feleségem', 1937, 55);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu`
--

CREATE TABLE `menu` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(20) DEFAULT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent_id`, `url`) VALUES
(1, 'Főoldal', NULL, 'index.php'),
(2, 'Rólunk', NULL, 'index.php#about'),
(3, 'Vetítések', NULL, 'projections.php'),
(4, 'Kapcsolat', NULL, 'index.php#contact'),
(5, 'MNB', NULL, 'mnb.php'),
(7, 'Kategóriák', NULL, 'index.php#category'),
(8, 'Blog', NULL, 'index.php#blog'),
(9, 'Értékelések', NULL, 'index.php#review');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mozi`
--

CREATE TABLE `mozi` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) DEFAULT NULL,
  `varos` varchar(100) DEFAULT NULL,
  `ferohely` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mozi`
--

INSERT INTO `mozi` (`id`, `nev`, `varos`, `ferohely`) VALUES
(1, 'Gárdonyi Lajos', 'Budapest', 320),
(2, 'Pécsi Sándor', 'Sárospatak', 250),
(3, 'Páger Antal', 'Szeged', 303),
(4, 'Dayka Margit', 'Szeged', 150),
(5, 'Csortos Gyula', 'Gyõr', 220),
(6, 'Latabár Kálmán', 'Szolnok', 160),
(7, 'Kabos Gyula', 'Nyíregyháza', 180),
(8, 'Jávor Pál', 'Eger', 200),
(9, 'Karády Katalin', 'Eger', 175),
(10, 'Gózon Gyula', 'Tatabánya', 180),
(11, 'Salamon Béla', 'Kaposvár', 300),
(12, 'Gertler Viktor', 'Gyõr', 310),
(13, 'Várkonyi Zoltán', 'Siklós', 180),
(14, 'Mály Gerõ', 'Zalaegerszeg', 210),
(15, 'Székely István', 'Siófok', 240),
(16, 'Keleti Márton', 'Szombathely', 195),
(17, 'Ráday Imre', 'Kistelek', 150),
(18, 'Bilicsi Tivadar', 'Tiszafüred', 145),
(19, 'Szabó Sándor', 'Érd', 175),
(20, 'Blaha Lujza', 'Komárom', 210),
(21, 'Tolnay Klári', 'Balatonfüred', 230),
(22, 'Latinovits Zoltán', 'Békéscsaba', 260),
(23, 'Kiss Manyi', 'Pécs', 150),
(24, 'Somlay Artúr', 'Debrecen', 180),
(25, 'Fedák Sári', 'Keszthely', 230),
(26, 'Makláry Zoltán', 'Budapest', 155),
(27, 'Major Tamás', 'Pécs', 140),
(28, 'Gobbi Hilda', 'Budapest', 300),
(29, 'Törzs Jenõ', 'Szekszárd', 130),
(30, 'Bajor Gizi', 'Budapest', 120),
(31, 'Ujházi Ede', 'Budapest', 140),
(32, 'Rózsahegyi Kálmán', 'Miskolc', 210),
(33, 'Honthy Hanna', 'Veszprém', 120),
(34, 'Márkus Emília', 'Sopron', 160),
(35, 'Varsányi Irén', 'Budapest', 300),
(36, 'Hegedüs Gyula', 'Budapest', 155),
(37, 'Rajnay Gábor', 'Gyöngyös', 210);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `eloadas`
--
ALTER TABLE `eloadas`
  ADD PRIMARY KEY (`filmid`,`moziid`,`datum`),
  ADD KEY `moziid` (`moziid`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`felh_ID`),
  ADD KEY `felh_nev` (`felh_nev`);

--
-- A tábla indexei `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `mozi`
--
ALTER TABLE `mozi`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felh_ID` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `mozi`
--
ALTER TABLE `mozi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `eloadas`
--
ALTER TABLE `eloadas`
  ADD CONSTRAINT `eloadas_ibfk_1` FOREIGN KEY (`filmid`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `eloadas_ibfk_2` FOREIGN KEY (`moziid`) REFERENCES `mozi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
