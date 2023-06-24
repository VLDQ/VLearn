-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 07:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrolments`
--

CREATE TABLE `enrolments` (
  `enrolmentId` int(11) UNSIGNED NOT NULL,
  `studentId` int(11) UNSIGNED NOT NULL,
  `subjectId` int(11) UNSIGNED NOT NULL,
  `enrolmentDate` date NOT NULL,
  `enrolmentIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrolments`
--

INSERT INTO `enrolments` (`enrolmentId`, `studentId`, `subjectId`, `enrolmentDate`, `enrolmentIsActive`) VALUES
(1, 1, 1, '2023-04-21', 1),
(2, 2, 1, '2023-04-21', 1),
(3, 3, 1, '2023-04-21', 1),
(4, 7, 1, '2023-04-21', 1),
(5, 9, 1, '2023-04-21', 1),
(6, 11, 1, '2023-04-21', 1),
(7, 13, 1, '2023-04-21', 1),
(8, 15, 1, '2023-04-21', 1),
(9, 17, 1, '2023-04-21', 1),
(10, 19, 1, '2023-04-21', 1),
(11, 2, 3, '2023-04-22', 1),
(12, 3, 3, '2023-04-22', 1),
(13, 7, 3, '2023-04-22', 1),
(14, 9, 3, '2023-04-22', 1),
(15, 11, 3, '2023-04-22', 1),
(16, 13, 3, '2023-04-22', 1),
(17, 15, 3, '2023-04-22', 1),
(18, 17, 3, '2023-04-22', 1),
(19, 19, 3, '2023-04-22', 1),
(20, 3, 5, '2023-04-23', 1),
(21, 7, 5, '2023-04-23', 1),
(22, 9, 5, '2023-04-23', 1),
(23, 11, 5, '2023-04-23', 1),
(24, 13, 5, '2023-04-23', 1),
(25, 15, 5, '2023-04-23', 1),
(26, 17, 5, '2023-04-23', 1),
(27, 19, 5, '2023-04-23', 1),
(28, 4, 2, '2023-04-24', 1),
(29, 5, 2, '2023-04-24', 1),
(30, 6, 2, '2023-04-24', 1),
(31, 8, 2, '2023-04-24', 1),
(32, 10, 2, '2023-04-24', 1),
(33, 12, 2, '2023-04-24', 1),
(34, 14, 2, '2023-04-24', 1),
(35, 16, 2, '2023-04-24', 1),
(36, 18, 2, '2023-04-24', 1),
(37, 20, 2, '2023-04-24', 1),
(38, 5, 4, '2023-04-25', 1),
(39, 6, 4, '2023-04-25', 1),
(40, 8, 4, '2023-04-25', 1),
(41, 10, 4, '2023-04-25', 1),
(42, 12, 4, '2023-04-25', 1),
(43, 14, 4, '2023-04-25', 1),
(44, 16, 4, '2023-04-25', 1),
(45, 18, 4, '2023-04-25', 1),
(46, 20, 4, '2023-04-25', 1),
(47, 6, 6, '2023-04-26', 1),
(48, 8, 6, '2023-04-26', 1),
(49, 10, 6, '2023-04-26', 1),
(50, 12, 6, '2023-04-26', 1),
(51, 14, 6, '2023-04-26', 1),
(52, 16, 6, '2023-04-26', 1),
(53, 18, 6, '2023-04-26', 1),
(54, 20, 6, '2023-04-26', 1),
(55, 8, 7, '2023-04-27', 1),
(56, 10, 7, '2023-04-27', 1),
(57, 12, 7, '2023-04-27', 1),
(58, 14, 7, '2023-04-27', 1),
(59, 16, 7, '2023-04-27', 1),
(60, 18, 7, '2023-04-27', 1),
(61, 20, 7, '2023-04-27', 1),
(62, 10, 8, '2023-04-28', 1),
(63, 12, 8, '2023-04-28', 1),
(64, 14, 8, '2023-04-28', 1),
(65, 16, 8, '2023-04-28', 1),
(66, 18, 8, '2023-04-28', 1),
(67, 20, 8, '2023-04-28', 1),
(68, 12, 9, '2023-04-29', 1),
(69, 14, 9, '2023-04-29', 1),
(70, 16, 9, '2023-04-29', 1),
(71, 18, 9, '2023-04-29', 1),
(72, 20, 9, '2023-04-29', 1),
(73, 14, 10, '2023-04-30', 1),
(74, 16, 10, '2023-04-30', 1),
(75, 18, 10, '2023-04-30', 1),
(76, 20, 10, '2023-04-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedbackId` int(11) UNSIGNED NOT NULL,
  `studentId` int(11) UNSIGNED NOT NULL,
  `topicId` int(11) UNSIGNED NOT NULL,
  `feedbackObtained` text NOT NULL,
  `feedbackUpdateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedbackId`, `studentId`, `topicId`, `feedbackObtained`, `feedbackUpdateDate`) VALUES
(1, 1, 1, 'That’s a really great start, keep up your good work!', '2023-05-27'),
(2, 2, 1, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(3, 3, 1, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(4, 7, 1, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(5, 9, 1, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(6, 11, 1, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(7, 13, 1, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(8, 15, 1, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(9, 17, 1, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(10, 19, 1, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(11, 4, 2, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(12, 5, 2, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(13, 6, 2, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(14, 8, 2, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(15, 10, 2, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(16, 12, 2, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(17, 14, 2, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(18, 16, 2, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(19, 18, 2, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(20, 20, 2, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(21, 2, 3, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(22, 3, 3, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(23, 7, 3, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(24, 9, 3, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(25, 11, 3, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(26, 13, 3, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(27, 15, 3, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(28, 17, 3, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(29, 19, 3, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(30, 5, 4, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(31, 6, 4, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(32, 8, 4, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(33, 10, 4, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(34, 12, 4, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(35, 14, 4, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(36, 16, 4, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(37, 18, 4, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(38, 20, 4, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(39, 3, 5, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(40, 7, 5, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(41, 9, 5, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(42, 11, 5, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(43, 13, 5, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(44, 15, 5, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(45, 17, 5, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(46, 19, 5, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(47, 6, 6, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(48, 8, 6, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(49, 10, 6, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(50, 12, 6, 'That’s a really great start, keep up your good work!', '2023-05-28'),
(51, 14, 6, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(52, 16, 6, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(53, 18, 6, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(54, 20, 6, 'You’re on the right track, but you’re not quite there yet.', '2023-05-28'),
(55, 8, 7, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(56, 8, 8, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(57, 10, 7, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(58, 10, 8, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(59, 12, 7, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(60, 12, 8, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(61, 14, 7, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(62, 14, 8, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(63, 16, 7, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(64, 16, 8, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(65, 18, 7, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(66, 18, 8, 'You’re on the right track, but you’re not quite there yet.', '2023-05-29'),
(67, 20, 7, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(68, 20, 8, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(69, 10, 9, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(70, 10, 10, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(71, 12, 9, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(72, 12, 10, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(73, 14, 9, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(74, 14, 10, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(75, 16, 9, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(76, 16, 10, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(77, 18, 9, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(78, 18, 10, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(79, 20, 9, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(80, 20, 10, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(81, 12, 11, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(82, 12, 12, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(83, 14, 11, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(84, 14, 12, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(85, 16, 11, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(86, 16, 12, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(87, 18, 11, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(88, 18, 12, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(89, 20, 11, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(90, 20, 12, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(91, 14, 13, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(92, 14, 14, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(93, 16, 13, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(94, 16, 14, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(95, 18, 13, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(96, 18, 14, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(97, 20, 13, 'That’s a really great start, keep up your good work!', '2023-05-29'),
(98, 20, 14, 'That’s a really great start, keep up your good work!', '2023-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `markId` int(11) UNSIGNED NOT NULL,
  `studentId` int(11) UNSIGNED NOT NULL,
  `topicId` int(11) UNSIGNED NOT NULL,
  `markObtained` float NOT NULL,
  `markUpdateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`markId`, `studentId`, `topicId`, `markObtained`, `markUpdateDate`) VALUES
(1, 1, 1, 8, '2023-05-27'),
(2, 2, 1, 8.3, '2023-05-28'),
(3, 3, 1, 8.5, '2023-05-28'),
(4, 7, 1, 8.8, '2023-05-28'),
(5, 9, 1, 6, '2023-05-28'),
(6, 11, 1, 6, '2023-05-28'),
(7, 13, 1, 6.4, '2023-05-28'),
(8, 15, 1, 5, '2023-05-28'),
(9, 17, 1, 5.4, '2023-05-28'),
(10, 19, 1, 4.5, '2023-05-28'),
(11, 4, 2, 42, '2023-05-28'),
(12, 5, 2, 32, '2023-05-28'),
(13, 6, 2, 30, '2023-05-28'),
(14, 8, 2, 27, '2023-05-28'),
(15, 10, 2, 26, '2023-05-28'),
(16, 12, 2, 25, '2023-05-28'),
(17, 14, 2, 24, '2023-05-28'),
(18, 16, 2, 24, '2023-05-28'),
(19, 18, 2, 23, '2023-05-28'),
(20, 20, 2, 23, '2023-05-28'),
(21, 2, 3, 16, '2023-05-28'),
(22, 3, 3, 17, '2023-05-28'),
(23, 7, 3, 17.8, '2023-05-28'),
(24, 9, 3, 12, '2023-05-28'),
(25, 11, 3, 12.4, '2023-05-28'),
(26, 13, 3, 12.8, '2023-05-28'),
(27, 15, 3, 10, '2023-05-28'),
(28, 17, 3, 10.8, '2023-05-28'),
(29, 19, 3, 9.8, '2023-05-28'),
(30, 5, 4, 17.6, '2023-05-28'),
(31, 6, 4, 12.8, '2023-05-28'),
(32, 8, 4, 12, '2023-05-28'),
(33, 10, 4, 10.8, '2023-05-28'),
(34, 12, 4, 10.4, '2023-05-28'),
(35, 14, 4, 10, '2023-05-28'),
(36, 16, 4, 9.8, '2023-05-28'),
(37, 18, 4, 9.4, '2023-05-28'),
(38, 20, 4, 9, '2023-05-28'),
(39, 3, 5, 8, '2023-05-28'),
(40, 7, 5, 8.5, '2023-05-28'),
(41, 9, 5, 8.9, '2023-05-28'),
(42, 11, 5, 6, '2023-05-28'),
(43, 13, 5, 6.4, '2023-05-28'),
(44, 15, 5, 5, '2023-05-28'),
(45, 17, 5, 5.4, '2023-05-28'),
(46, 19, 5, 4.7, '2023-05-28'),
(47, 6, 6, 8.5, '2023-05-28'),
(48, 8, 6, 6.4, '2023-05-28'),
(49, 10, 6, 6, '2023-05-28'),
(50, 12, 6, 5.4, '2023-05-28'),
(51, 14, 6, 5, '2023-05-28'),
(52, 16, 6, 4.9, '2023-05-28'),
(53, 18, 6, 4.7, '2023-05-28'),
(54, 20, 6, 4.5, '2023-05-28'),
(55, 8, 7, 20, '2023-05-29'),
(56, 8, 8, 20, '2023-05-29'),
(57, 10, 7, 21.5, '2023-05-29'),
(58, 10, 8, 21, '2023-05-29'),
(59, 12, 7, 22.5, '2023-05-29'),
(60, 12, 8, 22, '2023-05-29'),
(61, 14, 7, 15, '2023-05-29'),
(62, 14, 8, 15, '2023-05-29'),
(63, 16, 7, 16, '2023-05-29'),
(64, 16, 8, 16, '2023-05-29'),
(65, 18, 7, 13, '2023-05-29'),
(66, 18, 8, 12, '2023-05-29'),
(67, 20, 7, 14, '2023-05-29'),
(68, 20, 8, 13, '2023-05-29'),
(69, 10, 9, 24.5, '2023-05-29'),
(70, 10, 10, 23, '2023-05-29'),
(71, 12, 9, 21.5, '2023-05-29'),
(72, 12, 10, 21, '2023-05-29'),
(73, 14, 9, 19.5, '2023-05-29'),
(74, 14, 10, 18, '2023-05-29'),
(75, 16, 9, 17.5, '2023-05-29'),
(76, 16, 10, 16, '2023-05-29'),
(77, 18, 9, 16, '2023-05-29'),
(78, 18, 10, 15, '2023-05-29'),
(79, 20, 9, 14.5, '2023-05-29'),
(80, 20, 10, 14, '2023-05-29'),
(81, 12, 11, 21.5, '2023-05-29'),
(82, 12, 12, 21, '2023-05-29'),
(83, 14, 11, 19.5, '2023-05-29'),
(84, 14, 12, 18, '2023-05-29'),
(85, 16, 11, 17.5, '2023-05-29'),
(86, 16, 12, 16, '2023-05-29'),
(87, 18, 11, 16, '2023-05-29'),
(88, 18, 12, 15, '2023-05-29'),
(89, 20, 11, 14.5, '2023-05-29'),
(90, 20, 12, 14, '2023-05-29'),
(91, 14, 13, 19.5, '2023-05-29'),
(92, 14, 14, 18, '2023-05-29'),
(93, 16, 13, 17.5, '2023-05-29'),
(94, 16, 14, 16, '2023-05-29'),
(95, 18, 13, 16, '2023-05-29'),
(96, 18, 14, 15, '2023-05-29'),
(97, 20, 13, 14.5, '2023-05-29'),
(98, 20, 14, 14, '2023-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `overallgrades`
--

CREATE TABLE `overallgrades` (
  `overallGradeId` int(11) UNSIGNED NOT NULL,
  `studentId` int(11) UNSIGNED NOT NULL,
  `subjectId` int(11) UNSIGNED NOT NULL,
  `overallGradeObtained` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `overallgrades`
--

INSERT INTO `overallgrades` (`overallGradeId`, `studentId`, `subjectId`, `overallGradeObtained`) VALUES
(1, 1, 1, 'A'),
(2, 2, 1, 'A'),
(3, 2, 3, 'A'),
(4, 3, 1, 'A'),
(5, 3, 3, 'A'),
(6, 3, 5, 'A'),
(7, 7, 1, 'A'),
(8, 7, 3, 'A'),
(9, 7, 5, 'A'),
(10, 9, 1, 'B'),
(11, 9, 3, 'B'),
(12, 9, 5, 'A'),
(13, 11, 1, 'B'),
(14, 11, 3, 'B'),
(15, 11, 5, 'B'),
(16, 13, 1, 'B'),
(17, 13, 3, 'B'),
(18, 13, 5, 'B'),
(19, 15, 1, 'C'),
(20, 15, 3, 'C'),
(21, 15, 5, 'C'),
(22, 17, 1, 'C'),
(23, 17, 3, 'C'),
(24, 17, 5, 'C'),
(25, 19, 1, 'D'),
(26, 19, 3, 'D'),
(27, 19, 5, 'D'),
(28, 4, 2, 'A'),
(29, 5, 2, 'B'),
(30, 5, 4, 'A'),
(31, 6, 2, 'B'),
(32, 6, 4, 'B'),
(33, 6, 6, 'A'),
(34, 8, 2, 'C'),
(35, 8, 4, 'B'),
(36, 8, 6, 'B'),
(37, 8, 7, 'A'),
(38, 10, 2, 'C'),
(39, 10, 4, 'C'),
(40, 10, 6, 'B'),
(41, 10, 7, 'A'),
(42, 10, 8, 'A+'),
(43, 12, 2, 'C'),
(44, 12, 4, 'C'),
(45, 12, 6, 'C'),
(46, 12, 7, 'A'),
(47, 12, 8, 'A'),
(48, 12, 9, 'A'),
(49, 14, 2, 'D'),
(50, 14, 4, 'C'),
(51, 14, 6, 'C'),
(52, 14, 7, 'B'),
(53, 14, 8, 'A-'),
(54, 14, 9, 'A-'),
(55, 14, 10, 'A-'),
(56, 16, 2, 'D'),
(57, 16, 4, 'D'),
(58, 16, 6, 'D'),
(59, 16, 7, 'B'),
(60, 16, 8, 'B+'),
(61, 16, 9, 'B+'),
(62, 16, 10, 'B+'),
(63, 18, 2, 'D'),
(64, 18, 4, 'D'),
(65, 18, 6, 'D'),
(66, 18, 7, 'C'),
(67, 18, 8, 'B'),
(68, 18, 9, 'B'),
(69, 18, 10, 'B'),
(70, 20, 2, 'D'),
(71, 20, 4, 'D'),
(72, 20, 6, 'D'),
(73, 20, 7, 'C'),
(74, 20, 8, 'C+'),
(75, 20, 9, 'C+'),
(76, 20, 10, 'C+');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` int(11) UNSIGNED NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `studentEmail` varchar(100) NOT NULL,
  `studentPassword` varchar(100) NOT NULL,
  `studentEducationLevel` varchar(20) NOT NULL,
  `studentStage` varchar(20) NOT NULL,
  `studentSubjects` varchar(100) NOT NULL,
  `studentRegistrationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentId`, `studentName`, `studentEmail`, `studentPassword`, `studentEducationLevel`, `studentStage`, `studentSubjects`, `studentRegistrationDate`) VALUES
(1, 'Manuel Nah', 'manuelnah1@gmail.com', '25d00ea2121fbf205ee657efc72e9e74', 'Primary', 'Standard 1', 'English ', '2023-04-01'),
(2, 'Thomas Man', 'thomasman2@gmail.com', '4a427fd5766a30e3c90818268062bcee', 'Primary', 'Standard 1', 'English Mathematics ', '2023-04-01'),
(3, 'Joshua Kang', 'joshuakang3@gmail.com', 'b6cb45971579b33e104bef7dca088c29', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-02'),
(4, 'Kingsley Chuah', 'kingsleychuah1@gmail.com', '4650bd0a331c03916943cd8b88c55289', 'Secondary', 'Form 5', 'English ', '2023-04-02'),
(5, 'Serge Goh', 'sergegoh2@gmail.com', '1fe0e97c76b379c3084d8db89885df5c', 'Secondary', 'Form 5', 'English Mathematics ', '2023-04-03'),
(6, 'Leroy Sim', 'leroysim3@gmail.com', '36664a764376097a9f89f3a150905c0a', 'Secondary', 'Form 5', 'English Mathematics Science ', '2023-04-03'),
(7, 'Jamal Mah', 'jamalmah4@gmail.com', '35fc96ae6f59a9e5fb3721f105455f8f', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-04'),
(8, 'Leon Gan', 'leongan4@gmail.com', '8929d87d87d38fc3e99f6997b3d1513f', 'Secondary', 'Form 5', 'English Mathematics Science Additional_Mathematics ', '2023-04-04'),
(9, 'Sadio Mak', 'sadiomak5@gmail.com', '474e4a601c5c6621a30cb9dad9f60595', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-05'),
(10, 'Sven Ung', 'svenung5@gmail.com', 'edb6090da2268cfd608c274b35cebe75', 'Secondary', 'Form 5', 'English Mathematics Science Additional_Mathematics Biology ', '2023-04-05'),
(11, 'Ryan Guo', 'ryanguo6@gmail.com', 'b9707a5a463b87e85bc850767b122404', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-06'),
(12, 'Joao Chew', 'joaochew6@gmail.com', '34022fb4b5c0d3a29eca0df3eae47dd6', 'Secondary', 'Form 5', 'English Mathematics Science Additional_Mathematics Biology Chemistry ', '2023-04-06'),
(13, 'Alphonso Deng', 'alphonsodeng7@gmail.com', 'd9c124760c1be907137693619d2775a1', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-07'),
(14, 'Dayot Uh', 'dayotuh7@gmail.com', 'de5056b2b5f7894a63e0d13c228ae250', 'Secondary', 'Form 5', 'English Mathematics Science Additional_Mathematics Biology Chemistry Physics ', '2023-04-07'),
(15, 'Matthijs Lim', 'matthijslim8@gmail.com', '5b687ba874b30ea94da28622fc1a1158', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-08'),
(16, 'Noussair Meng', 'noussairmeng8@gmail.com', '1e85eb6604216f6e02686fdff2554384', 'Secondary', 'Form 5', 'English Mathematics Science Additional_Mathematics Biology Chemistry Physics ', '2023-04-08'),
(17, 'Lucas Ho', 'lucasho9@gmail.com', '1983bc874936425a54632264ce30f108', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-09'),
(18, 'Benjamin Phang', 'benjaminphang9@gmail.com', 'cf2671ff68561d4f99444fb0abc49364', 'Secondary', 'Form 5', 'English Mathematics Science Additional_Mathematics Biology Chemistry Physics ', '2023-04-09'),
(19, 'Philipp Loh', 'philipploh0@gmail.com', '47f033fa4b65fd7ecd31c1f5f4509395', 'Primary', 'Standard 1', 'English Mathematics Science ', '2023-04-10'),
(20, 'Bastian Soh', 'bastiansoh0@gmail.com', '7f4bec6e47e3f7299e9f4387b7676652', 'Secondary', 'Form 5', 'English Mathematics Science Additional_Mathematics Biology Chemistry Physics ', '2023-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectId` int(11) UNSIGNED NOT NULL,
  `tutorId` int(11) UNSIGNED NOT NULL,
  `subjectName` varchar(100) NOT NULL,
  `subjectCode` varchar(20) NOT NULL,
  `subjectEducationLevel` varchar(20) NOT NULL,
  `subjectStage` varchar(20) NOT NULL,
  `subjectCategory` varchar(30) NOT NULL,
  `subjectSession` varchar(20) NOT NULL,
  `subjectCreationDate` date NOT NULL,
  `subjectShowOrHide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectId`, `tutorId`, `subjectName`, `subjectCode`, `subjectEducationLevel`, `subjectStage`, `subjectCategory`, `subjectSession`, `subjectCreationDate`, `subjectShowOrHide`) VALUES
(1, 1, 'English', 'ENG_S1_M', 'Primary', 'Standard 1', 'English', 'Morning', '2023-04-11', 1),
(2, 1, 'English', 'ENG_F5_A', 'Secondary', 'Form 5', 'English', 'Afternoon', '2023-04-12', 1),
(3, 2, 'Mathematics', 'MAT_S1_M', 'Primary', 'Standard 1', 'Mathematics', 'Morning', '2023-04-13', 1),
(4, 2, 'Mathematics', 'MAT_F5_A', 'Secondary', 'Form 5', 'Mathematics', 'Afternoon', '2023-04-14', 1),
(5, 3, 'Science', 'SCI_S1_M', 'Primary', 'Standard 1', 'Science', 'Morning', '2023-04-15', 1),
(6, 3, 'Science', 'SCI_F5_A', 'Secondary', 'Form 5', 'Science', 'Afternoon', '2023-04-16', 1),
(7, 4, 'Additional Mathematics', 'AMA_F5_N', 'Secondary', 'Form 5', 'Additional Mathematics', 'Night', '2023-04-17', 1),
(8, 5, 'Biology', 'BIO_F5_N', 'Secondary', 'Form 5', 'Biology', 'Night', '2023-04-18', 1),
(9, 6, 'Chemistry', 'CHE_F5_N', 'Secondary', 'Form 5', 'Chemistry', 'Night', '2023-04-19', 1),
(10, 7, 'Physics', 'PHY_F5_N', 'Secondary', 'Form 5', 'Physics', 'Night', '2023-04-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topicId` int(11) UNSIGNED NOT NULL,
  `subjectId` int(11) UNSIGNED NOT NULL,
  `topicName` varchar(100) NOT NULL,
  `topicDescription` text NOT NULL,
  `topicNotes` varchar(255) NOT NULL,
  `topicHomework` varchar(255) NOT NULL,
  `topicMarksAvailable` float NOT NULL,
  `topicCreationDate` date NOT NULL,
  `topicShowOrHide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topicId`, `subjectId`, `topicName`, `topicDescription`, `topicNotes`, `topicHomework`, `topicMarksAvailable`, `topicCreationDate`, `topicShowOrHide`) VALUES
(1, 1, 'Topic 1: Grammar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 10, '2023-05-01', 1),
(2, 2, 'Topic 1: Essay Writing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 50, '2023-05-01', 1),
(3, 3, 'Topic 1: Addition', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 20, '2023-05-01', 1),
(4, 4, 'Topic 1: Variation', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 20, '2023-05-01', 1),
(5, 5, 'Topic 1: Scientific Skills', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 10, '2023-05-01', 1),
(6, 6, 'Topic 1: Microorganisms', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 10, '2023-05-01', 1),
(7, 7, 'Topic 1: Arithmetic Progressions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-01', 1),
(8, 7, 'Topic 2: Geometric Progressions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-10', 1),
(9, 8, 'Topic 1: Transport', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-10', 1),
(10, 8, 'Topic 2: Locomotion & Support', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-10', 1),
(11, 9, 'Topic 1: Rate of Reaction', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-10', 1),
(12, 9, 'Topic 2: Carbon Compounds', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-10', 1),
(13, 10, 'Topic 1: Force & Motion', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-10', 1),
(14, 10, 'Topic 2: Pressure', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lobortis tortor mi, in vehicula enim lobortis in. Quisque suscipit et velit non malesuada. Nulla facilisi. Integer efficitur iaculis commodo. Nunc laoreet pulvinar est, eget tempor dui tincidunt et. Phasellus id lectus ultrices mi varius volutpat id vitae ex. Vestibulum eget tortor nulla. Donec eget condimentum eros, eu fringilla nulla. Pellentesque rutrum, tellus nec maximus porta, dolor nunc tristique sem, eget imperdiet erat ex non purus. Fusce dolor arcu, venenatis eu augue sed, ullamcorper rhoncus mauris. Aenean tincidunt consectetur neque eu faucibus. In id ipsum vulputate, pretium lorem eu, rhoncus velit.', 'https://drive.google.com/drive/folders/1UOP7vTJi9FPC6x5Oo8NMdq3b4wsfzPAn?usp=share_link', 'https://drive.google.com/drive/folders/1EbljhCsL0Hw72xTroCmFwHWl4WBKyQyI?usp=share_link', 25, '2023-05-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `tutorId` int(11) UNSIGNED NOT NULL,
  `tutorName` varchar(100) NOT NULL,
  `tutorEmail` varchar(100) NOT NULL,
  `tutorPassword` varchar(100) NOT NULL,
  `tutorSpeciality` varchar(30) NOT NULL,
  `tutorStartDate` date NOT NULL,
  `tutorIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`tutorId`, `tutorName`, `tutorEmail`, `tutorPassword`, `tutorSpeciality`, `tutorStartDate`, `tutorIsActive`) VALUES
(1, 'Thomas Tuchel', 'thomastuchel1@gmail.com', 'd384d66fbad0457e79238f48f3b9cc5e', 'English', '2023-03-20', 1),
(2, 'Pep Guardiola', 'pepguardiola2@gmail.com', 'd32cae49a9c15b14b8e87ff00b74db9d', 'Mathematics', '2023-03-20', 1),
(3, 'Jurgen Klopp', 'jurgenklopp3@gmail.com', 'b6cb45971579b33e104bef7dca088c29', 'Science', '2023-03-20', 1),
(4, 'Jupp Heynckes', 'juppheynckes4@gmail.com', '34219ffe3b2628ef395cbbbcd63f0a44', 'Additional Mathematics', '2023-03-31', 1),
(5, 'Joachim Low', 'joachimlow5@gmail.com', '414d6621dc630e95e1f27d6586684249', 'Biology', '2023-03-31', 1),
(6, 'Carlo Ancelotti', 'carloancelotti6@gmail.com', 'f0d3a84b376d36d1d1a1ffa89293704f', 'Chemistry', '2023-03-31', 1),
(7, 'Hansi Flick', 'hansiflick7@gmail.com', '2b1a69c8a5071a8cb03977e26601358e', 'Physics', '2023-03-31', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD PRIMARY KEY (`enrolmentId`),
  ADD KEY `fk_studentId` (`studentId`),
  ADD KEY `fk_subjectId` (`subjectId`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedbackId`),
  ADD KEY `fk_studentId_f` (`studentId`),
  ADD KEY `fk_topicId_f` (`topicId`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`markId`),
  ADD KEY `fk_studentId_m` (`studentId`),
  ADD KEY `fk_topicId_m` (`topicId`);

--
-- Indexes for table `overallgrades`
--
ALTER TABLE `overallgrades`
  ADD PRIMARY KEY (`overallGradeId`),
  ADD KEY `fk_studentId_o` (`studentId`),
  ADD KEY `fk_subjectId_o` (`subjectId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectId`),
  ADD KEY `fk_tutorId` (`tutorId`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topicId`),
  ADD KEY `fk_subjectId_t` (`subjectId`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`tutorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrolments`
--
ALTER TABLE `enrolments`
  MODIFY `enrolmentId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedbackId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `markId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `overallgrades`
--
ALTER TABLE `overallgrades`
  MODIFY `overallGradeId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topicId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `tutorId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD CONSTRAINT `fk_studentId` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`),
  ADD CONSTRAINT `fk_subjectId` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`);

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `fk_studentId_f` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`),
  ADD CONSTRAINT `fk_topicId_f` FOREIGN KEY (`topicId`) REFERENCES `topics` (`topicId`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `fk_studentId_m` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`),
  ADD CONSTRAINT `fk_topicId_m` FOREIGN KEY (`topicId`) REFERENCES `topics` (`topicId`);

--
-- Constraints for table `overallgrades`
--
ALTER TABLE `overallgrades`
  ADD CONSTRAINT `fk_studentId_o` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`),
  ADD CONSTRAINT `fk_subjectId_o` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_tutorId` FOREIGN KEY (`tutorId`) REFERENCES `tutors` (`tutorId`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_subjectId_t` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
