<?php
//Validate required fields
$_module='error_1528374155';
validateFields($_module,$action);

if(
	!isset($_POST['error_desc']) || $_POST['error_desc']==""||
	!isset($_POST['icon']) || $_POST['icon']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$error_desc=e('error_desc');
$icon=(isset($_POST['icon']) ? e('icon') : '');
			
$die=(isset($_POST['die'])  && $_POST['die']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (error_desc,icon,die,admin_add_id,date_created) VALUES ('$error_desc','$icon','$die','$admin_add_id','$date_created')");
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