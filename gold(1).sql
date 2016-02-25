-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 06 月 24 日 05:37
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
CREATE DATABASE IF NOT EXISTS `gold` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gold`;

-- --------------------------------------------------------

--
-- 表的结构 `my_article`
--

CREATE TABLE IF NOT EXISTS `my_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `click` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '100' COMMENT '排序',
  `top` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  PRIMARY KEY (`id`),
  KEY `fk_my_article_my_category1_idx` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='真人图书' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_article_attachment`
--

CREATE TABLE IF NOT EXISTS `my_article_attachment` (
  `article_id` int(11) NOT NULL COMMENT '图书id',
  `attachment_id` int(11) NOT NULL COMMENT '附件id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '图片标题',
  `description` varchar(45) NOT NULL DEFAULT '' COMMENT '图片描述',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullfilename` varchar(100) NOT NULL DEFAULT '',
  `sort` int(10) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`attachment_id`,`article_id`),
  KEY `fk_my_book_has_my_attachment_my_attachment1_idx` (`attachment_id`),
  KEY `fk_my_book_has_my_attachment_my_book1_idx` (`article_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图书图片表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_article_tag`
--

CREATE TABLE IF NOT EXISTS `my_article_tag` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`),
  KEY `fk_my_book_has_my_tag_my_tag1_idx` (`tag_id`),
  KEY `fk_my_book_has_my_tag_my_book_idx` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图书与标签的多对多中间表';

-- --------------------------------------------------------

--
-- 表的结构 `my_attachment`
--

CREATE TABLE IF NOT EXISTS `my_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL DEFAULT 'unknown' COMMENT '模块',
  `controller` varchar(20) NOT NULL DEFAULT 'unknown' COMMENT '控制器',
  `action` varchar(20) NOT NULL DEFAULT 'unknown' COMMENT '操作',
  `filename` varchar(50) NOT NULL DEFAULT '' COMMENT '文件名',
  `filepath` varchar(100) NOT NULL COMMENT '文件路径',
  `filesize` int(10) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `fileext` char(10) NOT NULL DEFAULT '' COMMENT '文件扩展名',
  `isimage` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是图片',
  `userid` int(11) DEFAULT '0' COMMENT '上传的用户id',
  `createtime` int(10) NOT NULL COMMENT '上传时间',
  `ip` char(15) NOT NULL COMMENT '上传ip',
  `cite` tinyint(4) NOT NULL COMMENT '是否引用',
  `ori_filename` varchar(45) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fullfilename` varchar(160) NOT NULL DEFAULT '' COMMENT '完整路径文件',
  `hash` char(32) NOT NULL DEFAULT '' COMMENT '哈希值',
  `download` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='上传附件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_category`
--

CREATE TABLE IF NOT EXISTS `my_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图书数量',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '建立时间',
  `show_menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否在主菜单中显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='图书分类表' AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `my_category`
--

INSERT INTO `my_category` (`id`, `title`, `pid`, `num`, `sort`, `status`, `create_time`, `show_menu`) VALUES
(16, '黄金等级', 15, 0, 100, 1, 0, 0),
(15, '等级评估', 0, 0, 100, 1, 0, 1),
(14, '文化常识', 0, 0, 100, 1, 0, 1),
(13, '首饰佩戴', 0, 0, 100, 1, 0, 1),
(12, '市场资讯', 0, 0, 100, 1, 0, 1),
(11, '相关刊物', 0, 0, 100, 1, 0, 1),
(10, '潮流新款', 0, 0, 100, 1, 0, 1),
(9, '专题论文', 0, 0, 100, 1, 0, 1),
(8, '黄金行情', 0, 0, 100, 1, 0, 1),
(7, '黄金期货', 0, 0, 100, 1, 0, 1),
(6, '深圳珠宝品牌', 0, 0, 100, 1, 0, 1),
(5, '珠宝设计', 0, 0, 100, 1, 0, 1),
(4, '加工鉴定', 0, 0, 100, 1, 0, 1),
(1, '黄金', 0, 0, 100, 1, 0, 1),
(2, '珠宝', 0, 0, 100, 1, 0, 1),
(3, '销售经营', 0, 0, 100, 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `my_message`
--

CREATE TABLE IF NOT EXISTS `my_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(10) unsigned NOT NULL COMMENT '留言时间',
  `ip` char(15) NOT NULL DEFAULT '0.0.0.0' COMMENT '留言ip',
  `content` text NOT NULL COMMENT '留言内容',
  `article_id` int(11) NOT NULL COMMENT '给哪本书留言',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  PRIMARY KEY (`id`),
  KEY `fk_my_message_my_book1_idx` (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='留言表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `my_message`
--

INSERT INTO `my_message` (`id`, `time`, `ip`, `content`, `article_id`, `pid`) VALUES
(1, 0, '0.0.0.0', '主篇', 1, 0),
(2, 0, '0.0.0.0', '第一回复', 1, 1),
(3, 0, '0.0.0.0', '第二回复', 1, 2),
(4, 0, '0.0.0.0', '第三回复', 1, 3);

-- --------------------------------------------------------

--
-- 表的结构 `my_tag`
--

CREATE TABLE IF NOT EXISTS `my_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(45) NOT NULL DEFAULT '' COMMENT '标签名称',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标签中项目的数量',
  `sort` smallint(6) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_user`
--

CREATE TABLE IF NOT EXISTS `my_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别 0为女 1为男',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `logintime` int(11) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `loginip` char(15) NOT NULL DEFAULT '0.0.0.0' COMMENT '登录ip',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `my_user`
--

INSERT INTO `my_user` (`id`, `username`, `password`, `sex`, `email`, `logintime`, `loginip`, `status`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'zhurisoft@163.com', 1403581020, '0.0.0.0', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
