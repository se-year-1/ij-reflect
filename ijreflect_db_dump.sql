-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 08 jun 2016 om 16:59
-- Serverversie: 5.6.30
-- PHP-versie: 5.6.20-pl0-gentoo

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ijreflect`
--
CREATE DATABASE IF NOT EXISTS `ijreflect` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ijreflect`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Category`
--

INSERT INTO `Category` (`id`, `name`, `description`) VALUES
(1, 'Initiatief nemen', 'Wanneer je uit jezelf met ideeën en voorstellen komt en daar iets mee gaat doen, dan neem je initiatief. Je wacht niet af tot anderen iets zeggen of doen, maar je kijkt goed uit jezelf wat jij zou kunnen doen. Als je vaak zegt: “zal ik even...?” dan neem je waarschijnlijk vaak initiatief. Initiatief nemen is een belangrijke kwaliteit. Mensen die uit zichzelf dingen zien en daar wat mee gaan doen, zijn vaak succesvol. \r\nDe beste serveerster ziet wanneer een klant iets wil vragen, komt zelf met ideeën om het restaurant nog beter te laten lopen en vraagt uit zichzelf: “kan ik u nog ergens mee helpen”. De beste student ziet wat hij moet doen om nog beter te worden en gaat daar zelf mee aan de slag. Je kunt ‘initiatief nemen’ op allerlei plekken oefenen. Je kunt beginnen met jezelf en zelf heel actief aan je eigen ontwikkelpunten werken. '),
(2, 'Verantwoordelijkheid dragen', 'Wanneer je op tijd komt, je afspraken nakomt, je werk in orde hebt, regelmatig taken op je neemt en die ook goed uitvoert, gericht bent op je eigen ontwikkeling en die van anderen, dan gedraag je je verantwoordelijk. Iemand die taken op zich neemt en dat dan ook goed doet, draagt de verantwoordelijkheid voor een taak. Dit is ook iets wat heel belangrijk is om succesvol te zijn op je werk of in je opleiding.'),
(3, 'Verantwoording afleggen', 'Over de dingen waar jij verantwoordelijk voor bent, moet je ook verantwoording afleggen. Op die manier vertel jij zelf waar je mee bezig bent, zodat anderen daar zicht op hebben. Als je bijvoorbeeld een bepaalde taak op je hebt genomen, dan is het belangrijk om de ander (je coach, je docent, je ouders, je baas, je teamgenootjes) op de hoogte te stellen van hoe het gaat. Ook als het soms niet lukt om een bepaalde afspraak na te komen, dan laat je dat op tijd aan de ander weten. Je komt ook met een voorstel, waardoor je er toch voor kan zorgen dat uiteindelijk alles goed komt. Je zorgt er dan voor dat de ander zo min mogelijk last heeft van het feit dat jij je afspraken niet nagekomen bent.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Form_History`
--

CREATE TABLE `Form_History` (
  `email` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `respondent` varchar(30) NOT NULL,
  `name_respondent` varchar(100) NOT NULL,
  `completed` int(11) NOT NULL,
  `formdata` text NOT NULL,
  `graphdata` text,
  `period_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Form_History`
--

INSERT INTO `Form_History` (`email`, `datetime`, `respondent`, `name_respondent`, `completed`, `formdata`, `graphdata`, `period_id`) VALUES
('damiengroot@gmail.com', '2016-06-08 14:45:34', 'Ouder/Verzorger', 'N. Drooit', 0, '[{"categoryid":"1","questionid":"1","gradation":"1"},{"categoryid":"1","questionid":"2","gradation":"4"},{"categoryid":"1","questionid":"3","gradation":"5"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"5"}]', NULL, 113),
('gigateun@gmail.com', '2016-06-05 18:25:41', 'Ikzelf', 'Teun Mathijssen', 1, '[{"categoryid":"1","questionid":"1","gradation":"2"},{"categoryid":"1","questionid":"2","gradation":"4"},{"categoryid":"1","questionid":"3","gradation":"5"},{"categoryid":"2","questionid":"4","gradation":"4"},{"categoryid":"2","questionid":"5","gradation":"5"},{"categoryid":"2","questionid":"6","gradation":"4"},{"categoryid":"2","questionid":"7","gradation":"5"},{"categoryid":"2","questionid":"8","gradation":"4"},{"categoryid":"2","questionid":"9","gradation":"5"},{"categoryid":"3","questionid":"10","gradation":"4"},{"categoryid":"3","questionid":"11","gradation":"5"},{"categoryid":"3","questionid":"12","gradation":"4"}]', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[66.666666666667,87.5,83.333333333333]}', 57),
('gigateun@gmail.com', '2016-06-05 18:28:52', 'Ikzelf', 'Teun Mathijssen', 1, '[{"categoryid":"1","questionid":"1","gradation":"3"},{"categoryid":"1","questionid":"2","gradation":"4"},{"categoryid":"1","questionid":"3","gradation":"5"},{"categoryid":"2","questionid":"4","gradation":"4"},{"categoryid":"2","questionid":"5","gradation":"5"},{"categoryid":"2","questionid":"6","gradation":"1"},{"categoryid":"2","questionid":"7","gradation":"2"},{"categoryid":"2","questionid":"8","gradation":"4"},{"categoryid":"2","questionid":"9","gradation":"5"},{"categoryid":"3","questionid":"10","gradation":"4"},{"categoryid":"3","questionid":"11","gradation":"5"},{"categoryid":"3","questionid":"12","gradation":"4"}]', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[75,62.5,83.333333333333]}', 57),
('gigateun@gmail.com', '2016-06-05 18:30:31', 'Medeleerling', 'Jeroen', 1, '[{"categoryid":"1","questionid":"1","gradation":"3"},{"categoryid":"1","questionid":"2","gradation":"2"},{"categoryid":"1","questionid":"3","gradation":"4"},{"categoryid":"2","questionid":"4","gradation":"1"},{"categoryid":"2","questionid":"5","gradation":"5"},{"categoryid":"2","questionid":"6","gradation":"1"},{"categoryid":"2","questionid":"7","gradation":"2"},{"categoryid":"2","questionid":"8","gradation":"4"},{"categoryid":"2","questionid":"9","gradation":"5"},{"categoryid":"3","questionid":"10","gradation":"4"},{"categoryid":"3","questionid":"11","gradation":"5"},{"categoryid":"3","questionid":"12","gradation":"4"}]', '{"name":"Medeleerling: hey, lul!","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[50,50,83.333333333333]}', 57),
('gigateun@gmail.com', '2016-06-05 22:21:08', 'Ikzelf', 'Teun Mathijssen', 1, '[{"categoryid":"1","questionid":"1","gradation":"5"},{"categoryid":"1","questionid":"2","gradation":"5"},{"categoryid":"1","questionid":"3","gradation":"5"},{"categoryid":"2","questionid":"4","gradation":"5"},{"categoryid":"2","questionid":"5","gradation":"5"},{"categoryid":"2","questionid":"6","gradation":"5"},{"categoryid":"2","questionid":"7","gradation":"5"},{"categoryid":"2","questionid":"8","gradation":"5"},{"categoryid":"2","questionid":"9","gradation":"5"},{"categoryid":"3","questionid":"10","gradation":"1"},{"categoryid":"3","questionid":"11","gradation":"1"},{"categoryid":"3","questionid":"12","gradation":"1"}]', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[100,100,0]}', 58),
('gigateun@gmail.com', '2016-06-06 10:41:50', 'Ikzelf', 'Teun Mathijssen', 1, '[{"categoryid":"1","questionid":"1","gradation":"4"},{"categoryid":"1","questionid":"2","gradation":"5"},{"categoryid":"1","questionid":"3","gradation":"4"},{"categoryid":"2","questionid":"4","gradation":"5"},{"categoryid":"2","questionid":"5","gradation":"4"},{"categoryid":"2","questionid":"6","gradation":"3"},{"categoryid":"2","questionid":"7","gradation":"2"},{"categoryid":"2","questionid":"8","gradation":"5"},{"categoryid":"2","questionid":"9","gradation":"4"},{"categoryid":"3","questionid":"10","gradation":"3"},{"categoryid":"3","questionid":"11","gradation":"5"},{"categoryid":"3","questionid":"12","gradation":"4"}]', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[83.333333333333,70.833333333333,75]}', 58),
('gigateun@gmail.com', '2016-06-07 12:52:27', 'Medeleerling', 'Teun', 1, '[{"categoryid":"1","questionid":"1","gradation":"1"},{"categoryid":"1","questionid":"2","gradation":"3"},{"categoryid":"1","questionid":"3","gradation":"5"},{"categoryid":"2","questionid":"4","gradation":"4"},{"categoryid":"2","questionid":"5","gradation":"5"},{"categoryid":"2","questionid":"6","gradation":"4"},{"categoryid":"2","questionid":"7","gradation":"3"},{"categoryid":"2","questionid":"8","gradation":"4"},{"categoryid":"2","questionid":"9","gradation":"5"},{"categoryid":"3","questionid":"10","gradation":"4"},{"categoryid":"3","questionid":"11","gradation":"3"},{"categoryid":"3","questionid":"12","gradation":"5"},{"categoryid":"8","questionid":"21","gradation":"4"},{"categoryid":"8","questionid":"22","gradation":"4"},{"categoryid":"8","questionid":"23","gradation":"5"}]', '{"name":"Medeleerling: te","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen","Cat. 4"],"scores":[50,79.166666666667,75,83.333333333333]}', 89),
('gigateun@gmail.com', '2016-06-07 12:55:06', 'Ikzelf', 'Teun Mathijssen', 1, '[{"categoryid":"1","questionid":"1","gradation":"1"},{"categoryid":"1","questionid":"2","gradation":"4"},{"categoryid":"1","questionid":"3","gradation":"5"},{"categoryid":"2","questionid":"4","gradation":"4"},{"categoryid":"2","questionid":"5","gradation":"5"},{"categoryid":"2","questionid":"6","gradation":"5"},{"categoryid":"2","questionid":"7","gradation":"2"},{"categoryid":"2","questionid":"8","gradation":"3"},{"categoryid":"2","questionid":"9","gradation":"4"},{"categoryid":"3","questionid":"10","gradation":"4"},{"categoryid":"3","questionid":"11","gradation":"2"},{"categoryid":"3","questionid":"12","gradation":"2"},{"categoryid":"8","questionid":"21","gradation":"2"},{"categoryid":"8","questionid":"22","gradation":"4"},{"categoryid":"8","questionid":"23","gradation":"3"},{"categoryid":"9","questionid":"24","gradation":"4"}]', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen","Cat. 4","Cat. 5"],"scores":[58.333333333333,70.833333333333,41.666666666667,50,75]}', 95),
('gigateun@gmail.com', '2016-06-07 21:18:58', 'Ikzelf', 'Teun Mathijssen', 0, '[{"categoryid":"1","questionid":"1","gradation":"0"},{"categoryid":"1","questionid":"2","gradation":"0"},{"categoryid":"1","questionid":"3","gradation":"0"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"0"}]', NULL, 96),
('gigateun@gmail.com', '2016-06-07 21:30:10', 'Ikzelf', 'Teun Mathijssen', 0, '[{"categoryid":"1","questionid":"1","gradation":"0"},{"categoryid":"1","questionid":"2","gradation":"0"},{"categoryid":"1","questionid":"3","gradation":"0"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"0"}]', NULL, 96),
('gigateun@gmail.com', '2016-06-08 15:07:43', 'Ikzelf', 'Teun Mathijssen', 0, '[{"categoryid":"1","questionid":"1","gradation":"1"},{"categoryid":"1","questionid":"2","gradation":"5"},{"categoryid":"1","questionid":"3","gradation":"0"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"1"}]', NULL, 96),
('misharigot@gmail.com', '2016-06-08 12:37:30', 'Ikzelf', 'Misha R', 1, '0', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[50,54.166666666667,66.666666666667]}', 104),
('misharigot@gmail.com', '2016-06-08 12:38:38', 'Medeleerling', 'Teun', 1, '0', '{"name":"Medeleerling: Teun","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[25,37.5,50]}', 104),
('misharigot@gmail.com', '2016-06-08 12:39:12', 'Expert', 'Arthur', 1, '0', '{"name":"Expert: Arthur","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[50,54.166666666667,83.333333333333]}', 104),
('misharigot@gmail.com', '2016-06-08 12:39:44', 'Ouder/Verzorger', 'Papa', 1, '0', '{"name":"Ouder\\/Verzorger: Papa","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[66.666666666667,79.166666666667,83.333333333333]}', 104),
('misharigot@gmail.com', '2016-06-08 12:40:39', 'Ikzelf', 'Misha R', 1, '0', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[91.666666666667,70.833333333333,75]}', 109),
('misharigot@gmail.com', '2016-06-08 12:41:07', 'Medeleerling', 'Bram', 1, '0', '{"name":"Medeleerling: Bram","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[75,91.666666666667,100]}', 109),
('misharigot@gmail.com', '2016-06-08 12:41:35', 'Expert', 'Jos', 1, '0', '{"name":"Expert: Jos","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[66.666666666667,70.833333333333,66.666666666667]}', 109),
('misharigot@gmail.com', '2016-06-08 12:42:05', 'Ouder/Verzorger', 'Mama', 1, '0', '{"name":"Ouder\\/Verzorger: Mama","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[83.333333333333,66.666666666667,33.333333333333]}', 109),
('misharigot@gmail.com', '2016-06-08 12:44:49', 'Ikzelf', 'Misha R', 1, '0', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[75,91.666666666667,91.666666666667]}', 110),
('misharigot@gmail.com', '2016-06-08 12:45:16', 'Medeleerling', 'Murathan', 1, '0', '{"name":"Medeleerling: Murathan","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[66.666666666667,70.833333333333,50]}', 110),
('misharigot@gmail.com', '2016-06-08 12:45:49', 'Expert', 'Zarina', 1, '0', '{"name":"Expert: Zarina","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[50,54.166666666667,58.333333333333]}', 110),
('misharigot@gmail.com', '2016-06-08 12:46:17', 'Ouder/Verzorger', 'Oma', 1, '0', '{"name":"Ouder\\/Verzorger: Oma","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[91.666666666667,100,66.666666666667]}', 110),
('misharigot@gmail.com', '2016-06-08 12:46:54', 'Expert', 'Karel', 1, '0', '{"name":"Expert: Karel","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[75,75,83.333333333333]}', 111),
('misharigot@gmail.com', '2016-06-08 12:47:28', 'Ouder/Verzorger', 'Papa', 1, '0', '{"name":"Ouder\\/Verzorger: Papa","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[58.333333333333,79.166666666667,83.333333333333]}', 111),
('misharigot@gmail.com', '2016-06-08 13:58:50', 'Medeleerling', 'Peter', 1, '0', '{"name":"Medeleerling: Peter","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[91.666666666667,45.833333333333,75]}', 111),
('misharigot@gmail.com', '2016-06-08 14:20:29', 'Medeleerling', 'arnaud', 0, '[{"categoryid":"1","questionid":"1","gradation":"0"},{"categoryid":"1","questionid":"2","gradation":"0"},{"categoryid":"1","questionid":"3","gradation":"0"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"0"}]', NULL, 112),
('takkiemon@gmail.com', '2016-06-07 23:43:43', 'Expert', 'X. Per', 1, '0', '{"name":"Expert: X. Per","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[50,29.166666666667,58.333333333333]}', 68),
('takkiemon@gmail.com', '2016-06-07 23:44:36', 'Medeleerling', 'A. Tari', 1, '0', '{"name":"Medeleerling: A. Tari","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[66.666666666667,100,0]}', 68),
('takkiemon@gmail.com', '2016-06-07 23:45:19', 'Ouder/Verzorger', 'P. Smeker', 1, '0', '{"name":"Ouder\\/Verzorger: P. Smeker","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[50,62.5,33.333333333333]}', 68),
('takkiemon@gmail.com', '2016-06-07 23:46:49', 'Expert', 'B. verweijk', 1, '0', '{"name":"Expert: B. verweijk","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[83.333333333333,45.833333333333,100]}', 105),
('takkiemon@gmail.com', '2016-06-07 23:48:47', 'Medeleerling', 'N. Drooit', 1, '0', '{"name":"Medeleerling: N. Drooit","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[8.3333333333333,12.5,91.666666666667]}', 105),
('takkiemon@gmail.com', '2016-06-07 23:49:50', 'Ikzelf', 'Tak Man Wong', 1, '0', '{"name":"Ikzelf","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[50,100,0]}', 106),
('takkiemon@gmail.com', '2016-06-07 23:50:12', 'Ouder/Verzorger', 'H. Vermout', 1, '0', '{"name":"Ouder\\/Verzorger: H. Vermout","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[58.333333333333,37.5,33.333333333333]}', 106),
('takkiemon@gmail.com', '2016-06-07 23:51:05', 'Expert', 'K. Non', 1, '0', '{"name":"Expert: K. Non","categories":["Initiatief nemen","Verantwoordelijkheid dragen","Verantwoording afleggen"],"scores":[100,100,100]}', 106),
('takkiemon@gmail.com', '2016-06-08 13:57:35', 'Ikzelf', 'Tak Man Wong', 0, '[{"categoryid":"1","questionid":"1","gradation":"4"},{"categoryid":"1","questionid":"2","gradation":"2"},{"categoryid":"1","questionid":"3","gradation":"0"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"0"}]', NULL, 108),
('takkiemon@gmail.com', '2016-06-08 14:58:26', 'Expert', 'X. Per', 0, '[{"categoryid":"1","questionid":"1","gradation":"4"},{"categoryid":"1","questionid":"2","gradation":"4"},{"categoryid":"1","questionid":"3","gradation":"3"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"0"}]', NULL, 108),
('takkiemon@gmail.com', '2016-06-08 15:49:45', 'Ouder/Verzorger', 'N. Drooit', 0, '[{"categoryid":"1","questionid":"1","gradation":"4"},{"categoryid":"1","questionid":"2","gradation":"3"},{"categoryid":"1","questionid":"3","gradation":"0"},{"categoryid":"2","questionid":"4","gradation":"0"},{"categoryid":"2","questionid":"5","gradation":"0"},{"categoryid":"2","questionid":"6","gradation":"0"},{"categoryid":"2","questionid":"7","gradation":"0"},{"categoryid":"2","questionid":"8","gradation":"0"},{"categoryid":"2","questionid":"9","gradation":"0"},{"categoryid":"3","questionid":"10","gradation":"0"},{"categoryid":"3","questionid":"11","gradation":"0"},{"categoryid":"3","questionid":"12","gradation":"0"}]', NULL, 108);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Gradation`
--

CREATE TABLE `Gradation` (
  `id` int(11) NOT NULL,
  `gradationlevel` int(1) NOT NULL,
  `idquestion` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Gradation`
--

INSERT INTO `Gradation` (`id`, `gradationlevel`, `idquestion`, `description`) VALUES
(1, 1, 1, 'Ik wacht eigenlijk altijd af en kijk eerst wat anderen doen.'),
(2, 2, 1, 'Ik wacht vaak af en kijk liever eerst wat anderen doen. Daar sluit ik me dan bij aan.'),
(3, 3, 1, 'Ik zie wanneer er iets moet gebeuren en soms zeg ik dat.'),
(4, 4, 1, 'Ik zie heel vaak wat ik zou kunnen doen, ik heb regelmatig ideeën en voorstellen die ik voorleg aan anderen.'),
(5, 5, 1, 'Ik kom vaak met een idee of voorstel. Ik bedenk vaak wat ik zelf kan doen. Ik pak dit dan ook meteen op en ga dat doen.'),
(6, 1, 2, 'Ik ga niet uit mijzelf aan het werk. Ook als anderen me vragen iets te doen dan heb ik moeite om te beginnen.'),
(7, 2, 2, 'Ik vind het prettig wanneer anderen mij vertellen wat ik moet doen. Ik begin niet vaak uit mezelf.'),
(8, 3, 2, 'Wanneer anderen aan het werk zijn, sluit ik me daar bij aan. Soms begin ik zelf. Het helpt als anderen mij aansporen.'),
(9, 4, 2, 'Ik begin regelmatig uit mezelf met werken. Soms heb ik aansporing van anderen nodig, maar niet vaak.'),
(10, 5, 2, 'Ik begin meestal uit mezelf met werken. Anderen hoeven me niet aan te sporen.'),
(11, 1, 4, 'Ik lever werk vaak te laat, onvolledig of helemaal niet in.'),
(12, 2, 4, 'Het gebeurt regelmatig dat mijn werk iets te laat of niet helemaal in orde is.'),
(13, 3, 4, 'Ik doe mijn best mijn werk op tijd en netjes in te leveren, maar soms lukt me dat niet helemaal.'),
(14, 4, 4, 'Ik lever mijn spullen bijna altijd netjes en op tijd in. Heel af en toe lukt het me net niet.'),
(15, 5, 4, 'Ik zorg ervoor dat mijn werk altijd in orde, en op tijd af is.'),
(16, 1, 3, 'Ik vraag eigenlijk nooit om hulp. Ik kan het meestal alleen wel aan.'),
(17, 5, 3, 'Ik vraag altijd direct om hulp aan anderen. Ik werk liever samen met anderen en zoek dingen liever niet alleen uit.'),
(18, 2, 3, 'Ik vind het prettig als anderen mij hulp aanbieden. Ik vraag er zelf niet snel om.'),
(19, 3, 3, 'Ik vraag soms om hulp, als ik denk dat ik iets niet kan. Ik vind het lastig om om hulp te vragen.'),
(20, 4, 3, 'Ik vraag regelmatig om hulp aan anderen.'),
(21, 1, 5, 'Ik kom vaak te laat in lessen of op afspraken. Ik vind het ook niet zo heel belangrijk om op tijd te komen.'),
(22, 2, 5, 'Ik kom regelmatig te laat in lessen of op afspraken. Als iemand me er op aanspreekt, snap ik dat wel.'),
(23, 3, 5, 'Ik vind het belangrijk om op tijd te komen, maar vaak lukt me dat niet. Ik probeer dat wel te voorkomen.'),
(24, 4, 5, 'Ik ben bijna altijd op tijd. Dat vind ik ook erg belangrijk.'),
(25, 5, 5, 'Ik ben bijna altijd op tijd. Als ik, in een uitzonderlijk geval, toch te laat kom, zoek ik de ander op om de reden even toe te lichten.'),
(26, 1, 6, 'Als er iets gebeurt, vind ik vaak dat het niet aan mezelf ligt.'),
(27, 2, 6, 'Ook als ik weet dat iets aan mezelf ligt, dan geef ik dat niet snel toe.'),
(28, 3, 6, 'Soms vind ik het moeilijk alle verantwoordelijkheid op me te nemen en geef ik de schuld aan anderen.'),
(29, 4, 6, 'Ik voel me verantwoordelijk voor mijn eigen werk en gedrag.'),
(30, 5, 6, 'Ik voel me sterk verantwoordelijk voor mijn eigen gedrag en pas mijn gedrag aan als dat nodig is.'),
(31, 1, 7, 'Ik neem bijna nooit een taak op me. Niet uit mezelf en ook niet als iemand daarom vraagt.'),
(32, 2, 7, 'Als mij wordt gevraagd om een taak op me te nemen, dan doe ik dat soms. Het lukt vaak niet om dat goed te doen. Ik kom vaak mijn afspraken niet na.'),
(33, 3, 7, 'Ik probeer soms wel taken op te nemen. Ik doe mijn best om dat goed te doen. Het lukt me vaak niet om mijn afspraken ook na te komen.'),
(34, 4, 7, 'Ik neem soms een taak op me. Meestal lukt het me om deze taak goed uit te voeren. Ik vergeet op tijd om hulp te vragen.'),
(35, 5, 7, 'Ik neem vaak een taak op me en ik zorg er dan voor dat ik dat goed doe. Ik vraag op tijd om hulp als dat nodig is.'),
(36, 1, 8, 'In een groep voel ik me niet verantwoordelijk voor het geheel of voor anderen.'),
(37, 2, 8, 'Ik vind het moeilijk om te zien wat ik kan doen voor een groep of voor anderen. Daarom wacht ik meestal af.'),
(38, 3, 8, 'Soms zie ik wel dat de groep of anderen iets nodig hebben, maar dan weet ik niet wat ik kan doen.'),
(39, 4, 8, 'Ik zie het ook als mijn verantwoordelijkheid dat het goed gaat met een groep. Ik let op anderen en help waar ik kan.'),
(40, 5, 8, 'Het is ook mijn verantwoordelijkheid dat het goed gaat met een groep. Ik zorg ervoor dat de rollen goed verdeeld zijn. Ik probeer ook anderen te stimuleren om hun kwaliteiten goed in te zetten.'),
(41, 1, 9, 'Ik werk bijna nooit aan mijn actiepunten.'),
(42, 2, 9, 'Ik werk pas aan mijn actiepunten, wanneer anderen me aansporen.'),
(43, 3, 9, 'Soms werk ik uit mezelf aan mijn actiepunten, soms pas als anderen dat vragen.'),
(44, 4, 9, 'Met af en toe een herinnering van mijn mentor, ouder of docent werk ik goed aan mijn actiepunten.'),
(45, 5, 9, 'Ik werk zonder aansporing van anderen actief aan mijn actiepunten.'),
(46, 1, 10, 'Ik praat bijna nooit met mijn mentor of docenten over waar ik mee bezig ben en hoe het gaat.'),
(47, 2, 10, 'Als mijn mentor of docenten echt willen weten waar ik mee bezig ben of hoe het gaat, dan vertel ik dat meestal wel.'),
(48, 3, 10, 'Ik vertel mijn mentor en docenten soms uit mezelf wat ik doe en hoe het gaat, soms als ze er naar vragen.'),
(49, 4, 10, 'Ik praat regelmatig met mijn mentor en docenten over waar ik mee bezig ben. Meestal vertel ik dan ook hoe het gaat en of ik hulp nodig heb.'),
(50, 5, 10, 'Ik stel mijn mentor en docenten altijd goed op de hoogte van waar ik mee bezig ben en hoe het gaat.'),
(51, 1, 11, 'Ik praat bijna nooit met mijn ouders over school. Eigenlijk weten ze nauwelijks hoe het met me gaat op school.'),
(52, 2, 11, 'Als mijn ouders echt willen weten waar ik mee bezig ben of hoe het gaat, dan vertel ik dat meestal wel.'),
(53, 3, 11, 'Ik vertel mijn ouders soms uit mezelf wat ik doe en hoe het gaat, soms als ze er naar vragen.'),
(54, 4, 11, 'Ik praat regelmatig met mijn ouders over waar ik mee bezig ben. Meestal vertel ik dan ook hoe het gaat en of ik hulp nodig heb.'),
(55, 5, 11, 'Ik stel mijn ouders altijd goed op de hoogte van waar ik mee bezig ben.'),
(56, 1, 12, 'Ik communiceer nooit over afspraken die ik niet na kan komen. Als ik iets niet af krijg, wacht ik af wat er gaat gebeuren.'),
(57, 2, 12, 'Op het moment dat ik aangesproken wordt over iets wat ik zou doen en niet heb gedaan, leg ik uit hoe het zo gekomen is.'),
(58, 3, 12, 'Ik communiceer soms over mijn afspraken. Als het niet lukt om een afspraak na te komen, probeer ik daarover met de ander te communiceren, voordat de ander mij erop aanspreekt.'),
(59, 4, 12, 'Ik kom mijn afspraken meestal na. Als het niet lukt om mijn afspraak na te komen, dan vertel ik dat op tijd aan de ander.'),
(60, 5, 12, 'Ik kom mijn afspraken meestal na. Als het niet lukt om mijn afspraak na te komen, dan vertel ik dat op tijd aan de ander. Ik laat ook weten hoe ik ervoor zorg dat alles uiteindelijk toch in orde komt.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Period`
--

CREATE TABLE `Period` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Period`
--

INSERT INTO `Period` (`id`, `email`, `datetime`, `name`, `active`) VALUES
(57, 'gigateun@gmail.com', '2016-06-05 17:56:22', 'MET GRAPHDATA', 0),
(58, 'gigateun@gmail.com', '2016-06-05 18:40:12', 'test', 0),
(63, 'gigateun@gmail.com', '2016-06-06 15:01:24', 'test2', 0),
(64, 'gigateun@gmail.com', '2016-06-06 15:02:17', 'Lege periode', 0),
(68, 'takkiemon@gmail.com', '2016-06-06 15:40:52', 'My Salsa', 0),
(88, 'pad8hva@gmail.com', '2016-06-06 18:15:18', 'Mijn periode', 1),
(89, 'gigateun@gmail.com', '2016-06-06 21:11:38', 'Vier categorieën', 0),
(94, 'teun.c.mathijssen@gmail.com', '2016-06-07 12:51:19', 'Mijn periode', 1),
(95, 'gigateun@gmail.com', '2016-06-07 12:53:10', 'Vijf categorieën', 0),
(96, 'gigateun@gmail.com', '2016-06-07 12:55:50', 'Mijn periode', 1),
(104, 'misharigot@gmail.com', '2016-06-07 23:30:52', 'Thema Mens & Natuur', 0),
(105, 'takkiemon@gmail.com', '2016-06-07 23:46:36', 'My Band', 0),
(106, 'takkiemon@gmail.com', '2016-06-07 23:49:32', 'My Waifu', 0),
(107, 'takkiemon@gmail.com', '2016-06-07 23:51:36', 'a;lsdkfjpqoweiur.z,xcmvhg', 0),
(108, 'takkiemon@gmail.com', '2016-06-08 05:27:40', 'Mijn periode234', 1),
(109, 'misharigot@gmail.com', '2016-06-08 12:40:16', 'Thema Cultuur', 0),
(110, 'misharigot@gmail.com', '2016-06-08 12:43:01', 'Thema Time & Space', 0),
(111, 'misharigot@gmail.com', '2016-06-08 12:46:53', 'Thema Techniek', 0),
(112, 'misharigot@gmail.com', '2016-06-08 14:02:50', 'Mijn periode', 1),
(113, 'damiengroot@gmail.com', '2016-06-08 14:45:22', 'yursyiuyfgdjk', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Question`
--

CREATE TABLE `Question` (
  `id` int(11) NOT NULL,
  `idcategory` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Question`
--

INSERT INTO `Question` (`id`, `idcategory`, `description`) VALUES
(1, 1, 'Zien wat er nodig is en daar iets mee doen'),
(2, 1, 'Zelf aan het werk'),
(3, 1, 'Hulp vragen (op school of thuis)'),
(4, 2, 'Inleveren'),
(5, 2, 'Op tijd komen'),
(6, 2, 'Eigen gedrag'),
(7, 2, 'Voor een taak'),
(8, 2, 'Verantwoordelijk voor een groep of geheel'),
(9, 2, 'Werken aan actiepunten'),
(10, 3, 'Op school'),
(11, 3, 'Thuis'),
(12, 3, 'Communiceren over afspraken');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `User`
--

CREATE TABLE `User` (
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `familyName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `givenName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` text COLLATE utf8_unicode_ci,
  `level` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `User`
--

INSERT INTO `User` (`email`, `id`, `familyName`, `givenName`, `name`, `gender`, `locale`, `picture`, `level`) VALUES
('damiengroot@gmail.com', '104407297875818514360', 'Groot', 'Damiën', 'Damiën Groot', 'male', 'en', 'https://lh3.googleusercontent.com/-4iXhmpNVSHo/AAAAAAAAAAI/AAAAAAAAKQA/IBMOSXGlLHs/photo.jpg', 1),
('gigateun@gmail.com', '114486978899632980717', 'Mathijssen', 'Teun', 'Teun Mathijssen', 'male', 'en', 'https://lh4.googleusercontent.com/-jYRMhMLXxXE/AAAAAAAAAAI/AAAAAAAAAf0/S8nBUjeWkgM/photo.jpg', 1),
('marnixgames@outlook.com', '113839777307173147479', 'Langedijk', 'Marnix', 'Marnix Langedijk', NULL, 'nl', 'https://lh6.googleusercontent.com/-JNFOgQgtNc8/AAAAAAAAAAI/AAAAAAAAAAo/LGdbGC-jic8/photo.jpg', 1),
('misharigot@gmail.com', '100840832240088755313', 'R', 'Misha', 'Misha R', NULL, 'en', 'https://lh6.googleusercontent.com/-aTzaTm_Yc5w/AAAAAAAAAAI/AAAAAAAAAH4/uwf3bqBYM04/photo.jpg', 1),
('pad8hva@gmail.com', '106196019053184356271', '8', 'Pad', 'Pad 8', NULL, 'en', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 2),
('takkiemon@gmail.com', '118320493184266030301', 'Wong', 'Tak Man', 'Tak Man Wong', 'male', 'en-GB', 'https://lh4.googleusercontent.com/-jE3bPjWD2WI/AAAAAAAAAAI/AAAAAAAAACU/PY4tE80RurQ/photo.jpg', 1),
('teun.c.mathijssen@gmail.com', '113867948727023783161', 'Mathijssen', 'Teun', 'Teun Mathijssen', NULL, 'en', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Form_History`
--
ALTER TABLE `Form_History`
  ADD PRIMARY KEY (`email`,`datetime`),
  ADD KEY `idx_period_id` (`period_id`);

--
-- Indexen voor tabel `Gradation`
--
ALTER TABLE `Gradation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_gradationlevel_idquestion` (`gradationlevel`,`idquestion`),
  ADD KEY `fk_question_gradation` (`idquestion`);

--
-- Indexen voor tabel `Period`
--
ALTER TABLE `Period`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idx_period_email` (`email`);

--
-- Indexen voor tabel `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_idcategory` (`idcategory`);

--
-- Indexen voor tabel `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `Gradation`
--
ALTER TABLE `Gradation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT voor een tabel `Period`
--
ALTER TABLE `Period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT voor een tabel `Question`
--
ALTER TABLE `Question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Form_History`
--
ALTER TABLE `Form_History`
  ADD CONSTRAINT `fk_period_form_history` FOREIGN KEY (`period_id`) REFERENCES `Period` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_form_history` FOREIGN KEY (`email`) REFERENCES `User` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Gradation`
--
ALTER TABLE `Gradation`
  ADD CONSTRAINT `fk_question_gradation` FOREIGN KEY (`idquestion`) REFERENCES `Question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Period`
--
ALTER TABLE `Period`
  ADD CONSTRAINT `fk_user_period` FOREIGN KEY (`email`) REFERENCES `User` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Question`
--
ALTER TABLE `Question`
  ADD CONSTRAINT `fk_category_question` FOREIGN KEY (`idcategory`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
