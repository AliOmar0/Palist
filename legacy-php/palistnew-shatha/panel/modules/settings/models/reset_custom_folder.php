<?php
	trash(custom_dir);
	indexer(cd,'custom_config');
	indexer(cd,'custom_logout');
	indexer(cd,'custom_controller');
	indexer(cd,'custom_croner');
	indexer(cd,'custom_functions','js');
	indexer(cd,'custom_index');
	indexer(cd,'custom_list');
	indexer(cd,'custom_module_response');
	indexer(cd,'custom_meta');
	indexer(cd,'custom_preViewFormEnd');
	indexer(cd,'custom_style','css');
	indexer(cd,'htaccess','txt');
	indexer(cd);
	indexer(cd.'custom_links/');
	indexer(cd.'custom_files/');
	indexer(cd.'custom_files/custom_private/');
	
	$f=fopen(cd.'custom_files/custom_private/.htaccess','w');
	fwrite($f,'Deny from all');
	fclose($f);
	
	json(true,2,NULL,'Cleaned');