<?php
//validate fields if required
$_module='psn_1627841195';
validateFields($_module,$action);

if(
		!isset($_POST['user'])||
		!isset($_POST['title'])||
		!isset($_POST['message'])||
		!isset($_POST['extra'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$user=e('user');
$module_prefix=e('module_prefix');
$title=e('title');
$message=e('message');
$seen=(isset($_POST['seen'])  && $_POST['seen']!='0' ? 1 : 0);
			
$extra=e('extra');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET user='$user',module_prefix='$module_prefix',title='$title',message='$message',seen='$seen',extra='$extra',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);