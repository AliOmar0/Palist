<?php
//Validate required fields
$_module='cookies_1565697908';
validateFields($_module,$action);

if(
	!isset($_POST['user_id'])||
	!isset($_POST['token'])||
	!isset($_POST['browser'])||
	!isset($_POST['browser_name'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$user_id=e('user_id');
$module_id=e('module_id');
$token=e('token');
$browser=e('browser');
$browser_name=e('browser_name');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (user_id,module_id,token,browser,browser_name,admin_add_id,date_created) VALUES ('$user_id','$module_id','$token','$browser','$browser_name','$admin_add_id','$date_created')");
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