<?php
//Validate required fields
$_module='seo_custom_852526';
validateFields($_module,$action);

if(
	!isset($_POST['related_id'])||
	!isset($_POST['title'])||
	!isset($_POST['description'])||
	!isset($_POST['meta'])||
	!isset($_POST['type'])||
	!isset($_POST['photo'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$module_id=e('module_id');
$related_id=e('related_id');
$title=e('title');
$default_language=e('default_language');
$description=e('description');
$meta=e('meta');
$type=e('type');
$photo=e('photo');


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (module_id,related_id,title,default_language,description,meta,type,photo,admin_add_id,date_created) VALUES ('$module_id','$related_id','$title','$default_language','$description','$meta','$type','$photo','$admin_add_id','$date_created')");
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