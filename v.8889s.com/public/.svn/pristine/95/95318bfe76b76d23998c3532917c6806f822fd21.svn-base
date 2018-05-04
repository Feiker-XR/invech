-- 用户状态信息
DROP TABLE IF EXISTS `nitalk_session`;
CREATE TABLE `nitalk_session` (
	`uid` int(11) unsigned NOT NULL DEFAULT '0', -- 会员ID
	`sessid` varchar(255) NOT NULL DEFAULT '', -- session
	`active` int(10) unsigned NOT NULL DEFAULT '0', -- 活跃时间
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- 用户聊天数据
DROP TABLE IF EXISTS `nitalk_chat`;
CREATE TABLE `nitalk_chat` (
	`cid` int(11) unsigned NOT NULL auto_increment, -- 数据ID
	`key` char(16) NOT NULL DEFAULT '', -- 聊天标识
	`fromuid` int(11) unsigned NOT NULL DEFAULT '0', -- 发件人ID
	`fromusername` varchar(16) NOT NULL DEFAULT '', -- 发件人名称
	`touid` int(11) unsigned NOT NULL DEFAULT '0', -- 收件人ID
	`type` tinyint(1) unsigned NOT NULL DEFAULT '0', -- 聊天类型(0：用户之间聊天，1：用户与客服聊天)
	`sendtime` int(10) unsigned NOT NULL DEFAULT '0', -- 记录发送时间
	`sendday` char(8) NOT NULL DEFAULT '', -- 记录发送日期
	`status` tinyint(1) unsigned NOT NULL DEFAULT '0', -- 信息状态(0：未读，1：已读)
	`msg` text, -- 聊天内容
	PRIMARY KEY (`cid`),
	KEY `get_new_msg` (`touid`,`status`),
	KEY `history` (`key`,`sendday`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;