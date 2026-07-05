<?php
//Validate required fields
$_module='link_handler_1566934564';
validateFields($_module,$action);

if(
	!isset($_POST['all_entries'])||
	!isset($_POST['single'])||
	!isset($_POST['custom'])||
	!isset($_POST['single_title_prefix'])||
	!isset($_POST['all_entries_title'])||
	!isset($_POST['all_entries_photo'])||
	!isset($_POST['all_entries_description'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_prefix=e('module_prefix');
$all_entries=e('all_entries');
$single=e('single');
$custom=e('custom');
$single_title=e('single_title');
$single_description=e('single_description');
$publish_date_field=e('publish_date_field');
$single_photo=e('single_photo');
$single_title_alternative=e('single_title_alternative');
$single_alternative=e('single_alternative');
$single_photo_description=e('single_photo_description');
$single_title_prefix=e('single_title_prefix');
$all_entries_title=e('all_entries_title');
$robot_index=(isset($_POST['robot_index'])  && $_POST['robot_index']!='0' ? 1 : 0);
			
$robot_follow=(isset($_POST['robot_follow'])  && $_POST['robot_follow']!='0' ? 1 : 0);
			
$all_entries_photo=e('all_entries_photo');
$all_entries_description=e('all_entries_description');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_prefix,all_entries,single,custom,single_title,single_description,publish_date_field,single_photo,single_title_alternative,single_alternative,single_photo_description,single_title_prefix,all_entries_title,robot_index,robot_follow,all_entries_photo,all_entries_description,admin_add_id,date_created) VALUES ('$module_prefix','$all_entries','$single','$custom','$single_title','$single_description','$publish_date_field','$single_photo','$single_title_alternative','$single_alternative','$single_photo_description','$single_title_prefix','$all_entries_title','$robot_index','$robot_follow','$all_entries_photo','$all_entries_description','$admin_add_id','$date_created')");
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