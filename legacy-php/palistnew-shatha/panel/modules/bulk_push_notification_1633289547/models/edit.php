<?php
//validate fields if required
$_module='bulk_push_notification_1633289547';
validateFields($_module,$action);

if(
		!isset($_POST['title']) || $_POST['title']==""||
		!isset($_POST['message']) || $_POST['message']==""||
		!isset($_POST['specific_users_module']) || $_POST['specific_users_module']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$message=e('message');
$specific_users_module=e('specific_users_module');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',message='$message',specific_users_module='$specific_users_module',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);