<?php
//Validate required fields
$_module='modules';
validateFields($_module,$action);

if(
	!isset($_POST['module_name'])||
	!isset($_POST['module_prefix'])||
	!isset($_POST['order_by'])||
	!isset($_POST['version'])||
	!isset($_POST['main_icon'])||
	!isset($_POST['legion_version'])||
	!isset($_POST['legion_build'])||
	!isset($_POST['models'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_name=e('module_name');
$module_prefix=e('module_prefix');
$order_by=e('order_by');
$version=e('version');
$main_icon=e('main_icon');
$legion_version=e('legion_version');
$legion_build=e('legion_build');
$is_edit_only=(isset($_POST['is_edit_only'])  && $_POST['is_edit_only']!='0' ? 1 : 0);
			
$is_complemantary=(isset($_POST['is_complemantary'])  && $_POST['is_complemantary']!='0' ? 1 : 0);
			
$models=e('models');
$ml=(isset($_POST['ml'])  && $_POST['ml']!='0' ? 1 : 0);
			
$core=(isset($_POST['core'])  && $_POST['core']!='0' ? 1 : 0);
			
$cluster=(isset($_POST['cluster'])  && $_POST['cluster']!='0' ? 1 : 0);
			
$external_access=(isset($_POST['external_access'])  && $_POST['external_access']!='0' ? 1 : 0);
			
$commerce=(isset($_POST['commerce'])  && $_POST['commerce']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_name,module_prefix,order_by,version,main_icon,legion_version,legion_build,is_edit_only,is_complemantary,models,ml,core,cluster,external_access,commerce,admin_add_id,date_created) VALUES ('$module_name','$module_prefix','$order_by','$version','$main_icon','$legion_version','$legion_build','$is_edit_only','$is_complemantary','$models','$ml','$core','$cluster','$external_access','$commerce','$admin_add_id','$date_created')");
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