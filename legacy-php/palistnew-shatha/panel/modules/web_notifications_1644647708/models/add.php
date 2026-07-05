<?php
//Validate required fields
$_module='web_notifications_1644647708';
validateFields($_module,$action);

if(
	!isset($_POST['user'])||
	!isset($_POST['related_id'])||
	!isset($_POST['custom_title'])||
	!isset($_POST['custom_link'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$user=e('user');
$user_module=e('user_module');
$module_id=e('module_id');
$action_id=e('action_id');
$related_id=e('related_id');
$custom_title=e('custom_title');
$custom_link=e('custom_link');
$seen=(isset($_POST['seen'])  && $_POST['seen']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (user,user_module,module_id,action_id,related_id,custom_title,custom_link,seen,admin_add_id,date_created) VALUES ('$user','$user_module','$module_id','$action_id','$related_id','$custom_title','$custom_link','$seen','$admin_add_id','$date_created')");
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