<?php
//validate fields if required
$_module='error_1528374155';
validateFields($_module,$action);

if(
		!isset($_POST['error_desc']) || $_POST['error_desc']==""||
		!isset($_POST['icon']) || $_POST['icon']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$error_desc=e('error_desc');
$icon=(isset($_POST['icon']) ? e('icon') : '');
			
$die=(isset($_POST['die'])  && $_POST['die']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET error_desc='$error_desc',icon='$icon',die='$die',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);