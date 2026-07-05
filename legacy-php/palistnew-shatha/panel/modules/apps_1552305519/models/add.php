<?php
//Validate required fields
$_module='apps_1552305519';
validateFields($_module,$action);

if(
	!isset($_POST['app_name']) || $_POST['app_name']==""||
	!isset($_POST['app_icon'])||
	!isset($_POST['apple_version']) || $_POST['apple_version']==""||
	!isset($_POST['apple_store_id'])||
	!isset($_POST['ios_download_image'])||
	!isset($_POST['android_version']) || $_POST['android_version']==""||
	!isset($_POST['android_store_id'])||
	!isset($_POST['android_download_image'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$app_name=e('app_name');
$app_icon=e('app_icon');
$apple_version=e('apple_version');
$apple_store_id=e('apple_store_id');
$ios_active=(isset($_POST['ios_active'])  && $_POST['ios_active']!='0' ? 1 : 0);
			
$ios_download_image=e('ios_download_image');
$android_version=e('android_version');
$android_store_id=e('android_store_id');
$android_active=(isset($_POST['android_active'])  && $_POST['android_active']!='0' ? 1 : 0);
			
$android_download_image=e('android_download_image');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (app_name,app_icon,apple_version,apple_store_id,ios_active,ios_download_image,android_version,android_store_id,android_active,android_download_image,admin_add_id,date_created) VALUES ('$app_name','$app_icon','$apple_version','$apple_store_id','$ios_active','$ios_download_image','$android_version','$android_store_id','$android_active','$android_download_image','$admin_add_id','$date_created')");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
$prime_last_id=$last_id=mysqli_insert_id($conn);

	
//exit model
if($internal_forced)$_POST['internal']=true;
$last_id=$prime_last_id;
require core_dir.'preModelResponse.php';
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,array('url'=>returnUrl(),'js'=>'redirect'));