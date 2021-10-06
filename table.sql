CREATE TABLE `lx_blog` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gmt_create` datetime DEFAULT NULL COMMENT '创建时间',
  `gmt_modify` datetime DEFAULT NULL COMMENT '修改时间',
  `title` varchar(1024) DEFAULT NULL COMMENT '博客标题',
  `img_url` varchar(512) DEFAULT NULL COMMENT '图片地址',
  `keywords` varchar(512) DEFAULT NULL COMMENT '关键词，用于seo',
  `description` varchar(1024) DEFAULT NULL COMMENT '博客描述，用于seo',
  `tags` varchar(256) DEFAULT NULL COMMENT 'tag列表',
  `abstract` varchar(1024) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '博客正文',
  `readCount` bigint(20) DEFAULT NULL COMMENT '阅读次数',
  `blog_big_type` varchar(128) DEFAULT NULL COMMENT '大的分类：生活，技术',
  `blog_small_type` varchar(128) DEFAULT NULL COMMENT '小的分类',
  `small_type_order` bigint(20) DEFAULT NULL COMMENT '小的分类的顺序',
  `is_deleted` tinyint(4) DEFAULT '0' COMMENT '是否被删除',
  `show_order` bigint(20) DEFAULT '0' COMMENT '排列顺序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COMMENT='博客表';

CREATE TABLE `lx_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gmt_create` datetime DEFAULT NULL COMMENT '创建时间',
  `gmt_modify` datetime DEFAULT NULL COMMENT '修改时间',
  `blog_id` bigint(20) DEFAULT NULL COMMENT '博客的ID',
  `username` varchar(512) DEFAULT NULL COMMENT '用户名',
  `email` varchar(512) DEFAULT NULL COMMENT '邮箱',
  `website` varchar(512) DEFAULT NULL COMMENT '手机号',
  `content` text COMMENT '评论内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COMMENT='评论表';

CREATE TABLE `lx_picture` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gmt_create` datetime DEFAULT NULL COMMENT '创建时间',
  `gmt_modify` datetime DEFAULT NULL COMMENT '修改时间',
  `pic_name` varchar(512) DEFAULT NULL COMMENT '图片名称',
  `pic_url` varchar(512) DEFAULT NULL COMMENT '图片路径',
  `pic_size` varchar(128) DEFAULT NULL COMMENT '图片大小',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COMMENT='图片表';

CREATE TABLE `lx_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gmt_create` datetime DEFAULT NULL COMMENT '创建时间',
  `gmt_modify` datetime DEFAULT NULL COMMENT '修改时间',
  `tagname` varchar(256) DEFAULT NULL COMMENT '标签',
  `count` bigint(20) DEFAULT NULL COMMENT '标签被引用的次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COMMENT='标签表';

CREATE TABLE `lx_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gmt_create` datetime DEFAULT NULL COMMENT '创建时间',
  `gmt_modify` datetime DEFAULT NULL COMMENT '修改时间',
  `username` varchar(64) DEFAULT NULL COMMENT '用户名，邮箱',
  `nickname` varchar(64) DEFAULT NULL COMMENT '昵称',
  `passwd` varchar(64) DEFAULT NULL COMMENT '密码',
  `head_url` varchar(256) DEFAULT NULL COMMENT '头像',
  `extension` varchar(1024) DEFAULT NULL COMMENT '扩展字段，json格式，用来存推荐博客的id，{recomendId:1}',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';
