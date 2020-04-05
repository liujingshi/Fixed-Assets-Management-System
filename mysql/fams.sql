/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : fams

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 05/04/2020 16:08:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for fams_department
-- ----------------------------
DROP TABLE IF EXISTS `fams_department`;
CREATE TABLE `fams_department`  (
  `dep_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键 自动增长',
  `dep_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '部门编号 唯一',
  `dep_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '部门名称',
  `up_dep_id` int(11) NOT NULL DEFAULT 0 COMMENT '与本表关联的上级部门id 设置为0时就是最上级',
  `dep_remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`dep_id`) USING BTREE,
  UNIQUE INDEX `only`(`dep_no`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_department
-- ----------------------------
INSERT INTO `fams_department` VALUES (1, 'Root', '总系统', 0, '根节点 不可删除');
INSERT INTO `fams_department` VALUES (2, 'SVIP_9527', '高校固定资产管理系统', 1, '总部门 不可删除');
INSERT INTO `fams_department` VALUES (3, 'SCHOOL', '沈阳工业大学', 2, '学校总部门');
INSERT INTO `fams_department` VALUES (5, 'ACTION', '社会实践部', 7, '');
INSERT INTO `fams_department` VALUES (7, 'STUDENT', '学生会', 3, '学生会专用部门');
INSERT INTO `fams_department` VALUES (21, 'BM005', '部门005', 16, '');
INSERT INTO `fams_department` VALUES (16, 'BMROOT', '测试总部门', 2, '');
INSERT INTO `fams_department` VALUES (17, 'BM001', '部门001', 16, '');
INSERT INTO `fams_department` VALUES (18, 'BM002', '部门002', 16, '');
INSERT INTO `fams_department` VALUES (19, 'BM003', '部门003', 16, '');

-- ----------------------------
-- Table structure for fams_person
-- ----------------------------
DROP TABLE IF EXISTS `fams_person`;
CREATE TABLE `fams_person`  (
  `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键 自动增长',
  `p_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '工号 唯一',
  `dep_id` int(11) NOT NULL COMMENT '部门主键 与department的dep_id关联',
  `pos_id` int(11) NOT NULL COMMENT '职位主键 与position的pos_id关联',
  `p_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `p_sex` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '性别 只能是男或女',
  `p_ic` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '身份证号',
  `p_email` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  PRIMARY KEY (`p_id`) USING BTREE,
  UNIQUE INDEX `only`(`p_no`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_person
-- ----------------------------
INSERT INTO `fams_person` VALUES (1, 'SVIP_9527', 2, 1, '超级管理员9527', '男', '888666202003289999', 'ljs@ljscode.com');
INSERT INTO `fams_person` VALUES (5, '100002', 17, 6, '人员002', '男', '', '');
INSERT INTO `fams_person` VALUES (4, '100001', 17, 6, '人员001', '男', '', '');
INSERT INTO `fams_person` VALUES (6, '100003', 17, 7, '人员003', '女', '589654785698547412', '164546515@163.com');
INSERT INTO `fams_person` VALUES (7, '100004', 17, 13, '人员004', '男', '', '');
INSERT INTO `fams_person` VALUES (8, '100005', 21, 13, '人员005', '男', '', '7854548@qq.com');
INSERT INTO `fams_person` VALUES (9, '100006', 21, 23, '人员006', '男', '', '');
INSERT INTO `fams_person` VALUES (10, '100007', 16, 23, '人员007', '男', '', '');

-- ----------------------------
-- Table structure for fams_position
-- ----------------------------
DROP TABLE IF EXISTS `fams_position`;
CREATE TABLE `fams_position`  (
  `pos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键 自动增长',
  `pos_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '职位编号 唯一',
  `pos_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '职位名称',
  `pos_remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`pos_id`) USING BTREE,
  UNIQUE INDEX `only`(`pos_no`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_position
-- ----------------------------
INSERT INTO `fams_position` VALUES (1, 'SVIP_9527', '系统管理员', '系统管理员专用职位 不可删除');
INSERT INTO `fams_position` VALUES (23, 'zw000', '101010', '');
INSERT INTO `fams_position` VALUES (6, 'ZW005', '职位005', '');
INSERT INTO `fams_position` VALUES (7, 'ZW006', '职位006', '安达分公司');
INSERT INTO `fams_position` VALUES (11, 'ZW008', '职位008', '');
INSERT INTO `fams_position` VALUES (12, 'ZW009', '职位009', '');
INSERT INTO `fams_position` VALUES (13, 'ZW010', '职位010', '');
INSERT INTO `fams_position` VALUES (14, 'ZW011', '职位011', '');
INSERT INTO `fams_position` VALUES (22, 'ZZW018', '职位018', '');
INSERT INTO `fams_position` VALUES (21, 'ZW018', '职位018', '');
INSERT INTO `fams_position` VALUES (20, 'ZW017', '职位017', '');
INSERT INTO `fams_position` VALUES (18, 'ZW015', '职位015', '');
INSERT INTO `fams_position` VALUES (19, 'ZW016', '职位016', '');

-- ----------------------------
-- Table structure for fams_user
-- ----------------------------
DROP TABLE IF EXISTS `fams_user`;
CREATE TABLE `fams_user`  (
  `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键 自动增长',
  `p_id` int(11) NOT NULL COMMENT '人员表主键 与person表关联',
  `u_phone` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户电话 用于登录 短信验证码',
  `u_openid` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '微信openid',
  `power_no` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'VISIT' COMMENT '用户权限编号 与user_power表关联',
  `u_head` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户头像 默认空字符串',
  `u_money` int(11) NOT NULL DEFAULT 0 COMMENT '用户余额 默认0',
  PRIMARY KEY (`u_id`) USING BTREE,
  UNIQUE INDEX `only`(`u_phone`, `u_openid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_user
-- ----------------------------
INSERT INTO `fams_user` VALUES (1, 1, '15541850199', '', 'SVIP', 'las la-user-secret', 0);
INSERT INTO `fams_user` VALUES (2, 4, '13456789100', '', 'USER', 'las la-user-graduate', 2);
INSERT INTO `fams_user` VALUES (6, 10, '13842503687', '', 'VISIT', 'lab la-teamspeak', 666);
INSERT INTO `fams_user` VALUES (4, 6, '19818809499', '', 'VIP', 'las la-user-ninja', 0);

-- ----------------------------
-- Table structure for fams_user_power
-- ----------------------------
DROP TABLE IF EXISTS `fams_user_power`;
CREATE TABLE `fams_user_power`  (
  `power_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '权限主键 自动增长',
  `power_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限编号 唯一',
  `power_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限名 唯一',
  PRIMARY KEY (`power_id`) USING BTREE,
  UNIQUE INDEX `only`(`power_no`, `power_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_user_power
-- ----------------------------
INSERT INTO `fams_user_power` VALUES (1, 'SVIP', '系统管理员');
INSERT INTO `fams_user_power` VALUES (2, 'VIP', '普通管理员');
INSERT INTO `fams_user_power` VALUES (3, 'USER', '普通用户');
INSERT INTO `fams_user_power` VALUES (4, 'VISIT', '游客');

SET FOREIGN_KEY_CHECKS = 1;
