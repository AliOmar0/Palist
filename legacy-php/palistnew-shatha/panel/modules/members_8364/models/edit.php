<?php
//validate fields if required
$_module='members_8364';
validateFields($_module,$action);

if(
		!isset($_POST['name'])||
		!isset($_POST['job_name'])||
		!isset($_POST['photo'])||
		!isset($_POST['summary'])||
		!isset($_POST['content'])||
		!isset($_POST['order_number'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$name=e('name');
$job_name=e('job_name');
$photo=e('photo');
$summary=e('summary');
$content=e('content');
$order_number=e('order_number');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET name='$name',job_name='$job_name',photo='$photo',summary='$summary',content='$content',order_number='$order_number',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);