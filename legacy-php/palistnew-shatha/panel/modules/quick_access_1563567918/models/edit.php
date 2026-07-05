<?php
//validate fields if required
$_module='quick_access_1563567918';
validateFields($_module,$action);

if(
		!isset($_POST['module_prefix'])||
		!isset($_POST['action_of_module'])||
		!isset($_POST['title_of_link'])||
		!isset($_POST['custom_link'])||
		!isset($_POST['icon'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$module_prefix=e('module_prefix');
$action_of_module=e('action_of_module');
$title_of_link=e('title_of_link');
$custom_link=e('custom_link');
$icon=e('icon');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_prefix='$module_prefix',action_of_module='$action_of_module',title_of_link='$title_of_link',custom_link='$custom_link',icon='$icon',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);