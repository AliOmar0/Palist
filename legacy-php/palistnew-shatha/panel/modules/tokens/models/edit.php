<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET user_id='$user_id',module_prefix='$module_prefix',token='$token',_d='$_d',app_version='$app_version',device_model='$device_model',os_version='$os_version',browser_name='$browser_name',browser='$browser',language='$language',player_id='$player_id',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);