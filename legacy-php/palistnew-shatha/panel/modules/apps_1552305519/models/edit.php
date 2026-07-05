<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET app_name='$app_name',app_icon='$app_icon',apple_version='$apple_version',apple_store_id='$apple_store_id',ios_active='$ios_active',ios_download_image='$ios_download_image',android_version='$android_version',android_store_id='$android_store_id',android_active='$android_active',android_download_image='$android_download_image',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);