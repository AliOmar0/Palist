<?php
//Validate required fields
$_module='languages_1557157519';
validateFields($_module,$action);

if(
	!isset($_POST['title']) || $_POST['title']==""||
	!isset($_POST['prefix']) || $_POST['prefix']==""||
	!isset($_POST['language_name']) || $_POST['language_name']==""||
	!isset($_POST['direction']) || $_POST['direction']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$title=e('title');
$prefix=e('prefix');
$language_name=e('language_name');
$direction=e('direction');
$active=(isset($_POST['active'])  && $_POST['active']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (title,prefix,language_name,direction,active,admin_add_id,date_created) VALUES ('$title','$prefix','$language_name','$direction','$active','$admin_add_id','$date_created')");
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