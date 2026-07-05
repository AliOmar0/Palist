<?php
//Validate required fields
$_module='croner_8308';
validateFields($_module,$action);

if(
	!isset($_POST['item_id'])||
	!isset($_POST['remark'])||
	!isset($_POST['emails'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_prefix=e('module_prefix');
$item_id=e('item_id');
$remark=e('remark');
$emails=e('emails');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_prefix,item_id,remark,emails,admin_add_id,date_created) VALUES ('$module_prefix','$item_id','$remark','$emails','$admin_add_id','$date_created')");
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