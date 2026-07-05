<?php
//Validate required fields
$_module='tokens';
validateFields($_module,$action);

if(
	!isset($_POST['user_id'])||
	!isset($_POST['module_prefix'])||
	!isset($_POST['token'])||
	!isset($_POST['_d'])||
	!isset($_POST['app_version'])||
	!isset($_POST['device_model'])||
	!isset($_POST['os_version'])||
	!isset($_POST['browser_name'])||
	!isset($_POST['browser'])||
	!isset($_POST['player_id'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$user_id=e('user_id');
$module_prefix=e('module_prefix');
$token=e('token');
$_d=e('_d');
$app_version=e('app_version');
$device_model=e('device_model');
$os_version=e('os_version');
$browser_name=e('browser_name');
$browser=e('browser');
$language=e('language');
$player_id=e('player_id');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (user_id,module_prefix,token,_d,app_version,device_model,os_version,browser_name,browser,language,player_id,admin_add_id,date_created) VALUES ('$user_id','$module_prefix','$token','$_d','$app_version','$device_model','$os_version','$browser_name','$browser','$language','$player_id','$admin_add_id','$date_created')");
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