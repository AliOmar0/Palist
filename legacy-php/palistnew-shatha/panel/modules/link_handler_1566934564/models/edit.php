<?php
//validate fields if required
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
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

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

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_prefix='$module_prefix',all_entries='$all_entries',single='$single',custom='$custom',single_title='$single_title',single_description='$single_description',publish_date_field='$publish_date_field',single_photo='$single_photo',single_title_alternative='$single_title_alternative',single_alternative='$single_alternative',single_photo_description='$single_photo_description',single_title_prefix='$single_title_prefix',all_entries_title='$all_entries_title',robot_index='$robot_index',robot_follow='$robot_follow',all_entries_photo='$all_entries_photo',all_entries_description='$all_entries_description',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);