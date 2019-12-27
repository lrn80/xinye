-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2019-03-21 20:49:38
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
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` varchar(60) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `email` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'email账号',
  `create_time` int(11) NOT NULL COMMENT '更新时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) NOT NULL COMMENT '删除时间',
  `last_login_ip` varchar(12) COLLATE utf8_bin NOT NULL COMMENT '最后登录ip',
  `last_login_time` int(11) NOT NULL COMMENT '最后登录时间',
  `login_times` int(11) NOT NULL COMMENT '登录次数',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态值表示是否启用（1表示启用，0表示禁止，2表示删除）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `create_time`, `update_time`, `delete_time`, `last_login_ip`, `last_login_time`, `login_times`, `status`) VALUES
(1, 'rootroot', 'fcea920f7412b5da7be0cf42b8c93759', '415813765@qq.com', 1, 1553085249, 1552725903, '127.0.0.1', 1, 1, 1),
(19, 'user', 'e10adc3949ba59abbe56e057f20f883e', '415813765@qq.com', 1552652766, 1552985431, 0, '127.0.0.1', 1553143492, 47, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
