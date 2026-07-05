<?php
//Validate required fields
$_module='statistics_box_8324';
validateFields($_module,$action);

if(
	!isset($_POST['title']) || $_POST['title']==""||
	!isset($_POST['css'])||
	!isset($_POST['ids'])||
	!isset($_POST['order_number'])||
	!isset($_POST['shortname'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$title=e('title');
$css=e('css');
$ids=e('ids');
$order_number=e('order_number');
$shortname=e('shortname');
$dashboard=(isset($_POST['dashboard'])  && $_POST['dashboard']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (title,css,ids,order_number,shortname,dashboard,admin_add_id,date_created) VALUES ('$title','$css','$ids','$order_number','$shortname','$dashboard','$admin_add_id','$date_created')");
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