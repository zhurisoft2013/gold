-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 11 月 01 日 14:49
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `gold`
--

-- --------------------------------------------------------

--
-- 表的结构 `my_log`
--

CREATE TABLE IF NOT EXISTS `my_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL COMMENT '操作用户id',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '操作用户名',
  `log_time` int(11) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `log_ip` char(15) NOT NULL DEFAULT '' COMMENT '操作ip',
  `module` varchar(20) NOT NULL DEFAULT '',
  `controller` varchar(20) NOT NULL DEFAULT '',
  `action` varchar(20) NOT NULL DEFAULT '',
  `event` varchar(60) NOT NULL DEFAULT '',
  `auditing` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `my_log`
--

INSERT INTO `my_log` (`id`, `userid`, `username`, `log_time`, `log_ip`, `module`, `controller`, `action`, `event`, `auditing`) VALUES
(1, 23, 'abc', 1414852139, '0.0.0.0', 'abc', 'cd', 'ed', '用户登录', '失败:用户不存在:'),
(2, 0, 'ad', 1414852197, '0.0.0.0', 'Admin', 'Login', 'check', '用户登录', '失败:用户不存在:ad');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
