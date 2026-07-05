<?php
//Validate required fields
$_module='sms_1583164170';
validateFields($_module,$action);

if(
	!isset($_POST['country_code']) || $_POST['country_code']==""||
	!isset($_POST['phone_number']) || $_POST['phone_number']==""||
	!isset($_POST['message']) || $_POST['message']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$country_code=e('country_code');
$phone_number=e('phone_number');
$message=e('message');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (country_code,phone_number,message,admin_add_id,date_created) VALUES ('$country_code','$phone_number','$message','$admin_add_id','$date_created')");
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