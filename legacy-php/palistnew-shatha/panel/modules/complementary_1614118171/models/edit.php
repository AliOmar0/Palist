<?php
//validate fields if required
$_module='complementary_1614118171';
if(function_exists('validateFields'))validateFields($_module);

if(
		!isset($_POST['mother_id'])||
		!isset($_POST['child_id'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$mother_module_prefix=e('mother_module_prefix');
$mother_id=e('mother_id');
$child_module_prefix=e('child_module_prefix');
$child_id=e('child_id');
$id=e('id');

//update entry in database
if (!mysqli_query($conn, "UPDATE $_module SET mother_module_prefix='$mother_module_prefix',mother_id='$mother_id',child_module_prefix='$child_module_prefix',child_id='$child_id',date_modified='$date_modified' WHERE id='$id' LIMIT 1"))json(false,3);

	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);