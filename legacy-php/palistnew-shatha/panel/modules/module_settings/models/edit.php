<?php
//validate fields if required
$_module='module_settings';
validateFields($_module,$action);

if(
		!isset($_POST['module_prefix'])||
		!isset($_POST['default_column'])||
		!isset($_POST['default_order'])||
		!isset($_POST['items_per_page'])||
		!isset($_POST['ml_fields'])||
		!isset($_POST['menu_field'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$module_prefix=e('module_prefix');
$default_column=e('default_column');
$default_order=e('default_order');
$items_per_page=e('items_per_page');
$ml_fields=e('ml_fields');
$menu_field=e('menu_field');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_prefix='$module_prefix',default_column='$default_column',default_order='$default_order',items_per_page='$items_per_page',ml_fields='$ml_fields',menu_field='$menu_field',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);