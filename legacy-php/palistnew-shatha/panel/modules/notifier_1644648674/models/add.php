<?php
//Validate required fields
$_module='notifier_1644648674';
validateFields($_module,$action);

if(
	!isset($_POST['title'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_id=e('module_id');
$module_action=e('module_action');
$title=e('title');
$email_notification=(isset($_POST['email_notification'])  && $_POST['email_notification']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_id,module_action,title,email_notification,admin_add_id,date_created) VALUES ('$module_id','$module_action','$title','$email_notification','$admin_add_id','$date_created')");
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