-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-04-30 14:08:30
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `redrock_wx_game15`
--

-- --------------------------------------------------------

--
-- 表的结构 `question1`
--

CREATE TABLE IF NOT EXISTS `question1` (
  `qid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `ans_A` varchar(50) NOT NULL,
  `ans_B` varchar(50) NOT NULL,
  `ans_C` varchar(50) NOT NULL,
  `ans_D` varchar(50) NOT NULL,
  `true_ans` int(1) unsigned NOT NULL,
  PRIMARY KEY (`qid`),
  UNIQUE KEY `qid` (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `question1`
--

INSERT INTO `question1` (`qid`, `question`, `ans_A`, `ans_B`, `ans_C`, `ans_D`, `true_ans`) VALUES
(1, '红岩网校成立时间：', '2000年8月', '2000年9月', '2000年10月', '2000年11月', 3),
(2, '红岩网校的创办是由：', '学生自发组织创办', '党委领导创办', '团委领导创办', '都不是', 2),
(3, '红岩网校工作站以怎样的形式招新：', '党委老师组织', '团委老师组织', '通过学业考试选拔', '网校学生干部组织', 4),
(4, '红岩网校有几个部门:', '4', '5', '6', '7', 2),
(5, '红岩网校工作站微信服务号关注量目前为止已有：', '3万多', '2万多', '1万多', '不到1万', 2),
(6, '红岩网校工作站的官方微博的用户名：', '红岩网校工作站', '重庆邮电大学红-岩网校工作站', '重邮红岩网校工作站', '红岩网校', 2),
(7, '红岩网校的最新线上交易平台是：', '掌上重邮', '幽幽黄桷兰', 'BT当铺', '拾货', 4),
(8, '以下不属于掌上重邮的功能的是：', '查课表', '发现', '你问我答', '教务信息', 3),
(9, '下列不属于BTDown铺的板块的是：', '中外影视', '动漫飞闪 电视节目', '程序软件', '各类学习视屏', 3),
(10, '以下不属于拾货的功能板块的是:', '格子铺', '换货', '公益', '求货', 3),
(11, '红岩网校工作站开发掌上重邮的部门是:', 'web研发部', '移动开发部', ' 运营维护部', '视觉设计部', 2),
(12, '下面不属于重邮小帮手曾经推送的活动是:', '元宵节猜灯谜', ' 拉拉队大比拼', ' 小帮手带你赏樱花', '微信游戏争霸赛', 3),
(13, '下面不属于幽幽黄桷兰的板块的是:', '休闲娱乐  ', '学习天地 ', '校园生活', '最爱重邮', 4),
(14, '红岩网校工作站通过怎样的方式培训学员：', '党委老师组织培训', '团委老师组织培训', '专业老师组织培训', '学生干部组织培训', 4),
(15, '红岩网校网址大全的格局是：', '“一校、八网、十九站”的格局', '“一校、四网、十四站”的格局', '“一校、七网、十八站”的格局', '“一校、五网、十三站”的格局', 4),
(16, '下列不属于重邮小帮手微信游戏的是：', '奔跑吧兄弟', '赏樱花', '夸父追日', '拼拼价值观', 2),
(17, '下列不属于红岩网校获得的单项奖是：', '最佳思政创新奖', '最佳廉洁文化奖', '最佳精神文明奖', '最佳新闻宣传奖', 3),
(18, '红岩网校工作站每年在什么时候举办的“笑脸见面会”：', '四月校运会', '三月赏樱花', '九月迎新生', '六月毕业季', 3),
(19, '下面哪个红岩网校产品能够“发现周围美食”：', '重邮小帮手', '掌上重邮', '幽幽黄桷兰', 'BTdown铺', 2),
(20, '每年校运会由红岩网校举办的拉拉队大比拼活动会在什么平台进行投票：', '幽幽黄桷兰', '重邮小帮手', '掌上重邮', '拾货', 2),
(21, '重邮小帮手已成立：', '五周年', '三周年', '两周年', '一周年', 3),
(22, '红岩网校工作站官方QQ常被同学们称戏为：', '代码君', '主页菌', '红岩君', '小帮手', 2),
(23, '由红岩网校自主开发的最新线上交易平台是：', '二手市场', '拾货', '幽幽黄桷兰', 'BTdown铺', 2),
(24, '在红岩网校工作站中负责对网站产品和服务推广设计视觉交互界面的部门是：', 'web研发部', '视觉设计部', '运营维护部', '移动开发部', 2),
(25, '在红岩网校工作站中负责手机端的开发,APP的开发制作的部门是：', 'Web研发部', '移动开发部', '运营维护部', '视觉设计部', 2),
(26, '在红岩网校工作站中负责网站的交互设计工作,后台管理系统的部门是：', 'Web研发部', '移动开发部', '运营维护部', '管理规划部', 1),
(27, '在红岩网校工作站中负责工作站产品的运营推广，网站专题及线上线下活动的策划和制作的部门是：', 'Web研发部', '移动开发部', '运营维护部', '视觉设计部', 3),
(28, '在红岩网校工作站中负责工作站日常管理工作；组织工作站内部活动；协调项目进度与内容的更新的部门是：', '视觉设计部', '管理规划部', '运营维护部', '移动开发部', 2);

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `wx_id` varchar(50) NOT NULL,
  `whichDay` int(2) NOT NULL,
  `times` int(2) unsigned NOT NULL DEFAULT '0',
  `grade` int(3) unsigned NOT NULL DEFAULT '0',
  `askTime` int(15) NOT NULL,
  PRIMARY KEY (`wx_id`,`whichDay`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`wx_id`, `whichDay`, `times`, `grade`, `askTime`) VALUES
('1', 1, 5, 60, 0),
('2', 4, 2, 30, 0),
('ouRCyjhbyphqHJ0P_pa8wvhmEJ9A', 30, 1, 43, 1430393553);

-- --------------------------------------------------------

--
-- 表的结构 `share`
--

CREATE TABLE IF NOT EXISTS `share` (
  `wx_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `shareDay` int(3) unsigned NOT NULL,
  PRIMARY KEY (`wx_id`,`shareDay`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- 转存表中的数据 `share`
--

INSERT INTO `share` (`wx_id`, `shareDay`) VALUES
('ouRCyjhbyphqHJ0P_pa8wvhmEJ9A', 30);

-- --------------------------------------------------------

--
-- 表的结构 `wx_user`
--

CREATE TABLE IF NOT EXISTS `wx_user` (
  `wx_id` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  `joinDays` int(2) unsigned NOT NULL DEFAULT '0',
  `sex` int(2) NOT NULL,
  PRIMARY KEY (`wx_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_user`
--

INSERT INTO `wx_user` (`wx_id`, `name`, `img_src`, `joinDays`, `sex`) VALUES
('ouRCyjhbyphqHJ0P_pa8wvhmEJ9A', '意大利特╭(种马)╮', 'http://wx.qlogo.cn/mmopen/ialNEPD41CRgnp4devzygqkovPYiaf5qKprY5wXnP3HQhcz5FQmSicmia7fKwchibx4Iej4sjR1a5R8BYGcn6icrvyA0ZibHyibeSxSl/0', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
