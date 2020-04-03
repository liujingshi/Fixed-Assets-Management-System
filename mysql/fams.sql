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

 Date: 03/04/2020 22:21:33
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
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_department
-- ----------------------------
INSERT INTO `fams_department` VALUES (1, 'Root', '总系统', 0, '根节点 不可删除');
INSERT INTO `fams_department` VALUES (2, 'SVIP_9527', '高校固定资产管理系统', 1, '总部门 不可删除');
INSERT INTO `fams_department` VALUES (3, 'SCHOOL', '沈阳工业大学', 2, '学校总部门');
INSERT INTO `fams_department` VALUES (5, 'ACTION', '社会实践部', 7, '');
INSERT INTO `fams_department` VALUES (7, 'STUDENT', '学生会', 3, '学生会专用部门');

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
  `p_sex` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '性别 只能是男或女',
  `p_birthday` datetime(6) NOT NULL COMMENT '出生日期',
  `p_ic` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '身份证号',
  `p_email` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱',
  PRIMARY KEY (`p_id`) USING BTREE,
  UNIQUE INDEX `only`(`p_no`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_person
-- ----------------------------
INSERT INTO `fams_person` VALUES (1, 'SVIP_9527', 1, 1, '超级管理员9527', '男', '2020-03-28 08:43:21.000000', '888666202003289999', 'ljs@ljscode.com');

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
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_position
-- ----------------------------
INSERT INTO `fams_position` VALUES (1, 'SVIP_9527', '系统管理员', '系统管理员专用职位 不可删除');

-- ----------------------------
-- Table structure for fams_user
-- ----------------------------
DROP TABLE IF EXISTS `fams_user`;
CREATE TABLE `fams_user`  (
  `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键 自动增长',
  `p_id` int(11) NOT NULL COMMENT '人员表主键 与person表关联',
  `u_phone` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户电话 用于登录 短信验证码',
  `u_type` int(11) NOT NULL DEFAULT 0 COMMENT '用户类型 与权限有关 默认0最高级系统管理员',
  `u_password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户密码 默认空字符串',
  `u_head` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户头像 默认空字符串',
  `u_money` int(11) NOT NULL DEFAULT 0 COMMENT '用户余额 默认0',
  PRIMARY KEY (`u_id`) USING BTREE,
  UNIQUE INDEX `only`(`p_id`, `u_phone`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_user
-- ----------------------------
INSERT INTO `fams_user` VALUES (1, 1, '15541850199', 0, '', '', 0);

SET FOREIGN_KEY_CHECKS = 1;
