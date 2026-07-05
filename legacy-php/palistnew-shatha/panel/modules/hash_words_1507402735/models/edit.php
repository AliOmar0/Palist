<?php
//validate fields if required
$_module='hash_words_1507402735';
validateFields($_module,$action);

if(
		!isset($_POST['hash']) || $_POST['hash']==""||
		!isset($_POST['php_variable']) || $_POST['php_variable']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$hash=e('hash');
$php_variable=e('php_variable');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET hash='$hash',php_variable='$php_variable',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);