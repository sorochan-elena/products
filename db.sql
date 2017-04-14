-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 14 2017 г., 10:45
-- Версия сервера: 5.5.48-log
-- Версия PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `netpeak_catalog`
--
CREATE DATABASE IF NOT EXISTS `netpeak_catalog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `netpeak_catalog`;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text,
  `price` double(16,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `products`
--

TRUNCATE TABLE `products`;
--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `status`) VALUES
(16, 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5', 'Build interactive, data-driven websites with the potent combination of open-source technologies and web standards, even if you only have basic HTML knowledge. With this popular hands-on guide, you&#39;ll tackle dynamic web programming with the help of today&#39;s core technologies: PHP, MySQL, JavaScript, jQuery, CSS, and HTML5.', 27.83, 2),
(17, 'PHP for the Web: Visual QuickStart Guide (5th Edition)', 'PHP is experiencing a renaissance, though it may be difficult to tell with all of the outdated PHP tutorials online. With this practical guide, you’ll learn how PHP has become a full-featured, mature language with object-orientation, namespaces, and a growing collection of reusable component libraries.', 24.05, 1),
(18, 'PhP: Learn PHP Programming Quick & Easy', 'Are you new to computer programming or just want to brush up on some skills? If so, this book is a wonderful resource for you. PHP is one of the most widely used open source, server side programming languages. If you are interested in getting started with programming and want to get some basic knowledge of the language, then this book is for you! Famous websites, including Facebook & Yahoo are powered by PHP. It is, in a sense, the language of the world!', 15.96, 2),
(19, 'PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition)', 'It hasn''t taken Web developers long to discover that when it comes to creating dynamic, database-driven Web sites, MySQL and PHP provide a winning open-source combination. Add this book to the mix, and there''s no limit to the powerful, interactive Web sites that developers can create.', 32.74, 1),
(20, 'PHP and MySQL Web Development (5th Edition) (Developer''s Library)', 'PHP and MySQL are popular open-source technologies that are ideal for quickly developing database-driven Web applications. PHP is a powerful scripting language designed to enable developers to create highly featured Web applications quickly, and MySQL is a fast, reliable database that integrates well with PHP and is suited for dynamic Internet-based applications.', 33.31, 1),
(21, 'PHP Objects, Patterns, and Practice', 'Aided by three key elements: object fundamentals, design principles, and best practices, you''ll learn how to develop elegant and rock solid systems using PHP.\n\nThe 5th edition of this popular book has been fully updated for PHP 7, including replacing the PEAR package manager with Composer, and new material on Vagrant and PHP standards. It provides a solid grounding in PHP''s support for objects, it builds on this foundation to instill core principles of software design and then covers the tools and practices needed to develop, test and deploy robust code.', 46.95, 1),
(22, 'PHP Cookbook: Solutions & Examples for PHP Programmers', 'Want to understand a certain PHP programming technique? Or learn how to accomplish a particular task? This cookbook is the first place to look. With more than 350 code-rich recipes revised for PHP 5.4 and 5.5, this third edition provides updated solutions for generating dynamic web content—everything from using basic data types to querying databases, and from calling RESTful APIs to testing and securing your site.', 43.78, 1),
(23, 'Head First PHP & MySQL: A Brain-Friendly Guide', 'If you''re ready to create web pages more complex than those you can build with HTML and CSS, Head First PHP & MySQL is the ultimate learning guide to building dynamic, database-driven websites using PHP and MySQL. Packed with real-world examples, this book teaches you all the essentials of server-side programming, from the fundamentals of PHP and MySQL coding to advanced topics such as form validation, session IDs, cookies, database queries and joins, file I/O operations, content management, and more.', 27.83, 1),
(24, 'Programming PHP: Creating Dynamic Web Pages', 'This updated edition teaches everything you need to know to create effective web applications with the latest features in PHP 5.x. You’ll start with the big picture and then dive into language syntax, programming techniques, and other details, using examples that illustrate both correct usage and common idioms.', 31.86, 1),
(25, 'Laravel 5 Essentials', 'About This Book\nCreate a dynamic web application that can read and write data to a database\nImprove your PHP skills and develop a new outlook on solving programming issues\nA step-by-step guide that covers the different steps involved in creating a complete Laravel application in an easy-to-understand manner', 29.97, 1),
(26, 'PhpStorm Cookbook', 'About This Book\nLearn to plan, construct, test, and run your applications with ease using PHPStorm\nImprove the speed and efficiency of web application development using the PHPStorm IDE\nCollaborate tasks across time and space using CVS repository and learn expert level coding standards inspection for PHP in PHPStorm', 44.45, 1),
(27, 'PHP & MySQL: Novice to Ninja: The Easy Way to Build Your Own Database Driven Website', 'PHP & MySQL: Novice to Ninja is a practical hands-on guide to learning all the tools, principles and techniques needed to build a fully-functional database-driven web site using PHP & MySQL.\n\n\n\n\nThis book covers everything from installing PHP & MySQL under Windows, Linux, and Mac through to building a live web-based content management system.', 24.57, 1),
(28, 'Learning PHP: A Gentle Introduction to the Web''s Most Popular Languag', 'If you want to get started with PHP, this book is essential. Author David Sklar (PHP Cookbook) guides you through aspects of the language you need to build dynamic server-side websites. By exploring features of PHP 5.x and the exciting enhancements in the latest release, PHP 7, you’ll learn how to work with web servers, browsers, databases, and web services. End-of-chapter exercises help you make the lessons stick.', 23.84, 1),
(29, 'PHP & MySQL: Novice to Ninja: Get Up to Speed With PHP the Easy Way', 'PHP & MySQL: Novice to Ninja, 6th Edition is a hands-on guide to learning all the tools, principles, and techniques needed to build a fully functional application using PHP & MySQL. Comprehensively updated to cover PHP 7 and modern best practice, this practical and fun book covers everything from installing PHP and MySQL through to creating a complete online content management system.', 22.83, 1),
(30, 'JavaScript and JQuery: Interactive Front-End Web Development', 'Basic programming concepts - assuming no prior knowledge of programming beyond an ability to create a web page using HTML & CSS\nCore elements of the JavaScript language - so you can learn how to write your own scripts from scratch\njQuery - which will allow you to simplify the process of writing scripts (this is introduced half-way through the book once you have a solid understanding of JavaScript)\nHow to recreate techniques you will have seen on other web sites such as sliders, content filters, form validation, updating content using Ajax, and much more (these examples demonstrate writing your own scripts from scratch and how the theory you have learned is put into practice).', 23.00, 1),
(31, 'JavaScript: The Definitive Guide: Activate Your Web Pages (Definitive Guides)', 'Since 1996, JavaScript: The Definitive Guide has been the bible for JavaScript programmers—a programmer''s guide and comprehensive reference to the core language and to the client-side JavaScript APIs defined by web browsers.\n\nThe 6th edition covers HTML5 and ECMAScript 5. Many chapters have been completely rewritten to bring them in line with today''s best web development practices. New chapters in this edition document jQuery and server side JavaScript. It''s recommended for experienced programmers who want to learn the programming language of the Web, and for current JavaScript programmers who want to master it.', 35.56, 1),
(32, 'JavaScript: The Good Parts', 'Most programming languages contain good and bad parts, but JavaScript has more than its share of the bad, having been developed and released in a hurry before it could be refined. This authoritative book scrapes away these bad features to reveal a subset of JavaScript that''s more reliable, readable, and maintainable than the language as a whole—a subset you can use to create truly extensible and efficient code.', 21.87, 1),
(33, 'Head First JavaScript Programming: A Brain-Friendly Guide', 'This brain-friendly guide teaches you everything from JavaScript language fundamentals to advanced topics, including objects, functions, and the browser’s document object model. You won’t just be reading—you’ll be playing games, solving puzzles, pondering mysteries, and interacting with JavaScript in ways you never imagined. And you’ll write real code, lots of it, so you can start building your own web applications. Prepare to open your mind as you learn (and nail) key topics including:\n\nThe inner details of JavaScript\nHow JavaScript works with the browser\nThe secrets of JavaScript types\nUsing arrays\nThe power of functions\nHow to work with objects\nMaking use of prototypes\nUnderstanding closures\nWriting and testing applications', 38.00, 1),
(34, 'Eloquent JavaScript: A Modern Introduction to Programming', 'JavaScript lies at the heart of almost every modern web application, from social apps to the newest browser-based games. Though simple for beginners to pick up and play with, JavaScript is a flexible, complex language that you can use to build full-scale applications.\n\nEloquent JavaScript, 2nd Edition dives deep into the JavaScript language to show you how to write beautiful, effective code. Author Marijn Haverbeke immerses you in example code from the start, while exercises and full-chapter projects give you hands-on experience with writing your own programs.', 32.23, 3),
(35, 'Mastering JavaScript', 'JavaScript is a high-level, dynamic, untyped, lightweight, and interpreted programming language. Along with HTML and CSS, it is one of the three essential technologies of World Wide Web content production, and is an open source and cross-platform technology. The majority of websites employ JavaScript, and it is well supported by all modern web browsers without plugins. However, the JavaScript landscape has changed dramatically in recent years, and you need to adapt to the new world of JavaScript that people now expect. Mastering modern JavaScript techniques and the toolchain are essential to develop web-scale applications.', 43.35, 1),
(36, 'Test Recovery Product', '123', 1.00, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
