/* This file is created by MySQLReback 2017-11-21 16:32:54 */
 /* 创建表结构 `bk_area` */
 DROP TABLE IF EXISTS `bk_area`;/* MySQLReback Separation */ CREATE TABLE `bk_area` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_area` */
 INSERT INTO `bk_area` VALUES ('1','西昌市'),('2','盐源县'),('3','德昌县'),('4','会理县'),('5','会东县'),('6','宁南县'),('7','普格县'),('8','布拖县'),('9','金阳县'),('10','昭觉县'),('11','喜德县'),('12','冕宁县'),('13','越西县'),('14','甘洛县'),('15','美姑县'),('16','雷波县'),('17','木里藏族自治县'),('18','其他地区');/* MySQLReback Separation */
 /* 创建表结构 `bk_bingzhong` */
 DROP TABLE IF EXISTS `bk_bingzhong`;/* MySQLReback Separation */ CREATE TABLE `bk_bingzhong` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `bingzhong_name` varchar(100) NOT NULL,
  `keshi_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_bingzhong` */
 INSERT INTO `bk_bingzhong` VALUES ('1','前列腺疾病','1'),('2','生殖感染','1'),('3','男科检查','1'),('4','腋臭','4'),('5','包皮过长','1'),('6','痔疮','4'),('7','男性不育','3'),('8','性病','1'),('9','早泄','1'),('10','阳痿','1'),('11','疝气','5'),('12','阴茎延长/增粗','1'),('13','其它','5');/* MySQLReback Separation */
 /* 创建表结构 `bk_callback` */
 DROP TABLE IF EXISTS `bk_callback`;/* MySQLReback Separation */ CREATE TABLE `bk_callback` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `callback_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_callback` */
 INSERT INTO `bk_callback` VALUES ('2','待诊'),('3','改期'),('4','未接'),('5','外院治疗了'),('6','取消'),('9','否'),('10','挂断电话'),('11','盲音'),('12','打错电话不承认本人');/* MySQLReback Separation */
 /* 创建表结构 `bk_config` */
 DROP TABLE IF EXISTS `bk_config`;/* MySQLReback Separation */ CREATE TABLE `bk_config` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '顶级栏目',
  `notes` varchar(255) NOT NULL COMMENT '备注',
  `u_id` int(5) NOT NULL COMMENT '操作人',
  `state` int(2) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='参数配置';/* MySQLReback Separation */
 /* 创建表结构 `bk_consult` */
 DROP TABLE IF EXISTS `bk_consult`;/* MySQLReback Separation */ CREATE TABLE `bk_consult` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `consult_name` varchar(100) NOT NULL,
  `qudao_group_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_consult` */
 INSERT INTO `bk_consult` VALUES ('74','个人微信','1'),('73','个人qq','1'),('72','电话','1'),('70','后台抓取','1'),('69','商务通转电话','1'),('68','商务通转微信','1'),('71','商务通转qq','1'),('66','神马','1'),('65','搜狗','1'),('64','百度PC','1'),('63','百度手机','1');/* MySQLReback Separation */
 /* 创建表结构 `bk_deleteinfo` */
 DROP TABLE IF EXISTS `bk_deleteinfo`;/* MySQLReback Separation */ CREATE TABLE `bk_deleteinfo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `yuyue` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '客户姓名',
  `sex` varchar(100) NOT NULL COMMENT '性别',
  `area` varchar(100) NOT NULL COMMENT '地区',
  `age` int(100) NOT NULL COMMENT '年龄',
  `phone` varchar(100) NOT NULL COMMENT '电话',
  `qq` varchar(100) NOT NULL COMMENT 'QQ号',
  `keshi` varchar(100) NOT NULL COMMENT '科室',
  `bingzhong` varchar(100) DEFAULT NULL COMMENT '病种',
  `bingzheng` text COMMENT '病症',
  `remark` text NOT NULL COMMENT '备注',
  `consult` varchar(100) NOT NULL COMMENT '咨询方式',
  `info_channel` varchar(100) NOT NULL COMMENT '获取渠道',
  `marketing` varchar(100) NOT NULL COMMENT '营销方式',
  `source_web` varchar(100) NOT NULL COMMENT '来源网站',
  `source_url` varchar(100) NOT NULL COMMENT '来源网址',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `type_in` varchar(100) NOT NULL COMMENT '录入者',
  `time` varchar(100) NOT NULL COMMENT '预约时间',
  `in_time` varchar(100) NOT NULL COMMENT '录入时间',
  `doctor` varchar(100) DEFAULT NULL,
  `laiyuan` varchar(100) DEFAULT NULL,
  `huifang` varchar(100) DEFAULT NULL,
  `laiyuan_time` varchar(100) DEFAULT NULL,
  `qudao_group_id` varchar(100) NOT NULL,
  `isorder` tinyint(1) NOT NULL DEFAULT '1',
  `identitys` varchar(200) NOT NULL,
  `huifang_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=334 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `bk_doctor` */
 DROP TABLE IF EXISTS `bk_doctor`;/* MySQLReback Separation */ CREATE TABLE `bk_doctor` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(100) NOT NULL,
  `u_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_doctor` */
 INSERT INTO `bk_doctor` VALUES ('1','黄主任','1'),('2','赵主任','1'),('3','向主任','1'),('4','程主任','1'),('5','陈主任','1');/* MySQLReback Separation */
 /* 创建表结构 `bk_doctorsection` */
 DROP TABLE IF EXISTS `bk_doctorsection`;/* MySQLReback Separation */ CREATE TABLE `bk_doctorsection` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_doctorsection` */
 INSERT INTO `bk_doctorsection` VALUES ('1','医生');/* MySQLReback Separation */
 /* 创建表结构 `bk_downpwd` */
 DROP TABLE IF EXISTS `bk_downpwd`;/* MySQLReback Separation */ CREATE TABLE `bk_downpwd` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `downpwd` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;/* MySQLReback Separation */
 /* 创建表结构 `bk_group` */
 DROP TABLE IF EXISTS `bk_group`;/* MySQLReback Separation */ CREATE TABLE `bk_group` (
  `m_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `qx_group_id` varchar(255) DEFAULT NULL,
  `qx_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_group` */
 INSERT INTO `bk_group` VALUES ('2','主管','1,2,3,4,5,50,7,8,9,10,11,27,28,29,30,37,38','1,2,8,10'),('3','咨询员','1,2,3,4,9,10,27,28,29,30','1,2,8'),('4','导医','3,4,5,50','1'),('5','回访组','1,3,4,30','1,8'),('8','经营部','3,4,5,50,7,8,9,10,11,24,51,25,26,32,33,34,35,36,37,38,39,40','1,2,6,7,9,10'),('10','管理','1,2,3,4,5,6,43,50,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,51,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,44,45,46,47,48,13,53,52','1,2,4,5,6,7,8,9,10,11,14,15,16,13,17'),('9','竞价','1,3,4,7,8,9,10,11,32,33,34,35,36,37,38,39,40','1,2,9,10'),('1','超级管理员','1,2,3,5,6,43,50,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,51,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,44,45,46,47,48,13,53,52','1,2,4,5,6,7,8,9,10,11,14,15,16,13,17');/* MySQLReback Separation */
 /* 创建表结构 `bk_kefuinfo` */
 DROP TABLE IF EXISTS `bk_kefuinfo`;/* MySQLReback Separation */ CREATE TABLE `bk_kefuinfo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `yuyue` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '客户姓名',
  `sex` varchar(100) NOT NULL COMMENT '性别',
  `area` varchar(100) NOT NULL COMMENT '地区',
  `age` int(100) NOT NULL COMMENT '年龄',
  `phone` varchar(100) NOT NULL COMMENT '电话',
  `qq` varchar(100) NOT NULL COMMENT 'QQ号',
  `keshi` varchar(100) NOT NULL COMMENT '科室',
  `bingzhong` varchar(100) DEFAULT NULL COMMENT '病种',
  `bingzheng` text COMMENT '病症',
  `remark` text NOT NULL COMMENT '备注',
  `consult` varchar(100) NOT NULL COMMENT '咨询方式',
  `info_channel` varchar(100) NOT NULL COMMENT '获取渠道',
  `marketing` varchar(100) NOT NULL COMMENT '营销方式',
  `source_web` varchar(100) NOT NULL COMMENT '来源网站',
  `source_url` text NOT NULL COMMENT '来源网址',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `type_in` varchar(100) NOT NULL COMMENT '录入者',
  `time` varchar(100) NOT NULL COMMENT '预约时间',
  `in_time` varchar(100) NOT NULL COMMENT '录入时间',
  `doctor` varchar(100) DEFAULT NULL,
  `laiyuan` varchar(100) DEFAULT NULL,
  `huifang` varchar(100) DEFAULT NULL,
  `laiyuan_time` varchar(100) DEFAULT NULL,
  `qudao_group_id` varchar(100) NOT NULL,
  `isorder` tinyint(1) NOT NULL DEFAULT '1' COMMENT '预约或登记',
  `identitys` varchar(255) NOT NULL,
  `huifang_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=385 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_kefuinfo` */
 INSERT INTO `bk_kefuinfo` VALUES ('384','A0001','周城','2','会东县','3','74110','74110','男科','男科检查','111','111','个人微信','3','百度竞价','','','','0','2017-11-08','1511253134','--','否','否','','1','1','','0');/* MySQLReback Separation */
 /* 创建表结构 `bk_monthgoal` */
 DROP TABLE IF EXISTS `bk_monthgoal`;/* MySQLReback Separation */ CREATE TABLE `bk_monthgoal` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `yuefen` varchar(100) CHARACTER SET utf8 NOT NULL,
  `goalnum` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;/* MySQLReback Separation */
 /* 创建表结构 `bk_operation` */
 DROP TABLE IF EXISTS `bk_operation`;/* MySQLReback Separation */ CREATE TABLE `bk_operation` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `actions` varchar(150) NOT NULL,
  `ip_id` varchar(100) NOT NULL,
  `times` varchar(100) NOT NULL,
  `action_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1068 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_operation` */
 INSERT INTO `bk_operation` VALUES ('1067','添加预约信息-预约号：[A0001]成功！','127.0.0.1','1511253134','admin');/* MySQLReback Separation */
 /* 创建表结构 `bk_qudaogroup` */
 DROP TABLE IF EXISTS `bk_qudaogroup`;/* MySQLReback Separation */ CREATE TABLE `bk_qudaogroup` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `qudao_group_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_qudaogroup` */
 INSERT INTO `bk_qudaogroup` VALUES ('1','网络');/* MySQLReback Separation */
 /* 创建表结构 `bk_qudaoinfo` */
 DROP TABLE IF EXISTS `bk_qudaoinfo`;/* MySQLReback Separation */ CREATE TABLE `bk_qudaoinfo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `info_name` varchar(100) CHARACTER SET ucs2 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_qudaoinfo` */
 INSERT INTO `bk_qudaoinfo` VALUES ('3','网络');/* MySQLReback Separation */
 /* 创建表结构 `bk_qx` */
 DROP TABLE IF EXISTS `bk_qx`;/* MySQLReback Separation */ CREATE TABLE `bk_qx` (
  `qx_id` int(100) NOT NULL AUTO_INCREMENT,
  `qx_name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`qx_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_qx` */
 INSERT INTO `bk_qx` VALUES ('1','登记预约','fa-file-word-o'),('2','预约统计','fa-bar-chart'),('4','渠道分组','fa-window-maximize'),('5','渠道设置','fa-cogs'),('6','科室设置','fa-hospital-o'),('7','医生设置','fa-user-o'),('8','回访管理','fa-volume-control-phone'),('9','来诊统计','fa-line-chart'),('10','来诊对比','fa-area-chart'),('11','用户管理','fa-user-plus'),('14','数据库操作','fa-cog'),('15','回收站','fa-trash-o'),('16','操作日志','fa-file'),('13','手机设置','fa-mobile-phone'),('17','设置管理','fa-random');/* MySQLReback Separation */
 /* 创建表结构 `bk_qxgroup` */
 DROP TABLE IF EXISTS `bk_qxgroup`;/* MySQLReback Separation */ CREATE TABLE `bk_qxgroup` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `qx_name_1` varchar(100) NOT NULL,
  `qx_id` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '是否在列表显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_qxgroup` */
 INSERT INTO `bk_qxgroup` VALUES ('1','添加登记信息','1','Index/add','1'),('2','登记信息管理','1','Index/dengji','0'),('3','预约信息管理','1','Index/right','1'),('4','回访信息管理','1','Index/calls','1'),('5','导医资源列表','1','Index/daoyi_list','1'),('6','导出报表','1','Index/export','1'),('7','预约信息统计','2','Booking/info_list','1'),('8','预约地区统计','2','Booking/area_list','1'),('9','预约科室统计','2','Booking/keshi_list','1'),('10','预约咨询统计','2','Booking/zixun_list','1'),('11','预约关键词统计','2','Booking/keywords_list','1'),('12','添加地区','3','Area/add','0'),('13','地区管理','17','Area/area_list','1'),('14','添加分组','4','Qudaogroup/add','0'),('15','分组管理','4','Qudaogroup/qdgroup_list','1'),('16','添加渠道','5','Consult/consult_add','1'),('17','渠道管理','5','Consult/consult_list','1'),('18','添加渠道信息','5','Qudaoinfo/qdinfo_add','1'),('19','渠道信息管理','5','Qudaoinfo/qdinfo_list','1'),('20','添加来源网站','5','Web/web_add','1'),('21','来源网站管理','5','Web/web_list','1'),('22','添加营销方式','5','Yingxiao/yingxiao_add','1'),('23','营销方式管理','5','Yingxiao/yingxiao_list','1'),('24','科室管理','6','Section/section_list','1'),('25','添加医生','7','Doctor/doctor_add','0'),('26','医生管理','7','Doctor/doctor_list','1'),('27','添加回访','8','Callback/callback_add','1'),('28','回访设置','8','Callback/callback_list','1'),('29','咨询回访','8','Callback/hfsearch_list','1'),('30','电话回访','8','Callback/telsearch_list','1'),('31','导出回访','8','Callback/export','1'),('32','来诊科室统计','9','Statistics/keshi_list','1'),('33','来诊信息统计','9','Statistics/info_list','1'),('34','来诊咨询统计','9','Statistics/zixun_list','1'),('35','来诊地区统计','9','Statistics/area_list','1'),('36','信息对比','10','Compare/infoduibi','1'),('37','科室对比','10','Compare/ksduibi','1'),('38','渠道对比','10','Compare/consultduibi','1'),('39','地区对比','10','Compare/areaduibi','1'),('40','网站对比','10','Compare/webduibi','1'),('41','用户组管理','11','Manage/usergroup_list','1'),('53','登录Mac管理','17','Config/index/tps/2','1'),('43','目标列表','1','Monthgoal/monthgoal_list','1'),('44','备份及还原','14','Databack/index','1'),('45','查看回收信息','15','Recycle/recycle_list','1'),('46','查看日志','16','Operation/operation_list','1'),('47','手机号添加','13','Tel/tel_add','1'),('48','手机号管理','13','Tel/tel_list','1'),('49','导医手机','24','Mob/index','1'),('50','手机列表','1','Index/daoyi_mlist','1'),('51','病种管理','6','Section/bingzhong_list','1'),('52','登录Ip管理','17','Config/index/tps/1','1');/* MySQLReback Separation */
 /* 创建表结构 `bk_qxgroupbak` */
 DROP TABLE IF EXISTS `bk_qxgroupbak`;/* MySQLReback Separation */ CREATE TABLE `bk_qxgroupbak` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `qx_name_1` varchar(100) NOT NULL,
  `qx_id` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_qxgroupbak` */
 INSERT INTO `bk_qxgroupbak` VALUES ('1','添加登记信息','1','Index/add'),('2','登记信息管理','1','Index/dengji'),('3','预约信息管理','1','Index/right'),('4','回访信息管理','1','Index/calls'),('5','导医资源列表','1','Index/daoyi_list'),('6','导出报表','1','Index/export'),('7','预约信息统计','2','Booking/info_list'),('8','预约地区统计','2','Booking/area_list'),('9','预约科室统计','2','Booking/keshi_list'),('10','预约咨询统计','2','Booking/zixun_list'),('11','预约关键词统计','2','Booking/keywords_list'),('12','添加地区','3','Area/area_add'),('13','地区管理','3','Area/area_list'),('14','添加分组','4','Qudaogroup/qdgroup_add'),('15','分组管理','4','Qudaogroup/qdgroup_list'),('16','添加渠道','5','Consult/consult_add'),('17','渠道管理','5','Consult/consult_list'),('18','添加渠道信息','5','Qudaoinfo/qdinfo_add'),('19','渠道信息管理','5','Qudaoinfo/qdinfo_list'),('20','添加来源网站','5','Web/web_add'),('21','来源网站管理','5','Web/web_list'),('22','添加营销方式','5','Yingxiao/yingxiao_add'),('23','营销方式管理','5','Yingxiao/yingxiao_list'),('24','科室管理','6','Section/section_list'),('25','添加医生','7','Doctor/doctor_add'),('26','医生管理','7','Doctor/doctor_list'),('27','添加回访','8','Callback/callback_add'),('28','回访设置','8','Callback/callback_list'),('29','咨询回访','8','Callback/hfsearch_list'),('30','电话回访','8','Callback/telsearch_list'),('31','导出回访','8','Callback/export'),('32','来诊科室统计','9','Statistics/keshi_list'),('33','来诊信息统计','9','Statistics/info_list'),('34','来诊咨询统计','9','Statistics/zixun_list'),('35','来诊地区统计','9','Statistics/area_list'),('36','信息对比','10','Compare/infoduibi'),('37','科室对比','10','Compare/ksduibi'),('38','渠道对比','10','Compare/consultduibi'),('39','地区对比','10','Compare/areaduibi'),('40','网站对比','10','Compare/webduibi'),('41','用户组管理','11','Manage/usergroup_list'),('42','添加目标','12','Monthgoal/monthgoal_add'),('43','目标列表','12','Monthgoal/monthgoal_list'),('44','备份及还原','14','Databack/index'),('45','查看回收信息','15','Recycle/recycle_list'),('46','查看日志','16','Operation/operation_list'),('47','手机号添加','13','Tel/tel_add'),('48','手机号管理','13','Tel/tel_list'),('49','导医手机','24','Mob/index'),('50','手机列表','1','Index/daoyi_mlist'),('51','病种管理','6','Section/bingzhong_list');/* MySQLReback Separation */
 /* 创建表结构 `bk_section` */
 DROP TABLE IF EXISTS `bk_section`;/* MySQLReback Separation */ CREATE TABLE `bk_section` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_section` */
 INSERT INTO `bk_section` VALUES ('1','男科'),('3','不孕科'),('4','外科'),('5','其它');/* MySQLReback Separation */
 /* 创建表结构 `bk_tel` */
 DROP TABLE IF EXISTS `bk_tel`;/* MySQLReback Separation */ CREATE TABLE `bk_tel` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `phone` varchar(250) NOT NULL DEFAULT '',
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `bk_user` */
 DROP TABLE IF EXISTS `bk_user`;/* MySQLReback Separation */ CREATE TABLE `bk_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `phone` varchar(12) NOT NULL COMMENT '电话',
  `session_id` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=204 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_user` */
 INSERT INTO `bk_user` VALUES ('177','1','admin','21232f297a57a5a743894a0e4a801fc3','13068709985','','1498895236');/* MySQLReback Separation */
 /* 创建表结构 `bk_visit` */
 DROP TABLE IF EXISTS `bk_visit`;/* MySQLReback Separation */ CREATE TABLE `bk_visit` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `senddate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回访时间',
  `description` mediumtext,
  `writer` char(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=293 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `bk_web` */
 DROP TABLE IF EXISTS `bk_web`;/* MySQLReback Separation */ CREATE TABLE `bk_web` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `bk_yingxiao` */
 DROP TABLE IF EXISTS `bk_yingxiao`;/* MySQLReback Separation */ CREATE TABLE `bk_yingxiao` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `yingxiao_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `bk_yingxiao` */
 INSERT INTO `bk_yingxiao` VALUES ('1','百度竞价'),('2','电话营销');/* MySQLReback Separation */