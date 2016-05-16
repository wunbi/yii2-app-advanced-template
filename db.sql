-- phpMyAdmin SQL Dump
-- version 4.6.0-rc2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2016 at 06:51 AM
-- Server version: 5.5.46
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `advanced-template`
--
CREATE DATABASE IF NOT EXISTS `advanced-template` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `advanced-template`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL COMMENT '編號',
  `username` varchar(50) NOT NULL COMMENT '帳號',
  `password` varchar(40) NOT NULL COMMENT '密碼',
  `name` varchar(80) NOT NULL COMMENT '名稱',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '啟用狀態',
  `role` int(1) NOT NULL DEFAULT '1' COMMENT '1: 主管理員 2: 副管理員',
  `modtime` int(10) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理者帳號';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `status`, `role`, `modtime`, `createtime`) VALUES
(1, 'rockie.lin.tw@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '落雞零', 1, 1, 1457495630, 1300000000),
(2, 'aa@aa.aa', 'e10adc3949ba59abbe56e057f20f883e', '副帳號1', 1, 2, 1458859085, 1458859085),
(3, 'bb@bb.bb', 'e10adc3949ba59abbe56e057f20f883e', '副帳號2', 1, 3, 1458859108, 1458859108);

-- --------------------------------------------------------

--
-- Table structure for table `announce`
--

CREATE TABLE `announce` (
  `id` int(10) NOT NULL COMMENT 'ID',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '啟用狀態',
  `title` varchar(255) NOT NULL COMMENT '標題',
  `content` longtext NOT NULL COMMENT '內文',
  `image` varchar(255) DEFAULT NULL COMMENT AS `圖片`,
  `keyword` longtext COMMENT '關鍵字',
  `start_time` int(10) NOT NULL COMMENT '開始時間',
  `end_time` int(10) NOT NULL COMMENT '結束時間',
  `modtime` int(10) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announce`
--

INSERT INTO `announce` (`id`, `status`, `title`, `content`, `image`, `keyword`, `start_time`, `end_time`, `modtime`, `createtime`) VALUES
(1, 1, 'title', '<p>test</p><p>lalala</p><p><img src="http://common.domain.com/uploads/announce/56f46a4ba4674.jpg"></p>', 'http://common.domain.com/uploads/announce/1458858583.jpg', 'titletestlalalahttp://common.domain.com/uploads/announce/1458858583.jpg', 1462204800, 1490716800, 1458858583, 1458858583);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('1', '1', 1457495630),
('2', '2', 1458859085),
('3', '3', 1458859108);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('1', 1, '主帳號', NULL, NULL, 1441195655, 1441195655),
('2', 1, '副帳號1', NULL, NULL, 1441195655, 1441195655),
('3', 1, '副帳號2', NULL, NULL, 1441195655, 1441195655),
('announce', 2, '資訊發佈', NULL, NULL, 1435339282, 1435339282),
('member', 2, '會員管理', NULL, NULL, 1435339282, 1435339282),
('permission', 2, '權限管理', NULL, NULL, 1435339282, 1435339282),
('user', 2, '後台帳號管理', NULL, NULL, 1435339282, 1435339282);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('1', 'announce'),
('2', 'announce'),
('1', 'member'),
('2', 'member'),
('3', 'member'),
('1', 'permission'),
('1', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_check_codes`
--

CREATE TABLE `email_check_codes` (
  `id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `check_code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'email',
  `other` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Email驗證欄碼';

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(10) NOT NULL COMMENT 'ID',
  `social_type` varchar(10) NOT NULL DEFAULT 'email' COMMENT '帳號類型',
  `username` varchar(255) NOT NULL COMMENT '帳號',
  `password` varchar(40) NOT NULL COMMENT '密碼',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `name` varchar(100) NOT NULL COMMENT '真實姓名',
  `status` int(1) NOT NULL COMMENT '0:停用 1:Email未認證 2:已認證',
  `modtime` int(10) DEFAULT NULL COMMENT AS `最後修改`,
  `createtime` int(100) DEFAULT NULL COMMENT AS `建立時間`
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `social_type`, `username`, `password`, `email`, `name`, `status`, `modtime`, `createtime`) VALUES
(1, 'email', 'rockie.lin.tw@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'rockie.lin.tw@gmail.com', '林落雞', 2, 1458858955, 1450000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `modtime` (`modtime`),
  ADD KEY `start_time` (`start_time`),
  ADD KEY `end_time` (`end_time`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `email_check_codes`
--
ALTER TABLE `email_check_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkCode` (`check_code`),
  ADD KEY `type` (`type`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`),
  ADD KEY `email` (`email`),
  ADD KEY `name` (`name`),
  ADD KEY `status` (`status`),
  ADD KEY `social_type` (`social_type`),
  ADD KEY `createtime` (`createtime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '編號', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `announce`
--
ALTER TABLE `announce`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_check_codes`
--
ALTER TABLE `email_check_codes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
