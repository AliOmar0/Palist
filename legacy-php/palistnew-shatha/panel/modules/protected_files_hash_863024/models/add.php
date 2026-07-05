<?php
//Validate required fields
$_module='protected_files_hash_863024';
validateFields($_module,$action);

if(
	!isset($_POST['file_name'])||
	!isset($_POST['requested_file_version'])||
	!isset($_POST['ip'])||
	!isset($_POST['device'])||
	!isset($_POST['version'])||
	!isset($_POST['user'])||
	!isset($_POST['user_module'])||
	!isset($_POST['hash'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$file_name=e('file_name');
$requested_file_version=e('requested_file_version');
$ip=e('ip');
$device=e('device');
$version=e('version');
$user=e('user');
$user_module=e('user_module');
$hash=e('hash');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (file_name,requested_file_version,ip,device,version,user,user_module,hash,admin_add_id,date_created) VALUES ('$file_name','$requested_file_version','$ip','$device','$version','$user','$user_module','$hash','$admin_add_id','$date_created')");
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