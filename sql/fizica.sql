/*
Navicat MySQL Data Transfer

Source Server         : work-debian
Source Server Version : 50163
Source Host           : 127.0.0.1:3306
Source Database       : fizica

Target Server Type    : MYSQL
Target Server Version : 50163
File Encoding         : 65001

Date: 2012-11-01 23:22:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `Admins`
-- ----------------------------
DROP TABLE IF EXISTS `Admins`;
CREATE TABLE `Admins` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Admins
-- ----------------------------
INSERT INTO `Admins` VALUES ('1', 'zaharie', 'zaharie2012');

-- ----------------------------
-- Table structure for `Note`
-- ----------------------------
DROP TABLE IF EXISTS `Note`;
CREATE TABLE `Note` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` bigint(20) unsigned NOT NULL,
  `Data` date DEFAULT NULL,
  `Nota` int(11) NOT NULL,
  `Descriere` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Note
-- ----------------------------
INSERT INTO `Note` VALUES ('5', '1', null, '5', 'da');

-- ----------------------------
-- Table structure for `Users`
-- ----------------------------
DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Users
-- ----------------------------
INSERT INTO `Users` VALUES ('1', 'cristi', 'test');
INSERT INTO `Users` VALUES ('3', 'vlad', 'test');
