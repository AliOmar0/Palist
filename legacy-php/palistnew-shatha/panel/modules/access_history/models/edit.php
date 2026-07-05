<?php
//validate fields if required
$_module='access_history';
validateFields($_module,$action);

if(
		!isset($_POST['user_id'])||
		!isset($_POST['remark'])||
		!isset($_POST['ip'])||
		!isset($_POST['browser'])||
		!isset($_POST['referer'])||
		!isset($_POST['browser_language'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$module_prefix=e('module_prefix');
$user_id=e('user_id');
$remark=e('remark');
$ip=e('ip');
$browser=e('browser');
$referer=e('referer');
$browser_language=e('browser_language');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_prefix='$module_prefix',user_id='$user_id',remark='$remark',ip='$ip',browser='$browser',referer='$referer',browser_language='$browser_language',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);