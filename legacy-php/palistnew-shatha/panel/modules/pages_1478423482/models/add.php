<?php
//Validate required fields
$_module='pages_1478423482';
validateFields($_module,$action);

if(
	!isset($_POST['title']) || $_POST['title']==""||
	!isset($_POST['slug']) || $_POST['slug']==""||
	!isset($_POST['content'])||
	!isset($_POST['photo'])||
	!isset($_POST['files'])||
	!isset($_POST['additional_file'])
) json(false,4);
if(isset($_POST['internal']))$internal_forced=true;else $internal_forced=false;
//Escape
$title=e('title');
$slug=e('slug');
$content=e('content');
$photo=e('photo');
$files=e('files');
$additional_file=e('additional_file');
$signin_required=e('signin_required');
$with_share_functionality=(isset($_POST['with_share_functionality'])  && $_POST['with_share_functionality']!='0' ? 1 : 0);
			
$with_messenger=(isset($_POST['with_messenger'])  && $_POST['with_messenger']!='0' ? 1 : 0);
			


//add to database
try{
	mysqli_query($conn,"INSERT INTO $_module (title,slug,content,photo,files,additional_file,signin_required,with_share_functionality,with_messenger,admin_add_id,date_created) VALUES ('$title','$slug','$content','$photo','$files','$additional_file','$signin_required','$with_share_functionality','$with_messenger','$admin_add_id','$date_created')");
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