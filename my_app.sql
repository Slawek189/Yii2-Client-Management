-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 11, 2026 at 10:13 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_app`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `client_list`
--

CREATE TABLE `client_list` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `email`, `first_name`, `last_name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(6, 'jan@example.com', 'Janek', 'Kowalski', NULL, NULL, NULL, NULL),
(8, 'aa@aa.pl', 'asdas', 'asfasf', NULL, 1781204720, NULL, 45),
(9, 'asd@kol.pl', 'asdas', 'asdasd', NULL, NULL, NULL, NULL),
(12, 'test@test.pl', 'teset', 'terfsdf', 1781204622, 1781204622, 45, 45),
(13, 'aa@aa.pl', 'asdasd', 'asdasdf', 1781206444, 1781206444, 49, 49),
(14, 'asd@as.pl', 'asdas', 'asdasd', 1781207707, 1781207707, 18, 18),
(15, 'sdf@asd.pl', 'asdasfgh', 'dgfdhdf', 1781208134, 1781208134, 52, 52);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `editor_requests`
--

CREATE TABLE `editor_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `admin_comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `editor_requests`
--

INSERT INTO `editor_requests` (`id`, `user_id`, `request_date`, `status`, `admin_comment`) VALUES
(3, 19, '2025-01-06 17:08:10', 'approved', NULL),
(4, 23, '2025-01-06 17:34:37', 'approved', 'Zaakceptowany '),
(5, 25, '2025-01-06 17:38:16', 'approved', NULL),
(6, 26, '2025-01-06 17:40:07', 'approved', NULL),
(7, 27, '2025-01-06 17:50:50', 'approved', 'OK'),
(8, 28, '2025-01-06 17:56:58', 'approved', NULL),
(9, 31, '2025-01-06 18:17:44', 'approved', NULL),
(10, 33, '2025-01-06 19:08:38', 'approved', 'Zaakceptowano '),
(11, 35, '2025-01-06 19:18:12', 'pending', NULL),
(12, 37, '2025-01-06 19:28:36', 'pending', NULL),
(13, 38, '2025-01-06 19:30:35', 'pending', NULL),
(14, 39, '2025-01-12 10:56:56', 'pending', NULL),
(15, 40, '2025-11-30 13:31:21', 'pending', NULL),
(19, 51, '2026-06-11 19:55:45', 'pending', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','editor','viewer') NOT NULL DEFAULT 'viewer',
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `username`, `password`, `role`, `security_question`, `security_answer`, `registration_date`) VALUES
(15, 'fff', '$2y$10$Z4zlvaqh35EQpjfir1.yv.A4OhHRUBexEp/BKdsgTTmWvC001jeR6', 'viewer', 'Jaki jest twój ulubiony kolor?', '$2y$10$wDOTSUc7iqK/crCIMOqsFeahxiChvkza8JGAUS4coQEHDJPlnvciq', '2025-01-06 19:33:22'),
(16, 'ggg', '$2y$10$rmVv4ZKk//8yt3FoB9oU9u0dHbVDQJijTC7hFuNq08eNHQwDTjTBW', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$sfPvSR8OJ0E/gCtmmd4FiOtyfrp0AkGOiZ/FSosBvEQWeolIDMPRW', '2025-01-06 19:33:22'),
(18, 'admin', '$2y$10$dATK6hfD7T/txDpSuvwd0OP5peh3kYGy3.scn/EDqikrecdt3ykyG', 'admin', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$RRR8c2Y1cQEcx3vTy8sHcuGMafP6LtIEDpLSjuRbgGbUcfsiZpNCG', '2025-01-06 19:33:22'),
(19, 'ccc', '$2y$10$n/b6119XKcx3chdyyxomS.AFpiHI0FkBtdp7JJ6Fyq4EIgTiFGm5a', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$pgtEglkVOs8pYLB/KUdhAur.r08Li6amHOa0PsAT5hqfudGYCWXLG', '2025-01-06 19:33:22'),
(20, 'ddd', '$2y$10$V6Mvs95hIX3wRovbGdwPiOnghqsOql.Aba3yCbgwDd3i050SXQOdq', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$YmXFU0umv2F8ylbnvlfkG.ZLxkEGc064Wl8FUNlvCOYv1vw0f9Fwy', '2025-01-06 19:33:22'),
(21, 'hhh', '$2y$10$7B7vWBQB17rc8ssChxJH0e4jTfwaKOM1rkd2xWFbmglNYEoULz9O.', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$DLByH1MpzdW1GSKANpwMIOginIM5HY1804Nv0dOfYea5HnRQsjsaa', '2025-01-06 19:33:22'),
(22, 'iii', '$2y$10$fLywAtBpj8PkR3x.YZQsw.oBTeDO3S8FrXpSAzFs8DAJT5EXHh5b.', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$r2abmyGjqrvr0.DzXGyH7.spJ/Qs/5.YDBuwqymTwscO1P84mf4QO', '2025-01-06 19:33:22'),
(23, 'jjj', '$2y$10$iBfBQPFpxnnIoGUfGPlvAux1ygK6K3i3VzM3boNNW8rLos3Y5PgYW', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$aU1MWWUSPjFobJ5juqXyMedY/AUyVwu/dHKTIPvWiai0BZOiUas0W', '2025-01-06 19:33:22'),
(24, 'kkk', '$2y$10$hgaqRNx5sd8H6kGxmBPTS.jf/gnVk/Aw7ujLpvStGBqOToeLkdQ9a', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$HX5HYRtzDzE/D7CTkqAKi.4Ef1V.XATnBhGCpu3aOeEhN5KU3oCBu', '2025-01-06 19:33:22'),
(25, 'lll', '$2y$10$aKxf61d9tma6A83HwhlvGudBmoiqnAE6NgAvFSUSih64L3UDVvRt6', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$vnd70cv3T2DXWomHjdSIfuwuk.E3HdY7XmjXQDQZa63c4IppmFeTe', '2025-01-06 19:33:22'),
(26, 'ooo', '$2y$10$SEdAo70iuYmiTVWRsHpDYOjtox8Jnu0eaEsCuFWZy8kQMNCWmZkrK', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$ySdva4l3iX9JOyibxrgJ9uTmcw5YudhJSZ2iqRVa6RvuvWw9v64Aq', '2025-01-06 19:33:22'),
(27, 'ppp', '$2y$10$bKb4oFvomaAmhvNLX.AtPezgW75VHZueHI.I1byBuGp.roRoF6sFy', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$/gppSNVhLqALSzGB7P.fyuw6vILwVm0PsAw67ozoR2JE66JNc.RGa', '2025-01-06 19:33:22'),
(28, 'rrr', '$2y$10$0ZsE7F16fa0z5THrLoue1ejDiFeuCNIoFCKDQqhJw/MNLrDosIba6', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$f7Xhf4V9rrRFIGZHwxpS3ej7J3yJSGs6Q2XTlQxqmxB0SqHayp6Mm', '2025-01-06 19:33:22'),
(29, 'qqq', '$2y$10$OBnLi3DbKGCeJE5RgnzRQuyjlxVQpN0hOGctX9HxEqVgcxf7yMy1.', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$h9rEOT89OTCTuWw.mLTCH.2UGypm0E.ynrPkXYENpgEgBPlnmbrMK', '2025-01-06 19:33:22'),
(30, 'zzz', '$2y$10$4puk40CJdfX6FEgCM38cdOzkUkhXTSnzLJhvfGXHk5WXigE0415TK', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$m2wCOKltHxQmMAoS13n6YenP2K0.f1lUY61D87WLjaYZbNAD29wU2', '2025-01-06 19:33:22'),
(31, 'xxx', '$2y$10$cdH76y4idX3Xk.V/MsFU2uGQxZ.dTcNZx2.Rh10aZDdxTum3ozE7.', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$G.1S0Jaxt1cCvPVyAjOzuu3XOOXGU8UcarJak1VOyOB.9FJAc/OP6', '2025-01-06 19:33:22'),
(32, '111', '$2y$10$NVRfrcSCZRjiR0piQAsjRew0SzltEj4uaFCH9/Ap93cJ2e29j.c6G', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$9dI54/lvmoVsD4XfQLu3/O2GfREGYVWmhs2fk69L.xn1exD9oZ4sK', '2025-01-06 20:08:26'),
(33, '222', '$2y$10$7cSVV/ks0gsrVF.nXa6l8uCLWTke/0ucRvNIdrv2KJz/WcLfpjWm6', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$UkPdb0dyuPmFLOb0i3XrYOMO7jLhG6y2Z/PjxAvpon2w1Qp7ADuqa', '2025-01-06 20:08:38'),
(34, '333', '$2y$10$LIvB4Rb1Dsqkwq3LNW4KNOerPGjXj8lXLEVqaQudFvefC7jwLPo0O', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$UYSfmFpPR6fNrCXAg6wFDup.rERjsJ6CL.YRPkvW2mYPKrM4wSdzy', '2025-01-06 20:17:57'),
(35, '444', '$2y$10$rOmTSBQrpejP49LNopXQSekN6JTw4vei0LYxsSDMdvJ111UiUgSN6', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$kZekm8W2ufn984jp9RfxeeRLoV0FqtOAbaJaGvUdtSU3/f80ASDHy', '2025-01-06 20:18:12'),
(36, '555', '$2y$10$/UpSn3muIcTVc1gw3HkF/.7vTyptCCMRIzJXhSvAgEMj8VZ7sWdE.', 'viewer', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$NafntK3E5yXXSa32Y5/vROCf7wk8rK.T40v10nKcLRUiWRikrtP6K', '2025-01-06 20:28:20'),
(37, '666', '$2y$10$GfaQEy1O1bvV/48O03pntu5wj93kW/G4A0PTERuB5383k1u1WwAoW', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$Gr7BOWlAfhb/Yc/K8T4k4e/XZ3.m3w.ccYkXcpvNijLo9O3iU7anC', '2025-01-06 20:28:36'),
(38, '777', '$2y$10$khmRpLk0/u1GybvznpPQa.FnW94WvfX29zreFf/dlZVtB0OXQ/3uK', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$.mRLhr1XJTHfDbIU7lun5OMl2Vp2c5/hNK59yq9op/EaacM0XqVgy', '2025-01-06 20:30:35'),
(39, '888', '$2y$10$kJNpYKTx64MlPpRmGJjx2O13jS7FDCDckcPkPPrlqgXxhWJ3p0Cr6', 'editor', 'Jakie jest imię twojego pierwszego zwierzaka?', '$2y$10$mUgCRgcoHNRpYvqhGLRwSeVXkwJiJF3OKn7KLCVz5MY40gH1.DsN6', '2025-01-12 11:56:56'),
(40, 'aaa', '$2y$10$4yFculDwB.Ie3PuS2v8xYevcGDrhGcK22c.JVVG1S8iBnNoRqgHg2', 'viewer', 'Jaki jest twój ulubiony kolor?', '$2y$10$oOIGtsOAu9/L5AfmAz59suBT9UO9U5L8J0.omfec338nG4fJpMONO', '2025-11-30 14:31:21'),
(50, '1234', '$2y$10$aJXV.2dYB8z0ChixhB.tkeMP.MubaEBVmUf6AqNh5i7hhnCF0oGpy', 'viewer', '1234', '$2y$10$funmlo3es1.AgPsM6r0CTuv8Lv0.gdshPcOuSF127zPn5H1fV0qGy', '2026-06-11 21:50:34'),
(51, 'Widz', '$2y$10$NnPSwDntsq7AR8StAe3v5OUyjXZ./KBj/taFgNA1gqZ.X8/VDACyC', 'viewer', 'Kto?', '$2y$10$JQojYyD5NpBjSlpRAb64PeKDz1AC9o2LG0aEJN/JafeFE/0hV9CXi', '2026-06-11 21:54:42'),
(52, 'Edytor', '$2y$10$AFc4b02ZNT0bci.PJgm/jeocvNrmAz/iFGPDKTJI8LO679yJcQzUG', 'editor', 'Kto?', '$2y$10$BPwGmzDPF.gei5/WXv3Zk.9TNyWURvkn5cOEhSFHxYHm.TD5dKuYy', '2026-06-11 22:01:19'),
(53, 'Admin2', '$2y$10$ePUQ4oyxqgjisX8KM9W/WehhFs5Bs9gfzIxpSMA5/ft0FjxW45CHS', 'admin', 'Kto?', '$2y$10$kzE8px4t0SVBGVy4b7BtiOgd1FGRb6uPQOdNH/KCwXwsxnU.wTARy', '2026-06-11 22:01:43');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `editor_requests`
--
ALTER TABLE `editor_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`status`),
  ADD KEY `idx_status` (`status`);

--
-- Indeksy dla tabeli `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `editor_requests`
--
ALTER TABLE `editor_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `editor_requests`
--
ALTER TABLE `editor_requests`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
