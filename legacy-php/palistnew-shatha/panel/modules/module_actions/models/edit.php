<?php
//validate fields if required
$_module='module_actions';
validateFields($_module,$action);

if(
		!isset($_POST['title'])||
		!isset($_POST['type'])||
		!isset($_POST['icon'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$module_id=e('module_id');
$title=e('title');
$type=e('type');
$icon=e('icon');
$private=(isset($_POST['private'])  && $_POST['private']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_id='$module_id',title='$title',type='$type',icon='$icon',private='$private',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);