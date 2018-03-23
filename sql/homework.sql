CREATE TABLE `homework_record` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '作业唯一ID',
  `creator_uuid` VARCHAR(100) DEFAULT '' COMMENT '创建者ID',
  `class` VARCHAR(100) DEFAULT '' COMMENT '班级ID',
  `subject` INT(11) NOT NULL DEFAULT 0 COMMENT '科目',
  `homework_name` VARCHAR(100) DEFAULT '' COMMENT '作业名称',
  `homework_status` TINYINT(4) DEFAULT 0 COMMENT '作业状态 0:已创建 1:布置完成 2:已发送',
  `homework_date` DATE DEFAULT '0000-00-00' COMMENT '布置作业日期',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_creator_uuid` (`creator_uuid`),
  KEY `idx_homework_status` (`homework_status`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '作业记录表';

CREATE TABLE `homework_item` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '作业条目唯一ID',
  `homework_uuid` VARCHAR(100) DEFAULT '' COMMENT '作业记录ID',
  `creator_uuid` VARCHAR(100) DEFAULT '' COMMENT '创建者ID',
  `homework_content` TEXT COMMENT '作业内容',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_homework_uuid`(`homework_uuid`),
  KEY `idx_creator_uuid` (`creator_uuid`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '作业条目表';

CREATE TABLE `homework_schedule` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '作业条目唯一ID',
  `homework_item_uuid` VARCHAR(100) DEFAULT '' COMMENT '作业记录ID',
  `recorder_uuid` VARCHAR(100) DEFAULT '' COMMENT '记录者ID',
  `cost_time` INT(11) DEFAULT 0 COMMENT '花费时间,单位:分钟',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_homework_item_uuid`(`homework_item_uuid`),
  KEY `idx_recorder_uuid` (`recorder_uuid`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '作业进度表';