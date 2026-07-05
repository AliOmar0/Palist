<?php
//validate fields if required
$_module='sms_1583164170';
validateFields($_module,$action);

if(
		!isset($_POST['country_code']) || $_POST['country_code']==""||
		!isset($_POST['phone_number']) || $_POST['phone_number']==""||
		!isset($_POST['message']) || $_POST['message']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$country_code=e('country_code');
$phone_number=e('phone_number');
$message=e('message');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET country_code='$country_code',phone_number='$phone_number',message='$message',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);