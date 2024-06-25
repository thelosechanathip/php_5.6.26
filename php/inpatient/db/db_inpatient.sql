/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : db_inpatient

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2014-09-05 14:17:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) default NULL,
  `user_login` varchar(20) NOT NULL default '',
  `pass_login` varchar(20) default NULL,
  `user_name` varchar(150) default NULL,
  `ward` varchar(4) default NULL,
  PRIMARY KEY  (`user_login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES ('1', 'admin', 'admin', 'Administrator', '00');

-- ----------------------------
-- Table structure for data_all
-- ----------------------------
DROP TABLE IF EXISTS `data_all`;
CREATE TABLE `data_all` (
  `ward` varchar(4) default NULL,
  `idate` date default NULL,
  `wage_type_id` int(1) default NULL,
  `on_pt` int(11) default NULL,
  `on_nb` int(11) default NULL,
  `in_pt` int(11) default NULL,
  `in_nb` int(11) default NULL,
  `move_pt` int(11) default NULL,
  `move_nb` int(11) default NULL,
  `home_pt` int(11) default NULL,
  `home_nb` int(11) default NULL,
  `move_b_pt` int(11) default NULL,
  `move_b_nb` int(11) default NULL,
  `send_pt` int(11) default NULL,
  `send_nb` int(11) default NULL,
  `dead_pt` int(11) default NULL,
  `dead_nb` int(11) default NULL,
  `non_voluntary_pt` int(11) default NULL,
  `non_voluntary_nb` int(11) default NULL,
  `ad_pt` int(11) default NULL,
  `ad_nb` int(11) default NULL,
  `patient_type5` int(11) default NULL,
  `patient_type4` int(11) default NULL,
  `patient_type3` int(11) default NULL,
  `patient_type2` int(11) default NULL,
  `patient_type1` int(11) default NULL,
  `amount_bed` int(11) default NULL,
  `em_hn` int(11) default NULL,
  `em_rn` int(11) default NULL,
  `em_tn` int(11) default NULL,
  `em_pn` int(11) default NULL,
  `em_aid` int(11) default NULL,
  `i_status` int(1) default NULL,
  `last_date` datetime default NULL,
  `user_update` varchar(20) default NULL,
  KEY `ward` USING BTREE (`ward`),
  KEY `idate` USING BTREE (`idate`),
  KEY `wage_type_id` USING BTREE (`wage_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of data_all
-- ----------------------------

-- ----------------------------
-- Table structure for data_confirm
-- ----------------------------
DROP TABLE IF EXISTS `data_confirm`;
CREATE TABLE `data_confirm` (
  `ward` varchar(4) default NULL,
  `idate` date default NULL,
  `wage_type_id` int(1) default NULL,
  `cdate` datetime default NULL,
  `cuser` varchar(20) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of data_confirm
-- ----------------------------

-- ----------------------------
-- Table structure for data_split_patient
-- ----------------------------
DROP TABLE IF EXISTS `data_split_patient`;
CREATE TABLE `data_split_patient` (
  `ward` varchar(4) default NULL,
  `idate` date default NULL,
  `obs_n` int(11) default NULL,
  `nb_n` int(11) default NULL,
  `gyn_n` int(11) default NULL,
  `surg_n` int(11) default NULL,
  `med_n` int(11) default NULL,
  `psych_n` int(11) default NULL,
  `skin_n` int(11) default NULL,
  `ped_n` int(11) default NULL,
  `ortho_n` int(11) default NULL,
  `eye_n` int(11) default NULL,
  `ent_n` int(11) default NULL,
  `dent_n` int(11) default NULL,
  `neuro_surg_n` int(11) default NULL,
  `obs_s` int(11) default NULL,
  `nb_s` int(11) default NULL,
  `gyn_s` int(11) default NULL,
  `surg_s` int(11) default NULL,
  `med_s` int(11) default NULL,
  `psych_s` int(11) default NULL,
  `skin_s` int(11) default NULL,
  `ped_s` int(11) default NULL,
  `ortho_s` int(11) default NULL,
  `eye_s` int(11) default NULL,
  `ent_s` int(11) default NULL,
  `dent_s` int(11) default NULL,
  `neuro_surg_s` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of data_split_patient
-- ----------------------------

-- ----------------------------
-- Table structure for pressure
-- ----------------------------
DROP TABLE IF EXISTS `pressure`;
CREATE TABLE `pressure` (
  `ward` varchar(4) NOT NULL default '',
  `idate` date NOT NULL default '0000-00-00',
  `do_pressure` int(10) default NULL,
  `risk_pressure` int(10) default NULL,
  PRIMARY KEY  (`ward`,`idate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pressure
-- ----------------------------

-- ----------------------------
-- Table structure for readmit
-- ----------------------------
DROP TABLE IF EXISTS `readmit`;
CREATE TABLE `readmit` (
  `ward` varchar(4) NOT NULL default '',
  `month1` varchar(7) NOT NULL default '',
  `idate` date NOT NULL default '0000-00-00',
  `readmit_amount` int(5) default NULL,
  `discharge_amount` int(5) default NULL,
  PRIMARY KEY  (`ward`,`month1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of readmit
-- ----------------------------

-- ----------------------------
-- Table structure for tb_month
-- ----------------------------
DROP TABLE IF EXISTS `tb_month`;
CREATE TABLE `tb_month` (
  `month_id` varchar(2) NOT NULL default '',
  `month_fname` varchar(50) default NULL,
  `month_sname` varchar(4) default NULL,
  `ordering` int(2) default NULL,
  PRIMARY KEY  (`month_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_month
-- ----------------------------
INSERT INTO `tb_month` VALUES ('01', 'มกราคม', 'ม.ค.', '4');
INSERT INTO `tb_month` VALUES ('02', 'กุมภาพันธ์', 'ก.พ.', '5');
INSERT INTO `tb_month` VALUES ('03', 'มีนาคม', 'มี.ค', '6');
INSERT INTO `tb_month` VALUES ('04', 'เมษายน', 'เม.ย', '7');
INSERT INTO `tb_month` VALUES ('05', 'พฤษภาคม', 'พ.ค.', '8');
INSERT INTO `tb_month` VALUES ('06', 'มิถุนายน', 'มิ.ย', '9');
INSERT INTO `tb_month` VALUES ('07', 'กรกฎาคม', 'ก.ค.', '10');
INSERT INTO `tb_month` VALUES ('08', 'สิงหาคม', 'ส.ค.', '11');
INSERT INTO `tb_month` VALUES ('09', 'กันยายน', 'ก.ย.', '12');
INSERT INTO `tb_month` VALUES ('10', 'ตุลาคม', 'ต.ค.', '1');
INSERT INTO `tb_month` VALUES ('11', 'พฤศจิกายน', 'พ.ย.', '2');
INSERT INTO `tb_month` VALUES ('12', 'ธันวาคม', 'ธ.ค.', '3');

-- ----------------------------
-- Table structure for tb_news
-- ----------------------------
DROP TABLE IF EXISTS `tb_news`;
CREATE TABLE `tb_news` (
  `id` int(11) NOT NULL auto_increment,
  `title_news` varchar(255) default NULL,
  `detail_news` text,
  `status_news` varchar(1) default NULL,
  `date_news` date default NULL,
  `time_news` time default NULL,
  `user_update` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_news
-- ----------------------------

-- ----------------------------
-- Table structure for wage_type
-- ----------------------------
DROP TABLE IF EXISTS `wage_type`;
CREATE TABLE `wage_type` (
  `wage_type_id` int(1) NOT NULL default '0',
  `wage_type_name` varchar(10) default NULL,
  `wage_type_names` varchar(2) default NULL,
  PRIMARY KEY  (`wage_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wage_type
-- ----------------------------
INSERT INTO `wage_type` VALUES ('1', 'ดึก', 'ด');
INSERT INTO `wage_type` VALUES ('2', 'เช้า', 'ช');
INSERT INTO `wage_type` VALUES ('3', 'บ่าย', 'บ');

-- ----------------------------
-- Table structure for ward
-- ----------------------------
DROP TABLE IF EXISTS `ward`;
CREATE TABLE `ward` (
  `ward` varchar(4) NOT NULL default '',
  `name` varchar(250) default NULL,
  `old_code` varchar(3) default NULL,
  `spclty` varchar(2) default NULL,
  `bedcount` int(11) default NULL,
  `shortname` varchar(20) default NULL,
  `sss_code` varchar(10) default NULL,
  `hos_guid` varchar(38) default NULL,
  `ward_group` int(1) default NULL,
  `ordering` int(3) default NULL,
  PRIMARY KEY  (`ward`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ward
-- ----------------------------
INSERT INTO `ward` VALUES ('10', 'อายุรกรรมชาย', '010', null, null, 'อช', null, null, '1', '4');
INSERT INTO `ward` VALUES ('11', 'อายุรกรรมหญิง', '011', null, null, 'อญ', null, null, '1', '5');
INSERT INTO `ward` VALUES ('12', 'ICU ผู้ใหญ่', '120', null, null, 'ICU ใหญ่', null, null, '1', '14');
INSERT INTO `ward` VALUES ('13', 'ICU เด็ก', '121', null, null, 'ICU เด็ก', null, null, '1', '13');
INSERT INTO `ward` VALUES ('14', 'ศัลยกรรมหญิง', '021', null, null, 'ศญ', null, null, '1', '2');
INSERT INTO `ward` VALUES ('15', 'ศัลยกรรมชาย', '020', null, null, 'ศช', null, null, '1', '1');
INSERT INTO `ward` VALUES ('16', 'ห้องคลอด(ตึก58 ปี)', '030', null, null, 'ห้องคลอด', null, null, '1', '15');
INSERT INTO `ward` VALUES ('17', 'สูติ-นรีเวช( ตึก58 ปี)', '040', null, null, 'สูตินรีเวช', null, null, '1', '8');
INSERT INTO `ward` VALUES ('18', 'เด็ก  1', '050', null, null, 'เด็ก1', null, null, '1', '6');
INSERT INTO `ward` VALUES ('19', 'เด็ก  2 ( ทารกป่วย1ว.-1ด. )', '051', null, null, 'เด็ก2', null, null, '1', '7');
INSERT INTO `ward` VALUES ('20', 'ตาหูคอจมูก(ตึก58 ปี)', '060', null, null, 'EENT', null, null, '1', '9');
INSERT INTO `ward` VALUES ('21', 'ศัลยกรรมกระดูก', '080', null, null, 'ศก', null, null, '1', '3');
INSERT INTO `ward` VALUES ('22', 'สังเกตุอาการณ์', '130', null, null, null, null, null, '0', '16');
INSERT INTO `ward` VALUES ('23', 'พิเศษ 3( ตึก67ปี)', '024', null, null, 'พศ.3', null, null, '1', '12');
INSERT INTO `ward` VALUES ('24', 'พิเศษ1ชั้น4(ตึก62ปี)', '013', null, null, 'พศ.1', null, null, '1', '10');
INSERT INTO `ward` VALUES ('25', 'พิเศษ2ชั้น5(ตึก62ปี)', '022', null, null, 'พศ.2', null, null, '1', '11');
INSERT INTO `ward` VALUES ('26', 'ตึกพิเศษสงฆ์', '023', null, null, 'พศ.สงฆ์', null, null, '1', '17');
INSERT INTO `ward` VALUES ('27', 'STROKE  UNIT', null, null, null, 'Stroke Unit', null, null, '1', '18');
INSERT INTO `ward` VALUES ('28', 'ICU ศัลย์', null, null, null, 'ICU ศัลย์', null, null, '1', '19');
