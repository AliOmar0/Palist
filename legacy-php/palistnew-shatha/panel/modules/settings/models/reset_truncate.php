<?php

	$truncate_modules=['menu_items_1564508835','link_handler_1566934564','apps_1552305519','control_1566842582','tester_1565720578','tokens','cookies_1565697908','quick_access_1563567918','bulk_push_notification_1633289547','sms_1583164170','psn_1627841195','notifier_1644648674','web_notifications_1644647708','color_palette_1645099749','pages_1478423482','access_history','bulk_sms_1652425418','access_history','statistics_box_8324','statistics_8324','comments','privileges_1565709771','documentation_items_8343','documentations_8343','meepo_1646265283','complementary_1614118171','codes_8311','entries_log_8503','croner_8308','stats_867138'];
	
	foreach($truncate_modules as $_mod){
		mysqli_query($conn,"TRUNCATE $_mod");
	}
	
	mysqli_query($conn,"DELETE FROM mailer_1565894237 WHERE id!=2 AND id!=3 AND id!=1");
	mysqli_query($conn,"DELETE FROM languages_1557157519 WHERE id!=1 AND id!=2");
	mysqli_query($conn,"DELETE FROM menu_1564508145 WHERE id!=1");
	
	$_POST['internal']=true;
    require modules_dir.'settings/models/reset_htaccess.php';
	
	json(true,2,NULL,'Truncated '.count($truncate_modules).' modules');