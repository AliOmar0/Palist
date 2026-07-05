<?php
//validate fields if required
$_module='web_notifications_1644647708';
validateFields($_module,$action);

if(
		!isset($_POST['user'])||
		!isset($_POST['related_id'])||
		!isset($_POST['custom_title'])||
		!isset($_POST['custom_link'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$user=e('user');
$user_module=e('user_module');
$module_id=e('module_id');
$action_id=e('action_id');
$related_id=e('related_id');
$custom_title=e('custom_title');
$custom_link=e('custom_link');
$seen=(isset($_POST['seen'])  && $_POST['seen']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET user='$user',user_module='$user_module',module_id='$module_id',action_id='$action_id',related_id='$related_id',custom_title='$custom_title',custom_link='$custom_link',seen='$seen',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);