CREATE TABLE `school_record` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '学校唯一ID',
  `school_name` VARCHAR(200) DEFAULT '' COMMENT '学校名称',
  `school_level` TINYINT(4) DEFAULT 0 COMMENT '学校类型 0:小学 1:初中 2:高中',
  `school_attribution` INT(11) DEFAULT 0 COMMENT '学校归属地',
  `school_status` TINYINT(4) DEFAULT 0 COMMENT '学校状态 0:预注册 1:正常，2:挂失(临时不用) 3:注销(永久不用)',
  `administrator_uuid` VARCHAR(500) DEFAULT '' COMMENT '管理员ID,多个用户以逗号分隔,最多5个',
  `register_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_school_level` (`school_level`),
  KEY `idx_school_attribution` (`school_attribution`),
  KEY `idx_school_status` (`school_status`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '学校记录表';

CREATE TABLE `class_record` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '班级唯一ID',
  `school_uuid` VARCHAR(200) DEFAULT '' COMMENT '所属学校ID',
  `class_name` VARCHAR(10) DEFAULT '' COMMENT '班级名称',
  `class_create_grade` TINYINT(4) DEFAULT 0 COMMENT '班级建立时年级',
  `class_create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '班级建立时间',
  `class_grade` TINYINT(4) DEFAULT 0 COMMENT '班级当前年级',
  `graduate_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '预期毕业期限',
  `class_status` TINYINT(4) DEFAULT 0 COMMENT '班级状态 0:预创建 1:正常 2:已毕业 3:毕业后保留',
  `class_master` VARCHAR(500) DEFAULT '' COMMENT '班主任ID,多个用户以逗号分隔,最多5个',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_school_id` (`school_uuid`),
  KEY `idx_class_grade` (`class_grade`),
  KEY `idx_class_status` (`class_status`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '班级记录表';

CREATE TABLE `teacher_record` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '教师唯一ID',
  `phone` VARCHAR(20) DEFAULT '' COMMENT '手机号',
  `name` VARCHAR(100) DEFAULT '' COMMENT '教师姓名',
  `wx_nick_name` VARCHAR(100) DEFAULT '' COMMENT '教师姓名',
  `wx_open_id` VARCHAR(100) DEFAULT '' COMMENT '微信OpenID',
  `wx_union_id` VARCHAR(100) DEFAULT '' COMMENT '微信开发平台唯一ID',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_phone` (`phone`),
  KEY `idx_name` (`name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '教师记录表';

CREATE TABLE `parent_record` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '教师唯一ID',
  `phone` VARCHAR(20) DEFAULT '' COMMENT '手机号',
  `name` VARCHAR(100) DEFAULT '' COMMENT '教师姓名',
  `wx_nick_name` VARCHAR(100) DEFAULT '' COMMENT '教师姓名',
  `wx_open_id` VARCHAR(100) DEFAULT '' COMMENT '微信OpenID',
  `wx_union_id` VARCHAR(100) DEFAULT '' COMMENT '微信开发平台唯一ID',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_phone` (`phone`),
  KEY `idx_name` (`name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '教师记录表';

CREATE TABLE `student_record` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT COMMENT '主键,自增ID',
  `uuid` VARCHAR(100) DEFAULT '' COMMENT '教师唯一ID',
  `phone` VARCHAR(20) DEFAULT '' COMMENT '手机号',
  `name` VARCHAR(100) DEFAULT '' COMMENT '教师姓名',
  `wx_nick_name` VARCHAR(100) DEFAULT '' COMMENT '教师姓名',
  `wx_open_id` VARCHAR(100) DEFAULT '' COMMENT '微信OpenID',
  `wx_union_id` VARCHAR(100) DEFAULT '' COMMENT '微信开发平台唯一ID',
  `create_time` TIMESTAMP DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uuid` (`uuid`),
  KEY `idx_phone` (`phone`),
  KEY `idx_name` (`name`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT = '学生记录表';