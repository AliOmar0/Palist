<?php
//validate fields if required
$_module='about_the_syndicate_8362';
validateFields($_module,$action);

if(
		!isset($_POST['title'])||
		!isset($_POST['photo'])||
		!isset($_POST['photo_in_single'])||
		!isset($_POST['summary'])||
		!isset($_POST['content'])||
		!isset($_POST['mission_icon'])||
		!isset($_POST['mission_title'])||
		!isset($_POST['mission_content'])||
		!isset($_POST['vision_icon'])||
		!isset($_POST['vision_title'])||
		!isset($_POST['vision_content'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$photo=e('photo');
$photo_in_single=e('photo_in_single');
$summary=e('summary');
$content=e('content');
$mission_icon=e('mission_icon');
$mission_title=e('mission_title');
$mission_content=e('mission_content');
$vision_icon=e('vision_icon');
$vision_title=e('vision_title');
$vision_content=e('vision_content');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',photo='$photo',photo_in_single='$photo_in_single',summary='$summary',content='$content',mission_icon='$mission_icon',mission_title='$mission_title',mission_content='$mission_content',vision_icon='$vision_icon',vision_title='$vision_title',vision_content='$vision_content',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);