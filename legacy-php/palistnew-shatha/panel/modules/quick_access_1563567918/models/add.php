<?php
//Validate required fields
$_module='quick_access_1563567918';
validateFields($_module,$action);

if(
	!isset($_POST['module_prefix'])||
	!isset($_POST['action_of_module'])||
	!isset($_POST['title_of_link'])||
	!isset($_POST['custom_link'])||
	!isset($_POST['icon'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_prefix=e('module_prefix');
$action_of_module=e('action_of_module');
$title_of_link=e('title_of_link');
$custom_link=e('custom_link');
$icon=e('icon');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_prefix,action_of_module,title_of_link,custom_link,icon,admin_add_id,date_created) VALUES ('$module_prefix','$action_of_module','$title_of_link','$custom_link','$icon','$admin_add_id','$date_created')");
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