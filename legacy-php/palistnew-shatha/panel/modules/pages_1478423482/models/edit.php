<?php
//validate fields if required
$_module='pages_1478423482';
validateFields($_module,$action);

if(
		!isset($_POST['title']) || $_POST['title']==""||
		!isset($_POST['slug']) || $_POST['slug']==""||
		!isset($_POST['content'])||
		!isset($_POST['photo'])||
		!isset($_POST['files'])||
		!isset($_POST['additional_file'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$slug=e('slug');
$content=e('content');
$photo=e('photo');
$files=e('files');
$additional_file=e('additional_file');
$signin_required=e('signin_required');
$with_share_functionality=(isset($_POST['with_share_functionality'])  && $_POST['with_share_functionality']!='0' ? 1 : 0);
			
$with_messenger=(isset($_POST['with_messenger'])  && $_POST['with_messenger']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',slug='$slug',content='$content',photo='$photo',files='$files',additional_file='$additional_file',signin_required='$signin_required',with_share_functionality='$with_share_functionality',with_messenger='$with_messenger',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);