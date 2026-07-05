<?php
//validate fields if required
$_module='color_palette_1645099749';
validateFields($_module,$action);

if(
		!isset($_POST['name'])||
		!isset($_POST['color']) || $_POST['color']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$name=e('name');
$color=e('color');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET name='$name',color='$color',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);