<?php
//Validate required fields
$_module='contact_form_8363';
validateFields($_module,$action);

if(
	!isset($_POST['name']) || $_POST['name']==""||
	!isset($_POST['email']) || $_POST['email']==""||
	!isset($_POST['mobile_number']) || $_POST['mobile_number']==""||
	!isset($_POST['telephone'])||
	!isset($_POST['message']) || $_POST['message']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$name=e('name');
$email=e('email');
$mobile_number=e('mobile_number');
$telephone=e('telephone');
$message=e('message');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (name,email,mobile_number,telephone,message,admin_add_id,date_created) VALUES ('$name','$email','$mobile_number','$telephone','$message','$admin_add_id','$date_created')");
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