/*
Navicat MySQL Data Transfer

Source Server         : webrtcxss
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : webrtcxss

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-04-16 19:50:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for webrtc_cmspath
-- ----------------------------
DROP TABLE IF EXISTS `webrtc_cmspath`;
CREATE TABLE `webrtc_cmspath` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cms` varchar(20) NOT NULL,
  `path` varchar(200) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for webrtc_cmsvul
-- ----------------------------
DROP TABLE IF EXISTS `webrtc_cmsvul`;
CREATE TABLE `webrtc_cmsvul` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cms` varchar(20) NOT NULL,
  `vulinfo` varchar(1000) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for webrtc_existencecmsip
-- ----------------------------
DROP TABLE IF EXISTS `webrtc_existencecmsip`;
CREATE TABLE `webrtc_existencecmsip` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cms` varchar(20) NOT NULL,
  `inner_ip` varchar(200) NOT NULL,
  `onlystring` varchar(40) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for webrtc_existencevul
-- ----------------------------
DROP TABLE IF EXISTS `webrtc_existencevul`;
CREATE TABLE `webrtc_existencevul` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cms` varchar(40) NOT NULL,
  `vulip` varchar(20) NOT NULL,
  `onlystring` varchar(40) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for webrtc_ipdatalist
-- ----------------------------
DROP TABLE IF EXISTS `webrtc_ipdatalist`;
CREATE TABLE `webrtc_ipdatalist` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `survival_ip` varchar(200) NOT NULL,
  `onlystring` varchar(40) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for webrtc_project
-- ----------------------------
DROP TABLE IF EXISTS `webrtc_project`;
CREATE TABLE `webrtc_project` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `note` varchar(30) NOT NULL,
  `onlystring` varchar(40) NOT NULL,
  `stage` int(2) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for webrtc_survivaliplist
-- ----------------------------
DROP TABLE IF EXISTS `webrtc_survivaliplist`;
CREATE TABLE `webrtc_survivaliplist` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `outside_ip` varchar(20) NOT NULL,
  `survival_ip` varchar(100) NOT NULL,
  `onlystring` varchar(40) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
