<?php
//validate fields if required
$_module='uploader_1585790561';
validateFields($_module,$action);

if(
		!isset($_POST['photo'])||
		!isset($_POST['file'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$photo=e('photo');
$file=e('file');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET photo='$photo',file='$file',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);