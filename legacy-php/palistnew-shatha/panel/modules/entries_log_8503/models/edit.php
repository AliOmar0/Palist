<?php
//validate fields if required
$_module='entries_log_8503';
validateFields($_module,$action);

if(
		!isset($_POST['entry_id'])||
		!isset($_POST['user_id'])||
		!isset($_POST['action'])||
		!isset($_POST['remark'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$entry_module=e('entry_module');
$entry_id=e('entry_id');
$user_module=e('user_module');
$user_id=e('user_id');
$action=e('action');
$remark=e('remark');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET entry_module='$entry_module',entry_id='$entry_id',user_module='$user_module',user_id='$user_id',action='$action',remark='$remark',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);