-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2023 at 12:32 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `convert`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `content` longtext NOT NULL,
  `author` text NOT NULL,
  `quote` text NOT NULL,
  `category` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `meta_title` text NOT NULL,
  `meta_author` text NOT NULL,
  `meta_description` longtext NOT NULL,
  `key_words` text NOT NULL,
  `url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `comment` text NOT NULL,
  `ip_address` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `compress_data`
--

DROP TABLE IF EXISTS `compress_data`;
CREATE TABLE IF NOT EXISTS `compress_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `title` text NOT NULL,
  `file_type` text NOT NULL,
  `accept` text NOT NULL,
  `multiple` int(11) NOT NULL,
  `type` enum('Zip','Images','PDF') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `description` text,
  `meta_title` text,
  `meta_author` text,
  `meta_description` text,
  `key_words` text,
  `url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compress_data`
--

INSERT INTO `compress_data` (`id`, `created_by`, `title`, `file_type`, `accept`, `multiple`, `type`, `status`, `description`, `meta_title`, `meta_author`, `meta_description`, `key_words`, `url`, `created_at`, `updated_at`) VALUES
(31, 1, 'ANY to ZIP converter', 'any', 'any', 1, 'Zip', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ANY to ZIP converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ANY to ZIP converter', 'any-to-zip', '2023-01-23 04:05:11', '2023-02-28 06:02:12'),
(32, 1, 'Compress Images', 'image/jpeg, image/gif, image/png', '.jpeg, .jpg, .png, .gif', 1, 'Images', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Compress Images', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Compress Images', 'compress-images', '2023-01-23 05:44:10', '2023-02-28 06:01:54'),
(33, 1, 'Compress PDF', 'application/pdf', '.pdf', 0, 'PDF', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Compress PDF', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Compress PDF', 'compress-pdf', '2023-02-25 06:51:25', '2023-02-28 06:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `convert_data`
--

DROP TABLE IF EXISTS `convert_data`;
CREATE TABLE IF NOT EXISTS `convert_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `title` text NOT NULL,
  `from` text NOT NULL,
  `to` text NOT NULL,
  `file_type` text NOT NULL,
  `accept` text NOT NULL,
  `multiple` int(11) NOT NULL,
  `type` enum('File','Url') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `description` text,
  `meta_title` text,
  `meta_author` text,
  `meta_description` text,
  `key_words` text,
  `url` text,
  `sequence` varchar(150) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convert_data`
--

INSERT INTO `convert_data` (`id`, `created_by`, `title`, `from`, `to`, `file_type`, `accept`, `multiple`, `type`, `status`, `description`, `meta_title`, `meta_author`, `meta_description`, `key_words`, `url`, `sequence`, `created_at`, `updated_at`) VALUES
(1, 1, 'PDF to PNG converter', 'pdf', 'png', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to PNG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to PNG converter', 'pdf-to-png', 'pdf', '2023-01-16 05:50:44', '2023-03-11 06:49:50'),
(2, 1, 'PDF to JPG converter', 'pdf', 'jpg', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to JPG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to JPG converter', 'pdf-to-jpg', 'pdf', '2023-01-16 05:53:26', '2023-03-11 06:49:57'),
(3, 1, 'PDF to WEBP converter', 'pdf', 'webp', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to WEBP converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to WEBP converter', 'pdf-to-webp', 'pdf', '2023-01-16 05:54:58', '2023-03-11 06:49:36'),
(4, 1, 'DOCX to PDF converter', 'docx', 'pdf', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PDF converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PDF converter', 'docx-to-pdf', 'docx', '2023-01-16 06:04:11', '2023-03-11 06:52:30'),
(5, 1, 'XLS to PDF converter', 'xlsx', 'pdf', 'application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xlsx, .xls, .csv', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XLS to PDF converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XLS to PDF converter', 'xls-to-pdf', 'xls', '2023-01-16 06:06:56', '2023-03-11 06:53:21'),
(6, 1, 'PPT to PDF converter', 'pptx', 'pdf', 'application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation', '.pptx, .ppt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PDF converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PDF converter', 'ppt-to-pdf', 'ppt', '2023-01-16 06:10:09', '2023-03-11 06:54:08'),
(7, 1, 'DOCX to PNG converter', 'docx', 'png', 'application/rtf, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx, .rtf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PNG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PNG converter', 'docx-to-png', 'docx', '2023-01-18 05:08:43', '2023-03-11 06:52:35'),
(8, 1, 'DOCX to JPG converter', 'docx', 'jpg', 'application/rtf, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx, .rtf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to JPG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to JPG converter', 'docx-to-jpg', 'docx', '2023-01-18 05:15:52', '2023-03-11 06:55:33'),
(9, 1, 'DOC to HTML converter', 'docx', 'html', 'application/rtf, application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx, .doc, .rtf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to HTML converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to HTML converter', 'doc-to-html', 'doc', '2023-01-18 05:20:04', '2023-03-11 06:55:51'),
(10, 1, 'DOC to XML converter', 'doc', 'xml', 'application/rtf, application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.oasis.opendocument.text', '.docx, .doc, .rtf, .odt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to XML converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to XML converter', 'doc-to-xml', 'doc', '2023-01-18 05:38:11', '2023-03-13 07:14:19'),
(11, 1, 'HTML to DOCX converter', 'html', 'docx', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to DOCX converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to DOCX converter', 'html-to-docx', 'html', '2023-01-18 06:07:12', '2023-03-11 06:51:50'),
(12, 1, 'HTML to XLSX converter', 'html', 'xlsx', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to XLSX converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to XLSX converter', 'html-to-xlsx', 'html', '2023-01-18 06:13:28', '2023-03-11 06:51:15'),
(13, 1, 'HTML to TXT converter', 'html', 'txt', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to TXT converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to TXT converter', 'html-to-txt', 'html', '2023-01-18 06:15:42', '2023-03-11 06:51:27'),
(14, 1, 'XML to DOCX converter', 'xml', 'docx', 'text/xml', '.xml', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XML to DOCX converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XML to DOCX converter', 'xml-to-docx', 'xml', '2023-01-18 06:27:18', '2023-03-11 06:52:56'),
(15, 1, 'CSV to JPG converter', 'csv', 'jpg', 'application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xlsx, .xls, .csv', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to JPG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to JPG converter', 'csv-to-jpg', 'csv', '2023-01-18 06:39:43', '2023-03-11 06:56:13'),
(16, 1, 'CSV to PNG converter', 'csv', 'png', 'application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xlsx, .xls, .csv', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to PNG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to PNG converter', 'csv-to-png', 'csv', '2023-01-18 06:42:09', '2023-03-11 06:56:03'),
(17, 1, 'PDF to TXT converter', 'pdf', 'txt', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to TXT converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to TXT converter', 'pdf-to-txt', 'pdf', '2023-01-18 17:09:50', '2023-03-11 06:49:43'),
(18, 1, 'HTML to PDF converter', 'html', 'pdf', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PDF converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PDF converter', 'html-to-pdf', 'html', '2023-01-18 17:21:44', '2023-03-11 06:51:41'),
(19, 1, 'HTML to PNG converter', 'html', 'png', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PNG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PNG converter', 'html-to-png', 'html', '2023-01-18 17:24:47', '2023-03-11 06:51:35'),
(20, 1, 'HTML to JPG converter', 'html', 'jpg', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to JPG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to JPG converter', 'html-to-jpg', 'html', '2023-01-18 17:27:22', '2023-03-11 06:52:45'),
(21, 1, 'ODC to PDF converter', 'odc', 'pdf', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PDF converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PDF converter', 'odc-to-pdf', 'odc', '2023-01-18 18:08:07', '2023-03-11 06:50:42'),
(22, 1, 'ODC to PNG converter', 'odc', 'png', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PNG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PNG converter', 'odc-to-png', 'odc', '2023-01-18 18:16:01', '2023-03-11 06:50:30'),
(23, 1, 'ODC to JPG converter', 'odc', 'jpg', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to JPG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to JPG converter', 'odc-to-jpg', 'odc', '2023-01-18 18:18:47', '2023-03-11 06:50:46'),
(24, 1, 'ODC to WEBP converter', 'odc', 'webp', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to WEBP converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to WEBP converter', 'odc-to-webp', 'odc', '2023-01-18 18:21:49', '2023-03-11 06:54:42'),
(25, 1, 'PPT to PNG converter', 'pptx', 'png', 'application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation', '.pptx, .ppt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PNG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PNG converter', 'ppt-to-png', 'ppt', '2023-01-18 18:30:19', '2023-03-11 06:54:01'),
(26, 1, 'PPT to JPG converter', 'pptx', 'jpg', 'application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation', '.pptx, .ppt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to JPG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to JPG converter', 'ppt-to-jpg', 'ppt', '2023-01-18 18:32:18', '2023-03-11 06:54:28'),
(27, 1, 'WEB to PDF converter', 'web', 'pdf', 'url', 'Website URL', 0, 'Url', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PDF converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PDF converter', 'web-to-pdf', 'web', '2023-01-22 07:30:20', '2023-03-11 06:53:37'),
(28, 1, 'WEB to PNG converter', 'web', 'png', 'url', 'Website URL', 0, 'Url', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PNG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PNG converter', 'web-to-png', 'web', '2023-01-22 08:41:27', '2023-03-11 06:53:32'),
(29, 1, 'WEB to JPG converter', 'web', 'jpg', 'url', 'Website URL', 0, 'Url', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to JPG converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to JPG converter', 'web-to-jpg', 'web', '2023-01-22 08:42:58', '2023-03-11 06:53:44'),
(31, 1, 'Images to PDF converter', 'images', 'pdf', 'image/*', '.jpg, .jpeg, .png, .gif, .webp, .heic, .svg, .psd', 1, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Images to PDF converter', 'Nityanand Jha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Images to PDF converter', 'images-to-pdf', 'images', '2023-02-19 07:44:56', '2023-03-11 15:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(350) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_images`
--

DROP TABLE IF EXISTS `multiple_images`;
CREATE TABLE IF NOT EXISTS `multiple_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` text NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `received_data`
--

DROP TABLE IF EXISTS `received_data`;
CREATE TABLE IF NOT EXISTS `received_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` text NOT NULL,
  `browser` text NOT NULL,
  `file_name` text NOT NULL,
  `file_type` text NOT NULL,
  `file_content` text NOT NULL,
  `converted_to` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `send_data`
--

DROP TABLE IF EXISTS `send_data`;
CREATE TABLE IF NOT EXISTS `send_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `received_data_id` int(11) NOT NULL,
  `output_data` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `api_secret` text NOT NULL,
  `api_key` text NOT NULL,
  `total_used` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `created_by`, `email`, `password`, `api_secret`, `api_key`, `total_used`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'jha@yopmail.com', 'jha@1234567', 'ffM8EMb8ZuJeCArJ', '888330177', 104, 1, '2023-01-02 03:35:00', '2023-03-15 05:25:37'),
(2, 1, 'jhaconvertx1@yopmail.com', 'jha@1234567', 'GdblOPBTJHu514KZ', '738813340', 0, 1, '2023-02-17 01:28:59', '2023-02-17 01:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_by`, `role`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'admin', 'Nityanand Jha', 'jha@gmail.com', 'a346bc80408d9b2a5063fd1bddb20e2d5586ec30', 1, '2023-01-17 15:40:02', '2023-01-17 15:40:02'),
(2, 1, 'user', 'Nityanand Jha', 'jha@yopmail.com', 'a346bc80408d9b2a5063fd1bddb20e2d5586ec30', 1, '2023-01-17 15:40:02', '2023-01-18 04:48:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
