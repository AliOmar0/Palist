<?php
require 'panel/core/config.php';

/**
 * Note 1
 * 
 * Define 'protected_covered' and set to true in custom_config, as super and owner will always view files, for other admins/users/custom users u need to setup function in custom_config.php can_download_protected($file_entry), process the needs, for failure return false, for success return the file itself '$file_entry'
 * 
 * 
 * IGNORE NOTE 2
 * 
 * 
 * Note 2:
 * you need to activate the new layer of protection by using defining 'protected_covered' and set to true in custom_config, as next releases will break old protected handling
 * to generate a one time link, u need to replace 'url' and 'thumbnail_url' with protected_hasher($vars)
 * 
 */
function show_no_permission() {
	$file_path=target_dir.'noPermission.png';
	header('Content-type:'.mime_content_type($file_path));
	header('Content-Length:'.filesize($file_path));
	header('Content-Disposition:attachment;filename=noPermission.png');
	readfile($file_path);
	exit();
}

if(defined('protected_covered') && protected_covered==true){
	
	if(isset($_GET['file'])){
		$protected_handle_result=protected_unhasher();

		if($protected_handle_result!==false && isset($protected_handle_result['_path'])){
			
			$file_path=$protected_handle_result['_path'];
			header('Content-type:'.mime_content_type($file_path));
			header('Content-Length:'.filesize($file_path));
			header('Content-Disposition:attachment;filename='.$protected_handle_result['full_name']);
			readfile($file_path);
			exit();
		}
	}
}

show_no_permission();