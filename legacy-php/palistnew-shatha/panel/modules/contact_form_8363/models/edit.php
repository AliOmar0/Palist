<?php
//validate fields if required
$_module='contact_form_8363';
validateFields($_module,$action);

if(
		!isset($_POST['name']) || $_POST['name']==""||
		!isset($_POST['email']) || $_POST['email']==""||
		!isset($_POST['mobile_number']) || $_POST['mobile_number']==""||
		!isset($_POST['telephone'])||
		!isset($_POST['message']) || $_POST['message']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$name=e('name');
$email=e('email');
$mobile_number=e('mobile_number');
$telephone=e('telephone');
$message=e('message');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET name='$name',email='$email',mobile_number='$mobile_number',telephone='$telephone',message='$message',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);