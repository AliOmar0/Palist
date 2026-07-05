<?php
//validate fields if required
$_module='statistics_box_8324';
validateFields($_module,$action);

if(
		!isset($_POST['title']) || $_POST['title']==""||
		!isset($_POST['css'])||
		!isset($_POST['ids'])||
		!isset($_POST['order_number'])||
		!isset($_POST['shortname'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$css=e('css');
$ids=e('ids');
$order_number=e('order_number');
$shortname=e('shortname');
$dashboard=(isset($_POST['dashboard'])  && $_POST['dashboard']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',css='$css',ids='$ids',order_number='$order_number',shortname='$shortname',dashboard='$dashboard',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);