<?php
//validate fields if required
$_module='codes_8311';
validateFields($_module,$action);

if(
		!isset($_POST['title'])||
		!isset($_POST['dimension'])||
		!isset($_POST['value'])||
		!isset($_POST['color'])||
		!isset($_POST['hash_origin'])||
		!isset($_POST['hash'])||
		!isset($_POST['photo'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$dimension=e('dimension');
$value=e('value');
$color=e('color');
$hash_origin=e('hash_origin');
$hash=e('hash');
$photo=e('photo');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',dimension='$dimension',value='$value',color='$color',hash_origin='$hash_origin',hash='$hash',photo='$photo',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);