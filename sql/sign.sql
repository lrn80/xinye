-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2019-03-21 20:49:28
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xinye`
--

-- --------------------------------------------------------

--
-- 表的结构 `sign`
--

CREATE TABLE `sign` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `sign_date` int(11) NOT NULL COMMENT '签到日期',
  `sign_time` int(11) NOT NULL COMMENT '今日签到时间',
  `create_time` int(11) NOT NULL COMMENT '创建日期',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `sign`
--

INSERT INTO `sign` (`id`, `user_id`, `sign_date`, `sign_time`, `create_time`, `update_time`, `status`) VALUES
(1, 1, 1552716600, 1525, 1, 1, 0),
(2, 1, 1552630200, 15265, 0, 0, 0),
(3, 1, 1552543800, 55200, 0, 1553172010, 0),
(4, 1, 1552371000, 1, 0, 0, 0),
(5, 1, 1552284600, 154, 0, 0, 0),
(6, 1, 1552198200, 152, 0, 0, 0),
(7, 1, 1552025400, 25, 0, 0, 0),
(8, 1, 1552898028, 15265, 0, 0, 0),
(20, 19, 1552924800, 1045, 1552997370, 1552997667, 1),
(21, 19, 1553011200, 11333, 1553075382, 1553086715, 1),
(22, 19, 1553097600, 55200, 1553144603, 1553168456, 1),
(23, 1, 1553097600, 55800, 1553170464, 1553172195, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sign`
--
ALTER TABLE `sign`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sign`
--
ALTER TABLE `sign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
