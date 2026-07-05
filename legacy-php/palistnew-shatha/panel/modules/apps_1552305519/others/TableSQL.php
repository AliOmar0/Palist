CREATE TABLE `apps_1552305519` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `app_name` VARCHAR(250) NOT NULL  COMMENT 'App Name',
		    `app_icon` VARCHAR(1000) DEFAULT NULL  COMMENT 'App Icon',
		    `apple_version` VARCHAR(250) NOT NULL  COMMENT 'Apple Version',
		    `apple_store_id` VARCHAR(250) DEFAULT NULL  COMMENT 'Apple Store ID',
		    `ios_active` BOOLEAN NOT NULL DEFAULT '1' COMMENT 'iOS Active',
		    `ios_download_image` VARCHAR(1000) DEFAULT NULL  COMMENT 'iOS Download Image',
		    `android_version` VARCHAR(250) NOT NULL  COMMENT 'Android Version',
		    `android_store_id` VARCHAR(250) DEFAULT NULL  COMMENT 'Android Store ID',
		    `android_active` BOOLEAN  DEFAULT '1' COMMENT 'Android Active',
		    `android_download_image` VARCHAR(1000) DEFAULT NULL  COMMENT 'Android Download Image',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;