<?php
//validate fields if required
$_module='tester_1565720578';
validateFields($_module,$action);

if(
		!isset($_POST['raw_post'])||
		!isset($_POST['specific_data'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$raw_post=e('raw_post');
$specific_data=e('specific_data');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET raw_post='$raw_post',specific_data='$specific_data',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);