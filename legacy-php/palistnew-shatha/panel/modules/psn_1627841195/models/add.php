<?php
//Validate required fields
$_module='psn_1627841195';
validateFields($_module,$action);

if(
	!isset($_POST['user'])||
	!isset($_POST['title'])||
	!isset($_POST['message'])||
	!isset($_POST['extra'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$user=e('user');
$module_prefix=e('module_prefix');
$title=e('title');
$message=e('message');
$seen=(isset($_POST['seen'])  && $_POST['seen']!='0' ? 1 : 0);
			
$extra=e('extra');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (user,module_prefix,title,message,seen,extra,admin_add_id,date_created) VALUES ('$user','$module_prefix','$title','$message','$seen','$extra','$admin_add_id','$date_created')");
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