<?php
//validate fields if required
$_module='languages_1557157519';
validateFields($_module,$action);

if(
		!isset($_POST['title']) || $_POST['title']==""||
		!isset($_POST['prefix']) || $_POST['prefix']==""||
		!isset($_POST['language_name']) || $_POST['language_name']==""||
		!isset($_POST['direction']) || $_POST['direction']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$prefix=e('prefix');
$language_name=e('language_name');
$direction=e('direction');
$active=(isset($_POST['active'])  && $_POST['active']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',prefix='$prefix',language_name='$language_name',direction='$direction',active='$active',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);