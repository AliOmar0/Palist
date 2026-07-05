<?php
//Validate required fields
$_module='hash_words_1507402735';
validateFields($_module,$action);

if(
	!isset($_POST['hash']) || $_POST['hash']==""||
	!isset($_POST['php_variable']) || $_POST['php_variable']==""
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$hash=e('hash');
$php_variable=e('php_variable');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (hash,php_variable,admin_add_id,date_created) VALUES ('$hash','$php_variable','$admin_add_id','$date_created')");
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