<?php
//validate fields if required
$_module='privileges_1565709771';
validateFields($_module,$action);

if(
		!isset($_POST['user_id']) || $_POST['user_id']==""||
		!isset($_POST['module_name'])||
		!isset($_POST['type_name'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$user_id=e('user_id');
$module_name=e('module_name');
$type_name=e('type_name');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET user_id='$user_id',module_name='$module_name',type_name='$type_name',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);