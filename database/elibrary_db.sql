-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 11:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elibrary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books_tb`
--

CREATE TABLE `books_tb` (
  `book_id` int(224) NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `book_brief` text NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `book_genre` varchar(50) NOT NULL,
  `book_isbn` int(100) NOT NULL,
  `book_quantity` int(100) NOT NULL,
  `published_date` varchar(100) NOT NULL,
  `cover_image` varchar(100) NOT NULL,
  `book_status` varchar(50) NOT NULL DEFAULT 'Available',
  `uploaded_by` varchar(100) NOT NULL,
  `book_file` varchar(200) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `recycle` varchar(10) NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books_tb`
--

INSERT INTO `books_tb` (`book_id`, `book_title`, `book_brief`, `book_author`, `book_genre`, `book_isbn`, `book_quantity`, `published_date`, `cover_image`, `book_status`, `uploaded_by`, `book_file`, `ipaddress`, `recycle`) VALUES
(1, 'Want to Stay Alive', '', 'James Hardley Chase', 'Romance', 0, 0, 'October 15, 1945', 'want-to-stay-alive.jpg', 'Available', '1', '', '', 'False'),
(2, 'The Vulture is a Patient Bird', '', 'James Hardley Chase', 'Tragic', 0, 0, '1984', 'the-vulture.jpg', 'Available', '1', '', '', 'False'),
(3, 'Things Fall Apart', 'Things Fall Apart, first novel by Chinua Achebe, written in English and published in 1958. Things Fall Apart helped create the Nigerian literary renaissance of the 1960s.\n', 'Chinua Achebe', 'Fiction', 0, 0, 'November 14, 1983', 'things_fall_apart.png', 'Available', '1', '', '', 'False'),
(6, 'Atomic Habits ~ Little changes, Remarkable Results ', 'Packed with evidence-based strategies, Atomic Habits will teach you how to make small changes that will transform your habits and deliver amazing results.', '', 'Inspirational', 0, 0, '2025-03-07', 'Bookcover_1742549258.png', 'Available', '2', '', '127.0.0.1', 'True'),
(7, 'Atomic Habits ~ Little changes, Remarkable Results ', 'Packed with evidence-based strategies, Atomic Habits will teach you how to make small changes that will transform your habits and deliver amazing results.', 'James Clear', 'Skill Acquisition', 0, 0, '', 'Bookcover_1742549337.png', 'Borrowed', '2', '', '127.0.0.1', 'False'),
(8, 'Oliver Twice', 'Oliver Twist unromantically portrays the sordid lives of criminals and exposes the cruel treatment of the many orphans in England in the mid-19th century.', 'Charlse Deckins', 'Fiction', 0, 0, 'April 12, 1993', 'Bookcover_1742549548.jpg', 'Available', '2', '', '127.0.0.1', 'False'),
(9, 'An African Night\'s Entertainment', 'An African Night\'s Entertainment is a 1962 folktale novel by Nigerian author Cyprian Ekwensi. An African Night\'s Entertainment. Author, Cyprian Ekwensi.', 'Cyprian Egwesi', 'Fiction', 666767, 0, '2025-03-21', 'Bookcover_1742552159.jpg', 'Available', '2', '', '127.0.0.1', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `request_id` int(224) NOT NULL,
  `book_id` varchar(224) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `date_borrowed` varchar(50) NOT NULL,
  `returning_date` varchar(100) NOT NULL,
  `date_returned` varchar(50) NOT NULL,
  `borrowed_by_id` varchar(100) NOT NULL,
  `borrowed_by_name` varchar(200) NOT NULL,
  `borrow_status` varchar(40) NOT NULL DEFAULT 'Borrowed',
  `ipaddress` varchar(50) NOT NULL,
  `recycle` varchar(10) NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`request_id`, `book_id`, `book_title`, `date_borrowed`, `returning_date`, `date_returned`, `borrowed_by_id`, `borrowed_by_name`, `borrow_status`, `ipaddress`, `recycle`) VALUES
(2, '3', 'Things Fall Apart', '2025-03-20', '2025-03-31', 'Friday March 21, 2025 ~ 12:24:pm', '2', 'Ifesinachi Paschal', 'Returned', '127.0.0.1', 'False'),
(3, '1', 'Want to Stay Alive', '2025-03-20', '2025-03-31', '', '2', 'Ifesinachi Paschal', 'Pending Approval', '127.0.0.1', 'False'),
(4, '2', 'The Vulture is a Patient Bird', '2025-03-20', '2025-03-31', 'Friday March 21, 2025 ~ 12:50:pm', '2', 'Ifesinachi Paschal', 'Returned', '127.0.0.1', 'False'),
(5, '8', 'Oliver Twice', '2025-02-21', '2025-03-30', 'Friday March 21, 2025 ~ 12:23:pm', '2', 'Ifesinachi Paschal', 'Returned', '127.0.0.1', 'False'),
(6, '2', 'The Vulture is a Patient Bird', '2025-03-21', '2025-03-31', 'Friday March 21, 2025 ~ 12:50:pm', '2', 'Ifesinachi Paschal', 'Returned', '127.0.0.1', 'False'),
(7, '7', 'Atomic Habits ~ Little changes, Remarkable Results ', '2025-03-22', '2025-03-21', '', '2', 'Ifesinachi Paschal', 'Borrowed', '127.0.0.1', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(224) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `account_category` varchar(13) NOT NULL,
  `password` varchar(225) NOT NULL,
  `date_registered` varchar(100) NOT NULL,
  `ipaddress` varchar(50) NOT NULL,
  `recycle` varchar(10) NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `email`, `account_category`, `password`, `date_registered`, `ipaddress`, `recycle`) VALUES
(2, 'Ifesinachi Paschal', 'pascalworld22@gmail.com', 'User', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Wednesday March 19, 2025', '127.0.0.1', 'False'),
(3, 'Chioma Paschal', 'chiomapaschal@gmail.com', 'Administrator', 'b6d767d2f8ed5d21a44b0e5886680cb9', 'Friday March 21, 2025', '::1', 'False');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_tb`
--
ALTER TABLE `books_tb`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books_tb`
--
ALTER TABLE `books_tb`
  MODIFY `book_id` int(224) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `request_id` int(224) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(224) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
