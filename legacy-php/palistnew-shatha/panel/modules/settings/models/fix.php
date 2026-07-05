<?php
if(!file_exists(cd.'custom_logout.php'))
	indexer(cd,'custom_logout');

	if(!file_exists(cd.'custom_meta.php'))
	indexer(cd,'custom_meta');

	if(!file_exists(cd.'custom_croner.php'))
	indexer(cd,'custom_croner');

	if(!file_exists(cd.'custom_files/index.php'))
		indexer(cd.'custom_files/');

	if(!file_exists(cd.'custom_files/custom_private/index.php'))
		indexer(cd.'custom_files/custom_private/');
	
	if(!file_exists(cd.'custom_files/custom_private/.htaccess')){
		$f=fopen(cd.'custom_files/custom_private/.htaccess','w');
		fwrite($f,'Deny from all');
		fclose($f);
	}

if(!file_exists(cd.'custom_preViewFormEnd.php'))
	indexer(cd,'custom_preViewFormEnd');


	if(!file_exists(_protected)){
		indexer(_protected);
		$ht=fopen(_protected.'.htaccess','w');
		fwrite($ht,'Deny from  all');
		fclose($ht);
	}


	indexer(cms_dir,'robots','txt',"User-agent: *
Allow: /
Disallow: /panel/
Disallow: /res/
Disallow: /plugins/
Disallow: /comp/
Disallow: /protected/

Sitemap: ".url."sitemap.xml
");

if(file_exists(cms_dir.'sw.js'))trash(cms_dir.'sw.js');
if(file_exists(fres_dir.'js/serviceCommander.js'))trash(fres_dir.'js/serviceCommander.js');

json(true,2,NULL,'Fixed');