-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 22, 2023 at 04:04 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `created_by`, `title`, `image`, `content`, `author`, `quote`, `category`, `status`, `meta_title`, `meta_author`, `meta_description`, `key_words`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Convert HTML to JPG, PNG, PDF, TXT, XLSX and DOCX', '../../assets/img/blog/1679458111-HTML to JPG, PNG, PDF, TXT, XLSX and DOCX.jpg', '<p>In today&#39;s digital age, we often encounter situations where we need to convert HTML files into various formats like JPG, PNG, PDF, TXT, XLSX, and DOCX. The reasons for these conversions may vary depending on the user&#39;s requirements, but the process remains the same. In this article, we will discuss how to convert HTML files into these different formats.</p>\r\n\r\n<h2><strong>Convert HTML to JPG or PNG</strong></h2>\r\n\r\n<p>To convert an HTML file to JPG or PNG, we need to take a screenshot of the HTML file and save it in the desired format. There are different methods to take a screenshot on a computer, but the easiest way is to use the built-in Snipping Tool (for Windows) or Screenshot (for macOS) applications. Once we take the screenshot, we can save it as a JPG or PNG file using any image editing software like Adobe Photoshop, GIMP, or Paint.</p>\r\n\r\n<p>Alternatively, there are also online tools available that can convert HTML to JPG or PNG, such as HTML to Image and CloudConvert. These tools work by taking a screenshot of the HTML file on their servers and then providing a download link to the converted file.</p>\r\n\r\n<h2><strong>Convert HTML to PDF</strong></h2>\r\n\r\n<p>Converting an HTML file to PDF is a popular way to preserve the original formatting of the file and make it easily shareable. There are various ways to convert HTML to PDF, such as using a browser website like <strong>convertai.in</strong> &quot;Save as PDF&quot; feature or using a dedicated tool like <strong><em>convertai.</em></strong></p>\r\n\r\n<blockquote>\r\n<p>One of the most popular tools for converting HTML to PDF is called WeasyPrint. It is an open-source tool that uses CSS and HTML to create PDF files. WeasyPrint can be installed on Windows, macOS, and Linux systems and can be run from the command line or integrated into other applications.</p>\r\n</blockquote>\r\n\r\n<h2><strong>Convert HTML to TXT</strong></h2>\r\n\r\n<p>Converting an HTML file to plain text (TXT) is useful when we want to remove all formatting and only keep the text content. There are several ways to do this, such as using a text editor like Notepad or using an online tool like HTML to Text.</p>\r\n\r\n<p>HTML to Text is a simple online tool that converts HTML files to plain text. We need to copy and paste the HTML code into the tool&#39;s input box, and it will automatically convert it to plain text. We can then copy the plain text and save it in a TXT file using any text editor.</p>\r\n\r\n<h2><strong>Convert HTML to XLSX</strong></h2>\r\n\r\n<p>To convert an HTML file to XLSX, we need to first extract the data from the HTML file and then save it in a format that can be opened by Microsoft Excel. There are various ways to extract data from an HTML file, such as using Python libraries like Beautiful Soup or using online tools like Online HTML Table to XLSX Converter.</p>\r\n\r\n<p>Online HTML Table to XLSX Converter is a simple tool that extracts data from HTML tables and converts it into an XLSX file. We need to copy and paste the HTML table code into the tool&#39;s input box, and it will automatically convert it to an XLSX file. We can then download the XLSX file and open it in Microsoft Excel.</p>\r\n\r\n<h2><strong>Convert HTML to DOCX</strong></h2>\r\n\r\n<p>To convert an HTML file to DOCX, we need to first convert it to a Word-readable format like RTF or DOC and then save it as a DOCX file. There are various ways to convert HTML to RTF or DOC, such as using Microsoft Word&#39;s built-in &quot;Save as&quot; feature or using an online tool like <strong><em>Convertai</em></strong>.</p>\r\n\r\n<p><strong><em>Convertai</em></strong> is a popular online file conversion tool that can convert HTML files to DOCX. We need to upload the HTML file to the tool&#39;s website, select DOCX as the output format, and then click on the &quot;Convert&quot;.</p>\r\n', 'Vidyanand jha', 'Convertai is a popular online file conversion tool that can convert HTML files to DOCX. We need to upload the HTML file to the tool\'s website, select DOCX as the output format, and then click on the Convertai.', 'HTML', 1, 'Convert HTML to JPG, PNG, PDF, TXT, XLSX and DOCX', 'Convertai.in', 'In today\'s digital age, we often encounter situations where we need to convert HTML files into various formats like JPG, PNG, PDF, TXT, XLSX, and DOCX. The reasons for these conversions may vary depending on the user\'s requirements, but the process remains the same. In this article, we will discuss how to convert HTML files into these different formats.', 'Convert HTML to JPG, PNG, PDF, TXT, XLSX and DOCX', 'html-to-jpg-png-pdf-txt-xlsx-docx', '2023-03-21 22:38:31', '2023-03-22 12:39:43');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`id`, `blog_id`, `name`, `email`, `comment`, `ip_address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'RAHUL', 'darkweb.pin@gmail.com', 'You are doing an amazing job! Keep up the great work!', '2409:40c1:101e:4692:c56a:804b:2088:43c0', 1, '2023-03-21 22:43:11', '2023-03-21 22:44:15');

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
(31, 1, 'ANY to ZIP converter', 'any', 'any', 1, 'Zip', 1, 'An Any to Zip converter is a software tool that allows users to convert files of various formats to the ZIP format. The ZIP format is a popular archive format that compresses files to reduce their size and make them easier to transfer or store.\r\n<br><br>\r\nThe Any to Zip converter supports a wide range of file formats, including images, documents, audio, and video files. Some of the most commonly supported file formats include <b>JPEG, PNG, PDF, DOCX, MP3, and MP4</b>.\r\n<br><br>\r\nOne of the primary benefits of using an Any to Zip converter is the ability to reduce the size of files. <i>ZIP compression reduces the size of files by compressing data</i>, which can save disk space and reduce transfer times.', 'ANY to ZIP converter', 'convertai.in', 'One of the primary benefits of using an Any to Zip converter is the ability to reduce the size of files.By compressing data, which can save disk space.', 'ANY to ZIP converter', 'any-to-zip', '2023-01-23 04:05:11', '2023-03-22 15:53:57'),
(32, 1, 'Compress Images', 'image/jpeg, image/gif, image/png', '.jpeg, .jpg, .png, .gif', 1, 'Images', 1, 'Image compression is the process of reducing the size of an image file without significantly affecting its quality. It is a crucial technique used in various fields, including web design, digital photography, and video production. Compressed images take up less space, making them easier to store and share, without compromising on their visual appeal.\r\n<br><br>\r\nWhen compressing an image, it\'s important to consider the intended use of the image. If you\'re compressing an image for use on a website, for example, you may not need the same level of detail as you would for a printed image. In this case, lossy compression may be a better option, as it can reduce the file size while still producing an acceptable image quality.\r\n<br><br>\r\nThere are several tools and techniques available for compressing images. One of the most popular methods is to use online tools or software designed specifically for image compression. These tools use algorithms to analyze the image and compress it without affecting its visual quality. Some popular tools include <b><i>convertai.in</i></b>.', 'Compress Images', 'convertai.in', 'Image compression is the process of reducing the size of an image file without significantly affecting its quality. Compressed images take up less space.', 'Compress Images', 'compress-images', '2023-01-23 05:44:10', '2023-03-22 13:13:31'),
(33, 1, 'Compress PDF', 'application/pdf', '.pdf', 0, 'PDF', 1, 'PDF (<b><i>Portable Document Format</i></b>) files are commonly used for sharing documents, manuals, and books, among other things. However, PDF files can be quite large, making them difficult to share and store. Compressing a PDF file can help reduce its size, making it easier to send, store, and share. In this article, we will discuss how to compress PDF files.\r\n<br><br>\r\n<b><i>There are two types of PDF compression: lossless and lossy.</i></b>\r\n<br><br>\r\n<b>1. Lossless compression </b> reduces the size of a file without removing any data. This type of compression is ideal for documents that need to retain their original quality.\r\n<br><br>\r\n<b>2. Lossy compression </b> , on the other hand, reduces the file size by removing some of the data. This type of compression is suitable for documents where quality is not a primary concern, such as those containing images.', 'Compress PDF', 'convertai.in', 'Compressing a PDF file can help reduce its size, making it easier to send, store, and share. In this article, we will discuss how to compress PDF files.', 'Compress PDF', 'compress-pdf', '2023-02-25 06:51:25', '2023-03-22 14:47:51');

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
(1, 1, 'PDF to PNG converter', 'pdf', 'png', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to PNG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to PNG converter', 'pdf-to-png', 'pdf', '2023-01-16 05:50:44', '2023-03-22 13:10:18'),
(2, 1, 'PDF to JPG converter', 'pdf', 'jpg', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to JPG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to JPG converter', 'pdf-to-jpg', 'pdf', '2023-01-16 05:53:26', '2023-03-22 13:10:18'),
(3, 1, 'PDF to WEBP converter', 'pdf', 'webp', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to WEBP converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to WEBP converter', 'pdf-to-webp', 'pdf', '2023-01-16 05:54:58', '2023-03-22 13:10:18'),
(4, 1, 'DOCX to PDF converter', 'docx', 'pdf', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PDF converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PDF converter', 'docx-to-pdf', 'docx', '2023-01-16 06:04:11', '2023-03-22 13:10:18'),
(5, 1, 'XLS to PDF converter', 'xlsx', 'pdf', 'application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xlsx, .xls, .csv', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XLS to PDF converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XLS to PDF converter', 'xls-to-pdf', 'xls', '2023-01-16 06:06:56', '2023-03-22 13:10:18'),
(6, 1, 'PPT to PDF converter', 'pptx', 'pdf', 'application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation', '.pptx, .ppt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PDF converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PDF converter', 'ppt-to-pdf', 'ppt', '2023-01-16 06:10:09', '2023-03-22 13:10:18'),
(7, 1, 'DOCX to PNG converter', 'docx', 'png', 'application/rtf, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx, .rtf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PNG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to PNG converter', 'docx-to-png', 'docx', '2023-01-18 05:08:43', '2023-03-22 13:10:18'),
(8, 1, 'DOCX to JPG converter', 'docx', 'jpg', 'application/rtf, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx, .rtf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to JPG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOCX to JPG converter', 'docx-to-jpg', 'docx', '2023-01-18 05:15:52', '2023-03-22 13:10:18'),
(9, 1, 'DOC to HTML converter', 'docx', 'html', 'application/rtf, application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.docx, .doc, .rtf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to HTML converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to HTML converter', 'doc-to-html', 'doc', '2023-01-18 05:20:04', '2023-03-22 13:10:18'),
(10, 1, 'DOC to XML converter', 'doc', 'xml', 'application/rtf, application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.oasis.opendocument.text', '.docx, .doc, .rtf, .odt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to XML converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DOC to XML converter', 'doc-to-xml', 'doc', '2023-01-18 05:38:11', '2023-03-22 13:10:18'),
(11, 1, 'HTML to DOCX converter', 'html', 'docx', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to DOCX converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to DOCX converter', 'html-to-docx', 'html', '2023-01-18 06:07:12', '2023-03-22 13:10:18'),
(12, 1, 'HTML to XLSX converter', 'html', 'xlsx', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to XLSX converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to XLSX converter', 'html-to-xlsx', 'html', '2023-01-18 06:13:28', '2023-03-22 13:10:18'),
(13, 1, 'HTML to TXT converter', 'html', 'txt', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to TXT converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to TXT converter', 'html-to-txt', 'html', '2023-01-18 06:15:42', '2023-03-22 13:10:18'),
(14, 1, 'XML to DOCX converter', 'xml', 'docx', 'text/xml', '.xml', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XML to DOCX converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'XML to DOCX converter', 'xml-to-docx', 'xml', '2023-01-18 06:27:18', '2023-03-22 13:10:18'),
(15, 1, 'CSV to JPG converter', 'csv', 'jpg', 'application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xlsx, .xls, .csv', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to JPG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to JPG converter', 'csv-to-jpg', 'csv', '2023-01-18 06:39:43', '2023-03-22 13:10:18'),
(16, 1, 'CSV to PNG converter', 'csv', 'png', 'application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xlsx, .xls, .csv', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to PNG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'CSV to PNG converter', 'csv-to-png', 'csv', '2023-01-18 06:42:09', '2023-03-22 13:10:18'),
(17, 1, 'PDF to TXT converter', 'pdf', 'txt', 'application/pdf', '.pdf', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to TXT converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PDF to TXT converter', 'pdf-to-txt', 'pdf', '2023-01-18 17:09:50', '2023-03-22 13:10:18'),
(18, 1, 'HTML to PDF converter', 'html', 'pdf', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PDF converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PDF converter', 'html-to-pdf', 'html', '2023-01-18 17:21:44', '2023-03-22 13:10:18'),
(19, 1, 'HTML to PNG converter', 'html', 'png', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PNG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to PNG converter', 'html-to-png', 'html', '2023-01-18 17:24:47', '2023-03-22 13:10:18'),
(20, 1, 'HTML to JPG converter', 'html', 'jpg', 'text/html', '.html', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to JPG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'HTML to JPG converter', 'html-to-jpg', 'html', '2023-01-18 17:27:22', '2023-03-22 13:10:18'),
(21, 1, 'ODC to PDF converter', 'odc', 'pdf', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PDF converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PDF converter', 'odc-to-pdf', 'odc', '2023-01-18 18:08:07', '2023-03-22 13:10:18'),
(22, 1, 'ODC to PNG converter', 'odc', 'png', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PNG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to PNG converter', 'odc-to-png', 'odc', '2023-01-18 18:16:01', '2023-03-22 13:10:18'),
(23, 1, 'ODC to JPG converter', 'odc', 'jpg', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to JPG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to JPG converter', 'odc-to-jpg', 'odc', '2023-01-18 18:18:47', '2023-03-22 13:10:18'),
(24, 1, 'ODC to WEBP converter', 'odc', 'webp', 'application/doc, application/ms-doc, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/excel, application/vnd.ms-excel, application/x-msexcel, application/x-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet', '.docx, .doc, .pptx, .ppt, .xlsx, .xls, .odt, .ods, .odp', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to WEBP converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ODC to WEBP converter', 'odc-to-webp', 'odc', '2023-01-18 18:21:49', '2023-03-22 13:10:18'),
(25, 1, 'PPT to PNG converter', 'pptx', 'png', 'application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation', '.pptx, .ppt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PNG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to PNG converter', 'ppt-to-png', 'ppt', '2023-01-18 18:30:19', '2023-03-22 13:10:18'),
(26, 1, 'PPT to JPG converter', 'pptx', 'jpg', 'application/mspowerpoint, application/x-mspowerpoint, application/vnd.ms-powerpoint, application/powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation', '.pptx, .ppt', 0, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to JPG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'PPT to JPG converter', 'ppt-to-jpg', 'ppt', '2023-01-18 18:32:18', '2023-03-22 13:10:18'),
(27, 1, 'WEB to PDF converter', 'web', 'pdf', 'url', 'Website URL', 0, 'Url', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PDF converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PDF converter', 'web-to-pdf', 'web', '2023-01-22 07:30:20', '2023-03-22 13:10:18'),
(28, 1, 'WEB to PNG converter', 'web', 'png', 'url', 'Website URL', 0, 'Url', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PNG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to PNG converter', 'web-to-png', 'web', '2023-01-22 08:41:27', '2023-03-22 13:10:18'),
(29, 1, 'WEB to JPG converter', 'web', 'jpg', 'url', 'Website URL', 0, 'Url', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to JPG converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'WEB to JPG converter', 'web-to-jpg', 'web', '2023-01-22 08:42:58', '2023-03-22 13:10:18'),
(31, 1, 'Images to PDF converter', 'images', 'pdf', 'image/*', '.jpg, .jpeg, .png, .gif, .webp, .heic, .svg, .psd', 1, 'File', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Images to PDF converter', 'convertai.in', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Images to PDF converter', 'images-to-pdf', 'images', '2023-02-19 07:44:56', '2023-03-22 13:10:18');

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
