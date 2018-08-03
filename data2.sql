/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50547
 Source Host           : localhost:3306
 Source Schema         : data2

 Target Server Type    : MySQL
 Target Server Version : 50547
 File Encoding         : 65001

 Date: 03/08/2018 12:57:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_laboratory
-- ----------------------------
DROP TABLE IF EXISTS `t_laboratory`;
CREATE TABLE `t_laboratory`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `teacherid` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `maxnum` int(11) NOT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `stunum` int(11) NOT NULL DEFAULT 0,
  `newtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_laboratory
-- ----------------------------
INSERT INTO `t_laboratory` VALUES (1, '826', 'admin', 30, NULL, 0, '2018-07-23 10:46:05');
INSERT INTO `t_laboratory` VALUES (2, '101', 'su', 20, '101实验室介绍', 0, '2018-08-03 09:57:10');
INSERT INTO `t_laboratory` VALUES (22, '创新实验室', 'su', 12, '创新实验室介绍', 0, '2018-08-03 09:15:55');

-- ----------------------------
-- Table structure for t_project
-- ----------------------------
DROP TABLE IF EXISTS `t_project`;
CREATE TABLE `t_project`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '项目名',
  `teacherid` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '教师id',
  `laboratoryid` int(11) NOT NULL COMMENT '实验室id',
  `info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '介绍',
  `maxStuNum` int(11) NULL DEFAULT NULL COMMENT '最多加入学生个数',
  `startTime` datetime NOT NULL COMMENT '项目开始时间',
  `endTime` datetime NULL DEFAULT NULL COMMENT '项目截止时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_project
-- ----------------------------
INSERT INTO `t_project` VALUES (1, '实验室签报系统', 'admin', 1, '开放实验室签报系统', 30, '2018-07-24 09:18:56', '2018-09-29 09:18:59');
INSERT INTO `t_project` VALUES (2, '项目2', 'su', 2, NULL, 10, '2018-07-24 10:41:13', '2018-07-28 10:41:16');
INSERT INTO `t_project` VALUES (5, '测试项目a', 'admin', 2, '测试项目介绍', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for t_signtable
-- ----------------------------
DROP TABLE IF EXISTS `t_signtable`;
CREATE TABLE `t_signtable`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stuid` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学生id',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '签到时间',
  `static` int(1) NOT NULL COMMENT '状态',
  `laboratoryid` int(11) NOT NULL COMMENT '实验室id',
  `seat` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '座位',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of t_signtable
-- ----------------------------
INSERT INTO `t_signtable` VALUES (8, '1', '2018-08-02 15:50:16', 1, 1, '1');
INSERT INTO `t_signtable` VALUES (7, '3', '2018-08-02 15:50:00', 0, 2, '1');
INSERT INTO `t_signtable` VALUES (6, '3', '2018-08-02 15:49:51', 1, 2, '1');

-- ----------------------------
-- Table structure for t_stu_laboratory
-- ----------------------------
DROP TABLE IF EXISTS `t_stu_laboratory`;
CREATE TABLE `t_stu_laboratory`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `laboratoryid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of t_stu_laboratory
-- ----------------------------
INSERT INTO `t_stu_laboratory` VALUES (6, '3', 2, '2018-08-02 13:37:10');
INSERT INTO `t_stu_laboratory` VALUES (5, '2', 1, '2018-08-02 13:02:59');
INSERT INTO `t_stu_laboratory` VALUES (4, '1', 1, '2018-08-02 13:02:53');

-- ----------------------------
-- Table structure for t_stu_pro
-- ----------------------------
DROP TABLE IF EXISTS `t_stu_pro`;
CREATE TABLE `t_stu_pro`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `proid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of t_stu_pro
-- ----------------------------
INSERT INTO `t_stu_pro` VALUES (6, '2', 1, '2018-08-02 13:03:14');
INSERT INTO `t_stu_pro` VALUES (5, '1', 1, '2018-08-02 13:02:19');

-- ----------------------------
-- Table structure for t_student
-- ----------------------------
DROP TABLE IF EXISTS `t_student`;
CREATE TABLE `t_student`  (
  `id` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学号\r\n',
  `teacherid` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '教师id',
  `laboratoryid` int(11) NOT NULL COMMENT '实验室id',
  `proid` int(11) NULL DEFAULT NULL COMMENT '项目id',
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `class` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '班级',
  `password` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码 （sha1加密）',
  `addtime` datetime NOT NULL COMMENT '加入时间',
  `leavetime` datetime NULL DEFAULT NULL COMMENT '离开时间',
  `sex` int(1) NULL DEFAULT NULL COMMENT '性别 （1：男  0：女）',
  `phone` char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '个人介绍',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_student
-- ----------------------------
INSERT INTO `t_student` VALUES ('3', 'admin', 2, 2, '不皮一下会死的学生a', '某某班', '7c4a8d09ca3762af61e5', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `t_student` VALUES ('1', 'su', 1, 1, '即将被删除的学生a', '1111', '2ea6201a068c5fa0eea5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL);
INSERT INTO `t_student` VALUES ('2', 'admin', 1, 1, '可怜兮兮的测试数据a', '123456', '7c4a8d09ca3762af61e5', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for t_teacher
-- ----------------------------
DROP TABLE IF EXISTS `t_teacher`;
CREATE TABLE `t_teacher`  (
  `id` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '教工号',
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `password` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码（sha1加密）',
  `info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '介绍',
  `phone` char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `static` int(11) NOT NULL DEFAULT 0 COMMENT '权限（1：su)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_teacher
-- ----------------------------
INSERT INTO `t_teacher` VALUES ('admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, NULL, NULL, 0);
INSERT INTO `t_teacher` VALUES ('su', 'su', '363eb224f6ff8d3c5163a8805222acbf939a65b3', NULL, NULL, NULL, 1);

-- ----------------------------
-- View structure for v_laboratory
-- ----------------------------
DROP VIEW IF EXISTS `v_laboratory`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_laboratory` AS SELECT
t_laboratory.`name` AS laboratoryname,
t_teacher.`name` AS teachername,
t_laboratory.maxnum,
t_laboratory.stunum,
t_laboratory.newtime,
t_laboratory.id,
t_laboratory.info,
t_laboratory.teacherid,
t_teacher.phone,
t_teacher.email
FROM
t_laboratory
INNER JOIN t_teacher ON t_laboratory.teacherid = t_teacher.id ;

-- ----------------------------
-- View structure for v_project
-- ----------------------------
DROP VIEW IF EXISTS `v_project`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_project` AS SELECT
t_teacher.`name` AS teachername,
t_teacher.id AS teacherid,
t_project.`name` AS proname,
t_project.info,
t_project.maxStuNum,
t_project.startTime,
t_project.endTime,
t_project.id AS proid,
t_laboratory.id AS laboratoryid,
t_laboratory.`name` AS laboratoryname,
t_teacher.phone,
t_teacher.email
FROM
t_teacher
INNER JOIN t_project ON t_project.teacherid = t_teacher.id
INNER JOIN t_laboratory ON t_project.laboratoryid = t_laboratory.id ;

-- ----------------------------
-- View structure for v_signtable
-- ----------------------------
DROP VIEW IF EXISTS `v_signtable`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_signtable` AS SELECT
t_student.`name` AS stuname,
t_signtable.time,
t_signtable.static,
t_laboratory.`name` AS laboratoryname,
t_signtable.seat,
t_laboratory.id AS laboratoryid
FROM
t_signtable
INNER JOIN t_student ON t_signtable.stuid = t_student.id
INNER JOIN t_laboratory ON t_signtable.laboratoryid = t_laboratory.id ;

-- ----------------------------
-- View structure for v_student
-- ----------------------------
DROP VIEW IF EXISTS `v_student`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_student` AS SELECT
t_student.id,
t_student.`name` AS stuname,
t_teacher.`name` AS teachername,
t_student.class,
t_student.`password`,
t_student.addtime,
t_student.leavetime,
t_student.sex,
t_student.phone,
t_student.email,
t_student.info,
t_laboratory.`name` AS laboratoryname,
t_teacher.id AS teacherid
FROM
t_student
INNER JOIN t_teacher ON t_teacher.id = t_student.teacherid
INNER JOIN t_laboratory ON t_student.laboratoryid = t_laboratory.id ;

-- ----------------------------
-- View structure for v_stu_laboratory
-- ----------------------------
DROP VIEW IF EXISTS `v_stu_laboratory`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_stu_laboratory` AS SELECT
t_laboratory.`name` AS laboratoryname,
t_student.`name` AS stuname,
t_stu_laboratory.time,
t_student.class,
t_project.`name` AS proname,
t_student.sex,
t_student.phone,
t_student.email,
t_student.info,
t_stu_laboratory.studentid,
t_stu_laboratory.laboratoryid
FROM
t_laboratory
INNER JOIN t_stu_laboratory ON t_stu_laboratory.laboratoryid = t_laboratory.id
INNER JOIN t_student ON t_student.id = t_stu_laboratory.studentid
INNER JOIN t_project ON t_project.id = t_student.proid ;

-- ----------------------------
-- View structure for v_stu_pro
-- ----------------------------
DROP VIEW IF EXISTS `v_stu_pro`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_stu_pro` AS SELECT
t_student.`name` AS stuname,
t_project.`name` AS proname,
t_stu_pro.time,
t_student.class,
t_stu_pro.studentid,
t_stu_pro.proid
FROM
t_stu_pro
INNER JOIN t_student ON t_student.id = t_stu_pro.studentid
INNER JOIN t_project ON t_project.id = t_stu_pro.proid ;

SET FOREIGN_KEY_CHECKS = 1;
