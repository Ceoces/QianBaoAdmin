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

 Date: 09/08/2018 10:33:05
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
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

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
  `intime` int(11) NULL DEFAULT 0 COMMENT '在实验室累计时间',
  `info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '个人介绍',
  `static` int(1) NULL DEFAULT 1 COMMENT '状态 1：在校在实验室 2：离开实验室 3：毕业',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
t_signtable.time,
t_signtable.static,
t_laboratory.`name` AS laboratoryname,
t_signtable.seat,
t_laboratory.id AS laboratoryid,
v_student.stuname,
v_student.teachername,
v_student.phone,
v_student.class,
v_student.proname
FROM
t_signtable
INNER JOIN t_laboratory ON t_signtable.laboratoryid = t_laboratory.id
INNER JOIN v_student ON v_student.id = t_signtable.stuid ;

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
t_teacher.id AS teacherid,
t_project.`name` AS proname
FROM
t_student
INNER JOIN t_teacher ON t_teacher.id = t_student.teacherid
INNER JOIN t_laboratory ON t_student.laboratoryid = t_laboratory.id
INNER JOIN t_project ON t_student.proid = t_project.id ;

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
