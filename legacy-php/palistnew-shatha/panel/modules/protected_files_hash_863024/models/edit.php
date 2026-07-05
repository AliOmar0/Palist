<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$file_name=e('file_name');
$requested_file_version=e('requested_file_version');
$ip=e('ip');
$device=e('device');
$version=e('version');
$user=e('user');
$user_module=e('user_module');
$hash=e('hash');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET file_name='$file_name',requested_file_version='$requested_file_version',ip='$ip',device='$device',version='$version',user='$user',user_module='$user_module',hash='$hash',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);