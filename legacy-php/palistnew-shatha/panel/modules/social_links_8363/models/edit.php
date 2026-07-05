<?php
//validate fields if required
$_module='social_links_8363';
validateFields($_module,$action);

if(
		!isset($_POST['title']) || $_POST['title']==""||
		!isset($_POST['link'])||
		!isset($_POST['social_font']) || $_POST['social_font']==""
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$link=e('link');
$social_font=e('social_font');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',link='$link',social_font='$social_font',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);