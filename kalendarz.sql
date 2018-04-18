/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : kalendarz

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-03 21:25:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `calendar`
-- ----------------------------
DROP TABLE IF EXISTS `calendar`;
CREATE TABLE `calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of calendar
-- ----------------------------
INSERT INTO `calendar` VALUES ('1', '2017-09-15', 'Wyprzedaż', 'Wielki super mega event!');
INSERT INTO `calendar` VALUES ('2', '2017-08-26', 'Okazja!', 'Ale fajne!');
INSERT INTO `calendar` VALUES ('3', '2017-10-13', 'Tanie żarówki!', 'O kurczaczki!');
INSERT INTO `calendar` VALUES ('4', '2017-09-11', 'Wielkie wydarzenie!', 'Lubisz lemoniade?');
INSERT INTO `calendar` VALUES ('5', '2017-09-27', 'Obniżka cen!', 'To jest opis!');
