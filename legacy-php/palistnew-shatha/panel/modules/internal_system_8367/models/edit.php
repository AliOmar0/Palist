<?php
//validate fields if required
$_module='internal_system_8367';
validateFields($_module,$action);

if(
		!isset($_POST['pdf_file'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$pdf_file=e('pdf_file');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET pdf_file='$pdf_file',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);