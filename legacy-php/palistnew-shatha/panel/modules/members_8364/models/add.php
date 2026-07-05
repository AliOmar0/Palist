<?php
//Validate required fields
$_module='members_8364';
validateFields($_module,$action);

if(
	!isset($_POST['name'])||
	!isset($_POST['job_name'])||
	!isset($_POST['photo'])||
	!isset($_POST['summary'])||
	!isset($_POST['content'])||
	!isset($_POST['order_number'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$name=e('name');
$job_name=e('job_name');
$photo=e('photo');
$summary=e('summary');
$content=e('content');
$order_number=e('order_number');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (name,job_name,photo,summary,content,order_number,admin_add_id,date_created) VALUES ('$name','$job_name','$photo','$summary','$content','$order_number','$admin_add_id','$date_created')");
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