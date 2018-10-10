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

 Date: 10/10/2018 18:53:26
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
INSERT INTO `t_laboratory` VALUES (1, '826实验室', 'admin', 30, '先进光子学材料和物理实验室是2001年在“985”一期支持下建立起来的专业实验室，实验室的研究方向为基于新物理原理、新功能材料和新技术，在信息和其他相关领域有科学意...', 0, '2018-08-07 13:02:08');
INSERT INTO `t_laboratory` VALUES (2, '101实验室', 'su', 20, '101实验室介绍', 0, '2018-08-06 08:46:47');
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
  `static` int(11) NULL DEFAULT 0 COMMENT '项目状态 0未开始 1正在进行 2已经结束 3异常结束',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_project
-- ----------------------------
INSERT INTO `t_project` VALUES (1, '实验室签报系统', 'admin', 1, '开放实验室签报系统', 30, '2018-07-24 09:18:56', '2018-09-29 09:18:59', NULL);
INSERT INTO `t_project` VALUES (2, '项目2', 'su', 2, NULL, 10, '2018-07-24 10:41:13', '2018-07-28 10:41:16', NULL);
INSERT INTO `t_project` VALUES (3, '测试项目a', 'admin', 2, '测试项目介绍', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- ----------------------------
-- Table structure for t_signtable
-- ----------------------------
DROP TABLE IF EXISTS `t_signtable`;
CREATE TABLE `t_signtable`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stuid` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学生id',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '签到时间',
  `static` int(1) NOT NULL COMMENT '状态1 进入 0 离开',
  `laboratoryid` int(11) NOT NULL COMMENT '实验室id',
  `seat` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '座位',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of t_signtable
-- ----------------------------
INSERT INTO `t_signtable` VALUES (34, '2', '2018-10-01 13:40:11', 1, 1, '1');
INSERT INTO `t_signtable` VALUES (33, '1', '2018-10-10 13:40:02', 0, 1, '1');
INSERT INTO `t_signtable` VALUES (32, '1', '2018-10-10 09:47:38', 1, 1, '1');
INSERT INTO `t_signtable` VALUES (31, '1', '2018-10-10 09:47:30', 0, 1, '1');
INSERT INTO `t_signtable` VALUES (30, '1', '2018-10-10 09:18:20', 1, 1, '1');
INSERT INTO `t_signtable` VALUES (29, '2', '2018-10-09 21:34:03', 0, 1, '1');
INSERT INTO `t_signtable` VALUES (1, '2', '2018-10-09 21:33:52', 1, 1, '1');
INSERT INTO `t_signtable` VALUES (28, '1', '2018-10-09 21:33:22', 0, 1, '1');
INSERT INTO `t_signtable` VALUES (27, '1', '2018-10-09 21:33:13', 1, 1, '1');

-- ----------------------------
-- Table structure for t_stu_laboratory
-- ----------------------------
DROP TABLE IF EXISTS `t_stu_laboratory`;
CREATE TABLE `t_stu_laboratory`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `laboratoryid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '加入时间',
  `time_in_lab` datetime NOT NULL COMMENT '累计时间',
  `static` int(255) NOT NULL DEFAULT 1 COMMENT '0离开1在实验室2离校',
  `info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_stu_laboratory
-- ----------------------------
INSERT INTO `t_stu_laboratory` VALUES (6, '3', 2, '2018-08-02 13:37:10', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `t_stu_laboratory` VALUES (5, '2', 1, '2018-08-02 13:02:59', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `t_stu_laboratory` VALUES (4, '1', 1, '2018-08-02 13:02:53', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `t_stu_laboratory` VALUES (7, '123456', 1, '2018-09-05 19:32:42', '0000-00-00 00:00:00', 1, NULL);
INSERT INTO `t_stu_laboratory` VALUES (8, '3', 1, '2018-09-07 19:38:03', '0000-00-00 00:00:00', 1, NULL);

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
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of t_stu_pro
-- ----------------------------
INSERT INTO `t_stu_pro` VALUES (8, '123456', 1, '2018-09-05 19:24:22');
INSERT INTO `t_stu_pro` VALUES (7, '123', 1, '2018-09-04 19:36:54');
INSERT INTO `t_stu_pro` VALUES (6, '2', 1, '2018-08-02 13:03:14');
INSERT INTO `t_stu_pro` VALUES (5, '1', 1, '2018-08-02 13:02:19');
INSERT INTO `t_stu_pro` VALUES (9, '17140303xx', 1, '2018-09-05 19:30:54');

-- ----------------------------
-- Table structure for t_student
-- ----------------------------
DROP TABLE IF EXISTS `t_student`;
CREATE TABLE `t_student`  (
  `id` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学号\r\n',
  `teacherid` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '教师id',
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `class` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '班级',
  `password` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码 （sha1加密）',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '加入时间',
  `sex` int(1) NULL DEFAULT NULL COMMENT '性别 （1：男  0：女）',
  `phone` char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话',
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `intime` int(11) NULL DEFAULT 0 COMMENT '在实验室累计时间',
  `info` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '个人介绍',
  `static` int(1) NULL DEFAULT 1 COMMENT '状态 1：在校在实验室 2：离开实验室 3：毕业',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_student
-- ----------------------------
INSERT INTO `t_student` VALUES ('3', 'admin', '赵恩伯', '集成17-1', '77de68daecd823babbb58edb1c8e14d7106e83bb', '0000-00-00 00:00:00', 1, '15561858955', '2218722428@qq.com', 0, NULL, 1);
INSERT INTO `t_student` VALUES ('1', 'su', '杨恒', '1111', '2ea6201a068c5fa0eea5', '0000-00-00 00:00:00', 1, NULL, NULL, 0, NULL, 1);
INSERT INTO `t_student` VALUES ('2', 'admin', '梁成辉', '123456', '7c4a8d09ca3762af61e5', '0000-00-00 00:00:00', 1, NULL, NULL, 0, NULL, 1);
INSERT INTO `t_student` VALUES ('123', 'su', '学生A', '集成17-1', '40bd001563085fc35165', '2018-09-04 00:00:00', NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `t_student` VALUES ('123456', 'admin', '123', '1111', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0000-00-00 00:00:00', NULL, NULL, NULL, 0, NULL, 1);
INSERT INTO `t_student` VALUES ('17140303xx', 'admin', '汪筠博', '电科17-3', '00991a28e7c1a3cff9781b7769d54174b05a1817', '0000-00-00 00:00:00', NULL, NULL, NULL, 0, NULL, 1);

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
INSERT INTO `t_teacher` VALUES ('admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, '15945689568', NULL, 0);
INSERT INTO `t_teacher` VALUES ('su', 'su', '363eb224f6ff8d3c5163a8805222acbf939a65b3', NULL, '13345893791', NULL, 1);

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
v_student.proname,
v_student.id AS stuid
FROM
t_signtable
INNER JOIN t_laboratory ON t_signtable.laboratoryid = t_laboratory.id
INNER JOIN v_student ON v_student.id = t_signtable.stuid ;

-- ----------------------------
-- View structure for v_student
-- ----------------------------
DROP VIEW IF EXISTS `v_student`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_student` AS SELECT
t_student.`name` AS stuname,
t_student.class,
t_student.sex,
t_student.phone,
t_student.email,
t_teacher.`name` AS teachername,
t_project.`name` AS proname,
t_laboratory.`name` AS laboratoryname,
t_student.id,
t_student.addtime,
t_teacher.id AS teacherid
FROM
t_student
LEFT JOIN t_teacher ON t_student.teacherid = t_teacher.id
LEFT JOIN t_stu_pro ON t_student.id = t_stu_pro.studentid
LEFT JOIN t_project ON t_stu_pro.proid = t_project.id
LEFT JOIN t_stu_laboratory ON t_student.id = t_stu_laboratory.studentid
LEFT JOIN t_laboratory ON t_stu_laboratory.laboratoryid = t_laboratory.id ;

-- ----------------------------
-- View structure for v_stu_laboratory
-- ----------------------------
DROP VIEW IF EXISTS `v_stu_laboratory`;
CREATE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `v_stu_laboratory` AS SELECT
t_laboratory.`name` AS laboratoryname,
t_student.`name` AS stuname,
t_stu_laboratory.time,
t_student.class,
t_student.sex,
t_student.phone,
t_student.email,
t_student.info,
t_stu_laboratory.studentid,
t_stu_laboratory.laboratoryid
FROM
t_laboratory
INNER JOIN t_stu_laboratory ON t_stu_laboratory.laboratoryid = t_laboratory.id
INNER JOIN t_student ON t_student.id = t_stu_laboratory.studentid ;

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
