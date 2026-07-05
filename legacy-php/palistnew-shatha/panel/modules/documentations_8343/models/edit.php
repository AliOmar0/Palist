<?php
//validate fields if required
$_module='documentations_8343';
validateFields($_module,$action);

if(
		!isset($_POST['title']) || $_POST['title']==""||
		!isset($_POST['content'])
		|| !isset($_POST['id']) || $_POST['id']=="" 
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;

//escape parameters
$id=e('id');

$title=e('title');
$content=e('content');
$errors=(isset($_POST['errors'])  && $_POST['errors']!='0' ? 1 : 0);
			

//update entry in database
try{
	mysqli_query($conn,"UPDATE $_module SET title='$title',content='$content',errors='$errors',date_modified='$date_modified' WHERE id='$id' LIMIT 1");
}
catch(mysqli_sql_exception $e){
	json(false,3);
}
	
	
if($internal_forced)$_POST['internal']=true;
require core_dir.'preModelResponse.php';	
require custom_dir.'custom_module_response.php';
//ajaxly saved
json(true,2);