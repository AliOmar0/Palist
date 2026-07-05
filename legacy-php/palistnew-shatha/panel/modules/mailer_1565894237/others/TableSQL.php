CREATE TABLE `mailer_1565894237` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `email_title` VARCHAR(250) DEFAULT NULL  COMMENT 'Email Title',
		    `module_id` INT(11) DEFAULT NULL  COMMENT 'Module ID',
		    `module_action` INT(11) DEFAULT NULL  COMMENT 'Module Action',
		    `from_email` VARCHAR(250) DEFAULT NULL  COMMENT 'From Email',
		    `include_site_name` BOOLEAN  DEFAULT '1' COMMENT 'Include Site Name',
		    `to_email` VARCHAR(250) NOT NULL  COMMENT 'To Email',
		    `cc_email` VARCHAR(250) DEFAULT NULL  COMMENT 'CC Email',
		    `bcc_email` VARCHAR(250) DEFAULT NULL  COMMENT 'BCC Email',
		    `reply_email` VARCHAR(250) DEFAULT NULL  COMMENT 'Reply Email',
		    `content` TEXT DEFAULT NULL  COMMENT 'Content',
		    `extra_css` TEXT DEFAULT NULL  COMMENT 'Extra CSS',
PRIMARY KEY (`id`),
INDEX (`deleted`)
,INDEX (`module_id`),INDEX (`module_action`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;