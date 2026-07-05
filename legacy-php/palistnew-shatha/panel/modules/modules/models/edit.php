<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_name='$module_name',module_prefix='$module_prefix',order_by='$order_by',version='$version',main_icon='$main_icon',legion_version='$legion_version',legion_build='$legion_build',is_edit_only='$is_edit_only',is_complemantary='$is_complemantary',models='$models',ml='$ml',core='$core',cluster='$cluster',external_access='$external_access',commerce='$commerce',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);