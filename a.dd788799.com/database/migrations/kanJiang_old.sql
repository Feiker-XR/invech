DELIMITER $$

USE `alafei`$$

DROP PROCEDURE IF EXISTS `kanJiang`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kanJiang`(IN `_betId` INT, IN `_zjCount` INT, IN `_kjData` VARCHAR(255), IN `_kset` VARCHAR(255))
BEGIN
	
	DECLARE `uid` INT;									-- 抢庄人ID
	DECLARE qz_uid INT;									-- 抢庄人ID
	DECLARE qz_username VARCHAR(32) CHARACTER SET utf8;	-- 抢庄人用户名
	DECLARE qz_fcoin VARCHAR(32);						-- 抢庄冻结资金
	
	DECLARE parentId INT;								-- 投注人上级ID
	DECLARE username VARCHAR(32) CHARACTER SET utf8;	-- 投注人帐号

	
	-- 投注
	DECLARE actionNum INT;
	DECLARE serializeId VARCHAR(64);
	DECLARE actionData LONGTEXT CHARACTER SET utf8;
	DECLARE actionNo VARCHAR(255);
	DECLARE lotteryNo VARCHAR(255);
	DECLARE `type` INT;
	DECLARE playedId INT;
	
	DECLARE isDelete INT;
	
	DECLARE fanDian FLOAT;		-- 返点
	DECLARE `mode` FLOAT;		-- 模式
	DECLARE beiShu INT;			-- 倍数
	DECLARE zhuiHao INT;		-- 追号剩余期数
	DECLARE zhuiHaoMode INT;	-- 追号是否中奖停止追号
	DECLARE bonusProp FLOAT;	-- 赔率
	
	DECLARE amount FLOAT;					-- 投注总额
	DECLARE zjAmount FLOAT DEFAULT 0;		-- 中奖总额
	DECLARE _fanDianAmount FLOAT DEFAULT 0;	-- 总返点的钱

	DECLARE chouShuiAmount FLOAT DEFAULT 0;	-- 总抽水钱
	
	DECLARE liqType INT;
	DECLARE info VARCHAR(255) CHARACTER SET utf8;
	
	DECLARE _parentId INT;		-- 处理上级时返回

	DECLARE _fanDian FLOAT;		-- 用户返点
	DECLARE qz_fanDian FLOAT;	-- 抢庄人返点

	
	DECLARE fpEnable INT;	            -- 是否飞盘 针对快乐8
	DECLARE fpNum INT DEFAULT 1;	    -- 飞盘倍数 针对快乐8
	

	-- 提取投注信息
	DECLARE done INT DEFAULT 0;
	DECLARE cur CURSOR FOR
	SELECT b.`uid`, u.parentId, u.username, b.qz_uid, b.qz_username, b.qz_fcoin, b.actionNum, b.serializeId, b.actionData, b.actionNo,b.lotteryNo, b.`type`, b.playedId, b.isDelete, b.fanDian, u.fanDian, b.`mode`, b.beiShu, b.zhuiHao, b.zhuiHaoMode, b.bonusProp, b.actionNum*b.`mode`*b.beiShu*(b.fpEnable+1)  amount, b.fpEnable FROM gygy_bets b, gygy_members u WHERE b.`uid`=u.`uid` AND b.id=_betId;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;
	
	OPEN cur;
		REPEAT
			FETCH cur INTO `uid`, parentId, username, qz_uid, qz_username, qz_fcoin, actionNum, serializeId, actionData, actionNo, lotteryNo, `type`, playedId, isDelete, fanDian, _fanDian, `mode`, beiShu, zhuiHao, zhuiHaoMode, bonusProp, amount, fpEnable;
		UNTIL done END REPEAT;
	CLOSE cur;
	
	-- select `uid`, parentId, username, qz_uid, qz_username, qz_fcoin, actionNum, serializeId, actionData, actionNo, `type`, playedId, isDelete, fanDian, _fanDian, `mode`, beiShu, zhuiHao, zhuiHaoMode, bonusProp, amount;

	-- 开始事务

	START TRANSACTION;
	IF MD5(_kset)='47df5dd3fc251a6115761119c90b964a' THEN
	
		-- 已撤单处理，不进行处理

		IF isDelete=0 AND lotteryNo='' THEN
			
			-- 开奖扣除冻结资金

			-- set liqType=108;
			-- set info='开奖扣除冻结资金';
			-- call setCoin(0, - amount, `uid`, liqType, `type`, info, _betId, '', '');
			
			-- 处理积分
			CALL addScore(`uid`, amount);
		
			-- select fanDian, parentId, qz_uid;
			-- 处理自己返点
			IF fanDian THEN
				SET liqType=2;
				SET info='返点';
				SET _fanDianAmount=amount * fanDian/100;
				CALL setCoin(_fanDianAmount, 0, `uid`, liqType, `type`, info, _betId, '', '');
			END IF;
			
			-- 循环处理上级返点
			SET _parentId=parentId;
			-- set _fanDian=fanDian;
			SET fanDian=_fanDian;
			
			WHILE _parentId>1 DO
				CALL setUpFanDian(amount, _fanDian, _parentId, `type`, _betId, `uid`, username);
			END WHILE;
			SET _fanDianAmount = _fanDianAmount + amount * ( _fanDian - fanDian)/100;
			-- select _fanDian , fanDian, _fanDianAmount;
			
			-- 如果有人抢庄，循环处理上级抽水

			IF qz_uid THEN
				
				-- 投注资金付给抢庄人

				CALL getQzInfo(qz_uid, _fanDian, _parentId);
				-- select qz_uid, _parentId, _fanDian;
				SET qz_fanDian=_fanDian;
				
				WHILE _parentId DO
					CALL setUpChouShui(amount, _fanDian, _parentId, `type`, _betId, qz_uid, qz_username);
					-- select amount, _fanDian, _parentId, `type`, _betId, qz_uid, qz_username;
				END WHILE;
				
				-- 平台抽3%水

				SET chouShuiAmount=amount * ( _fanDian - qz_fanDian + 3) / 100;
				-- select chouShuiAmount, _fanDian, qz_fanDian;
			END IF;
			
			
			-- 处理奖金
			IF _zjCount THEN
				-- 中奖处理
				
				SET liqType=6;
				SET info='中奖奖金';
				IF fpEnable AND INSTR(_kjData,'|') THEN 
					-- 飞盘处理
					SET fpNum=SUBSTRING(_kjData, INSTR(_kjData,'|')+1)+0;
					SET zjAmount=fpNum * bonusProp * _zjCount * beiShu * `mode`/2;
				ELSE
					SET zjAmount=bonusProp * _zjCount * beiShu * `mode`/2;
				END IF;
				
				CALL setCoin(zjAmount, 0, `uid`, liqType, `type`, info, _betId, '', '');
	
			END IF;
			
			-- 更新开奖数据

			UPDATE gygy_bets SET lotteryNo=_kjData, zjCount=_zjCount, bonus=zjAmount, fanDianAmount=_fanDianAmount, qz_chouShui=chouShuiAmount WHERE id=_betId;

			-- 处理追号
			IF _zjCount AND zhuiHao=1 AND zhuiHaoMode=1 THEN
				-- 如果是追号单子

				-- 并且中奖时停止追号的单子
				-- 给后续单子撤单

				CALL cancelBet(serializeId);
			END IF;
			
			-- 给抢庄人派奖
			IF qz_uid THEN
				SET liqType=10;
				SET info='解冻抢庄冻结资金';
				CALL setCoin(qz_fcoin, - qz_fcoin, qz_uid, liqType, `type`, info, _betId, '', '');
				
				SET liqType=11;
				SET info='收单';
				CALL setCoin(amount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				
				IF _fanDianAmount THEN
					SET liqType=103;
					SET info='支付返点';
					CALL setCoin(-_fanDianAmount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				END IF;
				
				IF chouShuiAmount THEN
					SET liqType=104;
					SET info='支付抽水';
					CALL setCoin(-chouShuiAmount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				END IF;
				
				IF zjAmount THEN
					SET liqType=105;
					SET info='赔付中奖金额';
					CALL setCoin(-zjAmount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				END IF;
	
			END IF;

		END IF;
	END IF;

	-- 提交事务
	COMMIT;
	
END$$

DELIMITER ;