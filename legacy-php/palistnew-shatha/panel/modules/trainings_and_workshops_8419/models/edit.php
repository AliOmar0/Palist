<?php
//validate fields if required
$_module='trainings_and_workshops_8419';
validateFields($_module,$action);

if(
		!isset($_POST['title'])||
		!isset($_POST['summary'])||
		!isset($_POST['content'])||
		!isset($_POST['photo'])||
		!isset($_POST['publish_date'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$summary=e('summary');
$content=e('content');
$photo=e('photo');
$publish_date=e('publish_date');

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',summary='$summary',content='$content',photo='$photo',publish_date='$publish_date',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);