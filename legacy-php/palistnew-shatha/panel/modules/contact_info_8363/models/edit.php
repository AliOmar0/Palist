<?php
//validate fields if required
$_module='contact_info_8363';
validateFields($_module,$action);

if(
		!isset($_POST['phone'])||
		!isset($_POST['email'])||
		!isset($_POST['location'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$phone=e('phone');
$email=e('email');
$location=e('location');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET phone='$phone',email='$email',location='$location',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);