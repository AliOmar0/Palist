<?php
//validate fields if required
$_module='croner_8308';
validateFields($_module,$action);

if(
		!isset($_POST['item_id'])||
		!isset($_POST['remark'])||
		!isset($_POST['emails'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$module_prefix=e('module_prefix');
$item_id=e('item_id');
$remark=e('remark');
$emails=e('emails');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_prefix='$module_prefix',item_id='$item_id',remark='$remark',emails='$emails',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);