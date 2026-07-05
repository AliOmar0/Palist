CREATE TABLE `connections_1565698558` (
		 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		 `date_modified` datetime DEFAULT NULL,
 		`admin_add_id` int(11) NOT NULL DEFAULT '0',
		 `date_created` datetime DEFAULT NULL,
	    `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`deleted` tinyint(1) NOT NULL DEFAULT '0',
		`restricted` tinyint(1) NOT NULL DEFAULT '0',
        
		    `g_analytics` VARCHAR(1000) DEFAULT NULL  COMMENT 'G Analytics',
		    `facebook_page_id` VARCHAR(250) DEFAULT NULL  COMMENT 'Facebook Page ID',
		    `facebook_chat_color` VARCHAR(10) DEFAULT NULL  COMMENT 'Facebook Chat Color',
		    `fb_app_id` VARCHAR(250) DEFAULT NULL  COMMENT 'FB App ID',
		    `fb_app_secret_key` VARCHAR(250) DEFAULT NULL  COMMENT 'FB App Secret Key',
		    `fb_app_analytics` VARCHAR(1500) DEFAULT NULL  COMMENT 'FB App Analytics',
		    `fb_pixel` VARCHAR(1500) DEFAULT NULL  COMMENT 'FB Pixel',
		    `onesignal_app_id` VARCHAR(250) DEFAULT NULL  COMMENT 'OneSignal App ID',
		    `onesignal_app_secret_key` VARCHAR(250) DEFAULT NULL  COMMENT 'OneSignal App Secret Key',
		    `firebase_file_name` VARCHAR(250) DEFAULT NULL  COMMENT 'Firebase File Name',
		    `sharethis` TEXT DEFAULT NULL  COMMENT 'Sharethis',
		    `head_js` VARCHAR(1000) DEFAULT NULL  COMMENT 'Head JS',
		    `footer_js` TEXT DEFAULT NULL  COMMENT 'Footer JS',
PRIMARY KEY (`id`),
INDEX (`deleted`)

) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;