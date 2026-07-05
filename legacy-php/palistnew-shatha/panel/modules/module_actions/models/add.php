<?php
//Validate required fields
$_module='module_actions';
validateFields($_module,$action);

if(
	!isset($_POST['title'])||
	!isset($_POST['type'])||
	!isset($_POST['icon'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_id=e('module_id');
$title=e('title');
$type=e('type');
$icon=e('icon');
$private=(isset($_POST['private'])  && $_POST['private']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_id,title,type,icon,private,admin_add_id,date_created) VALUES ('$module_id','$title','$type','$icon','$private','$admin_add_id','$date_created')");
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