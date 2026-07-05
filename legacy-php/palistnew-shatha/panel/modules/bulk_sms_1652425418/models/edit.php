<?php
//validate fields if required
$_module='bulk_sms_1652425418';
validateFields($_module,$action);

if(
		!isset($_POST['message']) || $_POST['message']==""||
		!isset($_POST['module_prefix']) || $_POST['module_prefix']==""||
		!isset($_POST['mobile_field']) || $_POST['mobile_field']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$message=e('message');
$module_prefix=e('module_prefix');
$mobile_field=e('mobile_field');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET message='$message',module_prefix='$module_prefix',mobile_field='$mobile_field',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);