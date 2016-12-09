/*
Navicat MySQL Data Transfer

Source Server         : 
Source Server Version : 50617
Source Host           : 
Source Database       : takeyani

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-11-20 14:28:58
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_company`;
CREATE TABLE `t_company` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefecture_id` tinyint(2) NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `station` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `outside_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_relations` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `representative` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rep_tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rep_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `introduce_uid` int(11) NOT NULL,
  `category_id` int(2) DEFAULT NULL,
  `bank_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch_number` int(50) NOT NULL,
  `bank_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bank_holder` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password_login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password_reward` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(3) NOT NULL,
  `introduction_count` int(15) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,

  `remember_token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cid_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,

  `password_login_length` int(2) DEFAULT NULL,
  `password_reward_length` int(2) DEFAULT NULL,
  `reset_password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_kana` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `prefecture_id` tinyint(2) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `street_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `introduce_uid` int(11) DEFAULT NULL,
  `company_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_tel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point` int(11) unsigned DEFAULT NULL,
  `password_point` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password_login` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(3) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,

  `remember_token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password_point_length` int(2) DEFAULT NULL,
  `password_login_length` int(2) DEFAULT NULL,

  `reset_password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,

  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for t_support
-- ----------------------------
DROP TABLE IF EXISTS `t_support`;
CREATE TABLE `t_support` (
  `company_reward_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT NULL,
  `reward_from_data` date DEFAULT NULL,
  `reward_to_data` date DEFAULT NULL,
  `reward_from_time` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward_to_time` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applied_lowest_price` int(11) unsigned DEFAULT NULL,
  `discount_price` int(11) unsigned DEFAULT NULL,
  `discount_rate` int(5) DEFAULT NULL,
  `reward_point` int(11) unsigned NOT  NULL,
  `reward_point_rate` int(5) NOT NULL,
  `reward_content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward_group` tinyint(2) DEFAULT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,

  PRIMARY KEY (`company_reward_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for t_purchase
-- ----------------------------
DROP TABLE IF EXISTS `t_purchase`;
CREATE TABLE `t_purchase` (
  `buy_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `buy_time` datetime NOT NULL,
  `sales_company_id` int(11) NOT NULL,
  `company_reward_id` int(11) NOT NULL,
  `introduce_uid` int(11) NOT NULL,
  `buy_price` int(11) unsigned DEFAULT NULL,
  `point_use` int(11) unsigned DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,
  PRIMARY KEY (`buy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for t_payment
-- ----------------------------
DROP TABLE IF EXISTS `t_payment`;
CREATE TABLE `t_payment` (
  `reward_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `reward_add_time` datetime NOT NULL,
  `buy_id` int(11) NOT NULL,
  `introduce_point_total` int(11) unsigned NOT NULL,
  `introduce_point_company1` int(11) unsigned NOT NULL,
  `introduce_point_company2` int(11) unsigned NOT NULL,
  `introduce_point_user1` int(11) unsigned NOT NULL,
  `introduce_point_user2` int(11) unsigned NOT NULL,
  `introduce_point_takeyani` int(11) unsigned NOT NULL,
  `point_use` int(11) unsigned NOT NULL,
  `point_add` tinyint(1) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,

  PRIMARY KEY (`reward_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for t_demand
-- ----------------------------
DROP TABLE IF EXISTS `t_demand`;
CREATE TABLE `t_demand` (
  `charge_id` int(11) NOT NULL,
  `charge_month` date NOT NULL,
  `cid` int(10) NOT NULL,
  `total_sales` int(11) unsigned NOT NULL,
  `total_reward` int(11) unsigned NOT NULL,
  `charge_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_confirm` int(10) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,

  PRIMARY KEY (`charge_id`,`charge_month`,`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_category
-- ----------------------------
DROP TABLE IF EXISTS `m_category`;
CREATE TABLE `m_category` (
  `category_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,
  
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_prefecture
-- ----------------------------
DROP TABLE IF EXISTS `m_prefecture`;
CREATE TABLE `m_prefecture` (
  `prefecture_id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `prefecture_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,
  
  PRIMARY KEY (`prefecture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_crossInfinity
-- ----------------------------
DROP TABLE IF EXISTS `m_crossinfinity`;
CREATE TABLE `m_crossinfinity` (
  `ci_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `information_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `information_content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,
  
  PRIMARY KEY (`ci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_country
-- ----------------------------
DROP TABLE IF EXISTS `m_country`;
CREATE TABLE `m_country` (
  `country_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_abbreviation` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(10) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(10) NOT NULL,
  `delete_flg` tinyint(1) NOT NULL,
  
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `t_user` AUTO_INCREMENT = 30;
ALTER TABLE `t_company` AUTO_INCREMENT = 30;