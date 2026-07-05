<?php
//validate fields if required
$_module='publications_8367';
validateFields($_module,$action);

if(
		!isset($_POST['photo'])||
		!isset($_POST['title'])||
		!isset($_POST['link'])||
		!isset($_POST['publish_date'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$photo=e('photo');
$title=e('title');
$link=e('link');
$publish_date=e('publish_date');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET photo='$photo',title='$title',link='$link',publish_date='$publish_date',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);