<?php
//Validate required fields
$_module='entries_log_8503';
validateFields($_module,$action);

if(
	!isset($_POST['entry_id'])||
	!isset($_POST['user_id'])||
	!isset($_POST['action'])||
	!isset($_POST['remark'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$entry_module=e('entry_module');
$entry_id=e('entry_id');
$user_module=e('user_module');
$user_id=e('user_id');
$action=e('action');
$remark=e('remark');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (entry_module,entry_id,user_module,user_id,action,remark,admin_add_id,date_created) VALUES ('$entry_module','$entry_id','$user_module','$user_id','$action','$remark','$admin_add_id','$date_created')");
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