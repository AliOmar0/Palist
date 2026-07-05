<?php
//Validate required fields
$_module='module_settings';
validateFields($_module,$action);

if(
	!isset($_POST['module_prefix'])||
	!isset($_POST['default_column'])||
	!isset($_POST['default_order'])||
	!isset($_POST['items_per_page'])||
	!isset($_POST['ml_fields'])||
	!isset($_POST['menu_field'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_prefix=e('module_prefix');
$default_column=e('default_column');
$default_order=e('default_order');
$items_per_page=e('items_per_page');
$ml_fields=e('ml_fields');
$menu_field=e('menu_field');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_prefix,default_column,default_order,items_per_page,ml_fields,menu_field,admin_add_id,date_created) VALUES ('$module_prefix','$default_column','$default_order','$items_per_page','$ml_fields','$menu_field','$admin_add_id','$date_created')");
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