<?php
//Validate required fields
$_module='complementary_1614118171';
if(function_exists('validateFields'))validateFields($_module);

if(
	!isset($_POST['mother_id'])||
	!isset($_POST['child_id'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$mother_module_prefix=e('mother_module_prefix');
$mother_id=e('mother_id');
$child_module_prefix=e('child_module_prefix');
$child_id=e('child_id');


//add to database
if (!mysqli_query($conn, "INSERT INTO $_module (mother_module_prefix,mother_id,child_module_prefix,child_id,admin_add_id,date_created) VALUES ('$mother_module_prefix','$mother_id','$child_module_prefix','$child_id','$admin_add_id','$date_created')"))json(false,3);
	
$prime_last_id=$last_id=mysqli_insert_id($conn);
	
//exit model
if($internal_forced)$_POST['internal']=true;
$last_id=$prime_last_id;
require core_dir.'preModelResponse.php';
require custom_dir.'custom_module_response.php';
json(true,2,NULL,NULL,array('url'=>returnUrl(),'js'=>'redirect'));