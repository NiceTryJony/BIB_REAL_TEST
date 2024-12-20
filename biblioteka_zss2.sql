SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `konkursy`;
CREATE TABLE `konkursy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(255) NOT NULL,
  `tresc` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `nazwy_zdjec` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `konkursy` (`id`, `tytul`, `tresc`, `data`, `nazwy_zdjec`) VALUES
(1,'Dyplom za udział w konkursie','Uczniowie 2B Ts dostali dyplomy za udział w konkursie szkolno/gminowym gdzie otrymali 1 miejsce','2024-11-10','Img'),
(2,'Dyplom niewiadomo za co','Nie pytaj o co tu chodzi. Musisz wiedzieć o tym','2024-11-12','');

DROP TABLE IF EXISTS `konta`;
CREATE TABLE `konta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa_uzytkownika` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `uprawnienia` enum('admin','pelne','akt') DEFAULT 'akt',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `konta` (`id`, `nazwa_uzytkownika`, `haslo`, `uprawnienia`) VALUES
(1,'gol.daniel30@gmail.com','$2y$10$mfCKqwGqj6iJGHjKcFwyh.0jLHalVJ6pRw60Ki6eFcF81j82.RrR2','admin');

DROP TABLE IF EXISTS `ksiazki`;
CREATE TABLE `ksiazki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zdj` text NOT NULL,
  `tytul` text NOT NULL,
  `autor` text NOT NULL,
  `wydawnictwo` text NOT NULL,
  `typ` text NOT NULL,
  `ilosc` int(11) NOT NULL,
  `krotki_opis` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `wycieczki`;
CREATE TABLE `wycieczki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(255) NOT NULL,
  `tresc` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `nazwy_zdjec` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;


DROP TABLE IF EXISTS `wyjazdy`;
CREATE TABLE `wyjazdy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(255) NOT NULL,
  `tresc` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `nazwy_zdjec` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
-- 2024-12-17 06:26:17
