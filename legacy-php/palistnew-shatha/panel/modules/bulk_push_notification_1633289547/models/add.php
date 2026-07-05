<?php
//Validate required fields
$_module='bulk_push_notification_1633289547';
validateFields($_module,$action);

if(
	!isset($_POST['title']) || $_POST['title']==""||
	!isset($_POST['message']) || $_POST['message']==""||
	!isset($_POST['specific_users_module']) || $_POST['specific_users_module']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$title=e('title');
$message=e('message');
$specific_users_module=e('specific_users_module');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (title,message,specific_users_module,admin_add_id,date_created) VALUES ('$title','$message','$specific_users_module','$admin_add_id','$date_created')");
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