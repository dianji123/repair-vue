-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2024-04-09 15:53:00
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `repairdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(1) NOT NULL COMMENT '角色',
  `realname` varchar(100) DEFAULT '' COMMENT '姓名',
  `phone_num` varchar(11) DEFAULT '' COMMENT '手机号',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `tbl_admin`
--

INSERT INTO `tbl_admin` (`aid`, `username`, `password`, `role`, `realname`, `phone_num`) VALUES
(12, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'A', '李老师', '15512345678'),
(13, 'wang', 'e10adc3949ba59abbe56e057f20f883e', 'B', '王师傅', '13412345678'),
(15, 'abc', 'e10adc3949ba59abbe56e057f20f883e', 'B', '可可', '13312345678'),
(17, 'kk', 'e10adc3949ba59abbe56e057f20f883e', 'B', '蔡师傅', '12212345678');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_api_user`
--

CREATE TABLE IF NOT EXISTS `tbl_api_user` (
  `apiuser_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_num` varchar(11) DEFAULT '' COMMENT '手机号',
  `openid` varchar(100) DEFAULT '' COMMENT '微信用户的唯一标识',
  `session_key` varchar(100) DEFAULT '' COMMENT '会话密钥',
  `api_accessToken` varchar(100) DEFAULT '' COMMENT 'api资源验证密钥',
  `create_time` varchar(20) DEFAULT '' COMMENT '创建时间',
  PRIMARY KEY (`apiuser_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tbl_api_user`
--

INSERT INTO `tbl_api_user` (`apiuser_id`, `phone_num`, `openid`, `session_key`, `api_accessToken`, `create_time`) VALUES
(1, '', 'oPGzD612aGCtd7rdnEsHqxSO2zJ8', 'ZGX3HW6YAmcVvJubYNV2OQ==', '', '2024-03-31 12:16:40');

-- --------------------------------------------------------

--
-- 表的结构 `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `telphone` varchar(20) NOT NULL,
  `area` varchar(60) NOT NULL,
  `room` varchar(60) NOT NULL,
  `information` varchar(800) NOT NULL,
  `order_date` datetime NOT NULL,
  `apiuser_id` int(11) DEFAULT NULL COMMENT '订单发布者id',
  `image_file` varchar(100) DEFAULT NULL COMMENT '订单图片',
  `status` varchar(10) DEFAULT '' COMMENT '订单状态',
  `finish_time` datetime DEFAULT NULL COMMENT '订单完成时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `user_name`, `telphone`, `area`, `room`, `information`, `order_date`, `apiuser_id`, `image_file`, `status`, `finish_time`) VALUES
(3, '小明', '17712345678', '9栋', '666', '跳闸', '2024-04-01 05:56:59', 1, 'image-20240408114801-2340.jpg', '已维修', NULL),
(4, '小k', '18812345678', '12栋', '777', '空调漏水', '2024-04-03 03:45:05', 1, 'image-20240408114752-6007.jpeg', '待维修', NULL),
(5, '小李', '15512346578', '计科院', '102', '窗户破损', '2024-04-08 02:56:56', 1, 'image-20240408025654-6696.png', '待维修', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
