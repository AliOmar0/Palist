<?php
//validate fields if required
$_module='seo_custom_852526';
validateFields($_module,$action);

if(
		!isset($_POST['related_id'])||
		!isset($_POST['title'])||
		!isset($_POST['description'])||
		!isset($_POST['meta'])||
		!isset($_POST['type'])||
		!isset($_POST['photo'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$module_id=e('module_id');
$related_id=e('related_id');
$title=e('title');
$default_language=e('default_language');
$description=e('description');
$meta=e('meta');
$type=e('type');
$photo=e('photo');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET module_id='$module_id',related_id='$related_id',title='$title',default_language='$default_language',description='$description',meta='$meta',type='$type',photo='$photo',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);