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

 Date: 06/04/2020 16:51:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for fams_asset
-- ----------------------------
DROP TABLE IF EXISTS `fams_asset`;
CREATE TABLE `fams_asset`  (
  `as_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '资产主键 自动增长',
  `as_no` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '资产编号 唯一',
  `as_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '资产名称',
  `as_price` double(10, 2) NOT NULL DEFAULT 0.00 COMMENT '资产价格',
  `cate_id` int(11) NOT NULL COMMENT '类别id 与category表关联',
  `sta_no` int(11) NOT NULL COMMENT '状态编号 与status表关联',
  `as_import_time` datetime(0) NOT NULL COMMENT '资产入库时间',
  `as_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '资产照片',
  `as_local` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0;0' COMMENT '资产地点',
  `as_qrcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '资产二维码',
  `as_exist` int(11) NOT NULL DEFAULT 1 COMMENT '资产是否存在',
  PRIMARY KEY (`as_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fams_category
-- ----------------------------
DROP TABLE IF EXISTS `fams_category`;
CREATE TABLE `fams_category`  (
  `cate_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '类别主键 自动增长',
  `cate_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类别编号 唯一',
  `cate_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类别名称',
  `cate_exist` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '类别是否存在',
  PRIMARY KEY (`cate_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
  `dep_exist` int(11) NOT NULL DEFAULT 1 COMMENT '部门是否存在',
  PRIMARY KEY (`dep_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_department
-- ----------------------------
INSERT INTO `fams_department` VALUES (1, 'Root', '总系统', 0, '根节点 不可删除', 1);
INSERT INTO `fams_department` VALUES (2, 'SVIP_9527', '高校固定资产管理系统', 1, '总部门 不可删除', 1);
INSERT INTO `fams_department` VALUES (3, 'SCHOOL', '沈阳工业大学', 2, '学校总部门', 1);
INSERT INTO `fams_department` VALUES (5, 'ACTION', '社会实践部', 7, '', 1);
INSERT INTO `fams_department` VALUES (23, 'BBMM025', '部门008', 17, '', 1);
INSERT INTO `fams_department` VALUES (7, 'STUDENT', '学生会', 3, '学生会专用部门', 1);
INSERT INTO `fams_department` VALUES (21, 'BM005', '部门005', 16, '', 0);
INSERT INTO `fams_department` VALUES (16, 'BMROOT', '测试总部门', 2, '', 1);
INSERT INTO `fams_department` VALUES (17, 'BM001', '部门001', 16, '', 1);
INSERT INTO `fams_department` VALUES (18, 'BM002', '部门002', 16, '', 1);
INSERT INTO `fams_department` VALUES (19, 'BM003', '部门003', 16, '', 0);
INSERT INTO `fams_department` VALUES (24, '8548545', '部门01235', 21, '', 0);

-- ----------------------------
-- Table structure for fams_log
-- ----------------------------
DROP TABLE IF EXISTS `fams_log`;
CREATE TABLE `fams_log`  (
  `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '日志id 自动增长',
  `log_category_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日子类别编号 与log_category表关联',
  `log_action_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志操作编号 与log_action表关联',
  `u_id` int(11) NOT NULL COMMENT '用户id 与user表关联',
  `log_datetime` datetime(0) NOT NULL COMMENT '操作时间',
  `common_id` int(11) NOT NULL COMMENT '公用id 根据操作关联不同表',
  `table_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '表名',
  `table_main_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '关联的表的主键',
  `log_exist` int(11) NOT NULL DEFAULT 1 COMMENT '日志存在',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_log
-- ----------------------------
INSERT INTO `fams_log` VALUES (1, 'SYSTEM', 'INSERTU', 1, '2020-04-06 16:17:58', 10, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (2, 'SYSTEM', 'INSERTU', 1, '2020-04-06 16:18:02', 11, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (3, 'SYSTEM', 'INSERTU', 11, '2020-04-06 16:18:05', 12, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (4, 'SYSTEM', 'INSERTP', 11, '2020-04-06 16:18:10', 13, 'person', 'p_id', 1);
INSERT INTO `fams_log` VALUES (5, 'SYSTEM', 'INSERTPOS', 11, '2020-04-06 16:18:12', 24, 'position', 'pos_id', 1);
INSERT INTO `fams_log` VALUES (6, 'SYSTEM', 'INSERTDEP', 11, '2020-04-06 16:18:16', 24, 'department', 'dep_id', 1);
INSERT INTO `fams_log` VALUES (7, 'SYSTEM', 'UPDATEU', 11, '2020-04-06 16:18:19', 12, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (8, 'SYSTEM', 'UPDATEDEP', 11, '2020-04-06 16:18:23', 24, 'department', 'dep_id', 1);
INSERT INTO `fams_log` VALUES (9, 'SYSTEM', 'UPDATEPOS', 11, '2020-04-06 16:17:53', 13, 'position', 'pos_id', 1);
INSERT INTO `fams_log` VALUES (10, 'SYSTEM', 'UPDATEP', 11, '2020-04-06 16:18:30', 11, 'person', 'p_id', 1);
INSERT INTO `fams_log` VALUES (11, 'SYSTEM', 'DELETEU', 11, '2020-04-06 16:19:59', 12, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (12, 'SYSTEM', 'DELETEU', 1, '2020-04-06 16:26:19', 4, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (13, 'SYSTEM', 'DELETEU', 1, '2020-04-06 16:26:19', 6, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (14, 'SYSTEM', 'DELETEU', 1, '2020-04-06 16:26:19', 7, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (15, 'SYSTEM', 'DELETEU', 1, '2020-04-06 16:26:19', 10, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (16, 'SYSTEM', 'DELETEU', 1, '2020-04-06 16:26:19', 11, 'user', 'u_id', 1);
INSERT INTO `fams_log` VALUES (17, 'SYSTEM', 'DELETEDEP', 1, '2020-04-06 16:26:46', 19, 'department', 'dep_id', 1);
INSERT INTO `fams_log` VALUES (18, 'SYSTEM', 'DELETEDEP', 1, '2020-04-06 16:26:56', 21, 'department', 'dep_id', 1);
INSERT INTO `fams_log` VALUES (19, 'SYSTEM', 'DELETEDEP', 1, '2020-04-06 16:26:56', 24, 'department', 'dep_id', 1);
INSERT INTO `fams_log` VALUES (20, 'SYSTEM', 'DELETEPOS', 1, '2020-04-06 16:27:25', 21, 'position', 'pos_id', 1);
INSERT INTO `fams_log` VALUES (21, 'SYSTEM', 'DELETEPOS', 1, '2020-04-06 16:27:25', 22, 'position', 'pos_id', 1);
INSERT INTO `fams_log` VALUES (22, 'SYSTEM', 'DELETEPOS', 1, '2020-04-06 16:27:25', 23, 'position', 'pos_id', 1);
INSERT INTO `fams_log` VALUES (23, 'SYSTEM', 'DELETEPOS', 1, '2020-04-06 16:27:25', 24, 'position', 'pos_id', 1);
INSERT INTO `fams_log` VALUES (24, 'SYSTEM', 'DELETEPOS', 1, '2020-04-06 16:27:41', 20, 'position', 'pos_id', 1);
INSERT INTO `fams_log` VALUES (25, 'SYSTEM', 'DELETEP', 1, '2020-04-06 16:27:57', 13, 'person', 'p_id', 1);
INSERT INTO `fams_log` VALUES (26, 'SYSTEM', 'DELETEP', 1, '2020-04-06 16:28:26', 9, 'person', 'p_id', 1);
INSERT INTO `fams_log` VALUES (27, 'SYSTEM', 'DELETEP', 1, '2020-04-06 16:28:26', 10, 'person', 'p_id', 1);

-- ----------------------------
-- Table structure for fams_log_action
-- ----------------------------
DROP TABLE IF EXISTS `fams_log_action`;
CREATE TABLE `fams_log_action`  (
  `log_action_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '日志操作主键 自动增长',
  `log_action_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志操作编号 唯一',
  `log_action_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志操作名称',
  PRIMARY KEY (`log_action_id`) USING BTREE,
  INDEX `only`(`log_action_no`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_log_action
-- ----------------------------
INSERT INTO `fams_log_action` VALUES (1, 'INSERTU', '添加用户');
INSERT INTO `fams_log_action` VALUES (2, 'UPDATEU', '修改用户');
INSERT INTO `fams_log_action` VALUES (3, 'DELETEU', '删除用户');
INSERT INTO `fams_log_action` VALUES (4, 'INSERTDEP', '添加部门');
INSERT INTO `fams_log_action` VALUES (5, 'UPDATEDEP', '修改部门');
INSERT INTO `fams_log_action` VALUES (6, 'DELETEDEP', '删除部门');
INSERT INTO `fams_log_action` VALUES (7, 'INSERTPOS', '添加职位');
INSERT INTO `fams_log_action` VALUES (8, 'UPDATEPOS', '修改职位');
INSERT INTO `fams_log_action` VALUES (9, 'DELETEPOS', '删除职位');
INSERT INTO `fams_log_action` VALUES (10, 'INSERTP', '添加人员');
INSERT INTO `fams_log_action` VALUES (11, 'UPDATEP', '修改人员');
INSERT INTO `fams_log_action` VALUES (12, 'DELETEP', '删除人员');
INSERT INTO `fams_log_action` VALUES (13, 'INSERTAS', '资产入库');
INSERT INTO `fams_log_action` VALUES (14, 'UPDATEAS', '修改资产信息');
INSERT INTO `fams_log_action` VALUES (15, 'DELETEAS', '删除资产');

-- ----------------------------
-- Table structure for fams_log_category
-- ----------------------------
DROP TABLE IF EXISTS `fams_log_category`;
CREATE TABLE `fams_log_category`  (
  `log_category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '日志类别主键 自动增长',
  `log_category_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志类别编号 唯一',
  `log_category_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '日志类别名称',
  PRIMARY KEY (`log_category_id`) USING BTREE,
  UNIQUE INDEX `only`(`log_category_no`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_log_category
-- ----------------------------
INSERT INTO `fams_log_category` VALUES (1, 'SYSTEM', '系统管理');
INSERT INTO `fams_log_category` VALUES (2, 'ASSET', '资产管理');

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
  `p_exist` int(11) NOT NULL DEFAULT 1 COMMENT '人员存在',
  PRIMARY KEY (`p_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_person
-- ----------------------------
INSERT INTO `fams_person` VALUES (1, 'SVIP_9527', 2, 1, '超级管理员9527', '男', '888666202003289999', 'ljs@ljscode.com', 1);
INSERT INTO `fams_person` VALUES (5, '100002', 17, 6, '人员002', '男', '', '', 1);
INSERT INTO `fams_person` VALUES (4, '100001', 17, 6, '人员001', '男', '', '', 1);
INSERT INTO `fams_person` VALUES (6, '100003', 17, 7, '人员003', '女', '589654785698547412', '164546515@163.com', 1);
INSERT INTO `fams_person` VALUES (7, '100004', 17, 13, '人员004', '男', '', '', 1);
INSERT INTO `fams_person` VALUES (8, '100005', 21, 13, '人员005', '男', '', '7854548@qq.com', 1);
INSERT INTO `fams_person` VALUES (9, '100006', 21, 23, '人员006', '男', '', '', 0);
INSERT INTO `fams_person` VALUES (10, '100007', 16, 23, '人员007', '男', '', '', 0);
INSERT INTO `fams_person` VALUES (11, '12121', 17, 14, '计算机', '女', '', '', 1);
INSERT INTO `fams_person` VALUES (12, '121212', 17, 14, '计算机啊', '', '', '', 1);
INSERT INTO `fams_person` VALUES (13, '121214', 17, 14, '计算机啊哦', '', '', '', 0);

-- ----------------------------
-- Table structure for fams_position
-- ----------------------------
DROP TABLE IF EXISTS `fams_position`;
CREATE TABLE `fams_position`  (
  `pos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键 自动增长',
  `pos_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '职位编号 唯一',
  `pos_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '职位名称',
  `pos_remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  `pos_exist` int(11) NOT NULL DEFAULT 1 COMMENT '职位存在',
  PRIMARY KEY (`pos_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_position
-- ----------------------------
INSERT INTO `fams_position` VALUES (1, 'SVIP_9527', '系统管理员', '系统管理员专用职位 不可删除', 1);
INSERT INTO `fams_position` VALUES (23, 'zw000', '101010', '', 0);
INSERT INTO `fams_position` VALUES (6, 'ZW005', '职位005', '', 1);
INSERT INTO `fams_position` VALUES (7, 'ZW006', '职位006', '安达分公司', 1);
INSERT INTO `fams_position` VALUES (11, 'ZW008', '职位008', '', 1);
INSERT INTO `fams_position` VALUES (12, 'ZW009', '职位009', '', 1);
INSERT INTO `fams_position` VALUES (13, 'ZW010', '职位010', '大概', 1);
INSERT INTO `fams_position` VALUES (14, 'ZW011', '职位011', '', 1);
INSERT INTO `fams_position` VALUES (22, 'ZZW018', '职位018', '', 0);
INSERT INTO `fams_position` VALUES (21, 'ZW018', '职位018', '', 0);
INSERT INTO `fams_position` VALUES (20, 'ZW017', '职位017', '', 0);
INSERT INTO `fams_position` VALUES (18, 'ZW015', '职位015', '', 1);
INSERT INTO `fams_position` VALUES (19, 'ZW016', '职位016', '', 1);
INSERT INTO `fams_position` VALUES (24, '1221512', '大职位', '', 0);

-- ----------------------------
-- Table structure for fams_status
-- ----------------------------
DROP TABLE IF EXISTS `fams_status`;
CREATE TABLE `fams_status`  (
  `sta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '状态主键 自动增长',
  `sta_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '状态编号 唯一',
  `sta_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '状态名称',
  PRIMARY KEY (`sta_id`) USING BTREE,
  UNIQUE INDEX `only`(`sta_no`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
  `u_exist` int(11) NOT NULL DEFAULT 1 COMMENT '用户存在',
  PRIMARY KEY (`u_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fams_user
-- ----------------------------
INSERT INTO `fams_user` VALUES (1, 1, '15541850199', '', 'SVIP', 'las la-user-secret', 0, 1);
INSERT INTO `fams_user` VALUES (2, 4, '13456789100', '', 'USER', 'las la-user-graduate', 2, 0);
INSERT INTO `fams_user` VALUES (6, 10, '13842503687', '', 'VISIT', 'lab la-teamspeak', 666, 0);
INSERT INTO `fams_user` VALUES (4, 6, '19818809499', '', 'VIP', 'las la-user-ninja', 0, 0);
INSERT INTO `fams_user` VALUES (7, 6, '13456789100', '', 'USER', 'las la-user-graduate', 0, 0);
INSERT INTO `fams_user` VALUES (8, 8, '13358886999', '', 'USER', 'las la-user-graduate', 0, 0);
INSERT INTO `fams_user` VALUES (9, 9, '13344445555', '', 'VISIT', 'las la-user-secret', 0, 0);
INSERT INTO `fams_user` VALUES (10, 8, '13355556666', '', 'VISIT', 'las la-user-ninja', 0, 0);
INSERT INTO `fams_user` VALUES (11, 1, '19999999999', '', 'SVIP', 'las la-user-graduate', 6666, 0);
INSERT INTO `fams_user` VALUES (12, 7, '15566667777', '', 'VISIT', 'las la-user-clock', 666, 0);

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
